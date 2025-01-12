<?php


class District extends AppModel
{

    public $useTable = 'districts';

    public function getDistrictList()
    {
        return $this->find('all');
    }
    
    public function getDistrict($lat, $lng) {
        $res = array();
        $districts = $this->find('all', array(
                'order' => array('District.id' => 'DESC')   
            ));
        foreach ( $districts as $key => $val ){
            $distance = $this->calculateDistance(doubleval($lat), doubleval($lng), doubleval($val['District']['lat']), doubleval($val['District']['lng']));
            if ( $distance <= doubleval($val['District']['radius']) ) {
                array_push($res, $val);
            }
        }
        return $res;
    }
    
    function calculateDistance($lat1, $lng1, $lat2, $lng2) {
        if(($lat1 == $lat2) && ($lng1 == $lng2)) {
            return 0;
        } else {
            $theta = $lng1 - $lng2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            return $miles * 1609.344;
        }
    }
}
?>