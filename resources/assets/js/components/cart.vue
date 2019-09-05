<template>
    <div class="container">
        
       
        
<!--content here-->

<div class="pages">
    <div data-page="cart" class="page no-toolbar no-navbar">
      <div class="page-content">
            <h2 class="page_title">SELECTED FOOD</h2>
            
            <div id="pages_maincontent">
             
             <br>
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                           <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page">Food (3 ITEMS)</li>
                         </ol>
                       </nav>
                
      <div class="page_single layout_fullwidth_padding">	
        
           <div class="cartcontainer">            
              <div class="cart_item" id="cartitem1">
                  <div class="item_title"><span>01.</span> Bicycle Pedal Driven</div>
                  <div class="item_price">$100</div>
                  <div class="item_thumb"><a href="shop.html" class="close-panel"><img src="images/photos/photo1.jpg" alt="" title="" /></a></div>
                 
                  <a href="#" class="item_delete" id="cartitem1"><img src="images/icons/black/trash.png" alt="" title="" /></a>           </div>
              
              <div class="cart_item" id="cartitem2">
                  <div class="item_title"><span>02.</span> Yellow Car </div>
                  <div class="item_price">$1200</div>
                  <div class="item_thumb"><a href="shop.html" class="close-panel"><img src="images/photos/photo2.jpg" alt="" title="" /></a></div>
                  
                  <a href="#" class="item_delete" id="cartitem2"><img src="images/icons/black/trash.png" alt="" title="" /></a>            </div>
              
              <div class="cart_item" id="cartitem3">
                  <div class="item_title"><span>03.</span> Summer T-Shirt</div>
                  <div class="item_price">$20</div>
                  <div class="item_thumb"><a href="shop.html" class="close-panel"><img src="images/photos/photo3.jpg" alt="" title="" /></a></div>
                  <div class="item_qnty">
                      
                  </div>
                  <a href="#" class="item_delete" id="cartitem3"><img src="images/icons/black/trash.png" alt="" title="" /></a>             </div>
              
              
              
                <router-link to="/checkout" class="button_full btyellow">TAKE FOOD</router-link>           
                
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
