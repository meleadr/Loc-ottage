<template>
    <div>
        <h1>Reservation</h1>

        <div v-show="step === 1">
            <h3>Recapitulatif de la reservation</h3>
            <p><strong>Chalet:</strong> {{ chalet }}</p>
            <p><strong>Date de debut:</strong> {{ startDate }}</p>
            <p><strong>Date de fin:</strong> {{ endDate }}</p>
            <p><strong>Prix total:</strong> {{ totalPrice }} €</p>
            <div class="button" @click="step++">Suivant</div>
        </div>

        <div v-show="step === 2">
            <h3>Personal Information</h3>
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
            <div class="button" @click="step--">Retour</div>
            <div class="button" @click="step++">Suivant</div>
        </div>

        <div v-show="step === 3">
            <h3>Numbers of Persons</h3>
            <label>
                Number of persons:
                <input
                    v-model="reservation.persons"
                    type="number"
                    min="1"
                    required
                />
            </label>
            <div class="button" @click="step--">Retour</div>
            <div class="button" @click="submitReservation">Suivant</div>
        </div>
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
const startDate = route.query.startDate;
const endDate = route.query.endDate;
const totalPrice = route.query.totalPrice;

const submitReservation = () => {
    // submit the reservation data, for example by calling an API
    console.log(reservation.value);
};
</script>
