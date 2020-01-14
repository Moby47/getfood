<template>
    <div class="container">
    
<!--content here-->

<div class="pages">
    <div data-page="checkout" class="page no-toolbar no-navbar">
      <div class="page-content">
      
            
            <div id="pages_maincontent">
             
               <menubar></menubar>
             <br>
              <template>
                <v-card
                  class="mx-auto"
                  max-width="344"
                 
                >
                 <nav aria-label="breadcrumb ">
                         <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link to='/'>Home</router-link></li>
                            <li class="breadcrumb-item"><router-link to='/kitchen'>Kitchen</router-link></li>
                           <li class="breadcrumb-item"><router-link to='/table'>Table</router-link></li>
                           <li class="breadcrumb-item active" aria-current="page" >Eat</li>
                           
                         </ol>
                       </nav>
                </v-card>
              </template>
              
      <div class="page_single layout_fullwidth_padding">
              
             
              <template>
                <v-card
                  class="mx-auto p-1"
                  max-width="344"
                 
                >
              <h4 class="checkout_title">ORDER DETAILS</h4>

                <!-- ********************************************** empty -->
                <span v-show='empty < 1'>
                    <div  class='text-center alert alert-primary'>
               Your Table is Empty. 
                       </div>

                       <div class="my-2 text-center">
                          <v-btn @click.prevent='shop()' outlined color="#FFA500">Add Food</v-btn>   
                          </div>
         </span>
                       <!--loading 
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
        -->
                    
          
                                       
              <!--loading temp-->
        <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='wait' class='text-center'>
                       <template> <br>
                 <span class='alert alert-primary'>Internet Connection is needed</span>
                 <br><br> 
                   <v-list-item three-line>
                <!--      <v-img
                height="300"
                  src="/images/wifi.svg"
                  :lazy-src="`/images/black-spinner.gif`"
                >
                </v-img>-->
                    </v-list-item>
                        <br> <br>
                 <div class="my-2 text-center"  >
                  
          <v-btn @click.prevent='refresh()' outlined color="#FFA500">RELOAD</v-btn>   
          
          </div> <br> <br>
                         </template>
                                  </div>
                         </transition>

 
                      <div class="order_item animated tdExpandInBounce" v-for='con in content' v-bind:key='con.id'>
                          <div class="order_item_thumb"><a href="#" class="close-panel">
                            </a></div>
                          <div class="order_item_title"><span>{{con.quantity}} X</span> {{con.name}}</div>
                          <div class="order_item_price"><strike>N</strike>{{con.attributes.total}}</div>           
                      </div>
                      
               
              
                 
                 <span v-show='subtotal > 0' class=''>
                <h4 class="checkout_title">TOTAL</h4>      
                        <div class="carttotal_full slideUp">
                            <div class="carttotal_row_last">
                   <div class="carttotal_left">SERVICE CHARGE</div> <div class="carttotal_right"><strike>N</strike>{{charges}}</div>
                            <div class="carttotal_left">SUBTOTAL</div> <div class="carttotal_right"><strike>N</strike> {{subtotal}}</div>
                           
                     <div class="carttotal_left ">TOTAL</div> <div class="carttotal_right text-success"><strike>N</strike> {{total}}</div>
                            </div>
                        </div> 


                        
                        <!--show only if cart::exist-->
                        <template v-if='go == true'>
                            <paystack
                                :amount="amount"
                                :email="email"
                                :paystackkey="paystackkey"
                                :reference="reference"
                                :callback="callback"
                                :close="close"
                                :embed="false"
                            >
                            <a href="#"  id='pay' class="text-center  button_full btyellow slideUp">EAT</a> 
                            </paystack>
                            
                        </template>
                        
            <!--reset back to select delivery meth-->
            <h4 class="checkout_title ">CHOOSE A DELIVERY METHOD</h4>
            
       <div class="my-2 text-center">
          <v-btn v-if='go == true' 
             @click.prevent='back()' outlined color="#FFA500">Delivery Method</v-btn>   
          </div>
            
            <div class="my-2 text-center">
       <v-btn v-if='choiceBtn == false' @click.prevent='self()' outlined color="#FFA500">Pick-up By Self</v-btn>   
            </div>

       <div class="form-group" v-if='addText == true'>
        <label for="">Enter Your Delivery Address</label>
        <input type="text" class="form-control" name='address' 
        v-model='address' v-validate='"required"' placeholder="Eg: no 47 nehita, devine homes">

        <transition  name="fadeLeft">
            <span class='text-danger shake' v-show="errors.has('address')">{{ errors.first('address') }}</span>
             </transition>
      </div>
      
       <div class="my-2 text-center">
       <v-btn v-if='addText == true' @click.prevent='ok()' outlined color="#FFA500">Ok</v-btn> 
       <v-btn v-if='addText == true' @click.prevent='reset()' outlined color="#FFA500">Reset</v-btn>   
            </div>

  <div class="my-2 text-center">
       <v-btn v-if='choiceBtn == false' @click.prevent='vendor()' outlined color="#FFA500">Vendor delivery</v-btn>   
            </div>
                       
                </span>

                <!--  <transition name='anime' enter-active-class='animated fadeIn' :duration='200' leave-active-class='animated fadeOut'>
                     <div v-if='TotalWait' class='text-center'>
                       <template>
                         <p>Reloading Payment Info. Please Wait..</p>
                            <v-progress-circular 
                         color="#f2901d"
                         indeterminate
                         >
                         </v-progress-circular> 
                                 </template>
                                  </div>
                         </transition>-->
                
                </v-card>
               </template>
   
              </div>
       </div>
         
           
      </div>
    </div>
  </div>
  
  <!--content here-->
  <template>
    <div class="text-center">
      <v-overlay :value="overlay">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
        <br>
    {{loadingText}}
      </v-overlay>
    </div>
  </template>



  <back></back>

    </div>
