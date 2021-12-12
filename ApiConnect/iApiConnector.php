<?php
/**
 * 
 * @author alter
 *
 */
interface iConnectorApi
{
    /**
     * 
     */
    public function connector();
    
    /**
     * 
     * @param unknown $result
     */
    public function parser($result);
}