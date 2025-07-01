import http from "@/http";
import router from "@/router";
import useValidationService from "@/services/useValidationService";
import { ref } from "vue";

export default function useLoginService() {
    const { is_invalid, validation, errorMessage } = useValidationService();
    const credentials = ref({
        login: "",
        password: "",
    });

    const message = ref("");
    const loading = ref(false);
    const login = async () => {
        loading.value = true;
        try {
            const response = await http.post("/login", credentials.value);
            localStorage.setItem("token", response.data.token);

            router.push({ path: "/" });
        } catch (e) {
            validation(e);
            console.log(e);
        } finally {
            loading.value = false;
        }
    };

    const logout = async () => {
        loading.value = true;
        try {
            const response = await http.post("/logout");
        } catch (e) {
            console.log(e);
        } finally {
            loading.value = false;
            localStorage.removeItem("token");
            router.push({ name: "login" });
        }
    };

    return {
        credentials,
        errorMessage,
        loading,
        login,
        logout,
        is_invalid,
    };
}
