<script setup>
    import Input from "@/components/input.vue";
    import Loader from "@/components/loader.vue";
    import Select from "@/components/select.vue";
    import useMembersService from "@/services/useMembersService";
    import { onMounted } from "vue";
    import { useRoute } from "vue-router";

    const route = useRoute();
    const member_id = route.params.id;

    const { member, message, getMemberById, updateMember, loading, is_invalid } = useMembersService();

    onMounted(() => {
        getMemberById(member_id);
    });
</script>

<template>
    <Loader v-if="loading" />
    <RouterLink class="btn btn-secondary" :to="{ name: 'membersList' }"><i class="bi bi-reply-fill"></i> Назад к списку</RouterLink>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h4 class="fw-bold">Редактирование сотрудника</h4>
        <form class="form row g-3 col-4 p-3 shadow-sm" @submit.prevent="updateMember(member_id)">
            <div class="col-12">
                <Input label="Фамилия" v-model="member.lastname" name="lastname" :is_invalid="is_invalid('lastname')" />
            </div>
            <div class="col-12">
                <Input label="Имя" v-model="member.firstname" name="firstname" :is_invalid="is_invalid('firstname')" />
            </div>
            <div class="col-12">
                <Input label="Отчество" v-model="member.middlename" name="middlename" :is_invalid="is_invalid('middlename')" />
            </div>
            <div class="col-12">
                <Input label="Дата рождения" v-model="member.birthday_at" name="birthday_at" type="date" :is_invalid="is_invalid('birthday_at')" />
            </div>
            <div class="col-12">
                <Select label="Статус" v-model="member.is_active" name="birthday_at" :is_invalid="is_invalid('birthday_at')">
                    <option value="1">Активен</option>
                    <option value="0">Неактивен</option>
                </Select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary form-control"><i class="bi bi-arrow-clockwise"></i> Обновить</button>
            </div>
        </form>
        <h4 class="fw-bold alert alert-success mt-3" v-if="message">{{ message }}</h4>
    </div>
</template>

<style scoped></style>
