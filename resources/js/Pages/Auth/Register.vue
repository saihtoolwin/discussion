<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Loading from "@/Pages/components/Loading.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import FileUpload from "@/Pages/components/FileUpload.vue";
const handleFilePondUpdate = (file) => {
    console.log(file)
    if (file) {
        form.image = file;
    }
};
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    image: "",
});

const submit = () => {
    form.post(route("register"), {
        onSuccess: () => {
            form.reset("password", "password_confirmation"),
                toast.success(`Hi! ${form.name} Welcome to Discussion`);
        },
        onError:()=>{
            toast.error("Something went wrong");
        }
    });
};

const loginWithGoogle= ()=>{
    window.location.href = '/google/redirect';
}
</script>

<template>
    <GuestLayout class="font-lora">
        <Head title="Register" />

        <div class="">
            <h3 class="text-3xl font-bold text-primary">Discussion</h3>
        </div>
        <form
            @submit.prevent="submit"
            enctype="multipart/form-data"
            class="mt-5"
        >
            <FileUpload
                mode="avatar"
                name="image"
                labelIdle="Choose or Drag Avatar here..."
                :allowMultiple="false"
                :accepted-file-types="'image/jpg, image/png, image/jpeg'"
                :imageCropAspectRatio="'1:1'"
                :imagePreviewHeight="170"
                :imageResizeTargetWidth="170"
                :imageResizeTargetHeight="170"
                @updateFile="handleFilePondUpdate"
            ></FileUpload>
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    placeholder="Please enter Name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    placeholder="Please enter your email address"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    placeholder="Please enter your password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Please enter confirmation password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md"
                >
                    Already have an account?
                </Link>

                <PrimaryButton
                    class="ms-4 bg-primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    <Loading v-if="form.processing"></Loading>
                    Register
                </PrimaryButton>
            </div>
        </form>
        <hr class="mt-8">
            <button
                @click="loginWithGoogle"
                type="button"
                class="w-full my-10 py-[16.2px] px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md bg-white text-darkGray hover:bg-gray-50 border border-gray-200 shadow-sm disabled:opacity-50 disabled:pointer-events-none transition-all"
            >
                <svg
                    class="w-5 h-auto"
                    width="46"
                    height="47"
                    viewBox="0 0 46 47"
                    fill="none"
                >
                    <path
                        d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z"
                        fill="#4285F4"
                    />
                    <path
                        d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z"
                        fill="#34A853"
                    />
                    <path
                        d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z"
                        fill="#FBBC05"
                    />
                    <path
                        d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z"
                        fill="#EB4335"
                    />
                </svg>
                Google
            </button>
           
    </GuestLayout>
</template>
