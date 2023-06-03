<template>
    <!-- SECTION PRESENTATION -->
    <section class="presentation hero full-screen">
        <div class="">
            <h1>Loc'ottage</h1>
            <p>
                Bienvenue sur Loc'ottage ! Nous sommes ravis de vous accueillir dans notre univers chaleureux et enchanteur. 
                Que vous soyez en quête d'une escapade romantique, d'une réunion familiale ou d'une aventure en plein air, 
                notre sélection de chalets uniques saura combler toutes vos attentes.
            </p>
            <a class="button" href="#cottage">Voir nos chalets</a>
        </div>
    </section>

    <!-- SECTION CHALET -->
    <section id="cottage">
        <CottageCard 
            v-for="cottage in cottages" 
            :key="cottage.id"
            :id="cottage.id"
            :name="cottage.name"
            :area="cottage.area"
            :bedrooms="cottage.bedrooms"
            :persons="cottage.persons"
            :description="cottage.description"
            :price="cottage.price"
            :image_url="cottage.image_url"
        />
    </section>

    <!-- SECTION CONTACT -->
    <section class="contact container">
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
    import axios from "axios";
    import { ref, onMounted } from "vue";

    // Import des composants
    import CottageCard from "../CottageCard.vue";

    // Déclaration des variables
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
    .hero {
        background-image: url(/assets/images/hero.jpeg);
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
        position: relative;
        z-index: 2;
    }

    .hero::after {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: -1;
    }

    .presentation.full-screen {
        height: 100vh;
    }

    .presentation {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 2rem;
        height: 50vh;

        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        a {
            margin-top: 2rem;
            font-size: 1.5rem;
            padding: 1rem 2rem;
            border-radius: 1rem;
            border: 2px solid white;
            transition: all 0.3s ease-in-out;
        }
    }
    
    .contact {
        text-align: center;
        .contact_container {
            width: 75%;
            margin: 0 auto;

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
