<?php

include('../classes/invent.php');

ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer("invent.wsdl");

$server->setClass("Invent");

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
$server->handle();
}
else
{
  $wsdl = @implode('', @file('invent.wsdl'));
  if (strlen($wsdl) > 1)
  {
    header("Content-Type: text/xml");
    echo $wsdl;
  }
}

?>
