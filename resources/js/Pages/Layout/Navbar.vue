<template>
        <div class="bg-primary text-white">
            <nav
                class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center"
            >
                <div class="flex items-center justify-between">
                    <Link
                        href="/"
                        class="text-xl font-bold text-white md:text-2xl hover:text-blue-400"
                        >Discussion
                    </Link>
                    <!-- Mobile menu button -->
                    <div @click="showMenu = !showMenu" class="flex md:hidden">
                        <button
                            type="button"
                            class=" hover:text-gray-400 focus:outline-none focus:text-gray-400"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                class="w-6 h-6 fill-current"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <ul
                    :class="showMenu ? 'flex' : 'hidden'"
                    class=" mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-12 md:mt-0"
                >
                    <li
                        class="text-sm font-bold  hover:text-black md:mr-8"
                    >
                        <Link href="/">All Questions</Link>
                    </li>
                    <!-- <li
                        class="text-sm font-bold  hover:text-black md:mr-8"
                    >
                        All Questions
                    </li> -->
                    <li
                        class="text-sm font-bold  hover:text-black md:mr-8"
                    >
                        Answered Questions
                    </li>
                    <li
                        class="text-sm font-bold  hover:text-black md:mr-8"
                    >
                        Unanswered Questions
                    </li>
                    <li
                        class="text-sm font-bold  hover:text-black md:mr-8"
                        @click="toggleDropdown"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                        </svg>
                        <div
                            v-if="showDropdown"
                            ref="target"
                            class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                        >
                            <div class="py-1 rounded-md shadow-xs">
                                <Link
                                    :href="route('profile.edit')"
                                    class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                    role="menuitem"
                                    >Your Profile</Link
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                    role="menuitem"
                                    >Settings</a
                                >
                                <Link
                                    method="post"
                                    :href="route('logout')"
                                    class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                    role="menuitem"
                                >
                                    Sign out
                                </Link>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
</template>
<script>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";

export default {
    setup() {
        const showMenu = ref(false);
        const showDropdown = ref(false);
        const target = ref(null);

        const toggleDropdown = () => {
            showDropdown.value = !showDropdown.value;
        };

        onClickOutside(target, () => {
            showDropdown.value = false;
        });

        return {
            showMenu,
            showDropdown,
            toggleDropdown,
            target,
        };
    },
    components: {
    Link,
  },
};
</script>
