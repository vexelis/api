<?php

require '../php-vexel-api.php';

// Constructor without data (registered in the class)

// $api = new Vexel\API();
// $result = $api->accountGetList();
// print_r($result) . "\n";


// Constructor with data for connecting to the API

// $api_key = 'wwwwwwwwwwwwwwwww';
// $api_secret = 'eeeeeeeeeeeeeeeeeeeee';

// $api = new Vexel\API($api_key, $api_secret);
// $result = $api->accountGetList();
// var_dump($result);


// Constructor with token

$token = 'qqqqqqqqqqqqqqqqqqq';

$api = new Vexel\API($token);
$result = $api->accountGetList();
var_dump($result);