<?php
require_once("DBALEntityManager.php");

/**
 * @brief this is a DBAL connection class - this creates the connection instance to every query that you want to run 
 * (select, insert, update, delete etc)
 * @author alter
 *
 */
class DBALConnector {
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private static $_dbal;

    /**
     * @return \Doctrine\DBAL\Connection
     */
    static function getInstance() {
        if (!(bool)self::$_dbal) {
            self::$_dbal =  (new DBALEntityManager())->getEntityManager()->getConnection();
        }
        return self::$_dbal;
    }

    /**
     * 
     */
    private function __construct() {}
}
