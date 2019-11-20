<template>
        <div class="container">
            <vendormenubar></vendormenubar>
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent"> 
                   
                      <br>
                      <nav aria-label="breadcrumb ">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Edit Food</li>
                              </ol>
                            </nav>
    
                 <div class='bg-light'>
                    <main role="main" class="container">
      
    
                        
                        <form>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Food Name</label>
                              <input type="text" class="form-control" name='food' id="exampleInputEmail1" 
                              v-model='food' v-validate='"required|max:49"' placeholder="Eg: Beans">
    
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
                              <label for="exampleInputPassword1">Price</label>
                              <input type="text" class="form-control" v-model='price' name='price' v-validate='"required|max:9|numeric"' id="exampleInputEmail1" placeholder="Eg: 500">
                              <transition  name="fadeLeft">
                                  <span class='text-danger shake' v-show="errors.has('price')">{{ errors.first('price') }}</span>
                                   </transition>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Available Quantity</label>
                                <input type="text" class="form-control" v-model='quantity' name='quantity' v-validate='"required|max:2|numeric"' id="exampleInputEmail1" placeholder="Eg: 47">
                                <transition  name="fadeLeft">
                                    <span class='text-danger shake' v-show="errors.has('quantity')">{{ errors.first('quantity') }}</span>
                                     </transition>
                              </div>
                 <a href="#" class="button_full btyellow slideUp" @click.prevent='post()'>Post</a>    
                      
                            <br>
                            <br>
                          </form>
    
                     
                      </main>
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
    