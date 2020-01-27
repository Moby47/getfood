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



 <v-list-item link @click.prevent='dash()'>

          <v-list-item-action>

            <v-icon>dashboard</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Dashboard</v-list-item-title>

          </v-list-item-content>

        </v-list-item>


  <v-list-item link @click.prevent='add()'>

          <v-list-item-action>

            <v-icon>add_shopping_cart</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Add Food</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



         <v-list-item link @click.prevent='manage()'>

          <v-list-item-action>

            <v-icon>edit</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Manage Food</v-list-item-title>

          </v-list-item-content>

        </v-list-item>

        
         <v-list-item link @click.prevent='orders()'>

          <v-list-item-action>

            <v-icon>shopping_cart</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Customer Orders</v-list-item-title>

          </v-list-item-content>

        </v-list-item>



   <v-list-item link @click.prevent='vendorFav()'>

          <v-list-item-action>

            <v-icon>favorite</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Customer Favorites</v-list-item-title>

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



        <v-list-item link @click.prevent='kitchen()'>

          <v-list-item-action>

            <v-icon>restaurant</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Get Food</v-list-item-title>

          </v-list-item-content>

        </v-list-item>






      


         <v-list-item link @click.prevent='logout()'>

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

 export default {
  
//share icons
   data: () => ({
    loggedOut:null,
    snackbar: false,
        text: '',
        timeout: 6000,
        status:'',
          sheet: false,
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
      dash(){
 this.$router.push({name: "vendordashboard"});
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
                    NProgress.done();
                    this.$router.push({name: "index"});
                    },
   },

   mounted(){
     this.isAuth()
   },
 }

</script>