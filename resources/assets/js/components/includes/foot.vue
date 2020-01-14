 <template >
 
                    <v-footer padless class='mt-5'>
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
                  ({{ new Date().getFullYear() }})  HenryMoby   <a href='tel:08053121695' >Contact Support </a> 
                  </v-col>
                    
                    </v-footer>
                  </template>