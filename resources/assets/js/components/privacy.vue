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
                      <li class="breadcrumb-item active" aria-current="page" >Privacy</li>
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

  <span>
                <h4 class='slideUp p-3'>Privacy Policy</h4>
                <ul class="slideUp m-3">
                <li>GetFoods is a service provided by MobyTech. The following terms refer to each person visiting GetFoods. 
                    getfoods.com.ng. The terms we and our website refer to GetFoods. Protecting your personal data is very important to us. By visiting our website, 
                    you provide us with some personal data. This policy explains how we use it. You can visit our website and explore it without providing us with personal data.
                    </li>
                </ul>

                 <h4 class='slideUp p-3'>What information do we collect about you?</h4>
                <ul class="slideUp m-3">
                <li>We only collect personal information from you when you order goods or services on our website, when you complete any customer survey, or through cookies.
We collect this information in order to enable orders, such as name, address, phone number, or payment information.</li>
                </ul>

 <h4 class='slideUp p-3'>How we use the information we collect from you?</h4>
                <ul class="slideUp m-3">
                <li>We collect and use your personal data on secured servers. We ask third organisms to check and certify our confidentiality principles.</li>
                </ul>

                <br>
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
      title: ' GetFoods - Privacy Policy',
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
