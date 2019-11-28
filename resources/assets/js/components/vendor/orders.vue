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
                            <li class="breadcrumb-item active" aria-current="page">Customer Orders</li>
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
                    <div class="mt-4 form-group">
                        <v-text-field
                         name='Reference' 
                         v-model='ref'
                          v-validate='"required"'
                          label="Enter Reference Number"
                          required
                        ></v-text-field>
<transition  name="fadeLeft">
  <span class='text-danger shake' v-show="errors.has('Reference')">{{ errors.first('Reference') }}</span>
   </transition>
<br>
 <div class="my-2 text-center slideUp">
                <v-btn @click.prevent='search()' outlined color="#FFA500">FIND</v-btn>   
                </div> 

               </div>
                
                  </form>

                  <!--search result-->
                  <h6 class="border-bottom border-gray pb-2 mb-0" v-show='refCon'>Customer Order</h6>

                  <div v-if='empty2' class='text-center alert alert-info'>
                   No Transaction Found
                   </div>

                   <span v-if='!empty2' v-show='refCon'>

                  <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover table-bordered">
                    <thead class='thead-dark'>
                      <tr>
                      <th>Food</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                    <tr class='animated tdFadeIn' v-for='con in refContent' v-bind:key='con.id'>
                      <td>{{con.title}}</td>
                      <td>{{moment(con.created_at).fromNow()}}</td>
                      <td @click.prevent='check(con)'><v-icon>remove_red_eye</v-icon></td>
                    </tr>
                  
                    </table>
                  </div>


                  </span>


                    <!--all orders-->
                    <h6 class="border-bottom border-gray pb-2 mb-0">Customer Order(s)</h6>

                    <div v-if='empty' class='text-center alert alert-info'>
                     No Transaction(s) Found. 
                     </div>

                     <span v-if='!empty' >

                    <div class="table-responsive">
                      <table class="table table-striped table-sm table-hover table-bordered">
                      <thead class='thead-dark'>
                         <tr>
                      <th>Food</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    </thead>
											<tr class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
											  <td>{{con.title}}</td>
                      <td>{{moment(con.created_at).fromNow()}}</td>
                      <td @click.prevent='check(con)'><v-icon>remove_red_eye</v-icon></td>
											</tr>
										
                      </table>
                    </div>

                     <div class='text-center slideUp'>
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
                 var moment =require('moment');

          export default {
            data () {
            return {
              moment:moment,
              content:[],
              pagination: [],
              overlay:false,
              empty:false,

              ref:'',
              refContent:[],
              empty2:false,
              refCon: false,

               newContent:[],
            }
        },

        methods: {

           check(con){
           this.newContent = con
           this.$bvModal.show('modal')
         },

          search(){

            this.$validator.validateAll().then(() => {
           
           if (!this.errors.any()) {

            this.overlay = !this.overlay
                var   page_url = '/order-ref/'+this.ref+'/'+ localStorage.getItem('userId');
        console.log(page_url)
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.refContent = res.data;
                  this.overlay = false
                  this.refCon = true
                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty2 = true;
                          }else{
                              this.empty2 = false;
                          }
                
                })
                .catch(error =>{
                    //off loader
                    this.overlay = !this.overlay
                      
                      setTimeout(func=>{
                        console.log(error)
                          this.search();
                      },2000)
                         
                    })

           }
            })
          },



          fetch(page_url){

var userId = localStorage.getItem('userId')

if(page_url){
              NProgress.start();
              }else{
                this.overlay=true
              }
            var   page_url = page_url || '/vendor-orders/'+userId;
             
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
            .catch(error =>{
                //off loader
              //  this.data_load = false;
              //    this.wait = true;
                  setTimeout(func=>{
                      this.fetch();
                  },2000)
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
        },

        mounted() {
          this.fetch()
        }
    }
</script>
