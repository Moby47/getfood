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
                            <li class="breadcrumb-item active" aria-current="page">Customer orders (Weekly)</li>
                          </ol>
                        </nav>

             <div class='bg-light'>
                <main role="main" class="container">
  
                    <div class="table-responsive">
                      <table class="table table-striped table-sm">
                        <tr>
												<th>Customer</th>
												<th>Amount</th>
												<th>Date</th>
											</tr>

											<tr>
												<td>Gabb</td>
												<td>400</td>
												<td>2/12/2019</td>
											</tr>
											<tr>
												<td>Tolani</td>
												<td>200</td>
												<td>2/12/2019</td>
											</tr>
                      </table>
                    </div>
                  </main>
              </div>
                  
       
          
          </div>
          
          
        </div>
      </div>
    </div>
    
   
  
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

            }
        },

        methods: {
/*
            this.$validator.validateAll().then(() => {
           
           if (!this.errors.any()) {
            //
            }else{
            //
            }
         
                    //
            })
            .catch(err=>{
                
            }),
      
         setTimeout(func=>{
             //this.errors.clear()
            // this.$validator.reset()
         },1) 
        
         }); //validator
*/
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
