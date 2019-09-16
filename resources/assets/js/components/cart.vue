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
                           <li class="breadcrumb-item active" aria-current="page">Food ({{cartConCount}})</li>
                         </ol>
                       </nav>
                
      <div class="page_single layout_fullwidth_padding">	
        
           <div class="cartcontainer">   
                    
              
 
                          <!--loading -->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
<div v-if='data_load' class='text-center'>
<template>
   <b>  Fetching Food</b>
  <v-progress-circular 
  color="orange"
  indeterminate
  ></v-progress-circular>
         </template>
          </div>
 </transition>

   <!-- ********************************************** empty -->
                      
   <div v-show='empty < 1' class='text-center alert alert-info'>
        Sorry, your Table is empty.
             </div>
                               
      <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
             <div v-if='wait' class='text-center'>
               <template>
                 <b>A little delay, please wait.</b>
                  <v-progress-circular 
                 color="red"
                 indeterminate
                 >
                 </v-progress-circular>
                         </template>
                          </div>
                 </transition>

                <div class="cart_item" id="cartitem1" v-for='con in content' v-bind:key='con.id'>
                   
                    <cartUpdate
                    :con=con
                    >

                    </cartUpdate>
                  
                </div>
              
              
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
                content:[],
                wait:false,
                data_load: true,
                empty:47,
                cartConCount:''
            }
        },

        methods: {
            fetch(){
                  
                  fetch('/cart-items'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
                    console.log(this.content)
                    this.wait = false;
                   this.empty = this.content.length;
                  })
                  .catch(error =>{
                      //off loader
                      this.data_load = false;
                        this.wait = true;
                        setTimeout(func=>{
                            this.fetch();
                        },2000)     
                      })

                },

                countCartCon(){
                  
                  fetch('/cartCount/'+localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.cartConCount = res;
                      })
                  .catch(error =>{
                        setTimeout(func=>{
                            this.countCartCon();
                        },2000)     
                      })

                },

        },
        watch : {
              content(a,b){
               if(a){
                //data content loaded, it is safe to display
                this.data_load = false;
                this.data = true;
               }
            },
        },

        mounted() {
            this.fetch()
            this.countCartCon()
        }
    }
</script>
