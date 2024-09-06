<template>
    <div />
</template>

<script setup>
import { onBeforeUnmount, onMounted } from 'vue';
import { usePage,router } from '@inertiajs/vue3';
// import { createToaster } from '@meforma/vue-toaster';
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

let removeFinishEventListener = null;

function handleFlashMessages() {
    let flash = usePage().props.flash;
    console.log(flash);
    if (flash.info || flash.success || flash.error) {
        let type, message;
        if (flash.info) {
            type = 'info';
            message = flash.info;
        }
        if (flash.success) {
            type = 'success';
            message = flash.success;
        }
        if (flash.error) {
            type = 'error';
            message = flash.error;
        }
        toast(message, {
            position: "bottom-right",
            type: type,
            autoClose: 5000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
        });
    }
}

onMounted(() => {
    console.log(usePage().props.flash?.showToast);
    if(usePage().props.flash?.showToast) {
        handleFlashMessages();
    }

    removeFinishEventListener = router.on('finish', () => {
        handleFlashMessages();
    });

});

onBeforeUnmount(() => {
    removeFinishEventListener && removeFinishEventListener();
});
</script>
<style>
/* toast css */
.c-toast--info {
    background-color: #0092ef !important;
}
</style>
