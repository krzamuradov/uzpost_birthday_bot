<script setup>
    import Loader from "@/components/loader.vue";
    import useMembersService from "@/services/useMembersService";
    import { onMounted } from "vue";
    import { RouterLink } from "vue-router";

    const { members, loading, getAllMembers } = useMembersService();

    onMounted(() => {
        getAllMembers();
    });
</script>

<template>
    <Loader v-if="loading" />
    <div class="text-center">
        <RouterLink class="btn btn-success mb-3" :to="{ name: 'memberCreate' }" title="Добавление нового сотрудника"
            ><i class="bi bi-plus-circle"></i> Новый сотрудник</RouterLink
        >
    </div>

    <table class="table table-hover table-striped table-bordered align-middle text-center">
        <thead>
            <tr>
                <th class="col-1">#</th>
                <th class="col-5">ФИО</th>
                <th class="col-2">Дата рождения</th>
                <th class="col-1">Статус</th>
                <th class="col-1">Действие</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, i) in members" :key="member.id">
                <td class="col-1">{{ i + 1 }}</td>
                <td class="col-5">{{ member.fullname }}</td>
                <td class="col-2">{{ member.birthday_at_preview }}</td>
                <td class="col-1">{{ member.is_active }}<i class=""></i></td>
                <td class="col-1">
                    <RouterLink class="btn btn-outline-primary" :to="{ name: 'memberEdit', params: { id: member.id } }" title="Редактировать">
                        <i class="bi bi-pencil-fill"></i>
                    </RouterLink>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped></style>
