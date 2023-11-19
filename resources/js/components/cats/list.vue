<template>
    <ul
        v-if="cats.length"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2"
    >
        <li v-for="cat in cats" :key="cat.id">
            <CatListItem :cat="cat" @catDeleted="removeCatFromList" />
        </li>
    </ul>
    <p v-else>No cats available.</p>
</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent } from 'vue'
import CatListItem from './list-item.vue'

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
    data() {
        return {
            cats: [] as Cat[]
        }
    },
    mounted() {
        this.fetchCats()
    },
    methods: {
        fetchCats() {
            axios
                .get('/api/cats')
                .then((response) => {
                    this.cats = response.data
                })
                .catch((error) => {
                    console.error('Произошла ошибка при запросе: ', error)
                })
        },
        removeCatFromList(catId) {
            this.cats = this.cats.filter((cat) => cat.id !== catId)
        }
    },
    components: {
        CatListItem
    }
})
</script>
