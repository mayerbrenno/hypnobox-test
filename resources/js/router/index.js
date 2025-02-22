// resources/js/router/index.js
import { createRouter, createWebHistory } from "vue-router";
import CategoriaList from "../components/categoria/List.vue";
import CategoriaCreate from "../components/categoria/Create.vue";
import CategoriaEdit from "../components/categoria/Edit.vue";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import ForgotPassword from "../components/auth/ForgotPassword.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            redirect: "/login",
        },
        {
            path: "/categoria/List",
            name: "categoria-list",
            component: CategoriaList,
        },
        {
            path: "/categoria/create",
            name: "categoria-create",
            component: CategoriaCreate,
        },
        {
            path: "/categoria/:id/edit",
            name: "categoria-edit",
            component: CategoriaEdit,
            props: true,
        },
        {
            path: "/login",
            name: "Login",
            component: Login,
            meta: { requiresAuth: false },
        },
        {
            path: "/register",
            name: "register",
            component: Register,
            meta: { guest: true },
        },
        {
            path: "/forgot-password",
            name: "forgot-password",
            component: ForgotPassword,
            meta: { guest: true },
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: Dashboard,
            meta: { requiresAuth: true },
        },
    ],
});

router.beforeEach(async (to) => {
    const auth = useAuthStore();

    console.log("Navigating to:", to.path);

    // Allow access to login page even if not authenticated
    if (to.name === "Login") {
        if (auth.user) {
            return { name: "dashboard" }; // Redirect logged-in users to dashboard
        }
        return true;
    }

    // Check if route requires authentication
    if (to.meta.requiresAuth && !auth.user) {
        return { name: "Login" };
    }

    return true;
});

export default router;
