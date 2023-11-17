<template>
    <el-form
        ref="createBreedForm"
        :model="breedForm"
        label-width="120px"
        class="flex flex-col mx-auto max-w-lg"
    >
        <el-form-item label="Breed Name">
            <el-input v-model="breedForm.name"></el-input>
        </el-form-item>

        <el-form-item label="Description">
            <el-input
                type="textarea"
                v-model="breedForm.description"
            ></el-input>
        </el-form-item>

        <el-form-item label="Average Life Expectancy">
            <el-input-number
                v-model="breedForm.average_life_expectancy"
                :min="0"
            ></el-input-number>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="submitForm"
                >Create Breed</el-button
            >
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
                alert('Breed created successfully!')
                // Additional success handling (e.g., reset the form or navigate away)
            } catch (error) {
                console.error('Error creating breed:', error)
                alert('Error occurred while creating the breed.')
            }
        }

        return {
            breedForm,
            submitForm
        }
    }
})
</script>
