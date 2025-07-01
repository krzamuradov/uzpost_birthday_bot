<script setup>
    import Input from "@/components/input.vue";
    import Loader from "@/components/loader.vue";
    import useMembersService from "@/services/useMembersService";

    const { payload, message, createMember, loading, is_invalid } = useMembersService();
</script>

<template>
    <Loader v-if="loading" />
    <RouterLink class="btn btn-secondary" :to="{ name: 'membersList' }"><i class="bi bi-reply-fill"></i> Назад к списку</RouterLink>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h4 class="fw-bold">Новый сотрудник</h4>
        <form class="form row g-3 col-4 p-3 shadow-sm" @submit.prevent="createMember">
            <div class="col-12">
                <Input label="Фамилия" v-model="payload.lastname" name="lastname" :is_invalid="is_invalid('lastname')" />
            </div>
            <div class="col-12">
                <Input label="Имя" v-model="payload.firstname" name="firstname" :is_invalid="is_invalid('firstname')" />
            </div>
            <div class="col-12">
                <Input label="Отчество" v-model="payload.middlename" name="middlename" :is_invalid="is_invalid('middlename')" />
            </div>
            <div class="col-12">
                <Input label="Дата рождения" v-model="payload.birthday_at" name="birthday_at" type="date" :is_invalid="is_invalid('birthday_at')" />
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary form-control"><i class="bi bi-floppy"></i> Сохранить</button>
            </div>
        </form>
        <h4 class="fw-bold alert alert-success mt-3" v-if="message">{{ message }}</h4>
    </div>
</template>

<style scoped></style>
