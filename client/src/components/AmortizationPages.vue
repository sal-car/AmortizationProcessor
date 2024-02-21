<template>
  <div class="flex flex-col w-full gap-6">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 w-full">
      <template v-for="(item, index) in paginatedList" :key="index">
        <li>
          <AmortizationItem :item="item" />
        </li>
      </template>
    </ul>
    <div class="flex gap-5 self-center">
      <button
        class="font-semibold"
        @click="prevPage"
        :disabled="currentPage === 1"
      >
        Previous
      </button>
      <span>{{ currentPage }} / {{ totalPages }}</span>
      <button
        class="font-semibold"
        @click="nextPage"
        :disabled="currentPage === totalPages"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import AmortizationItem from "./AmortizationItem.vue";
import { defineProps } from "vue";
import { Amortization } from "../types";

const props = defineProps<{ list: Amortization[]; pageSize: number }>();

// Hold a reference to the currently displayed page
const currentPage = ref(1);

// Calculate the total amount of pages needed
const totalPages = computed(() =>
  Math.ceil(props.list.length / props.pageSize)
);

// Slice the list so that we only display the requested page size
// this will recompute whenever currentPage is updated
const paginatedList = computed(() => {
  const startIndex = (currentPage.value - 1) * props.pageSize;
  const endIndex = startIndex + props.pageSize;
  return props.list.slice(startIndex, endIndex);
});

// Go to the next page by updating the currentPage reference
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

// Go to the previous page by updating the currentPage reference
const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};
</script>
