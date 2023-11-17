<template>
    <el-menu
        mode="horizontal"
        :ellipsis="false"
        @select="handleSelect"
        router
        :default-active="$route.path"
    >
        <el-menu-item index="/">
            <h1 class="text-2xl">Cats + Laravel + Vue</h1>
        </el-menu-item>

        <div class="grow" />

        <el-sub-menu index="/cats">
            <template #title>Кошки</template>
            <el-menu-item index="/" route="/">Каталог</el-menu-item>
            <el-menu-item index="cats" route="/cats">Таблица</el-menu-item>
        </el-sub-menu>
        <el-menu-item index="breeds" route="/breeds">Породы</el-menu-item>
    </el-menu>
</template>

<script lang="ts" setup>
const handleSelect = (key: string, keyPath: string[]) => {
    console.log(key, keyPath)
}
</script>
