<template>
    <div class="container">
        
        <div class="statusbar-overlay"></div>

        <div class="panel-overlay"></div>
    
    
        <div class="views">
    
          
            <!-- Register Popup -->
        <div class=" popup-signup">
            <div class="content-block slideUp">
                <h4>REGISTER</h4> 
                <div class="loginform">
                    <form id="RegisterForm" method="post" data-vv-scope='regForm'>
       <input type="text" v-model='regName' name="Name"  v-validate='"required|max:15"' value="" class="form_input required" placeholder="Name" />
           <p class='text-danger shake' v-show="errors.has('regForm.Name')">{{ errors.first('regForm.Name') }}</p>
        
           <input type="text" v-model='regEmail' v-validate='"required|email|max:100"' name="Email" value="" class="form_input required" placeholder="Email" />
           <p class='text-danger shake' v-show="errors.has('regForm.Email')">{{ errors.first('regForm.Email') }}</p>

           <input type="password" v-model='regPassword' v-validate='"required|min:6"' name="Password" value="" class="form_input required" placeholder="Password" />
           <p class='text-danger shake' v-show="errors.has('regForm.Password')">{{ errors.first('regForm.Password') }}</p>

           <input type="submit" @click.prevent='reg()' name="submit" class="form_submit" id="submit" value="SIGN UP" />
                    </form>
                    
                </div>
                <div class="signup_bottom">
                    <router-link to="/login">LOGIN</router-link>
                </div>
                <div class="close_popup_button">
                        <router-link to='/'  class="close-popup"><img src="images/icons/black/menu_close.png" 
                            alt="" title="" /></router-link>
                </div>
            </div>
        </div>
    
      
        </div>

        <template>
                <v-snackbar
              v-model="snackbar"
              :timeout="timeout"
              >
              {{ text }}
              <v-btn
                color="#FFA500"
                text
                @click='snackbar=!snackbar'
              >
                Close
              </v-btn>
              </v-snackbar>
              </template>

     
          <!--Overlay-->
  <template>
        <div class="text-center">
          <v-overlay :value="overlay">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
          </v-overlay>
        </div>
      </template>
      <!--Overlay-->

    </div>
</template>

<script>
    export default {

        data(){
            return {
       overlay:false,
       regName:'',
          regEmail:'',
          regPassword:'',
          snackbar: false,
        text: '',
        timeout: 6000,
        valError:[],
            }
        },

        methods: {

            reg(){
                          //validate
            this.$validator.validateAll('regForm').then(() => {
             if (!this.errors.any()) {
              
              this.overlay = true
           
    var input = {'name':this.regName,'email':this.regEmail,'password':this.regPassword };
      
                      //send to database with axios
                          axios.post('/register-user',input)
                          .then(res=>{
                        if(res.data.msg == 1){
                           
                            this.overlay = false
                  this.text = 'Registered! Please check your Email for verification.';
                   this.snackbar = true
                            sound.play();
                        }else if(res.data.msg== 0){
                  this.text = 'Registered! But Verification failed. Please resend verification mail.';
                   this.snackbar = true
                   this.overlay = false
                   //
                        }
                        })
                        .catch(error=>{
                          this.overlay = false
                          if(error.response.status == 422){
                            this.valError = error.response.data.errors;
                         
                            this.text = 'This Email has been taken.';
                            this.snackbar = true
                          }else{
                    this.text = 'Please verify that your inputs are correct';
                     this.snackbar = true
                          } 
                        })
             }else{
               console.log('vee errors exist')
               //val err
               //do nothing, vee val got u
             }
             })//val
            
                  }, //reg

        },

        mounted() {
           // console.log('Component mounted.')
        }
    }
</script>
