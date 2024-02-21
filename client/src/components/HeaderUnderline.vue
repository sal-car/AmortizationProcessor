<template>
  <div class="relative z-20 w-fit">
    <h1 class="header-text z-10 relative font-extrabold text-3xl text-left">
      {{ title }}
    </h1>
    <span class="green-underline-bar"></span>
  </div>
</template>
<script setup="ts">
import { defineProps } from "vue";

defineProps({ title: String });
</script>
