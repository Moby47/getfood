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
              class="mx-auto"
              max-width="344"
            >
         <form>
            <div class="mt-4 form-group p-1">
              
                <v-chip
                class="m-2"
                color="orange"
                text-color="white"
              >
              Select vendor to view ratings and comments
                <v-icon right>fastfood</v-icon>
              </v-chip>
  
  <select class="form-control" v-model='vendorName'> 
    <option value='all'> View all vendors </option>
  <option :value='ven.name' v-for='ven in vendor_list' v-bind:key='ven.id'>
  {{ven.name.slice(0, 25)}} - {{ven.address.slice(0, 25)}} 
  </option>
  </select>
       </div>
       <!--
  <p class='text-center' v-if='vendorName' v-show='content.length > 0'> ({{food_count}}) Result Found</p>           
            -->
          </form>
  </v-card>
         </template>


        



  <template>
  <v-card
    class="mx-auto elevation-20 mb-2"
    color="grey"
    style="max-width: 374px;"
    v-for='con in content' v-bind:key='con.id'
  >
    <v-row justify="space-between">
      <v-col cols="8" >
          <div class="p-3">
            <div>{{con.name}}</div>
            <div>{{con.address}}</div>
            <div>  <a :href="`tel:`+con.phone"> {{con.phone}} </a></div>
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
            :rating="con.score" 
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
              <v-btn
              class='text-center m-1'
              color="#ffb42e"
              outlined
              text
              >
              Comments
            </v-btn>
              <!--  <vue-disqus shortname="getfoods"
                :identifier="`con.id`"
    :url="`http://localhost:8000/vendor-reviews/`">
               </vue-disqus>
<!--+con.name.replace(/[.,/*%' '?!()@]/g,'-')-->
          </v-expansion-panel>
        </v-expansion-panels>
      </template>

  </v-card>
</template>

  <div v-if='empty' class='text-center alert alert-info'>
      No vendor found. <router-link to='/vendor'>Find a Vendor</router-link>
      </div>

      <span v-if='!empty'>
          <div class="shop_pagination slideUp" v-if='vendor_count > 7'>
                 <template>
                     <v-card
                       class="mx-auto"
                       max-width="344"
                      
                     >
             <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
             <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
             <a href="" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
             </v-card>
         </template>
   
           </div>
   
      </span>

    <!--  <div class="my-2 text-center" v-if='vendorName' >
          <v-btn  outlined @click.prevent='fetch()' color="#FFA500">REFRESH</v-btn>   
          </div>
-->

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
          {{loading_text}}
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
        vendorName:'',
        content:[],
        overlay:false,
        empty:null,
        loading_text:'',
         rating:0,

         vendor_list:[],
         vendor_count:''
        // selected:'',
      }
  },

  methods: {


    fetch(page_url){
                  if(page_url){
                  NProgress.start();
                  }else{
                      this.overlay = !this.overlay
                      this.loading_text = 'Loading...'
                  }
                 
                var   page_url = page_url || '/get-vendors/'+this.vendorName;
      
                fetch(page_url)
                .then(res => res.json())
                .then(res=>{
                  this.content = res.data;
                  this.overlay = false
                  this.loading_text = ''
                 // this.vendorName = ''
                    
                  //to determine if obj is empty 
                          //console.log(res.data[0]);
                          if(res.data[0] == undefined){
                              this.empty = true;
                          }else{
                              this.empty = false;
                          }
                  //to determine if obj is empty
                  this.makePagination(res.meta, res.links);
                 
                  this.vendor_count = res.meta.total;
                  NProgress.done();
                })
                .catch(error =>{
                  console.log(error)
                    //off loader
                    this.overlay = false
                     //   this.errMessage ='An error occured. Relaoding food list...'
                      setTimeout(func=>{
                          this.fetch();
                      },2000)
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


  vendors(){
                //fetch vendor list
                NProgress.start();
               // this.overlay = !this.overlay
                fetch('/vendor-list')
                .then(res => res.json())
                .then(res=>{
                  this.vendor_list = res;
                  NProgress.done();
                  if(res[0] == undefined){
                    this.$toasted.show('No Vendor Available..')
                          }
                 // this.wait = false;
                //  this.overlay = !this.overlay
                })
                 .then(res=>{
                  setTimeout(func=>{
                //    this.clearAndWriteData('vendor-list',this.vendor_list)
                      },4000)
                })
                .catch(error =>{
                    //off loader
                    NProgress.done();
                 //   this.overlay = false
                  //  this.wait = true;
                      //offline data
                  //    this.readAllVendorList('vendor-list')     
                    })
              },




  },

  mounted() {

    this.vendorName = this.$route.params.vendorName;
    this.vendors()
    this.fetch()
  
  },

  watch : {
            vendorName(a,b){
             if(a){
              console.log('selected vendor')
              this.fetch()
             /*
                  var online = navigator.onLine; 
            if(!online){
                //not online
                console.log('not online')
                this.$toasted.show("This feature is currently unsupported in offline mode...");
                this.wait = false
                return;
            }
              this.fetch()
              */
             }
          },
      },
      
}
</script>
