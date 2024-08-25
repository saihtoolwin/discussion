<template>
    <!-- Pagination -->
<nav class="flex items-center text-black  gap-x-1 mb-5  justify-center" aria-label="Pagination">
  
  <div class="flex items-center gap-x-1" v-for="(l,index) in links" :key="index"> 
    <Link :href="l.url" class="border min-h-[38px] min-w-[38px] flex justify-center items-center bg-gray-200 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none  dark:focus:bg-neutral-500" aria-current="page"
    :class="{
        'dark:bg-primary text-white' : l.active,
    }"
    >
    <span v-html="l.label"></span>
    </Link>
  </div>
  
</nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from "vue";
const props=defineProps({
    links:Array,
})
const links = props.links;
</script>

<style scoped>

</style>