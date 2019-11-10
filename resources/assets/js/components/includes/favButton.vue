<template>
   <div> 
    <a href="#" v-if="isFavorited" data-popup=".popup-social" class="open-popup shopfav" @click.prevent='unFavorite(id)'>
                <img src="images/icons/black/menu_close.png" alt="" title="" /></a>

                <a href="#" v-else data-popup=".popup-social" class="open-popup shopfav pulse" @click.prevent='Favorite(id)'>
                        <img src="images/icons/black/love.png" alt="" title="" /></a>

                        <template>
                            <v-snackbar
                          v-model="snackbar"
                          :timeout="timeout"
                          >
                          {{ text }}
                          <v-btn
                            color="blue"
                            text
                            @click='snackbar=!snackbar'
                          >
                            Close
                          </v-btn>
                          </v-snackbar>
                          </template>
      </div>                  
</template>

<script>
    export default {

        props: ['id'],
//
data: function() {
    return {
        snackbar: false,
        text: '',
        timeout: 3000,
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
                            this.snackbar = true;
                            if(res.data == 1){
                                sound.play();
                        this.text='Food added to Favourites!'
                        this.snackbar = true;
                        //this.fetch();
                            }else if(res.data == 0){
                        this.text='Food was already added to Favorites!'
                        this.snackbar = true;
                            }else{ 
                       this.text='Maximum limit reached. no more Favorites!'
                       this.snackbar = true;   
                       this.isFavorited = !this.isFavorited
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
                        sound.play();
                        this.text='Food Liked!'
                        this.snackbar = true;
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
                        this.text='Food removed from Favourites!'
                       this.snackbar = true; 
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