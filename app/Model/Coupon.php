<?php

    class Coupon extends AppModel {
        
        public $useTable = 'coupon';
        
        public function getCoupon($code, $restaurant, $platform, $datetime)
        {
            return $this->find('first', array(
                'conditions' => array(
                    'Coupon.code' => $code,
                    'Coupon.restaurant_id' => array(0, $restaurant),
                    'Coupon.platform' => array(0, $platform),
                    'Coupon.start_date <=' => $datetime,
                    'Coupon.end_date >' => $datetime 
                ),
            ));
        }
        
        public function getWebCoupon($datetime)
        {
            return $this->find('first', array(
                'conditions' => array(
                    'Coupon.platform' => '1',
                    'Coupon.start_date <=' => $datetime,
                    'Coupon.end_date >' => $datetime 
                ),
            ));
        }
        
    }
    
?>