<template>
    <div class="info">
        <h2>{{ name }}</h2>

        <p>{{ description }}</p>

        <CottageInfo
            area="{{ area }}"
            nbPersons="{{ nbPersons }}"
            nbBedrooms="{{ nbBedrooms }}"
            price="{{ price }}"
        />

        <div class="button_container">
            <a class="button" href="#">
                Voir plus
            </a>
        </div>
    </div>
    <div class="image">
        <img src="{{ image_url }}" alt="">
    </div>
</template>

<script setup>
    import CottageInfo from "./CottageInfo.vue";
    const props = defineProps({
        id:{
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
        nbBedrooms: {
            type: Number,
            required: true,
        },
        nbPersons: {
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
</script>

<style scoped lang="scss">
    @use "@sass/_variables" as *;

    .table_info {
        margin: 2rem 0;
        width: 100%;
        border-radius: 20px;
        border-collapse: collapse;
        text-align: center;
        background-color: grey;

        th, td {
            padding: 1rem;
        }

        .icon {
            font-size: 2rem;
        }
    }
</style>