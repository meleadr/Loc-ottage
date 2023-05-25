<template>
    <div class="not-found-container">
        <div class="background">
            <h1 class="error-code">404</h1>
            <p class="error-message">
                Oups! La page que vous cherchez n'existe pas.
            </p>
            <button class="button" @click="goBack">Revenir en arriere</button>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const goBack = () => {
    router.back();
};
</script>

<style lang="scss" scoped>
@use "@sass/_variables" as *;

.not-found-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
    background-color: $color-background-light;
    color: $color-text-dark;

    .background {
        padding: $spacing-large;
        border-radius: $border-radius-default;
        background-color: $color-secondary-light;
    }

    .error-code {
        color: $color-primary-dark;
        font-size: 3em;
        margin-bottom: $spacing-default;
    }

    .error-message {
        margin-bottom: $spacing-large;
        font-size: $font-size-large;
    }
}
</style>
