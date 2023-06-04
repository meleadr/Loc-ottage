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
                    placeholder="Rechercher..."
                    @input="performSearch"
                />
                <select v-model="selectedChalet" @change="performFilter">
                    <option value="">Tous les chalets</option>
                    <option
                        v-for="chalet in chalets"
                        :key="chalet"
                        :value="chalet"
                    >
                        {{ chalet }}
                    </option>
                </select>
                <select v-model="selectedStatus" @change="performFilter">
                    <option value="">Tous les status</option>
                    <option
                        v-for="status in statuses"
                        :key="status"
                        :value="status"
                    >
                        {{ status }}
                    </option>
                </select>
                <select v-model="sortOrder" @change="performSort">
                    <option value="">Trier par...</option>
                    <option value="reservationDate">Date de réservation</option>
                    <option value="encodingDate">Date d'encodage</option>
                    <option value="name">Nom</option>
                </select>
            </div>

            <!-- Reservation Table -->
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Chalet</th>
                        <th>Date de réservation</th>
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
                        <td>{{ reservation.cottage }}</td>
                        <td>{{ reservation.created_at }}</td>
                        <td>{{ reservation.start_date }}</td>
                        <td>{{ reservation.end_date }}</td>
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
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const reservations = ref([]);
const chalets = ref([]);
const statuses = ref([]);
const searchText = ref("");
const selectedChalet = ref("");
const selectedStatus = ref("");
const sortOrder = ref("");

const searchQuery = computed(() => searchText.value.toLowerCase());
const filterOption = computed(() => selectedChalet.value.toLowerCase());
const sortOption = computed(() => sortOrder.value.toLowerCase());

const goBack = () => {
    router.push("/");
};

const logout = () => {
    sessionStorage.removeItem("token");
    router.push("/admin/login");
};

const getAllCottages = async () => {
    const response = await axios.get("/api/cottages/getAllCottages");
    chalets.value = response.data;
};

const getAllReservations = async () => {
    const response = await axios.get("/api/bookings/getAllBookings");
    reservations.value = response.data;
    console.log(reservations.value);
};

const getAllStatuses = async () => {
    const response = await axios.get("/api/status/getAllStatus");
    statuses.value = response.data;
    console.log(statuses.value);
};

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

    console.log(reservations.value);
});

const filteredReservations = computed(() => {
    let result = reservations.value;

    if (searchQuery.value) {
        result = performSearch(result);
    }

    if (filterOption.value) {
        result = performFilter(result);
    }

    if (sortOption.value) {
        result = performSort(result);
    }

    return result;
});

const performSearch = () => {
    return reservations.filter(
        (reservation) =>
            reservation.name.includes(searchQuery.value) ||
            reservation.email.includes(searchQuery.value)
    );
};

const performFilter = () => {
    switch (filterOption.value) {
        case "status":
            return reservations.filter(
                (reservation) => reservation.status === "paid"
            );
        case "chalet":
            return reservations.filter(
                (reservation) => reservation.chalet === "chaletName"
            );
        default:
            return reservations;
    }
};

const performSort = () => {
    switch (sortOption.value) {
        case "name":
            return reservations.sort((a, b) => a.name.localeCompare(b.name));
        case "date":
            return reservations.sort(
                (a, b) => new Date(a.date) - new Date(b.date)
            );
        default:
            return reservations;
    }
};

const updateReservationStatus = async (reservation, status) => {
    // Implement the logic to update reservation status
};

const cancelReservation = async (reservation) => {
    // Implement the logic to cancel reservation
};

const getClassForReservation = (reservation) => {
    if (reservation.status_id === 3) {
        return "red";
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

                    &.red {
                        background-color: $color-secondary;
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
