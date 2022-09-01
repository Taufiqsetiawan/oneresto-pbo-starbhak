//import vue router
import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
    {
        path: '/',
        name: 'template',
        component: () => import( /* webpackChunkName: "profilhotel.index" */ '@/views/profilhotel/Index.vue')
    },
    {
        path: '/create',
        name: 'profilhotel.create',
        component: () => import( /* webpackChunkName: "profilhotel.create" */ '@/views/profilhotel/Create.vue')
    },
    {
        path: '/edit/:id',
        name: 'profilhotel.edit',
        component: () => import( /* webpackChunkName: "profilhotel.edit" */ '@/views/profilhotel/Edit.vue')
    },
    
    
    {
        path: '/menu',
        name: 'menu.index',
        component: () => import( /* webpackChunkName: "profilhotel.index" */ '@/views/menu/Index.vue')
    },{
        path: '/create-menu',
        name: 'menu.create',
        component: () => import( /* webpackChunkName: "menu.create" */ '@/views/menu/Create.vue')
    },
    {
        path: '/edit-menu/:id',
        name: 'menu.edit',
        component: () => import( /* webpackChunkName: "menu.edit" */ '@/views/menu/Edit.vue')
    }
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router