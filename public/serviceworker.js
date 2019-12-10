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
    '/js/app.js',
    
];

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
                //put dynamic data
                
                //return to App
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('/');
              //  return caches.match('offline');
            })
    )
});