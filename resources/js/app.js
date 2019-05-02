
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store'

import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

import { library } from '@fortawesome/fontawesome-svg-core';
import { faSearch, faPlus, faMinus, faSync } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faSearch, faPlus, faMinus, faSync);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.config.productionTip = false;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('header-component', require('./components/Layouts/Header').default);
Vue.component('catalog-component', require('./components/Catalog/Index').default);
Vue.component('cart-component', require('./components/Cart/Index').default);
Vue.component('product-component', require('./components/Product/IndexComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
