<script setup>
    import Input from "@/components/input.vue";
    import Loader from "@/components/loader.vue";
    import useLoginService from "@/services/useLoginService";
    const { credentials, errorMessage, loading, login, is_invalid } = useLoginService();
</script>

<template>
    <Loader v-if="loading" />
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-lg-4 p-4 shadow-sm">
            <div class="text-center">
                <img src="@/assets/logo.png" alt="Logo" width="100px" />
                <h4 class="fw-bold">Авторизация</h4>
            </div>
            <form class="row g-3" @submit.prevent="login">
                <div class="col-12">
                    <Input label="Логин" name="login" v-model="credentials.login" :is_invalid="is_invalid('login')" />
                </div>
                <div class="col-12">
                    <Input label="Пароль" name="password" type="password" v-model="credentials.password" :is_invalid="is_invalid('password')" />
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary form-control"><i class="bi bi-arrow-right-square"></i> Войти</button>
                </div>
            </form>
            <h5 class="fw-bold alert alert-danger text-center mt-3" v-if="errorMessage">{{ errorMessage }}</h5>
        </div>
    </div>
</template>

<style scoped></style>
