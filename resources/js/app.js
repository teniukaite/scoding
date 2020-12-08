import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Tasks from './components/Tasks'
import Login from './auth/Login'
import Register from './auth/Register'
import Admin from './components/AdminPanel'
import auth from "./auth";
import admin from "./admin";
import {f} from './functions'
Vue.prototype.$f = f

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Tasks',
            component: Tasks,
            meta: {
                middleware: auth
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/logout',
            name: 'Logout',
            meta: {
                middleware: auth
            }
        },
        {
            path: '/admin',
            name: 'Admin',
            component: Admin,
            meta: {
                middleware: admin
            }
        }
    ],
});

Vue.component('spinner', require('vue-simple-spinner'));

let app = new Vue({
    router,
    render: h => h(App),
    data: {
        user: null,
        token: ''
    },
}).$mount('#app');
router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {
            from,
            next,
            router,
            to
        };
        if(to.meta.middleware.name === 'auth'){
            return auth({ ...context, next: next });
        }else if(to.meta.middleware.name === 'admin'){
            return admin({ ...context, next: next, user: app.user });
        }
    }

    return next();
});
