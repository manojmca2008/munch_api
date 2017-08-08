<?php

namespace RestFunctions;
use Zend\EventManager\EventManagerInterface;


class StaticFunctions {
       
    public static function test() {
        echo "i m here";die;
        
    }
    
    public static function getSolrUrl()
    {
        return "http://localhost:8984/solr/";
        /*
         * this is temporary implementation. Will be implemented according to standard.
         */
    }
}
