<template>
    <div class="container">
        <div class="chalet">
            <div class="title">
                <a href="/#cottage" class="button">Retour</a>
                <h1 class="chalet__title">{{ chalet.name }}</h1>
            </div>

            <div class="chalet__image">
                <img :src="chalet.image_url" :alt="chalet.title" />
            </div>

            <div class="chalet__info">
                <CottageInfo
                    :area="chalet.area"
                    :persons="chalet.persons"
                    :bedrooms="chalet.bedrooms"
                    :price="chalet.price"
                />

                <div class="chalet__description">
                    <p>{{ chalet.description }}</p>
                </div>
            </div>
        </div>

        <div class="reservation">
            <div class="reservation__calendar">
                <p><strong>Sélectionnez vos dates :</strong></p>

                <VueDatePicker
                    v-model="date"
                    range
                    min-range="1"
                    inline
                    auto-apply
                    :disabled-dates="disabledDates"
                    :enable-time-picker="false"
                    @update:model-value="handleDate"
                    :highlight="disabledDates"
                    highlight-disabled-days
                    :day-class="getDayClass"
                    :min-date="new Date()"
                >
                    <template #action-extra="{ selectCurrentDate }">
                        <span
                            @click="selectCurrentDate()"
                            title="Sélectionner la date actuelle"
                        >
                            <img
                                class="calendar-icon"
                                src="/assets/images/logo.png"
                            />
                        </span>
                    </template>
                </VueDatePicker>
            </div>

            <div class="reservation__book">
                <p class="error" v-show="error">{{ error }}</p>
                <p class="reservation__price" v-show="totalPrice != 0">
                    <strong>Prix total :</strong> {{ totalPrice }} €
                </p>
                <div class="button" @click="goReservation()">Réserver</div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, reactive, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

// Import des composants
import CottageInfo from "../CottageInfo.vue";

const router = useRouter();
const id = router.currentRoute.value.params.id;
const chalet = ref({});
const disabledDates = ref([]);

const getCottage = async () => {
    const response = await axios.get(`/api/cottages/getCottage/${id}`);
    chalet.value = response.data;
};
const getAllDisabledDates = async () => {
    const response = await axios.get(
        `/api/bookings/getAllBookingsFromCottage/${id}`
    );
    response.data.forEach((booking) => {
        const start = new Date(booking.start_date);
        const end = new Date(booking.end_date);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // calculate the difference in days
        for (let i = 0; i <= diffDays; i++) {
            const date = new Date(start);
            date.setDate(date.getDate() + i);
            disabledDates.value.push(date);
        }
    });
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    disabledDates.value.push(today, tomorrow);
};

const error = ref(null);

const date = reactive({ start: null, end: null });

const handleDate = (modelData) => {
    date.start = modelData[0];
    date.end = modelData[1];
};

const totalPrice = computed(() => {
    if (date.start && date.end) {
        const diffTime = Math.abs(date.end - date.start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // calculate the difference in days
        error.value = null;
        return diffDays * chalet.value.price;
    } else {
        error.value = "Veuillez sélectionner une date.";
    }
    return 0;
});

const goReservation = () => {
    if (date.start && date.end) {
        router.push({
            name: "Reservation",
            query: {
                id: id,
                chalet: chalet.value.title,
                startDate: date.start,
                endDate: date.end,
                totalPrice: totalPrice.value,
            },
        });
    }
};

onMounted(() => {
    getCottage();
    getAllDisabledDates();
});
</script>
<style scoped lang="scss">
@use "@sass/_variables" as *;
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    max-width: none;
}

.chalet {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 50vw;
    height: 100%;
    background-color: #fff;
    padding: 2rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

    .title {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    &__title {
        color: $color-primary;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    &__image {
        width: 100%;
        margin-bottom: 1rem;

        img {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            object-fit: cover;
        }
    }

    &__info {
        width: 100%;
        margin-bottom: 2rem;
    }

    &__description {
        color: $color-primary-dark;
        font-size: $font-size-large;
        line-height: 1.5;
        margin-top: 2rem;
    }
}

.reservation {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 50%;
    height: 100vh;

    &__calendar {
        margin-top: 2rem;
        text-align: center;
    }

    &__book {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-top: 2rem;

        &__price {
            font-size: 1.2rem;
            color: #428bca;
            margin-bottom: 1rem;
        }
    }
}

.slot-icon {
    height: 40px;
    width: auto;
    cursor: pointer;
}

.error {
    color: #ff0000;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.calendar-icon {
    height: 40px;
    width: auto;
    cursor: pointer;
}
</style>
