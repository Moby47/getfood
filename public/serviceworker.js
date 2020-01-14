importScripts('/js/idb.js');


var staticCacheName = "pwa-GF" + new Date().getTime();
var filesToCache = [
    '/',
   // '/offline',

    '/css/style.min.css',
    '/css/custom.min.css',
    '/css/wicked.min.css',
    '/css/reset.min.css',

    'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons',
    'https://unpkg.com/nprogress@0.2.0/nprogress.css',
    'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    'https://cdn.jsdelivr.net/gh/shakrmedia/tuesday@v1.1.0/build/tuesday.min.css',

    
    '/images/app-icons/app-icon-48x48.png',
    '/images/app-icons/app-icon-96x96.png',
    '/images/app-icons/app-icon-144x144.png',
    '/images/app-icons/app-icon-192x192.png',
    '/images/app-icons/app-icon-256x256.png',
    '/images/app-icons/app-icon-384x384.png',
    '/images/app-icons/app-icon-512x512.png',
    

    '/images/bullet.png',
    '/images/confused.gif',
    '/images/black-spinner.gif',
    '/images/home.png',
    '/images/dashboard.png',
    '/images/vendor.png',
    '/images/food.png',
    '/images/loader.gif',
    '/images/icons/black/food.png',
    '/images/icons/black/love.png',
    '/images/icons/black/rocket.png',
    '/images/icons/black/menu_close.png',
    '/images/icons/black/trash.png',

    'https://unpkg.com/nprogress@0.2.0/nprogress.js',
    'https://code.jquery.com/jquery-3.3.1.slim.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
    '/js/idb.js',
    //'/js/app.js', //don't cache this
    
];

var dbPromise = idb.open('getFoodsDB', 14, function (db) {
    if (!db.objectStoreNames.contains('foods')) {
      db.createObjectStore('foods', {keyPath: 'id'});
    }
    if (!db.objectStoreNames.contains('sync-fav')) {
        db.createObjectStore('sync-fav', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-unfav')) {
        db.createObjectStore('sync-unfav', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('vendor-list')) {
        db.createObjectStore('vendor-list', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-addToCart')) {
        db.createObjectStore('sync-addToCart', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-removeFromCart')) {
        db.createObjectStore('sync-removeFromCart', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('my-favs')) {
        db.createObjectStore('my-favs', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-deleteFav')) {
        db.createObjectStore('sync-deleteFav', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-addFood')) {
        db.createObjectStore('sync-addFood', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('posted-foods')) {
        db.createObjectStore('posted-foods', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-deleteFood')) {
        db.createObjectStore('sync-deleteFood', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('sync-updateFood')) {
        db.createObjectStore('sync-updateFood', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('food-likeList')) {
        db.createObjectStore('food-likeList', {keyPath: 'title'});
      }
      if (!db.objectStoreNames.contains('peter-parker')) {
        db.createObjectStore('peter-parker', {keyPath: 'id'});
      }
      if (!db.objectStoreNames.contains('user')) {
        db.createObjectStore('user', {keyPath: 'id'});
      }
  });

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {

    event.respondWith(
        caches.match(event.request)
            .then(response => {
                //return to App
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('/');
              //  return caches.match('offline');
            })
       )//respondWith
       
});




//read
function readAllData(table){
  return dbPromise.then(function(db){
    var tx = db.transaction(table, 'readonly');
    var store = tx.objectStore(table);
    return store.getAll();
  })
  .catch(error =>{
          console.log(error)    
          })
}


//clear data func
function clearAllData(table){
  return dbPromise
  .then(function(db){
      var tx = db.transaction(table, 'readwrite');
      var store = tx.objectStore(table);
      store.clear();
      return tx.complete
    })
    .catch(error =>{
        console.log(error)    
        })
  }


  //function to push to user
  function pushToUser(title,body,url,tag){

    readAllData('peter-parker')
          .then(function(data) {
              // console.log('peter-parker',data[0].pp);
              if(data[0] == undefined){
                var pId = '';
              }else{
                var pId = data[0].pp;
              }
               
              if(pId){
  //push programatically 
  fetch('https://onesignal.com/api/v1/notifications', {
   method: 'POST',
   headers: {
     'Authorization': 'Basic MWU1ZjQ5YzUtNmM0OS00MzVlLWE5ZGQtMDg2ZjYzMDcwZjE1',
     'Content-Type': 'application/json',
     'Accept': 'application/json'
   },
   body: JSON.stringify({
     'app_id':'da6349ad-e18f-471b-8d57-30444a9d158f',
     'contents': {'en': body},
     'headings': {'en': title},
     'url': url,
     'include_player_ids': [pId],
     'web_push_topic':tag,
     'chrome_web_image':'http://localhost:8000/images/push-images/completed.png',//512 or >
    'chrome_web_badge':'http://localhost:8000/images/app-icons/app-icon-96x96.png',// 72 or >
  //   'chrome_web_icon':'http://localhost:8000/images/app-icons/app-icon-192x192.png' //192 or >
   })
 })
   .then(res=> {
       console.log('push ok');
   }) 
   .catch(error =>{
         console.log(error)    
         })
              } else{
                console.log('no pId to push to')
              } 
          })
  
  }




  
// ****************** lISTEN FOR NETWORK AND [POST FAV] *****


self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-fav-tag') {
      
      event.waitUntil(
        readAllData('sync-fav')
          .then(function(data) {
            for (var dt of data) {
              
              fetch('/add-favorite', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  userId: dt.userId,
                  foodId: dt.foodId, })
              })
                .then(res=> {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');

             //read pId and push on completion #func takes title,body,url,tag
             pushToUser('Background task completed','The selected food has been added to favorites','http://localhost:8000/favorite','add-to-fav') 

                     //call clear
                clearAllData('sync-fav')
                .then(function(){
                  //gives a promise 
                })
                .catch(error =>{
                      console.log(error)    
                      })

                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }

  
          })
      );
    }
  });
  

  // ****************** lISTEN FOR NETWORK AND [POST FAV] *****



  
// ****************** lISTEN FOR NETWORK AND [POST UNFAV] *****

 
self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-unfav-tag') {
      event.waitUntil(
        readAllData('sync-unfav')
          .then(function(data) {
            
            for (var dt of data) {
              
              fetch('/remove-favorite', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  userId: dt.userId,
                  foodId: dt.foodId, })
              })
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');

                        //read pId and push on completion #func takes title,body,url,tag
  pushToUser('Background task completed','The selected food has been removed from favorites','http://localhost:8000/favorite','remove-from-fav') 

                         //call clear
                clearAllData('sync-unfav')
                .then(function(){
                  //gives a promise 
                  
                })
                .catch(error =>{
                      console.log(error)    
                      })

                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }

          
  
          })
      );
    }
  });
  

  // ****************** lISTEN FOR NETWORK AND [POST UNFAV] *****






  // ****************** lISTEN FOR NETWORK AND [POST TOCART] *****

 
