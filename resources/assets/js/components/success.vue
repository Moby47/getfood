<template>
    <div class="container">
        
     
<!--content here-->

<div class="pages">
    <div data-page="success" class="page no-toolbar no-navbar">
      <div class="page-content">
      
            <h2 class="page_title"><router-link to='/' class='text-white'>GO HOME</router-link></h2>
       
       <div id="pages_maincontent">
  
      <div class="page_single layout_fullwidth_padding bounceIn">
              <div class="success_message">
              <span>Thank You!</span>
              <img src="/images/icons/black/food.png" alt="" title="" />
              <p>Your Order <br />Has Been successfully completed.</p>            
              </div>
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
