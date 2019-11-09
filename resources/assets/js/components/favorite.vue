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
                           <li class="breadcrumb-item active" aria-current="page">FAVORITE FOOD ({{fav_count}})</li>
                   
                         </ol>
                       </nav>
        
                         <!-- ********************************************** empty -->
                         
                      <div v-if='empty' class='text-center alert alert-info'>
                      You Have No Food Favorite. <router-link class='text-center button_full btyellow' to='/shop'>Add Now</router-link>
                             </div>
     

      <div class="page_single layout_fullwidth_padding">
       
        <ul class="shop_items ">
              
          <li class='animated tdPlopIn' v-for='con in content' v-bind:key='con.id'>
          <div class="shop_thumb">
              <v-img 
              :src="'/storage/food/'+con.img"
              :alt="con.title"
              :lazy-src="`/images/black-spinner.gif`"
              title=""
              class='img_size'  ></v-img>
          </div>
          <div class="shop_item_details">
             
          <favUpdate
          :con=con
          :stash=con.qty
          >
          </favUpdate>
           
          </div>
          <p class="info">
            <v-icon>restaurant</v-icon> food by {{con.vendor_name}}
             <br>
             <v-icon class='icon-shift'>my_location</v-icon> {{con.vendorAddress}}
           </p>
          </li> 
      </ul>
        
      <span v-if='!empty'><!---->
        <router-link to="/cart" class="button_full btyellow slideUp">VIEW TABLE</router-link>    
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
            }
        },

        methods: {
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
                })
                .catch(error =>{
                    //off loader
                    this.overlay = !this.overlay
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
