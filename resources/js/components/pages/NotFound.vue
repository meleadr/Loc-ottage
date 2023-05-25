<template>
    <div class="not-found-container">
        <h1 class="error-code">404</h1>
        <p class="error-message">
            Oops! The page you are looking for does not exist.
        </p>
        <button class="button" @click="goBack">Go Back</button>
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

    .error-code {
        font-size: 3em;
        margin-bottom: $spacing-default;
    }

    .error-message {
        margin-bottom: $spacing-large;
    }

    .button {
        padding: $spacing-small $spacing-default;
    }
}
</style>
