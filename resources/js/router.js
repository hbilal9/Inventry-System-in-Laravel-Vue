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
                name: 'dashboard',
                component: () => import('./views/dashboard/manager/Dashboard.vue')
            },
            {
                path: '/manager/brands',
                component: () => import('./views/dashboard/manager/Brands.vue')
            },
            {
                path: '/manager/categories',
                component: () => import('./views/dashboard/manager/Categories.vue')
            },
            {
                path: '/manager/sub-categories',
                component: () => import('./views/dashboard/manager/SubCategories.vue')
            },
            {
                path: '/manager/products',
                component: () => import('./views/dashboard/manager/Products.vue')
            },
            {
                path: '/manager/sell-products',
                component: () => import('./views/dashboard/manager/Sell_Products.vue')
            },
            {
                path: '/manager/sales',
                component: () => import('./views/dashboard/manager/Sales.vue')
            },
            {
                path: '/manager/sale-report',
                component: () => import('./views/dashboard/manager/Sales_Report.vue')
            },
            {
                path: '/manager/profile',
                component: () => import('./views/dashboard/manager/Profile.vue')
            },
        ],
        beforeEnter(to, from, next) {
            if (auth.isLoggedIn() && auth.getUserRole() === 'manager') {
                next();
            } else {
                next('/404');
            }
        }
    },
    {
        path: '/employee',
        component: () => import('./views/dashboard/Home.vue'),
        children: [
            {
                path: '',
                component: () => import('./views/dashboard/employee/Dashboard.vue')
            },
            {
                path: '/employee/products',
                component: () => import('./views/dashboard/employee/Products.vue')
            },
            {
                path: '/employee/sell-products',
                component: () => import('./views/dashboard/employee/Sell_Products.vue')
            },
            {
                path: '/employee/sales',
                component: () => import('./views/dashboard/employee/Sales.vue')
            },
            {
                path: '/employee/sale-report',
                component: () => import('./views/dashboard/employee/Sales_Report.vue')
            },
            {
                path: '/employee/profile',
                component: () => import('./views/dashboard/employee/Profile.vue')
            },
        ],
        beforeEnter(to, from, next) {
            if (auth.isLoggedIn() && auth.getUserRole() === 'employee') {
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
