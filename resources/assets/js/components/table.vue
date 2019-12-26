<template>
    <div class="container">
      
<!--content here-->

<div class="pages">
    <div data-page="cart" class="page no-toolbar no-navbar">
      <div class="page-content">
            <div id="pages_maincontent">
             
             <menubar></menubar>
             <br>
             <template>
                <v-card
                  class="mx-auto"
                  max-width="344"
                 
                >
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                           <li class="breadcrumb-item"><router-link to='/kitchen'>Kitchen</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page">Selected Food ({{cartConCount}})</li>
                         </ol>
                       </nav>
                </v-card>
                </template>

      <div class="page_single layout_fullwidth_padding">	
        
           <div class="cartcontainer">   
                    
              
 
                          <!--loading 
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
<div v-if='data_load' class='text-center'>
<template>
   <b>  Fetching Food</b>
  <v-progress-circular 
  color="orange"
  indeterminate
  ></v-progress-circular>
         </template>
          </div>
 </transition>
-->
   <!-- ********************************************** empty -->
  
   <template>
      <v-card
        class="mx-auto"
        max-width="344"
        
      >

      <span v-show='empty < 1'>
 
 <template>
    <v-card
      class="mx-auto"
      max-width="344"
    >
<template>
<div>
<v-alert
  color="#FFA500"
  dark
  icon="fastfood"
  border="left"
  prominent
>
Your Table is Empty. 
</v-alert>
</div>
</template>

</v-card>
</template>

 <div class="my-2 text-center ">
    <v-btn @click.prevent='shop()' class='mb-2' outlined color="#FFA500">Add Food</v-btn>   
    </div>
</span>

      <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
             <div v-if='wait' class='text-center'>
               <template> <br>
                 <span class='alert alert-primary'>Internet Connection is needed</span>
                
                        <br> <br>
                 <div class="my-2 text-center"  >
                  
          <v-btn @click.prevent='refresh()' outlined color="#FFA500">RELOAD</v-btn>   
          
          </div> <br> <br>
                         </template>
                          </div>
                 </transition>
                 
                </v-card>
              </template>

                <div class="cart_item animated tdExpandInBounce" id="cartitem1" v-for='con in content' v-bind:key='con.id'>
                   
                    <cartUpdate
                    :con=con
                    >
                    </cartUpdate>
                  
                </div>
                        
       <div class="my-2 text-center" v-show='cartConCount > 0' >
          <v-btn @click.prevent='checkout()' outlined color="#FFA500">CHECKOUT</v-btn>   
          </div>
   </div>
                
                
           </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
  
  <!--content here-->
  <template>
    <div class="text-center">
      <v-overlay :value="overlay">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
        <br>
        Loading Table...
      </v-overlay>
    </div>
  </template>


  <floatings
  :toggle_cart=toggle_cart
  v-show='cartConCount > 0'
  >
  </floatings>




    </div>
</template>


      
<script>

import {eventBus} from "../app.js";

    export default {

        data(){
            return {
              overlay:false,
                content:[],
                wait:false,
                data_load: true,
                empty:47,
                cartConCount:'',
                toggle_cart:true
            }
        },

        methods: {

          refresh(){

            this.fetch()
            this.countCartCon()

          },

          shop(){
            this.$router.push({ name: "kitchen" })
          },
          
            fetch(){
                  
                  fetch('/cart-items'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
                    //console.log(this.content)
                    this.wait = false;
                   this.empty = this.content.length;
                  })
                  .catch(error =>{
                      //off loader
                      this.data_load = false;
                        this.wait = true;
                            this.$toasted.show("No Internet connection found...");
                           
                      })

                },

                countCartCon(){
                  this.overlay = !this.overlay
                  fetch('/cartCount/'+localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.cartConCount = res;
                    this.overlay = !this.overlay
                      })
                  .catch(error =>{
                    this.overlay = false
                         
                      })

                },

                checkout(){
                  if(localStorage.getItem('userToken')){
                    //authed, proceed
                 this.$router.push({name: "checkout"});
                  }else{
                    //auth needed
                  //set variable to redirect to checkout page after guest auth
                  localStorage.setItem('shopper','shopper')
                  //send to login
                   this.$router.push({name: "login"});
                  }
                  

                }

        },

                      created(){

              eventBus.$on('rerun_count', ()=>{
                this.countCartCon()
              })


              },
        watch : {
              content(a,b){
               if(a){
                //data content loaded, it is safe to toggle_cart
                this.data_load = false;
                this.data = true;
               }
            },

        },

        mounted() {

            var online = navigator.onLine; 
            if(online){
                // online
                console.log('not online')
                 this.fetch()
             this.countCartCon()

            }else{
              this.$toasted.show("Offline mode...");
                 this.data_load = false;
                        this.wait = true;
                        this.cartConCount ='-'
                return;
            }
           
        }
    }
</script>
