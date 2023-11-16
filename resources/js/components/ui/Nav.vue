<template>
    <el-menu
        mode="horizontal"
        :ellipsis="false"
        @select="handleSelect"
        :router="true"
        :default-active="$route.path"
    >
        <el-menu-item index="/">
            <h1 class="text-2xl">Cats + Laravel + Vue</h1>
        </el-menu-item>
        <div class="grow" />

        <el-menu-item index="/">Все кошки</el-menu-item>
        <el-menu-item index="new">Добавить кошку</el-menu-item>
    </el-menu>
</template>

<script lang="ts" setup>
const handleSelect = (key: string, keyPath: string[]) => {
    console.log(key, keyPath);
};
</script>
