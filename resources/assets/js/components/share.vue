<template>
    <div class="container">
        
      <menubar></menubar>

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

      
 <!-- Social Icons Popup -->
 <div class=" popup-social">
    <div class="content-block slideUp">

                   
             
    <!--  <p>Sharing is caring..</p> --><h4 class='p-1'></h4>

      <ul class="social_share wiggle">
          <li class='wiggle'><whats-app  :url="url" title="Get Food" scale="3" ></whats-app> </li>
          <li class='wiggle'> <email  :url="url" subject="Get Food" scale="3"></email>  </li>
          <li class='wiggle'> <facebook  :url="url" scale="3"></facebook> </li>
          <li class='wiggle'>  <twitter  :url="url" title="Get Food" scale="3"></twitter>  </li>
          <li class='wiggle'> <linkedin  :url="url" scale="3"></linkedin>  </li>
          <li class='wiggle'> <telegram  :url="url" scale="3"></telegram>  </li>
          <li class='wiggle'> <pinterest  :url="url" scale="3"></pinterest>  </li>
          <li class='wiggle'> <reddit  :url="url" scale="3"></reddit>  </li>
        </ul>

     

   <!--

 <v-img 
 max-width="344"
 class='mx-auto mt-1'
 src="/images/share.svg" alt="" title="" ></v-img>
-->

    </div>
    </div>

  
    </div>


<back></back>
    
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

             //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: ' Share GetFoods ',
         meta: [{
           'name': 'description',
        'content': 'Online food reservation and ordering platform to maintain a reliable and efficient system',
      }],
      noscript: [
      { innerHTML: 'JavaScript is required.' }
    ]
    },
    //meta
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
