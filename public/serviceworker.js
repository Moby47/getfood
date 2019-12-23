importScripts('/js/idb.js');

var staticCacheName = "pwa-GF" + new Date().getTime();
var filesToCache = [
    '/',
   // '/offline',

    '/css/style.min.css',
    '/css/custom.min.css',
    '/css/wicked.min.css',

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
    '/images/home.svg',
    '/images/start.svg',
    '/images/vendor.svg',
    '/images/wifi.svg',
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
    '/js/app.js',
    
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
                .then(function(res) {
                  
                  if (res.ok) {
                    console.log('Background Sync Completed');

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
          }

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
  
  
  // ****************** lISTEN FOR NETWORK AND [POST ADD FOOD] *****

