<template>
    <el-table
        :data="cats"
        class="w-full"
        border
        :row-class-name="getAgeCellStyle"
    >
        <el-table-column prop="name" label="Имя"></el-table-column>
        <el-table-column label="Возраст">
            <template #default="scope">
                <div>
                    {{ scope.row.age }}
                </div>
            </template>
        </el-table-column>
        <el-table-column label="Порода">
            <template #default="scope">
                {{ scope.row.breed.name }}
            </template>
        </el-table-column>

        <el-table-column label="Действия" width="200">
            <template #default="scope">
                <el-button size="small" @click="editCat(scope.row.id)"
                    >Редакт</el-button
                >
                <el-button
                    size="small"
                    type="danger"
                    @click="deleteCat(scope.row.id)"
                    >Удалить</el-button
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
                alert('Произошла ошибка при загрузке кошек.')
            }
        }

        /**
         * Подсвечивает записи в таблице возраст которых приближается
         * к средней продолжительности жизни породы
         */
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
            if (confirm('Вы уверены, что хотите удалить этого кота?')) {
                axios
                    .delete(`/api/cats/${catId}`)
                    .then(() => {
                        cats.value = cats.value.filter(
                            (cat) => cat.id !== catId
                        ) // Remove cat from list
                        alert('Кот успешно удален!')
                    })
                    .catch((error) => {
                        console.error('Error deleting cat:', error)
                        alert('Произошла ошибка при удалении кота.')
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
