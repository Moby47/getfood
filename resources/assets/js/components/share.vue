<template>
    <div class="container">
        
      <menubar></menubar>

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

      
 <!-- Social Icons Popup -->
 <div class=" popup-social">
    <div class="content-block slideUp">

                   
             
     <p class='text-center'>Sharing is caring. Tell a friend about GetFoods.</p>
   
      <ul class="social_share">
          <li><whats-app  :url="url" title="Get Food" scale="3" ></whats-app> </li>
          <li> <email  :url="url" subject="Get Food" scale="3"></email>  </li>
          <li> <facebook  :url="url" scale="3"></facebook> </li>
          <li>  <twitter  :url="url" title="Get Food" scale="3"></twitter>  </li>
          <li> <linkedin  :url="url" scale="3"></linkedin>  </li>
          <li> <telegram  :url="url" scale="3"></telegram>  </li>
          <li> <google  :url="url" scale="3"></google>  </li>
          <li> <pinterest  :url="url" scale="3"></pinterest>  </li>
          <li> <reddit  :url="url" scale="3"></reddit>  </li>
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
  Google
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
    Google
  },
  //share icons
          data: () => ({
           url:'',
          }),

          mounted(){
            //url issues
        
        // var url = String(window.location)
         this.url = 'https://www.getfoods.ng'
          },
        }
      
      </script>
