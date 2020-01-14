<template>
        <div class="container">
           
      <!--content here-->
      
      <div class="pages">
          <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                  <div id="pages_maincontent">
                   
                    <main role="main" class="">
      
    
  <template>
            <v-card
              class="mx-auto elevation-23 "
              max-width="344"
              outlined
            >

<menubar>
     </menubar>



      <div class="content-block slideUp">
          <h4>LOGIN</h4> 
          <div class="loginform">
              <form id="LoginForm" method="post" data-vv-scope='loginForm'>
                  <input type="text" name="Email" v-model='logEmail' v-validate='"required|email|max:100"' class="form_input required" placeholder="Enter Email" />
                  <p class='text-danger shake' v-show="errors.has('loginForm.Email')">{{ errors.first('loginForm.Email') }}</p>

                  <input type="password" v-model='logPassword' name="Password" v-validate='"required|min:6"' class="form_input required" placeholder="Enter Password" />
                  <p class='text-danger shake' v-show="errors.has('loginForm.Password')">{{ errors.first('loginForm.Password') }}</p>
                 
                  <div class="forgot_pass"><a href="/forgot-password" >Forgot Password?</a></div>
                  <input type="submit" v-if='online' name="submit" class="form_submit"  @click.prevent='login()' value="SIGN IN" />
                  <input type="submit" v-else name="submit" class="form_submit"  @click.prevent='loginOffline()' value="SIGN IN" />
            
                </form>
              
              <div class="signup_bottom">
                  
                                    <p>Don't have an account?</p>
               
                  <div class="my-2 text-center">
                      <v-btn @click.prevent='register()' outlined color="#FFA500">Sign Up</v-btn>   
                      </div>

                <div class="my-2 text-center">
                    <v-btn @click.prevent='resendEmail()' outlined color="#FFA500">Resend Verification</v-btn>   
                    </div>
                  
              </div>
          </div>
          
      </div>

      </v-card>
      </template>


<template>
        <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      >
      {{ text }}
      <v-btn
        color="#FFA500"
        text
        @click='snackbar=!snackbar'
      >
        Close
      </v-btn>
      </v-snackbar>
      </template>


  <!--Overlay-->
<template>
<div class="text-center">
  <v-overlay :value="overlay">
    <v-progress-circular indeterminate size="64"></v-progress-circular>
    <br>
    Signing In...
  </v-overlay>
</div>
</template>
<!--Overlay-->


<back></back>

                      </main>
              </div>
              
              
            </div>
          </div>
        </div>
        
        
      

          </div>
    </template>
    
    <style scoped>
    
      </style>
    

    
<script>
    export default {

        data(){
            return {
                logEmail: '',
          logPassword: '',
          snackbar: false,
        text: '',
        timeout: 10000,
        overlay:false,
        online:null
            }
        },

        methods: {
          register(){
            this.$router.push({ name: "register" })
          },
          resendEmail(){
            this.$router.push({ name: "resendemail" })
          },

            login(){
                          //validate specific reg fields
        this.$validator.validateAll('loginForm').then(() => {
             if (!this.errors.any()) {
              this.overlay = true

                    var input = {'email':this.logEmail, 'password':this.logPassword};
                    axios.post('/login-user',input)
                    .then(res => {
                    var result = res.data.result;
                  
                          if(result == 1){
                            this.text = 'Acount not verified. Please resend a verification email';
                            this.snackbar = true
                            this.overlay = false
                          }else if(result == 2){
                            this.text = 'Login failed. Invalid credentials';
                            this.snackbar = true
                            this.overlay = false
                          }else{
                            //start login 
                               localStorage.setItem('userToken',res.data.userToken);
                               localStorage.setItem('userId',res.data.userId);
                               localStorage.setItem('userName',res.data.userName);
                               localStorage.setItem('userMail',res.data.userMail);
                               localStorage.setItem('phone',res.data.phone);
                               localStorage.setItem('userStatus',res.data.userStatus);
                               localStorage.setItem('deliverySupport',res.data.deliverySupport);

                               //save for offline
                               this.clearSaveForOffline()

        //read and save Pid
        this.readAllData('peter-parker')
      .then(function(data) {
        
         if(data[0] == undefined){
          console.log('pId DB empty')
         }else{
          var pId = data[0].pp;
          if(pId){
      //save Pid
      fetch('/player-id', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({'peter': pId, 'parker': localStorage.getItem('userId')})
              })
                .then(res=> {
                    console.log('pId is a go');
                }) 
                .catch(error =>{
                      console.log(error)    
                      })
          }else{
            console.log('no pId')
          }  
         
         }
      })
//read and save Pid

                               var status = localStorage.getItem('userStatus')
                                
                                //validate if quest is coming from cart page then gotocheckout not dashboard
                                if(localStorage.getItem('shopper')){
                                  localStorage.removeItem('shopper')
                                  this.$router.push({name: "checkout"});
                                  return;
                                  
                                }else{

                                    if(status == 1){
                                  //admin
                                  //load add to store
                                  localStorage.setItem('vendorAddress',res.data.vendorAddress);

                                  this.$router.push({name: "vendordashboard"});
                                }else if (status == 0){
                                  //user
                                  this.$router.push({name: "userdashboard"});
                                }else if (status == 47){
                                  /* For super admin page*/
                                  this.$router.push({name: "superadmindash"});
                                }
                                }

                              
                          }
                    })
                    .catch(error =>{
                      this.overlay = false
                      console.log(error)
                    })
                  }else{ //if error
                    //error is auto shown, dont worry
                  } //if error
                })//val
              
                   }, //login




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
                

                 clearSaveForOffline(){
                   console.log('called save for offline')
                     //encrypt pass and save to indexed db
           var cipher = salt => {
    var textToChars = text => text.split('').map(c => c.charCodeAt(0))
    var byteHex = n => ("0" + Number(n).toString(16)).substr(-2)
    var applySaltToChar = code => textToChars(salt).reduce((a,b) => a ^ b, code)    

    return text => text.split('')
        .map(textToChars)
        .map(applySaltToChar)
        .map(byteHex)
        .join('')
}
// To create a cipher
var myCipher = cipher('mySecretSalt')
//Then cipher any text:
var pass = myCipher(this.logPassword)   

//save
var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('user')) {
                db.createObjectStore('user', {keyPath: 'id'});
                console.log('created user')
              }
              });

                  //clear data func
