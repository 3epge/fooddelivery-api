<?php



class AppSlider extends AppModel
{

    public $useTable = 'app_slider';


    public function getImages()
    {
        return $this->find('all');

    }
    
    public function getMobileBanners()
    {
        return $this->find('all', array(
            'conditions' => array(
                'type' => 1
            )
        ));
    }
    
    public function getDesktopBanners()
    {
        return $this->find('all', array(
            'conditions' => array(
                'type' => 2
            )
        ));
    }


    public function getImageDetail($id)
    {
        return $this->find('all', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'AppSlider.id' => $id


            ),
            ));


    }

    public function getAppSlidersCount()
    {
        return $this->find('count');
    }

    public function deleteAppSlider($id)
    {
        return $this->deleteAll(
            [
                'AppSlider.id' => $id
               
            ],
            false # <- single delete statement please
        );
    }
}

?>