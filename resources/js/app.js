require('./bootstrap');

Vue.component('create-form', require('./vue/create-form.vue').default);

import Vue from 'vue'
import EditForm from './vue/edit-form'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false


const app = new Vue({
    el: '#app',
    components: { EditForm }
});