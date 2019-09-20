import '../css/normilize.css';

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n'
import router from "./app/router";
import App from "./app/App";
import messages from "./locale";
Vue.use(VueRouter);
Vue.use(VueI18n);
const i18n = new VueI18n({
    locale: 'ua',
    messages,
});

new Vue({
    el: '#app',
    render: h => h(App),
    router,
    i18n
});
