<template>
        <div class="container">
            <usermenubar></usermenubar>
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent">
                   
                      <br>
                   
    
                 <div class=''>

                  
                    <main role="main" class="container">
      
                        <template>
                            <v-card
                              class="mx-auto"
                              max-width="344"
                            >

      <h6 class="border-bottom border-gray m-3 pt-2">Filter Orders</h6>
                        
                        <form class='m-3'>
                            <div class="mt-4 form-group">
                              <label for="exampleInputEmail1">From</label>
                              <input type="date" class="form-control" id="exampleInputEmail1" name='From' v-model='from' v-validate='"required"'>
                              <p class='text-danger shake' v-show="errors.has('From')">{{ errors.first('From') }}</p>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">To</label>
                              <input type="date" class="form-control" id="exampleInputEmail1" name='To' v-model='to' v-validate='"required"'>
                              <p class='text-danger shake' v-show="errors.has('To')">{{ errors.first('To') }}</p>
                            </div>
                            
                            <div class="my-2 text-center">
                                <v-btn @click.prevent='fetch()' outlined color="#FFA500">FIND</v-btn>   
                                </div> 
                            <br>
                            <br>
                          </form>
    
                          <!-- *************** filtered content ************ -->
                          <div v-if='empty' class='text-center alert alert-info'>
             You Have No Transaction Between <span class='text-primary'>{{from}}</span> And <span class='text-primary'>{{to}}</span></span>
                                   </div>

</v-card>
</template>



<template>
    <v-card
      class="mx-auto"
      max-width="344"
    >
                         <span v-if='!empty' v-show='content_details == true'> <!-- **to hide-->

                            <h6 class="border-bottom border-gray m-3 pt-2">My Orders</h6>
                    
                       <p class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                         
                          <v-list-item two-line @click.prevent='check(con)'>
                              <v-list-item-content>
                                <v-list-item-title>{{con.title}}</v-list-item-title>
                                <v-list-item-subtitle>{{moment(con.created_at).fromNow()}}</v-list-item-subtitle>
                              </v-list-item-content>
                            </v-list-item>

                       </p>
										
                    
                 
              <div class='text-center slideUp'>
           <v-btn small text icon color='#FFA500' @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"><v-icon>arrow_back</v-icon></v-btn> 
           <span>{{pagination.current_page}} of {{pagination.last_page}}</span>
           <v-btn small text icon color='#FFA500'  @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url"><v-icon>arrow_forward</v-icon></v-btn>
              </div>

                           <!-- *************** filtered content ************ -->
                 </span> <!-- **to hide-->
                 
    </v-card>
    </template>

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
        </v-overlay>
      </div>
      </template>
      <!--Overlay-->
    
      
      
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
                      <v-list-item-title>Amount Per Item: {{newContent.amt}}</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                  <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Total: {{newContent.total}}</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Delivery Mode: {{newContent.delivery}}</v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                      <v-list-item>
                          <v-list-item-content>
                            <v-list-item-title>Address Used: {{newContent.address}}</v-list-item-title>
                          </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                              <v-list-item-title>Reference Code: {{newContent.ref}}</v-list-item-title>
                            </v-list-item-content>
                          </v-list-item>
                          <v-list-item>
                              <v-list-item-content>
                                <v-list-item-title>Time of Order: {{moment(newContent.created_at).fromNow()}}</v-list-item-title>
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
                      var moment =require('moment');

              export default {
                data () {
                return {
                  moment:moment,
                  content:[],
                  pagination: [],
                  overlay:false,
                  to:'',
                  from:'',
                  content_details: false,
                  empty:false,

                  newContent:[],
                }
            },
    
            methods: {
    
              check(con){
           this.newContent = con
           this.$bvModal.show('modal')
         },
    
     fetch(page_url){

         this.$validator.validateAll().then(() => {

             if (!this.errors.any()) {

 var userId = localStorage.getItem('userId')

    if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay=true
                  }
                var   page_url = page_url || '/my-reporting/'+userId+'/'+ this.from+'/'+this.to;
                 
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;

                  this.content_details = true;

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
                .catch(error =>{
                    //off loader
                  //  this.data_load = false;
                  //    this.wait = true;
                      setTimeout(func=>{
                          this.fetch();
                      },2000)
                      this.overlay = false
                      NProgress.done(); 
                      console.log(error)
                    }) 
                    
             }
             
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
    
           
    
             
    
            },
    
            mounted() {
             //  this.fetch()
            }
        }
    </script>
    