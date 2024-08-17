<template>
    <div class="w-3/5 rounded h-full overflow-hidden shadow-lg">
        <Link :href="route('question.create')" class="text-white bg-primary py-4 text-xl flex justify-center">
            Ask New Question
        </Link>
        <div class="px-6 py-2 border">
            <div class="font-bold text-xl mb-2">All Tags</div>
        </div>
        <!-- <div class="px-6 pt-4" v-for="tag in tags" :key="tag.id">
                <ul class="list-outside border pl-4 py-3">
                    <li>{{ tag.name }}</li>
                </ul>
                
            </div> -->
        <div class="px-6 py-4">
            <ul
                class="list-outside border pl-4 py-3"
                v-for="tag in tags"
                :key="tag.id"
            >
                <li>{{ tag.name }}</li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { usePage,Link } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();
const tags = computed(() => page.props.tags);
</script>

<style lang="scss" scoped></style>
