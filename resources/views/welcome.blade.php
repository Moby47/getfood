<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LaraVue</title>

    <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">   

<!--vuetify material icons
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
<link href="/css/app.css" rel="stylesheet" />
-->
<!--nprogress-css-->
<link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />


<link href="/css/custom.css" rel="stylesheet" />

 <!--fav icon 
 <link rel="icon" href="{{ asset('images/fav.jpg') }}">
 -->
        <!-- Styles -->
        <style>
          
        </style>
    </head>
    <body>
        <div id='app' v-cloak>

     <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <router-view></router-view>	
      </transition>
              
              
                    </div>

         <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
        <script src="{{asset('/js/app.js')}}"></script>

    </body>
</html>
