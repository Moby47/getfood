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
                                        <v-list-item-subtitle>{{con.created_at}} 
                                            <v-btn class="mx-2" fab dark x-small color="#FFA500">
                                              <v-icon>more_vert</v-icon>
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
                                <v-list-item-title>Time of Order: {{newContent.created_at}}</v-list-item-title>
                              </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                  <v-list-item-title>
                                      
                                      <div class='text-center slideUp'>
                                          <v-btn small text icon color='#007bff' @click.prevent='edit(newContent)' ><v-icon>edit</v-icon></v-btn> 
                                        
                                          <v-btn small text icon color='#ff0000'  @click.prevent='del(newContent)' ><v-icon>delete</v-icon></v-btn>
                                             </div>

                                    </v-list-item-title>
                                </v-list-item-content>
                              </v-list-item>
  
              
              </v-card>
            </template>

      </b-modal>
    </div>
 <!--modal-->


          </div>
    </template>
    
    <style scoped>
    
      </style>
    
    <script>
        export default {
    
            data(){
                return {
                  content:[],
                  pagination: [],
                  overlay:false,
                  empty:false,
                  snackbar: false,
                    text: '',
                    timeout: 3000,

                    newContent:[],
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
    