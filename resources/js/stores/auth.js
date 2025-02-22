import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("Auth-Token"),
    }),

    actions: {
        async login(credentials) {
            try {
                const response = await axios.post("/api/login", credentials);
                this.token = response.data.token;
                this.user = response.data.user;
                localStorage.setItem("Auth-Token", this.token);
            } catch (error) {
                throw new Error("Login failed");
            }
        },

        logout() {
            this.user = null;
            this.token = null;
            localStorage.removeItem("Auth-Token");
            router.push({ name: "login" });
        },
    },
});
