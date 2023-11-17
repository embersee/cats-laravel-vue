<template>
    <el-page-header title="Назад" @back="goBack">
        <template #content>
            <span class="text-large font-600 mr-3"> Редактировать породу </span>
        </template>
    </el-page-header>
    <el-container class="p-4">
        <EditForm :breed-id="breedId" />
    </el-container>
</template>

<script lang="ts" setup>
import { useRouter, useRoute } from 'vue-router'
import EditForm from '../../components/breeds/edit-form.vue'

const router = useRouter()
const route = useRoute()

const goBack = () => {
    router.back()
}

const breedId = route.params.id
</script>
