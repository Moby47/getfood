<template>
    <div class="container">
        
<div class="pages">
    <div data-page="shop" class="page no-toolbar no-navbar">
      <div class="page-content">
      <h2 class="page_title">CHOOSE FOOD</h2>
            
       <div id="pages_maincontent">
        
        <br>
            <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                      <li class="breadcrumb-item active" aria-current="page">Food (3 ITEMS)</li>
                    </ol>
                  </nav>
        
      <div class="page_single layout_fullwidth_padding">
        
        <ul class="shop_items">
        
            <li>
            <div class="shop_thumb"><a href="shop.html"><img src="images/photos/photo1.jpg" alt="" title="" /></a></div>
            <div class="shop_item_details">
            <h4><a href="shop.html">Blue Bike</a></h4>
            <div class="shop_item_price">$100</div>
              <div class="item_qnty_shop">
                  <form id="myform" method="POST" action="#">
                      <input type="button" value="-" class="qntyminusshop" field="quantity" />
                      <input type="text" name="quantity" value="1" class="qntyshop" />
                      <input type="button" value="+" class="qntyplusshop" field="quantity" />
                  </form>
              </div>
            <a href="cart.html" id="addtocart"><router-link to='/cart'>ADD TABLE</router-link></a>
            <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
            </div>
            </li> 
            
            <li>
            <div class="shop_thumb"><a href="shop.html"><img src="images/photos/photo2.jpg" alt="" title="" /></a></div>
            <div class="shop_item_details">
            <h4><a href="shop.html">Yellow Car</a></h4>
            <div class="shop_item_price">$1200</div>
              <div class="item_qnty_shop">
                  <form id="myform" method="POST" action="#">
                      <input type="button" value="-" class="qntyminusshop" field="quantity2" />
                      <input type="text" name="quantity2" value="1" class="qntyshop" />
                      <input type="button" value="+" class="qntyplusshop" field="quantity2" />
                  </form>
              </div>
            <a href="cart.html" id="addtocart"><router-link to='/cart'>ADD TABLE</router-link></a>
            <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
            </div>
            </li>
            
            <li>
            <div class="shop_thumb"><a href="shop.html"><img src="images/photos/photo3.jpg" alt="" title="" /></a></div>
            <div class="shop_item_details">
            <h4><a href="shop.html">Summer T-Shirt</a></h4>
            <div class="shop_item_price">$1200</div>
              <div class="item_qnty_shop">
                  <form id="myform" method="POST" action="#">
                      <input type="button" value="-" class="qntyminusshop" field="quantity3" />
                      <input type="text" name="quantity3" value="1" class="qntyshop" />
                      <input type="button" value="+" class="qntyplusshop" field="quantity3" />
                  </form>
              </div>
            <a href="cart.html" id="addtocart"><router-link to='/cart'>ADD TABLE</router-link></a>
            <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
            </div>
            </li>   
            
            <li>
            <div class="shop_thumb"><a href="shop.html"><img src="images/photos/photo4.jpg" alt="" title="" /></a></div>
            <div class="shop_item_details">
            <h4><a href="shop-item.html">Valentines Gift</a></h4>
            <div class="shop_item_price">$175</div>
              <div class="item_qnty_shop">
                  <form id="myform" method="POST" action="#">
                      <input type="button" value="-" class="qntyminusshop" field="quantity4" />
                      <input type="text" name="quantity4" value="1" class="qntyshop" />
                      <input type="button" value="+" class="qntyplusshop" field="quantity4" />
                  </form>
              </div>
            <a href="cart.html" id="addtocart">ADD TABLE</a>
            <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
            </div>
            </li>
            
            <li>
            <div class="shop_thumb"><a href="shop-item.html"><img src="images/photos/photo5.jpg" alt="" title="" /></a></div>
            <div class="shop_item_details">
            <h4><a href="shop.html">Rocket Toy</a></h4>
            <div class="shop_item_price">$435</div>
              <div class="item_qnty_shop">
                  <form id="myform" method="POST" action="#">
                      <input type="button" value="-" class="qntyminusshop" field="quantity5" />
                      <input type="text" name="quantity5" value="1" class="qntyshop" />
                      <input type="button" value="+" class="qntyplusshop" field="quantity5" />
                  </form>
              </div>
            <a href="cart.html" id="addtocart">ADD TABLE</a>
            <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
            </div>
            </li> 
            
        </ul>

      
            <div class="shop_pagination">
            <a href="shop.html" class="prev_shop">PREV PAGE</a>
            <span class="shop_pagenr">1/37</span>
            <a href="shop.html" class="next_shop">NEXT PAGE</a>
            </div>
        
        
            <div class="text-center">
                    <router-link to='/cart' class="btn btn-block">View Table</router-link>
                    </div>

        </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
        
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
