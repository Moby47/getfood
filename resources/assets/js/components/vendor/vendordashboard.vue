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
                            <li class="breadcrumb-item active" aria-current="page">Welcome {{userName}}</li>
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
  

                    <div class="my-3 p-1 bg-white rounded shadow-sm">
                      <h6 class="border-bottom border-gray pb-2 mb-0">Statistics</h6>
                      <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#ffa500"/><text x="50%" y="50%" fill="#ffa500" dy=".3em">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                          <strong class="d-block text-gray-dark"> <span v-html='weeklyData'></span></strong>
                          Weekly Pay
                        </p>
                      </div>
                      <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                          <strong class="d-block text-gray-dark"><span v-html='monthlyData'></span></strong>
                          Monthly Pay
                        </p>
                      </div>
                      <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#ffa500"/><text x="50%" y="50%" fill="#ffa500" dy=".3em">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                          <strong class="d-block text-gray-dark"><span v-html='totalData'></span></strong>
                          Total Pay
                        </p>
                      </div>
                     
                    </div>
                    
                    <h6 class="border-bottom border-gray pb-2 mb-0">Filter Orders</h6>

                    <form>
                      <div class="mt-4 form-group">
                        <label for="">From</label>
                        <input type="date" class="form-control"  name='From' v-model='from' v-validate='"required"'>
                        <p class='text-danger shake' v-show="errors.has('From')">{{ errors.first('From') }}</p>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">To</label>
                        <input type="date" class="form-control"  name='To' v-model='to' v-validate='"required"'>
                        <p class='text-danger shake' v-show="errors.has('To')">{{ errors.first('To') }}</p>
                      </div>
                    
                      <div class="my-2 text-center slideUp" v-if='online'>
                          <v-btn @click.prevent='fetch()' outlined color="#FFA500">FIND</v-btn>   
                          </div> 
                          <div class="my-2 text-center slideUp" v-else>
                              <v-btn @click.prevent='offline()' outlined color="#FFA500">FIND</v-btn>   
                              </div> 
                      <br>
                      <br>
                    </form>

                   <!-- *************** filtered content ************ -->
                   <div v-if='empty' class='text-center alert alert-info'>
                    You Have No Transaction Between <span class='text-primary'>{{from}}</span> And <span class='text-primary'>{{to}}</span></span>
                                          </div>
       
       
                                <span v-if='!empty' v-show='content_details == true'> <!-- **to hide-->
       
                                   <h6 class="border-bottom border-gray pb-2 mb-0">Customer Orders</h6>
                          
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
                           
                        
               
                              <div class='text-center slideUp'>
                                  <v-btn small text icon color='#FFA500' @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"><v-icon>arrow_back</v-icon></v-btn> 
                                  <span>{{pagination.current_page}} of {{pagination.last_page}}</span>
                                  <v-btn small text icon color='#FFA500'  @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url"><v-icon>arrow_forward</v-icon></v-btn>
                                     </div>
                                  <!-- *************** filtered content ************ -->
                        </span> <!-- **to hide-->

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
                    <v-list-item-title>Customer's Name: {{newContent.cusName}}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
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

  </style>

<script>
                          var moment =require('moment');

          export default {
            data () {
            return {
              moment:moment,
              weeklyData:'Loading...',
              monthlyData:'Loading...',
              totalData:'Loading...',
              userName:'',

                content:[],
                  pagination: [],
                  overlay:false,
                  to:'',
                  from:'',
                  content_details: false,
                  empty:false,

                  newContent:[],
                  online:null
            }
        },

        methods: {

          check(con){
           this.newContent = con
           this.$bvModal.show('modal')
         },

         offline(){
          this.$toasted.show("This feature is currently unsupported in offline mode...");
         },
         
          weekly(){
            fetch('/weekly-ex-vendor/'+ localStorage.getItem('userId'))
                .then(res => res.json())
                .then(res=>{
                  this.weeklyData = '<strike>N</strike>'+res;
                })
                .catch(error =>{
                      setTimeout(func=>{
                          this.weekly();
                      },2000)
                              
                    })
          },


          monthly(){
            fetch('/monthly-ex-vendor/'+ localStorage.getItem('userId'))
                .then(res => res.json())
                .then(res=>{
                  this.monthlyData = '<strike>N</strike>'+res;
                })
                .catch(error =>{
                      setTimeout(func=>{
                          this.monthly();
                      },2000)
                              
                    })
          },

          total(){
            fetch('/total-ex-vendor/'+ localStorage.getItem('userId'))
                .then(res => res.json())
                .then(res=>{
                  this.totalData = '<strike>N</strike>'+res;
                })
                .catch(error =>{
                      setTimeout(func=>{
                          this.total();
                      },2000)
                              
                    })
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
       var   page_url = page_url || '/vendor-reporting/'+userId+'/'+ this.from+'/'+this.to;
        
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
          this.userName = localStorage.getItem('userName')
            this.weekly()
            this.monthly()
            this.total()

            var online = navigator.onLine; 
            if(online){
                //online
                console.log('on')
                this.online = true;
            }else{
                //offline
                console.log('off')
                this.online = false;
                this.$toasted.show("Offline mode...");
            }
            
        }
    }
</script>
