<template>
    <div class="container">
        <menubar></menubar>
<!--page content-->
<div class="pages">
    <div data-page="about" class="page no-toolbar no-navbar">
      <div class="page-content">
      
       <div id="pages_maincontent">
        
        <br>
         
       
        <template>
            <v-card
              :loading="loading"
              class="mx-auto my-12"
              max-width="374"
            >



<!--1-->
              <v-img
                max-width="344"
                class='mx-auto fadeIn'
                src="/images/home.svg"
                :lazy-src="`/images/black-spinner.gif`"
              ></v-img>
          
              <v-card-title class='text-capitalize'>Hello {{userName}}</v-card-title>
          
              <v-card-text class='slideUp'>
                <v-row
                  align="center"
                  class="mx-0"
                >
              
                </v-row>
          
                <div>Reduce your waiting time, with our reliable and
                    efficient restaurant ordering / reservation system.</div>
              </v-card-text>
          
              <v-card-actions>
                <v-btn
                  text
                  @click.prevent="shop()"
                  outlined color="#FFA500"
                >
                  Enter Kitchen
                </v-btn>
              </v-card-actions>


              <v-divider class="mx-4"></v-divider>
          

              <!--2-->
              <template>
                  <v-card
                    class="mx-auto slideUp"
                    max-width="344"
                    outlined
                  >
                    <v-list-item three-line>
                     
                      <v-img
                      width="80"
                      height="200"
                      src="/images/start.svg"
                      :lazy-src="`/images/black-spinner.gif`"
                    ></v-img>
                    </v-list-item>
                
                    <v-card-actions>
                      <span class='text-center'>
                      <v-btn  text outlined  color="#FFA500" class='mr-1 ' @click.prevent='login()'>Get Started</v-btn>
                      </span>
                    </v-card-actions>
                  </v-card>
                </template>


<!--more stuff-->


<!--more stuff-->

                <!--3-->
                <template >
                    <v-footer padless class='mt-5'>
                      <v-col
                        class="text-center"
                        cols="12"
                      >
                        {{ new Date().getFullYear() }} — <strong>HenryMoby - <a href='tel:08053121695' >Contact Support </a> </strong>
                      </v-col>
                    </v-footer>
                  </template>


            </v-card>
          </template>   

          
                   

        </div>
    
      </div>
    </div>
  </div>
  <!--page content-->
  
     
    </div>
</template>



<script>
    export default {
      data: () => ({
        loading: false,
        selection: 1,
        userName:'',

       

      //menu
      loggedOut:null,
        status:''
      }),
  
      methods: {

        shop(){
            this.$router.push({ name: "shop" })
          },

          login(){
            this.$router.push({ name: "login" })
          },
          


          //menu
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
              
                   this.isAuth();
                   this.loggedOut = true;
                    NProgress.done();
                    this.$router.push({name: "index"});
                    },
                    //menu

      },

      mounted() {

        //menu
          this.isAuth()


            if(localStorage.getItem('userName')){
              this.userName = localStorage.getItem('userName') +'.'
            }
          }
    }
  </script>
