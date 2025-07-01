import { ref } from "vue";

export default function useValidationService() {
    const errorFields = ref([]);
    const errorMessage = ref("");
    let timeoutId;

    const validation = (e) => {
        if (e.status === 422 && e.response.data.errors) {
            errorFields.value = e.response.data.errors;

            clearTimeout(timeoutId);

            timeoutId = setTimeout(() => {
                errorFields.value = [];
            }, 2000);
        }
        if (e.status === 401 && e.response.data.message) {
            errorMessage.value = e.response.data.message;

            clearTimeout(timeoutId);

            timeoutId = setTimeout(() => {
                errorMessage.value = "";
            }, 2000);
        }
    };

    const is_invalid = (field) => {
        return errorFields.value?.[field]?.[0];
    };

    return {
        errorFields,
        errorMessage,
        validation,
        is_invalid,
    };
}
