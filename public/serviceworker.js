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
    

    '/bullet.png',
    '/confused.gif',
    '/black-spinner.gif',
    '/home.svg',
    '/start.svg',
    '/vendor.svg',
    '/loader.gif',
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

var dbPromise = idb.open('getFoodsDB', 1, function (db) {
    if (!db.objectStoreNames.contains('foods')) {
      db.createObjectStore('foods', {keyPath: 'id'});
    }
    if (!db.objectStoreNames.contains('sync-posts')) {
        db.createObjectStore('sync-posts', {keyPath: 'id'});
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




self.addEventListener('sync', function(event) {
    console.log('[Service Worker] Background syncing', event);
    if (event.tag === 'sync-new-posts') {
      console.log('[Service Worker] Syncing new Posts');
    /*  event.waitUntil(
        readAllData('sync-posts')
          .then(function(data) {
            for (var dt of data) {
              fetch('https://pwagram-99adf.firebaseio.com/posts.json', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  id: dt.id,
                  title: dt.title,
                  location: dt.location,
                  image: 'https://firebasestorage.googleapis.com/v0/b/pwagram-99adf.appspot.com/o/sf-boat.jpg?alt=media&token=19f4770c-fc8c-4882-92f1-62000ff06f16'
                })
              })
                .then(function(res) {
                  console.log('Sent data', res);
                  if (res.ok) {
                    deleteItemFromData('sync-posts', dt.id); // Isn't working correctly!
                  }
                })
                .catch(function(err) {
                  console.log('Error while sending data', err);
                });
            }
  
          })
      );*/
    }
  });
  