self.addEventListener('sync', function(event) {
  console.log('[Service Worker] Background syncing', event);
  if (event.tag === 'sync-addToCart-tag') {
    
    //fetch post stored for sync
    //post it (send to db)
    //delete awaiting sync //clear db if res ==ok
    event.waitUntil(
      readAllData('sync-addToCart')
        .then(function(data) {
          console.log('read sync-addToCart');
          for (var dt of data) {
            
            fetch('/add-to-cart', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
              },
              body: JSON.stringify({
                userId: dt.userId,
                foodId: dt.foodId,
                qty:dt.qty,
             })
            })
              .then(function(res) {
                
                if (res.ok) {
                  console.log('Background Sync Completed');

                  
          //read pId and push on completion #func takes title,body,url,tag
  pushToUser('Background task completed','The selected food has been added to the table','http://localhost:8000/table','add-to-cart') 

                       //call clear
              clearAllData('sync-addToCart')
              .then(function(){
                //gives a promise 
                
              })
              .catch(error =>{
                    console.log('Error while clearing data',error)    
                    })

                }
              })
              .catch(function(err) {
                console.log('Error while sending data', err);
              });
          } //end foreach

        })
    );
  }
});


// ****************** lISTEN FOR NETWORK AND [POST TOCART] *****



// ****************** lISTEN FOR NETWORK AND [POST REMOVE FROM CART] *****

 
self.addEventListener('sync', function(event) {
  console.log('[Service Worker] Background syncing', event);
  if (event.tag === 'sync-removeFromCart-tag') {
    event.waitUntil(
      readAllData('sync-removeFromCart')
        .then(function(data) {
          console.log('read sync-removeFromCart');
          for (var dt of data) {
            
            fetch('/remove-from-cart', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
              },
              body: JSON.stringify({
                userId: dt.userId,
                foodId: dt.foodId,
             })
            })
              .then(function(res) {
                
                if (res.ok) {
                  console.log('Background Sync Completed');

                   //read pId and push on completion #func takes title,body,url
pushToUser('Background task completed','The selected food has been removed from the table','http://localhost:8000/table','remove-from-cart') 

                       //call clear
              clearAllData('sync-removeFromCart')
              .then(function(){
                //gives a promise 
                
              })
              .catch(error =>{
                    console.log(error)    
                    })

                }
              })
              .catch(function(err) {
                console.log('Error while sending data', err);
              });
          }

          

        })
    );
  }
});


