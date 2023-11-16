import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: () => import("./pages/Index.vue"),
        },
        {
            path: "/new",
            component: () => import("./pages/New.vue"),
        },
    ],
});
export default router;
