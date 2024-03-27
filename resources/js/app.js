/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import app from './app.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import LoadingPlugin from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import '../../public/css/style.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap/dist/js/bootstrap.bundle.js';
import vue3editor from 'vue3-editor';
import axios from 'axios';
import './plugins/axios';
import router from './router';
import swal from 'sweetalert2';
import LaravelVuePagination from 'laravel-vue-pagination';


const myapp = createApp(app);
window.Swal = swal;
myapp.config.globalProperties.$axios = axios;
myapp.component('Pagination',LaravelVuePagination );
myapp.use(router);
myapp.use(LoadingPlugin);
myapp.use(vue3editor);
myapp.mount('#app');
