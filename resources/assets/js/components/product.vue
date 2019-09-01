<template>
    <div class="container">
        
     
<!--content here-->

<div class="pages">
    <div data-page="form" class="page no-toolbar no-navbar">
      <div class="page-content">
          
          <h2 class="page_title">ADD FOOD</h2>
            
          <div id="pages_maincontent">
           
           <br>
               <nav aria-label="breadcrumb ">
                       <ol class="breadcrumb">
                         <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                         <li class="breadcrumb-item"><router-link to='/order'>Orders</router-link></li>
                         <li class="breadcrumb-item"><router-link to='/history2'>History</router-link></li>
                         <li class="breadcrumb-item active" aria-current="page">Add Food</li>
                       </ol>
                     </nav>
       
       <div class="page_single layout_fullwidth_padding">
  
                  <div class="contactform">
                  <form>
                  <div class="form_row">
                  <label>Name:</label>
                  <input type="text" name="name" value="" class="form_input" />
                  </div>
                  
                  <div class="form_row">
                  <label>Price:</label>
                  <input type="text" name="price" value="" class="form_input" />
                  </div>
                  
                  <div class="form_row">
                    <label>Quantity:</label>
                    <input type="number" name="number" value="" class="form_input" />
                    </div>
  
                    <div class="form_row">
                      <label>Picture:</label>
                      <input type="file" name="image" value="" class="form_input" />
                      </div>
                 
                  <input type="submit" name="submit" class="form_submit" id="submit" value="Send" />
                  </form>
                  </div>
  
                
              
                  <h3>Items</h3>
                
                  <ul class="responsive_table">
                       <li class="table_row">
                          <div class="table_section_small">Name</div>
                          <div class="table_section">Quantity</div>
                          <div class="table_section">Price</div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">swallow</div>
                          <div class="table_section">Web design</div>
                          <div class="table_section">$100 </div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">rice</div>
                          <div class="table_section">Drawing</div>
                          <div class="table_section">$60 </div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">potato</div>
                          <div class="table_section">Illustration</div>
                          <div class="table_section">$80 </div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">veg</div>
                          <div class="table_section">Layout design</div>
                          <div class="table_section">$80 </div> 
                       </li>
                       <li class="table_row">
                          <div class="table_section_small">zobo</div>
                          <div class="table_section">Programming</div>
                          <div class="table_section">$120 </div> 
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
