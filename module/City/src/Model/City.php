<?php

namespace City\Model;

use DomainException;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class City
{
    public $id;
    public $state_id;
    public $country_id;
    public $city_name;
    public $neighbouring;
    public $locality;
    public $state_code;
    public $latitude;
    public $longitude;
    public $sales_tax;
    public $status;
    public $time_zone;
    public $city_name_alias;
    public $is_browse_only;
    public $seo;
    
    

    public function exchangeArray(array $data)
    {
        $this->id         = (!empty($data['id'])) ? $data['id'] : null;
        $this->city_name  = (!empty($data['city_name'])) ? $data['city_name'] : null;
    }
}
