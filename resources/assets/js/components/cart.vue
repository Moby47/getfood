<template>
    <div class="container">
      <menubar></menubar>
<!--content here-->

<div class="pages">
    <div data-page="cart" class="page no-toolbar no-navbar">
      <div class="page-content">
            <div id="pages_maincontent">
             
             <br>
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                           <li class="breadcrumb-item"><router-link to='/shop'>KITCHEN</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page">SELECTED FOOD ({{cartConCount}})</li>
                         </ol>
                       </nav>
                
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
   <v-alert
   color="blue-grey"
      dark
      dense
      icon="mdi-school"
      v-show='empty < 1'
 >
   <v-row align="center">
     <v-col class="grow">Your Table is empty.</v-col>
     <v-col class="shrink">
       <router-link to='/shop'><v-btn>GET FOOD</v-btn></router-link>
     </v-col>
   </v-row>
 </v-alert>
           
      <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
             <div v-if='wait' class='text-center'>
               <template>
                 <b>A little delay, please wait.</b>
                  <v-progress-circular 
                 color="red"
                 indeterminate
                 >
                 </v-progress-circular>
                         </template>
                          </div>
                 </transition>

                <div class="cart_item animated tdExpandInBounce" id="cartitem1" v-for='con in content' v-bind:key='con.id'>
                   
                    <cartUpdate
                    :con=con
                    >
                    </cartUpdate>
                  
                </div>
              
       <router-link to="/checkout" v-show='cartConCount > 0' class="button_full btyellow slideUp">TAKE FOOD</router-link>           
                
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
      </v-overlay>
    </div>
  </template>

    </div>
</template>

<script>
    export default {

        data(){
            return {
              overlay:false,
                content:[],
                wait:false,
                data_load: true,
                empty:47,
                cartConCount:''
            }
        },

        methods: {
            fetch(){
                  
                  fetch('/cart-items'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
                    console.log(this.content)
                    this.wait = false;
                   this.empty = this.content.length;
                  })
                  .catch(error =>{
                      //off loader
                      this.data_load = false;
                        this.wait = true;
                        setTimeout(func=>{
                            this.fetch();
                        },2000)     
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
                    this.overlay = !this.overlay
                        setTimeout(func=>{
                            this.countCartCon();
                        },2000)     
                      })

                },

        },
        watch : {
              content(a,b){
               if(a){
                //data content loaded, it is safe to display
                this.data_load = false;
                this.data = true;
               }
            },

        },

        mounted() {
            this.fetch()
            this.countCartCon()
        }
    }
</script>
