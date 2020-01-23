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
    color="#ffb42e"
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

      <span class="grey--text text--lighten-2 caption mr-2">
        ({{ rating }})
      </span>

      <v-rating
        v-model="rating"
        background-color="white"
        color="yellow accent-4"
        dense
        half-increments
        hover
        size="18"
      ></v-rating>

    </v-card-actions>
  </v-card>



    </div>
     </div>
    </div>
  </div>
</div>

<back></back>

 </div>
</template>




<script>
  export default {
    data: () => ({
      rating: 4.3,
    }),
  }
</script>