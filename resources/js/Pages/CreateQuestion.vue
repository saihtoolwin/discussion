<template>
    <Master>
        <div class="w-full bg-white border-2 rounded-md h-auto px-9 py-6">
            <form @submit.prevent="submit" method="post">
                <div class="my-5">
                    <!-- <InputLabel for="title" :class="text-6xl" value="Title"/> -->
                    <label class="text-lg">Title</label>
                    <TextInput
                        id="title"
                        type="text"
                        v-model="form.title"
                        class="mt-1 block w-full"
                        placeholder="Please enter title"
                        required
                        autocomplete="name"
                    />
                    <InputError class="mt-2" />
                </div>
                <div class="my-8 flex justify-around">
                    <div v-for="tag in props.tags" :key="tag.id">
                        <input
                            type="checkbox"
                            v-model="form.tags"
                            class="focus:outline-none focus:ring-0"
                            :id=tag.id
                            :value=tag.id 
                        />

                        <label :for="tag.id"> {{ tag.name }} </label>
                    </div>
                   
                </div>
                <div class="my-5">
                    <!-- <InputLabel for="title" :class="text-6xl" value="Title"/> -->
                    <label class="text-lg">Question</label>
                    <textarea v-model="form.question" rows="15"
                        class="resize rounded-md border-gray-300 mt-1 block w-full focus:to-blue-500"
                        placeholder="Please enter title"
                        required
                    />
                    <InputError class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <button
                        class="w-20 h-8 bg-gray-500 rounded-sm hover:bg-gray-700 text-white mx-3"
                    >
                        Cancel
                    </button>
                    <button
                        class="w-20 h-8 bg-black rounded-sm hover:bg-primary text-white"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        <Loading v-if="form.processing"></Loading>
                        Ask
                    </button>
                </div>
            </form>
        </div>
    </Master>
</template>

<script setup>
import Master from "./Layout/Master.vue";
import InputError from "@/Components/InputError.vue";
// import InputLabel from "@/Components/InputLabel.vue";
import Loading from "@/Pages/components/Loading.vue";
// import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    tags: Object,
});
console.log(props.tags);
const form = useForm({
    title : '',
    tags:[],
    question:'',
})
const submit = () =>{
    form.post(route('question.store'),{
        onSuccess:()=>{
            console.log("it is Success!");
        }
    })
}
</script>

<style scoped></style>
