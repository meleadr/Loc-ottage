<template>
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        <form @submit.prevent="submitForm">
            <div class="input-group">
                <label for="username">Username:</label>
                <input id="username" type="text" v-model="username" required />
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input
                    id="password"
                    type="password"
                    v-model="password"
                    required
                />
            </div>
            <div class="input-group">
                <button class="button" type="submit">Login</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";

const username = ref("");
const password = ref("");

const submitForm = () => {
    // here you can handle form submission,
    // like making an API request to your backend
    console.log("Username:", username.value);
    console.log("Password:", password.value);
};
</script>

<style lang="scss" scoped>
@use "@sass/_variables" as *;

.login-container {
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
    padding: $spacing-large;

    .login-title {
        margin-bottom: $spacing-large;
        text-align: center;
    }

    .input-group {
        margin-bottom: $spacing-default;

        label {
            display: block;
            margin-bottom: $spacing-small;
        }

        input {
            width: 100%;
            padding: $spacing-small;
            border: 1px solid $color-border-dark;
            border-radius: $border-radius-small;
        }
    }

    .button {
        width: 100%;
    }
}
</style>
