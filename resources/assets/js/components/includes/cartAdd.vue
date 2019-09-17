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

        <a  href="#" v-if="isAdded" id="addtocart" @click.prevent='removeFromCart(con)' >CLEAR</a>

        <a   href="#" v-if="!isAdded" id="addtocart" @click.prevent='addToCart(con)' >RESERVE</a>
        </span>
        <div v-if='stash < 1'>
            Out of stock
      </div>

  

      <template>
        <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      >
      {{ text }}
      <v-btn
        color="blue"
        text
        @click='snackbar=!snackbar'
      >
        Close
      </v-btn>
      </v-snackbar>
      </template>


      <template>
        <div class="text-center">
          <v-overlay :value="overlay">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
          </v-overlay>
        </div>
      </template>
</div>


                        
</template>

<script>
    export default {

        props: ['con','stash'],
//
data: function() {
    return {
        overlay:false,
        snackbar: false,
        text: '',
        timeout: 3000,
        isAdded: false,
        qty:1,
    }
},

        methods: {
            addToCart(con) {
                this.overlay = !this.overlay
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
                        this.text='Food added to Cart!'
                        this.snackbar = true;
                            }
                            this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to add. Try again");
                  this.isAdded = !this.isAdded
                    this.overlay = !this.overlay        
                      })
            },

            removeFromCart(con) {
               
                this.overlay = !this.overlay
                this.isAdded = !this.isAdded
                var input = {'foodId':con.id, 'userId':localStorage.getItem('tempUserCartID')};
                axios.post('/remove-from-cart',input)
                        .then(res=>{
                            if(res.data == 1){
                                
                        this.text='Food removed from Cart!'
                        this.snackbar = true;
                            }
                           this.overlay = !this.overlay
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to remove. Try again");
                   this.overlay = !this.overlay        
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