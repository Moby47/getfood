<template>
    <div class="container">
        <menubar></menubar>
<!--page content-->
<div class="pages">
    <div data-page="about" class="page no-toolbar no-navbar">
      <div class="page-content">
      
       <div id="pages_maincontent">
        
        <br>
         <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
            <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                      <li class="breadcrumb-item active" aria-current="page" >About GetFoods</li>
                    </ol>
                  </nav>
            
                  </v-card>
         </template>
            
         
      <div class="page_single layout_fullwidth_padding">	  
            
                <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
                <blockquote class='slideUp'>
                  In order for restaurant owners to keep organized, maximize table turnover, and reduce waiting time for customers, 
                  GetFoods maintains a reliable and efficient food reservation/ordering system.
                   <span><router-link to='/'>GETFOODS.COM</router-link></span>
                </blockquote>  
  
                  </v-card>
                </template>
                
                    <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >

                <h4 class='slideUp p-3'>Objectives:</h4>
                <ul class="simple_list slideUp">
                <li>Provide a reservation/ordering system for customers</li>
                <li>Provide cost analysis / history on food expenditures for customers</li>
                <li>Ease service process for both customers and food vendors</li>
                <li>Provide an accurate record keeping for insights on best dishes, quantity and total income for food vendors</li>
                <li>And more...</li>
                </ul>
                  </v-card>
                    </template>

                    
                
               
 <div class="my-2 text-center">
              <v-btn  @click.prevent='shop()'>ENTER KITCHEN</v-btn>
            </div>

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

methods:{
    shop(){
            this.$router.push({ name: "shop" })
          }
}

     
       
     
    }
</script>
