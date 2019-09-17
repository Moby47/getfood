<template>
    <div class="container">
        
     
    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

       <!-- Login Popup -->
    <div class=" popup-login">
      <div class="content-block slideUp">
          <h4>LOGIN</h4> <div class='alert alert-danger'>Under repair</div>
          <div class="loginform">
              <form id="LoginForm" method="post">
                  <input type="text" name="Username" value="" class="form_input required" placeholder="username" />
                  <input type="password" name="Password" value="" class="form_input required" placeholder="password" />
                  <div class="forgot_pass"><router-link to="/forgot" >Forgot Password?</router-link></div>
                  <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN IN" />
              </form>
              <div class="signup_bottom">
                  <p>Don't have an account?</p>
                  <router-link to="/register">SIGN UP</router-link>
              </div>
          </div>
          <div class="close_popup_button">
              <router-link to='/' class="close-popup"><img src="images/icons/black/menu_close.png" alt="" title="" /></router-link>
          </div>
      </div>
  </div>

  
    </div>

    
    </div>
</template>

<script>
    export default {

        data(){
            return {

            }
        },

        methods: {
/*
            this.$validator.validateAll().then(() => {
           
           if (!this.errors.any()) {
            //
            }else{
            //
            }
         
                    //
            })
            .catch(err=>{
                
            }),
      
         setTimeout(func=>{
             //this.errors.clear()
            // this.$validator.reset()
         },1) 
        
         }); //validator
*/
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
