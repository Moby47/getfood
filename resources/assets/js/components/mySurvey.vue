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
  <v-card
    class="mx-auto elevation-20 mb-3"
    color="grey"
    style="max-width: 375px;"
    v-for='con in content' v-bind:key='con.id'
  >
    <v-row justify="space-between">
      <v-col cols="8">
        <v-card-title primary-title>
          <div>
            <div class="headline">{{con.vendor_name}}</div>
          </div>
        </v-card-title>
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
    <v-divider dark></v-divider>
    <v-card-actions class="pa-4">
      Rate this vendor
      <v-spacer></v-spacer>

      <star
      :userId=con.user_id
      :vendor=con.vendor_name
      :vendorId=con.vendor_id
      >
      </star>

    </v-card-actions>
  </v-card>

  <div v-if='empty' class='text-center alert alert-info'>
      No surveys for you now. <router-link to='/vendor'>Find a Vendor</router-link>
      </div>


 <div class="my-2 text-center" v-if='empty == false' >
          <v-btn  outlined @click.prevent='done()' color="#FFA500">FINISH</v-btn>   
          </div>

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
        
        content:[],
        overlay:false,
        empty:null,
        loading_text:''

      }
  },

  methods: {

done(){
  var prompt = confirm('Leave a comment?')
                if(prompt){
                  this.$router.push({name: "vendorReview"});
                }else{
                  this.$router.push({name: "index"});
                }
},

    fetch(param){
     
          this.overlay=true
         this.loading_text = 'Fetching Surveys...'
       
      var   page_url = '/get-my-surveys/'+param;
       
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
       
      
        NProgress.done();
      })
      .catch(error =>{
            setTimeout(func=>{
                this.fetch();
            },3000)
            this.overlay = false
            NProgress.done();        
          }) 
    },

  
  },

  mounted() {

    var param = this.$route.params.userId;
    if(param){
      this.fetch(param)
    }else{
      alert('You are not eligible to add survay. Use a vendor first')
      this.$router.push({name: "kitchen"});
    }
    
  
  }
}
</script>
