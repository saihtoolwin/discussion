<template>
    <Master class="scroll overflow-y-auto">
        <div
            class="mb-4 shadow-lg border h-auto"
            v-for="question in questions"
            :key="question.id"
        >
            <div
                class="text-white bg-black py-3 text-lg flex justify-between items-center"
            >
                <!-- fixed -->
                <div class="flex items-center gap-x-1.5 ml-2">
                    <span
                        v-if="question.is_fixed == 'false'"
                        class="inline-flex items-center bg-red-500 text-white gap-x-1.5 py-1.5 px-3 rounded text-xs font-medium border border-red-500"
                    >
                        Need Fixed!
                    </span>
                    <span
                        v-else
                        class="inline-flex w-24 justify-center items-center bg-green-500 text-white gap-x-1.5 py-1.5 px-3 rounded text-xs font-medium border border-green-500"
                    >
                        Success!
                    </span>
                    <span class="ml-5">{{ question.title }}</span>
                </div>
                <!-- fixed and delete -->
                <div
                    class="flex items-center gap-x-1.5 mr-2"
                    v-show="question.user_id == page.props.auth.user.id"
                >
                    <span
                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded text-xs font-medium bg-yellow-500 text-white"
                    >
                        Fixed
                    </span>
                    <span
                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded text-xs font-medium bg-red-500 text-white"
                    >
                        Delete
                    </span>
                </div>
            </div>
            <div class="px-6 pt-4 text-bold">
                {{ question.description }}
            </div>
            <!-- like box -->
            <div class="px-2 p-2 mt-3 border flex">
                <svg
                    @click="like(question.id, question.is_like)"
                    :class="{ 'fill-red-600': question.is_like === 'true' }"
                    class="size-6 text-red-600"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                </svg>
                <span class="ml-1">{{ question.like_count }}</span>
                &nbsp; &nbsp;
                <svg
                    class="size-6 text-green-500"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"
                    />
                </svg>
                <span class="ml-1">{{ question.comment.length }}</span>
                &nbsp; &nbsp;
                <svg
                    class="size-6 text-primary"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"
                    />
                </svg>
                <div class="ml-20">
                    <span
                        v-for="tag in question.tag"
                        :key="tag.id"
                        class="ml-3 inline-flex items-center gap-x-1.5 py-1 px-3 rounded text-xs font-medium bg-gray-500 text-white"
                        >{{ tag.name }}</span
                    >
                </div>
                <Link as="button"
                    :href="route('question.index', { slug: question.slug })"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded ml-auto"
                >
                    View
                </Link>
            </div>
        </div>
    </Master>
</template>

<script setup>
// import Sidebar from "./components/Sidebar.vue";
import Master from "./Layout/Master.vue";
import { defineProps, ref } from "vue";
import { router, usePage, Link } from "@inertiajs/vue3";
const page = usePage();
const red = ref(false);
// Define props
const props = defineProps({
    questions: Array,
});

const like = (id, is_like) => {
    if (is_like == "false") {
        router.post(
            route("like.store", { question_id: id }),
            {},
            {
                onSuccess: () => {
                    console.log("it is success");
                    red.value = true;
                },
                preserveScroll: true,
            }
        );
    } else {
        console.log(id);
        router.delete(
            route("like.destroy", { like: id }),
            
            {
                onSuccess: () => {
                    console.log("It is delete");
                },
                onError: (error) => {
                    console.error("Error deleting like:", error);
                },
                preserveScroll: true,
            }
        );
    }
};
</script>

<style>
body::-webkit-scrollbar {
 display: none !important;
}
</style>
