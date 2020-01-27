<template>
    <div class=''>
 
 <v-card
                    class="mx-auto"
                    max-width="344"
                  >

 <!--0-->
            <template>
                <v-card
                  color="grey lighten-4"
                  flat
                  tile
                >
                  <v-toolbar dense>
                    <v-btn icon  @click="sheet = !sheet">
                      <v-icon>menu</v-icon>
                    </v-btn>

       <v-toolbar-title>
         <router-link to='/'>
         <img class="logo-size" src='/images/logo/inline/getfoods-trans-1001x1001.png'
         alt='getfoods food reservation and ordering in nigeria'/>
         </router-link>
         </v-toolbar-title>

                  <!--  <v-spacer></v-spacer>

                    <v-btn icon >
                        <v-icon>search</v-icon>
                      </v-btn>
                  -->
                  </v-toolbar>
                </v-card>
              </template>

<template>

    <v-navigation-drawer

      v-model="sheet"

      app

      right

    >

      <v-list dense>

        <v-list-item link @click.prevent='home()'>

          <v-list-item-action>

            <v-icon>home</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Home</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



 <v-list-item link @click.prevent='login()' v-show='isAuth()'>

          <v-list-item-action>

            <v-icon>dashboard</v-icon>

          </v-list-item-action>


          <v-list-item-content>

            <v-list-item-title >Dashboard</v-list-item-title>

          </v-list-item-content>

        </v-list-item>


<!--

        <v-list-item link @click.prevent='login()' v-show='isAuth() && identity == 47'>

          <v-list-item-action>

            <v-icon>dashboard</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Admin Dashboard</v-list-item-title>

          </v-list-item-content>

        </v-list-item>


     <v-list-item link @click.prevent='login()' v-show='isAuth() && identity == 0'>

          <v-list-item-action>

            <v-icon>dashboard</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Customer Dashboard</v-list-item-title>

          </v-list-item-content>

        </v-list-item>


<--customer only--
        <v-list-item link @click.prevent='filter()' v-if="isAuth()" v-show='!identity'>

            <v-list-item-action>
  
              <v-icon>filter_list</v-icon>
  
            </v-list-item-action>
            <v-list-item-content>
  
              <v-list-item-title >Filter Orders</v-list-item-title>
  
            </v-list-item-content>
  
          </v-list-item>


          <!-Vendor only--
          <v-list-item link @click.prevent='add()' v-if="isAuth()" v-show='identity'>

              <v-list-item-action>
    
                <v-icon>add_shopping_cart</v-icon>
    
              </v-list-item-action>
    
    
    
              <v-list-item-content>
    
                <v-list-item-title >Add Food</v-list-item-title>
    
              </v-list-item-content>
    
            </v-list-item>
    
    
    
             <v-list-item link @click.prevent='manage()'  v-if="isAuth()" v-show='identity'>
    
              <v-list-item-action>
    
                <v-icon>edit</v-icon>
    
              </v-list-item-action>
    
    
    
              <v-list-item-content>
    
                <v-list-item-title >Manage Food</v-list-item-title>
    
              </v-list-item-content>
    
            </v-list-item>
    
            
             <v-list-item link @click.prevent='orders()' v-if="isAuth()" v-show='identity'>
    
              <v-list-item-action>
    
                <v-icon>shopping_cart</v-icon>
    
              </v-list-item-action>
    
    
    
              <v-list-item-content>
    
                <v-list-item-title >Customer Orders</v-list-item-title>
    
              </v-list-item-content>
    
            </v-list-item>
    
    
    
       <v-list-item link @click.prevent='vendorFav()' v-if="isAuth()" v-show='identity'>
    
              <v-list-item-action>
    
                <v-icon>favorite</v-icon>
    
              </v-list-item-action>
    
              <v-list-item-content>
    
                <v-list-item-title >Customer Favorites</v-list-item-title>
    
              </v-list-item-content>
    
            </v-list-item>
