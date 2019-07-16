<?php

class LydiaApi
{
    protected $KP;

    /**
     * constructor
     * @param $_root API service URL (give in $roots array)
     * @param $_kp Your secret key
     */
    public function __construct(
            $_root = LYDIA_API,
            $_kp = LYDIA_PRIVATE)                  // Secret key
    {
        // INIT vars
        $this->KP = $_kp;
        $this->ROOT = $_root;
    }
    /**
     * Call the api 
     * @param $_method GET POST DELETE or UPDATE
     * @param $_url The call url wanted
     * @param $_body Parameters
     */
    public function call($_method, $_url, $_body = "")
    {
        

        $myUrl = $this->ROOT . $_url;
        
        // Call
        $curl = curl_init($myUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $_method);
        

        if($_body)
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $_body);
        }

        $result = curl_exec($curl);
        if($result === FALSE)
        {
            echo curl_error($curl);
            return NULL;
        }
        return simplexml_load_string($result);
    }

    public function post($url, $body)
    {
        return $this->call("POST", $url, $body);
    }

}
?>