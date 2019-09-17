
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import index from './components/index.vue'
import about from './components/about.vue'
import cart from './components/cart.vue'
import checkout from './components/checkout.vue'
import favorite from './components/favorite.vue'
import forgot from './components/forgot.vue'
import history from './components/vendor/history.vue'
import history2 from './components/customer/history2.vue'
import login from './components/auth/login.vue'
import order from './components/customer/order.vue'
import product from './components/vendor/product.vue'
import register from './components/auth/register.vue'
import share from './components/share.vue'
import shop from './components/shop.vue'
import success from './components/success.vue'
//import history from './components/history.vue'

export default new Router({
    routes: [
        {
            path: '/',
            name: 'index',
            component: index,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/about',
            name: 'about',
            component: about,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/cart',
            name: 'cart',
            component: cart,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: checkout,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/favorite',
            name: 'favorite',
            component: favorite,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/forgot',
            name: 'forgot',
            component: forgot,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/history',
            name: 'history',
            component: history,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/history2',
            name: 'history2',
            component: history2,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: login,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/order',
            name: 'order',
            component: order,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/product',
            name: 'product',
            component: product,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/register',
            name: 'register',
            component: register,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/share',
            name: 'share',
            component: share,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/shop',
            name: 'shop',
            component: shop,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/success',
            name: 'success',
            component: success,
             meta:{
              //  auth: true
            }
        },
    ]
})
