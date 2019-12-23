<template>
    <div class="container">
        
        <menubar></menubar>
<!--content here-->

<div class="pages">
    <div data-page="success" class="page no-toolbar no-navbar">
      <div class="page-content">
      
       <div id="pages_maincontent">
  
      <div class="page_single layout_fullwidth_padding bounceIn mt-5">
              <div class="success_message">
              <span>Thank You!</span>
              <img src="/images/icons/black/rocket.png" alt="" title="" />
              <p>Your Order <br />Has Been successfully completed.</p>   
              </div>
        </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
  
  <!--content here-->

  <back></back> 
  
    </div>
</template>


          
<script>
    export default {

        data(){
            return {
             
            }
        },

        methods: {

        },

        mounted() {
            //need a way to prevent access unless a successful order was made!!!!
        }
    }
</script>
