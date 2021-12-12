<?php
require_once "vendor/autoload.php";
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * @brief this is the entity manager configuration file - to bootstrao Docntrine / DBAL package
 * @author alter
 *
 */
class DBALEntityManager {
    /**
     * 
     */
    function __construct() {}
    
    /**
     * 
     * @var unknown
     */
    private $_entityManager;
    
    /**
     * 
     * @return unknown
     */
    public function getEntityManager() {
        if ( !$this->_entityManager ) {
            $this->_entityManager = $this->_createEntityManager();
        }
        
        return $this->_entityManager;
    }

    /**
     * todo: move DB data to a seperate config file
     * @return unknown
     */
    private function _createEntityManager() {
        $dbParams = array(
            'driver'        => 'pdo_mysql',
            'user'          => 'root',
            'password' => '',
            'dbname'        => 'test'
        );
        $paths = array("/path/to/entity-files");
        $isDevMode = false;
        
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);
        return $entityManager;
    }
}