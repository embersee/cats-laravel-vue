<template>
    <el-container direction="vertical" class="min-h-screen">
        <Navigation />
        <el-main> <router-view></router-view></el-main>
        <Footer />
    </el-container>
</template>

<script setup>
import Navigation from './components/ui/nav.vue'
import Footer from './components/ui/footer.vue'
</script>
