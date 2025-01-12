<?php



class RestaurantMenuItem extends AppModel
{
    public $useTable = 'restaurant_menu_item';


    /*public $belongsTo = array(
        'RestaurantMenu' => array(
            'className' => 'RestaurantMenu',
            'foreignKey' => 'restaurant_menu_id',
        ),
    );*/
    
    public $hasMany = array(
        'RestaurantMenuExtraSection' => array(
            'className' => 'RestaurantMenuExtraSection',
            'foreignKey' => 'restaurant_menu_item_id',
            'dependent'=> true,
        ),
    );

    public function isDuplicateRecord($name, $description, $restaurant_menu_id,$price)
    {
        return $this->find('count', array(
            'conditions' => array(


                'RestaurantMenuItem.name'=> $name,
                'RestaurantMenuItem.description'=> $description,

                'RestaurantMenuItem.restaurant_menu_id'=> $restaurant_menu_id,
                'RestaurantMenuItem.price'=> $price,



            )
        ));
    }
    
    //keep
    public function getImage($id)
    {
        $item = $this->find('first', array(
            'conditions' => array(
                'RestaurantMenuItem.id'=> $id
            )
        ));
        
        return $item['RestaurantMenuItem']['image'];
    }

    public function getMenuItems($restaurant_menu_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'RestaurantMenuItem.restaurant_menu_id'=> $restaurant_menu_id,
                'RestaurantMenuItem.active'=> 1



            )
        ));
    }
    
    //keep
    public function getMenuItemIds($id)
    {
        $items = $this->find('all', array(
            'conditions' => array(
                'RestaurantMenuItem.restaurant_menu_id'=> $id
            )
        ));
        
        $IDs= array();
        
        foreach($items as $item){
            array_push($IDs, $item['RestaurantMenuItem']['id']);
        }
        
        return $IDs;
    }


    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'RestaurantMenuItem.id'=> $id



            )
        ));
    }



    public function getMenuItemsMobile($restaurant_menu_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'RestaurantMenuItem.restaurant_menu_id'=> $restaurant_menu_id,
                'RestaurantMenuItem.active'=> 1



            )
        ));
    }
    public function getMenuItemFromID($id)
    {

        return $this->find('all', array(

            'conditions' => array(

                'RestaurantMenuItem.id'=> $id,
                  'RestaurantMenuItem.active'=> 1



            )
        ));
    }
    
    public function getMenuItemFromName($name, $id)
    {
        return $this->find('first', array(

            'conditions' => array(
                'RestaurantMenuItem.restaurant_menu_id'=> $id,
                'RestaurantMenuItem.name'=> $name,
                'RestaurantMenuItem.active'=> 1
            ),
        ));
    }

    public function removeMenuItem($restaurant_menu_id,$active){


        return $this->updateAll(
            array('RestaurantMenuItem.active' => $active),
            array('RestaurantMenuItem.restaurant_menu_id' => $restaurant_menu_id)
        );

    }
    public function deleteMenuItem($restaurant_menu_id){


        return $this->deleteAll([
            'RestaurantMenuItem.restaurant_menu_id'=> $restaurant_menu_id
            ]);

    }

    public function deleteMenuItemAgainstID($id){


        return $this->deleteAll([
            'RestaurantMenuItem.id'=> $id
        ],true);

    }




}

