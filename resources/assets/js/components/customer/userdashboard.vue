<template>
    <div class="container">
        
  <!--content here-->
  
  
  <div class="pages">
      <div data-page="cart" class="page no-toolbar no-navbar">
        <div class="page-content">
              <div id="pages_maincontent">
               
                  <usermenubar></usermenubar>

                  <br>
                  <template>
                    <v-card
                      class="mx-auto"
                      max-width="344"
                    >
                  <nav aria-label="breadcrumb ">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Welcome <b>{{userName}}</b></li>
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
                          Weekly Purchase(s)
                        </p>
                      </div>
                      <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                          <strong class="d-block text-gray-dark"><span v-html='monthlyData'></span></strong>
                          Monthly Purchase(s)
                        </p>
                      </div>
                      <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#ffa500"/><text x="50%" y="50%" fill="#ffa500" dy=".3em">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                          <strong class="d-block text-gray-dark"><span v-html='totalData'></span></strong>
                          Total Expenditure
                        </p>
                      </div>
                     
                    </div>
                    
                    <h6 class="border-bottom border-gray pb-2 mb-0">My Orders</h6>

                    <div v-if='empty' class='text-center alert alert-info'>
                     No Transaction(s) Found. <router-link to='/shop'>Order Now</router-link>
                     </div>

                     <span v-if='!empty' >

                  
											<p class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id' >
											
                        <template>
                            <v-card
                              class="mx-auto"
                              max-width="400"
                              tile
                            >
                            
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
                          
                            </v-card>
                          </template>
                      </p>
                       



                    
                    <div class='text-center slideUp' v-show='content.length > 5'>
                        <v-btn small text icon color='#FFA500' @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"><v-icon>arrow_back</v-icon></v-btn> 
                        <span>{{pagination.current_page}} of {{pagination.last_page}}</span>
                        <v-btn small text icon color='#FFA500'  @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url"><v-icon>arrow_forward</v-icon></v-btn>
                       </div>

                   

                    </span>

                   <!-- <h4>Total: <b><strike>N</strike>600 </b></h4> -->
                   <span><!---->
                    <div class="my-2 text-center">
                        <v-btn @click.prevent='filterOrders()' outlined color="#FFA500">FILTER ORDERS</v-btn>   
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
              userName:'',
              weeklyData:'Loading...',
              monthlyData:'Loading...',
              totalData:'Loading...',
              content:[],
              pagination: [],
              overlay:false,
              empty:false,

              newContent:[],
            }
        },

        methods: {

          check(con){
           
            this.newContent = con
            this.$bvModal.show('modal')
          },

          filterOrders(){
            this.$router.push({ name: "filterorders" })
          },

          weekly(){
            fetch('/weekly-ex/'+ localStorage.getItem('userId'))
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
            fetch('/monthly-ex/'+ localStorage.getItem('userId'))
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
            fetch('/total-ex/'+ localStorage.getItem('userId'))
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

    var userId = localStorage.getItem('userId')

    if(page_url){
                  NProgress.start();
                  }else{
                    this.overlay=true
                  }
                var   page_url = page_url || '/orders/'+userId;
                 
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
            this.userName = localStorage.getItem('userName')
            //call functions
            this.fetch()

            this.weekly()
            this.monthly()
            this.total()

        }
    }
</script>
