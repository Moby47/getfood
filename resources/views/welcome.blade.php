<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Web Application Manifest -->
        <link rel="manifest" href="/manifest.json">

  <!-- Fix - for safari / ios -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="GetFood">

  <meta name="msapplication-TileColor" content="#fff">
  <meta name="theme-color" content="#ffb42e">

<title>GetFoods</title>

    <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">   

 <!--fav icon -->
 <link rel="icon" href="{{ asset('images/icons/black/food.png') }}">

<!--vuetify material icons-->
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

<!--nprogress-css-->
<link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />

<!--<link href="/css/custom.min.css" rel="stylesheet" />-->

<link rel="stylesheet" href="/css/style.min.css">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet"> 

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">  

 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/shakrmedia/tuesday@v1.1.0/build/tuesday.min.css" />

 <link rel="stylesheet" href="/css/wicked.min.css">

 <link rel="stylesheet" href="/css/custom.min.css">

    </head>

    
    <body id="mobile_wrap">
        <div id='app' v-cloak>

     <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <router-view></router-view>	
      </transition>
              
              
                    </div>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
         <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>

         <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js" integrity="sha256-TzCZHC7V5wLIgeSjxMcAuOnxj4vQ3ta5XRdAQTC8cu8=" crossorigin="anonymous"></script>
         
         <script src="{{asset('/js/idb.js')}}"></script>
         <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
        
        <script src="{{asset('/js/app.js')}}"></script>

<!-- register service worker -->
<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.' 
        }).then(function (registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
            
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
        }, function (err) {
            // registration failed 
            console.log('ServiceWorker registration failed: ', err);
        });
    }
</script>
  <!--register service worker-->

 
  

<script>

  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "da6349ad-e18f-471b-8d57-30444a9d158f",
      persistNotification: false, // Automatically dismiss the notification after ~20 seconds in non-mobile Chrome
      promptOptions: {
    /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
    /* actionMessage limited to 90 characters */
    actionMessage: "Click OK for a better experience",
    /* acceptButtonText limited to 15 characters */
    acceptButtonText: "OK",
    /* cancelButtonText limited to 15 characters */
    cancelButtonText: "MISS OUT"
    },
    welcomeNotification: {
      "title": "GetFoods",
      "message": "Thanks for subscribing!",
      // "url": "" /* Leave commented for the notification to not open a window on Chrome and Firefox (on Safari, it opens to your webpage) */
    }
    });
    /* In milliseconds, time to wait before prompting user. This time is relative to right after the user presses <ENTER> on the address bar and navigates to your page */
     var notificationPromptDelay = 15000;
    /* Use navigation timing to find out when the page actually loaded instead of using setTimeout() only which can be delayed by script execution */
    var navigationStart = window.performance.timing.navigationStart;
    /* Get current time */
    var timeNow = Date.now();
    /* Prompt the user if enough time has elapsed */
    setTimeout(promptAndSubscribeUser, Math.max(notificationPromptDelay - (timeNow - navigationStart), 0));
  
  });

//function to prompt
function promptAndSubscribeUser() {
    window.OneSignal.isPushNotificationsEnabled(function(isEnabled) {
      if (!isEnabled) {
        window.OneSignal.showSlidedownPrompt();
      }else{
        console.log('enabled notification already')
      }
    });
  }
  //function to prompt


   ////////////////////////////
  OneSignal.push(function() {
      OneSignal.getUserId(function(userId) {

if(userId){
 //hold peter
 var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('peter-parker')) {
                db.createObjectStore('peter-parker', {keyPath: 'id'});
                console.log('created peter-parker')
              }
              });
              var dat = {id: new Date().toISOString(),'pp':userId}


              //save data func
              function saveData(dat){
                    console.log('peter-parker',dat)
                    console.log('saving peter => saved')
          return   dbPromise
          .then(function(db) {
            var tx = db.transaction('peter-parker', 'readwrite');
            var store = tx.objectStore('peter-parker');
            store.put(dat);
            return tx.complete;
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

           //call clear
           clearAllData('peter-parker')
                .then(res=>{
                  console.log('cleared peter')

                  //if cleared,then call the save function
                  saveData(dat);
                })
                .catch(error =>{
                      console.log(error)    
                      })

        

    console.log("OneSignal User ID:", userId);
    console.log("User ID:", localStorage.getItem('userId'));
    fetch('/player-id', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({'peter': userId, 'parker': localStorage.getItem('userId')})
              })
                .then(res=> {
                //    console.log(res);
                }) 
                .catch(error =>{
                      console.log(error)    
                      })
}else{
    console.log('not subscribed')
}
       
  }); 
});
/////////////////////////////

</script>

    </body>
</html>
