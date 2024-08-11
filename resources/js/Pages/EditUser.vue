<template>
    <Master>
        <div class="border">
            <div class="text-white bg-primary py-4 text-xl">
                <div class="max-w-2xl mx-auto">Update Profile</div>
            </div>

            <div class="max-w-2xl px-1 py-1 mx-auto lg:py-4">
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="mb-4">
                        <FileUpload
                            mode="avatar"
                            name="image"
                            labelIdle="Choose or Drag Avatar here..."
                            :allowMultiple="false"
                            :imageCropAspectRatio="'1:1'"
                            :imagePreviewHeight="170"
                            :imageResizeTargetWidth="170"
                            :imageResizeTargetHeight="170"
                            :image="form.image"
                            @updateFile="handleFilePondUpdate"
                        ></FileUpload>
                        <div class="sm:col-span-2 mt-4">
                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                v-model="form.name"
                                autocomplete="name"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Please enter your name"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div class="sm:col-span-2 mt-4">
                            <label
                                for="email"
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                v-model="form.email"
                                autocomplete="email"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Please enter your email address"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>
                        <div class="sm:col-span-2 mt-4">
                            <label
                                for="old_password"
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Old Password
                            </label>
                            <input
                                type="password"
                                name="old_password"
                                id="old_password"
                                v-model="form.old_password"
                                autocomplete="current-password"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Please enter your old password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.old_password"
                            />
                        </div>
                        <div class="sm:col-span-2 mt-4">
                            <label
                                for="password"
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                New Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                v-model="form.password"
                                autocomplete="new-password"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Please enter your new password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>
                        <div class="sm:col-span-2 mt-4">
                            <label
                                for="confirm_password"
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                autocomplete="new-password"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Please confirm your new password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password_confirmation"
                            />
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button
                            type="submit"
                            class="text-white bg-primary hover:bg-primary-800 rounded-lg text-sm px-5 py-2.5 text-center"
                        >
                            Update
                        </button>
                        <button
                            type="button"
                            @click="goBack"
                            class="text-white bg-gray-500 border rounded-lg hover:bg-gray-600 text-sm px-5 py-2.5 text-center"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Master>
</template>
<script setup>
// import { ref } from 'vue';
import { usePage, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Master from "./Layout/Master.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import InputError from "@/Components/InputError.vue";
import FileUpload from "@/Pages/components/FileUpload.vue";
// const page = usePage();
const user = ref(usePage().props.auth?.user);
const handleFilePondUpdate = (file) => {
    if (file) {
        form.image = file; // Use the file object directly
    } else {
        form.image = "storage/images/defaultuser.jpg";
    }
};
const form = useForm({
    name: user.value.name,
    email: user.value.email,
    image: user.value.url_storage,
    old_password: "",
    password: "",
    password_confirmation: "",
});

const goBack = () => {
    window.history.back();
};

const submit = () => {
    form.post(route("profile.update"), {
        onSuccess: () => {
            toast.success("Profile Update Success!");
            form.old_password = "";
            form.password = "";
            form.password_confirmation = "";
        },
        onError: () => {
            toast.error("Error updating profile");
            console.log(form.errors);
        },
        preserveScroll: true,
    });
};
</script>

<style lang="scss" scoped></style>
