<template>
    <div class="container">
      <menubar></menubar>
<!--content here-->

<div class="pages">
    <div data-page="checkout" class="page no-toolbar no-navbar">
      <div class="page-content">
      
            
            <div id="pages_maincontent">
             
             <br>
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                           <li class="breadcrumb-item"><router-link to='/cart'>TABLE</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page" >FOOD IS READY</li>
                         </ol>
                       </nav>
           
              
      <div class="page_single layout_fullwidth_padding">
              
             
              <h4 class="checkout_title">ORDER DETAILS</h4>

                <!-- ********************************************** empty -->
                <span v-show='empty < 1' class='text-center'>
          <div class='alert alert-info'>NO FOOD TO EAT. <router-link to='/shop'>get food</router-link></div>  
         </span>
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
                    
          
                                       
              <!--loading temp-->
        <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='wait' class='text-center'>
                       <template>
                         <b>little delay, please wait.</b>
                          <v-progress-circular 
                         color="red"
                         indeterminate
                         >
                         </v-progress-circular>
                                 </template>
                                  </div>
                         </transition>


                      <div class="order_item animated tdExpandInBounce" v-for='con in content' v-bind:key='con.id'>
                          <div class="order_item_thumb"><a href="shop-item.html" class="close-panel">
                            </a></div>
                          <div class="order_item_title"><span>{{con.quantity}} X</span> {{con.name}}</div>
                          <div class="order_item_price"><strike>N</strike>{{con.attributes.total}}</div>           
                      </div>
                      
        
                 
                 <span v-show='subtotal > 0' class=''>
                <h4 class="checkout_title">TOTAL</h4>      
                        <div class="carttotal_full slideUp">
                            <div class="carttotal_row_last">
                   <div class="carttotal_left">SERVICE CHARGE</div> <div class="carttotal_right"><strike>N</strike>{{charges}}</div>
                            <div class="carttotal_left">SUBTOTAL</div> <div class="carttotal_right"><strike>N</strike> {{subtotal}}</div>
                           
                     <div class="carttotal_left ">TOTAL</div> <div class="carttotal_right text-success"><strike>N</strike> {{total}}</div>
                            </div>
                        </div> 
                        <!--show only if cart::exist-->
                        <router-link to="/success"  class="button_full btyellow">EAT</router-link> 
                </span>
   
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
                charges:'50.00',
                subtotal:0, //total food + 50
                total:0, //amount to pay
            }
        },

        methods: {
            fetch(){
                  fetch('/checkout'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
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

                },//

                getSumTotal(){
                  this.overlay = !this.overlay
                  fetch('/sumtotal'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    console.log(res)
                    this.subtotal = res
                    this.total =this.subtotal + 50;
                    this.overlay = !this.overlay
                  })
                  .catch(error =>{
                    this.overlay = !this.overlay
                        setTimeout(func=>{
                            this.getSumTotal();
                        },2000)     
                      })
                },//

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
           this.getSumTotal()
        }
    }
</script>
