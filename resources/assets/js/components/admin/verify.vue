<template>
        <div class="container">
           
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent">
                   
                        <superadminmenubar></superadminmenubar>
                      <br>
                       <template>
                          <v-card
                            class="mx-auto"
                            max-width="344"
                          >
                      <nav aria-label="breadcrumb ">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Approve/Decline Vendors</li>
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
                        <div class="mt-4 mb-5 form-group">
                            <v-text-field
                             name='Name' 
                             v-model='ref'
                              v-validate='"required"'
                              label="Find Vendor By Name "
                              required
                            ></v-text-field>
    <transition  name="fadeLeft">
      <span class='text-danger shake' v-show="errors.has('Name')">{{ errors.first('Name') }}</span>
       </transition>
    
     <div class="my-2 text-center slideUp">
                    <v-btn @click.prevent='search()' outlined color="#FFA500">FIND</v-btn>   
                    </div> 
    
                   </div>
                    
                      </form>
    
                      <!--search result-->
                      <h6 class="border-bottom border-gray pb-2 mb-0" v-show='refCon'>New Vendor(s)</h6>
    
                      <div v-if='empty2' class='text-center alert alert-info'>
                       No Result Found
                       </div>
    
                       <span v-if='!empty2' v-show='refCon'>
    
                      <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover table-bordered">
                        <thead class='thead-dark'>
                          <tr>
                                <th>Vendor Name</th>
                                <th>Time of Reg</th>
                                <th>Action</th>
                        </tr>
                      </thead>
                        <tr class='animated tdFadeIn' v-for='con in refContent' v-bind:key='con.id'>
                          <td>{{con.name}}</td>
                          <td>{{con.created_at}}</td>
                          <td @click.prevent='check(con)'><v-icon>remove_red_eye</v-icon></td>
                        </tr>
                      
                        </table>
                      </div>
    
    
                      </span>
    
    
                        <!--all orders-->
                        <h6 class="border-bottom border-gray pb-2 mb-0">New Vendor(s)</h6>
    
                        <div v-if='empty' class='text-center alert alert-info'>
                         No New Vendor Found. 
                         </div>
    
                         <span v-if='!empty' >
    
                        <div class="table-responsive">
                          <table class="table table-striped table-sm table-hover table-bordered">
                          <thead class='thead-dark'>
                             <tr>
                          <th>Vendor Name</th>
                          <th>Time of Reg</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                            <tr class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                         <td>{{con.name}}</td>
                          <td>{{moment(con.created_at).fromNow()}}</td>
                          <td @click.prevent='check(con)'><v-icon>remove_red_eye</v-icon></td>
                                                </tr>
                                            
                          </table>
                        </div>
    
                         <div class='text-center slideUp' v-show='content.length > 5'>
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
          <b-modal id="modal" scrollable :title="newContent.name" ok-only >
           
              <template>
                  <v-card
                    class="mx-auto"
                    max-width="500"
                    tile
                  >
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Address: {{newContent.address}}</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Email: {{newContent.email}}</v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                      <v-list-item>
                          <v-list-item-content>
                            <v-list-item-title>Phone: {{newContent.phone}}</v-list-item-title>
                          </v-list-item-content>
                        </v-list-item>
                              <v-list-item>
                                  <v-list-item-content>
                                    <v-list-item-title>Sign-up Time: {{newContent.created_at}}</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                        <v-list-item-content>
                                          <v-list-item-title>
                                              
                                              <div class='text-center slideUp'>
 <v-btn small text icon color='#007bff' @click.prevent='approve(newContent)' ><v-icon>thumb_up</v-icon></v-btn> 
                                                
   <v-btn small text icon color='#ff0000'  @click.prevent='decline(newContent)' ><v-icon>thumb_down</v-icon></v-btn>
                                                     </div>
        
                                            </v-list-item-title>
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
              <br>
              {{loading_text}}
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
                color="#FFA500"
                text
                @click='snackbar=!snackbar'
              >
                Close
              </v-btn>
              </v-snackbar>
              </template>

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
                    timeout: 6000,

                  ref:'',
                  refContent:[],
                  empty2:false,
                  refCon: false,
    
                   newContent:[],
                   loading_text:''
                }
            },
    
            methods: {
    
               check(con){
               this.newContent = con
               this.$bvModal.show('modal')
             },

             approve(newContent){
        var dialog = confirm('Approve '+ newContent.name +' ?');
        if(dialog){
           //approve
           this.$bvModal.hide('modal')

           this.overlay = true
           this.loading_text = 'Approving '+newContent.name+"'s account"
            var input = {'id':newContent.id}
           axios.post('/approve-vendor', input).then(res=>{
             
			if(res.data === 1){
         this.overlay=false
            this.text='Vendor Approved'
              this.snackbar = true;
                this.fetch()
                this.refCon = false
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
    }, // end

    
    decline(newContent){
        var dialog = confirm('Reject '+ newContent.name +' ?');
        if(dialog){
           //decline
           this.$bvModal.hide('modal')

           this.overlay = true
           this.loading_text = 'Declining '+newContent.name+"'s account"
            var input = {'id':newContent.id}
           axios.post('/decline-vendor', input).then(res=>{
			if(res.data === 1){
         this.overlay=false
            this.text='Vendor Rejected'
              this.snackbar = true;
                this.fetch()
                this.refCon = false
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
    }, // end

              search(){
    
                this.$validator.validateAll().then(() => {
               
               if (!this.errors.any()) {
    
                this.overlay = !this.overlay
                this.loading_text = 'Searching...'
                    var   page_url = '/vendor-search/'+this.ref;
           
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
                                  this.text='We found something.'
                                  this.snackbar = true;
                              }
                    
                    })
                    .catch(error =>{
                        //off loader
                        this.overlay = !this.overlay
                          
                            console.log(error)
                              
                        })
    
               }
                })
              },
    
    
    
              fetch(page_url){
    
    
    if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay=true
                this.loading_text = 'Setting up...'

                  }
                var   page_url = page_url || '/all-vendors';
                 
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
    