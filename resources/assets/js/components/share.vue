<template>
    <div class="container">
        
     
    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

      
 <!-- Social Icons Popup -->
 <div class=" popup-social">
    <div class="content-block slideUp">

                   
             
    <!--  <p>Sharing is caring..</p> --><h4 class='p-1'></h4>

      <ul class="social_share wiggle">
          <li class='wiggle'><whats-app  :url="url" title="Get Food" scale="3" ></whats-app> <span>WHATSAPP</span></li>
          <li class='wiggle'> <email  :url="url" subject="Get Food" scale="3"></email> <span>EMAIL</span> </li>
          <li class='wiggle'> <facebook  :url="url" scale="3"></facebook> <span>FACEBOOK</span> </li>
          <li class='wiggle'>  <twitter  :url="url" title="Get Food" scale="3"></twitter> <span>TWITTER</span> </li>
          <li class='wiggle'> <linkedin  :url="url" scale="3"></linkedin> <span>LINKEDIN</span> </li>
          <li class='wiggle'> <telegram  :url="url" scale="3"></telegram> <span>TELEGRAM</span> </li>
        </ul>

      <div class="close_popup_button"><router-link to='/' class="close-popup">
          <img src="images/icons/black/menu_close.png" alt="" title="" /></router-link>
          </div>

   <!--

 <v-img 
 max-width="344"
 class='mx-auto mt-1'
 src="/images/share.svg" alt="" title="" ></v-img>
-->

    </div>
    </div>

  
    </div>

    
    </div>
</template>



      <script>
         //share icons
  import {
  Facebook,
  Twitter,
  Linkedin,
  Pinterest,
  Reddit,
  Telegram,
  WhatsApp,
  Email,
} from "vue-socialmedia-share";
//share icons
        export default {
          //share icons
    components: {
    Facebook,
    Twitter,
    Linkedin,
    Pinterest,
    Reddit,
    Telegram,
    WhatsApp,
    Email,
  },
  //share icons
          data: () => ({
           url:'',
          }),

          mounted(){
            //url issues
        
         var url = String(window.location)
         this.url = url
          },
        }
      
      </script>
