<template>
    <div class="container">
        
        <div class="statusbar-overlay"></div>

        <div class="panel-overlay"></div>
    
    
        <div class="views">
    
          
            <!-- Register Popup -->
        <div class=" popup-signup">
            <div class="content-block">
                <h4>REGISTER</h4>
                <div class="loginform">
                    <form id="RegisterForm" method="post">
                        <input type="text" name="Username" value="" class="form_input required" placeholder="Username" />
                        <input type="text" name="Email" value="" class="form_input required" placeholder="Email" />
                        <input type="password" name="Password" value="" class="form_input required" placeholder="Password" />
                        <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN UP" />
                    </form>
                    
                </div>
                <div class="signup_bottom">
                    <router-link to="/login">BACK</router-link>
                </div>
                <div class="close_popup_button">
                        <router-link to='/'  class="close-popup"><img src="images/icons/black/menu_close.png" 
                            alt="" title="" /></router-link>
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
