<?php

require '../php-vexel-api.php';

$token = 'token';

// Get account information

$api = new Vexel\API($token);
$result = $api->accountGetOne('USD');


// Get information about all accounts

// $api = new Vexel\API($token);
// $result = $api->accountGetList();


// Create account

// $api = new Vexel\API($token);
// $result = $api->accountCreate('LTC');


// Replenish account

// $api = new Vexel\API($token);
// $result = $api->accountReplenish('123456789');


// Withdraw to new vexel

// $api = new Vexel\API($token);
// $result = $api->accountWithdraw(
//     'RUB',
//     '10',
//     'vexel',
//     'new'
// );


// Withdraw to cryptocurrency wallet

// $api = new Vexel\API($token);
// $result = $api->accountWithdraw(
//     'LTC',
//     '0.003',
//     'ltc',
//     'dsfgsfdgsfdgsfdgsdfg'
// );


// Withdraw to Card RU

// $api = new Vexel\API($token);
// $other = [
//     'card_way' => 'card_ru',
// ];
// $result = $api->accountWithdraw(
//     'RUB',
//     '10',
//     'card',
//     '7897987498191',
//     'card_ru',
//     '',
//     '',
//     '',
//     $other
// );


// Withdraw to Card WW USD

// $api = new Vexel\API($token);
// $other = [
//     'card_way' => 'card_world_usd',
//     'wc-date'  => '12.2020',
//     'wc-bday'  => '12.12.2020',
//     'wc-name'  => 'Name',
//     'wc-surname' => 'Surname',
//     'wc-address' => 'Street str., 54-115',
//     'wc-country' => 'RU',
//     'wc-city'  => 'City'
// ];
// $result = $api->accountWithdraw(
//     'USD',
//     '6',
//     'card',
//     '7897987498191',
//     'card_world_usd',
//     '',
//     '',
//     '',
//     $other
// );

var_dump($result);