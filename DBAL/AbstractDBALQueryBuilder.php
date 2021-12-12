<?php
require_once ("DBALConnector.php");
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\{QueryBuilder,Expression\ExpressionBuilder};

/**
 * @brief this is an abstract class from where all componenet and module related DBAL data layer
 * files will be inheriting from.
 * the constructor already creates the the DBAL connector instance
 * @author alter
 *
 */
abstract class AbstractDBALModelConnector {
    
    /** @var Connection */
    private $_connector;
    
    /** @var QueryBuilder */
    private $_qb;
    
    /**
     * @brief use up 'DBALConnector' to establish a connection -> entity manager
     * @param Connection $connector
     * @param unknown ...$args
     */
    function __construct(Connection $connector) {
        $this->_connector = $connector;
        $this->_qb = $this->_connector->createQueryBuilder();
    }
    
    /**
     * 
     * @return Connection
     */
    protected function _getConnector() {
        return $this->_connector;
    }
    
    /**
     * 
     * @return QueryBuilder
     */
    protected function _getQueryBuilder() {
        return $this->_qb;
    }
}