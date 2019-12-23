<template>
    <div class="container">
        
     
    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

       <!-- Login Popup -->
    <div class=" popup-login">

        <template>
            <v-card
              class="mx-auto elevation-23 "
              max-width="344"
              outlined
            >

      <div class="content-block slideUp">
          <h4>LOGIN</h4> 
          <div class="loginform">
              <form id="LoginForm" method="post" data-vv-scope='loginForm'>
                  <input type="text" name="Email" v-model='logEmail' v-validate='"required|email|max:100"' class="form_input required" placeholder="Email" />
                  <p class='text-danger shake' v-show="errors.has('loginForm.Email')">{{ errors.first('loginForm.Email') }}</p>

                  <input type="password" v-model='logPassword' name="Password" v-validate='"required|min:6"' class="form_input required" placeholder="password" />
                  <p class='text-danger shake' v-show="errors.has('loginForm.Password')">{{ errors.first('loginForm.Password') }}</p>
                 
                  <div class="forgot_pass"><a href="/forgot-password" >Forgot Password?</a></div>
                  <input type="submit" name="submit" class="form_submit" id="submit" @click.prevent='login()' value="SIGN IN" />
              </form>
              
              <div class="signup_bottom">
                  
                                    <p>Don't have an account?</p>
               
                  <div class="my-2 text-center">
                      <v-btn @click.prevent='register()' outlined color="#FFA500">Sign Up</v-btn>   
                      </div>

                <div class="my-2 text-center">
                    <v-btn @click.prevent='resendEmail()' outlined color="#FFA500">Verification Email</v-btn>   
                    </div>
                  
              </div>
          </div>
          <div class="close_popup_button">
              <router-link to='/' class="close-popup"><img src="images/icons/black/menu_close.png" alt="" title="" /></router-link>
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
    Signing In...
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
                logEmail: '',
          logPassword: '',
          snackbar: false,
        text: '',
        timeout: 6000,
        overlay:false,
            }
        },

        methods: {
          register(){
            this.$router.push({ name: "register" })
          },
          resendEmail(){
            this.$router.push({ name: "resendemail" })
          },

            login(){
                          //validate specific reg fields
        this.$validator.validateAll('loginForm').then(() => {
             if (!this.errors.any()) {
              this.overlay = true

                    var input = {'email':this.logEmail, 'password':this.logPassword};
                    axios.post('/login-user',input)
                    .then(res => {
                    var result = res.data.result;
                  
                          if(result == 1){
                            this.text = 'Acount not verified. Please resend a verification email';
                            this.snackbar = true
                            this.overlay = false
                          }else if(result == 2){
                            this.text = 'Login failed. Invalid credentials';
                            this.snackbar = true
                            this.overlay = false
                          }else{
                               localStorage.setItem('userToken',res.data.userToken);
                               localStorage.setItem('userId',res.data.userId);
                               localStorage.setItem('userName',res.data.userName);
                               localStorage.setItem('userMail',res.data.userMail);
                               localStorage.setItem('userStatus',res.data.userStatus);
                               
                               var status = localStorage.getItem('userStatus')
                                

                                //validate if quest is coming from cart page then gotocheckout not dashboard
                                if(localStorage.getItem('shopper')){
                                  localStorage.removeItem('shopper')
                                  this.$router.push({name: "checkout"});
                                  return;
                                  
                                }else{

                                    if(status == 1){
                                  //admin
                                  //load add to store
                                  localStorage.setItem('vendorAddress',res.data.vendorAddress);

                                  this.$router.push({name: "vendordashboard"});
                                }else if (status == 0){
                                  //user
                                  this.$router.push({name: "userdashboard"});
                                }else if (status == 47){
                                  /* For super admin page*/
                                  this.$router.push({name: "superadmindash"});
                                }
                                }

                              
                          }
                    })
                    .catch(error =>{
                      this.overlay = false
                      console.log(error)
                    })
                  }else{ //if error
                    //error is auto shown, dont worry
                  } //if error
                })//val
              
                   }, //login

                
        },

        created() {
          //this.Auth()
        }
    }
</script>
