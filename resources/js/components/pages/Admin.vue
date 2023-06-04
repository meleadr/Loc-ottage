<template>
    <div class="div_button">
        <div class="button" @click="goBack">Retour sur le site</div>
        <div class="button" @click="logout">Se déconnecter</div>
    </div>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="content">
            <!-- Search, Filter, Sort -->
            <div>
                <input
                    type="text"
                    v-model="searchText"
                    placeholder="Nom, prenom, mail..."
                />
                <select v-model="selectedChalet">
                    <option value="">Tous les chalets</option>
                    <option
                        v-for="chalet in chalets"
                        :key="chalet"
                        :value="chalet"
                    >
                        {{ chalet.name }}
                    </option>
                </select>
                <select v-model="selectedStatus">
                    <option value="">Tous les status</option>
                    <option
                        v-for="status in statuses"
                        :key="status"
                        :value="status"
                    >
                        {{ status.name }}
                    </option>
                </select>
                <select v-model="sortOrder">
                    <option value="">Trier par...</option>
                    <option value="reservationDate">Date de réservation</option>
                    <option value="encodingDate">Date d'encodage</option>
                    <option value="name">Nom</option>
                </select>
                <div class="showOutdatedDiv">
                    <input
                        type="checkbox"
                        id="showOutdated"
                        v-model="showOutdated"
                    />
                    <label v-if="showOutdated" for="showOutdated"
                        ><i class="bx bx-show"></i> Voir +
                    </label>
                    <label v-else for="showOutdated">
                        <i class="bx bx-show"></i> Voir -
                    </label>
                </div>
            </div>

            <!-- Reservation Table -->
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Chalet</th>
                        <th>Nb personnes</th>
                        <th>Date d'encodage</th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="reservation in filteredReservations"
                        :key="reservation.id"
                        :class="getClassForReservation(reservation)"
                    >
                        <td>{{ reservation.name }}</td>
                        <td>{{ reservation.surname }}</td>
                        <td>{{ reservation.email }}</td>
                        <td>{{ reservation.phone }}</td>
                        <td>{{ reservation.cottage }}</td>
                        <td>{{ reservation.persons }}</td>
                        <td>{{ reservation.created_at_string }}</td>
                        <td>{{ reservation.start_date_string }}</td>
                        <td>{{ reservation.end_date_string }}</td>
                        <td>{{ reservation.status }}</td>
                        <td>
                            <button
                                v-show="reservation.status_id === 1"
                                @click="updateReservationStatus(reservation, 2)"
                            >
                                Confirmé
                            </button>
                            <button
                                v-show="reservation.status_id === 2"
                                @click="updateReservationStatus(reservation, 4)"
                            >
                                Marqué comme payé
                            </button>
                            <button
                                v-show="reservation.status_id !== 3"
                                @click="updateReservationStatus(reservation, 3)"
                            >
                                Annuler
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

// Declarations des variables
const reservations = ref([]);
const reservationsOutdated = ref([]);
const chalets = ref([]);
const statuses = ref([]);
const searchText = ref("");
const selectedChalet = ref("");
const selectedStatus = ref("");
const sortOrder = ref("");
const searchQuery = computed(() => searchText.value.toLowerCase());
const sortOption = computed(() => sortOrder.value);
const showOutdated = ref(false);

// Retourne sur la page d'accueil
const goBack = () => {
    router.push("/");
};

// Déconnecte l'utilisateur
const logout = () => {
    sessionStorage.removeItem("token");
    router.push("/admin/login");
};

// Récupère les données de la base de données
const getAllCottages = async () => {
    const response = await axios.get("/api/cottages/getAllCottages");
    chalets.value = response.data;
};

const getAllReservations = async () => {
    const response = await axios.get("/api/bookings/getAllBookings");
    reservations.value = response.data;
};

const getAllStatuses = async () => {
    const response = await axios.get("/api/status/getAllStatus");
    statuses.value = response.data;
};

// Effectue les recherches, filtres et tris
onMounted(async () => {
    await getAllCottages();
    await getAllReservations();
    await getAllStatuses();

    reservations.value.forEach((reservation) => {
        reservation.status = statuses.value.find(
            (status) => status.id === reservation.status_id
        ).name;
    });

    reservations.value.forEach((reservation) => {
        reservation.cottage = chalets.value.find(
            (chalet) => chalet.id === reservation.cottage_id
        ).name;
    });

    reservations.value.forEach((reservation) => {
        reservation.created_at_string = new Date(
            reservation.created_at
        ).toLocaleDateString();
        reservation.start_date_string = new Date(
            reservation.start_date
        ).toLocaleDateString();
        reservation.end_date_string = new Date(
            reservation.end_date
        ).toLocaleDateString();
    });

    reservationsOutdated.value = reservations.value;

    // remove reservations that are outdated from the list but keep them if status is no already paid
    reservations.value = reservations.value.filter(
        (reservation) =>
            new Date(reservation.end_date) >= new Date() ||
            (reservation.status_id !== 4 && reservation.status_id !== 3)
    );

    // remove reservations that are outdated from the list but keep them if status is no already paid
    reservationsOutdated.value = reservationsOutdated.value.filter(
        (reservation) =>
            (new Date(reservation.end_date) < new Date() &&
                reservation.status_id === 4) ||
            reservation.status_id === 3
    );
});

