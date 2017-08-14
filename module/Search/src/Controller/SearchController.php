<?php

namespace Search\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\EventManager\EventManagerInterface;

//use Search\Solr\Synonyms;



class SearchController extends AbstractRestfulController {

    private $objSynonym ;
    /*public function __construct(Synonyms $syn) {
        $this->objSynonym = $syn;
    }*/

    public function __construct() {
        
    }
    public function getList() {  
        
        $sL      =  $this->getEvent()->getApplication()->getServiceManager();
        /*
        $tblCity =  $sL->get(\City\Model\CityTable::class);
        
        $cities  =  $tblCity->fetchAll();
        
        echo '<pre>';
        foreach($cities as $city )
        {
            echo '<pre>';
            print_r($city);
            echo "---";
        }
        */
        
        $synonym = $sL->get(\Search\Solr\Synonyms::class);
        
        $s = $synonym->applySynonyFilter("b.b.q.");
        print_r($s);
        
        die;
        /*
        $x = $this->objSynonym->applySynonyFilter("b.b.q.");
        $name    = Synonyms::class;
        $service = new Synonyms();
        */
        
        
        /*$ss = $sm->get('router');
        pr($ss,1);*/
        
        
        /*
        $objUtil = new \Search\Common\Utility();
        $objUtil->getTest($sm);
        */
        
        $appConfig =  $this->getConfig('ApplicationConfig');
        
        $appConfig2 =  $this->getConfig('Config');
        
        pr($appConfig);
        echo '<br>----------------------------------';
        pr($appConfig2,1);
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
