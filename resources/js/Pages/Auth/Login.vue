<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Loading from "@/Pages/components/Loading.vue"
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
// const toast = useToast();
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onSuccess: () =>
        {
            form.reset('password')
            toast.success('Welcome Back!');
        } ,
        onError:()=>{
            toast.error('Something went wrong')
        }
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="">
            <h3 class="text-3xl  font-bold text-primary">WelComeBack!</h3>
        </div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-5">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    placeholder="Please enter your email"
                    required
                    autofocus
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
                    placeholder="Please enter your password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link> -->
                <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Register
                </Link>
                <PrimaryButton class="ms-4 bg-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <Loading v-if="form.processing"></Loading>
                    <p>Login</p>
                </PrimaryButton>
                
            </div>
        </form>
    </GuestLayout>
</template>
