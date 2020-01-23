<template>
 <div class="container">
      
   
<!--content here-->

<div class="pages">
  <div data-page="success" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div id="pages_maincontent">

    <div class="page_single layout_fullwidth_padding bounceIn">
  <v-card
    class="mx-auto elevation-20"
    color="grey"
    style="max-width: 400px;"
  >
    <v-row justify="space-between">
      <v-col cols="8">
        <v-card-title primary-title>
          <div>
            <div class="headline">Vendor Name</div>
            <div>Address</div>
          </div>
        </v-card-title>
      </v-col>
      <v-img
        class="shrink ma-2"
        contain
        height="120px"
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

      <star-rating
      v-model="rating"
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
  </v-card>

 <div class="my-2 text-center" >
          <v-btn  outlined color="#FFA500">FINISH</v-btn>   
          </div>

    </div>
     </div>
    </div>
  </div>
</div>

<back></back>

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
    data: () => ({
      rating: 0,
    }),
  }
</script>