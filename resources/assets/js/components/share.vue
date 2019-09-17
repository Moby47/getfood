<template>
    <div class="container">
        
     
    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>


    <div class="views">

      
 <!-- Social Icons Popup -->
 <div class=" popup-social">
    <div class="content-block slideUp">
      <h4>Share Link</h4> <div class='alert alert-danger'>Under repair</div>
      <p>Share icons solution that allows you share and increase your social popularity.</p>
      <ul class="social_share">
		  <li><a href="http://twitter.com/" class="external"><img src="images/icons/black/twitter.png" alt="" title="" /><span>TWITTER</span></a></li>
		  <li><a href="http://www.facebook.com/" class="external"><img src="images/icons/black/facebook.png" alt="" title="" /><span>FACEBOOK</span></a></li>
		  <li><a href="http://plus.google.com" class="external"><img src="images/icons/black/gplus.png" alt="" title="" /><span>GOOGLE</span></a></li>
		  <li><a href="http://www.dribbble.com/" class="external"><img src="images/icons/black/dribbble.png" alt="" title="" /><span>DRIBBBLE</span></a></li>
		  <li><a href="http://www.linkedin.com/" class="external"><img src="images/icons/black/linkedin.png" alt="" title="" /><span>LINKEDIN</span></a></li>
		  <li><a href="http://www.pinterest.com/" class="external"><img src="images/icons/black/pinterest.png" alt="" title="" /><span>PINTEREST</span></a></li>
      </ul>
      <div class="close_popup_button"><router-link to='/' class="close-popup">
          <img src="images/icons/black/menu_close.png" alt="" title="" /></router-link></div>
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
