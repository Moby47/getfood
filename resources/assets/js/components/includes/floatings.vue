<template>
    <div>

        <!--floating left-->
			<v-btn 
			fab 
			dark
			color="info"
			small
			relative
			bottom
			left
			fixed
			  >
			<v-icon dark>close</v-icon>
			</v-btn>
          <!--  floating left-->
            
            <router-link to='/checkout'>	
			 <v-btn 
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
            </router-link>

            </div>
        </template>        


			


             <script>

import {eventBus} from "../../app.js";

            export default {
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

           mounted(){
               
             if(localStorage.getItem('cart')){
                this.count = localStorage.getItem('cart')
            }else{
                this.count = 0;
            }
              
           }

           }
			</script>
