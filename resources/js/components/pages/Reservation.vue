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
                        value="1" 
                        @change="toggleAllOptions"
                    />
                    <label for="allin">All-in</label>
                </div>

                <div class="option">
                    <input  
                        type="checkbox" 
                        id="dinner" 
                        value="2" 
                        :disabled="allInChecked"
                        :checked="allInChecked"
                        @change="addDinnerOption()"
                    />
                    <label for="dinner">Diner</label>
                </div>

                <div class="option">
                    <input  
                        type="checkbox" 
                        id="breakfast" 
                        value="3" 
                        :disabled="allInChecked"
                        :checked="allInChecked"
                        @change="addBreakfastOption()"
                    />
                    <label for="breakfast">Déjeuner</label>
                </div>

                <div class="option">
                    <input  
                        type="checkbox" 
                        id="spa" 
                        value="4" 
                        :disabled="allInChecked"
                        :checked="allInChecked"
                        @change="addSpaOption()"
                    />
                    <label for="spa">Spa</label>
                </div>
            </div>
        </div>

        <!-- Etape 2 : Nombre de personnes -->
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
                <br />
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

        <!-- Etape 3 : Informations personnelles -->
        <div v-show="step === 3">
            <h3>Informations personnelles</h3>
            <div class="info">
                <label>
                    Prenom:
                    <input v-model="reservation.name" required />
                </label>
                <br />
                <label>
                    Nom:
                    <input v-model="reservation.surname" required />
                </label>
                <br />
                <label>
                    Email:
                    <input v-model="reservation.email" type="email" required />
                </label>
                <br />
                <label>
                    Téléphone:
                    <input v-model="reservation.phone" type="tel" required />
                </label>
            </div>
        </div>

        <!-- Etape 4 : Recapitulatif de la reservation -->
        <div v-show="step === 4">
            <h3>Recapitulatif de la reservation</h3>
            <div class="info recap">
                <p><strong>Chalet:</strong> {{ id_cottage }}</p>
                <p><strong>Date de debut:</strong> {{ startDate }}</p>
                <p><strong>Date de fin:</strong> {{ endDate }}</p>
                <p><strong>Prix total:</strong> {{ totalPrice }} €</p>
                <p><strong>Options:</strong></p>
                <ul>
                    <li v-if="optionSelected == 1">All-in</li>
                    <li v-else-if="optionSelected == 2">Diner</li>
                    <li v-else-if="optionSelected == 3">
                        Petit-déjeuner
                    </li>
                    <li v-else-if="optionSelected == 4">Spa</li>
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

    </div>
    <!-- ProgressBar & button -->
    <div class="bar_button">
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

    const optionSelected = ref();

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
            cottage_id: id_cottage,
            option_id: optionSelected.value,
            status_id: 1,
        };

        axios.post("/api/bookings/createBooking", reservationData);
    };

    const goBack = () => {
        router.go(-1);
    };

    const toggleAllOptions = () => {
        allInChecked.value = !allInChecked.value;
        optionSelected.value = allin.value;
    }

    const addDinnerOption = () => {
        optionSelected.value = dinner.value;
    }

    const addBreakfastOption = () => {
        optionSelected.value = breakfast.value;
    }

    const addSpaOption = () => {
        optionSelected.value = spa.value;
    }
</script>

<style scoped lang="scss">
@use "@sass/_variables" as *;

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    width: 80%;
    height: 100%;
    padding: 2rem;
    background-color: #fff;
    border-radius: 1rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    height: 400px;
}

h1 {
    margin-bottom: 2rem;
    text-align: center;
}

h3 {
    margin-bottom: 1rem;
}

.info {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin: 0 auto;

    .option {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 1rem;
    }

    label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        
    }
}

input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
}
.recap {
    p {
        margin-bottom: 1rem;
    }

    ul {
        margin-bottom: 1rem;
    }

    li {
        margin-left: 1rem;
    }

    strong {
        margin-right: 0.5rem;
    }
}

.bar_button {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 80%;
    margin: 0 auto;
    .progressBar {
        height: 0.5rem;
        background-color: #ccc;
        border-radius: $border-radius-default;
        transition: width 0.5s ease-in-out;
    }
    
    .div_button {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: 5%;
        margin-top: 2rem;
    }
}


</style>
