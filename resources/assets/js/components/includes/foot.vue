 <template >
 
                    <v-footer padless class='mt-3 footer-texts'>
                      <v-col
                      class="text-center"
                      cols="12"
                    >
                    <router-link to='/terms-and-condition' >Terms and Conditions </router-link>  -
                    <router-link to='/privacy' >Privacy Policy </router-link> 

                    </v-col>

                    <v-col
                    class="text-center"
                    cols="12"
                  >
                 	&#169; ({{ new Date().getFullYear() }})<router-link to='/about' > GetFoods </router-link>
                  </v-col>
                    
                  <v-col>
                      <div class="text-center">
                          <whats-app  :url="url" title="Get Food" scale="1.3" ></whats-app> 
                           <email  :url="url" subject="Get Food" scale="1.3"></email>  
                           <facebook  :url="url" scale="1.3"></facebook> 
                            <twitter  :url="url" title="Get Food" scale="1.3"></twitter>  
                           <linkedin  :url="url" scale="1.3"></linkedin>  
                           <telegram  :url="url" scale="1.3"></telegram>  
                      </div>
                  </v-col>

                    </v-footer>
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
      
              created(){
    
        },
          methods: {
    
                
    
          },
    
          mounted() {
    
    
                // var url = String(window.location)
             this.url = 'https://getfoods.ng'
    
              }
        }
      </script>
    