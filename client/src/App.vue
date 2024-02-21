<template>
  <div class="pt-10 px-10 gap-6 flex flex-col">
    <HeaderUnderline :title="title" />
    <AmortizationList :amortizations="amortizations" />
  </div>
</template>

<script setup lang="ts">
import { amortizations } from "./data";
import AmortizationList from "./components/AmortizationList.vue";
import HeaderUnderline from "./components/HeaderUnderline.vue";
const title = "Scheduled Amortizations";
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background-color: #ebf7f1;
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}
</style>
