<template>
    <h1>Reservation</h1>
    <div class="container">
        <!-- Etape 1 : Choix des options -->
        <div v-show="step === 1">
            <h3>Choix des options</h3>
            <div class="info options">
                <div class="option">
                    <input
                        type="checkbox"
                        id="allin"
                        v-model="allInChecked"
                        @change="toggleAllOptions"
                    />
                    <label for="allin">All-in</label>
                </div>

                <div class="option">
                    <input
                        type="checkbox"
                        id="dinner"
                        v-model="dinnerChecked"
                        @change="addDinnerOption"
                    />
                    <label for="dinner">Diner</label>
                </div>

                <div class="option">
                    <input
                        type="checkbox"
                        id="breakfast"
                        v-model="breakfastChecked"
                        @change="addBreakfastOption"
                    />
                    <label for="breakfast">Petit-déjeuner</label>
                </div>

                <div class="option">
                    <input
                        type="checkbox"
                        id="spa"
                        v-model="spaChecked"
                        @change="addSpaOption"
                    />
                    <label for="spa">Spa</label>
                </div>
            </div>
        </div>

        <div v-show="step === 2">
            <h3>Nombres de personnes</h3>
            <div class="info">
                <label>
                    Nombre d'adultes:
                    <input
                        v-model="reservation.adult"
                        type="number"
                        min="1"
                        required
                    />
                </label>
                <label>
                    Nombre d'enfants:
                    <input
                        v-model="reservation.children"
                        type="number"
                        min="0"
                        required
                    />
                </label>
            </div>
        </div>

        <div v-show="step === 3">
            <h3>Informations personnelles</h3>
            <div class="info">
                <label>
                    Prenom:
                    <input v-model="reservation.name" required />
                </label>
                <label>
                    Nom:
                    <input v-model="reservation.surname" required />
                </label>
                <label>
                    Email:
                    <input v-model="reservation.email" type="email" required />
                </label>
                <label>
                    Téléphone:
                    <input v-model="reservation.phone" type="tel" required />
                </label>
            </div>
        </div>

        <div v-show="step === 4">
            <h3>Recapitulatif de la reservation</h3>
            <div class="info recap">
                <p><strong>Chalet:</strong> {{ id_cottage }}</p>
                <p><strong>Date de debut:</strong> {{ startDate }}</p>
                <p><strong>Date de fin:</strong> {{ endDate }}</p>
                <p><strong>Prix total:</strong> {{ totalPrice }} €</p>
                <p><strong>Options:</strong></p>
                <ul>
                    <li v-for="option in optionSelected">
                        {{ option[Object.keys(option)[0]] }}
                    </li>
                </ul>
                <p>
                    <strong>Nombre d'adultes:</strong> {{ reservation.adult }}
                </p>
                <p>
                    <strong>Nombre d'enfants:</strong>
                    {{ reservation.children }}
                </p>
                <p><strong>Prenom:</strong> {{ reservation.name }}</p>
                <p><strong>Nom:</strong> {{ reservation.surname }}</p>
                <p><strong>Email:</strong> {{ reservation.email }}</p>
                <p><strong>Téléphone:</strong> {{ reservation.phone }}</p>
            </div>
        </div>

        <div class="progressBar" :style="{ width: progressBarWidth() }"></div>
        <div class="div_button">
            <div class="button" @click="step > 1 ? step-- : goBack()">
                Retour
            </div>
            <div
                class="button"
                @click="step < 4 ? step++ : submitReservation()"
            >
                {{ step < 4 ? "Suivant" : "Valider" }}
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const step = ref(1);

const allInChecked = ref(false);
const dinnerChecked = ref(false);
const breakfastChecked = ref(false);
const spaChecked = ref(false);

const optionSelected = ref([]);

const updateSelectedOptions = () => {
    optionSelected.value = [];
    if (
        allInChecked.value ||
        (dinnerChecked.value && breakfastChecked.value && spaChecked.value)
    )
        optionSelected.value.push({ 1: "All-in" });
    else {
        if (dinnerChecked.value) optionSelected.value.push({ 2: "Diner" });
        if (breakfastChecked.value)
            optionSelected.value.push({ 3: "Petit-déjeuner" });
        if (spaChecked.value) optionSelected.value.push({ 4: "Spa" });
    }
};

const toggleAllOptions = () => {
    const newValue = allInChecked.value;
    dinnerChecked.value = newValue;
    breakfastChecked.value = newValue;
    spaChecked.value = newValue;

    updateSelectedOptions();
};

const addDinnerOption = () => {
    updateAllInChecked();
    updateSelectedOptions();
};

const addBreakfastOption = () => {
    updateAllInChecked();
    updateSelectedOptions();
};

const addSpaOption = () => {
    updateAllInChecked();
    updateSelectedOptions();
};

const updateAllInChecked = () => {
    if (dinnerChecked.value && breakfastChecked.value && spaChecked.value) {
        allInChecked.value = true;
    } else {
        allInChecked.value = false;
    }
};

const reservation = ref({
    name: "",
    surname: "",
    email: "",
    phone: "",
    adult: 1,
    children: 0,
});

const id_cottage = route.query.id;
const totalPrice = route.query.totalPrice;
const startDate = new Date(route.query.startDate).toLocaleDateString("fr-FR");
const endDate = new Date(route.query.endDate).toLocaleDateString("fr-FR");

const submitReservation = () => {
    const reservationData = {
        startDate: startDate,
        endDate: endDate,
        totalPrice: totalPrice,
        name: reservation.value.name,
        surname: reservation.value.surname,
        email: reservation.value.email,
        phone: reservation.value.phone,
        persons: reservation.value.adult + reservation.value.children,
        options: optionSelected.value,
        cottage_id: id_cottage,
        status_id: 1,
    };

    axios.post("/api/bookings/createBooking", reservationData);
};

const goBack = () => {
    router.go(-1);
};

const progressBarWidth = () => {
    return (step.value / 4) * 100 + "%";
};
</script>

<style scoped lang="scss">
@use "@sass/_variables" as *;

h1 {
    color: $color-secondary;
    text-align: center;
}
.container {
    width: 50vw;
    margin: 0 auto;
    background-color: whitesmoke;
    padding: 1rem;
    border-radius: $border-radius-default;

    h3 {
        font-size: $font-size-large;
        color: $color-primary-dark;
        margin-bottom: $spacing-default;
        text-align: center;
    }

    label {
        display: block;
        font-size: $font-size-default;
        color: $color-text-dark;

        & input {
            display: block;
            width: 100%;
            padding: $spacing-small;
            font-size: $font-size-default;
            border: 1px solid $color-border-dark;
            border-radius: $border-radius-default;
            margin-top: $spacing-small;
        }
    }

    .info {
        padding: $spacing-large;
        min-height: 50vh;
        overflow: scroll;

        p {
            strong {
                font-size: $font-size-large;
                color: $color-secondary;
            }
        }
    }

    .recap {
        ul {
            list-style: none;
            padding-left: 0;
            margin-top: $spacing-small;
            margin-bottom: $spacing-small;
        }
    }

    .options {
        display: flex;
        flex-direction: column;
        margin-top: $spacing-large;

        .option {
            display: flex;
            gap: $spacing-default;
            margin-bottom: $spacing-default;
        }
    }

    .div_button {
        display: flex;
        justify-content: space-between;
        margin-top: $spacing-large;
    }

    .progressBar {
        width: 100%;
        height: 20px;
        background-color: $color-primary-dark;
        border-radius: $border-radius-default;
        margin-top: $spacing-large;
        transition: width 0.5s ease-in-out;
    }
}
</style>
