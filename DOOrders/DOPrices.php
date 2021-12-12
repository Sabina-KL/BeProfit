<?php
require_once("DBAL/AbstractDBALQueryBuilder.php");
require_once ("DBAL/DBALPrices.php");
require_once ("Types/OrderTypes.php");
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * 
 * @author alter
 *
 */
class DOPrices {
    /**
     * 
     * @var unknown
     */
    public $pricesObj;
    /**
     * 
     * @var unknown
     */
    protected $netSales;
    /**
     * 
     * @var unknown
     */
    protected $productionCosts;
    
    /**
     * 
     */
    function __construct() {
        $this->pricesObj = new DBALPrices();
    }
    
    /**
     * 
     */
    function calcData() {
        echo "Net Sales: " .$this->getNetSales(). PHP_EOL;
        echo "Production costs: " .$this->ProductionCosts().PHP_EOL;
        echo "Gross Profit: " .$this->GrossProfit(). PHP_EOL ;
        echo " Gross margin: " .$this->GrossMargin(). PHP_EOL ;
    }
    
    /**
     * 
     * @return unknown
     */
    protected function getNetSales() {
        $data = $this->pricesObj->getPricesListWhereStatusPaid();
        $this->netSales = array_sum(array_map(function($item) {
            return $item[OrderTypes::TOTAL_PRICE];
        }, $data));
        
         return $this->netSales;
    }
    
    /**
     * 
     * @return string
     */
    protected function ProductionCosts() {
        $data = $this->pricesObj->getProductionCosts();
        $this->productionCosts = array_sum(array_map(function($item) {
            return $item[OrderTypes::TOTAL_PRODUCTION_COST];
        }, $data));
        
        return $this->productionCosts. PHP_EOL;
    }
    
    /**
     * 
     * @return number
     */
    protected function GrossProfit() {
        return ($this->netSales -= $this->productionCosts);
    }
    
    /**
     * 
     * @return number
     */
    protected function GrossMargin() {
        return ($this->GrossProfit() * 100) / $this->netSales;
    }
}
