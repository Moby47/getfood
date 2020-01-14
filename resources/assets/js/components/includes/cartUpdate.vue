
<template>
       
    <div>

        <template>
                
            <template>
              <span class='pt-4'>
                <v-card
                  class="mx-auto elevation-23"
                  max-width="344"
                >
        <div class="shop_thumb">
            <v-img 
            :src="'/storage/food/'+con.attributes.image"
            :alt="con.title"
            :lazy-src="`/images/black-spinner.gif`"
            title="con.name"
            class='img_size' ></v-img>
        </div>
        <div class="shop_item_details">
            <h4 class="text-capitalize">{{con.name}} ({{con.quantity}}<span v-show='qtyCount'>=>{{qtyCount}}</span>)</h4> 
   <div class="shop_item_price"><strike>N</strike>{{con.attributes.total}} 
    <span v-show='showSub'> => <strike>N</strike>{{subtotal}} </span></div>
           
            <template>
                <div>
                    <span>
                        <div class="item_qnty_shop">
      <form  method="POST" action="#">
 <input :disabled='qty==1 || qty==0' type="button" value="-" class="qntyminusshop" field="quantity" @click.prevent='decre()'/>
          <input type="text" name="quantity" :value="qty" class="qntyshop" />
 <input type="button" value="+" class="qntyplusshop" field="quantity" @click.prevent='incre()'/>
       </form>
          </div>
                <span>
    <v-btn   href="#"  id="addtocart" @click.prevent='update(con)' >UPDATE</v-btn>
                </span>
                        </span>
                </div>                     
                </template>
                

                <template>
                    <div> 
                        <span>
  <a href="#" data-popup=".popup-social" class="mr-1 open-popup shopfav pulse" @click.prevent='removeFromCart(con)'>
        <v-img src="/images/icons/black/trash.png" alt="" title=""></v-img></a>

                        </span>
                      
                       </div>                  
                 </template>

        
        </div>

     
        </v-card>
              </span>
        </template>

        </template>

            <!--content here-->
  <template>
      <div class="text-center">
        <v-overlay :value="overlay">
          <v-progress-circular indeterminate size="64"></v-progress-circular>
          <br>
          {{loading_text}}
        </v-overlay>
      </div>
    </template>
  
    <template>
        <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      >
      {{ text }}
      <v-btn
        color="blue"
        text
        @click='snackbar=!snackbar'
      >
        Close
      </v-btn>
      </v-snackbar>
      </template>
    </div>
                                
  </template>
        
        <script>

import {eventBus} from "../../app.js";

        export default {

props: ['con'],
//
data: function() {
return {
    snackbar: false,
        text: '',
        timeout: 3000,
        qty:0,
        overlay:false,
        loading_text:'Loading Table...',
        subtotal:'',
         showSub:false,
         qtyCount:''
}
},

methods: {

  update(con){
        console.log(con)
        this.overlay = !this.overlay
               this.loading_text = 'Updating Food...'

                if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*1234567890);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                   //  console.log('created id')
                }
                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};
                axios.post('/add-to-cart',input)
                        .then(res=>{
                            if(res.data.ok == '200 ok'){
                        this.text='Food updated!'
                        this.subtotal = res.data.subtotal
                       this.showSub = true
                        this.snackbar = true;
                      //  update new qty
                     this.qtyCount = res.data.qty

                            }else{
                              this.text='Only '+res.data+' is currently remaining for this food'
                            this.snackbar = true;
                            }
                            this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to update food. please refresh and try again");
                 // this.isAdded = !this.isAdded
                    this.overlay = false     
                      })
          },

          incre(){
                this.qty = this.qty + 1;
               // this.isAdded = false
            },
            decre(){
                this.qty = this.qty - 1;
             //   this.isAdded = false
            },

          removeFromCart(con) {
        console.log(con.id)
            var dialog =  confirm('You are about to delete '+con.name+' from table');

            if(dialog){
 NProgress.start();
       var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};
       axios.post('/remove-from-cart',input)
               .then(res=>{
                   if(res.data == 1){
                    
               this.text='Food removed from Table!'
                       this.snackbar = true;
                        //update cart count
                        this.cartcount()

                      //  to re-fetch
                      eventBus.$emit('refetch')
                     
                   }
                //   this.deleted = true;
                   NProgress.done();
               })
               .catch(error =>{
         this.$toasted.show("Failed to remove. Try again");
           NProgress.done();        
             })
            }
       
      
   },

   cartcount(){
              //get user cart count from DB
            fetch('/cartCount/'+ localStorage.getItem('tempUserCartID'))
                .then(res => res.json())
                .then(res=>{
            this.cartConCount = res;
            console.log(this.cartConCount)
         
                })
            },
},

}
        </script>

