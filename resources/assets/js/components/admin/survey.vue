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
                                <li class="breadcrumb-item active" aria-current="page">Send Customer Surveys</li>
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
      
                   
    
                         <span v-if='!empty' >
    
                        <div class="table-responsive">
                          <table class="table table-striped table-sm table-hover table-bordered">
                          <thead class='thead-dark'>
                             <tr>
                          <th>Customer</th>
                        <!--  <th>Vendor</th>-->
                          <th>Action</th>
                        </tr>
                        </thead>
                            <tr class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                         <td><a :href="`mailto:`+con.user_email">Email Customer</a></td>
                        <!-- <td>{{con.vendor_name}}</td>--> 
                          <td @click.prevent='send(con)'><v-icon>send</v-icon></td>
                                                </tr>
                                            
                          </table>
                        </div>
    
                         <div class='text-center slideUp' v-show='content.length > 5'>
                                      <v-btn small text icon color='#FFA500' @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"><v-icon>arrow_back</v-icon></v-btn> 
                                      <span>{{pagination.current_page}} of {{pagination.last_page}}</span>
                                      <v-btn small text icon color='#FFA500'  @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url"><v-icon>arrow_forward</v-icon></v-btn>
                                         </div>
    
                        </span>
      <div v-if='empty' class='text-center alert alert-info'>
        No surveys to send now
        </div>
    
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
              {{loading_text}}
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
                data () {
                return {
                  content:[],
                  pagination: [],
                  overlay:false,
                  empty:false,
    
                  ref:'',
                  refContent:[],
                  empty2:false,
                  refCon: false,

                  loading_text:''
    
                }
            },
    
            methods: {
    
               send(con){
                NProgress.start()
                var input = {'userId':con.user_id, 'userEmail':con.user_email}
            axios.post('/send-survey',input)
            .then(res=>{
                if(res.data === 1){
                    this.$toasted.show("Survey sent to "+con.user_email);
                    NProgress.done()
                    this.fetch()
                }else if(res.data == 0){
                    this.$toasted.show("Survey to "+con.user_email+' failed. Please refresh and retry');
                    NProgress.done()
                }else{
                    this.$toasted.show('Any error occured, please refresh and try again');
                    NProgress.done()
                }
            })
            .catch(error =>{
                console.log(error) 
                NProgress.done()   
               })
             },


              fetch(page_url){
    
             if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay=true
                this.loading_text = 'Fetching Surveys...'
                  }
                var   page_url = page_url || '/get-surveys';
                 
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
                      },3000)
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
    