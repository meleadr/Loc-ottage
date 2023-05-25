<template>
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        <form @submit.prevent="login">
            <div class="input-group">
                <label for="username">Email :</label>
                <input id="username" type="text" v-model="username" required />
            </div>
            <div class="input-group">
                <label for="password">Mot de passe :</label>
                <input
                    id="password"
                    type="password"
                    v-model="password"
                    required
                />
            </div>
            <div class="input-group">
                <p v-if="error" class="error">{{ error }}</p>
            </div>
            <div class="input-group">
                <button class="button" type="submit">Login</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import router from "@/router";

const username = ref("");
const password = ref("");

let error = ref(null);

const login = async () => {
    await axios
        .post("/api/auth/login", {
            email: username.value,
            password: password.value,
        })
        .then((response) => {
            if (response.data.success) {
                sessionStorage.setItem("token", response.data.token);
                router.push("/admin");
            } else {
                error.value = response.data.message;
            }
        })
        .catch((error) => {
            console.log(error);
        });
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
