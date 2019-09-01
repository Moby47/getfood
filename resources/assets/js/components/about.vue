<template>
    <div class="container">
        
<!--page content-->
<div class="pages">
    <div data-page="about" class="page no-toolbar no-navbar">
      <div class="page-content">
      
            <h2 class="page_title">ABOUT GETFOOD</h2>
            
       <div id="pages_maincontent">
        
        <br>
            <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                      <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                  </nav>
            
            
            
      <div class="page_single layout_fullwidth_padding">	  
            
                <blockquote>
                UpMobile is a mobile template that can be used to create a mobile website, a mobile web app, or even a native mobile app. The design is using a full width layout that works perfectly on tablets and desktop also. <span>SINDEVO.COM</span>
                </blockquote>  
  
        
                
                
                <h4>Objectives:</h4>
                <ul class="simple_list">
                <li>Creating a mobile website</li>
                <li>Creating a mobile web app</li>
                <li>Creating a mobile native app (integrated with solutions like phonegap or cordova)</li>
                <li>Works perfectly on tablets and desktop also</li>
                </ul>
                
                
                <router-link to="/shop" class="button_full external">GET FOOD NOW!</router-link>
                
                
           </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
  <!--page content-->
  
     
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
