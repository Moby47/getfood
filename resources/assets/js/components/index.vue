<template>
    <div class="container">
       
<!--page content-->
<div class="pages">
    <div data-page="about" class="page no-toolbar no-navbar">
      <div class="page-content">
      
       <div id="pages_maincontent">
        
        <menubar></menubar>
        <br>

        <template>
            <v-card
              class="mx-auto my-12"
              max-width="374"
            >

<!--1-->
              <v-img
                class='mx-auto fadeIn'
                 src="/images/home.png"
                :lazy-src="`/images/black-spinner.gif`"
                alt='Getfoods - online food ordering and reservation system'
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
                  Get Food
                </v-btn>
              </v-card-actions>


              <v-divider class="mx-4"></v-divider>
          

              <!--2-->
           
                    <v-list-item three-line>
                     
                      <v-img
                      src="/images/dashboard.png"
                      :lazy-src="`/images/black-spinner.gif`"
                      alt='Getfoods - online food ordering and reservation system'
                    ></v-img>
                    </v-list-item>
                
                    <v-card-text class='slideUp'>
                        <v-row
                          align="center"
                          class="mx-0"
                        >
                        </v-row>
                        <div>Take advantage of the platform to make life easier.</div>
                      </v-card-text>

                    <v-card-actions>
                      <span class='text-center'>
                      <v-btn  text outlined  color="#FFA500" class='mr-1 ' @click.prevent='login()'>Get Started</v-btn>
                      </span>
                    </v-card-actions>
                 

 <v-divider class="mx-4"></v-divider>

<!--more stuff-->

  

    <!--3-->
           
                    <v-list-item three-line>
                      <v-img
                  src="/images/vendor.png"
                  alt='Getfoods - online food ordering and reservation system'
                  :lazy-src="`/images/black-spinner.gif`"
                
                >
                
                </v-img>
                    </v-list-item>
                
                    <v-card-text class='slideUp'>
                        <v-row
                          align="center"
                          class="mx-0"
                        >
                        </v-row>
                        <div>Get food from your best food vendors with ease.</div>
                      </v-card-text>

                    <v-card-actions>
                      <span class='text-center'>
                      <v-btn  text outlined  color="#FFA500" class='mr-1 ' @click.prevent='vendor()'>Food Vendors</v-btn>
                      </span>
                    </v-card-actions>
<!--
<v-divider class="mx-4"></v-divider>

 
    <v-list two-line v-for='ven in vendor_list' v-bind:key='ven.id'>
      <v-list-item @click.prevent='vendor()'>
        <v-list-item-icon>
          <v-icon color="indigo">fastfood</v-icon>
        </v-list-item-icon>

        
        <v-list-item-content class='ml-2'>
         <v-list-item-title>{{ven.name.slice(0, 45)}}</v-list-item-title>
          <v-list-item-subtitle>{{ven.address.slice(0, 45)}}...</v-list-item-subtitle>
        </v-list-item-content>
      </router-link>

      </v-list-item>
    </v-list>
 >
    <div class='text-center' v-if='vendor_list.length > 0'>
   <v-btn small text icon color='#FFA500' @click.prevent="vendors(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"><v-icon>arrow_back</v-icon></v-btn> 
   <span>{{pagination.current_page}} of {{pagination.last_page}}</span>
   <v-btn small text icon color='#FFA500'  @click.prevent="vendors(pagination.next_page_url)" :disabled="!pagination.next_page_url"><v-icon>arrow_forward</v-icon></v-btn>
  </div>
-->

<!--more stuff-->

                <!--3-->
               <foot>
               </foot>


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

import {eventBus} from "../app.js";

    export default {

         //meta
    metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: 'Welcome to GetFoods',
         meta: [{
           'name': 'description',
        'content': 'Online food reservation and ordering system',
      }],
      noscript: [
      { innerHTML: 'JavaScript is required.' }
    ]
    },
    //meta

      data: () => ({
        loading: false,
        selection: 1,
        userName:'',

      //  vendor_list:[],
      //  pagination: [],

      //menu
     // loggedOut:null,
     //   status:''
      }),
  
          created(){

    eventBus.$on('clearUsername', ()=>{

    //clear user name after logout clicked from menubar component
      console.log('logged out')
      this.userName = ''
    })


    },
      methods: {

        shop(){
            this.$router.push({ name: "kitchen" })
          },

          login(){
            this.$router.push({ name: "login" })
          },

           vendor(){
            this.$router.push({ name: "vendor" })
          },

         
    /*      
          vendors(page_url){

            if(page_url){
                  NProgress.start();
                  }
                var   page_url = page_url || '/vendor-list-home';

                //fetch vendor list
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.vendor_list = res.data;
                 
                  this.makePagination(res);

                  NProgress.done();    
                })
                .catch(error =>{
                    //off loader
                      setTimeout(func=>{
                          this.vendors();
                      },2000)     
                    })
              },

              makePagination(res){
      var pagination = {
                      current_page: res.current_page,
                      last_page: res.last_page,
                      next_page_url: res.next_page_url,
                      prev_page_url: res.prev_page_url
                       }
      this.pagination = pagination;
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

           */         

      },

      mounted() {

        //menu
         // this.isAuth()
            if(localStorage.getItem('userName')){
              this.userName = localStorage.getItem('userName') +'.'
            }

         //   this.vendors();

          }
    }
  </script>
