<template>
    <el-page-header title="Назад" @back="goBack">
        <template #content>
            <span class="text-large font-600 mr-3"> Редактировать кошку </span>
        </template>
    </el-page-header>
    <el-container class="p-4">
        <EditForm :catId="catId" />
    </el-container>
</template>

<script lang="ts" setup>
import { useRouter, useRoute } from 'vue-router'
import EditForm from '../../components/cats/edit-form.vue'

const router = useRouter()
const route = useRoute()

const goBack = () => {
    router.back()
}

const catId = route.params.id
</script>
