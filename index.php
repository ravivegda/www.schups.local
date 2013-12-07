<?php


        
define ('ROUTED_REQUEST', true);

require_once './APIs/Business/BusinessAPI.php';

$businessAPI = BusinessAPI::getInstance();



$businessIO = new BusinessIO();
$businessIO->setInputValue('sessionToken', '0cc175b9c0f1b6a831c399e269772661');
$businessIO->sealInputs();

$businessIO = $businessAPI->getUsername($businessIO);

echo $businessIO->getOutputValue('username');

