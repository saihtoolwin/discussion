<template>
    <Master>
        <div
            v-for="question in save_quesitons"
            :key="question.id"
            class="bg-white shadow-lg w-full flex justify-between mx-auto rounded-lg border text-black py-5 pl-3 pr-5"
        >
            <h3 class="ml-5">{{ question.questions.title }}</h3>
            <div class="flex gap-5">
                <Link
                :href="
                    route('question.index', { slug: question.questions.slug })
                "
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6 hover:text-primary"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                </svg>
            </Link>
            <!-- <p></p> -->
                <svg @click="unSave(question.question_id)"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6 hover:text-rose-600 hover:cursor-pointer"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                    />
                </svg>
            </div>
        </div>
    </Master>
</template>

<script setup>
import { computed } from "vue";
import Master from "./Layout/Master.vue";

import { usePage, Link, router } from "@inertiajs/vue3";
const page = usePage();
const save_quesitons=computed(()=>page.props.questions);
const unSave=(id)=>{
    router.delete(route('question.unsave',{id:id}))
}
</script>

<style lang="scss" scoped></style>
