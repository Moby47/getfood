<template>
    <div class="container">
        
     

    <div class="views">

      <!-- Forgot Password Popup -->
    <div class=" popup-forgot">

        <template>
            <v-card
              class="mx-auto elevation-23 "
              max-width="344"
              outlined
            >

            
<menubar>
     </menubar>

        <div class="content-block slideUp">
          
            <div class="loginform">
                <form id="ForgotForm" method="post" data-vv-scope='resendForm'>
                    <input type="text" name="Email" value="" v-validate='"required|email"'
                    class="form_input required" placeholder="Enter Email" v-model='resendEmail'/>
                    <p class='text-danger shake' v-show="errors.has('resendForm.Email')">{{ errors.first('resendForm.Email') }}</p>

                    <input type="submit" name="submit"  @click.prevent='resendVeri()' class="form_submit" id="submit" value="RESEND" />
                </form>
                <div class="signup_bottom">
                   <!-- <p>Check your email and activate your account.</p> -->
                </div>

                <div class="signup_bottom">
                    <v-btn @click.prevent='login()' outlined color="#FFA500">Back</v-btn>
                </div>
            </div>
         
        </div>

        </v-card>
        </template>
        
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
    <br>
    Resending Verification email...
  </v-overlay>
</div>
</template>
<!--Overlay-->


<back></back>
    
    </div>
</template>

<script>
    export default {

        data(){
            return {
                resendEmail: '',
          snackbar: false,
        text: '',
        timeout: 10000,
        overlay:false,
            }
        },

        methods: {
          login(){
            this.$router.push({ name: "login" })
          },
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
                  this.text = 'An error occured resending mail. Please refresh and try again'
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
