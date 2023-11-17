<template>
    <el-table
        :data="cats"
        class="w-full"
        border
        :row-class-name="getAgeCellStyle"
    >
        <el-table-column prop="name" label="Cat Name"></el-table-column>
        <el-table-column label="Age">
            <template #default="scope">
                <div>
                    {{ scope.row.age }}
                </div>
            </template>
        </el-table-column>
        <el-table-column label="Breed">
            <template #default="scope">
                {{ scope.row.breed.name }}
            </template>
        </el-table-column>

        <el-table-column label="Actions" width="150">
            <template #default="scope">
                <el-button size="small" @click="editCat(scope.row.id)"
                    >Edit</el-button
                >
                <el-button
                    size="small"
                    type="danger"
                    @click="deleteCat(scope.row.id)"
                    >Delete</el-button
                >
            </template>
        </el-table-column>
    </el-table>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default defineComponent({
    setup() {
        const cats = ref([])
        const router = useRouter()
        const fetchCats = async () => {
            try {
                const response = await axios.get('/api/cats')
                cats.value = response.data
            } catch (error) {
                console.error('Error fetching cats:', error)
                alert('Error occurred while fetching cats.')
            }
        }

        const getAgeCellStyle = ({ row }) => {
            const ageRatio = row.age / row.breed.average_life_expectancy
            if (ageRatio >= 0.8) {
                return 'emergency-row'
            }
            if (ageRatio >= 0.5) {
                return 'warning-row'
            }
            return ''
        }
        const editCat = (catId) => {
            router.push({ name: 'EditCat', params: { id: catId } })
        }

        const deleteCat = (catId) => {
            if (confirm('Are you sure you want to delete this cat?')) {
                axios
                    .delete(`/api/cats/${catId}`)
                    .then(() => {
                        cats.value = cats.value.filter(
                            (cat) => cat.id !== catId
                        ) // Remove cat from list
                        alert('Cat deleted successfully')
                    })
                    .catch((error) => {
                        console.error('Error deleting cat:', error)
                        alert('Error occurred while deleting the cat.')
                    })
            }
        }

        onMounted(fetchCats)

        return {
            cats,
            getAgeCellStyle,
            editCat,
            deleteCat
        }
    }
})
</script>

<style>
.el-table .warning-row {
    --el-table-tr-bg-color: var(--el-color-warning-light-9);
}

.el-table .emergency-row {
    --el-table-tr-bg-color: var(--el-color-warning-light-7);
}
</style>
