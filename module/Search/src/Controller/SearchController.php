<?php

namespace Search\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\EventManager\EventManagerInterface;
use MCommons\StaticOptions;


class SearchController extends AbstractRestfulController {

    public function __construct() {
        
    }

    public function getList() { //echo "dsads";die;
        //echo '<pre>'; print_r($this->getRequest()->getQuery()->toArray()); die;
        $rawInput   = $this->getRequest()->getQuery()->toArray();
        
        $cleanInput = \Search\Common\Utility::cleanWebSearchParams($rawInput);
        
        echo '<pre>'; print_r($cleanInput);die;   
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
