/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import {createApp} from 'vue'
 import App from './App.vue'
 import axios from 'axios'
 import router from './router'
 require('./bootstrap');
 
 function userLoggedIn(){
     return localStorage.getItem('token')
 }
 
 router.beforeEach((to, from, next) => {
     if (to.matched.some(record => record.meta.requiresAuth)) {
         // this route requires auth, check if logged in
         // if not, redirect to login page.
         if (!userLoggedIn()) {
             next({
             path: '/login',
             query: { redirect: to.fullPath }
             })
         } else {
             next()
         }
     } else if(to.matched.some(record => record.meta.guest)) {
         if (loggedIn()) {
             next({
             path: '/',
             query: { redirect: to.fullPath }
             })
         } else {
             next()
         }
     } else {
         next() // make sure to always call next()!
     }
 })
 
 
 const app = createApp(App)
 app.config.globalProperties.$axios = axios;
 app.use(router)
 app.mount('#app')