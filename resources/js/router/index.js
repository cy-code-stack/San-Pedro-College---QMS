import { createRouter, createWebHistory } from "vue-router";
import NotFound from '../components/Notfound.vue';

//Pages Admin
import AdminDashboard from '../components/Admin/Dashboard.vue';
import TransactionView from '../components/Admin/Transaction/index.vue';
import UsersView from '../components/Admin/User/index.vue';
import UserType from '../components/Admin/UserType/index.vue'



const routes = [
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: AdminDashboard
    },
    {
        path: '/transaction',
        name: 'transaction',
        component: TransactionView
    },
    {
        path: '/user',
        name: 'user',
        component: UsersView
    },
    {
        path: '/usertype',
        name: 'usertype',
        component: UserType
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;