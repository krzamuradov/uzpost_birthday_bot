import http from "@/http";
import { ref } from "vue";
import dayjs from "dayjs";
import useValidationService from "@/services/useValidationService";

export default function useMembersService() {
    const { is_invalid, validation } = useValidationService();
    const url = "/members";
    const members = ref([]);
    const member = ref({});
    const message = ref("");

    const loading = ref(false);

    const payload = ref({
        firstname: "",
        lastname: "",
        middlename: "",
        birthday_at: "",
    });

    const getAllMembers = async () => {
        loading.value = true;
        try {
            const response = await http.get(url);
            members.value = response.data.map((member) => {
                return {
                    id: member.id,
                    firstname: member.firstname,
                    lastname: member.lastname,
                    middlename: member.middlename,
                    fullname: `${member.lastname} ${member.firstname} ${member.middlename ?? ""}`,
                    birthday_at: member.lastname,
                    is_active: member.is_active ? "Активен" : "Не активен",
                    birthday_at_preview: dayjs(member.birthday_at).format("DD.MM.YYYY"),
                };
            });
        } catch (e) {
            console.log(e);
        } finally {
            loading.value = false;
        }
    };

    const getMemberById = async (member_id) => {
        loading.value = true;
        try {
            const response = await http.get(url + "/" + member_id);
            member.value = { ...response.data };
            console.log(response.data);
        } catch (e) {
            console.log(e);
        } finally {
            loading.value = false;
        }
    };

    const createMember = async () => {
        loading.value = true;
        try {
            const response = await http.post(url, payload.value);
            if (response.status === 201) {
                message.value = response.data.message;
                payload.value = {};

                setTimeout(() => {
                    message.value = "";
                }, 2000);
            }
        } catch (e) {
            validation(e);
        } finally {
            loading.value = false;
        }
    };
    const updateMember = async (member_id) => {
        loading.value = true;
        try {
            const response = await http.put(url + "/" + member_id, member.value);
            if (response.status === 200) {
                message.value = response.data.message;

                setTimeout(() => {
                    message.value = "";
                }, 2000);
            }
        } catch (e) {
            validation(e);
        } finally {
            loading.value = false;
        }
    };

    return {
        members,
        member,
        payload,
        loading,
        message,
        getAllMembers,
        getMemberById,
        createMember,
        updateMember,
        is_invalid,
    };
}