function clearAllData(table){
  return dbPromise
  .then(function(db){
      var tx = db.transaction(table, 'readwrite');
      var store = tx.objectStore(table);
      store.clear();
      return tx.complete
    })
    .catch(error =>{
        console.log(error)    
        })
  }

  var dat = {id: new Date().toISOString(),'e':this.logEmail,'p':pass,
  'tok':localStorage.getItem('userToken'),'id':localStorage.getItem('userId'),'name':localStorage.getItem('userName'),
  'stat':localStorage.getItem('userStatus'),'del':localStorage.getItem('deliverySupport')}

//save data func
function saveData(dat){
      console.log('user',dat)
      console.log('saving  => saved')
return   dbPromise
.then(function(db) {
var tx = db.transaction('user', 'readwrite');
var store = tx.objectStore('user');
store.put(dat);
return tx.complete;
})
.catch(error =>{
    console.log(error)    
    })
}

           //call clear
           clearAllData('user')
                .then(res=>{
                  console.log('cleared user')

                  //if cleared,then call the save function
                  saveData(dat);
                })
                .catch(error =>{
                      console.log(error)    
                      })
                 },


                 loginOffline(){
                          //validate specific form
        this.$validator.validateAll('loginForm').then(() => {
             if (!this.errors.any()) {
              this.overlay = true

                    var input = {'email':this.logEmail, 'password':this.logPassword};
                   
                       //read offline user
        this.readAllData('user')
      .then(data=> {
        
         if(data[0] == undefined){
          console.log('user DB empty')
          this.$toasted.show("You need to login at least once to use this feature offline...");
          this.overlay = false 
         }else{
          //check auth
          //decryt pass
          var decipher = salt => {
    var textToChars = text => text.split('').map(c => c.charCodeAt(0))
    var saltChars = textToChars(salt)
    var applySaltToChar = code => textToChars(salt).reduce((a,b) => a ^ b, code)
    return encoded => encoded.match(/.{1,2}/g)
        .map(hex => parseInt(hex, 16))
        .map(applySaltToChar)
        .map(charCode => String.fromCharCode(charCode))
        .join('')
}
//To decipher, you need to create a decipher and use it:
var myDecipher = decipher('mySecretSalt')
var pass = myDecipher(data[0].p)    // --> 'the secret string'

if(this.logEmail == data[0].e && this.logPassword == pass){
  console.log('login ok')
   //start login 
                              localStorage.setItem('userToken',data[0].tok);
                               localStorage.setItem('userId',data[0].id);
                               localStorage.setItem('userName',data[0].name);
                               localStorage.setItem('userMail',data[0].e);
                               localStorage.setItem('userStatus',data[0].stat);
                               localStorage.setItem('deliverySupport',data[0].del);
                               var status = localStorage.getItem('userStatus')
                                    if(status == 1){
                                  //ven
                                  this.$router.push({name: "vendordashboard"});
                                }else if (status == 0){
                                  //user
                                  this.$router.push({name: "userdashboard"});
                                }else if (status == 47){
                                  /* For super admin page*/
                                  this.$router.push({name: "superadmindash"});
                                }
                                
}else{
  this.$toasted.show("No user found. Please try again with internet connection...");
}
this.overlay = false
         }
      })
//read offline user
       

                  }else{ //if error
                    //error is auto shown, dont worry
                  } //if error
                })//val
              
                   }, //login

        },//meth end


        

        created() {
          //this.Auth()
        },

        mounted(){
          var online = navigator.onLine; 
            if(online){
                //online
                console.log('on')
                this.online = true;
            }else{
                //offline
                console.log('off')
                this.online = false;
            }
        }

    }
</script>
