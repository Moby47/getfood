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
                           <li class="breadcrumb-item"><router-link to='/cart'>Table</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page" >FOOD IS READY</li>
                         </ol>
                       </nav>
           
              
      <div class="page_single layout_fullwidth_padding">
              
             
              <h4 class="checkout_title">ORDER DETAILS</h4>

                <!-- ********************************************** empty -->
                
                    <div v-show='empty < 1' class='text-center alert alert-info'>
                        Your Table is Empty. <router-link to='/shop'>Add Food</router-link>
                       </div>
         
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
                          <div class="order_item_thumb"><a href="#" class="close-panel">
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
                        <template>
                            <paystack
                                :amount="amount"
                                :email="email"
                                :paystackkey="paystackkey"
                                :reference="reference"
                                :callback="callback"
                                :close="close"
                                :embed="false"
                            >
                            <a href="#"  id='pay' class="text-center button_full btyellow">EAT</a> 
                            </paystack>
                            
                        </template>
                       

                       
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

import paystack from 'vue-paystack';

    export default {
      components: {
        paystack
    },
        data(){
            return {
              overlay:false,
                content:[],
                wait:false,
                data_load: true,
                empty:47,
                charges:'50.00',
                subtotal:0, //total food + 50
                total:0, //amount in naira
                ref:'',

                paystackkey: "pk_test_ad39cbe2a4a48182c6ef83a38736005bbec325f5",
                email: localStorage.getItem('userMail'),
                amount: 0, //total in naira * 100 = Kobo equivalent 
                
            }
        },

        computed: {
        reference(){
          let text = "";
          let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

          for( let i=0; i < 10; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

          this.ref = text
          return text;
        }
        },

        
        methods: {

          paid(){            
            

            //save to db. order TB
           var input = {'content':this.content, 'cusId':localStorage.getItem('userId')}

            axios.post('/save-order',input).then(res=>{
		
              console.log(res.data)

		      	})
      
            //clear cart

          },

          callback: function(response){
           // console.log(response)
            
           if(response.status == 'success'){
            //save to DB

             var input = {'total':this.total,'ref':response.reference, 'trans':response.trans,'cusId':localStorage.getItem('userId')}
            axios.post('/save-order',input).then(res=>{
                console.log('order saved')  
            })
            .catch(error =>{
                console.log(error)    
               })
            
            //clear cart
              var input = {'userId':localStorage.getItem('tempUserCartID')}
            axios.post('/clear-cart',input).then(res=>{
                console.log('cart cleared')  
            })
            .catch(error =>{
                console.log(error)    
               })
            

            //redirect to success page
            this.$router.push({name: "success"});

           }else{
             alert('Payment Failed')
           }
           
            
          },
          close: function(){
            console.log("Payment closed")
          },

            fetch(){
                  fetch('/checkout'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
                  //  console.log(this.content)
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
                    this.subtotal = res
                    var sum = this.subtotal + 50;
                    //amount in naira
                    this.total = sum;
                    //amount to kobo N500
                    this.amount = sum * 100;
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
