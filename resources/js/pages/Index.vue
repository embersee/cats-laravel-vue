<template>
    <Heading title="Каталог кошек">
        <el-button @click="CreateCat">Добавить</el-button>
    </Heading>

    <CatsList />
</template>
<script>
import CatsList from '../components/cats/list.vue'
import Heading from '../components/ui/heading.vue'

export default {
    methods: {
        CreateCat() {
            this.$router.push({ name: 'CreateCat' })
        }
    },
    components: {
        Heading,
        CatsList
    }
}
</script>
