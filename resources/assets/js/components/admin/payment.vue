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
                                <li class="breadcrumb-item active" aria-current="page">Vendor's Payment This Week</li>
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
                         No Data Found. 
                         </div>
    
                         <span v-if='!empty' >
    
                        <div class="table-responsive">
                          <table class="table table-striped table-sm table-hover table-bordered">
                          <thead class='thead-dark'>
                            <tr>
                            <th>Vendor</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                              <tr class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                            <td>{{con.vendorName}}</td>
                            <td>{{con.total}}</td>                    
                               </tr>
                                            
                          </table>
                        </div>
    
                        <div class="shop_pagination slideUp" v-show='content.length > 7'>
                          <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
                          <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
                          <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
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
    
    <back></back>
    
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
                
                }
            },
    
            methods: {
    
    
      fetch(page_url){
    
    if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay=true
                  }
                var   page_url = page_url || '/due-vendors';
                 
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                 console.log(this.content)
                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                  //to determine if obj is empty
                  this.overlay = false
                 this.makePagination(res);
                
                  NProgress.done();
                })
                .catch(error =>{
                   console.log(error)
                      setTimeout(func=>{
                          this.fetch();
                      },2000)
                      this.overlay = false
                      NProgress.done();        
                    }) 
              },
    
              makePagination(res){
          var pagination = {
                          current_page: res.current_page,
                          last_page: res.last_page,
                          next_page_url: res.next_page_url,
                          prev_page_url: res.prev_page_url
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
    