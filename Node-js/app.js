

// Dependencies
var rest = require('restler'),
	crypto = require('crypto');


// API key and shared secret
var	key = 'abc',
	secret = 'xyz';


// Signing function: adds key, timestamp and signature to params object
function sign(params) {
    params.key = key;
    params.timestamp = Math.round(new Date().getTime());
    params.signature = crypto.createHmac('sha256', secret).update(params.key + params.timestamp).digest('hex');
    return params;
}


// Define parameters
var params = {
	invoice_id: 1
};

// Add key, timestamp and signature to parameters
params = sign(params);

// Initiate the call
rest.post('http://sandbox.zenconomy.se/api/invoice/get', {
    data: params
}).on('complete', function(params, response) {
	// Handle response
	apiResponse = JSON.parse(response.rawEncoded);
	console.log(apiResponse);
});


