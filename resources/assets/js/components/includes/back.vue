<template>
    <div>
            
               <!--floating left-->
			<v-btn 
      
			fab 
			dark
			color="#fbc25b"
               outlined
			small
			relative
			bottom
			left
      fixed
      @click.prevent='home()'
			  >
			<v-icon dark>home</v-icon>
			</v-btn>
          <!--  floating left-->


            <a @click.prevent='back()' >	
			 <v-btn 
			 fab 
			 dark
			 color="#fbc25b"
			 small
                relative
                outlined
			 bottom
			 right
			 fixed
			   >
               <v-icon dark > arrow_back</v-icon> 
			 </v-btn>
            </a>

            </div>
        </template>        



             <script>


            export default {


               data: () => ({
									
            }),
            
            created(){

           
           },
           methods:{

            back(){
                  
                 this.$router.go(-1)
                  
                },
              home(){
                 this.$router.push({name: "index"});
                  
                },
           },

           mounted(){
               
             
           }

           }
			</script>
