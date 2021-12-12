<?php
require_once "vendor/autoload.php";
require_once("DBALEntityManager.php");
require_once("ApiConnect/ApiConnectorCurl.php");
require_once ("DOOrders/DOPrices.php");

try {
    $DOPrices = new DOPrices();
    $DOPrices->calcData();
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}
