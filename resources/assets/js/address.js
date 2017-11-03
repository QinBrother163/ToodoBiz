require('./bootstrap');


Vue.component('trade-address', require('./components/trade/Address.vue'));

const app = new Vue({
    el: '#app',
});