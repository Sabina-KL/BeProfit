<?php
require_once "vendor/autoload.php";
require_once("DBALEntityManager.php");
require_once("ApiConnect/ApiConnectorCurl.php");
require_once 'DOOrders/DOOrders.php';

use DBALEntityManager;

/**
 * @brief this is the script that runs the API integration and updated the data in the DB
 * todo: API connection details should be moved to a config file
 */
try {
    $order_data = (new ApiConnectorCurl("https://www.become.co/api/rest/test/", "tzinch", "r#eD21mA%gNU"))->connector();
    (new DOOrders())->insertOrderLines($order_data);
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}