// Computed property to return the appropriate list based on showOutdated
const displayedReservations = computed(() => {
    // If showOutdated is checked, return all reservations
    if (showOutdated.value) {
        return [...reservations.value, ...reservationsOutdated.value];
    }
    return reservations.value;
});

// Filtre les réservations en fonction des critères de recherche
const filteredReservations = computed(() => {
    let result = displayedReservations.value;

    // Algorithme de recherche
    if (searchQuery.value) {
        result = result.filter(
            (reservation) =>
                reservation.name.toLowerCase().includes(searchQuery.value) ||
                reservation.surname.toLowerCase().includes(searchQuery.value) ||
                reservation.email.toLowerCase().includes(searchQuery.value)
        );
    }

    // Algorithme de filtre
    if (selectedChalet.value) {
        result = result.filter(
            (reservation) => reservation.cottage_id === selectedChalet.value.id
        );
    }

    // Algorithme de tri
    if (selectedStatus.value) {
        result = result.filter(
            (reservation) => reservation.status_id === selectedStatus.value.id
        );
    }

    // Algorithme de tri
    if (sortOption.value) {
        switch (sortOption.value) {
            case "name":
                result.sort((a, b) => a.name.localeCompare(b.name));
                break;
            case "reservationDate":
                result.sort(
                    (a, b) => new Date(a.start_date) - new Date(b.start_date)
                );
                break;
            case "encodingDate":
                result.sort(
                    (a, b) => new Date(a.created_at) - new Date(b.created_at)
                );
                break;
            default:
        }
    }

    return result;
});

// Met à jour le status d'une réservation
const updateReservationStatus = async (reservation, status) => {
    const id_status_before = reservation.status_id;
    const id_status_after = status;
    const response = await axios.post(
        "/api/bookings/updateStatus/" + reservation.id,
        {
            status_id: status,
        }
    );

    if (response.status === 200) {
        reservation.status_id = status;
        reservation.status = statuses.value.find(
            (status) => status.id === reservation.status_id
        ).name;

        const response2 = await axios.post(
            "/api/historique/createHistoriqueBooking",
            {
                id_booking: reservation.id,
                id_status_before: id_status_before,
                id_status_after: id_status_after,
                id_user: sessionStorage.getItem("id_user"),
            }
        );
        if (response2.status === 200) {
            console.log("Historique ajouté");
        }
    } else {
        console.log("error");
    }
};

// Retourne la classe css correspondant au status d'une réservation
const getClassForReservation = (reservation) => {
    if (
        new Date(reservation.end_date) < new Date() &&
        reservation.status_id !== 4 &&
        reservation.status_id !== 3
    ) {
        return "red";
    } else if (reservation.status_id === 3) {
        return "orange";
    } else if (reservation.status_id === 4) {
        return "green";
    }
};
</script>

<style scoped lang="scss">
@use "@sass/_variables" as *;

.div_button {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: $spacing-large;
    margin-top: $spacing-large;
    margin-left: $spacing-large;
    margin-right: $spacing-large;
}

div {
    display: flex;
    flex-direction: column;
    align-items: center;

    h1 {
        color: $color-secondary;
        text-align: center;
        margin-top: $spacing-large;
        margin-bottom: $spacing-large;
    }
    .content {
        div {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            margin-bottom: $spacing-large;

            select,
            input {
                width: 200px;
                padding: $spacing-small;
                font-size: $font-size-default;
                border: 1px solid $color-border-dark;
                border-radius: $border-radius-default;
            }
        }

        .showOutdatedDiv {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin: 0;

            label {
                cursor: pointer;
                color: white;
                font-size: large;
            }

            input {
                width: 20px;
                height: 20px;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;

            thead {
                tr {
                    background-color: $color-primary;
                    color: $color-text-light;
                }
            }

            th,
            td {
                padding: $spacing-small;
                border: 1px solid $color-border-dark;
            }

            tbody {
                tr {
                    transition: background-color 0.5s ease-in-out;
                    background-color: white;

                    &.orange {
                        background-color: rgba($color: orange, $alpha: 0.8);
                    }

                    &.red {
                        background-color: rgba($color: red, $alpha: 0.8);
                    }

                    &.green {
                        background-color: rgba($color: green, $alpha: 0.8);
                    }
                }
            }
        }

        button {
            margin-right: $spacing-small;
            padding: $spacing-small;
            font-size: $font-size-default;
            border-radius: $border-radius-default;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            background-color: $color-primary;
            color: $color-text-light;

            &:last-child {
                margin-right: 0;
            }

            &:hover {
                background-color: $color-primary-hover;
            }
        }
    }
}
</style>
