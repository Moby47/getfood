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
    <v-btn @click.prevent='shop()' outlined color="#FFA500">FIND Food</v-btn>   
    </div>
                         </span>

                 <!--         <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='wait' class='text-center'>
                       <template>
                         <p>Reloading Your Favorite Food(s)..</p>
                          
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
                 
              <favUpdate
              :con=con
              :stash=con.qty
              :online=online
              >
              </favUpdate>
               
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
        <br>
        Loading Your Favorites..
      </v-overlay>
    </div>
  </template>
  <!--Overlay-->



<back></back>


    </div>
</template>


      
<script>
    export default {

         //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: 'My favorite foods on GetFoods',
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
              overlay:false,
              content:[],
              empty:false,
              fav_count:'',
              wait:false,
              online:null
            }
        },

        methods: {
              shop(){
            this.$router.push({ name: "kitchen" })
          },
          cart(){
            this.$router.push({ name: "table" })
          },
          fetch(){
            this.overlay = !this.overlay
                fetch('/get-fav/'+ localStorage.getItem('userFavId'))
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
                .then(res=>{
                 
                })
                .catch(error =>{
                    //off loader
                    this.overlay = false
                    this.wait = true;
                     //offline data
                     this.fav_count = '-'
                     this.readAllFavs('my-favs')
                              
                    })
                    
               
              },

              clearAndWriteData(table,data){
              
                var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains(table)) {
                db.createObjectStore(table, {keyPath: 'id'});
              }
            });
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


readAllFavs(table){
   this.overlay =! this.overlay
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
            if(res[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
              this.overlay =! this.overlay
            this.awaitingList = 'Offline mode'
            console.log('fetched from inDB fav:',this.content)
          })
          .catch(error =>{
                    console.log(error)    
                    })
},

        },//meth end

        mounted() {
           
            var online = navigator.onLine; 
            if(online){
                //online
                console.log('on')
                this.online = true;
                this.fetch()

            }else{
                //offline
                console.log('off')
                this.online = false;
                this.fav_count = '-'
                this.$toasted.show("Offline mode...");
                this.readAllFavs('my-favs')
            }

             setTimeout(func=>{
                    this.clearAndWriteData('my-favs',this.content)
                      },4000)
        }
    }
</script>
