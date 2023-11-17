<template>
    <el-page-header title="Назад" @back="goBack">
        <template #content>
            <span class="text-large font-600 mr-3"> Добавить новую кошку </span>
        </template>
    </el-page-header>

    <div class="p-4">
        <CreateForm />
    </div>
</template>

<script lang="ts" setup>
import { useRouter } from 'vue-router'
import CreateForm from '../../components/cats/create-form.vue'

const router = useRouter()
const goBack = () => {
    router.back()
}
</script>
