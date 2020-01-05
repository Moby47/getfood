
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import index from './components/index.vue'
import about from './components/about.vue'
import table from './components/table.vue'
import checkout from './components/checkout.vue'
import favorite from './components/favorite.vue'
import resendEmail from './components/auth/resendEmail.vue'
import vendordashboard from './components/vendor/vendordashboard.vue'
import userdashboard from './components/customer/userdashboard.vue'
import filterorders from './components/customer/filterorders.vue'
import login from './components/auth/login.vue'
import add from './components/vendor/add.vue'
import orders from './components/vendor/orders.vue'
import manage from './components/vendor/manage.vue'
import edit from './components/vendor/edit.vue'
import favorites from './components/vendor/favorites.vue'
import register from './components/auth/register.vue'
import vendorRegister from './components/auth/vendorRegister.vue'
import share from './components/share.vue'
import kitchen from './components/kitchen.vue'
import success from './components/success.vue'
import notfound from './components/notfound.vue'
import vendor from './components/vendor.vue'
import privacy from './components/privacy.vue'
import terms from './components/terms.vue'

import superadmindash from './components/admin/superadmindash.vue'
import payment from './components/admin/payment.vue'
import verify from './components/admin/verify.vue'

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
            path: '/table',
            name: 'table',
            component: table,
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
            path: '/vendor/:vendorName?',
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
            path: '/vendordashboard',
            name: 'vendordashboard',
            component: vendordashboard,
             meta:{
                vendor: true
            }
        },
        {
            path: '/user-login',
            name: 'login',
            component: login,
             meta:{
                authPage: true
            }
        },
     
        {
            path: '/add-food',
            name: 'add',
            component: add,
             meta:{
                vendor: true
            }
        },
        {
            path: '/vendor-favorites',
            name: 'favorites',
            component: favorites,
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
            path: '/edit',
            name: 'edit',
            component: edit,
             meta:{
                vendor: true
            }
        },
        {
            path: '/manage-food',
            name: 'manage',
            component: manage,
             meta:{
                vendor: true
            }
        },
        {
            path: '/customer-register',
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
            path: '/kitchen',
            name: 'kitchen',
            component: kitchen,
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
            path: '/super-admin-dashboard',
            name: 'superadmindash',
            component: superadmindash,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/vendor-payment',
            name: 'payment',
            component: payment,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/verify-vendor',
            name: 'verify',
            component: verify,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/privacy',
            name: 'privacy',
            component: privacy,
             meta:{
              //  auth: true
            }
        },
        {
            path: '/terms-and-condition',
            name: 'terms',
            component: terms,
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
