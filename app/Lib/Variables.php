<?php

define('APP_NAME', 'Food Delivery');
define('APP_STATUS', 'live');
define('API_KEY', '');

define('TEST_MOBILE_NO', ''); //e.g +13472720544 // no should be with the country code
define('BASE_URL', ''); //example  http://abc.com/mobileapp_api/
date_default_timezone_set('Asia/Hong_Kong');


define('RADIUS', '20'); //value will be in KM. If you set 1000 it means it will fetch the restaurants which comes in 1000 km radius


define('UPLOADS_FOLDER_URI', 'app/webroot/uploads');
define('VERIFICATION_DOCUMENTS', 'verification_documents');
define('PREP_REGISTRATION_SUBJECT', 'Confirm your Food Delivery Registration');
define('VERIFICATION_PHONENO_MESSAGE', 'Your verification code is');

//DATABASE
define('DATABASE_USER', '');
define('DATABASE_PASSWORD', '');
define('DATABASE_NAME', '');


//PostMark
define('POSTMARK_SERVER_API_TOKEN', '');
define('SUPPORT_EMAIL', 'Food Delivery <admin@fooddelivery.com>');
define('TEST_EMAIL', ''); //test@gmail.com
define('GOOGLE_MAPS_KEY', '');
define('ADMIN_EMAIL_1', '');
define('ADMIN_EMAIL_2', '');
define('ADMIN_EMAIL_3', '');

//Twilio
define('TWILIO_ACCOUNTSID', 'twilo account sid');
define('TWILIO_AUTHTOKEN', 'auth tokon');
define('TWILIO_NUMBER', '+1XXXXXX21'); // put the registered number here

//Firebase
define('FIREBASE_PUSH_NOTIFICATION_KEY', '');  

define('FIREBASE_URL', '');


//PayMe
define('PAYME_URL', '');
define('client_id', '');
define('client_secret', '');
define('keyId', '');
define('signing_key', '');


//***************************STRIPE************************//
define('STRIPE_API_KEY',''); 

define('STRIPE_CURRENCY', 'HKD');

//***************************PAYPAL************************//
define("PAYPAL_CURRENCY", "HKD");
define("PAYPAL_CLIENT_ID", "");
define("PAYPAL_CLIENT_SECRET", "");



//test
define('DEBUG_VALUE', 2); //0 means no errors will display on the screen. 2 means all the errors


?>


