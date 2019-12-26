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

<link href="/css/custom.min.css" rel="stylesheet" />

<link rel="stylesheet" href="/css/style.min.css">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet"> 

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">  

 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/shakrmedia/tuesday@v1.1.0/build/tuesday.min.css" />

 <link rel="stylesheet" href="/css/wicked.min.css">

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
        }, function (err) {
            // registration failed 
            console.log('ServiceWorker registration failed: ', err);
        });
    }
</script>
  <!--register service worker-->
    </body>
</html>
