<template>
    <Heading title="Таблица пород">
        <el-button @click="CreateBreed">Добавить</el-button>
    </Heading>

    <BreedTable />
</template>
<script>
import BreedTable from '../../components/breeds/table.vue'
import Heading from '../../components/ui/heading.vue'
export default {
    methods: {
        CreateBreed() {
            this.$router.push({ name: 'CreateBreed' })
        }
    },
    components: {
        Heading,
        BreedTable
    }
}
</script>
