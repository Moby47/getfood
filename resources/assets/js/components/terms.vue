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
                      <li class="breadcrumb-item active" aria-current="page" >Terms and Conditions</li>
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
                 Please carefully read the terms and conditions ("Terms and Conditions") below before placing any order for any of the Goods or Services 
                 from http://www.getfoods.com.ng. By placing an order for any of the Goods or column Services from this Website,
                  whereas it is by phone, or by any other available channel, you agree to be bound by these Terms and Conditions.
                </blockquote>  
  
                  </v-card>
                </template> 
            


                    <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                  >
  <span>
                <h4 class='slideUp p-3'>Section 1: GetFoods Introduction</h4>
                <ul class="slideUp m-3">
                <li>We are GetFoods, a brand of http://www.getfoods.com.ng, unless otherwise stated.
                    </li>
                </ul>

                 <h4 class='slideUp p-3'>Section 2: Definitions</h4>
                <ul class="slideUp m-3">
                <li>2.1. "Agreement" references these Terms and Conditions (T&amp;Cs), the Privacy Policy, any payment instructions provided to you and any other form we might provide to you;
<br>
2.2. By "Privacy Policy" we mean the policy accessible on our Website which details how we collect and store your personal data;
<br>
2.3. "you", "your" and "yours" are references to you, the person accessing this Website, and placing the orders for the Goods or Services we display on it. Access through any other channel provided by GetFoods will also bound you to these Terms and Conditions;
<br>
2.4. "we", "us", "our", and "GetFoods" are references to the Company;
<br>
2.5. "Goods" is a reference to any goods which we may offer for sale from our Website from at a given time;
<br>
2.6. "Service" or "Services" is a reference to any service which we may supply and which you may request via our Website;
<br>
2.7. "Partner Restaurant" is a third party, which has agreed to co-operate with the Company to prepare and/or deliver the Goods or Services.
<br>
2.8. "Food Delivery" references perishable goods and any form of delivery service, both provided by our Partner restaurants and for both of which our Partner restaurants take full responsibility;
<br>
2.9. "Website" is a reference to our Website http://www.getfoods.com.ng, our mobile applications or any other platform we will choose to offer our Goods or services.</li>
                </ul>

 <h4 class='slideUp p-3'>Section 3: Ordering</h4>
                <ul class="slideUp m-3">
                <li>By placing an order through our Website, you enter into an agreement with GetFoods with respect to the processing of that order and 
                    forwarding it to the Participating Restaurant. If you are paying online, GetFoods is also responsible for any returns or refunds. 
                    However, the Restaurant remains responsible for the preparation, quality and delivery of your order. You agree to take particular 
                    care when providing us with your details and warrant that these details are accurate and complete at the time of ordering. 
                    You also warrant that the credit or debit card details that you provide are for your own credit or debit card and that you have
                     sufficient funds to make the payment.</li>
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
      title: ' GetFoods - Terms and Condition',
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
