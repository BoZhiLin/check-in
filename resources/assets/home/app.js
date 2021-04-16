/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import router from './router/index.js';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueDatetime from "vue-datetime";
import VueTimepicker from 'vue2-timepicker'
import VueSwal from 'vue-sweetalert2';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue-datetime/dist/vue-datetime.css';
import 'vue2-timepicker/dist/VueTimepicker.css';
import 'sweetalert2/dist/sweetalert2.min.css';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueDatetime);

Vue.use(VueSwal, {
    confirmButtonColor: "#007bff",
    cancelButtonColor: "#dc3545"
});

Vue.component('vue-timepicker', VueTimepicker);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});