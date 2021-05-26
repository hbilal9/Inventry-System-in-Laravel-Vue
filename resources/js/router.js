import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
import * as auth from './services/auth_service';
import store from './store';

Vue.use(Router);

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/admin',
        component: () => import('./views/dashboard/Home.vue'),
        children: [
            {
                path: '',
                name: 'dashboard',
                component: () => import('./views/dashboard/admin/Dashboard.vue')
            },
            {
                path: '/admin/brands',
                component: () => import('./views/dashboard/admin/Brands.vue')
            },
            {
                path: '/admin/categories',
                component: () => import('./views/dashboard/admin/Categories.vue')
            },
            {
                path: '/admin/sub-categories',
                component: () => import('./views/dashboard/admin/SubCategories.vue')
            },
            {
                path: '/admin/products',
                component: () => import('./views/dashboard/admin/Products.vue')
            },
            {
                path: '/admin/sell-products',
                component: () => import('./views/dashboard/admin/Sell_Products.vue')
            },
            {
                path: '/admin/sales',
                component: () => import('./views/dashboard/admin/Sales.vue')
            },
            {
                path: '/admin/sale-report',
                component: () => import('./views/dashboard/admin/Sales_Report.vue')
            },
            {
                path: '/admin/profile',
                component: () => import('./views/dashboard/admin/Profile.vue')
            },
        ],
        beforeEnter(to, from, next) {
            if (auth.isLoggedIn() && auth.getUserRole() === 'admin') {
                next();
            } else {
                next('/404');
            }
        }
    },
    {
        path: '/manager',
        component: () => import('./views/dashboard/Home.vue'),
        children: [
            {
                path: '',
                component: () => import('./views/dashboard/manager/Dashboard.vue')
            },
        ],
        beforeEnter(to, from, next) {
            if (auth.isLoggedIn() && auth.getUserRole() === 'manager') {
                next();
            } else {
                next('/dashboard/login');
            }
        }
    },
    {
        path: '/dashboard/login',
        name: 'login',
        component: () => import('./views/dashboard/Authentication.vue'),
    },
    {
        path: '*',
        name: '404',
        component: () => import('./views/404.vue')
    }
];

const router = new Router({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active'
});

router.beforeResolve((to, from, next) => {
    store.state.mainMenuStatus = false;
    next();
});

router.afterEach((to, from) => {
    store.state.mainMenuStatus = false;
});

export default router;
