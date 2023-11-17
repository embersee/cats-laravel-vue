<template>
    <div>
        <el-table :data="breeds" class="w-full" border>
            <el-table-column prop="name" label="Breed Name"></el-table-column>
            <el-table-column
                prop="description"
                label="Description"
            ></el-table-column>
            <el-table-column
                prop="average_life_expectancy"
                label="Average Life Expectancy"
            ></el-table-column>

            <el-table-column label="Actions" width="150">
                <template #default="scope">
                    <el-button size="small" @click="editBreed(scope.row.id)">
                        Edit
                    </el-button>
                    <el-button
                        size="small"
                        type="danger"
                        @click="deleteBreed(scope.row)"
                    >
                        Delete
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
                alert('Error occurred while fetching breeds.')
            }
        }

        const editBreed = (breedId) => {
            router.push({ name: 'EditBreed', params: { id: breedId } })
        }

        const deleteBreed = (breed) => {
            if (
                confirm(
                    `Are you sure you want to delete breed "${breed.name}"?`
                )
            ) {
                axios
                    .delete(`/api/breeds/${breed.id}`)
                    .then(() => {
                        breeds.value = breeds.value.filter(
                            (b) => b.id !== breed.id
                        )
                        alert('Breed deleted successfully')
                    })
                    .catch((error) => {
                        console.error('Error deleting breed:', error)
                        alert('Error occurred while deleting the breed.')
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
