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
                      <li class="breadcrumb-item active" aria-current="page" >ABOUT GETFOODS</li>
                    </ol>
                  </nav>
            
            
            
      <div class="page_single layout_fullwidth_padding">	  
            
                <blockquote class='slideUp'>
                  In order for restaurant owners to keep organized, maximize table turnover, and reduce waiting time for customers, 
                  GetFoods maintains a reliable and efficient food reservation/ordering system.
                   <span><router-link to='/'>GETFOODS.COM</router-link></span>
                </blockquote>  
  
        
                
                
                <h4 class='slideUp'>Objectives:</h4>
                <ul class="simple_list slideUp">
                <li>Provide a reservation/ordering system for customers</li>
                <li>Provide cost analysis / history on food expenditures for customers</li>
                <li>Ease service process for both customers and food vendors</li>
                <li>Provide an accurate record keeping for insights on best dishes, quantity and total income for food vendors</li>
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

//
data: function() {
    return {
       
    }
},

     
       
     
    }
</script>
