<?php

$client = new SoapClient(NULL,  
        array(  
        "location" => "http://127.0.0.1:9000",  
        "uri"      => "urn:SASSoap",  
        "style"    => SOAP_RPC,  
        "use"      => SOAP_ENCODED  
           ));

$client->GetNotices();
$client->Install('mc');
$client->Execute('ls /');

?>
