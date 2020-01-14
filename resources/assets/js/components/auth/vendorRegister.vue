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
                <h4>REGISTER</h4> 
                <div class="loginform">
                    <form id="RegisterForm" method="post" data-vv-scope='regForm'>
       <input type="text" v-model='regName' name="Name"  v-validate='"required|max:15"' value="" class="form_input required" placeholder="Enter Vendor Name" />
           <p class='text-danger shake' v-show="errors.has('regForm.Name')">{{ errors.first('regForm.Name') }}</p>
        
           <input type="text" v-model='regEmail' v-validate='"required|email|max:100"' name="Email" value="" class="form_input required" placeholder="Enter Email" />
           <p class='text-danger shake' v-show="errors.has('regForm.Email')">{{ errors.first('regForm.Email') }}</p>

           <input type="text" v-model='regAddress' name="Address"  v-validate='"required|max:30"' value="" class="form_input required" placeholder="Enter Address" />
           <p class='text-danger shake' v-show="errors.has('regForm.Address')">{{ errors.first('regForm.Address') }}</p>

           <input type="text" v-model='regPhone' name="Phone"  v-validate='"required|max:11"' value="" class="form_input required" placeholder="Enter Phone Number" />
           <p class='text-danger shake' v-show="errors.has('regForm.Phone')">{{ errors.first('regForm.Phone') }}</p>
           
           <input type="password" v-model='regPassword' v-validate='"required|min:6"' name="Password" value="" class="form_input required" placeholder="Enter Password" />
           <p class='text-danger shake' v-show="errors.has('regForm.Password')">{{ errors.first('regForm.Password') }}</p>

<label class='text-center'>Do you support food delivery?</label>
            <select class="form-control" v-model='selected' v-validate='"required|min:1"' name='delivery'> 
      <option value='1'> Yes </option>
       <option  value='0'> No </option>
      </select>
<p class='text-danger shake' v-show="errors.has('regForm.delivery')">{{ errors.first('regForm.delivery') }}</p>

           <input type="submit" v-if='online' @click.prevent='reg()' name="submit" class="form_submit" id="submit" value="SIGN UP" />
           <input type="submit" v-else @click.prevent='offline()' name="submit" class="form_submit" id="submit" value="SIGN UP" />
                  
          </form>
                    
                </div>
               <!-- <div class="signup_bottom">
                        <v-btn   @click.prevent='register()' outlined color="#FFA500">Back</v-btn>
                    <v-btn @click.prevent='login()' outlined color="#FFA500">Login</v-btn>
                </div>
                -->
               <!-- <div class="close_popup_button">
                        <router-link to='/'  class="close-popup"><img src="images/icons/black/menu_close.png" 
                            alt="" title="" /></router-link>
                </div>-->
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
            Creating {{regName}}'s Account...
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
       overlay:false,
       regName:'',
          regEmail:'',
          regAddress:'',
          regPhone:'',
          regPassword:'',
          snackbar: false,
        text: '',
        timeout: 9000,
        valError:[],
        online:null,
        selected:'',
            }
        },

        methods: {
          login(){
            this.$router.push({ name: "login" })
          },
          offline(){
          this.$toasted.show("This feature is currently unsupported in offline mode...");
         },
          register(){
            this.$router.push({ name: "register" })
          },
            reg(){
                          //validate
            this.$validator.validateAll('regForm').then(() => {
             if (!this.errors.any()) {
              
              this.overlay = true
           
                         //read pId for saving on reg
        this.readAllData('peter-parker')
      .then(data => {
         if(data[0] == undefined){
          console.log('pId DB empty')
          var pId = null;
         }else{
          var pId = data[0].pp || null;
         }

    var input = {'name':this.regName,'email':this.regEmail,'password':this.regPassword,
    'address':this.regAddress,'phone':this.regPhone, 'vendor':true,'pId':pId, 'delivery':this.selected };
      
                      //send to database with axios
                          axios.post('/register-user',input)
                          .then(res=>{
                        if(res.data.msg == 1){
                          this.saveForOffline(res)
                            this.overlay = false
                             this.$toasted.show("Registered! Please check your Email for verification.");
                              this.$router.push({name: "login"});
                //  this.text = 'Registered! Please check your Email for verification.';
                 //  this.snackbar = true
                          
                        }else if(res.data.msg== 0){
                          this.saveForOffline(res)
                          this.overlay = false
                          this.$toasted.show("Registered! But Verification failed. Please resend verification mail.");
                          this.$router.push({name: "login"});
                //  this.text = 'Registered! But Verification failed. Please resend verification mail.';
                 //  this.snackbar = true
                   
                   //
                        }
                        })
                        .catch(error=>{
                          this.overlay = false
                          if(error.response.status == 422){
                            this.valError = error.response.data.errors;
                         
                            this.text = 'This Email has been taken.';
                            this.snackbar = true
                          }else{
                    this.text = 'Please verify that your inputs are correct';
                     this.snackbar = true
                          } 
                        })
                      })
             }else{
               console.log('vee errors exist')
               //val err
               //do nothing, vee val got u
             }
             })//val
            
                  }, //reg

                  saveForOffline(regData){
                   console.log(regData)
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
var pass = myCipher(this.regPassword)   

//save
var dbPromise = idb.open('getFoodsDB', 14, function (db) {
              if (!db.objectStoreNames.contains('user')) {
                db.createObjectStore('user', {keyPath: 'id'});
                console.log('created user')
              }
              });

var dat = {id: new Date().toISOString(),'e':this.regEmail,'p':pass,
'tok':regData.data.userToken,'id':regData.data.userId,'name':regData.data.userName,'stat':regData.data.userStatus,'del':regData.data.deliverySupport}
console.log('dat',dat)

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
