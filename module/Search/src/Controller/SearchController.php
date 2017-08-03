<?php

namespace Search\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\EventManager\EventManagerInterface;
use MCommons\StaticOptions;


class SearchController extends AbstractRestfulController {

    public function __construct() {
        
    }

    public function getList() { 
        //echo '<pre>'; print_r($this->getRequest()->getQuery()->toArray()); die;
        $rawInput   = $this->getRequest()->getQuery()->toArray();
        
        $cleanInput = \Search\Common\Utility::cleanWebSearchParams($rawInput);
        
        echo '<pre>'; print_r($cleanInput);die;   
        $debug = $cleanInput['DeBuG'] ;
        if($debug == '404'){
            $this->debug = true;
            $this->starttime_milli = microtime(true);
        }
        
        $reqtype = $cleanInput['rt'] ;
        $response = array();
        if($reqtype == 'seo'){
            $response = $this->getSeoResponse();
            $response['image_base_path'] = IMAGE_PATH;
        } else {
            $response = $this->search_by_req_type($reqtype);
        }
        
        if ($this->debug) {
            $response['time_in_millis'] = microtime(true) - $this->starttime_milli;
            $response['original_request_params'] = $this->getRequest()->getQuery()->toArray();
        }
        return $response;
        
        
        
        if (!empty($data)) {
            return new JsonModel($data);
        }
    }

    public function get($id) {
        
    }

    public function create($data) {
        
    }

    public function update($id, $data) {
        
    }

    public function delete($id) {
        
    }

    public function setEventManager(EventManagerInterface $events) {
        parent::setEventManager($events);
        $events->attach('dispatch', array($this, 'getConfig'), 10);
    }

    public function getConfig() {
        $event = $this->getEvent();
        $config = $event->getApplication()->getServiceManager()->get('config');
        return $config;
    }

}
