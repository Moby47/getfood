<template>
    <div class="">
        
<!--content here-->

<div class="pages">
    <div data-page="checkout" class="page no-toolbar no-navbar">
      <div class="page-content">
      
            <h2 class="page_title">FOOD IS READY</h2>
            
            <div id="pages_maincontent">
             
             <br>
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                           <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                         </ol>
                       </nav>
           
              
      <div class="page_single layout_fullwidth_padding">
              
             
              <h4 class="checkout_title">ORDER DETAILS</h4>
              
                      <div class="order_item">
                          <div class="order_item_thumb"><a href="shop-item.html" class="close-panel">
                            </a></div>
                          <div class="order_item_title"><span>1 X</span> Bicycle Pedal Driven</div>
                          <div class="order_item_price">$100</div>           
                      </div>
                      <div class="order_item">
                          <div class="order_item_thumb"><a href="shop-item.html" class="close-panel"></a></div>
                          <div class="order_item_title"><span>1 X</span> Yellow Car</div>
                          <div class="order_item_price">$1200</div>           
                      </div>
                      <div class="order_item">
                          <div class="order_item_thumb"><a href="shop-item.html" class="close-panel"></a></div>
                          <div class="order_item_title"><span>1 X</span> Summer T-Shirt</div>
                          <div class="order_item_price">$20</div>           
                      </div>
                      
               
        
                 
                 
                <h4 class="checkout_title">TOTAL</h4>      
                        <div class="carttotal_full">
                            
                            <div class="carttotal_row_last">
                            <div class="carttotal_left">TOTAL</div> <div class="carttotal_right">$ 1,528.00</div>
                            </div>
                        </div> 
                        
                        <router-link to="/success" class="button_full btyellow">EAT</router-link> 
                
   
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
