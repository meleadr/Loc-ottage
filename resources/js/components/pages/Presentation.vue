<template>
    <section>
        <!-- Affichage des cottages -->
        <ul>
            <li v-for="cottage in cottages" :key="cottage.id">
                {{ cottage.name }}
            </li>
        </ul>

        <div class="cottage_right">
            <div class="info">
                <h2>Chalet Familial</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab
                    delectus natus cum quod? Soluta impedit, aliquam odio
                    facilis aperiam sapiente quasi doloribus amet obcaecati
                    totam dolorem laborum rem eveniet inventore? Nam laborum
                    delectus ullam rem velit? Ab nam illum dolorum iste minus
                    dolorem optio ipsa sapiente enim et. Provident, nobis totam.
                    Iste accusamus libero quam a mollitia quia nostrum saepe.
                    Alias iste rerum, facere sunt eaque laborum quis ex possimus
                    sit asperiores facilis consequuntur voluptates tempora magni
                    non assumenda maxime aut quo autem dolorem unde excepturi
                    laboriosam animi. Nobis, alias. Inventore consequuntur
                    suscipit tenetur sunt voluptas totam vel quaerat assumenda
                    at modi, earum deleniti, rerum laudantium necessitatibus,
                    aspernatur eveniet expedita distinctio explicabo nostrum
                    nisi? Dicta dignissimos veritatis odio? Quidem, et?
                </p>

                <CottageCard
                    surface="100m²"
                    nbPersonnes="4"
                    nbChambres="2"
                    prix="100€"
                />

                <div class="button_container">
                    <a class="button" href="#"> Voir plus </a>
                </div>
            </div>
            <div class="image">
                <img
                    src="/assets/images/cottage/familial_cottage.jpeg"
                    alt=""
                />
            </div>
        </div>

        <div class="cottage_left">
            <div class="image">
                <img src="/assets/images/cottage/love_cottage.jpeg" alt="" />
            </div>

            <div class="info">
                <h2>Chalet Familial</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab
                    delectus natus cum quod? Soluta impedit, aliquam odio
                    facilis aperiam sapiente quasi doloribus amet obcaecati
                    totam dolorem laborum rem eveniet inventore? Nam laborum
                    delectus ullam rem velit? Ab nam illum dolorum iste minus
                    dolorem optio ipsa sapiente enim et. Provident, nobis totam.
                    Iste accusamus libero quam a mollitia quia nostrum saepe.
                    Alias iste rerum, facere sunt eaque laborum quis ex possimus
                    sit asperiores facilis consequuntur voluptates tempora magni
                    non assumenda maxime aut quo autem dolorem unde excepturi
                    laboriosam animi. Nobis, alias. Inventore consequuntur
                    suscipit tenetur sunt voluptas totam vel quaerat assumenda
                    at modi, earum deleniti, rerum laudantium necessitatibus,
                    aspernatur eveniet expedita distinctio explicabo nostrum
                    nisi? Dicta dignissimos veritatis odio? Quidem, et?
                </p>

                <CottageCard
                    surface="100m²"
                    nbPersonnes="4"
                    nbChambres="2"
                    prix="100€"
                />

                <div class="button_container">
                    <a class="button" href="#"> Voir plus </a>
                </div>
            </div>
        </div>

        <div class="cottage_right">
            <div class="info">
                <h2>Chalet Familial</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab
                    delectus natus cum quod? Soluta impedit, aliquam odio
                    facilis aperiam sapiente quasi doloribus amet obcaecati
                    totam dolorem laborum rem eveniet inventore? Nam laborum
                    delectus ullam rem velit? Ab nam illum dolorum iste minus
                    dolorem optio ipsa sapiente enim et. Provident, nobis totam.
                    Iste accusamus libero quam a mollitia quia nostrum saepe.
                    Alias iste rerum, facere sunt eaque laborum quis ex possimus
                    sit asperiores facilis consequuntur voluptates tempora magni
                    non assumenda maxime aut quo autem dolorem unde excepturi
                    laboriosam animi. Nobis, alias. Inventore consequuntur
                    suscipit tenetur sunt voluptas totam vel quaerat assumenda
                    at modi, earum deleniti, rerum laudantium necessitatibus,
                    aspernatur eveniet expedita distinctio explicabo nostrum
                    nisi? Dicta dignissimos veritatis odio? Quidem, et?
                </p>

                <CottageCard
                    surface="100m²"
                    nbPersonnes="4"
                    nbChambres="2"
                    prix="100€"
                />

                <div class="button_container">
                    <a class="button" href="#"> Voir plus </a>
                </div>
            </div>
            <div class="image">
                <img src="/assets/images/cottage/classic_cottage.jpg" alt="" />
            </div>
        </div>
    </section>

    <section id="contact" class="container">
        <h1>Contactez-nous</h1>
        <div class="contact_container">
            <form>
                <input
                    name="email"
                    type="text"
                    placeholder="Email"
                    class="contact_input"
                    required
                />
                <input
                    name="objet"
                    type="text"
                    placeholder="Objet"
                    class="contact_input"
                    required
                />

                <textarea
                    name="texte"
                    cols="0"
                    rows="10"
                    placeholder="Message"
                    class="contact_input"
                    required
                ></textarea>

                <input type="submit" value="Envoyer" class="button" />
            </form>
        </div>
    </section>
</template>

<script setup>
import CottageCard from "../CottageCard.vue";
import axios from "axios";
import { ref, onMounted } from "vue";

const cottages = ref([]);

// Fonction pour récupérer les cottages de la base de données
const fetchCottages = async () => {
    // use axios to fetch data from the API
    const response = await axios.get("/api/cottages/getAllCottages");
    // set the value of the cottages variable to the data from the API
    cottages.value = response.data;
};

// Appel de la fonction fetchCottages lors du montage du composant
onMounted(fetchCottages);
</script>

<style scoped lang="scss">
@use "@sass/_variables" as *;

.cottage_right,
.cottage_left {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin: 2rem 0;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);

    .info {
        width: 50%;
        padding: 0 2rem;
        color: orange;

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

#contact {
    .contact_container {
        width: 75%;

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            .contact_input {
                width: 100%;
                margin: 1rem 0;
                padding: 1rem;
                border-radius: 1rem;
                border: none;
                box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);
            }
        }
    }
}
</style>
