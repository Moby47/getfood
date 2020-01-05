<template>
    <div class="container">

         <!--
        https://vuetifyjs.com/en/components/treeview
        https://vuetifyjs.com/en/components/selects
        tooltips
        -->

<!--page content-->
<div class="pages">
    <div data-page="about" class="page no-toolbar no-navbar">
      <div class="page-content">
      
       <div id="pages_maincontent">
        
        <menubar></menubar>
        <br>
         <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
            <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                      <li class="breadcrumb-item active" aria-current="page" >About Us</li>
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
                  In order for restaurant owners to keep an organized system, maximize table turnover, and reduce waiting time for customers, 
                  GetFoods was built to maintain a reliable and efficient food reservation and ordering system.
                   <span><router-link to='/'>GETFOODS.COM</router-link></span>
                </blockquote>  
  
                  </v-card>
                </template>
                
                    <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >

  <span>
                <h4 class='slideUp p-1'>Objectives:</h4>
                <ul class="simple_list slideUp m-2">
                <li>Provide a reservation and ordering system for customers</li>
                <li>Provide cost analysis / history on food expenditures for customers</li>
                <li>Ease service process for both customers and food vendors</li>
                <li>Provide accurate record keeping for insights on best dishes, quantity and total income for food vendors</li>
                <li>And more...</li>
                </ul>

  </span>
                  </v-card>
                    </template>

                    
                
               
 <div class="my-2 text-center">
              <v-btn  @click.prevent='shop()' outlined color="#FFA500">GET FOOD</v-btn>
            </div>

           </div>
                

        </div>
        
        
      </div>
    </div>
  </div>
  <!--page content-->
  

  
<back></back>
     
    </div>
</template>




<script>


    export default {
   //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: 'About GetFoods',
         meta: [{
           'name': 'description',
        'content': 'Online food reservation and ordering platform to maintain a reliable and efficient system',
      }],
      noscript: [
      { innerHTML: 'JavaScript is required.' }
    ]
    },
    //meta
//
data: function() {
    return {
       
    }
},

methods:{
    shop(){
            this.$router.push({ name: "kitchen" })
          }
}

     
       
     
    }
</script>
