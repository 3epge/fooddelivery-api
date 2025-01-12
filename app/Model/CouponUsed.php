<?php


class CouponUsed extends AppModel
{

    public $useTable = 'coupon_used';

    public function countCouponUsed($coupon_id)
    {
        return $this->find('count', array(
            'conditions' => array(
                'CouponUsed.coupon_id' => $coupon_id,
            )
        ));
    }
    
    public function checkIfUsedBefore($coupon_id, $user_id){
        return $this->find('all', array(
            'conditions' => array(
                'CouponUsed.coupon_id' => $coupon_id,
                'CouponUsed.user_id' => $user_id
            )
        ));
    }

}
?>