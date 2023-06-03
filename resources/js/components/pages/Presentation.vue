<template>
    <section id="cottages">
        <div class="cottage_right">
            <div class="info">
                <h2>Chalet Famililial</h2>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab delectus natus cum quod? Soluta impedit, aliquam odio facilis aperiam sapiente quasi doloribus amet obcaecati totam dolorem laborum rem eveniet inventore?
                Nam laborum delectus ullam rem velit? Ab nam illum dolorum iste minus dolorem optio ipsa sapiente enim et. Provident, nobis totam. Iste accusamus libero quam a mollitia quia nostrum saepe.
                Alias iste rerum, facere sunt eaque laborum quis ex possimus sit asperiores facilis consequuntur voluptates tempora magni non assumenda maxime aut quo autem dolorem unde excepturi laboriosam animi. Nobis, alias.
                Inventore consequuntur suscipit tenetur sunt voluptas totam vel quaerat assumenda at modi, earum deleniti, rerum laudantium necessitatibus, aspernatur eveniet expedita distinctio explicabo nostrum nisi? Dicta dignissimos veritatis odio? Quidem, et?</p>

                <div class="features">
                    <table class="table_info">
                        <tr>
                            <th>Surface</th>
                            <th>Nombre de personnes</th>
                            <th>Nombre de chambres</th>
                            <th>Prix</th>
                        </tr>

                        <tr>
                            <td>100m²</td>
                            <td>4</td>
                            <td>2</td>
                            <td>100€</td>
                        </tr>
                    </table>
                </div>

                <div class="button_container">
                    <a class="button" href="#">
                        Voir plus
                    </a>
                </div>
            </div>
            <div class="image">
                    <img src="../../../../public/assets/images/cottage/cottage1.jpeg" alt="">
            </div>
        </div>

        <div class="cottage_left">
            <div class="image">
                <img src="../../../../public/assets/images/cottage/cottage1.jpeg" alt="">
            </div>

            <div class="info">
                <h2>Chalet Famililial</h2>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab delectus natus cum quod? Soluta impedit, aliquam odio facilis aperiam sapiente quasi doloribus amet obcaecati totam dolorem laborum rem eveniet inventore?
                Nam laborum delectus ullam rem velit? Ab nam illum dolorum iste minus dolorem optio ipsa sapiente enim et. Provident, nobis totam. Iste accusamus libero quam a mollitia quia nostrum saepe.
                Alias iste rerum, facere sunt eaque laborum quis ex possimus sit asperiores facilis consequuntur voluptates tempora magni non assumenda maxime aut quo autem dolorem unde excepturi laboriosam animi. Nobis, alias.
                Inventore consequuntur suscipit tenetur sunt voluptas totam vel quaerat assumenda at modi, earum deleniti, rerum laudantium necessitatibus, aspernatur eveniet expedita distinctio explicabo nostrum nisi? Dicta dignissimos veritatis odio? Quidem, et?</p>

                <div class="features">
                    <table class="table_info">
                        <tr>
                            <th>Surface</th>
                            <th>Nombre de personnes</th>
                            <th>Nombre de chambres</th>
                            <th>Prix</th>
                        </tr>

                        <tr>
                            <td>100m²</td>
                            <td>4</td>
                            <td>2</td>
                            <td>100€</td>
                        </tr>
                    </table>
                </div>

                <div class="button_container">
                    <a class="button" href="#">
                        Voir plus
                    </a>
                </div>
            </div>
        </div>

        <div class="cottage_right">
            <div class="info">
                <h2>Chalet Famililial</h2>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab delectus natus cum quod? Soluta impedit, aliquam odio facilis aperiam sapiente quasi doloribus amet obcaecati totam dolorem laborum rem eveniet inventore?
                Nam laborum delectus ullam rem velit? Ab nam illum dolorum iste minus dolorem optio ipsa sapiente enim et. Provident, nobis totam. Iste accusamus libero quam a mollitia quia nostrum saepe.
                Alias iste rerum, facere sunt eaque laborum quis ex possimus sit asperiores facilis consequuntur voluptates tempora magni non assumenda maxime aut quo autem dolorem unde excepturi laboriosam animi. Nobis, alias.
                Inventore consequuntur suscipit tenetur sunt voluptas totam vel quaerat assumenda at modi, earum deleniti, rerum laudantium necessitatibus, aspernatur eveniet expedita distinctio explicabo nostrum nisi? Dicta dignissimos veritatis odio? Quidem, et?</p>

                <div class="features">
                    <table class="table_info">
                        <tr>
                            <th>Surface</th>
                            <th>Nombre de personnes</th>
                            <th>Nombre de chambres</th>
                            <th>Prix</th>
                        </tr>

                        <tr>
                            <td>100m²</td>
                            <td>4</td>
                            <td>2</td>
                            <td>100€</td>
                        </tr>
                    </table>
                </div>

                <div class="button_container">
                    <a class="button" href="#">
                        Voir plus
                    </a>
                </div>
            </div>
            <div class="image">
                    <img src="../../../../public/assets/images/cottage/cottage1.jpeg" alt="">
            </div>
        </div>
    </section>

    <section id="contact" class="container">
        <h1>Contactez-nous</h1>
        <div class="contact_container">
            <form>
                <input name="email" type="text" placeholder="Email" class="contact_input" required>
                <input name="objet" type="text" placeholder="Objet" class="contact_input" required>
              

                <textarea name="texte" cols="0" rows="10" placeholder="Message" class="contact_input" required></textarea>

                <input type="submit" value="Envoyer" class="button">
            </form>
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

        .info {
            width: 50%;
            padding: 0 2rem;
            color: orange;

            .table_info {
                margin: 2rem 0;
                width: 100%;
                border-collapse: collapse;
                text-align: center;
                background-color: grey;

                th, td {
                    padding: 1rem;
                }
            }

            .button_container {
                margin: 2rem 0;
                text-align: center;
            }
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

    #contact{
        .contact_container{
            width: 75%;

            form{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

                .contact_input{
                    width: 100%;
                    margin: 1rem 0;
                    padding: 1rem;
                    border-radius: 1rem;
                    border: none;
                    box-shadow: 0 0 1rem rgba(0, 0, 0, .2);
                }
            }
        }

    }
</style>