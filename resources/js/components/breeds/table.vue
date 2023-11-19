<template>
    <div>
        <el-table :data="breeds" class="w-full" border>
            <el-table-column prop="name" label="Порода"></el-table-column>
            <el-table-column
                prop="description"
                label="Описание"
            ></el-table-column>
            <el-table-column
                prop="average_life_expectancy"
                label="Средняя продолжительность жизни"
            ></el-table-column>

            <el-table-column label="Actions" width="200">
                <template #default="scope">
                    <el-button size="small" @click="editBreed(scope.row.id)">
                        Редакт.
                    </el-button>
                    <el-button
                        size="small"
                        type="danger"
                        @click="deleteBreed(scope.row)"
                    >
                        Удалить
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default defineComponent({
    setup() {
        const router = useRouter()
        const breeds = ref([])

        const fetchBreeds = async () => {
            try {
                const response = await axios.get('/api/breeds')
                breeds.value = response.data
            } catch (error) {
                console.error('Error fetching breeds:', error)
                alert('Произошла ошибка при получении пород.')
            }
        }

        const editBreed = (breedId) => {
            router.push({ name: 'EditBreed', params: { id: breedId } })
        }

        const deleteBreed = (breed) => {
            if (
                confirm(
                    `Вы уверены что хотите удалить породу "${breed.name}" и всех кошек с этой породой?`
                )
            ) {
                axios
                    .delete(`/api/breeds/${breed.id}`)
                    .then(() => {
                        breeds.value = breeds.value.filter(
                            (b) => b.id !== breed.id
                        )
                        alert('Порода успешно удалена')
                    })
                    .catch((error) => {
                        console.error('Error deleting breed:', error)
                        alert('Произошла ошибка при удалении породы.')
                    })
            }
        }

        onMounted(fetchBreeds)

        return {
            breeds,
            editBreed,
            deleteBreed
        }
    }
})
</script>
