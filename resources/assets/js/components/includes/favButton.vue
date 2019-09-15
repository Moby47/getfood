<template>
        <a href="#" v-if="isFavorited" data-popup=".popup-social" class="open-popup shopfav" @click.prevent='unFavorite(id)'>
                <img src="images/icons/black/menu_close.png" alt="" title="" /></a>

                <a href="#" v-else data-popup=".popup-social" class="open-popup shopfav" @click.prevent='Favorite(id)'>
                        <img src="images/icons/black/love.png" alt="" title="" /></a>

</template>

<script>
    export default {

        props: ['id'],
//
data: function() {
    return {
        isFavorited: '',
    }
},

        methods: {
            Favorite(id) {
                this.isFavorited = true
                    //this.$toasted.clear();
                   // this.loading = true;
                   var check = localStorage.getItem('userId');
                    if(check){
                        NProgress.start()
                        //Id exists, send both User and Post Id to DB
                        var userId = check;
                        var foodId = id;
        
                        var input = {'userId':userId, 'foodId':foodId};
        
                        axios.post('/add-favorite',input)
                        .then(res=>{
                            if(res.data == 1){
                        this.$toasted.show("Food added to Favourites!");
                        //this.fetch();
                            }else if(res.data == 0){
                        this.$toasted.show("Food was already added to Favorites!");
                            }else{
                       this.$toasted.show("Maximum limit reached, no more Favorites!");     
                            }
                            NProgress.done();
                           
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to add food. Try again"); 
                    NProgress.done();        
                      })
                        
                    }else{
                        NProgress.start();
                        //create id for user  
                    var userId = Math.floor(Math.random()*1000);
                    //store locally
                    localStorage.setItem('userId',userId);
                    var foodId = id;
        
                    //go to server
                    var input = {'userId':userId, 'foodId':foodId};
                    axios.post('/add-favorite',input)
                        .then(res=>{
                            if(res.data == 1){
                        alert('Food Liked!');
                       
                            }
                            NProgress.done();
                            
                        })
                        .catch(error =>{
                            this.$toasted.show("Failed to add food. Try again"); 
                    NProgress.done();        
                      })
                    }
            },

            unFavorite(id) {
                this.isFavorited = false
                NProgress.start();

               var userId =  localStorage.getItem('userId',userId);
                var foodId = id;
                        var input = {'foodId':foodId,'userId':userId};
        
                        axios.post('/remove-favorite',input)
                        .then(res=>{
                            if(res.data == 1){
                        this.$toasted.show("Food removed from Favourites!");
                            }
                            NProgress.done();
                        })
                        .catch(error =>{
                  this.$toasted.show("Failed to remove food. Try again"); 
                    NProgress.done();        
                      })
            },

        }
    }
</script>