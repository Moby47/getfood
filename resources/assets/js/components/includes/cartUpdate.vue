
<template>
       
    <div :id='con.id'>
            <div class="item_title"> {{con.name}} </div>

            <span v-if='deleted == false'>
            <div class="item_price"><strike>N</strike>{{con.attributes.total}} </div>
            <div class="item_price" v-show='showSub'> Subtotal: <strike>N</strike>{{subtotal}} </div>
            <div class="item_thumb"><a href="#" class="close-panel">
            <v-img 
            :src="'/storage/food/'+con.attributes.image"
            :alt="con.title"
            :lazy-src="`https://picsum.photos/id/11/100/60`"
            title="" 
            class='img_size'></v-img>
            </a></div>

            <div class="item_qnty">
                <form id="myformup" method="POST" action="#">
                    <label>QUANTITY ({{con.quantity}})</label>
                    <input type="button" value="-" class="qntyminus" field="quantity" @click.prevent='decre(con)'
                     :disabled='qty==1'/>
                    <input type="text" name="quantity" :value="qty" class="qnty" /> 
                    <input type="button" value="+" class="qntyplus" field="quantity" @click.prevent='incre(con)'/>
                </form>
            </div>
            <a href="#" class="item_delete" id="cartitem1" @click.prevent='removeFromCart(con.id)'>
                <img src="/images/icons/black/trash.png" alt="" title="" /></a>         
                </span> 
            <span v-if='deleted == true'>
                    <div class="item_qnty">
                                <label>DELETED</label>
                            </div>
            </span>

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
qty:'',
deleted:false,
subtotal:'',
showSub:false,
}
},

methods: {

    removeFromCart(id) {
       
        NProgress.start();
        var input = {'foodId':id, 'userId':localStorage.getItem('tempUserCartID')};
        axios.post('/remove-from-cart',input)
                .then(res=>{
                    if(res.data == 1){
                     
                this.text='Food removed from Table!'
                        this.snackbar = true;
                         //update cart count
                         this.cartcount()
                         //rerun method to recount cart content
                         eventBus.$emit('rerun_count')
                    }
                    this.deleted = true;
                    NProgress.done();
                   
                })
                .catch(error =>{
          this.$toasted.show("Failed to remove. Try again");
            NProgress.done();        
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

    incre(con){
                NProgress.start();

                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};
                axios.post('/increase-qty',input)
                        .then(res=>{
                         //  console.log(res.data)
                            this.qty = res.data.qty
                            this.subtotal = res.data.subtotal
                            this.showSub = true
                        this.text='Table Updated!'
                        this.snackbar = true;
                            NProgress.done();
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to update. Try again");
                    NProgress.done();        
                      })
    },

    decre(con){
        NProgress.start();

var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};
axios.post('/decrease-qty',input)
        .then(res=>{
         //  console.log(res.data)
            this.qty = res.data.qty
            this.subtotal = res.data.subtotal
            this.showSub = true
        this.text='Table Updated!'
         this.snackbar = true;
            NProgress.done();
        })
        .catch(error =>{
  this.$toasted.show("Failed to update. Try again");
    NProgress.done();        
      })
    },
 
},

}
        </script>

