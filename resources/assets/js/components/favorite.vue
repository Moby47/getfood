<template>
    <div class="container">
        
<div class="pages">
    <div data-page="shop" class="page no-toolbar no-navbar">
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
                           <li class="breadcrumb-item active" aria-current="page">Favorite Food(s) ({{fav_count}})</li>
                   
                         </ol>
                       </nav>
                  </v-card>
              </template>
                         <!-- ********************************************** empty -->
                         
                         <span v-if='empty'>

                            <template>
                                <v-card
                                  class="mx-auto"
                                  max-width="344"
                                >
                            <template>
                          <div>
                            <v-alert
                              color="#FFA500"
                              dark
                              icon="favorite"
                              border="left"
                              prominent
                            >
                             You Have No Favorite Food Yet. 
                            </v-alert>
                          </div>
                        </template>

                        </v-card>
                        </template>


      <div class="my-2 text-center">
    <v-btn @click.prevent='shop()' outlined color="#FFA500">Add Food</v-btn>   
    </div>
                         </span>

                          <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='wait' class='text-center'>
                       <template>
                         <p>Reloading Favorite Food(s).</p>
                          <v-progress-circular 
                         color="#f2901d"
                         indeterminate
                         >
                         </v-progress-circular>
                                 </template>
                                  </div>
                         </transition>


      <div class="page_single layout_fullwidth_padding">
       
          <ul class="shop_items ">
              
              <li class='animated tdPlopIn' v-for='con in content' v-bind:key='con.id'>

                  <template>
                      <v-card
                        class="mx-auto elevation-23 p-1"
                        max-width="344"
                        outlined
                      >
              <div class="shop_thumb">
                  <v-img 
                  :src="'/storage/food/'+con.img"
                  :alt="con.title"
                  :lazy-src="`/images/black-spinner.gif`"
                  title=""
                  class='img_size' ></v-img>
              </div>
              <div class="shop_item_details">
                 
              <favUpdate
              :con=con
              :stash=con.qty
              >
              </favUpdate>
               
              </div>

              <p class="info text-capitalize">
                  <v-icon>restaurant</v-icon> {{con.vendor_name}}
                   <br>
                   <v-icon class='icon-shift'>my_location</v-icon> {{con.vendorAddress}}
                 </p>
                 
              </v-card>
              </template>

              </li> 
          </ul>
            
        
      <span v-if='!empty'><!---->
         <div class="my-2 text-center">
          <v-btn @click.prevent='cart()' outlined color="#FFA500">GOTO TABLE</v-btn>   
          </div>
         </span>
        </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
     <!--Overlay-->
  <template>
    <div class="text-center">
      <v-overlay :value="overlay">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>
    </div>
  </template>
  <!--Overlay-->



<back></back>


    </div>
</template>


      
<script>
    export default {

        data(){
            return {
              overlay:false,
              content:[],
              empty:false,
              fav_count:0,
              wait:false
            }
        },

        methods: {
              shop(){
            this.$router.push({ name: "shop" })
          },
          cart(){
            this.$router.push({ name: "cart" })
          },
          fetch(){
            this.overlay = !this.overlay
                fetch('/get-fav/'+ localStorage.getItem('userId'))
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                //  console.log(this.content)
                  //to determine if obj is empty 
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                  //to determine if obj is empty
                  this.fav_count = res.meta.total;
                  this.overlay = !this.overlay
                  this.wait = false;
                })
                .catch(error =>{
                    //off loader
                    this.overlay = false
                    this.wait = true;
                      setTimeout(func=>{
                          this.fetch();
                      },2000)
                              
                    })
                    
               
              },
        },

        mounted() {
            this.fetch()
        }
    }
</script>
