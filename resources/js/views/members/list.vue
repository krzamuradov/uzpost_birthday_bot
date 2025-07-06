<script setup>
    import Loader from "@/components/loader.vue";
    import useMembersService from "@/services/useMembersService";
    import { computed, onMounted, ref } from "vue";
    import { RouterLink } from "vue-router";

    const { members, loading, deleteMember, getAllMembers } = useMembersService();

    const sortKey = ref("");
    const sortOrder = ref("asc");

    const sortBy = (key) => {
        if (sortKey.value === key) {
            sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
        } else {
            sortKey.value = key;
            sortOrder.value = "asc";
        }
    };

    const sortedMembers = computed(() => {
        if (!sortKey.value) return members.value;

        return [...members.value].sort((a, b) => {
            const dir = sortOrder.value === "asc" ? 1 : -1;

            if (sortKey.value === "fullname") {
                return a.fullname.localeCompare(b.fullname) * dir;
            }

            if (sortKey.value === "birthday_at_preview") {
                const parseDate = (str) => {
                    const [day, month, year] = str.split(".");
                    return new Date(+year, +month - 1, +day); // mm - 1 потому что месяц с 0
                };

                const dateA = parseDate(a.birthday_at_preview);
                const dateB = parseDate(b.birthday_at_preview);

                return (dateA - dateB) * dir;
            }

            return 0;
        });
    });

    onMounted(() => {
        getAllMembers();
    });
</script>

<template>
    <Loader v-if="loading" />
    <div class="text-center">
        <RouterLink class="btn btn-success mb-3" :to="{ name: 'memberCreate' }" title="Добавление нового сотрудника">
            <i class="bi bi-plus-circle"></i> Новый сотрудник
        </RouterLink>
    </div>

    <table class="table table-hover table-striped table-bordered align-middle text-center">
        <thead>
            <tr>
                <th class="col-1">#</th>
                <th class="col-5 sorted" @click="sortBy('fullname')">ФИО <i class="bi bi-sort-alpha-down"></i></th>
                <th class="col-2 sorted" @click="sortBy('birthday_at_preview')">Дата рождения <i class="bi bi-sort-down"></i></th>
                <th class="col-1">Статус</th>
                <th class="col-1">Действие</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, i) in sortedMembers" :key="member.id">
                <td class="col-1">{{ i + 1 }}</td>
                <td class="col-5">{{ member.fullname }}</td>
                <td class="col-2">{{ member.birthday_at_preview }}</td>
                <td class="col-1">{{ member.is_active }}<i class=""></i></td>
                <td class="col-1">
                    <RouterLink class="btn btn-outline-primary" :to="{ name: 'memberEdit', params: { id: member.id } }" title="Редактировать">
                        <i class="bi bi-pencil-fill"></i>
                    </RouterLink>
                    <button class="btn btn-outline-danger ms-1" title="Удалить" @click="deleteMember(member.id)">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
    .sorted {
        cursor: pointer;
        user-select: none;
        &:hover {
            color: red;
        }
    }

    th,
    td {
        user-select: none;
    }
</style>
