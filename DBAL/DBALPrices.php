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
class DBALPrices extends AbstractDBALModelConnector {
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
    function getPricesList() {
        $fields = [
            OrderTypes::TOTAL_PRICE,
            OrderTypes::SUBTOTAL_PRICE,
            OrderTypes::TOTAL_PRODUCTION_COST,
            OrderTypes::TOTAL_ORDER_SHIPPING_COST,
            OrderTypes::TOTAL_ORDER_HANDLING_COST,
            OrderTypes::TOTAL_DISCOUNTS,
        ];
        try {
           return $this->_getConnector()
            ->createQueryBuilder()
            ->select($fields)
            ->from(OrderTypes::TABLE_ORDER_PRICES)
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (DBALException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * todo: add status parameter to decide upon where status is =
     * todo: refactor function - create parameterized fields to select
     * @return array
     */
    function getPricesListWhereStatusPaid() {
        try {
            return $this->_getConnector()
            ->createQueryBuilder()
            ->select(OrderTypes::TOTAL_PRICE)
            ->from(OrderTypes::TABLE_ORDER_PRICES, 'pri')
            ->leftJoin('pri', OrderTypes::TABLE_ORDERS, 'ord', $this->_getQueryBuilder()->expr()->eq('ord.Prices_ID', 'pri.id'))
            ->leftJoin('pri', OrderTypes::TABLE_ORDER_FINANCIAL_STATUSES, 'st', $this->_getQueryBuilder()->expr()->eq('ord.financial_statuses_ID', 'st.id'))
            ->where($this->_getQueryBuilder()->expr()->eq('st.name', ':name'))->setParameter('name', 'paid')
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);
//             where($qb->expr()->eq('wfl.distribution_channel', ':dcid'))->setParameter('dcid', $request)
        } catch (DBALException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     *todo: add status parameter to decide upon where status is =
     * todo: refactor function - create parameterized fields to select
     * @return array
     */
    function getProductionCosts() {
        try {
            return $this->_getConnector()
            ->createQueryBuilder()
            ->select(OrderTypes::TOTAL_PRODUCTION_COST)
            ->from(OrderTypes::TABLE_ORDER_PRICES, 'pri')
            ->leftJoin('pri', OrderTypes::TABLE_ORDERS, 'ord', $this->_getQueryBuilder()->expr()->eq('ord.Prices_ID', 'pri.id'))
            ->leftJoin('pri', OrderTypes::TABLE_ORDER_FINANCIAL_STATUSES, 'st', $this->_getQueryBuilder()->expr()->eq('ord.financial_statuses_ID', 'st.id'))
            ->where($this->_getQueryBuilder()->expr()->eq('st.name', ':name'))->setParameter('name', 'paid')
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (DBALException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}