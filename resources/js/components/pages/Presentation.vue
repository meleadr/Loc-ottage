<template>
    <section>
        <div class="cottage_right">
            <div class="description">
                <h2>Présentation</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab delectus natus cum quod? Soluta impedit, aliquam odio facilis aperiam sapiente quasi doloribus amet obcaecati totam dolorem laborum rem eveniet inventore?
                Nam laborum delectus ullam rem velit? Ab nam illum dolorum iste minus dolorem optio ipsa sapiente enim et. Provident, nobis totam. Iste accusamus libero quam a mollitia quia nostrum saepe.
                Alias iste rerum, facere sunt eaque laborum quis ex possimus sit asperiores facilis consequuntur voluptates tempora magni non assumenda maxime aut quo autem dolorem unde excepturi laboriosam animi. Nobis, alias.
                Inventore consequuntur suscipit tenetur sunt voluptas totam vel quaerat assumenda at modi, earum deleniti, rerum laudantium necessitatibus, aspernatur eveniet expedita distinctio explicabo nostrum nisi? Dicta dignissimos veritatis odio? Quidem, et?</p>
            </div>
            <div class="image">
                    <img src="https://picsum.photos/800/400" alt="">
            </div>
        </div>

        <div class="cottage_left">
            <div class="image">
                    <img src="https://picsum.photos/800/400" alt="">
            </div>
            <div class="description">
                <h2>Présentation</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab delectus natus cum quod? Soluta impedit, aliquam odio facilis aperiam sapiente quasi doloribus amet obcaecati totam dolorem laborum rem eveniet inventore?
                Nam laborum delectus ullam rem velit? Ab nam illum dolorum iste minus dolorem optio ipsa sapiente enim et. Provident, nobis totam. Iste accusamus libero quam a mollitia quia nostrum saepe.
                Alias iste rerum, facere sunt eaque laborum quis ex possimus sit asperiores facilis consequuntur voluptates tempora magni non assumenda maxime aut quo autem dolorem unde excepturi laboriosam animi. Nobis, alias.
                Inventore consequuntur suscipit tenetur sunt voluptas totam vel quaerat assumenda at modi, earum deleniti, rerum laudantium necessitatibus, aspernatur eveniet expedita distinctio explicabo nostrum nisi? Dicta dignissimos veritatis odio? Quidem, et?</p>
            </div>
            
        </div>

        <div class="cottage_right">
            <div class="description">
                <h2>Présentation</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab delectus natus cum quod? Soluta impedit, aliquam odio facilis aperiam sapiente quasi doloribus amet obcaecati totam dolorem laborum rem eveniet inventore?
                Nam laborum delectus ullam rem velit? Ab nam illum dolorum iste minus dolorem optio ipsa sapiente enim et. Provident, nobis totam. Iste accusamus libero quam a mollitia quia nostrum saepe.
                Alias iste rerum, facere sunt eaque laborum quis ex possimus sit asperiores facilis consequuntur voluptates tempora magni non assumenda maxime aut quo autem dolorem unde excepturi laboriosam animi. Nobis, alias.
                Inventore consequuntur suscipit tenetur sunt voluptas totam vel quaerat assumenda at modi, earum deleniti, rerum laudantium necessitatibus, aspernatur eveniet expedita distinctio explicabo nostrum nisi? Dicta dignissimos veritatis odio? Quidem, et?</p>
            </div>

            <div class="image">
                    <img src="https://picsum.photos/800/400" alt="">
            </div>
        </div>
    </section>
</template>

<style scoped lang="scss">
    @use "@sass/_variables" as *;

    .cottage_right, .cottage_left {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin: 2rem 0;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 0 1rem rgba(0, 0, 0, .2);

        .description {
            width: 50%;
            padding: 0 2rem;
        }

        .image {
            width: 50%;
            padding: 0 2rem;

            img {
                width: 100%;
                height: auto;
            }
        }
    }
</style>