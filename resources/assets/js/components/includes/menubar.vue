<template>
    <div class=''>
    <nav class="navbar navbar-expand-lg navbar-light bg-light radius menu-over">
        <router-link class="navbar-brand" to="/">GetFoods</router-link>

    <!--    <v-btn class="ma-2" text>
             <router-link to='/checkout'> <v-icon color="orange darken-2">shopping_cart</v-icon></router-link>
            </v-btn>
-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item" v-if='loggedOut == false'>
                  <router-link v-if='status == 0' class="nav-link" to='/userdashboard'>Dashboard</router-link>
                  <router-link v-if='status == 1' class="nav-link" to='/admindashboard'>Dashboard</router-link>
                </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/shop">Enter Kitchen</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/favorite">My Favorite</router-link>
              </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/about">About Getfoods</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/share">Tell a Friend</router-link>
              </li>
              <li class="nav-item" v-if='loggedOut == true'>
                <router-link class="nav-link" to="/login">Login</router-link>
              </li>
              <li class="nav-item" v-if='loggedOut == false'>
                <a class="nav-link" @click.prevent="logout()">Log Out</a>
              </li>
              <li class="nav-item">
                <a href='tel:08053121695' class="nav-link" >Contact Developer</a>
              </li>
          </ul>
         
        </div>
      </nav>

      <template>
        <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      >
      {{ text }}
      <v-btn
        color="#FFA500"
        text
        @click='snackbar=!snackbar'
      >
        Close
      </v-btn>
      </v-snackbar>
      </template>

      </div>
     
</template>



<script>

 export default {
  
//share icons
   data: () => ({
    loggedOut:null,
    snackbar: false,
        text: '',
        timeout: 6000,
        status:''
   }),

   methods:{
          //meth to check Auth
                      isAuth(){
                    if(localStorage.getItem('userToken')){
                      this.loggedOut = false;
                      this.status = localStorage.getItem('userStatus');
                          return true;
                    }else{
                      this.loggedOut = true;
                          return false;
                    }
                     },

                     logout(){
                        NProgress.start()
                   localStorage.removeItem('userToken');
                   localStorage.removeItem('userId');
                   localStorage.removeItem('userName');
                   localStorage.removeItem('userMail');
                   localStorage.removeItem('userStatus');
                      //clear tempcartid
                       localStorage.removeItem('tempUserCartID');
                   //clear cart
                   if(localStorage.getItem('tempUserCartID')){
                    var input = {'userId':localStorage.getItem('tempUserCartID')}
            axios.post('/clear-cart',input).then(res=>{
                console.log('cart cleared')  
            })
            .catch(error =>{
                console.log(error)    
               })
                   }
              
                   sound.play();
                   this.isAuth();
                   this.loggedOut = true;
                    NProgress.done();
                    this.$router.push({name: "index"});
                    },
   },

   mounted(){
     this.isAuth()
   },
 }

</script>