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
                            <li class="breadcrumb-item active" aria-current="page">Add Food To Table</li>
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
                            <label for="exampleInputEmail1">Food Image</label>
                            <input type="file" class="form-control" name='picture' id="exampleInputEmail1" 
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
                <v-btn @click.prevent='post()' outlined color="#FFA500">ADD</v-btn>   
                </div> 
                  
                <div class="my-2 text-center slideUp" v-else>
                    <v-btn @click.prevent='postSync()' outlined color="#FFA500">ADD</v-btn>   
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
    formdata.append('vendorId', localStorage.getItem('userId'));
    formdata.append('vendorName', localStorage.getItem('userName'));
    formdata.append('img', this.picture);
    formdata.append('address', localStorage.getItem('vendorAddress'));

        axios.post('/new-food',formdata).then(res=>{
			if(res.data == 1){
        this.overlay=false

                this.text='Food  Successfully'
                        this.snackbar = true;

				this.food = '';
				this.quantity = '';
				this.price = '';
				
				setTimeout(func=>{
					this.errors.clear();
				},5)
				
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

 var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('sync-addFood')) {
                db.createObjectStore('sync-addFood', {keyPath: 'id'});
                console.log('created store sync-post')
              }
              });


    var input = {id:  new Date().toISOString(),'food': this.food,'price': this.price,
    'vendorId': localStorage.getItem('userId'),'vendorName': localStorage.getItem('userName'),
    'img':'noimage.jpg','address': localStorage.getItem('vendorAddress'),'quantity': this.quantity}

          this.text = 'Food queued for addition to kitchen...'
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
            this.overlay = false
                  console.log(error)    
                  })
        }

saveData('sync-addFood',input)  
          .then(res=> {
            return sw.sync.register('sync-addFood-tag');
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



        },

        mounted() {
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
