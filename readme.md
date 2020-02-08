<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<p align="center"><img src="https://vuejs.org/images/logo.png"></p>
<p align="center"><img src="https://mdn.mozillademos.org/files/16742/pwa.png"></p>


<h3>GetFoods</h3>

<b>GetFood is an intended enterprise meal reservation application (SAAS).</b><br>
In order for restaurant owners to keep an organized system, maximize table turnover, and reduce waiting time for customers, GetFoods was built to maintain a reliable and efficient food reservation and ordering system.

<hr>

Objectives
For Vendor:
1.	Accurate records keeping for insights on best dishes, quantity to provide and total income.
2.	Drive more purchase through an intuitive food ordering system.
3.	Create a means of cashless transactions for vendor.
4.	Eliminate issue of “Finding change”.
5.	Ease services process.
For Customer:
1.	Provide an order/reservation system
2.	Provide cost analysis / history on food spending.
3.	Eliminate issue of “Finding change”
<hr>

Scope
The Application is currently targeted at small to medium food vendors (in several companies).
<hr>

Technologies
The Application will be built with VS code as an IDE. A Progressive web app (PWA), using the following technologies:
1.	HTML
2.	CSS
3.	JS
4.	Vue js
5.	Laravel
6.	MySQL
 
<hr>
 
 PWA Support
  <ul>
 <li>1. Add to mobile homescreen, using manifest.json file</li> 
 <li>2. Offline support with serviceworker.js</li>
 <li>3. Dynamic content (API) support using indexed DB (iDb.js)</li> 
 <li>4. Push web and mobile notifications, using Onesignal.</li>
 </ul>

<hr>
Packages

Laravel
 <ol>
 <li>s-ichikawa/laravel-sendgrid-driver</li> 
 <li>tymon/jwt-auth</li>
 <li>intervention/image</li> 
 <li>guzzlehttp/guzzle</li>
 <li>darryldecode/cart</li>
 </ol>

<br>
<hr>
APIs
 <ul>
 <li>1. Onesignal</li> 
 <li>2. Paystack</li>
 </ul>

<hr>
Vue
 <ul>
 <li>"bootstrap-vue": "^2.1.0",</li>
  <li>"moment": "^2.24.0",</li>
  <li> "vee-validate": "^2.1.5",</li>
  <li> "vue-paystack": "^2.0.2",</li>
  <li> "vue-router": "^3.0.2",</li>
  <li>"vue-socialmedia-share": "^1.0.1",</li>
  <li>  "vue-toasted": "^1.1.26",</li>
  <li> "vue2-animate": "^2.1.0",</li>
 </ul>
 
       
Cost
Hosting – 4,800 Per Yr.
Domain name – 3,900 (getfoods.com) Per yr.
TOTAL: N8,700

<hr>

Design
User levels:
1.	Vendor
2.	Customer
3. SuperAdmin
<br>

<hr>
<b>Modules: Vendor</b>
1.	Auth
2.	Cart
3.	Create product
4.	Order history (Vendor)
5.	Purchase history (Customer)
6.	Browse food (Read)

<hr>

Database
Tables:
 <ol>
 <li>Favorites</li> 
 <li>Foods</li>
 <li>Orders</li> 
 <li>temps</li>
 <li> Users</li>
 </ol>



<br>
<hr>

Steps to setup the local env.

Install xamp.

Search the keyword "laravel doc" in your browser.

Select documentation.

Download and install composer, its a small file, type the word "composer" in your cmd to verify installation.

Copy the code to install laravel and paste in your CMD, hit enter.

After installation.

Close and reopen cmd then run the word "laravel" to verify Sucesful installation.

Make sure your project is in the local server,  htdoc folder for xamp.

Start xamp.

Then run "php artisan serve" to start the server, then enter the specified localhost url in your browser, usually localhost:8000.


*You need to install nodeJs to run vue. 
https://git-scm.com/download/win

open the project and run 'npm run watch to start the vue server, along side laravel as backend'
