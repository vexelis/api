<?php

require '../php-vexel-api.php';

$token = 'token';
$url = 'http://test.test/webhook/'


$api = new Vexel\API($token);
$result = $api->createWebHook($url);
var_dump($result);