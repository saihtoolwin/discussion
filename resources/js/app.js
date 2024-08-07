import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
const appName = import.meta.env.VITE_APP_NAME || "Laravel";
import Vue3Toastify from "vue3-toastify";
import "vue3-toastify/dist/index.css";
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Vue3Toastify, {
                autoClose: 3000,
                hideProgressBar: false,
                newestOnTop: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                position: "bottom-right", 
                progress: undefined,
            })
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
