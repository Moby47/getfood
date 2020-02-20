<template>
        <div class="container">
          
      <!--content here-->
      
      <div class="pages">
        <div data-page="cart" class="page no-toolbar no-navbar">
          <div class="page-content">
                <div id="pages_maincontent">
                 
                 <menubar></menubar>
                 <br>
                
      
          <div class="page_single layout_fullwidth_padding">	
            
               <div class="cartcontainer">   
            
                <div class="page_single layout_fullwidth_padding bounceIn mt-5">
                  <div class="success_message">
                  <img src="/images/icons/black/user.png" alt="" title="" />
                  <p>Account created!<br/>
                    Check your email for verification.</p> 
                  <p><router-link to='/resend-email'>Resend email verification</router-link></p> 
                  <p><router-link to='/user-signin'>Sign in</router-link></p>   
                  <p><router-link to='/'>Go Home</router-link></p> 
                  </div>
            </div>
      
       </div>
        </div>
        </div>
        </div>
        </div>
      </div>
      
        <back></back> 
      
        </div>
      </template>
      
      
      <script>
        export default {
       //meta
       metaInfo: {
           charset: 'utf-8' ,
           name: 'viewport', content: 'width=device-width, initial-scale=1',
          title: 'Sign up Successful',
             meta: [{
               'name': 'description',
            'content': 'Online food reservation and ordering platform to maintain a reliable and efficient system',
          }],
          noscript: [
          { innerHTML: 'JavaScript is required.' }
        ]
        },
        //meta
            data(){
                return {
                 
                }
            },
      
            methods: {
      
            },
      
            mounted() {
             //check if reged, to determine resend veri btn visibility
          if(localStorage.getItem('resendVeri')){
            this.reged = true
          }else{
            this.$router.push({name: "register"});
          }
            }
        }
      </script>
      