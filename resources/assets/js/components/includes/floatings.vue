<template>
    <div>

        <!--floating left-->
			<v-btn 
      v-if='toggle_cart == true'
			fab 
			dark
			color="info"
			small
			relative
			bottom
			left
      fixed
      @click.prevent='clear_cart()'
       id='clearBtn'
			  >
			<v-icon dark>remove_shopping_cart</v-icon>
			</v-btn>
      <!--tooltip-->
           <b-tooltip show target="clearBtn">Clear table</b-tooltip>
          <!--  floating left-->
            
            <a @click.prevent='checkout()'  v-if='toggle_cart == false' >	
			 <v-btn 
:disabled='!online'
			 fab 
			 dark
			 color="#fbc25b"
			 small
			 relative
			 bottom
			 right
			 fixed
			   >
               {{count}} <v-icon dark > shopping_cart</v-icon> 
			 </v-btn>
            </a>

            </div>
        </template>        


			


             <script>

import {eventBus} from "../../app.js";

            export default {

                props: ['toggle_cart','online'],

               data: () => ({
					count:'',				
            }),
            
            created(){

            eventBus.$on('cart_status', ()=>{

            //get user cart count from DB
            fetch('/cartCount/'+ localStorage.getItem('tempUserCartID'))
                .then(res => res.json())
                .then(res=>{
            var cart_count = res;
            //save to local storage
            localStorage.setItem('cart', cart_count )
            //fetch the store and append
           this.count = localStorage.getItem('cart')
                })

            })


           },
           methods:{

            checkout(){
                  if(localStorage.getItem('userToken')){
                    //authed, proceed
                 this.$router.push({name: "checkout"});
                  }else{
                    //auth needed
                  //set variable to redirect to checkout page after guest auth
                  localStorage.setItem('shopper','shopper')
                  //send to login
                   this.$router.push({name: "login"});
                  }
                  
                },

            clear_cart(){

              var dialog =  confirm('You are about to clear the table...');

            if(dialog){
               NProgress.start();
      this.$toasted.show("Clearing Cart...");
               //clear cart
               var input = {'userId':localStorage.getItem('tempUserCartID')}
            axios.post('/clear-cart',input).then(res=>{
                console.log('cart cleared')
                this.$toasted.show("Cart Cleared!");  
                 //clear cart count
                      localStorage.removeItem('cart')

            NProgress.done();
          //redirect to food page
          this.$router.push({name: "kitchen"});
            })
            .catch(error =>{
              NProgress.done();
                console.log(error)    
               })
            }
             
            },


           },

           mounted(){
               
             if(localStorage.getItem('cart')){
                this.count = localStorage.getItem('cart')
            }else{
                this.count = 0;
            }
              
           }

           }
			</script>
