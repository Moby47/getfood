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
                                <li class="breadcrumb-item active" aria-current="page">Manage Food</li>
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
                         No Food(s) Found. 
                         </div>
    
                         <span v-if='!empty' >
    
                       
                              <p class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                                  <v-list-item two-line @click.prevent='check(con)'>
                                      <v-list-item-content>
                                        <v-list-item-title>{{con.title}}</v-list-item-title>
                                        <v-list-item-subtitle>{{moment(con.created_at).fromNow()}} 
                                            <v-btn class="mx-2" fab x-small color="">
                                              <v-icon>remove_red_eye</v-icon>
                                            </v-btn>
                                          </v-list-item-subtitle>
                                        
                                            
                                          
                                      </v-list-item-content>
                                    </v-list-item>
                                 
                              </p>
                              
    
                              <div class='text-center slideUp'  v-if='content.length > 7'>
                                  <v-btn small text icon color='#FFA500' @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"><v-icon>arrow_back</v-icon></v-btn> 
                                  <span>{{pagination.current_page}} of {{pagination.last_page}}</span>
                                  <v-btn small text icon color='#FFA500'  @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url"><v-icon>arrow_forward</v-icon></v-btn>
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
                Getting food...
              </v-overlay>
            </div>
            </template>
            <!--Overlay-->

            <template>
                    <v-snackbar
                  v-model="snackbar"
                  :timeout="timeout"
                  >
                  {{ text }}
                  <v-btn
                    color="blue"
                    text
                    @click='snackbar=!snackbar'
                  >
                    Close
                  </v-btn>
                  </v-snackbar>
                  </template>


                   <!--modal-->
  <div>
      <b-modal id="modal" scrollable :title="newContent.title" ok-only >
       
          <template>
              <v-card
                class="mx-auto"
                max-width="500"
                tile
              >
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Quantity: {{newContent.qty}}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                    <v-list-item-content>
                      <v-list-item-title>Amount: {{newContent.amt}}</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                          <v-list-item>
                              <v-list-item-content>
                                <v-list-item-title>Time of Order: {{moment(newContent.created_at).fromNow()}}</v-list-item-title>
                              </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                  <v-list-item-title>
                                      
                                      <div class='text-center slideUp'>
                                          <v-btn small text icon color='#007bff' @click.prevent='edit(newContent)' ><v-icon>edit</v-icon></v-btn> 
                                        
                                          <span v-if='online'>
                                          <v-btn small text icon color='#ff0000'  @click.prevent='del(newContent)' ><v-icon>delete</v-icon></v-btn>
                                        </span>

                                        <span v-else>
                                            <v-btn small text icon color='#ff0000'  @click.prevent='delSync(newContent)' ><v-icon>delete</v-icon></v-btn> 
                                        </span>

                                        </div>

                                    </v-list-item-title>
                                </v-list-item-content>
                              </v-list-item>
  
              
              </v-card>
            </template>

      </b-modal>
    </div>
 <!--modal-->

<back></back>

          </div>
    </template>
    
    <style scoped>
    
      </style>
    
    <script>
                    var moment =require('moment');

            export default {
              data () {
              return {
                moment:moment,
                  content:[],
                  pagination: [],
                  overlay:false,
                  empty:false,
                  snackbar: false,
                    text: '',
                    timeout: 3000,

                    newContent:[],
                    online:null
                }
            },
    
            methods: {

              check(con){
           this.newContent = con
           this.$bvModal.show('modal')
         },
    
    del(newContent){
        var dialog = confirm('Food Will Be Deleted');
        if(dialog){
           //del
           this.$bvModal.hide('modal')

           this.overlay = true
            var input = {'id':newContent.id}
           axios.post('/delete-food', input).then(res=>{
			if(res.data == 1){
         this.overlay=false
            this.text='Food Deleted'
              this.snackbar = true;
                this.fetch()
			}else{
        this.overlay=false
        this.text='Operatiion Failed. Try again'
           this.snackbar = true;
			}
				
			})
			.catch(err=>{
        console.log(err)
        this.overlay=false
      })
        }else{
           //exit
        }
    }, //del end
        
    edit(newContent){
    
        this.$router.push({name:'edit', params:{'con':newContent}});
    },

      fetch(page_url){
    
    var userId = localStorage.getItem('userId')
    
    if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay=true
                  }
                var   page_url = page_url || '/vendor-food-list/'+userId;
                 
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                // console.log(this.content)
                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                  //to determine if obj is empty
                  this.overlay = false
                  this.makePagination(res.meta, res.links);
    //this.wait = false;
                
                  NProgress.done();
                })
                .then(res=>{
                  setTimeout(func=>{
                    this.clearAndWriteData('posted-foods',this.content) 
                      },7000)
                })
                .catch(error =>{
                    //off loader
                  //  this.data_load = false;
                  //    this.wait = true;
                  this.readAllFromDB('posted-foods')
                      this.overlay = false
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


delSync(newContent){
  var dialog = confirm('Mark food for deletion?');
        if(dialog){
           //del
           this.$bvModal.hide('modal')

           this.overlay = true

            if ('serviceWorker' in navigator && 'SyncManager' in window) {

                //notify after syncing => title,body,tag
  //this.displayConfirmNotification('Backgroud task created','Food will be removed from kitchen', 'remove-from-kitchen')

var dbPromise = idb.open('getFoodsDB', 14, function (db) {
             if (!db.objectStoreNames.contains('sync-deleteFood')) {
               db.createObjectStore('sync-deleteFood', {keyPath: 'id'});
               console.log('created store sync-post')
             }
             });

             var input = {'id':newContent.id}

         this.text = 'Food queued for deletion from kitchen...'
         this.snackbar = true


   navigator.serviceWorker.ready
     .then(function(sw) {
       
       console.log(input)
       
         function saveData(table, input){
       
         return   dbPromise
         .then(function(db) {
           var tx = db.transaction(table, 'readwrite');
           var store = tx.objectStore(table);
           for(var i in input){
           store.put(input);
           }
           return tx.complete;
         })
         .catch(error =>{
           this.overlay = false
                 console.log(error)    
                 })
       }

saveData('sync-deleteFood',input)  
         .then(res=> {
           return sw.sync.register('sync-deleteFood-tag');
         })
         .then(res=> {
           console.log('sync saved');
         })
         .catch(function(err) {
           console.log(err);
         });

     });
 } else {
    this.overlay = false 
   alert('Ofline Mode: Not supported');
 }
this.overlay = false 

        }else{
           //exit
        }
},

/*
displayConfirmNotification(title, body, tag) {
      var options = {
        body: body,
        icon: '/images/app-icons/app-icon-96x96.png',
       image: '/images/noimage.jpg',
        dir: 'ltr',
        lang: 'en-US', // BCP 47,
        vibrate: [100, 50, 200],
        badge: '/images/app-icons/app-icon-96x96.png',
        timeout: 6000,
        tag: tag,
        renotify: true,
      };
      Push.create(title, options);

  },
*/
            },//all meth end
    
            mounted() {
              this.fetch()
              var online = navigator.onLine; 
              if(online){
                //online
                console.log('on')
                this.online = true;
            }else{
                //offline
                console.log('off')
                this.online = false;
              //  this.readAllFromDB('foods')
            }

            }
        }
    </script>
    