import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: () => import('./pages/Index.vue')
        },
        {
            path: '/cats',
            name: 'CatsTable',
            component: () => import('./pages/cats/Index.vue')
        },
        {
            path: '/cats/create',
            name: 'CreateCat',
            component: () => import('./pages/cats/Create.vue')
        },
        {
            path: '/cats/edit/:id',
            name: 'EditCat',
            component: () => import('./pages/cats/Edit.vue'),
            props: true
        },
        {
            path: '/breeds',
            name: 'BreedTable',
            component: () => import('./pages/breeds/Index.vue')
        },
        {
            path: '/breeds/create',
            name: 'CreateBreed',
            component: () => import('./pages/breeds/Create.vue')
        },
        {
            path: '/breeds/edit/:id',
            name: 'EditBreed',
            component: () => import('./pages/breeds/Edit.vue'),
            props: true
        }
    ]
})
export default router
