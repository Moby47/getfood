<template>
       
<div>
    <span v-if='stash > 0'>
        <div class="item_qnty_shop">
                <form id="myform" method="POST" action="#">
              <input :disabled='qty==1' type="button" value="-" class="qntyminusshop" field="quantity" @click.prevent='decre()'/>
                    <input type="text" name="quantity" :value="qty" class="qntyshop" />
                    <input type="button" value="+" class="qntyplusshop" field="quantity" @click.prevent='incre()'/>
                </form>
            </div>

        <a  href="#" v-if="isAdded" id="addtocart" @click.prevent='removeFromCart(con)' >CLEAR FOOD</a>

        <a   href="#" v-if="!isAdded" id="addtocart" @click.prevent='addToCart(con)' >ADD TO TABLE</a>
        </span>
        <div v-if='stash < 1'>
            Out of stock
      </div>
</div>

                        
</template>

<script>
    export default {

        props: ['con','stash'],
//
data: function() {
    return {
        isAdded: false,
        qty:1,
    }
},

        methods: {
            addToCart(con) {
                NProgress.start();
                this.isAdded = !this.isAdded

                if(!localStorage.getItem('tempUserCartID')){
                    var tempUserCartID = Math.floor(Math.random()*10000);
                     localStorage.setItem('tempUserCartID',tempUserCartID);
                     console.log('created id')
                }
                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID'),'qty':this.qty};
                axios.post('/add-to-cart',input)
                        .then(res=>{
                            if(res.data == 1){
                        this.$toasted.show("Food added to Cart!");
                            }
                            NProgress.done();
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to add. Try again");
                  this.isAdded = !this.isAdded
                    NProgress.done();        
                      })
            },

            removeFromCart(con) {
               
                NProgress.start();
                this.isAdded = !this.isAdded
                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};
                axios.post('/remove-from-cart',input)
                        .then(res=>{
                            if(res.data == 1){
                        this.$toasted.show("Food removed from Cart!");
                            }
                            NProgress.done();
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to remove. Try again");
                    NProgress.done();        
                      })
            },

            incre(){
                this.qty = this.qty + 1;
            },
            decre(){
                this.qty = this.qty - 1;
            },
        }
    }
</script>