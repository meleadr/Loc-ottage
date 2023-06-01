import { createRouter, createWebHistory } from "vue-router";

// Admin
import Admin from "../components/pages/Admin.vue";
import Presentation from "../components/pages/Presentation.vue";
import Login from "../components/pages/Login.vue";
import Chalet from "../components/pages/Chalet.vue";

// NotFound
import NotFound from "../components/pages/NotFound.vue";

const routes = [
    {
        path: "/",
        Name: "Presentation",
        component: Presentation,
    },
    {
        path: "/chalet/:id",
        Name: "Chalet",
        component: Chalet,
    },
    {
        path: "/admin",
        Name: "Admin",
        component: Admin,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/admin/login",
        Name: "Login",
        component: Login,
    },
    {
        path: "/:pathMatch(.*)*",
        Name: "NotFound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !sessionStorage.getItem("token")) {
        return "/admin/login";
    }
});

export default router;
