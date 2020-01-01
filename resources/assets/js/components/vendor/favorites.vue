<template>
    <div class="container">
        
  <!--content here-->
  
  <div class="pages">
      <div data-page="cart" class="page no-toolbar no-navbar">
        <div class="page-content">
              <div id="pages_maincontent">
                  <vendormenubar></vendormenubar>
                    
                  <br>
                   <template>
                      <v-card
                        class="mx-auto"
                        max-width="344"
                      >
                  <nav aria-label="breadcrumb ">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Customer Favorite(s)</li>
                          </ol>
                        </nav>
                      </v-card>
                      </template>

             <div class=''>
                <template>
                      <v-card
                        class="mx-auto"
                        max-width="344"
                      >
                <main role="main" class="container">
  
                 
                    <div v-if='empty' class='text-center alert alert-info'>
                     No Favorite(s) Found. 
                     </div>

                     <span v-if='!empty' >

                    <div class="table-responsive">
                      <table class="table table-striped table-sm table-hover table-bordered">
                      <thead class='thead-dark'>
                        <tr>
                        <th>Food</th>
                        <th>Like(s)</th>
                      </tr>
                    </thead>
                          <tr class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                        <td>{{con.title}}</td>
                        <td>{{con.total}}</td>                    
                           </tr>
                                        
                      </table>
                    </div>

                    <div class="shop_pagination slideUp" v-show='content.length > 7'>
                      <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
                      <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
                      <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
                      </div>

                    </span>


                  </main>
                      </v-card>
                </template>

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
            Setting up...
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

        data(){
            return {
              content:[],
              pagination: [],
              overlay:false,
              empty:false,
            
            }
        },

        methods: {


  fetch(page_url){

var userName = localStorage.getItem('userName')

if(page_url){
              NProgress.start();
              }else{
                this.overlay=true
              }
            var   page_url = page_url || '/vendor-favorites/'+userName;
             
            fetch(page_url)
            .then(res => res.json())
            .then(res=>{
              this.content = res.data;
             console.log(this.content)
              //to determine if obj is empty 
                      //console.log(res.data[0]);
                      if(res.data[0] == undefined){
                          this.empty = true;
                      }else{
                          this.empty = false;
                      }
              //to determine if obj is empty
              this.overlay = false
             this.makePagination(res);
            
              NProgress.done();
            })
            .then(res=>{
                  setTimeout(func=>{
                    this.clearAndWriteData('food-likeList',this.content) 
                      },4000)
                })
            .catch(error =>{
               console.log(error)
               this.readAllFromDB('food-likeList')
                  this.overlay = false
                  NProgress.done();        
                }) 
          },

          makePagination(res){
      var pagination = {
                      current_page: res.current_page,
                      last_page: res.last_page,
                      next_page_url: res.next_page_url,
                      prev_page_url: res.prev_page_url
                       }
        document.body.scrollTop = 0;
       document.documentElement.scrollTop = 0;
      this.pagination = pagination;
          },



          clearAndWriteData(table,data){
                var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains(table)) {
                db.createObjectStore(table, {keyPath: 'title'});
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



            readAllFromDB(table){
   
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
             
this.awaitingList = 'Offline mode'
console.log('fetched from inDB :',this.content)
})
.catch(error =>{
       console.log(error)    
       })
},

        },

        mounted() {
              this.fetch()

              if(online){
                //online
                console.log('on')
                this.online = true;
            }else{
                //offline
                console.log('off')
                this.online = false;
                this.readAllFromDB('food-likeList')
            }

            }
    }
</script>
