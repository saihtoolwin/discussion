<template>
    <Master class="scroll overflow-y-auto">
        <Pagination :links="links" v-if="links.length > 4 && page.component =='Home' "></Pagination>
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
                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded text-xs font-medium bg-yellow-500 text-white cursor-pointer"
                       :class="{ 'hidden': question.is_fixed == 'true' }"
                        @click="fix(question.id)"
                    >
                        Fixed
                    </span>
                    <span
                     @click="openModal(question.id)"
                     class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded text-xs font-medium bg-red-500 text-white cursor-pointer"                    >
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
                <span class="ml-1">{{ question.comment.length }} </span>
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
        <DeleteModel :show="model" :id="selectedId" @close="model = false">
            <div class="flex flex-col items-center justify-center text-center">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="red"
                    class="mx-auto mt-5"
                    width="100px"
                >
                    <path
                        fill-rule="evenodd"
                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                        clip-rule="evenodd"
                    />
                </svg>
                <p class="text-2xl font-medium text-black my-5">
                    Delete Question
                </p>
                <p class="text-xl font-medium text-black mb-4">
                    Are you sure you would like to do this ?
                </p>
            </div>
        </DeleteModel>
    </Master>
</template>

<script setup>
// import Sidebar from "./components/Sidebar.vue";
import Master from "./Layout/Master.vue";
import { computed, defineProps, ref } from "vue";
import { router, usePage, Link } from "@inertiajs/vue3";
import DeleteModel from "@/Pages/components/DeleteModel.vue";
import Pagination from "./components/Pagination.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
const page = usePage();
const red = ref(false);
const model = ref(false);
const selectedId = ref(null);
const openModal = (id) => {
    selectedId.value=id;
    model.value = true;
};
const props = defineProps({
    questions: Object,
});
const questions =computed(()=> props.questions.data);
const links = props.questions.links;
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

const fix=(id)=>{
    router.post(route('question.update',{id:id}),{},{
        onSuccess:()=>{
            toast.success('Question updated successfully!');
        }
    })
}
</script>

<style>
body::-webkit-scrollbar {
 display: none !important;
}
</style>
