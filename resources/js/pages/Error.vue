<template>
    <Heading title="Такой страницы нету"> </Heading>
    <div class="w-full flex justify-center">
        <el-image src="https://http.cat/images/404.jpg" />
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Heading from '../components/ui/heading.vue'

export default defineComponent({
    components: { Heading }
})
</script>
