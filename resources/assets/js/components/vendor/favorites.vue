<template>
    <div class="container">
        <vendormenubar></vendormenubar>
  <!--content here-->
  
  <div class="pages">
      <div data-page="cart" class="page no-toolbar no-navbar">
        <div class="page-content">
              <div id="pages_maincontent">
               
                  <br>
                  
                  <nav aria-label="breadcrumb ">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Customer Favorite(s)</li>
                          </ol>
                        </nav>

             <div class=''>
                <main role="main" class="container">
  
                 
                    <div v-if='empty' class='text-center alert alert-info'>
                     No Favorite(s) Found. 
                     </div>

                     <span v-if='!empty' >

                    <div class="table-responsive">
                      <table class="table table-striped table-sm table-hover table-bordered">
                      <thead class='thead-dark'>
                        <tr>
                        <th>Food</th>
                        <th>Like(s)</th>
                      </tr>
                    </thead>
                          <tr class='animated tdFadeIn' v-for='con in content' v-bind:key='con.id'>
                        <td>{{con.title}}</td>
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
              content:[],
              pagination: [],
              overlay:false,
              empty:false,
            
            }
        },

        methods: {


  fetch(page_url){

var userName = localStorage.getItem('userName')

if(page_url){
              NProgress.start();
              }else{
                this.overlay=true
              }
            var   page_url = page_url || '/vendor-favorites/'+userName;
             
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
