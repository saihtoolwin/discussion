<template>
    <div class="flex items-center justify-center">
      <div class="border-t-transparent mr-2 border-solid animate-spin rounded-full border-gray-300 border-4 h-5 w-5"></div>
    </div>
  </template>
  
  <script>
  export default {
    name: "LoadingSpinner",
  };
  </script>
  
  <style scoped>
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  
  .animate-spin {
    animation: spin 1s linear infinite;
  }
  </style>