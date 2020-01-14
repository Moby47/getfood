<template>
        <div class="container">
           
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent">
                   
                    <menubar></menubar>
                      <br>
                   
    
                 <div class=''>
                    <main role="main" class="">
      
       <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
                            <nav aria-label="breadcrumb ">
                                    <ol class="breadcrumb">
                          <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                                      <li class="breadcrumb-item"><router-link to='/kitchen'>Kitchen</router-link></li>
                                      <li class="breadcrumb-item active" aria-current="page" >Vendors</li>
                                      
                                    </ol>
                                  </nav>
                                  
                        </v-card>
       </template>

       <template>
          <v-card
            class="mx-auto"
            max-width="344"
          >
       <form>
          <div class="mt-4 form-group p-1">
            <label>Select a Vendor</label>
<select class="form-control" v-model='selected'> 
<option :value='ven.name' v-for='ven in vendor_list' v-bind:key='ven.id'>
{{ven.name.slice(0, 25)}} - {{ven.address.slice(0, 25)}} 
</option>
</select>
     </div>
<p class='text-center' v-if='selected' v-show='content.length > 0'> ({{food_count}}) Result Found</p>           
          
        </form>
</v-card>
       </template>

       <template>
          <v-card
            class="mx-auto"
            max-width="344"
          >
    <!-- <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='wait' class='text-center'>
                       <template>
                         <p>Loading Vendor List. Please wait..</p>
                                 </template>
                                  </div>
                         </transition>
-->
                         <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div  class='text-center'>
                       <template>
                         <span>{{errMessage}}</span>
                                 </template>
                                  </div>
                         </transition>

              </v-card>
</template>

                  <!-- res here-->    
                   <template>
                  <v-card
                    class="mx-auto"
                    max-width="344"
                   
                  >
                  <div v-if='empty' class='text-center alert alert-primary'>
                        Sorry. This Kitchen is Empty.
                             </div>   

                  </v-card>
                   </template>

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
            <v-icon>restaurant</v-icon> {{con.vendor_name}}
             <br>
             <v-icon class='icon-shift'>my_location</v-icon> {{con.vendorAddress}}
           </p>

        </v-card>
        </template>

        </li> 
    </ul>


    <span v-if='!empty' v-show='selected'>
       <div class="shop_pagination slideUp" v-if='food_count > 5'>
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
          <v-btn @click.prevent='cart()' outlined color="#FFA500">GOTO TABLE</v-btn>   
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
          <br>
    Loading Vendor List...
        </v-overlay>
      </div>
      </template>
      <!--Overlay-->

        <!--Overlay-->
        <template>
            <div class="text-center">
              <v-overlay :value="overlay2">
                <v-progress-circular indeterminate size="64"></v-progress-circular>
                <br>
          Checking {{selected}}'s kitchen...
              </v-overlay>
            </div>
            </template>
            <!--Overlay-->
      
<back></back>
      
          </div>
    </template>
    
    <style scoped>
    
      </style>
    
    <script>
        export default {
       //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: ' GetFoods - Vendor food listings',
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
                 selected:'',
                  content:[],
                  pagination: [],
                  overlay:false,
                  overlay2:false,
                  empty:false,
                  food_count:'',
                  vendor_list:[],
                  wait:false,
                  errMessage:'',
                  online:null
                }
            },
    
            methods: {
    
    cart(){
            this.$router.push({ name: "table" })
          },
             
          
          fetch(page_url){
                  if(page_url){
                  NProgress.start();
                  }else{
                      this.overlay2 = !this.overlay2
                  }
                var   page_url = page_url || '/vendor-food/'+this.selected;
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                  this.overlay2 = false

                  this.errMessage =''
                    
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
                    this.overlay2 = false
                        this.errMessage ='An error occured. Relaoding food list...'
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
                  
                  if(res[0] == undefined){
                    this.$toasted.show('No Vendor Available..')
                          }
                  this.wait = false;
                  this.overlay = !this.overlay
                })
                 .then(res=>{
                  setTimeout(func=>{
                    this.clearAndWriteData('vendor-list',this.vendor_list)
                      },4000)
                })
                .catch(error =>{
                    //off loader
                    this.overlay = false
                    this.wait = true;
                      //offline data
                      this.readAllVendorList('vendor-list')     
                    })
              },


                clearAndWriteData(table,data){
              console.log('connecting to db')
                var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains(table)) {
                db.createObjectStore(table, {keyPath: 'id'});
              }
            });
              console.log('db ready to be cleared..')
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
                console.log('cleared')

                for(var key in data){
              console.log('data keys:',key)
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
            this.awaitingList = 'Offline mode'
            console.log('fetched from inDB venlist:',this.vendor_list)
          })
          .catch(error =>{
                    console.log(error)    
                    })
},
           
            }, //method end




            watch : {
            selected(a,b){
             if(a){
              console.log('selected vendor')
                  var online = navigator.onLine; 
            if(!online){
                //not online
                console.log('not online')
                this.$toasted.show("This feature is currently unsupported in offline mode...");
                this.wait = false
                return;
            }
              this.fetch()
             }
          },
      },
            mounted() {
              /*
              //get url param #vendorName
      var param = this.$route.params.vendorName;

      if (param){
        this.selected = param
        this.fetch()
      }*/
      this.vendors()
       var online = navigator.onLine; 
            if(online){
                //online
                console.log('on')
                this.online = true;
               // this.vendors()
            }else{
                //offline
                console.log('off')
                 this.$toasted.show("Offline mode...");
                this.online = false;
                this.readAllVendorList('vendor-list')    
            }
             
            }
        }
    </script>
    