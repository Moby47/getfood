<template>
  <div class="container">
     
        <template>
          <div>
            <!--floating right-->
            <v-btn 
            fab 
            dark
            color="#fbc25b"
            small
            relative
            top
            right
            fixed
            @click.prevent='modal()'
            id='sortBtn'
              >
            <v-icon dark>sort</v-icon>
            </v-btn>
             <!--tooltip-->
             <b-tooltip :show.sync="show2" target="sortBtn" placement="bottom">
                Filter by<strong> Vendor</strong>
               </b-tooltip>
                <!--  floating right-->
                  </div>



                  <div>
                      <!--floating left-->
                      <v-btn 
                      fab 
                      dark
                      color="#fbc25b"
                      small
                      relative
                      bottom
                      left
                      fixed
                      @click.prevent='fetch()'
                      id='refreshbBtn'
                        >
                      <v-icon dark>refresh</v-icon>
                      </v-btn>
                      <!--tooltip-->
                      <b-tooltip :show.sync="show" target="refreshbBtn" placement="top">
                         Refresh <strong>Food List</strong>
                        </b-tooltip>

                          <!--  floating left-->
                            </div>
              </template>    
   
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
                    <li class="breadcrumb-item active" aria-current="page">Available Food ({{food_count}}) </li>
                    
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
                       All Kitchens are Currently Empty.
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
        <b> Fetching Food. Please Wait..</b>
              </template>
               </div>
      </transition>
                                    
           <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                  <div v-if='wait' class='text-center'>
                    <template>
                      <b>Reloading Food List. please Wait..</b>
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

      <!-- all food pagination-->
          <div class="shop_pagination slideUp" v-if='currentContent'>
              <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                    v-if='content.length > 5'
                  >
          <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
          <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
          <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
        </v-card>
      </template>
        </div>
      <!-- all food pagination-->

       <!-- sorted food pagination-->
       <div class="shop_pagination slideUp" v-if='!currentContent'>
          <template>
              <v-card
                class="mx-auto"
                max-width="344"
                v-if='content.length > 5'
              >
      <a href="" class="prev_shop" @click.prevent="sorted(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
      <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
      <a href="" class="next_shop" @click.prevent="sorted(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
    </v-card>
  </template>
    </div>
  <!-- sorted food pagination-->

          <div class="my-2 text-center" >
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


 <!--modal-->
 <div>
    <b-modal id="modal" scrollable title="" hide-footer >
     
        <template>
            <v-card
              class="mx-auto"
              max-width="500"
              tile
            >
             
            <form>
                <div class="mt-4 form-group p-1">
                  <label>Select a Vendor</label>
      <select class="form-control" id="exampleInputEmail1"  v-model='selected'> 
      <option :value='ven.name' v-for='ven in vendor_list' v-bind:key='ven.id'>
      {{ven.name.slice(0, 25)}} - {{ven.address.slice(0, 25)}} 
      </option>
      </select>

      <div v-if='awaitingList' class='text-center alert alert-info'>
          <template>
              <b> {{awaitingList}} </b>
           
                    </template>
                     </div>

        
           </div>      
              </form>

            </v-card>
          </template>

    </b-modal>
  </div>
<!--modal-->


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
              food_count:0,
              toggle_cart:false,

              currentContent:true,

              //vendor
              selected:'',
              vendor_list:[],
              awaitingList:'',
              overlay:false,
              
              show:false,
              show2:null,
          }
      },
  
      methods: {

        modal(){
          this.$bvModal.show('modal')
          this.show2 = true
         },

       cart(){
            this.$router.push({ name: "cart" })
          },

  fetch(page_url){
                  if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay = !this.overlay
                    this.show = !this.show
                  }
                var   page_url = page_url || '/get-foods';
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                  this.overlay = !this.overlay
                // console.log(this.content)

                 

                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                              this.currentContent = true
                          }
                  //to determine if obj is empty
                  this.makePagination(res.meta, res.links);
                  this.wait = false;
                  this.food_count = res.meta.total;
                  NProgress.done();
                })
                .catch(error =>{
                    //off loader
                    this.overlay = !this.overlay
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

              vendors(){
                //fetch vendor list
                this.awaitingList = 'Loading Vendor List. Please wait..'
                fetch('/vendor-list')
                .then(res => res.json())
                .then(res=>{
                  this.vendor_list = res;
                  if(res[0] == undefined){
                    this.awaitingList = 'No Vendor Available..'
                          }else{
                            this.awaitingList = ''
                          }
                  
                })
                .catch(error =>{
                    //off loader text
                    console.log(error)
                      setTimeout(func=>{
                          this.vendors();
                      },2000)     
                    })
                },
            

                sorted(page_url){
                  
                  if(page_url){
                  NProgress.start();
                  }else{
                    this.awaitingList ="Cheking "+this.selected+"'s Kitchen. Please wait"
                  }
                  var   page_url = page_url || '/vendor-food/'+this.selected;
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                 
                   //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                            this.$toasted.show(this.selected +"'s Kitchen is Empty")
                          }else{
                            this.content = res.data;
                            this.currentContent = false
                            this.$bvModal.hide('modal')
                            this.food_count = res.meta.total;
                          }
                  //to determine if obj is empty
                  this.awaitingList = ''
                  this.makePagination(res.meta, res.links);
                  NProgress.done();
                })
                .catch(error =>{
                    //off loader
                    alert('An Error Occured, Please Try Again..')
                    console.log(error)
                      NProgress.done();        
                    })
              },

      }, //meth end

           //watch data load
           watch : {
            content(a,b){
             if(a){
              //data content loaded, it is safe to display
              this.data_load = false;
              this.data = true;
             }
          },

          //watch and load when a vendor is selected
          selected(a,b){
             if(a){
              console.log('selected vendor')
              this.sorted()
             }
          },
      },
      
      mounted() {
          this.fetch()
          this.vendors()

           //put dynamic data
           
var dbPromise = idb.open('posts-store', 1, function (db) {
    if (!db.objectStoreNames.contains('posts')) {
      db.createObjectStore('posts', {keyPath: 'id'});
    }
  });
  //write
            var   page_url = '/get-foods';
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  var data = res.data
                 console.log(data)
                 
                for(var key in data){
                   console.log(key)
                    dbPromise
                .then(function(db) {
                  var tx = db.transaction('posts', 'readwrite');
                  var store = tx.objectStore('posts');
                  store.put(data[key]);
                  return tx.complete;
                });
                }
  //read
  
                })
    

      /*        
  if (event.request.url.indexOf(url) > -1) {
    event.respondWith(fetch(event.request)
      .then(function (res) {
         console.log(res)
        var clonedRes = res.clone();
        clonedRes.json()
          .then(function(data) {
            for (var key in data) {
              dbPromise
                .then(function(db) {
                  var tx = db.transaction('posts', 'readwrite');
                  var store = tx.objectStore('posts');
                  store.put(data[key]);
                  return tx.complete;
                });
            }
          });
        return res;
      })
    );
  }
  */
                 //put dynamic data
      },
     
      
  }
</script>