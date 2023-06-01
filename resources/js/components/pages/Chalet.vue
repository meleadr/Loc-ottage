<template>
    <NavBar />
    <div class="chalet">
        <div class="chalet__left">
            <h1>{{ chalet.title }}</h1>
            <img src="/images/chalet.jpg" alt="Chalet" />
        </div>
        <div class="chalet__info">
            <p><strong>Taille:</strong> {{ chalet.size }} sqm</p>
            <p>
                <strong>Personnes:</strong>
                {{ chalet.persons }} persons
            </p>
            <p><strong>Chambre:</strong> {{ chalet.bedrooms }}</p>
            <p><strong>Prix par nuit:</strong> {{ chalet.price }} $</p>
            <div class="chalet__info__description">
                <p>{{ chalet.description }}</p>
            </div>
            <div class="chalet__calendar">
                <p><strong>Selectionner vos dates:</strong></p>
                <VueDatePicker
                    v-model="date"
                    range
                    inline
                    :disabled-dates="disabledDates"
                    :enable-time-picker="false"
                ></VueDatePicker>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import NavBar from "../NavBar.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

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
</script>

<style lang="scss">
@use "@sass/_variables" as *;

.chalet {
    display: flex;
    color: $color-text-dark;
    background-color: $color-background-light;
    border: 1px solid $color-border-dark;
    border-radius: $border-radius-default;
    padding: $spacing-default;
    font-family: $font-family-default;

    &__left {
        width: 50vw;
        h1 {
            font-size: $font-size-large;
            color: $color-primary;
            margin-bottom: $spacing-default;

            &:hover {
                color: $color-primary-hover;
            }
        }

        img {
            width: 100%;
            border-radius: $border-radius-default;
            margin-bottom: $spacing-default;
        }
    }

    &__info {
        width: 50vw;
        font-size: $font-size-default;
        color: $color-text-dark;
        line-height: 1.5;

        &__description {
            font-size: $font-size-default;
            color: $color-text-light;
            margin-top: $spacing-large;
        }

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
}
</style>
