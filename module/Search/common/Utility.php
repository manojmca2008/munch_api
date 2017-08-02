<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author bravvura
 */
namespace Search\Common;
class Utility 
{
    /**
     * Check if required search params are present. If not set their default values.
     * @param array $params search parameters
     * @param string $stype Search Type = {search,auto,facet}
     * @return array
     */
    public static function cleanWebSearchParams($params)
    {
        $ret = array();
        $ret['DeBuG'] = isset($params['DeBuG']) ? $params['DeBuG'] : 0;
        $ret ['city_id'] = isset($params ['city_id']) ? (int) $params ['city_id'] : 18848;
        $ret ['city_name'] = isset($params ['city_name']) ? $params ['city_name'] : 'New York';
        $ret ['is_registered'] = isset($params ['is_registered']) ? $params ['is_registered'] : '';
        
        //open view type = {food, restaurant}
        $ret ['sst'] = isset($params ['sst']) ? $params ['sst'] : 'all';
        // vt = {restaurant, food, suggest} (not in use)
        $ret['ovt'] = isset($params['ovt']) ? $params['ovt'] : 'restaurant';
        
        /*
        $dayDateTime = DateTimeUtils::getCityDayDateAndTime24F($ret['city_id']);
        $ret['curr_time'] = $dayDateTime ['time'];
        $ret['curr_date'] = $dayDateTime ['date'];
        //pr($params);
        if(!isset($params['sdate']) || $params['sdate'] == '' ) {
            $ret ['sdate'] =  $dayDateTime ['date'];
        }else{ 
            $ret ['sdate'] =  $params['sdate']; 
        }

        if( !isset($params['stime']) || $params['stime'] == ''){
            $ret ['stime'] = self::getSearchTime($ret ['sst'], $ret['curr_time']);
        }else {
            $ret ['stime'] = intval(str_replace(':', '',$params['stime']));
        }
         */
        
        /*
        if(!isset($params['sdate']) || !isset($params['stime']) || $params['sdate'] == '' || $params['stime'] == ''){
            $ret ['stime'] = self::getSearchTime($ret ['sst'], $ret['curr_time']);
            $ret ['sdate'] =  $dayDateTime ['date'];
        } else {
            $ret ['stime'] = intval(str_replace(':', '',$params['stime']));
            $ret ['sdate'] =  $params['sdate'];
        }
        $ret ['day'] =  substr(strtolower(date('D', strtotime($ret['sdate']))), 0, 2);
        */
        // reservation_request_type = rrt = {breakfast,lunch,dinner}
        $ret ['rrt'] = isset($params ['rrt']) ? $params ['rrt'] : 'breakfast';
        
        // sq=search_query, sdt=search_datatype
        $ret ['sq'] = isset($params ['sq']) ? $params ['sq'] : '';
        // data_type: dt contains {cui,fav,pref,top,feat,amb} delimited by ||
        $ret ['sdt'] = isset($params ['sdt']) ? $params ['sdt'] : '';
        
        // sq=search_query, sdt=search_datatype
        $ret ['fq'] = isset($params ['fq']) ? $params ['fq'] : '';
        // data_type: dt contains {cui,fav,pref,top,feat,amb} delimited by ||
        $ret ['fdt'] = isset($params ['fdt']) ? $params ['fdt'] : '';

        // at = { address','street','nbd','zip','city'}, av=address value
        $ret ['at'] = isset($params ['at']) ? $params ['at'] : 'city';
        $ret ['av'] = isset($params ['av']) ? $params ['av'] : '';
        if($ret ['at'] == 'zip'){
            preg_match("/\d+/", $ret['av'], $zipcodes);
            $ret['av'] = isset($zipcodes[0]) ? $zipcodes[0] : '';
        } elseif($ret ['at'] == 'nbd'){
            preg_match("/[^,]+/", $ret['av'], $nbds);
            $ret['av'] = isset($nbds[0]) ? $nbds[0] : '';
        }
        //if 'av' is empty fallback to city
        if($ret['av'] == ''){
            $ret['at'] = 'city';
        }
        
        // latitude and longitude of the address
        $ret ['lat'] = isset($params ['lat']) ? $params ['lat'] : 0;
        $ret ['lng'] = isset($params ['lng']) ? $params ['lng'] : 0;
        
        // price = {0,1,2,3,4}
        $ret ['price'] = isset($params ['price']) ? (int) $params ['price'] : 0;
        //deals part of solr fq parameter
        $ret ['deals'] = 0;//isset($params ['deals']) ? (int) $params ['deals'] : 0;
        
        //sorting
        $ret ['sort_by'] = isset($params ['sort_by']) ? $params ['sort_by'] : 'relevancy';
        $ret ['sort_type'] = isset($params ['sort_type']) ? $params ['sort_type'] : 'asc';
                    
        // start and rows
        $ret ['start'] = isset($params ['start']) ? $params ['start'] : 0;
        $ret ['rows'] = isset($params ['rows']) ? $params ['rows'] : 12;
        $ret ['page'] = isset($params ['page']) ? $params ['page'] : 0;
        
        $ret ['aor'] = isset($params ['aor']) && ($params['aor'] == '1') ? 1 : 0;
        $ret ['acp'] = isset($params ['acp']) && ($params['acp'] == '1') ? 1 : 0;

        //params required for autosuggestion only
        $ret ['term'] = isset($params ['term']) ? rawurlencode(strtolower(trim($params ['term']))) : '';
        $ret ['limit'] = isset($params ['limit']) ? $params ['limit'] : 5;
        $ret ['sec'] = isset($params ['sec']) ? $params ['sec'] : '';  //this is to identify autosuggest from checkin
        return $ret;
    }
}
