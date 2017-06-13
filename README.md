# Transbank OneClick Rest API

This is a simple API that wraps arround SOAP calls so you can easily make calls to the OneClick Web Service.

## Endpoints

### Authentication
All endpoints must be called using a special header called `x-auth-token`. This token must be kept secret and only the server and client should know it. You can create a new GUID using [https://guidgenerator.com/](https://guidgenerator.com/) or another tool that generates UUID-4 tokens. This token could be any string but is recommended an unique one.

See the file *includes/constants.php* and configure the authentication token.

### init.php
Activates the user for using *oneclick*. After obtaining the *session token* you should send a post to the url. This will redirect to the *oneclick* registration process.

#### Example Form

```html
<form action="https://webpay3gint.transbank.cl/filtroUnificado/bp_inscription.cgi" 
		id="webpay-form" method="post">
		
	<input type="hidden" name="TBK_TOKEN" value="{session token}" />
	
</form>

<script>document.getElementById("webpay-form").submit();</script>
```

#### route
**GET** */api/registration/init.php*

#### params
|params|description
|---|---|
|user| username
|email| email
|url| callback url that transbank will use to execute *finish.php* logic.

#### example call
*/api/registration/init.php?user=test1&email=test1@test.dev&url=http://www.mywebsite.dev*

**Header**
 
x-auth-token: 48fe43fa-9a2c-43f3-8678-0ddc7196ca52

#### return
```json
{
  "data": {
    "session": "e87beb6ece336373f6d4ba37a35aa112fc3932ddcda08e204e94b997cc06df25",
    "url": "https://webpay3gint.transbank.cl/filtroUnificado/bp_inscription.cgi"
  },
  "_meta": [],
  "status": 200
}
```

### finish.php
Obtains the user token and finish the activation process.

Transbank will send you the session token as `token_ws` via POST. This is the session token you should be sending to the endpoint.

#### route
**GET** */api/registration/finish.php*

#### params
|params|description
|---|---|
|session| Session token obtained in the *init.php* endpoint. This is provided by transbank inside POST params.

#### example call
*/api/registration/finish.php?session=27b9f75fa1394b51bee83345cebee63d*

**Header**
 
x-auth-token: 48fe43fa-9a2c-43f3-8678-0ddc7196ca52

#### return
```json
{
  "data": {
    "token": "c991f8fef94cd8417408a8992a57b6a5fc3932ddcda08e204e94b997cc06df25",
    "operation" : {
    	"code" : "1234",
    	"response" : "0"
    },
    "card" : {
    	"type" : "VISA",
    	"digits" : "1234"
    }
  },
  "_meta": [],
  "status": 200
}
```

### User Token
The following methods needs the user token returned in *finish.php*. All request must include the header `x-tbk-token` additional to the `x-auth-token` used for authorization.

### remove.php
Removes the user authorization for using *oneclick*.

#### route
**GET** */api/registration/remove.php*

#### params
|params|description
|---|---|
|user| Username used in the *init.php* endpoint.
|token| Token obtained in *finish.php* endpoint. Must be sent as header `x-auth-token`.

#### example call
*/api/registration/remove.php?user=test1*

**Header**
 
x-auth-token: 48fe43fa-9a2c-43f3-8678-0ddc7196ca52

x-tbk-token: 226a08fe73b84dd7891c2e1a4f05f78b

### authorize.php
Creates a new *oneclick* purchase.

#### route
**GET** */api/payments/authorize.php*

#### params
|params|description
|---|---|
|user| Username used in the *init.php* endpoint.
|order| Unique order number for the purchase identification.
|amount| Total Amount that will be charged to the credit card.
|token| Token obtained in *finish.php* endpoint. Must be sent as header `x-auth-token`.

#### example call
*/api/registration/authorize.php?user=test1&order=20170609222047231&amount=20000*

**Header**
 
x-auth-token: 48fe43fa-9a2c-43f3-8678-0ddc7196ca52

x-tbk-token: 226a08fe73b84dd7891c2e1a4f05f78b

#### return
```json
{
  "data": {
    "operation" : {
    	"code" : "1234",
    	"response" : "0",
    	"transaction" : "123"
    },
    "card" : {
    	"type" : "VISA",
    	"digits" : "1234"
    }
  },
  "_meta": [],
  "status": 200
}
```

### reverse.php
Undo a *oneclick* purchase.

#### route
**GET** */api/payments/reverse.php*

#### params
|params|description
|---|---|
|order| Unique order number for the purchase identification.

#### example call
*/api/registration/reverse.php?order=20170609222047231*

**Header**
 
x-auth-token: 48fe43fa-9a2c-43f3-8678-0ddc7196ca52

x-tbk-token: 226a08fe73b84dd7891c2e1a4f05f78b

## Certificates
Certificates for development are already configured. If you want to use the certificates for production use you must include them inside the *certs/* directory and enable Production mode in *include/constants.php*. Changing *kNJSCurrentEnv* to *kNJSEnvProduction*.

Default certificates names are *private.key* and *certificate.crt*.

## Testing
All testing should be made in a public url that Transbank could access. You can use [https://ngrok.com/](https://ngrok.com/) to expose localhost as a public server. Also you can use [https://www.getpostman.com/](https://www.getpostman.com/) for making calls to the endpoints.

If you are using PHP is highly recommended using [https://github.com/guzzle/guzzle](https://github.com/guzzle/guzzle) for creating a client.

Some tests were made using *mocha* and *chai* in nodejs.
Execute them using *npm test* inside the test directory.

## Security
Ensure that only the *api/* directory can be viewed in browsers.

## Thanks
Special thanks to the authors of this repo [https://github.com/freshworkstudio/transbank-web-services](https://github.com/freshworkstudio/transbank-web-services) that made possible creating this simple api.



Made with <i class="fa fa-heart">&#9829;</i> by <a href="http://ninjas.cl" target="_blank">Ninjas</a>.
