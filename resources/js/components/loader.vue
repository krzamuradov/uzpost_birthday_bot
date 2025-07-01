<script setup></script>

<template>
    <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 vh-100 w-100 bg-white bg-opacity-75 z-3">
        <img src="@/assets/logo.png" alt="Logo" width="150" class="animated-logo" />
    </div>
</template>

<style scoped>
    .animated-logo {
        animation: pulse 0.9s infinite ease-in-out;
    }

    @keyframes pulse {
        0%,
        100% {
            transform: scale(0.8);
        }
        50% {
            transform: scale(1.1);
        }
    }
</style>
