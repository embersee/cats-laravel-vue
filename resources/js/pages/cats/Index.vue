<template>
    <Heading title="Таблица Кошек">
        <el-button @click="CreateCat">Добавить</el-button>
    </Heading>

    <CatsTable />
</template>
<script>
import CatsTable from '../../components/cats/table.vue'
import Heading from '../../components/ui/heading.vue'
export default {
    methods: {
        CreateCat() {
            this.$router.push({ name: 'CreateCat' })
        }
    },
    components: {
        Heading,
        CatsTable
    }
}
</script>
