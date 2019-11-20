
<template>
       
    <div >
       
        <span v-if='deleted == true'>
            <div class="item_qnty text-danger">
                        <label>DELETED</label>
                    </div>
    </span>

    <span v-if='deleted == false'>
      <span v-if='stash > 0'>
          <a href="#" class="item_delete" id="cartitem1" @click.prevent='removeFromFav(con)'>
              <img src="/images/icons/black/trash.png" alt="" title="" /></a>         
              
          

      <h4>{{con.title}}</h4>
      <div class="shop_item_price"><strike>N</strike>{{con.amt}}</div>
        <div class="item_qnty_shop">
                <form id="myformfav" method="POST" action="#">
              <input :disabled='qty==1' type="button" value="-" class="qntyminusshop" field="quantity" @click.prevent='decre()'/>
                    <input type="text" name="quantity" :value="qty" class="qntyshop" />
                    <input type="button" value="+" class="qntyplusshop" field="quantity" @click.prevent='incre()'/>
                </form>
            </div>

           

        <a  href="#" v-if="isAdded" id="addtocart" @click.prevent='removeFromCart(con)' >CLEAR</a>

        <a   href="#" v-if="!isAdded" id="addtocart" @click.prevent='addToCart(con)' >RESERVE</a>
        </span>
      </span>

        <div v-if='stash < 1'>
            Out of stock
      </div>

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

                 <!--Overlay-->
  <template>
        <div class="text-center">
          <v-overlay :value="overlay">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
          </v-overlay>
        </div>
      </template>
      <!--Overlay-->

    </div>
                                
  </template>
        
        <script>

import {eventBus} from "../../app.js";

        export default {

props: ['con','stash'],
//
data: function() {
return {
    overlay:false,
    snackbar: false,
        text: '',
        timeout: 3000,
        isAdded: false,
        qty:1,
deleted:false,
}
},

methods: {

    removeFromFav(con) {
      //
        this.overlay = !this.overlay
        if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*1234567890);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                   //  console.log('created id')
                }
        var input = {'favId':con.id, 'foodId':con.foodId, 'userId':localStorage.getItem('tempUserCartID')};
       
        axios.post('/remove-from-fav',input)
                .then(res=>{
                    if(res.data == 1){
                     
                this.text='Food removed from Favorites!'
                        this.snackbar = true;
                        
                    }
                    this.deleted = true;
                     this.overlay = !this.overlay
                   
                })
                .catch(error =>{
          this.$toasted.show("Failed to remove. Try again");
             this.overlay = !this.overlay        
              })
    },

    addToCart(con) {
     
                this.overlay = !this.overlay
                this.isAdded = !this.isAdded

                if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*10000);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                  //   console.log('created id')
                }
                var input = {'foodId':con.foodId, 'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};
                axios.post('/add-fav-to-cart',input)
                        .then(res=>{
                            if(res.data == 1){
                        this.text='Food added to Table!'
                        this.snackbar = true;
                        //update cart count
                        this.cartcount()
                            }
                            this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to add. Try again");
                 // this.isAdded = !this.isAdded
                    this.overlay = !this.overlay        
                      })
            },

            removeFromCart(con) {
               
                this.overlay = !this.overlay
                this.isAdded = !this.isAdded
                var input = {'foodId':con.foodId, 'userId':localStorage.getItem('tempUserCartID')};
                axios.post('/remove-fav-from-cart',input)
                        .then(res=>{
                            if(res.data == 1){
                                
                        this.text='Food removed from Table!'
                        this.snackbar = true;
                        //update cart count
                        this.cartcount()
                            }
                           this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to remove. Try again");
                   this.overlay = !this.overlay        
                      })
            },

            cartcount(){
              //get user cart count from DB
            fetch('/cartCount/'+ localStorage.getItem('tempUserCartID'))
                .then(res => res.json())
                .then(res=>{
            var cart_count = res;
            //save to local storage
            localStorage.setItem('cart', cart_count )
            //fetch the store and append
           this.count = localStorage.getItem('cart')
                })
            },

            incre(){
                this.qty = this.qty + 1;
            },
            decre(){
                this.qty = this.qty - 1;
            },
 
},

}
        </script>

