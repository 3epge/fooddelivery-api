<?php


    class Kitchen extends AppModel {

        public $useTable = 'kitchen';
        
        public $belongsTo = array(

            'District' => array(
                'className' => 'District',
                'foreignKey' => 'district',
            ),
            
        );
        
        var $contain = array('District');
        
        public function getAllKitchens()
        {
            return $this->find('all', array(
                'order' => 'Kitchen.id'    
            ));
        }
        
        public function getKitchenID($device)
        {
            return $this->find('all', array(
                'conditions' => array(
                    'Kitchen.device' => $device,
                ),
                'fields' => array(
                    'Kitchen.id'    
                )
            ));
        }
        
        public function getKitchen($device)
        {
            return $this->find('first', array(
                'conditions' => array(
                    'Kitchen.device' => $device,
                ),
            ));
        }
        
        public function hasDineIn($device)
        {
            $id = $this->find('all', array(
                'conditions' => array(
                    'Kitchen.device' => $device,
                ),
                'fields' => array(
                    'Kitchen.id'    
                )
            ));
            
            return in_array('1', $id);
        }
        
        public function getKitchenById($id)
        {
            return $this->find('first', array(
                'conditions' => array(
                    'Kitchen.id' => $id,
                ),
            ));
        }
        
        //keep
        public function getKitchensNearby($district)
        {
            return $this->find('all', array(
                'conditions' => array(
                    'Kitchen.district' => $district,
                    'Kitchen.block' => 0
                    ),
                'fields' => array(
                    'Kitchen.*'    
                ),
            ));
        }
        
        public function getKitchenDistrict($device)
        {
            $this->Behaviors->attach('Containable');
            return $this->find('first', array(
                'conditions' => array(
                    'Kitchen.device' => $device,
                ),
                'contain'=>$this->contain,
                'fields' => array(
                    'District.*'    
                )
            ));
        }
    
    }

?>