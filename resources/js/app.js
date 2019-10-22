require('./bootstrap');

window.Vue = require('vue');

Vue.component('app', require('../js/App.vue').default);

const app = new Vue({
    el: '.container'
});

