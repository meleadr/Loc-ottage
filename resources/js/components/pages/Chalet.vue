<template>
    <div class="chalet">
        <div class="chalet__left">
            <img src="/images/chalet.jpg" alt="Chalet" />
            <h1>{{ chalet.title }}</h1>
        </div>
        <div class="chalet__info">
            <p><strong>Taille:</strong> {{ chalet.size }} sqm</p>
            <p>
                <strong>Personnes:</strong>
                {{ chalet.persons }} persons
            </p>
            <p><strong>Chambre:</strong> {{ chalet.bedrooms }}</p>
            <p><strong>Prix par nuit:</strong> {{ chalet.price }} $</p>
        </div>
        <div class="chalet__description">
            <p>{{ chalet.description }}</p>
        </div>
        <div class="chalet__calendar">
            <p><strong>Selectionner vos dates:</strong></p>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const chalet = ref({
    title: "Cozy Cottage",
    size: 100,
    persons: 4,
    bedrooms: 2,
    price: 150,
    description:
        "A lovely cottage situated in a serene and peaceful environment...",
});

const dateRange = ref(null);
</script>

<style lang="scss">
@use "@sass/_variables" as *;

.chalet {
    color: $color-text-dark;
    background-color: $color-background-light;
    border: 1px solid $color-border-dark;
    border-radius: $border-radius-default;
    padding: $spacing-default;
    font-family: $font-family-default;

    &__left {
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

    &__description {
        font-size: $font-size-default;
        color: $color-text-light;
        margin-top: $spacing-large;
    }
}
</style>
