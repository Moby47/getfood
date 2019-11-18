<template>
    <div class="">

      <!-- banner -->
<div class="banner fadeIn">
    <div class="container ">
      <div class="banner-left">
          <menubar></menubar>
        <div class="banner-info mist">	
            <h1 class='text-uppercase'>HELLO {{userName}}</h1>
            <p>Reduce your waiting time, with our reliable and
                efficient restaurant ordering / reservation system.</p>
            <router-link to="/shop">ENTER KITCHEN</router-link>
            <br><br>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <!-- //banner -->
  
  
  <!-- perfect -->
  <div class="perfect text-center ">
    <div class="container slideUp">
      <h3>THE PERFECT CHOICE FOR YOUR COMPANY</h3>
        <div class="perfect-buttons">
          <router-link to="/about" class="bor">ABOUT US</router-link>
          <router-link to="/vendor-register" class="red">GET STARTED</router-link>
        </div>
    </div>
  </div>
  <!-- //perfect -->

  <!-- footer -->
  <div class="footer">
    <div class="container">
      <p> &copy; 2019 GetFoods. All Rights Reserved | &nbsp;<a href="http://www.mobytech.tech">Mobytech</a></p>
    </div>
  </div>
  <!-- //footer -->
  
    </div>
</template>

<style scoped>


</style>

<script>
    export default {

        data(){
            return {
              userName:'',
            }
        },

        methods: {

        },

        mounted() {
            if(localStorage.getItem('userName')){
              this.userName = localStorage.getItem('userName') +'.'
            }
        }
    }
</script>

