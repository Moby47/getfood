<template>
  <div class="container">
      <menubar></menubar>
<div class="pages">
  <div data-page="shop" class="page no-toolbar no-navbar">
    <div class="page-content">
     <div id="pages_maincontent">
      
      <br>
          <nav aria-label="breadcrumb ">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">AVAILABLE FOOD ({{food_count}})</li>
                   
                  </ol>
                </nav>
      
                    <!-- ********************************************** empty -->
                         
                      <div v-if='empty' class='text-center alert alert-info'>
                         Sorry, The Kitchen is Empty.
                              </div>
      
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
                                    
           <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                  <div v-if='wait' class='text-center'>
                    <template>
                      <b>Kitchen delay, please wait.</b>
                       <v-progress-circular 
                      color="red"
                      indeterminate
                      >
                      </v-progress-circular>
                              </template>
                               </div>
                      </transition>
           

    <div class="page_single layout_fullwidth_padding">
      
      
      <ul class="shop_items ">
              
          <li class='animated tdPlopIn' v-for='con in content' v-bind:key='con.id'>
          <div class="shop_thumb">
              <v-img 
              :src="'/storage/food/'+con.img"
              :alt="con.title"
              :lazy-src="`/images/black-spinner.gif`"
              title=""
              class='img_size' ></v-img>  
          </div>
          <div class="shop_item_details">
          <h4>{{con.title}}</h4>
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
          
          <p class="info">
           <v-icon>restaurant</v-icon> {{con.vendor_name}}
            <br>
            <v-icon class='icon-shift'>my_location</v-icon> {{con.vendorAddress}}
          </p>

          </li> 
         
      </ul>

    <span v-if='!empty'>
          <div class="shop_pagination slideUp" >
          <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
          <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
          <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
          </div>
      
      
          <router-link to="/cart" class="button_full btyellow slideUp">VIEW TABLE</router-link>           
        
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