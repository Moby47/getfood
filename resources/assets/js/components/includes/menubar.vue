<template>
    <div class=''>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link class="navbar-brand" to="/">GetFood</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link class="nav-link" to="/shop">Eat!</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/favorite">Favorite Food</router-link>
              </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/about">About the App</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/share">Tell a Friend</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/login">Login</router-link>
              </li>
              <li class="nav-item">
                <a href='tel:080'class="nav-link" to="">Call Us</a>
              </li>
          </ul>
         
        </div>
      </nav>

      </div>
     
</template>