import { createRouter, createWebHistory } from "vue-router";

// Admin
import Admin from "../components/pages/Admin.vue";
import Presentation from "../components/pages/Presentation.vue";
import Login from "../components/pages/Login.vue";
import Chalet from "../components/pages/Chalet.vue";
import Reservation from "../components/pages/Reservation.vue";

// NotFound
import NotFound from "../components/pages/NotFound.vue";

const routes = [
    {
        path: "/",
        name: "Presentation",
        component: Presentation,
    },
    {
        path: "/chalet/:id",
        name: "Chalet",
        component: Chalet,
    },
    {
        path: "/chalet/reservation",
        name: "Reservation",
        component: Reservation,
        props: true,
    },
    {
        path: "/admin",
        name: "Admin",
        component: Admin,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/admin/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
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
