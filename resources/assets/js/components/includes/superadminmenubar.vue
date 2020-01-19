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

        
 <v-list-item link @click.prevent='login()'>

          <v-list-item-action>

            <v-icon>dashboard</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Dashboard</v-list-item-title>

          </v-list-item-content>

        </v-list-item>

       



         <v-list-item link @click.prevent='verify()'>

          <v-list-item-action>

            <v-icon>account_box</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Verify Vendor</v-list-item-title>

          </v-list-item-content>

        </v-list-item>


         <v-list-item link @click.prevent='pay()'>

          <v-list-item-action>

            <v-icon>payment</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Vendor Payment</v-list-item-title>

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



<v-list-item link @click.prevent='home()'>

          <v-list-item-action>

            <v-icon>home</v-icon>

          </v-list-item-action>



          <v-list-item-content>

            <v-list-item-title >Home</v-list-item-title>

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
           home(){
 this.$router.push({name: "index"});
     },

     kitchen(){
 this.$router.push({name: "kitchen"});
     },
      login(){
 this.$router.push({name: "login"});
     },
      verify(){
 this.$router.push({name: "verify"});
     },
      pay(){
 this.$router.push({name: "payment"});
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