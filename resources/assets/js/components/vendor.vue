<template>
        <div class="container">
            <menubar></menubar>
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent">
                   
                      <br>
                   
    
                 <div class=''>
                    <main role="main" class="container">
      
       <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
                            <nav aria-label="breadcrumb ">
                                    <ol class="breadcrumb">
                          <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                                      <li class="breadcrumb-item"><router-link to='/shop'>Kitchen</router-link></li>
                                      <li class="breadcrumb-item active" aria-current="page" >Vendors</li>
                                      
                                    </ol>
                                  </nav>
                        </v-card>
       </template>



              <v-card
               class="mx-auto"
                 max-width="344"
                 max-height='90'
               >
                        <form>
                            <div class="mt-4 form-group p-1">
                              <label>Select a Vendor</label>
       <select class="form-control" id="exampleInputEmail1"  v-model='selected'> 
        <option :value='ven.name' v-for='ven in vendor_list' v-bind:key='ven.id'>
          {{ven.name.slice(0, 25)}} - {{ven.address.slice(0, 25)}} 
        </option>
        </select>
                       </div>
                <p class='text-center' v-if='selected' v-show='content.length > 0'> ({{food_count}}) Result Found</p>           
                            <br>
                            <br>
                          </form>

                            <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='wait' class='text-center'>
                       <template>
                         <p>Reloading Vendor List.</p>
                          <v-progress-circular 
                         color="#f2901d"
                         indeterminate
                         >
                         </v-progress-circular>
                                 </template>
                                  </div>
                         </transition>

              </v-card>

                  <!-- res here-->    
                  <div v-if='empty' class='text-center alert alert-info'>
                        Sorry. This Kitchen is Empty.
                             </div>   

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
          
          <p class="info">
           <v-icon>restaurant</v-icon> {{con.vendor_name}}
            <br>
            <v-icon class='icon-shift'>my_location</v-icon> {{con.vendorAddress}}
          </p>

</v-card>
</template>

          </li> 
         
      </ul>


    <span v-if='!empty' v-show='selected'>
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
      
          <div class="my-2 text-center" v-if='content.length > 0'>
          <v-btn @click.prevent='cart()' outlined color="#FFA500">VIEW TABLE</v-btn>   
          </div>

   </span>

    



      </div>


                      </main>
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
    
    <style scoped>
    .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
          }
    
          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
    
    
          /*-- Custom styles for this template -->*/
    
          html,
    body {
      overflow-x: hidden; /* Prevent scroll on narrow devices */
    }
    
    body {
      padding-top: 56px;
    }
    
    @media (max-width: 991.98px) {
      .offcanvas-collapse {
        position: fixed;
        top: 56px; /* Height of navbar */
        bottom: 0;
        left: 100%;
        width: 100%;
        padding-right: 1rem;
        padding-left: 1rem;
        overflow-y: auto;
        visibility: hidden;
        background-color: #343a40;
        transition: visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
        transition: transform .3s ease-in-out, visibility .3s ease-in-out;
        transition: transform .3s ease-in-out, visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
      }
      .offcanvas-collapse.open {
        visibility: visible;
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }
    
    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }
    
    .nav-scroller .nav {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: nowrap;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      color: rgba(255, 255, 255, .75);
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
    
    .nav-underline .nav-link {
      padding-top: .75rem;
      padding-bottom: .75rem;
      font-size: .875rem;
      color: #6c757d;
    }
    
    .nav-underline .nav-link:hover {
      color: #007bff;
    }
    
    .nav-underline .active {
      font-weight: 500;
      color: #343a40;
    }
    
    .text-white-50 { color: rgba(255, 255, 255, .5); }
    
    .bg-purple { background-color: #6f42c1; }
    
    .lh-100 { line-height: 1; }
    .lh-125 { line-height: 1.25; }
    .lh-150 { line-height: 1.5; }
      </style>
    
    <script>
        export default {
    
            data(){
                return {
                 selected:'',
                  content:[],
                  pagination: [],
                  overlay:false,
                  empty:false,
                  food_count:'',
                  vendor_list:[],
                  wait:false
                }
            },
    
            methods: {
    
    cart(){
            this.$router.push({ name: "cart" })
          },
                fetch(page_url){
                  if(page_url){
                  NProgress.start();
                  }else{
                      this.overlay = !this.overlay
                  }
                var   page_url = page_url || '/vendor-food/'+this.selected;
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                  this.overlay = false
                    
                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                  //to determine if obj is empty
                  this.makePagination(res.meta, res.links);
                 
                  this.food_count = res.meta.total;
                  NProgress.done();
                })
                .catch(error =>{
                    //off loader
                    this.overlay = false
                        
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
    

              vendors(){
                //fetch vendor list
                this.overlay = !this.overlay
                fetch('/vendor-list')
                .then(res => res.json())
                .then(res=>{
                  this.vendor_list = res;
                  this.wait = false;
                  this.overlay = !this.overlay
                })
                .catch(error =>{
                    //off loader
                    this.overlay = false
                    this.wait = true;
                      setTimeout(func=>{
                          this.vendors();
                      },2000)     
                    })
              }

           
            },


            watch : {
            selected(a,b){
             if(a){
              console.log('selected vendor')
              this.fetch()
             }
          },
      },
            mounted() {
              //get url param #vendorName
      var param = this.$route.params.vendorName;

      if (param){
        this.selected = param
        this.fetch()
      }
             this.vendors()
            }
        }
    </script>
    