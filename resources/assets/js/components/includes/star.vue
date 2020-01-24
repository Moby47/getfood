<template>

    <div>

            <star-rating
            @rating-selected ="rate(vendorId,vendor)"
            v-show='star'
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

            <!--<input type="text" v-model='vendorId'/>-->
    </div>

</template>



<script>

          export default {
        
                props: ['userId','vendor','vendorId'],
        
        data: function() {
            return {
                rating: 0,
                star:true,
            }
        },
        
                methods: {
                  
                 rate(vendorId,vendor){

                    NProgress.start()
      var input = {'vendorId':vendorId, 'rating':this.rating, 'vendorName':vendor}
  axios.post('/rate-vendor',input)
  .then(res=>{
      if(res.data === 1){
          this.$toasted.show(vendor +" was rated "+ this.rating +' star(s)');
          NProgress.done()
          //hide this comp
           // this.star = false
      }else{
          this.$toasted.show('Any error occured, please refresh and try again');
          NProgress.done()
      }
  })
  .catch(error =>{
      console.log(error) 
      NProgress.done()   
     })
                 },



        
                },//meth end

                  watch : {
            
                },

            }
        </script>