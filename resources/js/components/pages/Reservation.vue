<template>
    <h1>Reservation</h1>
    <div class="container">
        <div v-show="step === 1">
            <h3>Choix des options</h3>
            <div class="info options">
                <div
                    v-if="
                        !optionSelected.diner && !optionSelected.petitDejeuner
                    "
                >
                    <input type="checkbox" id="allin" v-model="allInSelected" />
                    <label for="allin">All-in</label>
                </div>
                <div v-if="!allInSelected">
                    <input
                        type="checkbox"
                        id="dinner"
                        v-model="optionSelected.diner"
                    />
                    <label for="dinner">Diner</label>
                </div>
                <div v-if="!allInSelected">
                    <input
                        type="checkbox"
                        id="breakfast"
                        v-model="optionSelected.petitDejeuner"
                    />
                    <label for="breakfast">Petit-déjeuner</label>
                </div>
                <div>
                    <input
                        type="checkbox"
                        id="spa"
                        v-model="optionSelected.spa"
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
                <p><strong>Chalet:</strong> {{ chalet }}</p>
                <p><strong>Date de debut:</strong> {{ startDate }}</p>
                <p><strong>Date de fin:</strong> {{ endDate }}</p>
                <p><strong>Prix total:</strong> {{ totalPrice }} €</p>
                <p><strong>Options:</strong></p>
                <ul>
                    <li v-if="allInSelected">All-in</li>
                    <li v-else-if="optionSelected.diner">Diner</li>
                    <li v-else-if="optionSelected.petitDejeuner">
                        Petit-déjeuner
                    </li>
                    <li v-else-if="optionSelected.spa">Spa</li>
                    <li v-else>Aucune</li>
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
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const step = ref(1);

const optionSelected = ref({
    diner: false,
    petitDejeuner: false,
    spa: false,
});
const allInSelected = ref(false);

const reservation = ref({
    name: "",
    surname: "",
    email: "",
    phone: "",
    adult: 1,
    children: 0,
});

const chalet = route.query.chalet;
const totalPrice = route.query.totalPrice;
const startDate = new Date(route.query.startDate).toLocaleDateString("fr-FR");
const endDate = new Date(route.query.endDate).toLocaleDateString("fr-FR");

const submitReservation = () => {
    console.log(reservation.value);
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
    margin-top: $spacing-large;
    margin-bottom: $spacing-large;
}
.container {
    width: 50vw;
    margin: 0 auto;

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
        margin-bottom: $spacing-default;

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
        justify-content: space-evenly;

        & label {
            display: inline-flex;
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
