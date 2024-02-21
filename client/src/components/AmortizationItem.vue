<template>
  <div
    class="bg-white h-30 rounded-md shadow-md p-4 pb-4 flex flex-col items-center justify-between"
  >
    <div class="w-full flex justify-between items-start">
      <h4
        class="font-semibold text-sm"
        :class="{
          'text-green-400/90': item.state === 'paid',
          'text-yellow-400/90': item.state !== 'paid',
        }"
      >
        {{ item.state.toUpperCase() }}
      </h4>
    </div>
    <h3 class="font-semibold text-2xl">${{ item.amount }}</h3>
    <div class="flex w-full justify-end">
      <p class="text-sm text-blue-950/50 font-light">
        {{ new Date(item.schedule_date).toLocaleDateString() }}
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import { Amortization } from "../types";

defineProps<{ item: Amortization }>();
</script>
