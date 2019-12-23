<template>
  <div class="container">
      
   
<!--content here-->

<div class="pages">
  <div data-page="success" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div id="pages_maincontent">

    <div class="page_single layout_fullwidth_padding bounceIn">
            <div class="success_message">
            <span>No Food Here</span>
            <img src="/images/confused.gif" alt="" title="" />
            <p>Please Try <br /> <router-link to='/kitchen' class=''>HERE</router-link></p>            
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
