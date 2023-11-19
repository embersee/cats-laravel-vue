<template>
    <div class="heading">
        <h1 class="title">{{ title }}</h1>
        <slot />
    </div>
</template>

<script setup>
defineProps(['title'])
</script>

<style>
.heading {
    @apply flex justify-between items-center mb-4;
}

.title {
    @apply text-2xl text-center;
}
</style>