</template>


      
<script>

import paystack from 'vue-paystack';

    export default {

      //meta
   metaInfo: {
       charset: 'utf-8' ,
       name: 'viewport', content: 'width=device-width, initial-scale=1',
      title: ' GetFoods - Checkout',
         meta: [{
           'name': 'description',
        'content': 'Online food reservation and ordering platform to maintain a reliable and efficient system',
      }],
      noscript: [
      { innerHTML: 'JavaScript is required.' }
    ]
    },
    //meta
      components: {
        paystack
    },
        data(){
            return {
              overlay:false,
                content:[],
                wait:false,
                TotalWait:false,
                go:false,
                choiceBtn:false,
                address:'',
                addText:false,
                data_load: true,
                empty:47,
                charges:'0.00',
                subtotal:0, //total food + 50
                total:0, //amount in naira
                ref:'',

                paystackkey: process.env.MIX_PAYSTACK_PUBLIC_KEY, //process.env.MIX_PAYSTACK_PUBLIC_KEY
                email: localStorage.getItem('userMail'),
                amount: 0, //total in naira * 100 = Kobo equivalent 

                loadingText: 'Loading Food Details...',
                pId:[]
                
            }
        },

        computed: {
        reference(){
          let text = "";
          let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

          for( let i=0; i < 10; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

          this.ref = text
          return text;
        }
        },

        
        methods: {
          shop(){
            this.$router.push({ name: "kitchen" })
          },

          self(){
            var del = localStorage.getItem('delivery')
            if(del){
              localStorage.removeItem('delivery')
            }
            localStorage.setItem('delivery','self')
            localStorage.setItem('address', 'N/A')

            this.choiceBtn = !this.choiceBtn
            this.go = !this.go
          },

          vendor(){
            this.addText = true
            this.choiceBtn = !this.choiceBtn
          },

          reset(){
            this.addText = false
            this.choiceBtn = false
            this.addText = false
          },

          ok(){
            this.$validator.validateAll().then(() => {
           
           if (!this.errors.any()) {
             //go
            var add = this.address
          localStorage.setItem('delivery','vendor')
          localStorage.setItem('address', add)
          this.addText = !this.addText
          this.go = !this.go
           }
          })

          },

          back(){
            this.go = !this.go
            //this.addText = !this.addText
            this.choiceBtn = !this.choiceBtn
          },

          paid(){            
            //save to db. order TB
           var input = {'content':this.content, 'cusId':localStorage.getItem('userId')}

            axios.post('/save-order',input).then(res=>{
		
              console.log(res.data)

		      	})
      
            //clear cart

          },

          callback: function(response){
           // console.log(response)
            
           if(response.status == 'success'){

            this.overlay = true
            this.loadingText = 'Please wait, almost done...'

            //save to DB
        //    if(localStorage.getItem('address') && localStorage.getItem('delivery')){
              var address = localStorage.getItem('address')
              var delivery = localStorage.getItem('delivery')
          //  }

             var input = {'total':this.total,'ref':response.reference, 'trans':response.trans,
             'cusId':localStorage.getItem('userId'), 'address':address, 'delivery':delivery,
             'tempId':localStorage.getItem('tempUserCartID'),'userMail':localStorage.getItem('userMail'),
             'userName':localStorage.getItem('userName')}

            axios.post('/save-order',input)
            .then(res=>{
                console.log('order saved')  
    // ! finish save-order and push to vendors processing before clearing 
            })
            .then(res=>{

               //notify vendors by push api
     var input3 = {'tempId':localStorage.getItem('tempUserCartID')}
            axios.post('/push-to-vendors',input3)
            .then(res=>{
              

              if(res.data[0] == undefined){
                this.pId = '';
                console.log('pId for ven is empty')
              }else{
                this.pId = res.data
              }

              if(this.pId){
                  console.log('push to vens')
            //  console.log(this.pId)
                //push programatically 
fetch('https://onesignal.com/api/v1/notifications', {
                method: 'POST',
                headers: {
                  'Authorization': 'Basic '+process.env.MIX_ONESIGNAL_API_KEY,
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  'app_id':'da6349ad-e18f-471b-8d57-30444a9d158f',
                  'contents': {'en': localStorage.getItem('userName')+' just placed an order, view now'},
                  'headings': {'en': 'Hello'},
                  'url': 'http://localhost:8000/orders',
                  'include_player_ids': this.pId,
                  'web_push_topic': 'notify-admin',
           'chrome_web_image':'http://localhost:8000/images/push-images/order.png',//512 or >
    'chrome_web_badge':'http://localhost:8000/images/app-icons/app-icon-96x96.png',// 72 or >
    // 'chrome_web_icon':'http://localhost:8000/images/app-icons/app-icon-192x192.png' //192 or >
                })
              })
                .then(res=> {
                    console.log('push to vendors ok');
                 //   console.log(res);
                   //read pId and push to self #func takes title,body,url,tag
  this.pushToUser('Hello '+localStorage.getItem('userName'),'Click here to view your orders','http://localhost:8000/userdashboard','thanks') 

                }) 
                .catch(error =>{
                      console.log(error)    
                      })
//push
              }
            })
            .then(res=>{
              //clear cart
            var input2 = {'userId':localStorage.getItem('tempUserCartID')}
            axios.post('/clear-cart',input2).then(res=>{
                console.log('cart cleared')  
            })
            .catch(error =>{
                console.log(error)    
               })

                //clear temp data
            var input3 = {'userId':localStorage.getItem('tempUserCartID')}
            axios.post('/clear-temp',input3).then(res=>{
                console.log('temp DB cleared')  
            })
            .catch(error =>{
                console.log(error)    
               })
            
          //clear local sto
            localStorage.removeItem('cart')
            localStorage.removeItem('address')
            localStorage.removeItem('delivery')
          
            this.overlay = false
            this.loadingText = ''
            //redirect to success page
            this.$router.push({name: "success"});
            })
            .catch(error =>{
                console.log(error)    
               })
            })
           
            .catch(error =>{
                console.log(error)    
               })
            
            

           }else{
             alert('Payment Failed')
           }
           
            
          },
          close: function(){
            console.log("Payment closed")
          },

        refresh(){
          this.fetch()
          this.getSumTotal()
        },
        
            fetch(){
                  fetch('/checkout'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.content = res.data;
                  //  console.log(this.content)
                    this.wait = false;
                   this.empty = this.content.length;
                  })
                  .catch(error =>{
                      //off loader
                      this.data_load = false;
                        this.wait = true;
                           
                      })

                },//

                getSumTotal(){
                  this.overlay = !this.overlay
                  fetch('/sumtotal'+'/'+ localStorage.getItem('tempUserCartID'))
                  .then(res => res.json())
                  .then(res=>{
                    this.subtotal = res
                    var sum = this.subtotal + 50;
                    //amount in naira
                    this.total = sum;
                    //amount to kobo N500
                    this.amount = sum * 100;
                    this.overlay = !this.overlay
                     this.TotalWait = false;
                  })
                  .catch(error =>{
                    this.overlay = false
                         
                      })
                },

                checkout(){
                  if(localStorage.getItem('userToken')){
                    //authed, ok!
                    this.fetch()
                  this.getSumTotal()
                  }else{
                    //auth needed
                  //set variable to redirect to checkout page after guest auth
                  localStorage.setItem('shopper','shopper')
                  //send to login
                   this.$router.push({name: "login"});
                  }
                  
                },

                //Pid from indexed DB
         readAllData(table){
          var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('peter-parker')) {
                db.createObjectStore('peter-parker', {keyPath: 'id'});
                console.log('created peter-parker')
              }
              });
  return dbPromise.then(function(db){
    var tx = db.transaction(table, 'readonly');
    var store = tx.objectStore(table);
    return store.getAll();
  })
  .catch(error =>{
          console.log(error)    
          })
},

                //function to push to user
   pushToUser(title,body,url,tag){

this.readAllData('peter-parker')
      .then(function(data) {

      //   console.log('peter-parker',data[0]);
          if(data[0] == undefined){
            var pId = '';
          }else{
            var pId = data[0].pp;
          }
           
          if(pId){
//push programatically 
fetch('https://onesignal.com/api/v1/notifications', {
method: 'POST',
headers: {
  'Authorization': 'Basic '+process.env.MIX_ONESIGNAL_API_KEY,
 'Content-Type': 'application/json',
 'Accept': 'application/json'
},
body: JSON.stringify({
 'app_id':'da6349ad-e18f-471b-8d57-30444a9d158f',
 'contents': {'en': body},
 'headings': {'en': title},
 'url': url,
 'include_player_ids': [pId],
 'web_push_topic':tag,
   'chrome_web_image':'http://localhost:8000/images/push-images/success.png',//512 or >
 'chrome_web_badge':'http://localhost:8000/images/app-icons/app-icon-96x96.png',// 72 or >
  //   'chrome_web_icon':'http://localhost:8000/images/app-icons/app-icon-192x192.png' //192 or >
})
})
.then(res=> {
   console.log('push to cus, ok');
}) 
.catch(error =>{
     console.log(error)    
     })
          } else{
            consol.log('no pId found')
          } 
      })

},

        },
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
           this.checkout()
           
        }
    }
</script>
