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
                        Your Table is Empty. <router-link to='/shop' class='text-center button_full btyellow'>Add Food</router-link>
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
                        <template v-if='go == true'>
                            <paystack
                                :amount="amount"
                                :email="email"
                                :paystackkey="paystackkey"
                                :reference="reference"
                                :callback="callback"
                                :close="close"
                                :embed="false"
                            >
                            <a href="#"  id='pay' class="text-center button_full btyellow slideUp">EAT</a> 
                            </paystack>
                            
                        </template>
                        
            <!--reset back to select delivery meth-->
            <a href="#" class="button_full btyellow slideUp" v-if='go == true'
             @click.prevent='back()'>Delivery Method</a> 
       
            
       <a href="#" class="button_full btyellow slideUp" v-if='choiceBtn == false' @click.prevent='self()'>Pick-up By Self</a> 
            
       <div class="form-group" v-if='addText == true'>
        <label for="exampleInputEmail1">Food Name</label>
        <input type="text" class="form-control" name='address' id="exampleInputEmail1" 
        v-model='address' v-validate='"required"' placeholder="Eg: no 47 nehita, devine homes">

        <transition  name="fadeLeft">
            <span class='text-danger shake' v-show="errors.has('address')">{{ errors.first('address') }}</span>
             </transition>
      </div>
      <a href="#" v-if='addText == true' class="button_full btyellow slideUp" @click.prevent='ok()'>Ok</a> 

       <a href="#" class="button_full btyellow slideUp" v-if='choiceBtn == false' @click.prevent='vendor()'>Vendor delivery</a> 
                       
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
                go:false,
                choiceBtn:false,
                address:'',
                addText:false,
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

          self(){
            var del = localStorage.getItem('delivery')
            if(del){
              localStorage.removeItem('delivery')
            }
            localStorage.setItem('delivery','self')
            localStorage.setItem('address', 'N/A')

            this.choiceBtn = !this.choiceBtn
            this.go = !this.go
          },

          vendor(){
            this.addText = true
            this.choiceBtn = !this.choiceBtn
          },

          ok(){
            this.$validator.validateAll().then(() => {
           
           if (!this.errors.any()) {
             //go
            var add = this.address
          localStorage.setItem('delivery','vendor')
          localStorage.setItem('address', add)
          this.addText = !this.addText
          this.go = !this.go
           }
          })

          },

          back(){
            this.go = !this.go
            //this.addText = !this.addText
            this.choiceBtn = !this.choiceBtn
          },

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
        //    if(localStorage.getItem('address') && localStorage.getItem('delivery')){
              var address = localStorage.getItem('address')
              var delivery = localStorage.getItem('delivery')
          //  }

             var input = {'total':this.total,'ref':response.reference, 'trans':response.trans,
             'cusId':localStorage.getItem('userId'), 'address':address, 'delivery':delivery,
             'tempId':localStorage.getItem('tempUserCartID')}
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
            
          //clear local sto
            localStorage.removeItem('cart')
            localStorage.removeItem('address')
            localStorage.removeItem('delivery')

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
