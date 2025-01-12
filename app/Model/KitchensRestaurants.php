<?php


    class KitchensRestaurants extends AppModel {

        public $useTable = 'kitchens_restaurants';
        
        public $belongsTo = array(

            'Restaurant' => array(
                'className' => 'Restaurant',
                'foreignKey' => 'restaurant',
            ),
            
        );
        
        var $contain = array('Restaurant');

        public function getRestaurants($kitchen_id)
        {
            $this->Behaviors->attach('Containable');
            return $this->find('all', array(
                'conditions' => array(
                    'Restaurant.block'=>0,
                    'KitchensRestaurants.kitchen' => $kitchen_id,
                ),
                'contain'=>$this->contain,
                'fields'    => array(
                    'Restaurant.*'
                ),
                'order' => 'KitchensRestaurants.id ASC',
            ));
        }
        
        public function getRestaurantIDs($kitchen_id)
        {
            return $this->find('all', array(
                'conditions' => array(
                    'Restaurant.block'=>0,
                    'KitchensRestaurants.kitchen' => $kitchen_id,
                ),
                'fields'    => array(
                    'KitchensRestaurants.restaurant'
                ),
            ));
        }
        
        public function getPickUpRestaurants(){
            $this->Behaviors->attach('Containable');
            return $this->find('all', array(
                'conditions' => array(
                    'Restaurant.block'=>0,
                    'Restaurant.notes'=>array('real', 'partner', '')
                ),
                'contain'=>$this->contain,
                'fields'=>array('Restaurant.*'),
                'order' => 'Restaurant.id ASC'
            ));
        }
        
        public function getAllRestaurants(){
            $this->Behaviors->attach('Containable');
            return $this->find('all', array(
                'conditions' => array(
                    'Restaurant.block'=>0
                ),
                'contain'=>$this->contain,
                'fields'=>array('Restaurant.*'),
                'order' => 'Restaurant.rank ASC'
            ));
        }
        
        public function getRegularRestaurants($kitchen_id)
        {
            $this->Behaviors->attach('Containable');
            return $this->find('all', array(
                'conditions' => array(
                    'KitchensRestaurants.kitchen' => $kitchen_id,
                    'Restaurant.block'=>0,
                    'Restaurant.promoted'=>0
                ),
                //'contain'=>array(),
                'fields'    => array(
                    'Restaurant.*'
                ),
                'order' => 'KitchensRestaurants.id ASC',
    
            ));
        }
        
        public function getFeaturedRestaurants($kitchen_id)
        {
            $this->Behaviors->attach('Containable');
            return $this->find('all', array(
                'conditions' => array(
                    'KitchensRestaurants.kitchen' => $kitchen_id,
                    'Restaurant.block'=>0,
                    'Restaurant.promoted'=>1
                ),
                'contain'=>$this->contain,
                'fields'    => array(
                    'Restaurant.*'
                ),
                'order' => 'KitchensRestaurants.id ASC',
    
            ));
        }
        
        public function getRestaurantsForUsers($kitchen_id, $user_id=null)
        {
            $this->Behaviors->attach('Containable');
            
            return $this->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'restaurant_favourite',
                        'alias' => 'RestaurantFavourite',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Restaurant.id = RestaurantFavourite.restaurant_id',
                            'RestaurantFavourite.user_id' => $user_id,
                        )
                    )
                ),
                'conditions' => array(
                    'Restaurant.block'=>0,
                    'Restaurant.promoted <'=>1,
                    'Restaurant.user_id >'=>0
                ),
                'fields' => array(
                    'Restaurant.*',
                    'RestaurantFavourite.*'
                ),
                
            ));
        }

    }

?>