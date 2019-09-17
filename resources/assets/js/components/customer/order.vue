<template>
    <div class="container">
        
     
<!--content here-->

<div class="pages">
    <div data-page="tables" class="page no-toolbar no-navbar">
      <div class="page-content">
        
          <h2 class="page_title">CUSTOMER ORDERS</h2>
            
          <div id="pages_maincontent">
           
           <br>
               <nav aria-label="breadcrumb ">
                       <ol class="breadcrumb">
                         <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                         <li class="breadcrumb-item"><router-link to='/history2'>History</router-link></li>
                         <li class="breadcrumb-item"><router-link to='/product'>New Food</router-link></li>
                         <li class="breadcrumb-item active" aria-current="page">Orders</li>
                       </ol>
                     </nav>
       
       <div class="page_single layout_fullwidth_padding">
                
                <h3>Simple table</h3>
                
                  <ul class="responsive_table">
                       <li class="table_row">
                          <div class="table_section_small">Nr</div>
                          <div class="table_section">Service</div>
                          <div class="table_section">Price</div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">01</div>
                          <div class="table_section">Web design</div>
                          <div class="table_section">$100 / hour</div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">02</div>
                          <div class="table_section">Drawing</div>
                          <div class="table_section">$60 / hour</div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">03</div>
                          <div class="table_section">Illustration</div>
                          <div class="table_section">$80 / hour</div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">04</div>
                          <div class="table_section">Layout design</div>
                          <div class="table_section">$80 / hour</div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">05</div>
                          <div class="table_section">Programming</div>
                          <div class="table_section">$120 / hour</div> 
                       </li>
                  </ul>
                
                
                </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
  
  <!--content here-->
  
    </div>
</template>

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
