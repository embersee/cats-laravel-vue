<template>
    <el-container class="h-screen">
        <Nav />
        <el-main><router-view></router-view></el-main>
        <el-footer class="mt-auto"><Footer /></el-footer>
    </el-container>
</template>

<script setup>
import Nav from "./components/ui/Nav.vue";
import Footer from "./components/ui/Footer.vue";
</script>
