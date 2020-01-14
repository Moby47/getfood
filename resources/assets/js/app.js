
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/* ------------------------- Imports -------------------- */

//vee validate
import Vue from 'vue';
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

//toated
// register the plugin on vue
import Toasted from 'vue-toasted';
Vue.use(Toasted, {
    duration: 7000
})
// you can also pass options, check options reference below
//Vue.use(Toasted, Options)



//animate.css
require('vue2-animate/dist/vue2-animate.min.css')

//vur router
import router from './router'


//vuetify
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

//Vue.use(Vuetify)

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
//import './custom.scss'

//metatag
import Meta from 'vue-meta'
Vue.use(Meta)

/* ------------------------- Imports -------------------- */


/* ------------------------URL interceptor for progressbar ----------------*/

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
  })
  
  router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
   NProgress.done()
  })

  /* ------------------------URL interceptor for progressbar ----------------*/

  

/* ------------------------URL interceptor  ----------------*/

 
//route middleware 
router.beforeEach((to, from, next) => {

        if(to.matched.some(record => record.meta.customer)){
    /***************** redirect if not auth customer********* */
    if(localStorage.getItem('userToken')){
        //continue
        if(localStorage.getItem('userStatus') == 0){
            next()
        }else{
            next({path: '/userdashboard'})
        }        
    }else{
        //redirect
        next({path: '/'})
    } //inner if close
        /************************** */

 }else if(to.matched.some(record => record.meta.vendor)){
      /***************** redirect if not auth customer********* */
    if(localStorage.getItem('userToken')){
        //continue
        if(localStorage.getItem('userStatus') == 1){
            next()
        }else{
            next({path: '/vendordashboard'})
        }        
    }else{
        //redirect
        next({path: '/'})
    } //inner if close
        /************************** */
      
 }else if(to.matched.some(record => record.meta.authPage)){
        /************reirect if auth************** */
    if(localStorage.getItem('userToken')){
        //continue
        if(localStorage.getItem('userStatus') == 1){
        next({path: '/vendordashboard'})
        }else if(localStorage.getItem('userStatus') == 0){
            next({path: '/userdashboard'})  
        }else if(localStorage.getItem('userStatus') == 47){
            next({path: '/super-admin-dashboard'})
        }
    }else{
        //redirect
        next()
    } //inner if close
        /************************** */
}else{
    /*********No redirect, just go on***************** */
 next() 

  }
        

    } //func closure
) //router close
// route middleware 
 

 /* ------------------------URL interceptor ----------------*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export const eventBus = new Vue();

Vue.component('index', require('./components/index.vue'));
Vue.component('menubar', require('./components/includes/menubar.vue'));
Vue.component('vendormenubar', require('./components/includes/vendormenubar.vue'));
Vue.component('usermenubar', require('./components/includes/usermenubar.vue'));
Vue.component('superadminmenubar', require('./components/includes/superadminmenubar.vue'));
Vue.component('favButton', require('./components/includes/favButton.vue'));
Vue.component('cartAdd', require('./components/includes/cartAdd.vue'));
Vue.component('cartUpdate', require('./components/includes/cartUpdate.vue'));
Vue.component('favUpdate', require('./components/includes/favUpdate.vue'));
Vue.component('floatings', require('./components/includes/floatings.vue'));
Vue.component('back', require('./components/includes/back.vue'));
Vue.component('foot', require('./components/includes/foot.vue'));
Vue.component('confirmBtn', require('./components/includes/confirmBtn.vue'));

const vuetifyOptions = { }
Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(vuetifyOptions)
});