// ****************** lISTEN FOR NETWORK AND [POST REMOVE FROM CART] *****




  // ****************** lISTEN FOR NETWORK AND [POST TOCARTFROMFAV] *****

 
  self.addEventListener('sync', function(event) {
   // console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-addToCartFromFav-tag') {
      event.waitUntil(
        readAllData('sync-addToCart')
          .then(function(data) {
          
         //   console.log('verify for id from SW',data)

            for (var dt of data) {
              
              fetch('/add-fav-to-cart', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  userId: dt.userId,
                  foodId: dt.foodId,
                  qty:dt.qty,
               })
              })
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');
  
                       //read pId and push on completion #func takes title,body,url,tag
  pushToUser('Background task completed','The selected food has been added to the table','http://localhost:8000/table','add-to-cart') 

                         //call clear
                clearAllData('sync-addToCart')
                .then(function(){
                  //gives a promise 
                  
                })
                .catch(error =>{
                      console.log(error)    
                      })
  
                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }
          
  
          })
      );
    }
  });
  
  
  // ****************** lISTEN FOR NETWORK AND [POST TOCARTFROMFAV] *****




  // ****************** lISTEN FOR NETWORK AND [POST REMOVE FROM CART FROM FAV] *****

 
self.addEventListener('sync', function(event) {
  console.log('[Service Worker] Background syncing', event);
  if (event.tag === 'sync-removeFromCartFromFav-tag') {
    
    //fetch post stored for sync
    //post it (send to db)
    //delete awaiting sync //clear db if res ==ok
    event.waitUntil(
      readAllData('sync-removeFromCart')
        .then(function(data) {
          console.log('read sync-removeFromCart');
          for (var dt of data) {
            
            fetch('/remove-fav-from-cart', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
              },
              body: JSON.stringify({
                userId: dt.userId,
                foodId: dt.foodId,
             })
            })
              .then(function(res) {
                
                if (res.ok) {
                  console.log('Background Sync Completed');

                  //read pId and push on completion #func takes title,body,url
  pushToUser('Background task completed','The selected food has been removed from the table','http://localhost:8000/table','remove-from-cart') 

                       //call clear
              clearAllData('sync-removeFromCart')
              .then(function(){
                //gives a promise 
                
              })
              .catch(error =>{
                    console.log(error)    
                    })

                }
              })
              .catch(function(err) {
                console.log('Error while sending data', err);
              });
          }
  
        })
    );
  }
});


