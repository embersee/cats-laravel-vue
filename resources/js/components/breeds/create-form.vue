<template>
    <el-form
        ref="createBreedForm"
        :model="breedForm"
        label-width="120px"
        class="flex flex-col mx-auto max-w-lg"
    >
        <el-form-item label="Порода">
            <el-input v-model="breedForm.name"></el-input>
        </el-form-item>

        <el-form-item label="Описание">
            <el-input
                type="textarea"
                v-model="breedForm.description"
            ></el-input>
        </el-form-item>

        <el-form-item label="Средняя продолжительность жизни">
            <el-input-number
                v-model="breedForm.average_life_expectancy"
                :min="0"
            ></el-input-number>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="submitForm">Создать</el-button>
        </el-form-item>
    </el-form>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import axios from 'axios'

export default defineComponent({
    setup() {
        const breedForm = ref({
            name: '',
            description: '',
            average_life_expectancy: 0
        })

        const submitForm = async () => {
            try {
                await axios.post('/api/breeds', breedForm.value)
                alert('Порода создана успешно!')
                // Дополнительная обработка успеха (например, сброс формы или redirect)
            } catch (error) {
                console.error('Error creating breed:', error)
                alert('Произошла ошибка при создании породы.')
            }
        }

        return {
            breedForm,
            submitForm
        }
    }
})
</script>
