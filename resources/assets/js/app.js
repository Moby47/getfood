
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
Vue.use(Toasted)
// you can also pass options, check options reference below
//Vue.use(Toasted, Options)

//animate.css
require('vue2-animate/dist/vue2-animate.min.css')

//vur router
import router from './router'


//vuetify
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)


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

  

/* ------------------------URL interceptor for auth ----------------*/

 /*
//route middleware 
router.beforeEach((to, from, next) => {

        if(to.matched.some(record => record.meta.auth)){
    
if(localStorage.getItem('token')){
    //continue
    next()
}else{
    //redirect
    next({path: '/'})
} //inner if close

        }else{
         //no auth required for this page
            next()
        } //main if close

    } //func closure
) //router close
// route middleware 
 */

 /* ------------------------URL interceptor ----------------*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('index', require('./components/index.vue'));

const app = new Vue({
    el: '#app',
    router
});
