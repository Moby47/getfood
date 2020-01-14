<template>
       
<div>
    <span v-if='stash > 0'>
        <div class="item_qnty_shop">
                <form  method="POST" action="#">
              <input :disabled='qty==1' type="button" value="-" class="qntyminusshop" field="quantity" @click.prevent='decre()'/>
                    <input type="text" name="quantity" :value="qty" class="qntyshop" />
                    <input type="button" value="+" class="qntyplusshop" field="quantity" @click.prevent='incre()'/>
                </form>
            </div>

<span v-if='online'>
        <v-btn  href="#" v-if="isAdded" id="addtocart" @click.prevent='removeFromCart(con)' >CLEAR</v-btn>

        <v-btn   href="#" v-if="!isAdded" id="addtocart" @click.prevent='addToCart(con)' >SELECT</v-btn>
</span>
<span v-else>
   <v-btn  href="#" v-if="isAdded" id="addtocart" @click.prevent='removeFromCartSync(con)' >CLEAR</v-btn>

        <v-btn   href="#" v-if="!isAdded" id="addtocart" @click.prevent='addToCartSync(con)' >SELECT</v-btn>
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


      <template>
        <div class="text-center">
          <v-overlay :value="overlay">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
            <br>
            {{loading_text}}
          </v-overlay>
        </div>
      </template>
</div>


                        
</template>

<script>

import {eventBus} from "../../app.js";

    export default {

        props: ['con','stash','online'],
//
data: function() {
    return {
        overlay:false,
        snackbar: false,
        text: '',
        timeout: 5000,
        isAdded: false,
        qty:1,
        loading_text:''
    }
},

        methods: {
          
            addToCart(con) {
              console.log(con)
        //return ;
                this.overlay = !this.overlay
               this.loading_text = 'Adding Food to Table...'

                if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*1234567890);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                   //  console.log('created id')
                }
                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};
                axios.post('/add-to-cart',input)
                        .then(res=>{
                            if(res.data.ok == '200 ok'){
                        this.text='Food added to Table!'
                       
                        this.snackbar = true;
                        this.isAdded = !this.isAdded
                        //get user cart count 
                        eventBus.$emit('cart_status')

                            }else{
                              this.text='Only '+res.data+' is currently remaining for this food'
                            this.snackbar = true;
                            }
                            this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to add. Try again");
                 // this.isAdded = !this.isAdded
                    this.overlay = false     
                      })
            },


   addToCartSync(con) {
                this.overlay = !this.overlay
               this.isAdded = !this.isAdded
               this.loading_text = 'Adding Food to Table...'
               
              
              if ('serviceWorker' in navigator && 'SyncManager' in window) {
            //notify after syncing => title,body,tag
  //this.displayConfirmNotification('Backgroud task created','Your food will be added to the table', 'add-to-cart')

                 if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*1234567890);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                   //  console.log('created id')
                }

 var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-addToCart')) {
                db.createObjectStore('sync-addToCart', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });

                var input = {id: new Date().toISOString(),'foodId':con.id, 
                'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};

           this.text = 'Food queued for addition to table...'
          this.snackbar = true


    navigator.serviceWorker.ready
      .then(function(sw) {
        
                function saveData(table, input){
                    console.log(table,input)
          return   dbPromise
          .then(function(db) {
            var tx = db.transaction(table, 'readwrite');
            var store = tx.objectStore(table);
            for(var i in input){
            store.put(input);
            }

            
            return tx.complete;
          })
          .catch(error =>{
            this.overlay = false
                  console.log(error)    
                  })
        }

saveData('sync-addToCart',input)  
          .then(res=> {
            return sw.sync.register('sync-addToCart-tag');
          })
          .then(res=> {
            console.log('sync saved');

          })
          .catch(function(err) {
            console.log(err);
          });

      });
  } else {
     this.overlay = false 
    alert('Your browser does not support this feature in offline mode');
  }
this.overlay = false 
            },









             removeFromCartSync(con) {
                this.overlay = !this.overlay
                this.isAdded = !this.isAdded
                this.loading_text = 'Removing Food from Table...'
              
              if ('serviceWorker' in navigator && 'SyncManager' in window) {

               //notify after syncing => title,body,tag
  //this.displayConfirmNotification('Backgroud task created','Your food will be removed from table', 'remove-from-cart')


                 var input = {id: new Date().toISOString(),'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};

                if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*1234567890);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                   //  console.log('created id')
                }

 var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-removeFromCart')) {
                db.createObjectStore('sync-removeFromCart', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });


 this.text = 'Food queued for removal from table...'
          this.snackbar = true

    navigator.serviceWorker.ready
      .then(function(sw) {
        
        console.log(input)
        
                function saveData(table, input){
                    console.log(table,input)
          return   dbPromise
          .then(function(db) {
            var tx = db.transaction(table, 'readwrite');
            var store = tx.objectStore(table);
            for(var i in input){
            store.put(input);
            }

            return tx.complete;
          })
          .catch(error =>{
            this.overlay = false
                  console.log(error)    
                  })
        }

saveData('sync-removeFromCart',input)  
          .then(res=> {
            return sw.sync.register('sync-removeFromCart-tag');
          })
          .then(res=> {
            console.log('sync saved');
            //alert('This food will be removed from the cart when internet connection is detected...')
          })
          .catch(function(err) {
            console.log(err);
          });

      });
  } else {
     this.overlay = false 
    alert('Ofline Mode: Not supported');
  }
this.overlay = false 
            },





            removeFromCart(con) {
               
                this.overlay = !this.overlay
                this.isAdded = !this.isAdded
                this.loading_text = 'Removing Food from Table...'
                
                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};
                axios.post('/remove-from-cart',input)
                        .then(res=>{
                            if(res.data == 1){
                                
                        this.text='Food removed from Table!'
                        this.snackbar = true;
                        //get user cart count
                        eventBus.$emit('cart_status')

                            }
                           this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to remove. Try again");
                   this.overlay = false     
                      })
            },

            incre(){
                this.qty = this.qty + 1;
                this.isAdded = false
            },
            decre(){
                this.qty = this.qty - 1;
                this.isAdded = false
            },

/*

displayConfirmNotification(title, body, tag) {
      var options = {
        body: body,
        icon: '/images/app-icons/app-icon-96x96.png',
       image: '/images/noimage.jpg',
        dir: 'ltr',
        lang: 'en-US', // BCP 47,
        vibrate: [100, 50, 200],
        badge: '/images/app-icons/app-icon-96x96.png',
        timeout: 6000,
        tag: tag,
        renotify: true,
      };
      Push.create(title, options);

  },
*/


        }
    }
</script>