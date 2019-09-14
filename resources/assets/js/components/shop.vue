<template>
    <div class="container">
        
<div class="pages">
    <div data-page="shop" class="page no-toolbar no-navbar">
      <div class="page-content">
      <h2 class="page_title">AVAILABLE FOOD</h2>
            
       <div id="pages_maincontent">
        
        <br>
            <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                      <li class="breadcrumb-item active" aria-current="page">Food ({{food_count}})</li>
                    </ol>
                  </nav>
        
                      <!-- ********************************************** empty -->
                           
                        <div v-if='empty' class='text-center alert alert-info'>
                           Sorry, the Kitchen is empty.
                                </div>
        
                                 <!--loading -->
     <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
    <div v-if='data_load' class='text-center'>
      <template>
          <b>  Fetching Food</b>
         <v-progress-circular 
         color="orange"
         indeterminate
         ></v-progress-circular>
                </template>
                 </div>
        </transition>
                                      
             <!--loading temp-->
<transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                    <div v-if='wait' class='text-center'>
                      <template>
                        <b>Kitchen delay, please wait.</b>
                         <v-progress-circular 
                        color="red"
                        indeterminate
                        >
                        </v-progress-circular>
                                </template>
                                 </div>
                        </transition>
             

      <div class="page_single layout_fullwidth_padding">
        
        
        <ul class="shop_items">
                
            <li v-for='con in content' v-bind:key='con.id'>
            <div class="shop_thumb">
                <v-img 
                :src="'/storage/food/'+con.img"
                :alt="con.title"
                :lazy-src="`/images/black-spinner.gif`"
                title="" ></v-img>
            </div>
            <div class="shop_item_details">
            <h4>{{con.title}}</h4>
            <div class="shop_item_price"><strike>N</strike>{{con.amt}}</div>
              <div class="item_qnty_shop">
                  <form id="myform" method="POST" action="#">
                      <input type="button" value="-" class="qntyminusshop" field="quantity" @click.prevent='decre()'/>
                      <input type="text" name="quantity" :value="qty" class="qntyshop" />
                      <input type="button" value="+" class="qntyplusshop" field="quantity" @click.prevent='incre()'/>
                  </form>
              </div>
               
            <cartButton
            :id=con
            >
            </cartButton>
          
            <favButton
            :id=con.id
            >
            </favButton>

               
            </div>
            </li> 
        </ul>

      <span v-if='!empty'>
            <div class="shop_pagination" >
            <a href="" class="prev_shop" @click.prevent="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">PREV PAGE</a>
            <span class="shop_pagenr">  <span>{{pagination.current_page}} of {{pagination.last_page}}</span></span>
            <a href="shop.html" class="next_shop" @click.prevent="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url">NEXT PAGE</a>
            </div>
        
        
            <div class="signup_bottom">
                <router-link to="/cart">VIEW TABLE</router-link>
            </div>
     </span>

        </div>
        
        </div>
        
        
      </div>
    </div>
  </div>
        
    </div>
</template>

<script>
    export default {

        data(){
            return {
                content:[],
                empty:false,
                wait:false,
                data_load: true,
                pagination: [],
                food_count:'',
                qty:1,
            }
        },

    

        methods: {
        
    //fetch blogs
    fetch(page_url){
                    if(page_url){
                    NProgress.start();
                    }
                    //off snackbar
                    this.snackbar = false;
                  var   page_url = page_url || '/get-foods';
        
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
                    this.makePagination(res.meta, res.links);
                    this.wait = false;
                    this.food_count = res.meta.total;
                    NProgress.done();
                  })
                  .catch(error =>{
                      //off loader
                      this.data_load = false;
                        this.wait = true;
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


                like(id){
                   
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
                        alert('Food added to Favourites!');
                        //this.fetch();
                            }else if(res.data == 0){
                        alert('Food was already added to Favorites');
                       
                            }else{
                       alert('Favorite Maxed out!');       
                            }
                            NProgress.done();
                           
                        })
                        .catch(error =>{
                  alert("Failed to add food. Try again");
                  
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
                  alert("The like action failed...");
                  
                    NProgress.done();        
                      })
                    }
                    
                },

            incre(){
                this.qty = this.qty + 1;
            },
            decre(){
                this.qty = this.qty - 1;
            },

            cart(con){
                console.log(con)
                var tempUserCartID = Math.floor(Math.random()*10000);
                localStorage.setItem('tempUserCartID',tempUserCartID);
              //  con.assign(tempUserCartID);
                axios.post('/add-to-cart',con)
                        .then(res=>{
                            if(res.data == 1){
                        alert('Food added to Cart!');
                        //this.fetch();
                            }
                            NProgress.done();
                           
                        })
                        .catch(error =>{
                  alert("Failed. Try again");
                    NProgress.done();        
                      })
            },

        },

             //watch data load
             watch : {
              content(a,b){
               if(a){
                //data content loaded, it is safe to display
                this.data_load = false;
                this.data = true;
               }
            },
        },
        
        mounted() {
            this.fetch()
        }
    }
</script>
