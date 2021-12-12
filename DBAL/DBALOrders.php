<?php
require_once ("DBALConnector.php");
require_once("AbstractDBALQueryBuilder.php");
require_once ("Types/OrderTypes.php");
use Doctrine\DBAL;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @brief data layer files, this file will hold all DB calls related to this process
 * todo: split this into more files - DBALAddresses, DBALStatuses, DBALShopInfo, DBALPrices
 * @author alter
 *
 */
class DBALOrders extends AbstractDBALModelConnector {
    /**
     * 
     */
    function __construct() {
        parent::__construct(DBALConnector::getInstance());
    }
    
    /**
     * @brief bring an array of statuses that are kept seperatly in the DB and update from it
     * @return array
     */
    function getStatusesList() {
        $fields = [
            OrderTypes::ID,
            OrderTypes::FINANCES_STATUS_NAME,
        ];
        try {
           return $this->_getConnector()
            ->createQueryBuilder()
            ->select($fields)
            ->from(OrderTypes::TABLE_ORDER_FINANCIAL_STATUSES)
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (DBALException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * @brief a generic insert
     * @param unknown $table_name
     * @param array $placeholders
     * @param array $order_data
     * @return unknown|array
     */
    function _loopThroughInsertTable($table_name, array $placeholders, array $order_data) {
        try {
            return $this->_getQueryBuilder()
            ->insert($table_name)
            ->values($placeholders)
            ->setParameters($order_data)
            ->execute();
        } catch (DBALException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * @brief get last inserted id - to be used for updating the links between all 5 tables in the final "orders" table insert
     * @return unknown
     */
    function getLastInsertedId() {
        return $this->_getConnector()->lastInsertId();
    }
    
}