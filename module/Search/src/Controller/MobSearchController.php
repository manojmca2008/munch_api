<?php
/**
 * Description of MobileSearch
 *
 * @author bravvura
 */
namespace Search\Controller;

use Zend\View\Model\JsonModel;
use Zend\EventManager\EventManagerInterface;
use Search\Common\Utility;
use Zend\Http\Request;
use RestFunctions\Controller\AbstractRestfulController;
use Search\Solr\MainSearchMobile;


class MobSearchController extends AbstractRestfulController {
    private $debug      =   false;
    const FOOD          =   'food';
    const SEO_PAGE_SIZE =   100;  
    const RESTAURANT    =   'restaurant';
    
    public function __construct() {
        
    }

    public function getList() { 
        
        $rawInput   = $this->getRequest()->getQuery()->toArray();
        
        $cleanInput = Utility::cleanMobileSearchParams($rawInput);
        
        $debug  =   $cleanInput['DeBuG'] ;
        if($debug == '404')
        {
            $this->debug            = true;
            $this->starttime_milli  = microtime(true);
        }
        
        if (empty($cleanInput['reqtype'])) 
        {
            throw new \Exception("Parameter reqtype is invalid or missing.", 400);
        }
        
        $response   =   $this->searchByRequestType($cleanInput);
        
        if ($this->debug) {
            $response['time_in_millis']         =  microtime(true) - $this->starttime_milli;
            $response['original_request_params']=  $this->getRequest()->getQuery()->toArray();
        }
        
        if (!empty($response)) {
            return new JsonModel($response);
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

    /*public function setEventManager(EventManagerInterface $events) {
        parent::setEventManager($events);
        $events->attach('dispatch', array($this, 'getConfig'), 10);
    }*/

    public function getConfig() {
        $event = $this->getEvent();
        $config = $event->getApplication()->getServiceManager()->get('config');
        return $config;
    }
    
    private function searchByRequestType($clearInput) {
        //$session    =   $this->getUserSession();
        //$user_loc   =   $session->getUserDetail('selected_location', array());
        //$rawInput['city_id']    = isset($user_loc['city_id']) ? intval($user_loc ['city_id']) : 18848;
        //$rawInput['city_name']  = isset($user_loc['city_name']) ? $user_loc['city_name'] : 'New York';
        
        $response = array();
        switch ($clearInput['reqtype']) {
            case 'search' :
                $response = $this->getMainSearchData($clearInput);
                if (isset($input['q']) && $input['q'] != '') 
                {
                    //$log    = new \Search\Model\LogSearch();
                    //$saved  = $log->saveSearchLogMob($input);
                }
                break;
            default :
                throw new \Exception("Invalid Request", 400);
        }
        return $response;
    }
    
    private function getMainSearchData($clearInput) 
    {
        $search     =   new MainSearchMobile();
        
        $response   =   $search->returnMobileSearchData($clearInput);
        
        $objUtility    =   new Utility ();
        
        if ($clearInput ['view_type'] == self::RESTAURANT) 
        {
            $objUtility->updateRestaurantDataMobile($response, $clearInput);
        } 
        elseif($clearInput ['view_type'] == self::FOOD) 
        {
            $objUtility->updateFoodDataMobile($response, $clearInput);
        }
        
        $response ['image_base_path']   = IMAGE_PATH;
        //$city = new \Home\Model\City();
        //$response ['curr_time'] = $city->getCityCurrentDateTime($input['city_id']);
        //$response ['search_time'] = !empty($input['stime'])?$input['stime']:$response ['curr_time'];
        
        return $response;
    }
}
