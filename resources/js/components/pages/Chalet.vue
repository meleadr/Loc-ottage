<template>
    <div class="container">
        <div class="chalet">
            <div class="title">            
                <a href="/" class="button">Retour</a>
                <h1 class="chalet__title">{{ chalet.title }}</h1>
            </div>

            <div class="chalet__image">
                <img :src="chalet.image" :alt="chalet.title" />
            </div>

            <div class="chalet__info">
                <CottageInfo
                :area="chalet.size"
                :persons="chalet.persons"
                :bedrooms="chalet.bedrooms"
                :price="chalet.price"
                />

                <div class="chalet__description">
                    <p>{{ chalet.description }}</p>
                </div>
            </div>
        </div>

        <div class="reservation">
            <div class="reservation__calendar">
                <p><strong>Sélectionnez vos dates :</strong></p>

                <VueDatePicker
                    v-model="date"
                    range
                    min-range="1"
                    inline
                    auto-apply
                    :disabled-dates="disabledDates"
                    :enable-time-picker="false"
                    @update:model-value="handleDate"
                    >

                    <template #action-extra="{ selectCurrentDate }">
                        <span @click="selectCurrentDate()" title="Sélectionner la date actuelle">
                        <img class="calendar-icon" src="/assets/images/calendar.png" />
                        </span>
                    </template>
                </VueDatePicker>
            </div>

            <div class="reservation__book">
                <p class="error" v-show="error">{{ error }}</p>
                <p class="reservation__price" v-show="totalPrice != 0">
                <strong>Prix total :</strong> {{ totalPrice }} €
                </p>
                <div class="button" @click="goReservation()">Réserver</div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, reactive } from "vue";
import { useRouter } from "vue-router";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

// Import des composants
import CottageInfo from "../CottageInfo.vue";

const router = useRouter();

const disabledDates = computed(() => {
  const today = new Date();
  const tomorrow = new Date(today);
  tomorrow.setDate(tomorrow.getDate() + 1);
  const afterTomorrow = new Date(tomorrow);
  afterTomorrow.setDate(tomorrow.getDate() + 1);

  return [tomorrow, afterTomorrow];
});

const chalet = ref({
  title: "Chalet Cosy",
  size: 100,
  persons: 4,
  bedrooms: 2,
  price: 150,
  description: "Un charmant chalet situé dans un environnement paisible et serein...",
  image: "/assets/images/cottage/classic_cottage.jpg"
});

const error = ref(null);

const date = reactive({ start: null, end: null });

const handleDate = (modelData) => {
  date.start = modelData[0];
  date.end = modelData[1];
};

const totalPrice = computed(() => {
  if (date.start && date.end) {
    const diffTime = Math.abs(date.end - date.start);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // calculate the difference in days
    error.value = null;
    return diffDays * chalet.value.price;
  } else {
    error.value = "Veuillez sélectionner une date.";
  }
  return 0;
});

const goReservation = () => {
  if (date.start && date.end) {
    router.push({
      name: "Reservation",
      query: {
        chalet: chalet.value.title,
        startDate: date.start,
        endDate: date.end,
        totalPrice: totalPrice.value
      }
    });
  }
};
</script>
<style scoped lang="scss">
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.chalet {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 50%;
  background-color: #fff;
  padding: 2rem;
  border-radius: 0.5rem;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

  .title {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    margin-bottom: 2rem;
    gap: 1rem;
  }

  &__title {
    color: #555;
    margin-bottom: 1rem;
    font-size: 1.5rem;
  }

  &__image {
    width: 100%;
    margin-bottom: 1rem;

    img {
      width: 100%;
      border-radius: 0.5rem;
    }
  }

  &__info {
    margin-bottom: 2rem;
  }

  &__description {
    color: #777;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-top: 2rem;
  }
}

.reservation {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 50%;

  &__calendar {
    margin-top: 2rem;
    text-align: center;
  }

  &__book {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-top: 2rem;

    &__price {
      font-size: 1.2rem;
      color: #428bca;
      margin-bottom: 1rem;
    }
  }
}

.slot-icon {
  height: 40px;
  width: auto;
  cursor: pointer;
}

.error {
  color: #ff0000;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

.calendar-icon {
  height: 40px;
  width: auto;
  cursor: pointer;
}
</style>