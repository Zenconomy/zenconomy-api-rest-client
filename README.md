Zenconomy API REST Client
=========================

_Invoicing and Accounting software in the cloud - https://www.zenconomy.se_

Examples and test clients for accessing the Zenconomy REST API


This code is licensed for use, modification, and distribution
under the terms of the MIT License (see http://en.wikipedia.org/wiki/MIT_License)


### Access the Zenconomy API from your REST client

The base URL for calling the API during development is http://sandbox.zenconomy.se/api, so for example to get an invoice you would call http://sandbox.zenconomy.se/api/invoice/get

The API does not differentiate between HTTP GET and POST. For clarity, our documentation uses GET for calls that primarily fetch data, and POST for any calls that create, update or delete objects.

### Authentication

All calls must include a key, a UNIX timestamp in milliseconds, and a signature. The variables need to be included in the querystring or POST body as follows:

key=X&timestamp=Y&signature=Z

The signature is a HMAC SHA256 hash of a string consisting of your public key and the timestamp, hashed using your shared secret. Examples:

```PHP
// PHP
$signature = hash_hmac( 'sha256', $key . $timestamp, $secret );
```

```javascript
// Node.js
var signature = crypto.createHmac('sha256', secret).update(key + timestamp).digest(‘hex’);
```

###Response

The API responds with a JSON object in the following format

```javascript
{
	// boolean, indicates whether the call was a success. If FALSE, no data will persist
	ok: true,

	// array of messages - these are only for information and do not contain data
	msg: [
		{
			// type, “notification”, “warning” or “error”
			type: “notification”,
			 // the message in cleartext
			content: “The invoice was created”
		}
	],

		// data can be an array or object depending on what type of data is being returned
		data: {
			example_id: 1,
			name: “Example”
		}
	}
```


###Example code

A PHP example is included. This example is based on Pest REST Client for PHP - http://github.com/educoder/pest
