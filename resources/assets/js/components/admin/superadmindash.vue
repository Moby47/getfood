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
                                <li class="breadcrumb-item active" aria-current="page">Welcome <b>{{userName}} </b></li>
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
                              <strong class="d-block text-gray-dark"> <span v-html='customerCount'></span></strong>
                             Customer(s)
                            </p>
                          </div>
                          <div class="media text-muted pt-3">
                            <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                              <strong class="d-block text-gray-dark"><span v-html='vendorCount'></span></strong>
                              Vendor(s)
                            </p>
                          </div>
                         
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
                  
                  userName:'',
                  customerCount:'Loading...',
                  vendorCount:'Loading...',
                  overlay:false,
                }
            },
    
            methods: {
    
             
    
              customerC(){
                fetch('/customer-count')
                    .then(res => res.json())
                    .then(res=>{
                      this.customerCount = res;
                    })
                    .catch(error =>{
                          setTimeout(func=>{
                              this.customerC();
                          },2000)
                                  
                        })
              },
    
    
              vendorC(){
                fetch('/vendor-count')
                    .then(res => res.json())
                    .then(res=>{
                      this.vendorCount =res;
                    })
                    .catch(error =>{
                          setTimeout(func=>{
                              this.vendorC();
                          },2000)
                                  
                        })
              },
    
            
    
    
            },
    
            mounted() {
                this.userName = localStorage.getItem('userName')
               
                this.customerC()
                this.vendorC()
    
            }
        }
    </script>
    