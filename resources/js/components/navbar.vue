<script setup>
    import useLoginService from "@/services/useLoginService";

    const { logout } = useLoginService();
</script>

<template>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 mb-3">
        <a class="navbar-brand fw-bold" href="/">
            <img src="@/assets/logo.png" alt="Logo" width="100px" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <RouterLink class="nav-link" :to="{ name: 'membersList' }" exact-active-class="active"><i class="bi bi-people-fill"></i> Сотрудники</RouterLink>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#" @click="logout"><i class="bi bi-box-arrow-in-right"></i> Выход</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<style scoped>
    nav {
        min-height: 100px;
    }
    .navbar-nav .nav-link {
        position: relative;
        padding: 0.5rem 1rem;
        color: #333;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 1rem;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #0d6efd; /* основной цвет Bootstrap */
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
        width: calc(100% - 2rem); /* анимация underline */
    }

    .navbar-nav .nav-link:hover {
        color: #0d6efd;
    }

    .navbar-nav .nav-link.active {
        color: #0d6efd;
    }

    .navbar-nav .nav-link.active::after {
        width: calc(100% - 2rem);
    }
</style>
