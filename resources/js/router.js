import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        redirect: { name: "membersList" },
    },
    {
        path: "/members",
        component: () => import("@/index.vue"),
        meta: { requiresAuth: true },
        children: [
            {
                path: "",
                name: "membersList",
                component: () => import("@/views/members/list.vue"),
            },
            {
                path: "create",
                name: "memberCreate",
                component: () => import("@/views/members/create.vue"),
            },
            {
                path: ":id/edit",
                name: "memberEdit",
                component: () => import("@/views/members/edit.vue"),
            },
        ],
    },
    {
        path: "/login",
        name: "login",
        component: () => import("@/views/login.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if (to.meta.title) {
        document.title = to.meta.title;
    }
    const authorized = Boolean(localStorage.getItem("token"));

    if (authorized && to.name === "login") {
        return { name: "membersList" };
    }

    if (!authorized && to.meta.requiresAuth) {
        return { name: "login" };
    }

    return true;
});

export default router;
