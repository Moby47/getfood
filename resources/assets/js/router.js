
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import index from './components/index.vue'
import about from './components/about.vue'
import cart from './components/cart.vue'
import checkout from './components/checkout.vue'
import favorite from './components/favorite.vue'
import resendEmail from './components/auth/resendEmail.vue'
import admindashboard from './components/vendor/admindashboard.vue'
import userdashboard from './components/customer/userdashboard.vue'
import filterorders from './components/customer/filterorders.vue'
import login from './components/auth/login.vue'
import product from './components/vendor/product.vue'
import orders from './components/vendor/orders.vue'
import register from './components/auth/register.vue'
import vendorRegister from './components/auth/vendorRegister.vue'
import share from './components/share.vue'
import shop from './components/shop.vue'
import success from './components/success.vue'
import notfound from './components/notfound.vue'
import vendor from './components/vendor.vue'

export default new Router({
    mode: 'history',
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
            path: '/vendor',
            name: 'vendor',
            component: vendor,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/resend-email',
            name: 'resendemail',
            component: resendEmail,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/userdashboard',
            name: 'userdashboard',
            component: userdashboard,
             meta:{
               customer: true
            }
        },
        {
            path: '/filter-orders',
            name: 'filterorders',
            component: filterorders,
             meta:{
               customer: true
            }
        },
        {
            path: '/admindashboard',
            name: 'admindashboard',
            component: admindashboard,
             meta:{
                vendor: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: login,
             meta:{
                authPage: true
            }
        },
     
        {
            path: '/product',
            name: 'product',
            component: product,
             meta:{
                vendor: true
            }
        },
        {
            path: '/orders',
            name: 'orders',
            component: orders,
             meta:{
                vendor: true
            }
        },
        {
            path: '/register',
            name: 'register',
            component: register,
             meta:{
                authPage: true
            }
        },
        {
            path: '/vendor-register',
            name: 'vendorRegister',
            component: vendorRegister,
             meta:{
                authPage: true
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
        {
            path: '*',
            name: 'notfound',
            component: notfound,
             meta:{
              
            }
        },

    ]
})
