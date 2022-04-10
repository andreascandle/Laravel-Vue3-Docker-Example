import {createWebHistory, createRouter} from "vue-router";

import User from '../pages/users/Index.vue';
import Edit_User from '../pages/users/Edit.vue';
import Add from '../pages/users/Add.vue';
// import About from '../pages/About';
import Register from '../pages/Register.vue';
import Login from '../pages/Login.vue';
// import Dashboard from '../pages/Dashboard';

// import Books from '../components/Books';
// import AddBook from '../components/AddBook';
// import EditBook from '../components/EditBook';

export const routes = [
    {
        name: 'user',
        path: '/',
        component: User,
        meta: {
            requiresAuth: true
          }
    },
    {
        name: 'users',
        path: '/user',
        component: User,
        meta: {requiresAuth: true}
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'edit',
        path: '/user/edit/:id',
        component: Edit_User,
        meta: {requiresAuth: true}
    },
    {
        name: 'add',
        path: '/user/add',
        component: Edit_User,
        meta: {requiresAuth: true}
    },
    // {
    //     name: 'dashboard',
    //     path: '/dashboard',
    //     component: Dashboard
    // },
    // {
    //     name: 'books',
    //     path: '/books',
    //     component: Books
    // },
    // {
    //     name: 'addbook',
    //     path: '/books/add',
    //     component: AddBook
    // },
    // {
    //     name: 'editbook',
    //     path: '/books/edit/:id',
    //     component: EditBook
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
