<template>
    <div class="container">
        
     
    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

      <!-- Forgot Password Popup -->
    <div class=" popup-forgot">
        <div class="content-block slideUp">
          
            <div class="loginform">
                <form id="ForgotForm" method="post" data-vv-scope='resendForm'>
                    <input type="text" name="Email" value="" v-validate='"required|email"'
                    class="form_input required" placeholder="email" v-model='resendEmail'/>
                    <p class='text-danger shake' v-show="errors.has('resendForm.Email')">{{ errors.first('resendForm.Email') }}</p>

                    <input type="submit" name="submit"  @click.prevent='resendVeri()' class="form_submit" id="submit" value="RESEND EMAIL" />
                </form>
                <div class="signup_bottom">
                    <p>Check your email and activate your account.</p>
                </div>

                <div class="signup_bottom">
                    <router-link to="/login">Back</router-link>
                </div>
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
                resendEmail: '',
          snackbar: false,
        text: '',
        timeout: 6000,
        overlay:false,
            }
        },

        methods: {
            resendVeri(){
            this.$validator.validateAll('resendForm').then(() => {
             if (!this.errors.any()) {
              this.overlay = true
              var input = {'email':this.resendEmail};
              axios.post('/resend-veri',input)
              .then(res=>{
                if(res.data == 0){
                  //user not reged in Db
                  this.text = 'No account found for '+this.resendEmail+' Please register';
                            this.snackbar = true
                            this.overlay = false
                 
                }else if (res.data == 1){
                  //user reged already
                  this.text = this.resendEmail+' has an Account on GetFoods. Please login';
                            this.snackbar = true
                            this.overlay = false

                }else if (res.data == 2){
                  //error sending mail
                  this.text = 'An error occured resending mail. Please try again'
                            this.snackbar = true
                            this.overlay = false
                }else if (res.data == 3){
                  //success
                  this.text = 'Verification mail sent. Check your Mailbox'
                            this.snackbar = true
                            this.overlay = false
                
                }
              })
              .catch(error=>{
                this.text = 'An error occured. Try again'
                            this.snackbar = true
                            this.overlay = false
              })
              
             }else{
              
               console.log('val err')
             }
             
            })
          },
        },

        mounted() {
           
        }
    }
</script>
