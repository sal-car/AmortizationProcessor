<template>
  <div class="flex gap-2 self-start">
    <label class="font-semibold" for="sort">Sort by</label>
    <select
      value="selected"
      @change="onSelectChange($event)"
      class="bg-transparent rounded-xs outline-none pr-1"
      name="sort"
    >
      <option value="earliest-date">Earliest Date</option>
      <option value="state-pending">Status (Pending)</option>
      <option value="state-paid">Status (Paid)</option>
    </select>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from "vue";

defineProps({ onSelectChange: { type: Function, required: true } });
</script>
