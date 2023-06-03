<template>
    <a href="/chalet" class="button">Retour</a>
    <div class="chalet">
        <div class="chalet__left">
            <h1>{{ chalet.title }}</h1>
            <img src="/assets/images/cottage/chalet.jpg" alt="Chalet" />
            <div class="chalet__info">
                <p><strong>Taille:</strong> {{ chalet.size }} m2</p>
                <p>
                    <strong>Personnes:</strong>
                    {{ chalet.persons }} personnes
                </p>
                <p><strong>Chambre:</strong> {{ chalet.bedrooms }}</p>
                <p><strong>Prix par nuit:</strong> {{ chalet.price }} €</p>
            </div>
        </div>
        <div class="chalet__right">
            <div class="chalet__info__description">
                <p>{{ chalet.description }}</p>
            </div>
            <div class="chalet__calendar">
                <p><strong>Selectionner vos dates:</strong></p>
                <VueDatePicker
                    v-model="date"
                    range
                    min-range="1"
                    inline
                    auto-apply
                    :disabled-dates="disabledDates"
                    :enable-time-picker="false"
                    @update:model-value="handleDate"
                >
                    <template #action-extra="{ selectCurrentDate }">
                        <span
                            @click="selectCurrentDate()"
                            title="Select current date"
                        >
                            <img class="slot-icon" src="/logo.png" />
                        </span>
                    </template>
                </VueDatePicker>
            </div>
            <div class="chalet__book">
                <p class="chalet__book__price">
                    <strong>Prix total:</strong> {{ totalPrice }} €
                </p>
                <div class="button" @click="goReservation()">Réserver</div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, reactive } from "vue";
import { useRouter } from "vue-router";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const router = useRouter();

const disabledDates = computed(() => {
    const today = new Date();

    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    const afterTomorrow = new Date(tomorrow);
    afterTomorrow.setDate(tomorrow.getDate() + 1);

    return [tomorrow, afterTomorrow];
});

const chalet = ref({
    title: "Cozy Cottage",
    size: 100,
    persons: 4,
    bedrooms: 2,
    price: 150,
    description:
        "A lovely cottage situated in a serene and peaceful environment...",
});

const date = reactive({ start: null, end: null });

const handleDate = (modelData) => {
    date.start = modelData[0];
    date.end = modelData[1];
};

const totalPrice = computed(() => {
    if (date.start && date.end) {
        const diffTime = Math.abs(date.end - date.start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // calculate the difference in days
        return diffDays * chalet.value.price;
    }
    return 0;
});

const goReservation = () => {
    if (date.start && date.end) {
        router.push({
            name: "Reservation",
            query: {
                chalet: chalet.value.title,
                startDate: date.start,
                endDate: date.end,
                totalPrice: totalPrice.value,
            },
        });
    }
};
</script>

<style lang="scss">
@use "@sass/_variables" as *;

.chalet {
    display: flex;
    color: $color-text-dark;
    background-color: $color-background-light;
    padding: $spacing-default;
    font-family: $font-family-default;

    &__left {
        width: 50vw;
        h1 {
            font-size: $font-size-large;
            color: $color-secondary;
            margin-bottom: $spacing-default;

            &:hover {
                color: $color-secondary-hover;
            }
        }

        img {
            width: 100%;
            border-radius: $border-radius-default;
            margin-bottom: $spacing-default;
        }
    }

    &__right {
        width: 50vw;
        font-size: $font-size-default;
        color: $color-text-dark;
        line-height: 1.5;

        p {
            margin-bottom: $spacing-small;
        }

        strong {
            color: $color-secondary;

            &:hover {
                color: $color-secondary-hover;
            }
        }
    }

    &__info {
        display: inline-flex;
        margin-bottom: $spacing-large;
    }

    &__description {
        font-size: $font-size-default;
        color: $color-text-light;
        margin-top: $spacing-large;
    }

    &__calendar {
        margin-top: $spacing-large;
    }

    &__book {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-top: $spacing-large;

        &__price {
            font-size: $font-size-large;
            color: $color-primary;
            margin-bottom: $spacing-default;
        }
    }
}

.slot-icon {
    height: 20px;
    width: auto;
    cursor: pointer;
}
</style>
