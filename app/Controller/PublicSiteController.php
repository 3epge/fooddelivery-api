<?php

App::uses('Lib', 'Utility');
App::uses('Postmark', 'Utility');
App::uses('Message', 'Utility');

App::uses('CustomEmail', 'Utility');
App::uses('Security', 'Utility');
App::uses('PushNotification', 'Utility');
App::uses('Firebase', 'Lib');



class PublicSiteController extends AppController{

    public $components = array('Email');

    public $autoRender = false;
    public $layout = false;
    
    //keep
    public function registerRestaurantDeviceToken(){

        $this->loadModel("Kitchen");
        $this->loadModel("KitchensRestaurants");
        $this->loadModel("Restaurant");
        $this->loadModel("UserInfo");

        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $kitchen = $this->Kitchen->getKitchenID($data['device']);
            
            if(sizeof($kitchen) > 0){
                
                $restaurants = array();
            
                foreach($kitchen as $k){
                    
                    $restaurant = $this->KitchensRestaurants->getRestaurantIDs($k['Kitchen']['id']);
                    
                    foreach($restaurant as $r){
            
                        array_push($restaurants, $r);
                        
                    }
                }
                
                foreach($restaurants as $rest){
                    
                    $id = $this->Restaurant->getRestaurantUserID($rest['KitchensRestaurants']['restaurant']);
                    
                    $this->UserInfo->id = $id['Restaurant']['user_id'];
                    $this->UserInfo->saveField('device_token', $data['token']);
                    
                }
                
                $output['code'] = 200;
    
                $output['msg'] = 'Successfully registered device tokens!';
                echo json_encode($output);
    
                die();
                
            } else {
                
                $output['code'] = 404;
                $output['msg'] = 'This device is not registered. Please contact the OOHK admin.';
                
                echo json_encode($output);
                die();
                
            }

        }
    }
    
    //keep
    public function getRestaurantsByDeviceId(){

        $this->loadModel("Kitchen");
        $this->loadModel("KitchensRestaurants");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $kitchen = $this->Kitchen->getKitchenID($data['device']);
            
            $restaurants = array();
            
            foreach($kitchen as $k){
                
                $restaurant = $this->KitchensRestaurants->getRestaurants($k['Kitchen']['id']);
                
                foreach($restaurant as $r){
                    
                    array_push($restaurants, $r);
                }
            }
            
            $output['code'] = 200;

            $output['msg'] = $restaurants;
            echo json_encode($output);

            die();

        }
    }

  
    //keep
    public function showKitchenOrders(){
        
        $this->loadModel("KitchensRestaurants");
        $this->loadModel("Kitchen");
        $this->loadModel("Order");
        $this->loadModel("Restaurant");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            $kitchen = $this->Kitchen->getKitchenID($data['device']);
            
            $restaurants = array();
            
            foreach($kitchen as $k){
                $restaurant = $this->KitchensRestaurants->getRestaurants($k['Kitchen']['id']);
                $restaurants = array_merge($restaurants, $restaurant);
            }
            
            $kitchen_orders = array();
            
            if(count($restaurants) > 0){
                
                if($data['status'] == 'live'){
                    
                    foreach ($restaurants as $k => $v){
                        $orders = $this->Order->getLiveOrders($v['Restaurant']['id']);
                        if(sizeof($orders) != 0){
                            $temp['Restaurant'] = $v['Restaurant'];
                            $temp['Orders'] = $orders;
                            array_push($kitchen_orders, $temp);
                        }
                    }
                    
                }else if($data['status'] == 'past'){
                    
                    foreach ($restaurants as $k => $v){
                        $orders = $this->Order->getPastOrders($v['KitchensRestaurants']['restaurant'], date('Y-m-d H:i:s', strtotime("-3 days")));
                        $kitchen_orders[$k] = $orders;
                    }
                    
                }
                
            }
            
            
            
            $output['code'] = 200;

            $output['msg'] = $kitchen_orders;
            echo json_encode($output);

            die();

        }
        
        
    }
    
    //keep
    public function showDineInOrders(){
        
        $this->loadModel("Kitchen");
        $this->loadModel("Order");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $dinein_orders = array();
            
            $orders = $this->Order->getDineInOrders();
            
            foreach ($orders as $order){
                $added = false;
                foreach ($dinein_orders as $k => $v){
                    if($dinein_orders[$k]['Table'] == $order['Order']['deal_id']){
                        $added = true;
                        array_push($dinein_orders[$k]['Orders'], $order);
                    }
                }
                if(!$added){
                    $temp['Table'] = $order['Order']['deal_id'];
                    $temp['Orders'] = [];
                    array_push($temp['Orders'], $order);
                    array_push($dinein_orders, $temp);
                }
            }
            
            $output['code'] = 200;
            $output['msg'] = $dinein_orders;
            echo json_encode($output);

            die();
        }
    }
    
    //keep
    public function showTableOrders(){
        
        $this->loadModel("Kitchen");
        $this->loadModel("Order");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $dinein_orders = array();
            
            $orders = $this->Order->getTableOrders($data['table_id']);
            
            $output['code'] = 200;
            $output['msg'] = $orders;
            echo json_encode($output);

            die();
        }
    }

    //keep
    public function getOrderDetails()
    {
        $this->loadModel("Order");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['id'];
            $order = $this->Order->getOrderDetailBasedOnID($order_id);
            
            if (count($order) > 0) {
                $output['code'] = 200;

                $output['msg'] = $order[0];
                echo json_encode($output);
                die();

            } else {

                Message::EmptyDATA();
                die();

            }


        }
    }
    
    //keep
    public function acceptOrder(){
        $this->loadModel("Order");
        $this->loadModel("Restaurant");
        
        if ($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $restaurant_id = $data['restaurant_id'];
            $restaurant_response['restaurant_status'] = 1;
            $restaurant_response['estimated_time'] = $data['estimated_time'];
            
            $this->Order->id = $order_id;
            
            if ($this->Order->save($restaurant_response)) {
                
                $restaurant_orders = $this->Restaurant->getRestaurantInfo($data['restaurant_id']);
                $restaurant_orders['Orders'] = $this->Order->getLiveOrders($data['restaurant_id']);
                
                if($data['token']!=""){
                    
                    $device_token = $data['token'];
                    
                    /************notification*************/

                    $notification['to'] = $device_token;
                    $notification['data']['title'] = "🧾Order Accepted";
                    $notification['notification']['title'] = "🧾Order Accepted";
                    $notification['data']['body'] = $restaurant_orders['Restaurant']['name']." has started preparing your order. Delivery time: ".$data['estimated_time'];
                    $notification['notification']['body'] = $restaurant_orders['Restaurant']['name']." has started preparing your order. Delivery time: ".$data['estimated_time'];
                    $push_notification = PushNotification::sendPushNotificationToMobileDevice(json_encode($notification));

                    /***********end notification**********/
                    
                }

                $output['code'] = 200;
                $output['msg'] = $restaurant_orders;
                echo json_encode($output);

                die();
                
            } else {

                $output['code'] = 400;
                $output['msg'] = Message::DATASAVEERROR();
                echo json_encode($output);
                die();

            }
            
        }
        
    }
    
    //keep
    public function notifiedKitchen(){
        $this->loadModel("Order");
        
        if ($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $restaurant_response['restaurant_status'] = 1;
            
            $this->Order->id = $order_id;
            
            if ($this->Order->save($restaurant_response)) {
                
                $output['code'] = 200;
                echo json_encode($output);

                die();
            }
            
            $output['code'] = 400;
            $output['msg'] = Message::DATASAVEERROR();
            echo json_encode($output);
            die();
            
        }
        
    }
    
    //keep
    public function declineOrder(){
        $this->loadModel("Order");
        $this->loadModel("Restaurant");
        
        if ($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $restaurant_id = $data['restaurant_id'];
            $restaurant_response['restaurant_status'] = 4;
            $restaurant_response['rejected_reason'] = "Restaurant Cancelled";
            
            $this->Order->id = $order_id;
            
            if ($this->Order->save($restaurant_response)) {
                
                if($data['token']!=""){
                    
                    $device_token = $data['token'];
                    
                    /************notification*************/

                    $notification['to'] = $device_token;
                    $notification['data']['title'] = "❌Order Cancelled";
                    $notification['notification']['title'] = "❌Order Cancelled";
                    $notification['data']['body'] = "The restaurant has cancelled your order #".$order_id.".";
                    $notification['notification']['body'] = "The restaurant has cancelled your order #".$order_id.".";
                    $push_notification = PushNotification::sendPushNotificationToMobileDevice(json_encode($notification));

                    /***********end notification**********/
                    
                }
                
                $restaurant_orders = $this->Restaurant->getRestaurantInfo($data['restaurant_id']);
                $restaurant_orders['Orders'] = $this->Order->getLiveOrders($data['restaurant_id']);

                $output['code'] = 200;
                $output['msg'] = $restaurant_orders;
                echo json_encode($output);

                die();
                
            } else {

                $output['code'] = 400;
                $output['msg'] = Message::DATASAVEERROR();
                echo json_encode($output);
                die();

            }
            
        }
    }
    
    //keep
    public function updateOrder(){
        
        $this->loadModel("Order");
        $this->loadModel("Restaurant");
        
        if ($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $restaurant_id = $data['restaurant_id'];
            $restaurant_response['restaurant_status'] = 2;
            
            $this->Order->id = $order_id;
            
            if ($this->Order->save($restaurant_response)) {
                
                if($data['token']!=""){
                    
                    $device_token = $data['token'];
                    
                    /************notification*************/

                    $notification['to'] = $device_token;
                    $notification['data']['title'] = "🛵Driver Picked Up";
                    $notification['notification']['title'] = "🛵Driver Picked Up";
                    $notification['data']['body'] = "Your order is being delivered.";
                    $notification['notification']['body'] = "Your order is being delivered.";
                    $push_notification = PushNotification::sendPushNotificationToMobileDevice(json_encode($notification));

                    /***********end notification**********/
                    
                }
                
                $restaurant_orders = $this->Restaurant->getRestaurantInfo($data['restaurant_id']);
                $restaurant_orders['Orders'] = $this->Order->getLiveOrders($data['restaurant_id']);

                $output['code'] = 200;
                $output['msg'] = $restaurant_orders;
                echo json_encode($output);

                die();
                
            } else {

                $output['code'] = 400;
                $output['msg'] = Message::DATASAVEERROR();
                echo json_encode($output);
                die();

            }
            
        }
        
    }
    
    //keep
    public function completeOrder(){
        $this->loadModel("Order");
        $this->loadModel("Restaurant");
        
        if ($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $restaurant_id = $data['restaurant_id'];
            $restaurant_response['restaurant_status'] = 3;
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
            $dt->setTimestamp($timestamp);
            $restaurant_response['actual_time'] = $dt->format('M d H:i');
            
            $this->Order->id = $order_id;
            
            if ($this->Order->save($restaurant_response)) {
                
                $restaurant_orders = $this->Restaurant->getRestaurantInfo($data['restaurant_id']);
                $restaurant_orders['Orders'] = $this->Order->getLiveOrders($data['restaurant_id']);
                
                if(isset($data['token'])){
                    
                    $device_token = $data['token'];
                    
                    /************notification*************/

                    $notification['to'] = $device_token;
                    $notification['data']['title'] = "🍛Food Ready";
                    $notification['notification']['title'] = "🍛Food Ready";
                    $notification['data']['body'] = "Your order is ready. Please pick up from ".$restaurant_orders['Restaurant']['name'].".";
                    $notification['notification']['body'] = "Your order is ready. Please pick up from ".$restaurant_orders['Restaurant']['name'].".";
                    $push_notification = PushNotification::sendPushNotificationToMobileDevice(json_encode($notification));

                    /***********end notification**********/
                    
                }

                $output['code'] = 200;
                $output['msg'] = $restaurant_orders;
                echo json_encode($output);

                die();
                
            } else {

                $output['code'] = 400;
                $output['msg'] = Message::DATASAVEERROR();
                echo json_encode($output);
                die();

            }
            
        }
            
    }
    
    //keep
    public function finishedDining(){
        $this->loadModel("Order");
        
        if ($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $orders = $data['orders'];
            $restaurant_response['restaurant_status'] = 3;
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
            $dt->setTimestamp($timestamp);
            $restaurant_response['actual_time'] = $dt->format('M d H:i');
            
            $hasError = false;
            
            foreach($orders as $order){
                $this->Order->id = $order;
                if ($this->Order->save($restaurant_response)) {
                    continue;
                }else{
                    $hasError = true;
                }
            }
            
            if($hasError){
                $output['code'] = 400;
                $output['msg'] = Message::DATASAVEERROR();
                echo json_encode($output);
                die();
            }else{
                $output['code'] = 200;
                echo json_encode($output);
                die();
            }
            
        }
        
    }
 
}?>