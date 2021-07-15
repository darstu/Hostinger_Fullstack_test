/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import VueRouter from 'vue-router'

//Vue.use(VueRouter)
Vue.use(Vuetify)

const opts = {}

export default new Vuetify(opts)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('register-form', require('./components/RegisterForm.vue').default);
Vue.component('login-form', require('./components/LoginForm.vue').default);
Vue.component('pcamapign-list', require('./components/PCampaignListUser.vue').default);
Vue.component('pcamapign-list-hr', require('./components/PCampaignListHR.vue').default);
Vue.component('gift-items', require('./components/GiftItems.vue').default);
Vue.component('gift-campaigns', require('./components/GiftCampaigns.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const app = new Vue({
    el: '#app',
   vuetify: new Vuetify(),
});
