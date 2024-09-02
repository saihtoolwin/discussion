<template>
    <div class="w-3/5 rounded h-full overflow-hidden shadow-lg">
        <Link
            :href="route('question.create')"
            class="text-white bg-primary py-4 text-xl flex justify-center"
        >
            Ask New Question
        </Link>
        <div class="px-6 py-2 border" v-if="!editPage">
            <Link :href="route('home.index')">
                <div class="font-bold text-xl mb-2">All Tags</div>
            </Link>
        </div>
        <div class="px-6 py-4" v-if="!editPage">
            <ul
                class="list-outside border pl-4 py-3"
                v-for="tag in tags"
                :key="tag.id"
            >
                <Link :href="'/?tag=' + tag.slug"
                    ><li>{{ tag.name }}</li></Link
                >
            </ul>
        </div>
        <div class="px-6 py-4 font-semibold" v-if="editPage">
            <Link :href="route('profile.edit')">
                <ul
                    class="list-outside border pl-4 py-3 flex"
                    :class="{
                        'text-yellow-400': page.component === 'EditUser',
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 mr-2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />
                    </svg>

                    <li>Edit Profile</li>
                </ul>
            </Link>
            <Link :href="route('question.user')">
                <ul
                    class="list-outside border pl-4 py-3 flex"
                    :class="{
                        'text-yellow-400': page.component === 'UserQuestion',
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 mr-2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"
                        />
                    </svg>
                    <li>Your Questions</li>
                </ul>
            </Link>
            <Link :href="route('question.show')">
                <ul
                    class="list-outside border pl-4 py-3 flex"
                    :class="{
                        'text-yellow-400': page.component === 'SaveQuestion',
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 mr-2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"
                        />
                    </svg>

                    <li>Save Questions</li>
                </ul>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();
const tags = computed(() => page.props.tags);
const editPage = computed(() => {
    return page.component === "EditUser" || page.component === "UserQuestion" || page.component==="SaveQuestion";
});
</script>

<style lang="scss" scoped></style>
