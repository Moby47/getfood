<template>
    <div class="container">
        <menubar></menubar>
<!--page content-->
<div class="pages">
    <div data-page="about" class="page no-toolbar no-navbar">
      <div class="page-content">
      
       <div id="pages_maincontent">
        
        <br>
            <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                      <li class="breadcrumb-item active" aria-current="page">ABOUT GETFOODS</li>
                    </ol>
                  </nav>
            
            
            
      <div class="page_single layout_fullwidth_padding">	  
            
                <blockquote class='slideUp'>
                  In order for restaurant owners to keep organized, maximize table turnover, and reduce waiting time for customers, 
                  GetFoods maintains a reliable and efficient food reservation system for Tek-Experts.
                   <span><router-link to='/'>GETFOODS.COM</router-link></span>
                </blockquote>  
  
        
                
                
                <h4 class='slideUp'>Objectives:</h4>
                <ul class="simple_list slideUp">
                <li>Provide an order/reservation system for customers</li>
                <li>Provide cost analysis / history on food spending for customers</li>
                <li>To ease services process for both customers and food vendors</li>
                <li>Provide an accurate records keeping for insights on best dishes, quantity and total income for food vendors</li>
                <li>And more...</li>
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
