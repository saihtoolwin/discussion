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
    </GuestLayout>
</template>
