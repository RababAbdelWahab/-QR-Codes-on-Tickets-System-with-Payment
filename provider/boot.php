<?php
require "../vendor/autoload.php";

// $urlPrefix = '/braintree/';
// require_once 'braintree_php-master/lib/Braintree.php';
//set the sandbox credentials
$gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'h52c7hh9t3zjjgr9',
    'publicKey' => 'nbwyr6mrtys6v2c7',
    'privateKey' => '33f1d5c4c9bebd6d4ff32711f943e5be'
]);

$clientToken = $gateway->clientToken()->generate();


?>