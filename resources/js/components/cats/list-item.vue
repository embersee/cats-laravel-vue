<template>
    <el-card class="p-0">
        <img
            :src="cat.image"
            alt="Cat image"
            class="w-full object-cover aspect-square rounded-sm mb-1"
        />
        <div>
            <h3 class="text-lg font-semibold mb-1">{{ cat.name }}</h3>
            <p class="text-sm text-gray-600">Breed: {{ cat.breed.name }}</p>
            <p class="text-sm text-gray-600">Age: {{ cat.age }} years</p>
        </div>
        <el-button-group class="mt-2 self-end">
            <el-button @click="editCat(cat.id)">Edit</el-button>
            <el-button type="danger" @click="deleteCat(cat.id)"
                >Delete</el-button
            >
        </el-button-group>
    </el-card>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import axios from 'axios'

interface Cat {
    id: number
    name: string
    age: number
    image: string
    breed: {
        name: string
    }
}

export default defineComponent({
    props: {
        cat: {
            type: Object as PropType<Cat>,
            required: true
        }
    },
    methods: {
        editCat(catId) {
            this.$router.push({ name: 'EditCat', params: { id: catId } })
        },
        deleteCat(catId) {
            if (confirm('Are you sure you want to delete this cat?')) {
                axios
                    .delete(`/api/cats/${catId}`)
                    .then(() => {
                        this.$emit('catDeleted', catId)
                        alert('Cat deleted successfully')
                    })
                    .catch((error) => {
                        console.error('Error deleting cat:', error)
                        alert('Error occurred while deleting the cat.')
                    })
            }
        }
    }
})
</script>
