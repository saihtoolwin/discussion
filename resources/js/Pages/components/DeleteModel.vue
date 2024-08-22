<template>
  <div v-if="props.show" class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Modal Box -->
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
      <div class="px-6 py-4">
        <div>
          <slot></slot>
        </div>
      </div>

      <!-- Footer -->
      <div class="px-6 py-4 bg-gray-100 text-right flex justify-center">
        <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" @click="closeModal">
          Close
        </button>
        <button class="bg-red-500 ml-5 text-white px-4 py-2 rounded hover:bg-red-600" @click="deleteQuestion(props.id)">
          Confirm
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { defineProps, defineEmits } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({
  show: {
    type: Boolean,
    required: true,
  },
  id: {
    type: Number,
  }
});
const emit = defineEmits(['close', 'deleted']);

function closeModal() {
  emit('close');
}

const deleteQuestion = (id) => {
  router.delete(route("question.delete", id), {
    onSuccess: () => {
      emit('deleted', id);
      emit('close');
      toast.success('Question deleted successfully');
    },
    onError: (error) => {
      console.error('Error deleting question:', error);
      toast.error('Failed to delete question');
    },
    preserveScroll: true
  });
};
</script>

<style scoped>
/* Add any additional custom styles here */
</style>

  