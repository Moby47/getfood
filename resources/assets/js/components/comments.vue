<template>
        <div class="container">
          
       <!--content here-->
       
       <div class="pages">
         <div data-page="success" class="page no-toolbar no-navbar">
           <div class="page-content">
           
            <div id="pages_maincontent">
       
       
               <menubar></menubar>
               <br>
           <div class="page_single layout_fullwidth_padding bounceIn">
               <!---->
          
            
         <template>
         <v-card
           class="mx-auto elevation-20 mb-2"
           color="grey"
           style="max-width: 374px;"
         >
           <v-row justify="space-between">
             <v-col cols="8" >
                 <div class="p-3">
                   <div>{{name}}</div>
                   <div>{{address}}</div>
                   <div>  <a :href="`tel:`+phone"> {{phone}} </a></div>
                 </div>
             </v-col>
             <v-img
               class="shrink ma-2"
               contain
               height="115px"
               src="/images/vendor.png"
               alt='Getfoods - online food ordering and reservation system'
                 :lazy-src="`/images/black-spinner.gif`"
               style="flex-basis: 120px"
             ></v-img>
           </v-row>
          
           <v-card-actions class="pa-4">
             Current rating
             <v-spacer></v-spacer>
             
             <star-rating
                   :rating="score" 
                   :read-only="true"
                   :star-size="30"
                   active-color="#ffb42e"
                   :border-width="3"
                   text-class="custom-text"
                   :glow="10" 
                   :rounded-corners="true" 
                   :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"
                   >
                   </star-rating>
       
           </v-card-actions>
       
           <template>
               <v-expansion-panels>
                 <v-expansion-panel
                 >
                     
                       <vue-disqus shortname="getfoods" class='p-2'
                       :identifier="`id`"
           :url="`http://localhost:8000/comments/`">
                      </vue-disqus>
       <!--+con.name.replace(/[.,/*%' '?!()@]/g,'-')-->
                 </v-expansion-panel>
               </v-expansion-panels>
             </template>
       
         </v-card>
       </template>
       
         
       
           </div>
            </div>
           </div>
         </div>
       </div>
       
       <back></back>
       
          <!--Overlay-->
          <template>
             <div class="text-center">
               <v-overlay :value="overlay">
                 <v-progress-circular indeterminate size="64"></v-progress-circular>
                 <br>
                Loading vendor...
               </v-overlay>
             </div>
             </template>
             <!--Overlay-->
       
       
        </div>
       </template>
       
       
       <style>
       .custom-text {
         font-weight: bold;
         font-size: 1.1em;
         border: 1px solid #cfcfcf;
         padding-left: 7px;
         padding-right: 7px;
         border-radius: 5px;
         color: #999;
         background: #fff;
       }
       </style>
       
       
       <script>
                      
           export default {
             data () {
             return {
               name:'',
               address:'',
               phone:'',
               score:0,
               id:'',
               overlay:false,
             }
         },
       
         methods: {
       
       
         },
       
         mounted() {
       
            this.overlay = !this.overlay

            var id = this.$route.params.id
            
                if(id){
                    this.name = this.$route.params.name
                    this.address= this.$route.params.address
                    this.phone = this.$route.params.phone
                    this.score = this.$route.params.score
                    this.id = this.$route.params.id
                    this.overlay = !this.overlay
                }else{
                    this.$router.push({name: "vendorReview"});
                }
                
                
         },
       
       
             
       }
       </script>
       