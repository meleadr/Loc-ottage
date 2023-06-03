<template>
    <div class="card_info">
        <div class="features">
            <table class="table_info">
                <tr>
                    <th><i class='bx bx-area icon'></i></th>
                    <th><i class='bx bx-user icon'></i></th>
                    <th><i class='bx bx-bed icon' ></i></th>
                    <th><i class='bx bx-purchase-tag-alt icon' ></i></th>
                </tr>

                <tr>
                    <td>{{ surface }}</td>
                    <td>{{ nbPersonnes }}</td>
                    <td>{{ nbChambres }}</td>
                    <td>{{ prix }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        surface: {
            type: Number,
            required: true,
        },
        nbPersonnes: {
            type: Number,
            required: true,
        },
        nbChambres: {
            type: Number,
            required: true,
        },
        prix: {
            type: Number,
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