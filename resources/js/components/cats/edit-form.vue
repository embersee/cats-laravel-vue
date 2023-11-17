<template>
    <el-form
        ref="editCatForm"
        :model="catForm"
        label-width="80px"
        class="flex flex-col mx-auto max-w-md"
    >
        <div class="space-y-2 flex flex-col mb-2">
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
                <el-select
                    v-model="catForm.breed_id"
                    placeholder="Select a breed"
                >
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
                <el-button type="primary" @click="updateCat"
                    >Update Cat</el-button
                >
            </el-form-item>
        </div>
    </el-form>
</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent, ref, onMounted } from 'vue'

export default defineComponent({
    props: {
        catId: {
            type: [String, Number],
            required: true
        }
    },
    setup(props) {
        const catForm = ref({
            name: '',
            image: '',
            age: 0,
            breed_id: ''
        })
        const breeds = ref([])

        const fetchCatData = async () => {
            try {
                const response = await axios.get(`/api/cats/${props.catId}`)
                catForm.value = response.data
            } catch (error) {
                console.error('Error fetching cat data:', error)
                alert('Error occurred while fetching cat data.')
            }
        }

        const fetchBreeds = async () => {
            try {
                const response = await axios.get('/api/breeds')
                breeds.value = response.data
            } catch (error) {
                console.error('Error fetching breeds:', error)
                alert('Error occurred while fetching breeds.')
            }
        }

        const updateCat = async () => {
            try {
                await axios.put(`/api/cats/${props.catId}`, catForm.value)
                alert('Cat updated successfully!')
                // Additional success handling (e.g., redirecting)
            } catch (error) {
                console.error('Error updating cat:', error)
                alert('Error occurred while updating the cat.')
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
            fetchCatData()
            fetchBreeds()
        })

        return {
            catForm,
            breeds,
            fetchCatImage,
            updateCat,
            isLoadingImage
        }
    }
})
</script>
