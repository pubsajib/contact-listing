require('./bootstrap');
window.Vue = require('vue');
window.Bus = new Vue();
Vue.component('edit', require('./components/edit.vue').default);
Vue.component('create', require('./components/create.vue').default);
Vue.component('contacts', require('./components/contacts.vue').default);
const app = new Vue({
    el: '#app',
    // data: [
    // 	create: true,
    // 	edit:false,
    // ],
});
