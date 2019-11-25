<template>
        <div class="container">
            <vendormenubar></vendormenubar>
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent"> 
                   
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
                  
                       <div class="my-2 text-center slideUp">
                <v-btn @click.prevent='post()' outlined color="#FFA500">UPDATE</v-btn>   
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
                
    
              }
            },
    
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
            }
        }
    </script>
    