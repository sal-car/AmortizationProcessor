<template>
  <div class="flex flex-col items-center gap-5 self-center w-[100%]">
    <SortingOptions :onSelectChange="onSelectChange" />
    <AmortizationPages :list="sortedAmortizations" :pageSize="12" />
  </div>
</template>

<script setup lang="ts">
import { defineProps, ref } from "vue";
import { Amortization } from "../types";
import AmortizationPages from "./AmortizationPages.vue";
import SortingOptions from "./SortingOptions.vue";
import { sortByDate, sortByState } from "../utils/sortingHelpers";
import { amortizations } from "@/data";

defineProps<{ amortizations: Amortization[] }>();

const sortedAmortizations = ref<Amortization[]>(amortizations);

/* 
When user selects a sorting option in dropdown menu, the items will
be sorted by either date or state
*/
const onSelectChange = (event: Event) => {
  const target = event.currentTarget as HTMLSelectElement;
  const selectedValue = target.value;

  switch (selectedValue) {
    case "state-pending":
      sortedAmortizations.value = sortByState("pending", amortizations);
      break;

    case "state-paid":
      sortedAmortizations.value = sortByState("paid", amortizations);
      break;

    case "earliest-date":
      sortedAmortizations.value = sortByDate("earliest", amortizations);
      break;

    default:
      sortedAmortizations.value = amortizations;
      break;
  }
};
</script>
