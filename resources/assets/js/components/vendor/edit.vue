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
                                <li class="breadcrumb-item active" aria-current="page">Edit Food</li>
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
      
    
                        
                        <form>
                            <div class="form-group">
                               <v-text-field
                          v-model="food"
                          name='food'
                          v-validate='"required|max:49"'
                          :counter="49"
                          label="Food Name"
                          required
                        ></v-text-field>
    
                              <transition  name="fadeLeft">
                                  <span class='text-danger shake' v-show="errors.has('food')">{{ errors.first('food') }}</span>
                                   </transition>
                            </div>
                            <div class="form-group">
                                <label for="">Food Image</label>
                                <input type="file" class="form-control" name='picture'
                                @change='ImageSelect' v-validate='"required|image"'>
      
                                <transition  name="fadeLeft">
                                    <span class='text-danger shake' v-show="errors.has('picture')">{{ errors.first('picture') }}</span>
                                     </transition>
                              </div>
                            <div class="form-group">
                              <v-text-field
                          v-model='price' name='price' v-validate='"required|max:9|numeric"'
                            :counter="9"
                            label="Price"
                            required
                          ></v-text-field>
                              <transition  name="fadeLeft">
                                  <span class='text-danger shake' v-show="errors.has('price')">{{ errors.first('price') }}</span>
                                   </transition>
                            </div>
                            <div class="form-group">
                                 <v-text-field
                            v-model='quantity' name='quantity' v-validate='"required|max:2|numeric"'
                              :counter="2"
                              label="Available Quantity"
                              required
                            ></v-text-field>
                                <transition  name="fadeLeft">
                                    <span class='text-danger shake' v-show="errors.has('quantity')">{{ errors.first('quantity') }}</span>
                                     </transition>
                              </div>
                  
                              <div class="my-2 text-center slideUp" v-if='online'>
                                  <v-btn @click.prevent='post()' outlined color="#FFA500">UPDATE</v-btn>   
                                  </div> 
                                    
                                  <div class="my-2 text-center slideUp" v-else>
                                      <v-btn @click.prevent='postSync()' outlined color="#FFA500">UPDATE</v-btn>   
                                      </div> 
                            <br>
                            <br>
                          </form>
    
                     
                      </main>
</v-card>
</template>
                     

                  </div>
                      
           
              
              </div>
              
              
            </div>
          </div>
        </div>
        
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
      
           <!--Overlay-->
    <template>
      <div class="text-center">
        <v-overlay :value="overlay">
          <v-progress-circular indeterminate size="64"></v-progress-circular>
          <br>
          Updating food...
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
                  food:'',
                  price:'',
                  quantity:'',
                  id:'',
                  overlay:false,
    
                  snackbar: false,
                text: '',
                timeout: 3000,
    
                picture:'',
                online:null
                }
            },
    
            methods: {
    
              ImageSelect(event){
              this.picture = event.target.files[0];
            },
    
              post(){
    
                this.$validator.validateAll().then(() => {
               
               if (!this.errors.any()) {
                //run code
                this.overlay=true
    
                const formdata  = new FormData();
        //append form data to formdata
        formdata.append('food',  this.food);
        formdata.append('price', this.price);
        formdata.append('quantity', this.quantity);
        formdata.append('img', this.picture);
        formdata.append('id', this.id);
    
            axios.post('/edit-food',formdata).then(res=>{
                if(res.data == 1){
            this.overlay=false
    
                    this.text='Food  Successfully'
                            this.snackbar = true;
                            this.$router.push({name: "manage"});
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
                //do nothing, v validate will work
                }
             
                        //
                })
                
    
              },


              postSync(){
           
           this.$validator.validateAll().then(() => {
          
          if (!this.errors.any()) {
           //run code
           this.overlay=true

        
             if ('serviceWorker' in navigator && 'SyncManager' in window) {

                //notify after syncing => title,body,tag
  //this.displayConfirmNotification('Backgroud task created','Your food will be updated', 'add-to-kitchen')

var dbPromise = idb.open('getFoodsDB', 14, function (db) {
             if (!db.objectStoreNames.contains('sync-updateFood')) {
               db.createObjectStore('sync-updateFood', {keyPath: 'id'});
               console.log('created store sync-post')
             }
             });


   var input = {'id':  this.id,'food': this.food,'price': this.price,
   'vendorId': localStorage.getItem('userId'),'vendorName': localStorage.getItem('userName'),
   'img':'noimage.jpg','address': localStorage.getItem('vendorAddress'),'quantity': this.quantity}

         this.text = 'Food update queued for application...'
         this.snackbar = true

         setTimeout(func=>{
           this.food = '';
       this.quantity = '';
       this.price = '';
       
       setTimeout(func=>{
         this.errors.clear();
       },5)
       },2000)


   navigator.serviceWorker.ready
     .then(function(sw) {
       
       console.log(input)
       
         function saveData(table, input){
          console.log(table,input)

       
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
                 console.log(error)    
                 })
       }

saveData('sync-updateFood',input)  
         .then(res=> {
           return sw.sync.register('sync-updateFood-tag');
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

         } //validation
         })
         
         }, //meth end

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
*/      },
    
            mounted() {
                var con = {'con':this.$route.params.con}
                console.log(con)
                if(con.con == undefined){
                   this.$router.push({name: "manage"});
                }
                this.food = con.con.title
                this.id = con.con.id
                this.quantity = con.con.qty
                this.price = con.con.amt

                var online = navigator.onLine; 
            if(online){
                //online
                console.log('on')
                this.online = true;
            }else{
                //offline
                console.log('off')
                this.online = false;
            }
            }
        }
    </script>
    