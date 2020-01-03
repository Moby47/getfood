<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<p align="center"><img src="https://vuejs.org/images/logo.png"></p>
<p align="center"><img src="https://mdn.mozillademos.org/files/16742/pwa.png"></p>


About<br>
<b>GetFood is an intended enterprise meal reservation application (SAAS).</b>
In order for restaurant owners to keep an organized system, maximize table turnover, and reduce waiting time for customers, GetFoods was built to maintain a reliable and efficient food reservation and ordering system.

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

Scope
The Application is currently targeted at small to medium food vendors (in several companies).

Technologies
The Application will be built with VS code as an IDE. A Progressive web app (PWA), using the following technologies:
1.	HTML
2.	CSS
3.	JS
4.	Vue js
5.	Laravel
6.	MySQL
 
PWA Support
1. Add to mobile homescreen, using manifest.json file
2. Offline support with serviceworker.js
3. Dynamic content (API) support using indexed DB (iDb.js)
4. Push web and mobile notifications, using Onesignal.


APIs
1. Onesignal
2. Paystack

Packages

Laravel
s-ichikawa/laravel-sendgrid-driver
tymon/jwt-auth
intervention/image
guzzlehttp/guzzle
darryldecode/cart

Vue
"bootstrap-vue": "^2.1.0",
        "moment": "^2.24.0",
        "vee-validate": "^2.1.5",
        "vue-paystack": "^2.0.2",
        "vue-router": "^3.0.2",
        "vue-socialmedia-share": "^1.0.1",
        "vue-toasted": "^1.1.26",
        "vue2-animate": "^2.1.0",
        
        
Cost
Hosting – 4,800 Per Yr.
Domain name – 3,900 (getfoods.com) Per yr.
TOTAL: N8,700

Design
User levels:
1.	Vendor
2.	Customer
3. SuperAdmin
<br>

<b>Modules: Vendor</b>
1.	Auth
2.	Cart
3.	Create product
4.	Order history (Vendor)
5.	Purchase history (Customer)
6.	Browse food (Read)

Database
Tables:
3.	Favorites
4.	Foods
5.	Orders
6. temps
7. Users



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
