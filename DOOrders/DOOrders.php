<?php
// require_once 'DBAL/DBALConnector.php';
require_once("DBAL/AbstractDBALQueryBuilder.php");
require_once ("DBAL/DBALOrders.php");
require_once ("Types/OrderTypes.php");
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @brief this is the Orders DO class, this will run the business logic
 * todo: add restrictions and unique values to DB
 * todo: enable safe transaction of the insert
 * todo: clear tables before new integration run
 * todo: create draw line from statuses and insert based on the status data recieved via API
 * @author alter
 *
 */
class DOOrders {
    public $dbal_orders;
    public $statuses = array();
    public $last_inserted_id_list = array(
//         'shop_ID',
//         'order_address_ID',
//         'Prices_ID'
    );
    
    /**
     * 
     */
    function __construct() {}
    
    /**
     * 
     */
    function buidStatusesList () {
        $this->statuses = (new DBALOrders())->getStatusesList();
    }
    
    /**
     * 
     */
    function loadDBALOrders() {
        if (!(bool)$this->dbal_orders) {
            $this->dbal_orders =  new DBALOrders();
        }
    }
    
    /**
     * 
     * @param unknown $order_data
     * @return boolean
     */
    function insertOrderLines($order_data) {
        $this->loadDBALOrders();
        
        //todo: enable transaction
        try {
               foreach ($order_data['data'] as $key => $row) {
                       
//                    //INSERT ADDRESS
                      $this->dbal_orders->_loopThroughInsertTable(OrderTypes::TABLE_ADDRESSES, 
                            [
                                OrderTypes::COUNTRY  => ":".OrderTypes::COUNTRY,
                                OrderTypes::PROVINCE => ":".OrderTypes::PROVINCE
                            ],[
                                OrderTypes::COUNTRY  => $row[OrderTypes::COUNTRY], 
                                OrderTypes::PROVINCE => $row[OrderTypes::PROVINCE]
                            ]
                      );
                       $last_inserted_id_list['order_address_ID'] = $this->dbal_orders->getLastInsertedId();
                       
                      //INSERT SHOP INFO
                      $this->dbal_orders->_loopThroughInsertTable(OrderTypes::TABLE_SHOP_INFO, 
                           [
                                OrderTypes::SHOP_ID   => ":".OrderTypes::SHOP_ID,
                                OrderTypes::SHOP_NAME => ":".OrderTypes::SHOP_NAME
                           ],[
                                OrderTypes::SHOP_ID   => $row[OrderTypes::SHOP_ID],
                                OrderTypes::SHOP_NAME => $row[OrderTypes::SHOP_NAME]
                           ]
                      );
                      $last_inserted_id_list['shop_ID'] = $this->dbal_orders->getLastInsertedId();
                       
                      //INSERT PRICES
                      $this->dbal_orders->_loopThroughInsertTable(OrderTypes::TABLE_ORDER_PRICES, 
                           [
                                OrderTypes::TOTAL_PRICE               => ":".OrderTypes::TOTAL_PRICE,
                                OrderTypes::SUBTOTAL_PRICE            => ":".OrderTypes::SUBTOTAL_PRICE,
                                OrderTypes::TOTAL_PRODUCTION_COST     => ":".OrderTypes::TOTAL_PRODUCTION_COST,
                                OrderTypes::TOTAL_ORDER_SHIPPING_COST => ":".OrderTypes::TOTAL_ORDER_SHIPPING_COST,
                                OrderTypes::TOTAL_ORDER_HANDLING_COST => ":".OrderTypes::TOTAL_ORDER_HANDLING_COST,
                                OrderTypes::TOTAL_DISCOUNTS           => ":".OrderTypes::TOTAL_DISCOUNTS
                           ],[
                                OrderTypes::TOTAL_PRICE               =>  $row[OrderTypes::TOTAL_PRICE],
                                OrderTypes::SUBTOTAL_PRICE            =>  $row[OrderTypes::SUBTOTAL_PRICE],
                                OrderTypes::TOTAL_PRODUCTION_COST     =>  $row[OrderTypes::TOTAL_PRODUCTION_COST],
                                OrderTypes::TOTAL_ORDER_SHIPPING_COST =>  $row[OrderTypes::TOTAL_ORDER_SHIPPING_COST],
                                OrderTypes::TOTAL_ORDER_HANDLING_COST =>  $row[OrderTypes::TOTAL_ORDER_HANDLING_COST],
                                OrderTypes::TOTAL_DISCOUNTS           =>  $row[OrderTypes::TOTAL_DISCOUNTS]
                           ]
                       );
                       $last_inserted_id_list['Prices_ID'] = $this->dbal_orders->getLastInsertedId();
                        
                       //INSERT ORDER DETAILS
                       $this->dbal_orders->_loopThroughInsertTable(OrderTypes::TABLE_ORDERS,
                            [
                                OrderTypes::ORDER_ID            => ":".OrderTypes::ORDER_ID,
                                OrderTypes::SHOP_ID             => ":".OrderTypes::SHOP_ID,
                                OrderTypes::PRICES_ID           => ":".OrderTypes::PRICES_ID,
                                OrderTypes::FINANCIAL_STATUS_ID => ":".OrderTypes::FINANCIAL_STATUS_ID,
                                OrderTypes::ORDER_ADDRESS_ID    => ":".OrderTypes::ORDER_ADDRESS_ID,
                                OrderTypes::CLOSED_AT           => ":".OrderTypes::CLOSED_AT,
                                OrderTypes::CREATED_AT          => ":".OrderTypes::CREATED_AT,
                                OrderTypes::FULFILMENT_STATUS   => ":".OrderTypes::FULFILMENT_STATUS,
                                OrderTypes::TOTAL_ITEMS         => ":".OrderTypes::TOTAL_ITEMS
                            ], [
                                OrderTypes::ORDER_ID            => $row[OrderTypes::ORDER_ID],
                                OrderTypes::SHOP_ID             => $last_inserted_id_list['shop_ID'],
                                OrderTypes::PRICES_ID           => $last_inserted_id_list['Prices_ID'],
                                OrderTypes::FINANCIAL_STATUS_ID => 1,
                                OrderTypes::ORDER_ADDRESS_ID    => $last_inserted_id_list['order_address_ID'],
                                OrderTypes::CLOSED_AT           => $row[OrderTypes::CLOSED_AT],
                                OrderTypes::CREATED_AT          => $row[OrderTypes::CREATED_AT],
                                OrderTypes::FULFILMENT_STATUS   => $row[OrderTypes::FULFILMENT_STATUS],
                                OrderTypes::TOTAL_ITEMS         => $row[OrderTypes::TOTAL_ITEMS],
                      ]);
                          
               };
                return true;
        } catch (DBALException $e) {
            return false;
        }
    }
}