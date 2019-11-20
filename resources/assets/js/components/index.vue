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

<!--0-->
            <template>
                <v-card
                  color="grey lighten-4"
                  flat
                  tile
                >
                  <v-toolbar dense>
                    <v-btn icon>
                      <v-icon>menu</v-icon>
                    </v-btn>
                  </v-toolbar>
                </v-card>
              </template>


<!--1-->
              <v-img
                height="250"
                class='fadeIn'
                src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                :lazy-src="`https://picsum.photos/id/11/100/60`"
              ></v-img>
          
              <v-card-title class='text-capitalize'>HELLO {{userName}}</v-card-title>
          
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
                      :lazy-src="`https://picsum.photos/id/11/100/60`"
                    ></v-img>
                    </v-list-item>
                
                    <v-card-actions>
                      <span class='text-center'>
                      <v-btn  text outlined  color="#FFA500" class='mr-1 ' @click.prevent='login()'>Get Started</v-btn>
                      </span>
                    </v-card-actions>
                  </v-card>
                </template>




                <!--3-->
                <template >
                    <v-footer padless class='mt-5'>
                      <v-col
                        class="text-center"
                        cols="12"
                      >
                        {{ new Date().getFullYear() }} — <strong>HenryMoby</strong>
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
      }),
  
      methods: {

        shop(){
            this.$router.push({ name: "shop" })
          },

          login(){
            this.$router.push({ name: "login" })
          },
          
      },

      mounted() {
            if(localStorage.getItem('userName')){
              this.userName = localStorage.getItem('userName') +'.'
            }
          }
    }
  </script>
