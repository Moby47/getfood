
<template>
       
    <div >
       
        <span v-if='deleted == true'>
            <div class="item_qnty text-danger">
                        <label>DELETED</label>
                    </div>
    </span>

    <span v-if='deleted == false'>
      <span v-if='stash > 0'>
          <span v-if='online'>
          <a href="#" class="item_delete" id="cartitem1" @click.prevent='removeFromFav(con)'>
              <img src="/images/icons/black/trash.png" alt="" title="" /></a>         
              </span>
              <span v-else>
                  <a href="#" class="item_delete" id="cartitem1" @click.prevent='removeFromFavSync(con)'>
                      <img src="/images/icons/black/trash.png" alt="" title="" /></a>  
              </span>
          

      <h4 class='text-capitalize'>{{con.title}}</h4>
      <div class="shop_item_price"><strike>N</strike>{{con.amt}}</div>
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
    <v-btn  href="#" v-if="isAdded" id="addtocart" @click.prevent='removeFromCartSync(con)'>CLEAR</v-btn>

     <v-btn   href="#" v-if="!isAdded" id="addtocart" @click.prevent='addToCartSync(con)'>SELECT</v-btn>
</span>

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
            <br>
            {{loading_text}}
          </v-overlay>
        </div>
      </template>
      <!--Overlay-->

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
deleted:false,
loading_text:''
}
},

methods: {

    removeFromFav(con) {
      //
        this.overlay = !this.overlay
        this.loading_text = 'Removing Food From Favorites..'

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
             this.overlay = false        
              })
    },

    addToCart(con) {
     
                this.overlay = !this.overlay
                this.loading_text = 'Adding Food to Table..' 
                this.isAdded = !this.isAdded

                if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*10000);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                  //   console.log('created id')
                }
        var input = {'foodId':con.foodId, 'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};
                axios.post('/add-fav-to-cart',input)
                        .then(res=>{
                            if(res.data == '200 ok'){
                        this.text='Food added to Table!'
                        this.snackbar = true;
                        //update cart count
                        this.cartcount()
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

            removeFromCart(con) {
               
                this.overlay = !this.overlay
                this.loading_text = 'Removing Food From Table..' 

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
                   this.overlay = false       
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
 
    










            addToCartSync(con) {
                this.overlay = !this.overlay
                this.loading_text = 'Adding Food to Table..' 
               this.isAdded = !this.isAdded

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

var input = {id: new Date().toISOString(),'foodId':con.foodId,
 'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};

//console.log('verify for id',con)

                   this.text = 'Food queued for addition to table...'
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

saveData('sync-addToCart',input)  
          .then(res=> {
            return sw.sync.register('sync-addToCartFromFav-tag');
          })
          .then(res=> {
            console.log('sync saved');
           // alert('This food will be added to cart when internet connection is detected...')
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



            removeFromCartSync(con) {
                this.overlay = !this.overlay
                this.loading_text = 'Removing Food From Table..' 
               this.isAdded = !this.isAdded

              if ('serviceWorker' in navigator && 'SyncManager' in window) {

                   //notify after syncing => title,body,tag
  //this.displayConfirmNotification('Backgroud task created','Your food will be removed from the table', 'remove-from-cart')


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

              var input = {id: new Date().toISOString(),'foodId':con.foodId, 'userId':localStorage.getItem('tempUserCartID')};

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
            return sw.sync.register('sync-removeFromCartFromFav-tag');
          })
          .then(res=> {
            console.log('sync saved');
           // alert('This food will be added to cart when internet connection is detected...')
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





            removeFromFavSync(con) {
                this.overlay = !this.overlay
                this.loading_text = 'Removing Food From Favorites..'
               this.isAdded = !this.isAdded

              if ('serviceWorker' in navigator && 'SyncManager' in window) {

                 //notify after syncing => title,body,tag
    // this.displayConfirmNotification('Backgroud task created','The selected food will be deleted from favorites', 'del-from-fav')


                 if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*1234567890);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                   //  console.log('created id')
                }

 var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-deleteFav')) {
                db.createObjectStore('sync-deleteFav', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });

     var input = {id: new Date().toISOString(),'favId':con.id, 
     'foodId':con.foodId, 'userId':localStorage.getItem('tempUserCartID')};


          this.text = 'Food queued for deletion...'
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

saveData('sync-deleteFav',input)  
          .then(res=> {
            return sw.sync.register('sync-deleteFav-tag');
          })
          .then(res=> {
            console.log('sync saved');
           // alert('This food will be added to cart when internet connection is detected...')
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
},//total meth end

mounted(){

}

}
        </script>

