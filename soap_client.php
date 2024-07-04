<?php

include_once 'includes/PDOConnection.inc.php';


$optionen = array('uri' => 'meimei',
'location' => 'http://localhost/soap_abschluss/soap_server.php');

$client = new SoapClient(null, $optionen);


var_dump($_POST);

$response = $client->getZitat(array());
$set_response = $client->setZitat(array('neuesZitat' => 'Testzitat'));
echo $response;
