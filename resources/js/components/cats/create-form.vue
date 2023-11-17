<template>
    <el-form
        ref="addCatForm"
        :model="catForm"
        label-width="80px"
        class="flex flex-col mx-auto max-w-md"
    >
        <div class="space-y-2 flex flex-col items-center mb-2">
            <el-image
                class="w-96 h-96"
                :src="catForm.image"
                fit="cover"
                v-loading="isLoadingImage"
            />

            <el-button @click="fetchCatImage">Fetch New Image</el-button>
        </div>
        <div>
            <el-form-item label="Cat Name">
                <el-input v-model="catForm.name"></el-input>
            </el-form-item>

            <el-form-item label="Age">
                <el-input-number
                    v-model="catForm.age"
                    :min="0"
                ></el-input-number>
            </el-form-item>

            <el-form-item label="Breed">
                <el-select v-model="catForm.breed_id" placeholder="Select">
                    <el-option
                        v-for="breed in breeds"
                        :key="breed.id"
                        :label="breed.name"
                        :value="breed.id"
                    >
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="submitForm"
                    >Add Cat</el-button
                >
            </el-form-item>
        </div>
    </el-form>
</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent, ref, onMounted } from 'vue'

export default defineComponent({
    setup() {
        const catForm = ref({
            name: '',
            age: 0,
            breed_id: '',
            image: ''
        })

        const breeds = ref([])

        const fetchBreeds = async () => {
            try {
                const response = await axios.get('/api/breeds')
                breeds.value = response.data
            } catch (error) {
                console.error('Error fetching breeds:', error)
                alert('Error occurred while fetching breeds.')
            }
        }

        const submitForm = async () => {
            try {
                const response = await axios.post('/api/cats', catForm.value)
                console.log('Cat created:', response.data)
                catForm.value = { name: '', age: 0, breed_id: '', image: '' }
                alert('Cat successfully added!')
            } catch (error) {
                console.error('Error creating cat:', JSON.stringify(error))
                alert('Error occurred while adding the cat.')
            }
        }

        const isLoadingImage = ref(false)

        const fetchCatImage = async () => {
            isLoadingImage.value = true
            try {
                const response = await axios.get('/api/cat-image')
                catForm.value.image = response.data.url
            } catch (error) {
                console.error('Error fetching cat image:', error)
                alert('Error occurred while fetching the cat image.')
            } finally {
                isLoadingImage.value = false
            }
        }

        onMounted(() => {
            fetchBreeds()
            fetchCatImage()
        })
        return {
            breeds,
            catForm,
            submitForm,
            fetchCatImage,
            isLoadingImage
        }
    }
})
</script>
