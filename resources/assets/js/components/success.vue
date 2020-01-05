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
   //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: 'Thanks - GetFoods',
         meta: [{
           'name': 'description',
        'content': 'Online food reservation and ordering platform to maintain a reliable and efficient system',
      }],
      noscript: [
      { innerHTML: 'JavaScript is required.' }
    ]
    },
    //meta
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
