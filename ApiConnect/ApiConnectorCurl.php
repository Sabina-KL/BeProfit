<?php

require_once("iApiConnector.php");

/**
 * @brief this is an adaptor - connection with CURL
 * @author alter
 *
 */
class ApiConnectorCurl implements iConnectorApi
{
    /**
     * 
     * @var unknown
     */
    protected $url;
    /**
     * 
     * @var unknown
     */
    protected $user;
    /**
     * 
     * @var unknown
     */
    protected $password;
    
    public $data;
    
    /**
     * 
     * @param string $url
     * @param string $user
     * @param string $password
     */
    function __construct(string $url, string $user, string $password) {
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
    }
    
    /**
     * 
     * @return string|unknown
     */
    public function connector() {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->user:$this->password");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            return $error_msg;
        } else {
            $this->$data = $this->parser($result);
            return $this->$data;
        }
        curl_close($ch);
    }
    
    /**
     * @brief a way to parse your data
     * @param unknown $result
     * @return mixed
     */
    public function parser($result) {
        return json_decode($result, true);
    }
   
    /**
     * 
     * @return unknown
     */
    public function getData() {
        return $this->data;
    }
}