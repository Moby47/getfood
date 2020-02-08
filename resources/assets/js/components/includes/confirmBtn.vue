<template>

        <v-btn v-if='confirmed' class="mx-2 ml-5" fab x-small @click.prevent='confirmedMeth()'>
                <v-icon>done_outline</v-icon>
              </v-btn>

        <v-btn v-else class="mx-2 ml-5" fab x-small @click.prevent='approve(id)'>
                <v-icon>done</v-icon>
              </v-btn>
              
</template>


<script>
     
        export default {
     props: ['id'],

data: () => ({
    confirmed:false
}),

methods:{

    approve(id){     
                var prompt = confirm('You are about to confirm Food collection')
                if(prompt){
                 NProgress.start();
                 var input = {'orderId':id}
                 axios.post('/approve-collection', input)
                 .then(res=>{
                   if(res.data == 1){
                     this.$toasted.show("Order confirmed!");
                     this.confirmed = true
                     NProgress.done();
                   }else{
                     this.$toasted.show("An error occured, please try again.");
                     NProgress.done();
                   }
                 })
                 .catch(err => {
                   console.log(err)
                   NProgress.done();
                 })
                }else{
                  //nothing
                  this.$toasted.show("Confirm only if you have collected your food.");
                }
               },


               confirmedMeth(){
                this.$toasted.show("This order was confirmed already.");
               }
},

mounted(){

},
}
</script>