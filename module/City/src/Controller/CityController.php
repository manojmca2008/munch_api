<?php

namespace City\Controller;

use City\Model\City;
use City\Model\CityTable;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
class CityController extends AbstractRestfulController 
{
    private $table;

    public function __construct(CityTable $table)
    {
        $this->table = $table;
    }

    public function getList()
    {
        $cities =   $this->table->fetchAll();
        foreach ($cities as $city)
        {
            pr($city);
        }
        die;
        return new JsonModel($cities);
    }
    
    public function get($id)
    {
        $city =   $this->table->getCity($id);
        pr($city);
        die;
        return new JsonModel($cities);
    }
}
