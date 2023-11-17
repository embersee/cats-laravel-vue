<template>
    <el-container direction="vertical" class="min-h-screen">
        <Nav />
        <el-main> <router-view></router-view></el-main>
        <Footer />
    </el-container>
</template>

<script setup>
import Nav from './components/ui/nav.vue'
import Footer from './components/ui/footer.vue'
</script>
