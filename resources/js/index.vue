<script setup>
    import Navbar from "@/components/navbar.vue";
</script>

<template>
    <div class="container">
        <Navbar />
        <div class="p-4 shadow-sm">
            <RouterView />
        </div>
    </div>
</template>

<style scoped></style>
