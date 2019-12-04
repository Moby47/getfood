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
                    <li class="breadcrumb-item active" aria-current="page">Available Food ({{food_count}})</li>
                   
                  </ol>
                </nav>
      </v-card>
    </template>
                    <!-- ********************************************** empty -->
                         
                      <span v-if='empty' >
                         
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
                          icon="fastfood"
                          border="left"
                          prominent
                        >
                        Sorry, The Kitchen is Empty.
                        </v-alert>
                      </div>
                    </template>

                    </v-card>
                    </template>
                              </span>
      
                               <!--loading -->
   <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
  <div v-if='data_load' class='text-center'>
    <template>
        <b> Fetching Food</b>
       <v-progress-circular 
       color="orange"
       indeterminate
       ></v-progress-circular>
              </template>
               </div>
      </transition>
                                    
           <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                  <div v-if='wait' class='text-center'>
                    <template>
                      <b>Reloading, Please Wait.</b>
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
              
          <li class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
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
          <h4 class="text-capitalize">{{con.title}}</h4>
          <div class="shop_item_price"><strike>N</strike>{{con.amt}}</div>
            
             
          <cartAdd
          :con=con
          :stash=con.qty
          >
          </cartAdd>
        
          <favButton
          :id=con.id
          >
          </favButton>

          
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

      
    <span v-if='!empty'>
          <div class="shop_pagination slideUp" v-if='content.length > 0'>
              <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
          <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
          <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
          <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
        </v-card>
      </template>

        </div>
      
          <div class="my-2 text-center" >
          <v-btn @click.prevent='cart()' outlined color="#FFA500">VIEW TABLE</v-btn>   
          </div>

   </span>

   

      </div>
      
      </div>
      
      
    </div>
  </div>
</div>
      
<floatings
:toggle_cart=toggle_cart
>
</floatings>

  </div>
</template>


<script>

 

  export default {
      data(){
          return {
              content:[],
              empty:false,
              wait:false,
              data_load: true,
              pagination: [],
              food_count:'',
              toggle_cart:false
          }
      },
  
      methods: {
       cart(){
            this.$router.push({ name: "cart" })
          },

  fetch(page_url){
                  if(page_url){
                  NProgress.start();
                  }
                var   page_url = page_url || '/get-foods';
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
             //     console.log(this.content)
                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                  //to determine if obj is empty
                  this.makePagination(res.meta, res.links);
                  this.wait = false;
                  this.food_count = res.meta.total;
                  NProgress.done();
                })
                .catch(error =>{
                    //off loader
                    this.data_load = false;
                      this.wait = true;
                      setTimeout(func=>{
                          this.fetch();
                      },2000)
                      NProgress.done();        
                    })
                    
               
              },
      
               makePagination(meta, links){
          var pagination = {
                          current_page: meta.current_page,
                          last_page: meta.last_page,
                          next_page_url: links.next,
                          prev_page_url: links.prev
                           }
            document.body.scrollTop = 0;
           document.documentElement.scrollTop = 0;
          this.pagination = pagination;
              },

            
      },
           //watch data load
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
      },
     
      
  }
</script>