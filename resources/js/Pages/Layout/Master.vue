<template>
    <!-- Navbar -->
    <Navbar></Navbar>
    <!--  Navbar end -->

    <!-- Main Content -->
    <div class="container flex mx-auto px-4 py-8">
        <!-- Side bar -->
        <Sidebar></Sidebar>
        <!-- Side bar end -->

         <!-- Content -->
        <div class="w-full min-h-[auto] ml-8 rounded overflow-hidden shadow-lg">
            <slot></slot>
        </div>
        <!-- Content end -->
    </div>
    <!-- Main Content end -->
</template>

<script setup>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
</script>

<style lang="scss" scoped></style>
