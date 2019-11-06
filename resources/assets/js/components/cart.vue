<template>
    <div class="container">
      <menubar></menubar>
<!--content here-->

<div class="pages">
    <div data-page="cart" class="page no-toolbar no-navbar">
      <div class="page-content">
            <div id="pages_maincontent">
             
             <br>
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                           <li class="breadcrumb-item"><router-link to='/shop'>Kitchen</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page">SELECTED FOOD ({{cartConCount}})</li>
                         </ol>
                       </nav>
                
      <div class="page_single layout_fullwidth_padding">	
        
           <div class="cartcontainer">   
                    
              
 
                          <!--loading 
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
-->
   <!-- ********************************************** empty -->
  
 <div v-show='empty < 1' class='text-center alert alert-info'>
  Your Table is Empty. <router-link to='/shop' class='text-center button_full btyellow'>Add Food</router-link>
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

                <div class="cart_item animated tdExpandInBounce" id="cartitem1" v-for='con in content' v-bind:key='con.id'>
                   
                    <cartUpdate
                    :con=con
                    >
                    </cartUpdate>
                  
                </div>
              
       <a @click.prevent='checkout()' v-show='cartConCount > 0' class="button_full btyellow slideUp">TAKE FOOD</a>           
                
   </div>
                
                
           </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
  
  <!--content here-->
  <template>
    <div class="text-center">
      <v-overlay :value="overlay">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>
    </div>
  </template>

  <floatings
  :display=display
  >
  </floatings>

    </div>
</template>


      
<script>
    export default {

        data(){
            return {
              overlay:false,
                content:[],
                wait:false,
                data_load: true,
                empty:47,
                cartConCount:'',
                display:true
            }
        },

        methods: {
            fetch(){
                  
                  fetch('/cart-items'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
                    //console.log(this.content)
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
                  this.overlay = !this.overlay
                  fetch('/cartCount/'+localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.cartConCount = res;
                    this.overlay = !this.overlay
                      })
                  .catch(error =>{
                    this.overlay = !this.overlay
                        setTimeout(func=>{
                            this.countCartCon();
                        },2000)     
                      })

                },

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
                  

                }

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
