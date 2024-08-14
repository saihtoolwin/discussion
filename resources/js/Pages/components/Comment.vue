<template>
    <div class="bg-slate-200 p-4 rounded-md">
        <!-- comment btn  -->
        <form @submit.prevent="submit">
            <div
                class="w-full mb-4 border border-gray-200 rounded-lg bg-primary"
            >
                <div class="px-4 py-2 text-black bg-white rounded-t-lg">
                    <FileUpload
                        ref="fileUploadref"
                        name="image"
                        labelIdle="Choose or Drag Image here..."
                        :allowMultiple="false"
                        :imageCropAspectRatio="'1:1'"
                        :imagePreviewHeight="170"
                        :imageResizeTargetWidth="170"
                        :imageResizeTargetHeight="170"
                        @updateFile="handleFilePondUpdate"
                    ></FileUpload>
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea
                        id="comment"
                        v-model="form.comment"
                        rows="4"
                        class="w-full px-0 text-sm text-black bg-white border-0 focus:ring-0 dark:placeholder-gray-400"
                        placeholder="Write a comment..."
                        required
                    ></textarea>
                </div>
                <div
                    class="flex items-center justify-end px-3 py-2 border-t dark:border-gray-600"
                >
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-sky-500 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-sky-700"
                    >
                        Post comment
                    </button>
                </div>
            </div>
        </form>
        <!-- Inner border starts here -->

        <div
            class="border-2 border-gray-400 bg-white rounded-md"
            v-for="(comment, index) in props.comments"
            :key="comment.id"
            :class="{ 'mt-3': index > 0 }"
        >
            <div
                class="flex justify-between items-center bg-primary text-white py-3 px-4 rounded-t-md"
            >
                <div class="flex items-center space-x-3">
                    <img
                        :src="'/' + comment.user.url_storage"
                        alt="User Image"
                        class="w-10 h-10 rounded-full object-cover"
                    />
                    <h3 class="text-lg font-semibold">
                        {{ comment.user.name }}
                    </h3>
                    <h2 class="text-sm text-white">
                        {{ comment.date }}
                    </h2>
                </div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z"
                    />
                </svg>
            </div>
            <div class="p-4">
                <p class="text-gray-800">
                    {{ comment.comment }}
                </p>
                <Modal>
                    <img
                        class="h-[200px] mt-5"
                        :src="getUrlImage(comment.image)"
                        alt=""
                    />
                </Modal>
            </div>
        </div>
        <!-- Inner border ends here -->
    </div>
</template>

<script setup>
import FileUpload from "@/Pages/components/FileUpload.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed, defineProps, ref } from "vue";
import Modal from "@/Components/Modal.vue";
const openModal = ref(false);
const props = defineProps({
    comments: Array,
});
const getUrlImage = (image) => {
    return `http://127.0.0.1:8000/storage/${image}`;
};
const fileUploadref = ref(null);
const page = usePage();
const handleFilePondUpdate = (file) => {
    if (file) {
        form.image = file;
    }
};
const form = useForm({
    question_id: page.props.questions[0].id,
    image: "",
    comment: "",
});

const submit = () => {
    console.log("it work");
    form.post(route("comment.store"), {
        onSuccess: () => {
            form.reset();
            if (fileUploadref.value) {
                const pondInstance = fileUploadref.value.$refs.pond;
                if (pondInstance) {
                    pondInstance.removeFiles();
                }
            }
        },
        preserveScroll: true,
    });
};
</script>

<style lang="scss" scoped></style>
