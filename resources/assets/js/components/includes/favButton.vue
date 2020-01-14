<template>
   <div> 
       <span v-if='online'>
            <a href="#" v-if="isFavorited" data-popup=".popup-social" class="mr-1 open-popup shopfav" @click.prevent='unFavorite(id)'>
                    <img src="/images/icons/black/menu_close.png" alt="" title="" /></a>
    
                    <a href="#" v-else data-popup=".popup-social" class="mr-1 open-popup shopfav pulse" @click.prevent='Favorite(id)'>
                       <v-img src="/images/icons/black/love.png" alt="" title=""></v-img></a>
       </span>
    <span v-else>
            <a href="#" v-if="isFavorited" data-popup=".popup-social" class="mr-1 open-popup shopfav" @click.prevent='unFavoriteSync(id)'>
                    <img src="/images/icons/black/menu_close.png" alt="" title="" /></a>
    
                    <a href="#" v-else data-popup=".popup-social" class="mr-1 open-popup shopfav pulse" @click.prevent='FavoriteSync(id)'>
                       <v-img src="/images/icons/black/love.png" alt="" title=""></v-img></a>
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
    export default {

        props: ['id','online'],
//
data(){
          return {
        snackbar: false,
        text: '',
        timeout: 3000,
        isFavorited: '',
    }
},

        methods: {
            Favorite(id) {
                this.isFavorited = true
                    //this.$toasted.clear();  
                   // this.loading = true;
                   var check = localStorage.getItem('userFavId');
                    if(check){
                        NProgress.start()
                        //Id exists, send both User and Post Id to DB
                        var userId = check;
                        var foodId = id;
        
                        var input = {'userId':userId, 'foodId':foodId};
        
                        axios.post('/add-favorite',input)
                        .then(res=>{
                            this.snackbar = true;
                            if(res.data == 1){
                               
                        this.text='Food added to Favourites!'
                        this.snackbar = true;
                        //this.fetch();
                            }else if(res.data == 0){
                        this.text='Food was already added to Favorites!'
                        this.snackbar = true;
                            }else{ 
                       this.text='Maximum limit reached. no more Favorites!'
                       this.snackbar = true;   
                       this.isFavorited = !this.isFavorited
                            }
                            NProgress.done();
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to add food. Try again"); 
                    NProgress.done();        
                      })
                        
                    }else{
                        NProgress.start();
                        //create id for user  
                    var userId = Math.floor(Math.random()*1000);
                    //store locally
                    localStorage.setItem('userFavId',userId);
                    var foodId = id;
        
                    //go to server
                    var input = {'userId':userId, 'foodId':foodId};
                    axios.post('/add-favorite',input)
                        .then(res=>{
                            if(res.data == 1){
                      
                        this.text='Food Liked!'
                        this.snackbar = true;
                            }
                            NProgress.done();
                            
                        })
                        .catch(error =>{
                            this.$toasted.show("Failed to add food. Try again"); 
                    NProgress.done();        
                      })
                    }
            },

            unFavorite(id) {
                this.isFavorited = false
                NProgress.start();

               var userId =  localStorage.getItem('userFavId',userId);
                var foodId = id;
                        var input = {'foodId':foodId,'userId':userId};
        
                        axios.post('/remove-favorite',input)
                        .then(res=>{
                            if(res.data == 1){
                        this.text='Food removed from Favourites!'
                       this.snackbar = true; 
                            }
                            NProgress.done();
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to remove food. Try again"); 
                    NProgress.done();        
                      })
            },




unFavoriteSync(id){

    this.isFavorited = false
                NProgress.start();

               var userId =  localStorage.getItem('userFavId',userId);
                var foodId = id;

    var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-unfav')) {
                db.createObjectStore('sync-unfav', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });
              
              if ('serviceWorker' in navigator && 'SyncManager' in window) {

                  //notify after syncing => title,body,tag
               //   this.displayConfirmNotification('Backgroud task created','The selected food will be removed from favorites', 'remove-from-fav')

                this.text = 'Food queued for removal from favorites...'
          this.snackbar = true

    navigator.serviceWorker.ready
      .then(function(sw) {
        
        var input = {id: new Date().toISOString(),'userId':userId, 'foodId':foodId};
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
          console.log(error)    
          })
}
console.log('call SD func')
saveData('sync-unfav',input)  

          .then(function() {
            return sw.sync.register('sync-unfav-tag');
          })
          .then(res=> {
            console.log('sync saved');
            NProgress.done(); 
          })
          .catch(function(err) {
            console.log(err);
          });
          
      });
  } else {
    alert('Ofline Mode: Not supported');
  }
    
},


            FavoriteSync(id) {
                console.log('saving fav for later')
                this.isFavorited = true
                    
                   var check = localStorage.getItem('userFavId');
                    if(check){
                        console.log('old user')
                        NProgress.start()
                        //Id exists, send both User and Post Id to DB
                        var userId = check;
                        var foodId = id;
        
        
                        var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-fav')) {
                db.createObjectStore('sync-fav', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });
              
              if ('serviceWorker' in navigator && 'SyncManager' in window) {

                  //notify after syncing => title,body,tag
  //this.displayConfirmNotification('Backgroud task created','The selected food will be added to favorites', 'add-to-fav')

                     this.text = 'Food queued for addition to favorites...'
          this.snackbar = true

    navigator.serviceWorker.ready
      .then(function(sw) {
        
        var input = {id: new Date().toISOString(),'userId':userId, 'foodId':foodId};
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
          console.log(error)    
          })
}
console.log('call SD func')
saveData('sync-fav',input)  

          .then(res=> {
            return sw.sync.register('sync-fav-tag');
          })
          .then(res=> {
            console.log('sync saved');
          //  alert('This food will be added to favorites when internet connection is detected...')
          })
          .catch(function(err) {
            console.log(err);
          });
      });
  } else {
    alert('Ofline Mode: Not supported');
  }
  NProgress.done();    




                    }else{




                        NProgress.start();
                        
        
                    console.log('new user')
                        NProgress.start()
                        
                       //create id for user  
                    var userId = Math.floor(Math.random()*1000);
                    //store locally
                    localStorage.setItem('userFavId',userId);
                    var foodId = id;
        
        
                        var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-fav')) {
                db.createObjectStore('sync-fav', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });
              
              if ('serviceWorker' in navigator && 'SyncManager' in window) {

                  //notify after syncing => title,body,tag
                 // this.displayConfirmNotification('Backgroud task created','The selected food will be added to favorites', 'add-to-fav')
                   this.text = 'Food queued for addition to favorites...'
          this.snackbar = true

    navigator.serviceWorker.ready
      .then(function(sw) {
        
        var input = {id: new Date().toISOString(),'userId':userId, 'foodId':foodId};
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
          console.log(error)    
          })
}
console.log('call SD func')
saveData('sync-fav',input)  

          .then(function() {
            return sw.sync.register('sync-fav-tag');
          })
          .then(res=> {
            console.log('sync saved');
          //  alert('This food will be added to favorites when internet connection is detected...')
          })
          .catch(function(err) {
            console.log(err);
          });
      });
  } else {
    alert('Ofline Mode: Not supported');
  }
  NProgress.done();    

                    }


                    
            },

/*
displayConfirmNotification(title, body, tag) {
    console.log('in notification function')
//if ('serviceWorker' in navigator) {
   //   console.log('SW in Nav')
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
      /*  actions: [
          { action: 'confirm', title: 'Okay', icon: '/src/images/icons/app-icon-96x96.png' },
          { action: 'cancel', title: 'Cancel', icon: '/src/images/icons/app-icon-96x96.png' }
        ]*/
   //   };
  //    Push.create(title, options);
//navigator.serviceWorker.ready
//.then(function(swreg) {
//swreg.showNotification('Backgroud task created', options);
   //     });
    //}else{
    //  console.log('No sw supp')
   // }
 /* },
*/
        },

        mounted(){
            
        }
    }
</script>