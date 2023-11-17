<template>
    <div class="heading">
        <h1 class="title">{{ title }}</h1>
        <slot />
    </div>
</template>

<script setup>
defineProps(['title'])
</script>
