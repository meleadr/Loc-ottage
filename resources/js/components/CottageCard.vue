<template>
    <div class="card">
        <div
            class="image"
            :class="{ 'image-left': id % 2 === 0, 'image-right': id % 2 === 1 }"
        >
            <img :src="image_url" :alt="name" />
        </div>

        <div
            class="info"
            :class="{ 'info-left': id % 2 === 0, 'info-right': id % 2 === 1 }"
        >
            <h2>{{ name }}</h2>
            <p class="description">{{ description }}</p>

            <CottageInfo
                :area="area"
                :persons="persons"
                :bedrooms="bedrooms"
                :price="price"
            />

            <div class="button_container">
                <a class="button" :href="lien"> Voir plus </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import CottageInfo from "./CottageInfo.vue";
import { computed } from "vue";

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    area: {
        type: Number,
        required: true,
    },
    bedrooms: {
        type: Number,
        required: true,
    },
    persons: {
        type: Number,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    price: {
        type: Number,
        required: true,
    },
    image_url: {
        type: String,
        required: true,
    },
});

const lien = computed(() => {
    return "/chalet/" + props.id;
});
</script>

<style scoped lang="scss">
@use "@sass/_variables.scss" as *;
.card {
    display: flex;
    justify-content: center;
    width: 80%;
    align-items: center;
    margin: 2rem auto;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);
    background-color: $color-primary-hover;
}

.info {
    width: 50%;
    padding: 0 2rem;
    color: $color-secondary;

    .description {
        color: white;
    }

    &-left {
        order: 2;
    }

    &-right {
        order: 1;
    }

    .button_container {
        margin: 2rem 0;
        text-align: center;
    }
}

.image {
    width: 50%;
    padding: 0 2rem;
    display: flex;
    justify-content: center;
    align-items: center;

    &-left {
        order: 1;
    }

    &-right {
        order: 2;
    }

    img {
        width: 100%;
        height: auto;
        border-radius: 20px;
    }
}
</style>