-->


        <v-list-item link @click.prevent='kitchen()'>

          <v-list-item-action>

            <v-icon>restaurant</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Get Food</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



         <v-list-item link @click.prevent='vendors()'>

          <v-list-item-action>

            <v-icon>fastfood</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Find Vendors</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



        <v-list-item link @click.prevent='reviews()'>

            <v-list-item-action>
  
              <v-icon>stars</v-icon>
  
            </v-list-item-action>
  
            <v-list-item-content>
  
              <v-list-item-title > Vendor Reviews</v-list-item-title>
  
            </v-list-item-content>
  
          </v-list-item>




         <v-list-item link @click.prevent='fav()'>

          <v-list-item-action>

            <v-icon>favorite</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >My Favorites</v-list-item-title>

          </v-list-item-content>



        </v-list-item>

         <v-list-item link @click.prevent='about()'>

          <v-list-item-action>

            <v-icon>perm_device_information</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >About</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



         <v-list-item link @click.prevent='share()'>

          <v-list-item-action>

            <v-icon>share</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Share</v-list-item-title>

          </v-list-item-content>

        </v-list-item>

 



         <v-list-item link @click.prevent='login()' v-show='loggedOut'>

          <v-list-item-action>

            <v-icon>settings_power</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Sign In</v-list-item-title>

          </v-list-item-content>

        </v-list-item>


 <v-list-item link @click.prevent='signup()' v-show='loggedOut'>

          <v-list-item-action>

            <v-icon>person_add</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title > Sign Up</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



         <v-list-item link @click.prevent='logout()' v-show='isAuth()'>

          <v-list-item-action>

            <v-icon>settings_power</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Logout</v-list-item-title>

          </v-list-item-content>

        </v-list-item>

      </v-list>

    </v-navigation-drawer>




</template>

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



</v-card>
      </div>
     
</template>



<script>

import {eventBus} from "../../app.js";

 export default {
  
//share icons
   data: () => ({
    loggedOut:null,
    snackbar: false,
        text: '',
        timeout: 6000,
        status:'',
        identity: false,
        sheet: false
   }),

   methods:{

    reviews(){
 this.$router.push({name: "vendorReview"});
     },
     home(){
 this.$router.push({name: "index"});
     },

     kitchen(){
 this.$router.push({name: "kitchen"});
     },
        
     vendors(){
 this.$router.push({name: "vendor"});
     },
     
     fav(){
 this.$router.push({name: "favorite"});
     },
     
     about(){
 this.$router.push({name: "about"});
     },
     
     share(){
 this.$router.push({name: "share"});
     },

     login(){
 this.$router.push({name: "login"});
     },

      signup(){
 this.$router.push({name: "register"});
     },
     add(){
 this.$router.push({name: "add"});
     },
     
     vendorFav(){
 this.$router.push({name: "favorites"});
     },
     
     manage(){
 this.$router.push({name: "edit"});
     },
     
     orders(){
 this.$router.push({name: "orders"});
     },

     filter(){
 this.$router.push({name: "filterorders"});
     },
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

                   //clear username from index
                   eventBus.$emit('clearUsername')

                      //clear tempcartid
                       localStorage.removeItem('tempUserCartID');
                       //clear cart count
                        localStorage.removeItem('cart');
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
              
                   this.isAuth();
                   this.loggedOut = true;
                   this.sheet = false
                    NProgress.done();
                    this.$router.push({name: "index"});
                    },
   },

   mounted(){
     this.isAuth()

     /*toggle view
     if(localStorage.removeItem('userStatus')){
       if(localStorage.removeItem('userStatus') == 0){
         this.identity = 0
       }else if(localStorage.removeItem('userStatus') == 1){
         this.identity = true
       }else if(localStorage.removeItem('userStatus') == 47){
          this.identity = 47
       }

     }
*/

   },
 }

</script>