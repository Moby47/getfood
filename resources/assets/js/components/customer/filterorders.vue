<template>
        <div class="container">
            <menubar></menubar>
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent">
                   
                      <br>
                   
    
                 <div class='bg-light'>
                    <main role="main" class="container">
      
    
                        
                        <form>
                            <div class="form-group">
                              <label for="exampleInputEmail1">From</label>
                              <input type="date" class="form-control" id="exampleInputEmail1" v-model='from' required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">To</label>
                              <input type="date" class="form-control" id="exampleInputEmail1" v-model='to' required>
                            </div>
                           
                            <button type="submit" class="btn btn-primary" @click.prevent='scan'>Submit</button>
                            <br>
                            <br>
                          </form>
    
                          <!-- *************** filtered content ************ -->
                         
                            {{content}}
                            <h6 class="border-bottom border-gray pb-2 mb-0">My Orders</h6>
                    <div class="table-responsive">
                      <table class="table table-striped table-sm">
                        <tr>
												<th>Food</th>
                        <th>Amount</th>
                        <th>Quantity</th>
												<th>Date</th>
											</tr>
											<tr class='animated tdPlopIn' v-for='con in content' v-bind:key='con.id'>
												<td>{{con.title}}</td>
                        <td>{{con.amt}}</td>
                        <td>{{con.qty}}</td>
												<td>{{con.created_at}}</td>
											</tr>
										
                      </table>
                    </div>
        
                         
                           <!-- *************** filtered content ************ -->
    
    
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
                  userName:'',
                  weeklyData:'Loading...',
                  monthlyData:'Loading...',
                  totalData:'Loading...',
                  content:[],
                  pagination: [],
                  overlay:false,
                  to:'',
                  from:'',
                }
            },
    
            methods: {
    
              scan(){
                
                var input = {'to':this.to, 'from':this.from, 'userId':localStorage.getItem('userId')};
                axios.post('/my-reporting',input).then(res=>{
                
                  this.content = res.data
                    //  console.log(this.content)
                      //to determine if obj is empty 
                              //console.log(res.data[0]);
                         /*     if(res.data[0] == undefined){
                                  this.empty = true;
                              }else{
                                  this.empty = false;
                              }*/
                      //to determine if obj is empty
                     // this.makePagination(res.meta, res.links);
                })
                .catch(err=>{
                    console.log(err)
                   })
                
              },
    
            
    
    
    
           
    
             
    
            },
    
            mounted() {
               
            }
        }
    </script>
    