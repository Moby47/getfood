<template>
    <div class="container">
        
    
<!--content here-->

<div class="pages">
    <div data-page="features" class="page no-navbar">
      <div class="page-content">
          <h2 class="page_title">FOOD TRAY</h2>
            
          <div id="pages_maincontent">
           
           <br>
               <nav aria-label="breadcrumb ">
                       <ol class="breadcrumb">
                         <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                         <li class="breadcrumb-item active" aria-current="page">Food (3 ITEMS)</li>
                       </ol>
                     </nav>
        
      <div class="page_single layout_fullwidth_padding toolbarpage">  
        
      <ul class="features_list_detailed">
  
            <li class="bg1">
            <div class="feat_small_icon"><img src="images/icons/white/electronics.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4><a href="about.html">For all devices</a></h4>
            <a href="about.html">Created for all screens, mobile and desktop. Full width layout with touch enabled sections.</a>
            </div>
            </li> 
      
            
            
            <li class="bg4">
            <div class="feat_small_icon"><img src="images/icons/white/shop.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4><a href="shop.html">Shop</a></h4>
            <a href="shop.html">Mobile eccomerce solution. Layout designs to create a mobile shop with categories and shopping cart integrated.</a>
            </div>
            </li> 	  
            
            <li class="bg5">
            <div class="feat_small_icon"><img src="images/icons/white/user.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4> <a href="#" data-popup=".popup-login" class="open-popup">User login</a></h4>
            <a href="#" data-popup=".popup-login" class="open-popup">Static login and register HTML forms with validation.</a>
            </div>
            </li>
            
            <li class="bg6">
            <div class="feat_small_icon"><img src="images/icons/white/lock.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4><a href="#" data-panel="right" class="open-panel">User account</a></h4>
            <a href="#" data-panel="right" class="open-panel">Create an user account page with profile image and custom menu.</a>
            </div>
            </li>
                  
            <li class="bg1">
            <div class="feat_small_icon"><img src="images/icons/white/tabs.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4> <a href="tabs.html">Responsive tabs</a></h4>
            <a href="tabs.html">Add responsive tabs to any page or section in your app.</a>
            </div>
            </li>
            
            <li class="bg2">
            <div class="feat_small_icon"><img src="images/icons/white/toggle.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4><a href="toggle.html">Toggles</a></h4>
            <a href="toggle.html">Add content with toggles will save a lot of space in your app layout.</a>
            </div>
            </li>
            
            
            
            <li class="bg1">
            <div class="feat_small_icon"><img src="images/icons/white/love.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4><a href="#" data-popup=".popup-social" class="open-popup">Social share</a></h4>
            <a href="#" data-popup=".popup-social" class="open-popup">Allow users to follow you on your social websites.</a>
            </div>
            </li>
            
            <li class="bg2">
            <div class="feat_small_icon"><img src="images/icons/white/phone.png" alt="" title="" /></div>
            <div class="feat_small_details">
            <h4><a href="tel:123456" class="external">Call Us button</a></h4>
            <a href="tel:123456" class="external">Create a direct call button for mobile with a phone number.</a>
            </div>
            </li>
            
            
            
        </ul>
         </div>
         
         
        </div>
        
        
      </div>
    </div>
  </div>
  
  <!--content here-->
   
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
