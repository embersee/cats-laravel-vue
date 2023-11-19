<template>
    <el-form
        ref="updateBreedForm"
        :model="breedForm"
        label-width="120px"
        class="flex flex-col mx-auto w-1/2 max-w-lg"
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
            <el-button type="primary" @click="submitForm">Обновить</el-button>
        </el-form-item>
    </el-form>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'

interface Breed {
    id: number
    name: string
    description: string
    average_life_expectancy: number
}

export default defineComponent({
    props: {
        breedId: {
            type: [String, Number],
            required: true
        }
    },
    setup(props) {
        const breedForm = ref({
            name: '',
            description: '',
            average_life_expectancy: 0
        })

        const fetchBreedData = async () => {
            try {
                const response = await axios.get(`/api/breeds/${props.breedId}`)
                breedForm.value = response.data
            } catch (error) {
                console.error('Error fetching breed data:', error)
                alert('Произошла ошибка при получении данных о породе.')
            }
        }

        const submitForm = async () => {
            try {
                await axios.put(`/api/breeds/${props.breedId}`, breedForm.value)
                alert('Порода успешно обновлена!')
            } catch (error) {
                console.error('Error updating breed:', error)
                alert('Произошла ошибка при обновлении породы.')
            }
        }

        onMounted(fetchBreedData)

        return {
            breedForm,
            submitForm
        }
    }
})
</script>
