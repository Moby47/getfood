<template>
  <div class="container">
     
        <template>
          <div>
            <!--floating right :disabled='offline'-->
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
                    <li  class="breadcrumb-item active" aria-current="page">Available Food ({{food_count}}) </li>
                  
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
      
                               <!--loading 
   <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
  <div v-if='data_load' class='text-center'>
    <template>
        <b> Fetching Food. Please Wait..</b>
              </template>
               </div>
      </transition>
                            -->        
           <!--loading temp
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                  <div v-if='wait' class='text-center'>
                    <template>
                      <b>Reloading Food List. please Wait..</b>
                              </template>
                               </div>
                      </transition>
         -->  

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
              v-if='online'
              :src="'/storage/food/'+con.img"
              :alt="con.title"
              :lazy-src="`/images/black-spinner.gif`"
              title=""
              class='img_size' ></v-img>
              <v-img 
              v-else
              :src="`/images/food.png`"
              :alt="con.title"
              :lazy-src="`/images/food.png`"
              title=""
              class='img_size' ></v-img>
          </div>
          <div class="shop_item_details">
              <h4 class="text-capitalize">{{con.title}}</h4>
              <div class="shop_item_price"><strike>N</strike>{{con.amt}}</div>

          <cartAdd
          :con=con
          :stash=con.qty
           :online=online
          >
          </cartAdd>
        
          <favButton
          :id=con.id
          :online=online
          >
          </favButton>

          
          </div>




          <p class="info text-capitalize">
             <template>
  <div class="">
    <v-chip
      class="ma-2 mb-1 white"
      small
      outlined
    >
      <v-icon left >local_shipping</v-icon>
      <span v-if='con.delivery == 1'>Yes</span> <span v-else>No</span>
    </v-chip>
  </div>
</template>
            <template>
  <div class="">
    <v-chip
      class="ma-2 mb-1 white"
      small
      outlined
    >
      <v-icon left>local_dining</v-icon>
     {{con.vendor_name}}
    </v-chip>
  </div>
</template>
              <template>
  <div class="">
    <v-chip
      class="ma-2 mb-1 white"
      small
      outlined
    >
      <v-icon left>beenhere</v-icon>
     {{con.vendorAddress}}
    </v-chip>
  </div>
</template>
            

             </p>

          </v-card>
          </template>

          </li> 
      </ul>

    <span v-if='!empty'>

      <!-- all food pagination ****************************************** v-if='content.length > 5' not 1-->
          <div class="shop_pagination slideUp" v-if='currentContent'>
              <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                    v-if='food_count > 10'
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
                v-if='food_count > 10'
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
          <br>
          Getting Food...
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
      <select class="form-control"   v-model='selected'> 
      <option :value='ven.name' v-for='ven in vendor_list' v-bind:key='ven.id'>
      {{ven.name.slice(0, 25)}} - {{ven.address.slice(0, 25)}} 
      </option>
      </select>

      <div v-if='awaitingList' class='text-center alert alert-primary'>
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
:online=online
>
</floatings>

  </div>
</template>


