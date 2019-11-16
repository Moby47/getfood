<template>
    <div class="container">
        <usermenubar></usermenubar>
  <!--content here-->
  
  <div class="pages">
      <div data-page="cart" class="page no-toolbar no-navbar">
        <div class="page-content">
              <div id="pages_maincontent">
               
                  <br>
                  <nav aria-label="breadcrumb ">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Welcome <b>{{userName}}</b></li>
                          </ol>
                        </nav>

             <div class='bg-light'>
                <main role="main" class="container">
  

                    <div class="my-3 p-3 bg-white rounded shadow-sm">
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
                    
                    <h6 class="border-bottom border-gray pb-2 mb-0">My Orders</h6>

                    <div v-if='empty' class='text-center alert alert-info'>
                     No Transaction(s) Found. <router-link to='/shop'>Order Now</router-link>
                     </div>

                     <span v-if='!empty' >

                    <div class="table-responsive">
                      <table class="table table-striped table-sm table-hover table-bordered">
                      <thead class='thead-dark'>
                        <tr>
												<th>Food</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                      <!--  <th>Reference</th> -->
                        <th>Address</th>
                        <th>Delivery</th>
												<th>Date</th>
                      </tr>
                    </thead>
											<tr class='animated tdPlopIn' v-for='con in content' v-bind:key='con.id'>
												<td>{{con.title}}</td>
                        <td>{{con.amt}}</td>
                      <!--  <td>{{con.qty}}</td> -->
                        <td>{{con.ref}}</td>
                        <td>{{con.address}}</td>
                        <td>By {{con.delivery}}</td>
												<td>{{con.created_at}}</td>
											</tr>
										
                      </table>
                    </div>

                    <div class="shop_pagination slideUp" >
                      <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
                      <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
                      <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
                      </div>

                    </span>

                   <!-- <h4>Total: <b><strike>N</strike>600 </b></h4> -->
                   <span><!---->
                    <router-link to="/filter-orders" class="button_full btyellow slideUp">FILTER ORDERS</router-link>    
                     </span>

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
              empty:false,
            }
        },

        methods: {


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
