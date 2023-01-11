
require('./bootstrap');
window.Vue = require('vue');
Vue.component('Contact', require('./components/frondend/ContactComponent.vue').default);
Vue.component('Booking', require('./components/frondend/BookingComponent.vue').default);
Vue.component('Book', require('./components/frondend/BookComponent.vue').default);

const app = new Vue({
    el: '#app'
});
