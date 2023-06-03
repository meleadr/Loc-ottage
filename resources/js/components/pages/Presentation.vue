<template>
    <!-- SECTION CHALET -->
    <section>
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
