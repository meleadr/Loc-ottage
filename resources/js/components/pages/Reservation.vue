<template>
    <h1>Reservation</h1>
    <div class="container">
        <div v-show="step === 1">
            <h3>Recapitulatif de la reservation</h3>
            <div class="info">
                <p><strong>Chalet:</strong> {{ chalet }}</p>
                <p><strong>Date de debut:</strong> {{ startDate }}</p>
                <p><strong>Date de fin:</strong> {{ endDate }}</p>
                <p><strong>Prix total:</strong> {{ totalPrice }} €</p>
            </div>
            <div class="div_button">
                <div class="button" @click="goBack">Quitter</div>
                <div class="button" @click="step++">Suivant</div>
            </div>
        </div>

        <div v-show="step === 2">
            <h3>Personal Information</h3>
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
            <div class="div_button">
                <div class="button" @click="step--">Retour</div>
                <div class="button" @click="step++">Suivant</div>
            </div>
        </div>

        <div v-show="step === 3">
            <h3>Numbers of Persons</h3>
            <div class="info">
                <label>
                    Number of persons:
                    <input
                        v-model="reservation.persons"
                        type="number"
                        min="1"
                        required
                    />
                </label>
            </div>
            <div class="div_button">
                <div class="button" @click="step--">Retour</div>
                <div class="button" @click="submitReservation">Suivant</div>
            </div>
        </div>

        <div class="progressBar" :style="{ width: progressBarWidth() }"></div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const step = ref(1);
const reservation = ref({
    name: "",
    surname: "",
    email: "",
    phone: "",
    persons: 1,
});

const chalet = route.query.chalet;
const totalPrice = route.query.totalPrice;
const startDate = new Date(route.query.startDate).toLocaleDateString("fr-FR");
const endDate = new Date(route.query.endDate).toLocaleDateString("fr-FR");

const submitReservation = () => {
    console.log(reservation.value);
};

const goBack = () => {
    window.history.back();
};

const progressBarWidth = () => {
    return (step.value / 3) * 100 + "%";
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
        height: 50vh;
    }

    .div_button {
        display: flex;
        justify-content: space-between;
        margin-top: $spacing-large;
    }

    .progressBar {
        width: 100%;
        height: 10px;
        background-color: $color-primary-dark;
        border-radius: $border-radius-default;
        margin-top: $spacing-large;
        transition: width 0.5s ease-in-out;
    }
}
</style>
