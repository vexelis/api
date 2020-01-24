<?php

require '../php-vexel-api.php';

$token = 'token';
$invoice = 'invoiceid';


// Get invoice status

// $api = new Vexel\API($token);
// $result = $api->getStatusInvoice($invoice);


// Get invoice info

// $api = new Vexel\API($token);
// $result = $api->getInvoice($invoice);


// Get invoice list

$api = new Vexel\API($token);
$result = $api->getListInvoices();

var_dump($result);