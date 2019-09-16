import VueRouter from 'vue-router';
import Gallery from "./views/Gallery";
import Contacts from "./views/Contacts";
import Blog from "./views/Blog";
import Cv from "./views/Cv";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Gallery
        },
        {
            path: '/blog',
            component: Blog
        },
        {
            path: '/cv',
            component: Cv
        },
        {
            path: '/contacts',
            component: Contacts
        }
    ]
});

export default router;