// ****************** lISTEN FOR NETWORK AND [POST REMOVE FROM CART FROM FAV] *****






  // ****************** lISTEN FOR NETWORK AND [POST REMOVE FAV] *****

 
  self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-deleteFav-tag') {
      
      event.waitUntil(
        readAllData('sync-deleteFav')
          .then(function(data) {
            console.log('read sync-deleteFav');
            for (var dt of data) {
              fetch('/remove-from-fav', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  favId: dt.favId,
                  userId: dt.userId,
                  foodId: dt.foodId,
               })
              })
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');
  
                       //read pId and push on completion #func takes title,body,url
  pushToUser('Background task completed','The selected food has been deleted from favorites','http://localhost:8000/favorite','del-from-fav') 

                         //call clear
                clearAllData('sync-deleteFav')
                .then(function(){
                  //gives a promise 
                  
                })
                .catch(error =>{
                      console.log(error)    
                      })
  
                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }
  
         
          })
      );
    }
  });
  
  
  // ****************** lISTEN FOR NETWORK AND [POST REMOVE  FAV] *****




  
  // ****************** lISTEN FOR NETWORK AND [POST ADD FOOD] *****

 
  self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-addFood-tag') {
      
      event.waitUntil(
        readAllData('sync-addFood')
          .then(function(data) {
            console.log('read sync-addFood');
            for (var dt of data) {
              fetch('/new-food', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  food: dt.food,
                  price: dt.price,
                  vendorId: dt.vendorId,
                  vendorName: dt.vendorName,
                  address: dt.address,
                  img: dt.img,
                  quantity: dt.quantity,
               })
              })
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');
  
                      //read pId and push on completion #func takes title,body,url
  pushToUser('Background task completed','Your food has been added to kitchen','http://localhost:8000/manage-food','add-to-kitchen') 

                         //call clear
                clearAllData('sync-addFood')
                .then(function(){
                  //gives a promise 
                  
                })
                .catch(error =>{
                      console.log(error)    
                      })
  
                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }
           
  
          })
      );
    }
  });
  
  
  // ****************** lISTEN FOR NETWORK AND [POST ADD FOOD] *****


   
  // ****************** lISTEN FOR NETWORK AND [DELETE FOOD] *****

 
  self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-deleteFood-tag') {
      
      event.waitUntil(
        readAllData('sync-deleteFood')
          .then(function(data) {
            console.log('read sync-deleteFood');
            for (var dt of data) {
              fetch('/delete-food', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  id: dt.id,
               })
              })
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');
  
                    //read pId and push on completion #func takes title,body,url
  pushToUser('Background task completed','The selected food has been removed kitchen','http://localhost:8000/manage-food','remove-from-kitchen') 

                         //call clear
                clearAllData('sync-deleteFood')
                .then(function(){
                  //gives a promise 
                  
                })
                .catch(error =>{
                      console.log(error)    
                      })
  
                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }
  
          })
      );
    }
  });
  
  
  // ****************** lISTEN FOR NETWORK AND [DELETE FOOD] *****





  
  
  // ****************** lISTEN FOR NETWORK AND [POST UPDATE FOOD] *****

 
  self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing');
    if (event.tag === 'sync-updateFood-tag') {
      
      event.waitUntil(
        readAllData('sync-updateFood')
          .then(function(data) {
            console.log('data',data);
            for (var dt of data) {
              fetch('/edit-food', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  id: dt.id,
                  food: dt.food,
                  price: dt.price,
                  vendorId: dt.vendorId,
                  vendorName: dt.vendorName,
                  address: dt.address,
                  img: dt.img,
                  quantity: dt.quantity,
               })
              })
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');
                    
 //read pId and push on completion #func takes title,body,url
 pushToUser('Background task completed','The edited food has updated successfully','http://localhost:8000/manage-food','add-to-kitchen') 

                         //call clear
                clearAllData('sync-updateFood')
                .then(function(){
                  //gives a promise 
                  
                })
                .catch(error =>{
                      console.log(error)    
                      })
  
                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }
   
          })
      );
    }
  });
  
  
  // ****************** lISTEN FOR NETWORK AND [POST update FOOD] *****



/*
  // ****************** FUNCTION TO ADD IMPORTANT DYNAMIC CONTENTS TO INDEXED DB IN THE BACKGROUD ********
  function dbSync(table,url,apiRes = 0){

    console.log('connecting to db')
      var dbPromise = idb.open('getFoodsDB', 14, function (db) {
    if (!db.objectStoreNames.contains(table)) {
      db.createObjectStore(table, {keyPath: 'id'});
    }
  });

    //fetch data
    fetch(url)
    .then(res => res.json())
    .then(res=>{

      //check if res is API
      if(apiRes == 0){
        var data = res;
      }else{
        var data = res.data;
      }
      
      console.log('fetched data',data)

       //call clear then save
    clearAllData(table)
    .then(function(){
      //gives a promise for saving
      console.log('table cleared')

      for(var key in data){
    console.log('data keys to save:',key)
      dbPromise
  .then(function(db) {
    var tx = db.transaction(table, 'readwrite');
    var store = tx.objectStore(table);
    for(var i in data){
    store.put(data[i]);
    }
    console.log('saved to indexdb')
    return tx.complete;
  })
  .catch(error =>{
          console.log(error)    
          })
  }
    })
    .catch(error =>{
          console.log(error)    
          })
    })
     .then(res=>{
      console.log('fetched ok! from '+url)  
    })
    .catch(error =>{
        console.log(error)    
        })

  } //end of clear and write data
  // ****************** FUNCTION TO ADD IMPORTANT DYNAMIC CONTENTS TO INDEXED DB IN THE BACKGROUD ********


// function calls for indexed DB
  dbSync('vendor-list','/vendor-list')
  dbSync('foods','/offline-foods','1')
  */