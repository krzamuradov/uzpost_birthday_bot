<script setup>
    const props = defineProps({
        type: { type: String, default: "text" },
        name: { type: String, required: true },
        label: { type: String, required: true },
        is_invalid: { type: String, default: "" },
    });

    const model = defineModel();
</script>

<template>
    <div class="position-relative">
        <input :type="props.type" :name="props.name" :id="props.name" class="form-control" v-model="model" :class="{ 'is-invalid': props.is_invalid }" v-bind="$attrs" />
        <label :for="props.name" class="position-absolute top-0 start-0 translate-middle-y bg-white px-1 ms-3 small text-secondary rounded-0">{{ props.label }}</label>
        <div class="invalid-feedback" v-if="props.is_invalid">{{ props.is_invalid }}</div>
    </div>
</template>

<style scoped>
    input {
        height: 3rem;
    }
    input:focus {
        border-color: #0d6efd !important; /* или любой другой */
        box-shadow: 0 0 3px rgb(50, 83, 231); /* стандарт bootstrap */
    }

    input:-webkit-autofill {
        box-shadow: 0 0 0px 1000px white inset !important;
        -webkit-box-shadow: 0 0 0px 1000px white inset !important;
        -webkit-text-fill-color: #000 !important;
    }

    .is-invalid {
        box-shadow: none !important;
    }
</style>
