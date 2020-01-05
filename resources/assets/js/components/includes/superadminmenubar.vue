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
    
     <!--sheet / menu-->
    <template>
      <div class="text-center">
        <v-bottom-sheet v-model="sheet">
          <v-sheet class="text-center" height="465px">
           
           
              <v-list>
    
        
    
    <!--dashboard-->
    <span v-if='loggedOut == false'>
        <v-list-item
         @click="sheet = false"
            >
              <v-list-item-avatar>
                <v-avatar size="32px" tile>
                  <v-icon>dashboard</v-icon>
                </v-avatar>
              </v-list-item-avatar>
        
          <router-link to='/super-admin-dashboard' v-if='status == 47'>
              <v-list-item-title>Dashboard</v-list-item-title>
        </router-link>
            </v-list-item>
    </span>
    
    
    
    <!--looped menu-->
            <v-list-item
              v-for="tile in tiles"
              :key="tile.title"
              @click="sheet = false"
            >
              <v-list-item-avatar>
                <v-avatar size="32px" tile>
                  <v-icon>{{tile.img}}</v-icon>
                </v-avatar>
              </v-list-item-avatar>
    
        <router-link :to='tile.link'>
              <v-list-item-title>{{ tile.title }}</v-list-item-title>
        </router-link>
    
            </v-list-item>
    <!--looped menu-->
    
    <!--login/out-->
        <v-list-item
         @click="sheet = false"
            >
              <v-list-item-avatar>
                <v-avatar size="32px" tile>
                  <v-icon>settings_power</v-icon>
                </v-avatar>
              </v-list-item-avatar>
        <router-link to='/user-login' v-if='loggedOut == true'>
              <v-list-item-title>Login</v-list-item-title>
        </router-link>
          <a href='#' @click.prevent="logout()" v-if='loggedOut == false'>
              <v-list-item-title>Logout</v-list-item-title>
        </a>
            </v-list-item>
    
          </v-list>
    
    
          </v-sheet>
        </v-bottom-sheet>
      </div>
    </template>
    <!--sheet / menu-->
    
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
          tiles: [
            { img: 'account_box', title: 'Verify Vendor', link:'/verify-vendor' },
            { img: 'payment', title: 'Vendor Payments', link:'/vendor-payment'},
          ],
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