<script>


  export default {

       //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: ' GetFoods - Kitchen listings',
         meta: [{
           'name': 'description',
        'content': 'Online food reservation and ordering platform to maintain a reliable and efficient system',
      }],
      noscript: [
      { innerHTML: 'JavaScript is required.' }
    ]
    },
    //meta
      data(){
          return {
              content:[],
              empty:false,
            //  wait:false,
             // data_load: true,
              pagination: [],
              food_count:'0',
              toggle_cart:false,
              offline:false,
              currentContent:true,

              //vendor
              selected:'',
              vendor_list:[],
              awaitingList:'',
              overlay:false,
              
              show:false,
              show2:null,

              online:null
          }
      },
  
      methods: {

        modal(){
          this.$bvModal.show('modal')
          this.show2 = true
         },

       cart(){
            this.$router.push({ name: "table" })
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
                  var data = this.content = res.data;
                  this.overlay = false
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
                 // this.wait = false;
                  this.food_count = res.meta.total;
                  NProgress.done();
                })
                .then(res=>{
                /*  setTimeout(func=>{
                    this.clearAndWriteData('foods',this.content)
                      },8000)*/
                })
                .catch(error =>{
                  console.log(error)
                    //off loader
                    this.overlay = false
                   // this.data_load = false;
                     // this.wait = true;
                      NProgress.done();   
                      
                      //offline data
                      this.readAllData('foods')
                      this.food_count = '-'
                      this.$toasted.show("Offline Mode");
                      this.offline = true
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
                 .then(res=>{
                 /* setTimeout(func=>{
                    this.clearAndWriteData('vendor-list',this.vendor_list)
                      },9000)
                      */
                })
                .catch(error =>{
                  this.awaitingList = '' 
                    //off loader text
                    console.log(error)
                       //offline data
                      this.readAllVendorList('vendor-list')   
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




              //*****************************************************indexed DB methods


              readAllData(table){ //param = name of store/table
                this.overlay = !this.overlay
                var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains(table)) {
                db.createObjectStore(table, {keyPath: 'id'});
              }
            });
              
             //read
            function readAllData(table){
            return dbPromise.then(function(db){
              var tx = db.transaction(table, 'readonly');
              var store = tx.objectStore(table);
              return store.getAll();
            })
            .catch(error =>{
                    console.log(error)    
                    })
          }
          //call fetch indexeddb
          readAllData(table)
          .then(res=>{
            //gives a promise to use data
            this.content = res
            this.overlay = !this.overlay
            console.log('fetched from inDB:',this.content)
          })
          .catch(error =>{
                    console.log(error)    
                    })
              }, //end readAllData



readAllVendorList(table){
   
                var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains(table)) {
                db.createObjectStore(table, {keyPath: 'id'});
              }
            });
              
             //read
            function readAllData(table){
            return dbPromise.then(function(db){
              var tx = db.transaction(table, 'readonly');
              var store = tx.objectStore(table);
              return store.getAll();
            })
            .catch(error =>{
                    console.log(error)    
                    })
          }
          //call fetch indexeddb
          readAllData(table)
          .then(res=>{
            //gives a promise to use data
            this.vendor_list = res
            if(res[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                          
            this.awaitingList = 'Offline mode'
            console.log('fetched from inDB venlist:',this.vendor_list)
          })
          .catch(error =>{
                    console.log(error)    
                    })
},


            clearAndWriteData(table,data){
                var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains(table)) {
                db.createObjectStore(table, {keyPath: 'id'});
              }
            });
              console.log('data to save:',data)
          //clear data func
          function clearAllData(table){
              return dbPromise
              .then(function(db){
                  var tx = db.transaction(table, 'readwrite');
                  var store = tx.objectStore(table);
                  store.clear();
                  return tx.complete
                })
                .catch(error =>{
                    console.log(error)    
                    })
              }
              //call clear
              clearAllData(table)
              .then(function(){
                //gives a promise 
                for(var key in data){
                dbPromise
            .then(function(db) {
              var tx = db.transaction(table, 'readwrite');
              var store = tx.objectStore(table);
              for(var i in data){
              store.put(data[i]);
              }
              console.log('saved to indexdb')
              return tx.complete;
            })
            .catch(error =>{
                    console.log(error)    
                    })
            }
              })
              .catch(error =>{
                    console.log(error)    
                    })
            }, //end of clear and write data


               // ************************indexed DB methods


      /*         askForNotificationPermission() {
  Notification.requestPermission(function(result) {
    console.log('User Choice', result);
    if (result !== 'granted') {
      console.log('No notification permission granted!');
    } else {
      console.log('notification permission granted!');
    }
  });
},
*/

      }, //meth end

           //watch data load
           watch : {
            content(a,b){
             if(a){
              //data content loaded, it is safe to display
            //  this.data_load = false;
              this.data = true;
             }
          },

          //watch and load when a vendor is selected
          selected(a,b){
             if(a){

              console.log('selected vendor')
               var online = navigator.onLine; 
            if(!online){
                //not online
                console.log('not online')
                this.$toasted.show("This feature is currently unsupported in offline mode...");
                this.awaitingList = 'Offline mode'
                return;
            }

              this.sorted()
             }
          },
      },
      
      mounted() {

         // ask for notification
         //this.askForNotificationPermission()

          var online = navigator.onLine; 
            if(online){
                //online
                console.log('on')
                this.online = true;
                this.fetch()
              this.vendors()
            }else{
                //offline
                console.log('off')
                this.online = false;
                this.readAllVendorList('vendor-list')
                this.readAllData('foods')
                      this.food_count = '-'
                      this.$toasted.show("Offline mode...");
            }

             setTimeout(func=>{
                    this.clearAndWriteData('vendor-list',this.vendor_list)
                      },7000)
                      setTimeout(func=>{
                    this.clearAndWriteData('foods',this.content)
                      },5000)
      },
     
      
  }
</script>