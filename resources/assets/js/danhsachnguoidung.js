window.Vue = require('vue');

window.axios = require('axios');

Vue.component('danh-sach-nguoi-dung', require('./components/danhsachnguoidung.vue'));
const test = new Vue({
    el: '#danh-sach-nguoi-dung'
});