import '../css/normilize.css';

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from "./app/router";
import App from "./app/App";
Vue.use(VueRouter);

new Vue({
    el: '#app',
    render: h => h(App),
    router
});
