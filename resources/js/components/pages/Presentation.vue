<template></template>

<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
const chalet = route.params.chalet;
const startDate = route.params.startDate;
const endDate = route.params.endDate;
const totalPrice = route.params.totalPrice;
</script>
