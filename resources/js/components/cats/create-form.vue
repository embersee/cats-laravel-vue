<template>
    <el-form
        ref="addCatForm"
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

            <el-button @click="fetchCatImage">Новое изображение</el-button>
        </div>
        <div>
            <el-form-item label="Имя">
                <el-input v-model="catForm.name"></el-input>
            </el-form-item>

            <el-form-item label="Возраст">
                <el-input-number
                    v-model="catForm.age"
                    :min="0"
                ></el-input-number>
            </el-form-item>

            <el-form-item label="Парода">
                <el-select
                    v-model="catForm.breed_id"
                    placeholder="Выберите породу"
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
                <el-button type="primary" @click="submitForm"
                    >Добавить кошку</el-button
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
                console.error('Ошибка при получении пород:', error)
                alert('Произошла ошибка при получении данных пород.')
            }
        }

        const isLoadingImage = ref(false)

        const fetchCatImage = async () => {
            isLoadingImage.value = true
            try {
                const response = await axios.get('/api/cat-image')
                catForm.value.image = response.data.url
            } catch (error) {
                console.error('Ошибка при получении изображения кошки:', error)
                alert('Произошла ошибка при получении изображения кошки.')
            } finally {
                isLoadingImage.value = false
            }
        }
        const submitForm = async () => {
            try {
                const response = await axios.post('/api/cats', catForm.value)
                console.log('Cat created:', response.data)
                catForm.value = { name: '', age: 0, breed_id: '', image: '' }

                alert('Кот успешно добавился!')
                await fetchCatImage()
            } catch (error) {
                console.error('Ошибка обновления кота:', error)
                alert('Произошла ошибка при обновлении кота.')
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
