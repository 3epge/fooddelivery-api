<?php

App::uses('Lib', 'Utility');
App::uses('Firebase', 'Lib');
App::uses('Postmark', 'Utility');
App::uses('Message', 'Utility');
App::uses('Variables', 'Utility');
App::uses('CustomEmail', 'Utility');
App::uses('Security', 'Utility');
App::uses('PushNotification', 'Utility');




class ApiController extends AppController
{

    public $autoRender = false;
    public $layout = false;


    //keep
    public function registerUser()
    {
        $this->loadModel('User');
        $this->loadModel('UserInfo');
        
        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $email        = $data['email'];
            $password     = $data['password'];
            $first_name   = $data['first_name'];
            $last_name    = $data['last_name'];

            $device_token = $data['device_token'];
            $role         = $data['role'];
            $active = 1;

            if(isset($data['phone'])){

                $phone        = $data['phone'];
                $user_info['phone']        = $phone;
            }

            if($role == "rider" || $role == "hotel"){

                $active = 0;
            }


            if ($email != null && $password != null) {




                $user['email']    = strtolower($email);
                
                $passwordBlowfishHasher = new BlowfishPasswordHasher();
                $user['password'] = $passwordBlowfishHasher->hash($password);
                $user['salt'] = Security::hash($password, 'sha256', true);

                $user['active']  = $active;
                $user['role']    = $role;
                
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
                $dt->setTimestamp($timestamp);
                $user['created'] = $dt->format('Y-m-d H:i:s');

                $count = $this->User->isEmailAlreadyExist($email);

                if ($count && $count > 0) {
                    echo Message::DATAALREADYEXIST();
                    die();

                } else {

                    if (!$this->User->save($user)) {
                        echo Message::DATASAVEERROR();
                        die();
                    }

                    $user_id              = $this->User->getInsertID();
                    $user_info['user_id'] = $user_id;

                    $user_info['device_token'] = $device_token;
                    $user_info['first_name']   = $first_name;
                    $user_info['last_name']    = $last_name;


                    if (!$this->UserInfo->save($user_info)) {
                        echo Message::DATASAVEERROR();
                        die();
                    }




                    $output      = array();
                    $userDetails = $this->UserInfo->getUserDetailsFromID($user_id);
                    $key     = Security::hash(CakeText::uuid(), 'sha512', true);

                   if(APP_STATUS == "live") {
                       //CustomEmail::welcomeEmail($email, $key);
                   }
                    $output['code'] = 200;
                    $output['msg']  = $userDetails;
                    echo json_encode($output);




                }
            } else {
                echo Message::ERROR();
            }
        }
    }
    
    //keep
    public function registerPhoneNumber(){
        
        $this->loadModel('User');
        $this->loadModel('UserInfo');
        
        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $email = strtolower($data['email']);
            $phone = $data['phone_number'];
            
            $count = $this->User->isEmailAlreadyExist($email);

            if ( $count == 1) {
                $userData = $this->User->getUserDetailsAgainstEmail($email);
                $user_id = $userData['User']['id'];
                $this->UserInfo->id = $user_id;
                $this->UserInfo->saveField('phone', $phone);
                $output['code'] = 200;
                $output['msg'] = $user_id;
                echo json_encode($output);
                die();
            }
        }
    }
    
    //keep
    public function login() //changes done by irfan
    {
        $this->loadModel('User');
        $this->loadModel('UserInfo');


        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');

            $data = json_decode($json, TRUE);

            $email        = $data['email'];
            $password     = $data['password'];
            $device_token = $data['device_token'];
            $role = $data['role'];
            $email        = strtolower($email);

            $count = $this->User->isEmailAlreadyExist($email);


            if ( $count < 1) {
                $output['code'] = 201;
                $output['msg']  = "No account exist with this email. You have to signup first";

                echo json_encode($output);
                die();

            }
            if ($email != null && $password != null) {


                $userData = $this->User->login($email, $password,$role);




                if ($userData) {
                    $user_id = $userData[0]['User']['id'];

                    $this->UserInfo->id = $user_id;
                    $this->UserInfo->saveField('device_token', $device_token);

                    $output = array();
                    $userDetails = $this->UserInfo->getUserDetailsFromID($user_id);


                    $output['code'] = 200;
                    $output['msg'] = $userDetails;

                    echo json_encode($output);


                } else {
                    echo Message::INVALIDDETAILS();
                    die();

                }


            } else {
                echo Message::ERROR();
                die();
            }


        }

    }
    
    //keep
    public function loginWithSocialMedia()
    {
        $this->loadModel('User');
        $this->loadModel('UserInfo');
        
        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $email = strtolower($data['email']);
            $count = $this->User->isEmailAlreadyExist($email);

            if ( $count < 1) {
                
                $user = array();
                $user['email'] = $email;
                $user['password'] = '';
                $user['salt'] = '';
                $user['active'] = 1;
                $user['block'] = 0;
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
                $dt->setTimestamp($timestamp);
                $user['created'] = $dt->format('Y-m-d H:i:s');
                $user['role'] = 'user';
                $user['method'] = strtolower($data['method']);
                $this->User->save($user);
                
                $user_id = $this->User->getInsertID();
                $user_info['user_id'] = $user_id;
                
                $user_info['first_name'] = $data['first_name'];
                $user_info['last_name'] = $data['last_name'];
                
                $this->UserInfo->save($user_info);
                
                $output['code'] = 201;
                echo json_encode($output);
                die();
                
            }else{
                
                $userData = $this->User->getUserDetailsAgainstEmail($email);
                if($userData['UserInfo']['phone'] != null){
                    $output = array();
                    $output['code'] = 200;
                    $output['msg'] = $userData['User']['id'];

                    echo json_encode($output);
                    die();
                }else{
                    $output['code'] = 201;
                    echo json_encode($output);
                    die();
                }
            }
        }
        
    }

    /*public function addRiderLocation()
    {

        $this->loadModel("RiderLocation");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id = $data['user_id'];
            $lat     = $data['lat'];
            $long    = $data['long'];



            $rider_location = array();

            $rider_location['user_id'] = $user_id;
            $rider_location['lat']     = $lat;
            $rider_location['long']    = $long;


            $result = $this->RiderLocation->getRiderLocation($user_id);
            if (count($result) > 0) {


                $id                      = $result[0]['RiderLocation']['id'];

                $this->RiderLocation->id = $id;
                if (!$this->RiderLocation->save($rider_location)) {
                    echo Message::DATASAVEERROR();
                    die();

                } else {
                    echo Message::DATASUCCESSFULLYSAVED();

                    die();

                }
            } else {

                if (!$this->RiderLocation->save($rider_location)) {
                    echo Message::DATASAVEERROR();
                    die();

                } else {
                    echo Message::DATASUCCESSFULLYSAVED();

                    die();
                }

            }



        }
    }*/


    /*public function addOrderSession()
    {

        $this->loadModel("OrderSession");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id = $data['user_id'];

            $string = $json;

            $created = date('Y-m-d H:i:s', time());


if(isset( $data['string'])){

    $string = $data['string'];
}



            $session['user_id'] = $user_id;
            $session['string']     = $string;
            $session['created']    = $created;


            $details = $this->OrderSession->getAll();
            if(count($details) > 0){

                foreach($details as $detail) {

                    $datetime1 = new DateTime($created);
                    $datetime2 = new DateTime($detail['OrderSession']['created']);
                    $interval = $datetime1->diff($datetime2);
                    $minutes = $interval->format('%i');
                    $id = $detail['OrderSession']['id'];
                    if ($minutes > 60) {

                        $this->OrderSession->delete($id);

                    }
                }

            }


            $this->OrderSession->save($session);
            $id = $this->OrderSession->getInsertID();
            $details =   $this->OrderSession->getDetails($id);

            $output['code'] = 200;

            $output['msg'] = $details;
            echo json_encode($output);

            die();


        }
    }*/

    /*public function showOrderSession()
    {

        $this->loadModel("OrderSession");


        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $id = $data['id'];

            $details = $this->OrderSession->getDetails($id);
            if(count($details) > 0) {

                $output['code'] = 200;

                $output['msg'] = $details;
                echo json_encode($output);


                die();
            }else{

                Message::EmptyDATA();
                die();

            }

        }
    }*/

    /*public function showRiderLocationAgainstOrder()
    {

        $this->loadModel("Order");
        $this->loadModel("RiderOrder");
        $this->loadModel("RiderTrackOrder");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $user_id = $data['user_id'];
            $map_change = $data['map_change'];



            $on_my_way_to_hotel_time = $this->RiderTrackOrder->isEmptyOnMyWayToHotelTime($order_id);
            $pickup_time = $this->RiderTrackOrder->isEmptyPickUpTime($order_id);
            $on_my_way_to_user_time = $this->RiderTrackOrder->isEmptyOnMyWayToUserTime($order_id);
            $delivery_time = $this->RiderTrackOrder->isEmptyDeliveryTime($order_id);
            $order_detail = $this->Order->getOrderDetailBasedOnID($order_id);


            $status_0 = "";
            $status_1 = "";
            $status_2 = "";
            $status_3 = "";
            $status_4 = "";
            $status_5 = "";
            $status_6 = "";
            $status_7 = "";

            if ($order_detail[0]['Order']['hotel_accepted'] == 0) {

                $status_0 = "Order is in processing";
                $status_pusher[0]['order_status'] = $status_0;
                if($map_change == 1){
                    $status_pusher[0]['map_change'] = $map_change;
                }else {
                    $status_pusher[0]['map_change'] = "0";
                }
            }else {

                $status_0 = "Order is in processing";
                $status_pusher[0]['order_status'] = $status_0;
                if($map_change == 1){
                    $status_pusher[0]['map_change'] = $map_change;
                }else {
                    $status_pusher[0]['map_change'] = "0";
                }

            }

            if ($order_detail[0]['Order']['hotel_accepted'] == 1) {

                $status_1 = $order_detail[0]['Restaurant']['name'] . ' ' . "has accepted your order and processing it";
                $status_pusher[1]['order_status'] = $status_1;
                if($map_change == 1){
                    $status_pusher[1]['map_change'] = $map_change;
                }else {
                    $status_pusher[1]['map_change'] = "0";
                }

            }

            if ($order_detail[0]['RiderOrder']['id'] > 0) {
                if (Lib::multi_array_key_exists('RiderOrder', $order_detail)) {


                    $status_2 = "Order has been assigned to " . $order_detail[0]['RiderOrder']['Rider']['first_name'];
                    //$status_pusher[0]['order_status'] =  $status_0;
                    $status_pusher[2]['order_status'] = $status_2;
                    if($map_change == 1){
                        $status_pusher[2]['map_change'] = $map_change;
                    }else {
                        $status_pusher[2]['map_change'] = "1";
                    }
                }


                if ($on_my_way_to_hotel_time == 1) {


                    $status_3 = $order_detail[0]['RiderOrder']['Rider']['first_name'] . ' ' . "is on the way to restaurant to pickup your order";
                    //$status_pusher[0]['order_status'] =  $status_0;
                    $status_pusher[3]['order_status'] = $status_3;
                    if($map_change == 1){
                        $status_pusher[3]['map_change'] = $map_change;
                    }else {
                        $status_pusher[3]['map_change'] = "0";
                    }

                    //  $status = "order is in processing";
                    //$status_pusher[0]['order_status'] = $status;

                }

                if ($pickup_time == 1) {


                    $status_4 = $order_detail[0]['RiderOrder']['Rider']['first_name'] . ' ' . "has picked up your food";

                    $status_pusher[4]['order_status'] = $status_4;
                    if($map_change == 1){
                        $status_pusher[4]['map_change'] = $map_change;
                    }else {
                        $status_pusher[4]['map_change'] = "1";
                    }

                }
                if ($on_my_way_to_user_time == 1) {


                    $status_5 = $order_detail[0]['RiderOrder']['Rider']['first_name'] . ' ' . "is on the way to you";

                    $status_pusher[5]['order_status'] = $status_5;
                    if($map_change == 1){
                        $status_pusher[5]['map_change'] = $map_change;
                    }else {
                        $status_pusher[5]['map_change'] = "0";
                    }


                }

                if ($delivery_time == 1) {


                    $status_6 = $order_detail[0]['RiderOrder']['Rider']['first_name'] . ' ' . "just delivered the food";

                    $status_pusher[6]['order_status'] = $status_6;
                    if($map_change == 1){
                        $status_pusher[6]['map_change'] = $map_change;
                    }else {
                        $status_pusher[6]['map_change'] = "0";
                    }

                }

            }
            $reverse_status_pusher = array_reverse($status_pusher);

            $rider = $this->RiderOrder->getRiderDetailsAgainstOrderID($order_id);

            //  $rider_location = $this->RiderLocation->getRiderLocation($rider[0]['RiderOrder']['rider_user_id']);
            if (count($rider) > 0 && $pickup_time > 0) {


                //order has been assigned and picked up
                $result[0]['RiderOrder'] = $rider[0]['RiderOrder'];

                $result[0]['Rider'] = $rider[0]['Rider'];

                if(!Lib::multi_array_key_exists('RiderLocation',$rider[0]['RiderOrder'])){


                    $result[0]['RiderOrder']['RiderLocation']['lat'] = "";
                    $result[0]['RiderOrder']['RiderLocation']['long'] = "";


                }
                $result[0]['RiderOrder']['RiderLocation']['status'] = $reverse_status_pusher;
                $result[0]['UserLocation'] = $rider[0]['Order']['Address'];
                $result[0]['RestaurantLocation']['lat'] = "";
                $result[0]['RestaurantLocation']['long'] = "";

                $output['code'] = 200;

                $output['msg'] = $result;
                echo json_encode($output);


            } else if (count($rider) > 0 && $pickup_time == 0) {

                //order has been assigned but not picked up yet

                $result[0]['RiderOrder'] = $rider[0]['RiderOrder'];
                $result[0]['Rider'] = $rider[0]['Rider'];

                if(!Lib::multi_array_key_exists('RiderLocation',$rider[0]['RiderOrder'])){


                    $result[0]['RiderOrder']['RiderLocation']['lat'] = "";
                    $result[0]['RiderOrder']['RiderLocation']['long'] = "";


                }
                $result[0]['RiderOrder']['RiderLocation']['status'] = $reverse_status_pusher;
                $result[0]['UserLocation']['lat'] = "";
                $result[0]['UserLocation']['long'] = "";
                $result[0]['RestaurantLocation'] = $rider[0]['Order']['Restaurant']['RestaurantLocation'];

                $output['code'] = 200;

                $output['msg'] = $result;
                echo json_encode($output);


            } else {

                //no order has been assigned to rider...: send only restaurant location

                $restaurant_location = $this->Order->getOrderDetailBasedOnID($order_id);

                $result[0]['RiderOrder']['RiderLocation']['lat'] = "";
                $result[0]['RiderOrder']['RiderLocation']['long'] = "";
                $result[0]['Rider']['first_name'] = "";
                $result[0]['Rider']['last_name'] = "";
                $result[0]['Rider']['phone'] = "";


                $result[0]['RiderOrder']['RiderLocation']['status'] = $reverse_status_pusher;
                $result[0]['UserLocation']['lat'] = "";
                $result[0]['UserLocation']['long'] = "";
                $result[0]['RestaurantLocation'] = $restaurant_location[0]['Restaurant']['RestaurantLocation'];

                $output['code'] = 200;

                $output['msg'] = $result;
                echo json_encode($output);

            }






        }
    }*/









    /*public function enableOrderTracking(){

        $this->loadModel("Order");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order_id = $data['order_id'];
            $status = $data['status'];

            $this->Order->id = $order_id;

            if($this->Order->saveField('tracking',$status)){

                echo Message::DATASUCCESSFULLYSAVED();


                die();

            }else{


                echo Message::ERROR();
                die();
            }
        }

    }*/

    
    //keep
    public function getRestaurantsByHomeMenus(){
        $this->loadModel('HomeMenu');
        $this->loadModel("RestaurantMenu");
        $this->loadModel("Restaurant");
        
        $categories = $this->HomeMenu->find('all');
        
        $result = array();
        
        foreach($categories as $c) {
            $data = $this->RestaurantMenu->find('all',  array('conditions'=>array('RestaurantMenu.homemenu'=>$c['HomeMenu']['id'])));
            $ids = array();
            foreach($data as $d) {
             $ids[] =  $d['RestaurantMenu']['restaurant_id']; 
            }
            $ids = array_unique($ids);
            $restaurants = $this->Restaurant->getHomeRestaurants($ids);
            $c['Restaurants'] = $restaurants;
            array_push($result, $c);
        }
        
        $output['code'] = 200;
        $output['msg'] = $result;
		echo json_encode($output);
        die();
        
    }
    
    
    //keep
    public function getUserDetails(){
        
        $this->loadModel("UserInfo");
        
        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id = $data['user_id'];
            
            $userDetails = $this->UserInfo->getUserDetailsFromID($user_id);
            
            $output['code'] = 200;
            $output['msg'] = $userDetails;
            echo json_encode($output);
            die();
        }
    }
    
   
    /*public function editUserProfile()
    {

        $this->loadModel("UserInfo");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id    = $data['user_id'];
            $first_name = $data['first_name'];
            $last_name  = $data['last_name'];
            $email      = $data['email'];




            $user_info['first_name'] = $first_name;
            $user_info['last_name']  = $last_name;
            $user_info['email']      = $email;





            $this->UserInfo->id = $user_id;
            if ($this->UserInfo->save($user_info)) {
                $userDetails = $this->UserInfo->getUserDetailsFromID($user_id);


                $output['code'] = 200;

                $output['msg'] = $userDetails;
                echo json_encode($output);


                die();
            } else {

                echo Message::DATASAVEERROR();
                die();

            }

        }
    }*/
    
    //keep
    public function updateUserProfile()
    {

        $this->loadModel("UserInfo");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id    = $data['user_id'];
            $first_name = $data['first_name'];
            $last_name  = $data['last_name'];
            $phone      = $data['phone'];




            $user_info['first_name'] = $first_name;
            $user_info['last_name']  = $last_name;
            $user_info['phone']      = $phone;





            $this->UserInfo->id = $user_id;
            if ($this->UserInfo->save($user_info)) {
                $userDetails = $this->UserInfo->getUserDetailsFromID($user_id);


                $output['code'] = 200;

                $output['msg'] = $userDetails;
                echo json_encode($output);


                die();
            } else {

                echo Message::DATASAVEERROR();
                die();

            }

        }
    }
    
    //keep
    public function addFormattedAddress(){
        
        $this->loadModel("Address");



        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id     = $data['user_id'];
            $street      = $data['street'];
            $lat         = $data['lat'];
            $long        = $data['long'];
            $city        = $data['city'];
            $instruction = $data['instruction'];

            $address['user_id']      = $user_id;
            $address['lat']          = $lat;
            $address['long']         = $long;
            $address['street']       = $street;
            $address['city']         = $city;
            $address['instructions'] = $instruction;
            
            $address['user_id']      = $user_id;
            $address['lat']          = $lat;
            $address['long']         = $long;
            $address['street']       = $street;
            $address['apartment']    = '';
            $address['city']         = $city;
            $address['state']        = '';
            $address['zip']          = '';
            $address['country']      = '';
            $address['instructions'] = $instruction;
            
            $this->Address->save($address);
            $address_id = $this->Address->getLastInsertId();
            
            $output['code'] = 200;
            $output['address_id']  = $address_id;
            
            echo json_encode($output);
            die();

        }
        
    }
    
    //keep
    public function getAllDeliveryAddresses(){
        
        $this->loadModel('Address');
        
        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);


            $user_id   = $data['user_id'];
            $addresses = $this->Address->getUserDeliveryAddresses($user_id);
            
            $output['code'] = 200;
            $output['msg']  = $addresses;
            echo json_encode($output);
            die();
            
        }
    }
    
    //keep
    public function getDeliveryFee(){
        
        $this->loadModel('Address');
        $this->loadModel('RestaurantLocation');
        $this->loadModel('Restaurant');
        
        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);


            $lat = $data['lat'];
            $lng = $data['lng'];
            $restaurant_id = $data['restaurant_id'];
            
            $delivery_fee = 0;
            $kitchen_location = $this->Restaurant->getKitchenLocation($restaurant_id);
            
            $distance_difference = Lib::getDurationTimeBetweenTwoDistances($kitchen_location['lat'], $kitchen_location['lng'], $lat, $lng);
            $new_fee = intval($distance_difference['rows'][0]['elements'][0]['duration']['text']) * 5;
            
            /*$restaurant_location = $this->RestaurantLocation->getRestaurantLatLong($restaurant_id);
            
            
            $distance_difference_btw_user_and_restaurant = Lib::getDurationTimeBetweenTwoDistances($restaurant_location[0]['RestaurantLocation']['lat'], $restaurant_location[0]['RestaurantLocation']['long'], $lat, $lng);
            $my = intval($distance_difference_btw_user_and_restaurant['rows'][0]['elements'][0]['distance']['text']);
            $distance = $my * 1.6;
            
            $restaurant_detail = $this->Restaurant->getRestaurantDetailInfo($restaurant_id);
                    
            if ($distance <= 2.5){
                $delivery_fee = 30;
            } else if($distance > 2.5 && $distance <= 5) {
                $delivery_fee = 40;
            } else if($distance > 5 && $distance <= 7.5) {
                $delivery_fee = 60;
            } else if($distance > 7.5 && $distance <= 10) {
                $delivery_fee = 80;
            }else if($distance > 10 && $distance <= 20) {
                $delivery_fee = 95;
            }else if($distance > 20) {
                $delivery_fee = 125;
            }*/
            
            $output['code'] = 200;
            $output['fee']  = (int)number_format((float)$new_fee, 1, '.', '');
            echo json_encode($output);
            die();
        }
    }

    //keep
    public function deleteDeliveryAddress()
    {

        $this->loadModel('Address');
        // $this->loadModel("RestaurantRating");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $id      = $data['id'];
            $user_id = $data['user_id'];
            $this->Address->query('SET FOREIGN_KEY_CHECKS=0');
            if ($this->Address->delete($id)) {


                $addresses = $this->Address->getUserDeliveryAddresses($user_id);


                $output['code'] = 200;
                $output['msg']  = $addresses;
                echo json_encode($output);
                die();
                //$this->RiderTiming->deleteAll(array('upvote_question_id' => $upvote_question_id), false);
            } else {

                Message::ALREADYDELETED();
                die();


            }
        }
    }
    
    //keep
    public function getRestaurantTimingByDay() {
        
        $this->loadModel('RestaurantTiming');
        
        if($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $day = $data['weekday'];
            $restaurant = $data['restaurant'];
            
            $res = $this->RestaurantTiming->getRestaurantTiming($day, $restaurant);
            
            $output['code'] = 200;
            $output['msg']  = $res;
            echo json_encode($output);
            die();
        }
    }
    
    //keep
    public function getPaymentMethod()
    {
        $this->loadModel('PaymentMethod');
        if ($this->request->isPost()) {
            $method = $this->PaymentMethod->get();
            $output['code'] = 200;
            $output['msg']  = $method;
            echo json_encode($output);
            die();
        }
    }

    //keep
    public function showRestaurantsByDistrict(){
        
        $this->loadModel("District");
        $this->loadModel("Restaurant");
        $this->loadModel("Kitchen");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $user_id = null;
            if (isset($data['user_id'])) {

                $user_id = $data['user_id'];
            }
            
            $district = $this->District->getDistrict($data['lat'], $data['lng']);
            
            $kitchens = array();
            
            foreach( $district as $key => $val) {
                $res = $this->Kitchen->getKitchensNearby($val['District']['id']);
                foreach ($res as $k => $v){
                    array_push($kitchens, $v);
                }
            }
            
            $regular = array();
            $promoted = array();
            
            foreach($kitchens as $key => $val){
                $regular_rest = $this->Restaurant->getRestaurantByKitchen($val['Kitchen']['id'], 0);
                foreach($regular_rest as $rest){
                    $add = true;
                    foreach($regular as $k=>$v){
                        if($v['Restaurant']['rank'] == $rest['Restaurant']['rank']){
                            $regular[$k] = $rest;
                            $add = false;
                        }
                    }
                    if($add){
                        array_push( $regular, $rest);
                    }
                }
                $feat_rest = $this->Restaurant->getRestaurantByKitchen($val['Kitchen']['id'], 1);
                foreach($feat_rest as $feat){
                    $add = true;
                    foreach($promoted as $k=>$v){
                        if($v['Restaurant']['rank'] == $feat['Restaurant']['rank']){
                            $promoted[$k] = $feat;
                            $add = false;
                        }
                    }
                    if($add){
                        array_push( $promoted, $feat);
                    }
                }
            }
            
            $output['code'] = 200;
            $output['kitchen'] = $kitchens;
            $output['regular'] = $regular;
            $output['featured'] = $promoted;
            echo json_encode($output);

            die();

        }
    }
    
    //keep
    public function showRestaurantsThatAllowPickUp(){
        
        $this->loadModel("Restaurant");
        
        if ($this->request->isPost()) {
            
            $regular = array();
            $featured = array();
            
            $restaurants= $this->Restaurant->getPickUpRestaurants();
            
            foreach($restaurants as $key => $val){
                if($val['Restaurant']['promoted'] == '1' && !in_array($val, $featured)) array_push($featured, $val);
                if($val['Restaurant']['promoted'] == '0' && !in_array($val, $regular)) array_push($regular, $val);
            }
            
            $output['code'] = 200;
            $output['featured'] = $featured;
            $output['regular'] = $regular;
            echo json_encode($output);

            die();

        }
        
        
    }

    
    //keep
    public function showRestaurantsMenu()
    {

        $this->loadModel("Restaurant");
        $this->loadModel("RestaurantMenuItem");
        $this->loadModel("RestaurantTiming");
        $this->loadModel("RestaurantMenuExtraSection");
        $this->loadModel("RestaurantMenuExtraItem");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $restaurant_id = $data['id'];
            $current_time  = $data['current_time'];


            $menus = $this->Restaurant->getRestaurantMenusForMobiletest($restaurant_id);

            $i = 0;
            foreach($menus[0]['RestaurantMenu'] as $menu){

                $menu_items = $this->RestaurantMenuItem->getMenuItems($menu['id']);

                $j = 0;
                foreach($menu_items as $menu_item){


                    $menus[0]['RestaurantMenu'][$i]['RestaurantMenuItem'][$j] = $menu_item['RestaurantMenuItem'];

                    $menu_extra_section = $this->RestaurantMenuExtraSection->getSectionsAgainstRestaurantMenuItemMobile($menu_item['RestaurantMenuItem']['id']);
                    if(count($menu_extra_section) > 0){
                        $k = 0;

                        foreach ($menu_extra_section as $section) {

                            $menus[0]['RestaurantMenu'][$i]['RestaurantMenuItem'][$j]['RestaurantMenuExtraSection'][$k] = $section['RestaurantMenuExtraSection'];


                            $extra_items = $this->RestaurantMenuExtraItem->getExtraItemsMobile($section['RestaurantMenuExtraSection']['id']);
                            if(count($extra_items) > 0) {
                                $l = 0;

                                foreach ($extra_items as $extra_item) {

                                    $menus[0]['RestaurantMenu'][$i]['RestaurantMenuItem'][$j]['RestaurantMenuExtraSection'][$k]['RestaurantMenuExtraItem'][$l] = $extra_item['RestaurantMenuExtraItem'];
                                    $l++;
                                }
                            }else{

                                $menus[0]['RestaurantMenu'][$i]['RestaurantMenuItem'][$j]['RestaurantMenuExtraSection'][$k]['RestaurantMenuExtraItem'] = array();
                            }

                            $k++;
                        }
                    }else{

                        $menus[0]['RestaurantMenu'][$i]['RestaurantMenuItem'][$j]['RestaurantMenuExtraSection'] = array();
                    }
                    $j++;
                }
                $i++;
            }






            $day   = Lib::getDayOfTheWeek($current_time);



            $time  = date('H:i:s', strtotime($current_time));

            $restaurant_timing = $this->RestaurantTiming->isRestaurantOpen($day, $time, $restaurant_id);

           // $menus[0]['Restaurant']['open'] = "1";


            if(count($restaurant_timing) > 0) {

                $opening_time = $restaurant_timing['RestaurantTiming']['opening_time'];
                $closing_time = $restaurant_timing['RestaurantTiming']['closing_time'];



                if ($time >= $opening_time && $time <= $closing_time) {

                    $menus[0]['Restaurant']['open'] = "1"; //(string)$count;
                }else{

                    $menus[0]['Restaurant']['open'] = "0";
                }

            }else{

                $menus[0]['Restaurant']['open'] = "0";
            }


            //$menus = Lib::convert_from_latin1_to_utf8_recursively($menus);

            $output['code'] = 200;

            $output['msg'] = $menus;
            echo json_encode($output);



            die();
        }
    }

    //keep
    public function placeOrder()
    {
       
        
        $this->loadModel("Order");
        $this->loadModel("User");
        $this->loadModel("UserInfo");
        $this->loadModel("Address");
        $this->loadModel("OrderMenuItem");
        $this->loadModel("OrderMenuExtraItem");
        $this->loadModel("CouponUsed");
        $this->loadModel("RestaurantLocation");
        $this->loadModel("Restaurant");
        $this->loadModel("OrderTransaction");
        


        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);




            $user_id       = $data['user_id'];

            $quantity      = $data['quantity'];
            $address_id    = $data['address_id'];
            $restaurant_id = $data['restaurant_id'];
            $cod           = $data['cod'];
            $sub_total     = $data['sub_total'];



            $instructions  = $data['instructions'];
            $coupon_id     = $data['coupon_id'];
            $device        = @$data['device'];
            $version     =   @$data['version'];


            $delivery_fee  = $data['delivery_fee'];
            $delivery      = $data['delivery'];
            $rider_tip     = $data['rider_tip'];

            $created   = $data['order_time'];
            $menu_item = $data['menu_item'];

            $discount = 0;
            $donation = 0;
            if(isset($data['discount'])){

                $discount = $data['discount'];
            }
            if(isset($data['donation'])){

                $donation = $data['donation'];
            }
            if (count($menu_item) < 1) {

                echo Message::ERROR();
                die();
            }

            if($this->User->iSUserExist($user_id) == 0){

                echo Message::ERROR();
                die();
            }

            if($sub_total < 1){
                echo Message::ERROR();
                die();
            }




            $price = $delivery_fee + $rider_tip + $sub_total - $discount;




            $user_details_check = $this->UserInfo->getUserDetailsFromID($user_id);
            $restaurant_detail_check = $this->Restaurant->getRestaurantDetailInfo($restaurant_id);

            if(count($user_details_check) > 0 && count($restaurant_detail_check) > 0) {


                $order['user_id'] = $user_id;
                $order['price'] = $price;
                $order['created'] = $created;
                $order['quantity'] = $quantity;
                $order['discount'] = $discount;
                $order['cod'] = $cod;
                $order['version'] = $version;

                $order['address_id'] = $address_id;
                $order['sub_total'] = $sub_total;
                $order['device'] = $device;
                $order['delivery'] = $delivery;
                $order['rider_tip'] = $rider_tip;
                $order['restaurant_id'] = $restaurant_id;
                $order['instructions'] = $instructions;
                $order['delivery_fee'] = $delivery_fee;
                $order['donation'] = $donation;

                if (isset($data['phone_no'])) {


                    $order['phone_no'] = $data['phone_no'];
                }

                if (isset($data['delivery_date_time'])) {


                    $order['delivery_date_time'] = $data['delivery_date_time'];
                }

                if (isset($data['ruc_id'])) {


                    $order['ruc_id'] = $data['ruc_id'];
                }



                $this->Order->query('SET FOREIGN_KEY_CHECKS=0');


                $restaurant_location = $this->RestaurantLocation->getRestaurantLatLong($restaurant_id);
                $address_detail = $this->Address->getAddressDetail($address_id);


                $if_order_exist = $this->Order->isOrderExist($order);


                if (count($if_order_exist) > 0) {

                    $time_diff = Lib::time_difference($if_order_exist['Order']['created'], $created);


                    if (count($if_order_exist) > 0 && $time_diff <= 60) {

                        $output['code'] = 200;
                        $output['msg'] = "Your order has already been placed.";
                        echo json_encode($output);
                        die();

                    }
                }


                if ($this->Order->save($order)) {
                    $order_id = $this->Order->getLastInsertId();
                    $restaurant_detail = $this->Restaurant->getRestaurantDetailInfo($restaurant_id);
                            
                    $restaurant_user_id = $restaurant_detail[0]['Restaurant']['user_id'];
                    $restaurant_user_details = $this->UserInfo->getUserDetailsFromID($restaurant_user_id);
                    $device_token = $restaurant_user_details['UserInfo']['device_token'];
                    

                    //Firebase::placeOrder($order_id, $restaurant_user_id, $delivery);


                    if ($coupon_id != '') {
                        $coupon['coupon_id'] = $coupon_id;
                        $coupon['order_id'] = $order_id;
                        $coupon['user_id'] = $user_id;
                        $this->CouponUsed->save($coupon);
                    }

                    if (isset($data['transaction'])) {


                        $transaction = $data['transaction'];

                        if(count($transaction) > 0){

                            $order_transaction['type'] = $transaction['type'];

                            if($transaction['type'] == "stripe"){

                                $order_transaction['value'] = $order['stripe_charge'];
                            }

                            $order_transaction['value'] = $transaction['value'];

                            $order_transaction['order_id'] = $order_id;
                            $order_transaction['created'] = $created;

                            $this->OrderTransaction->save($order_transaction);


                        }
                    }

                    for ($i = 0; $i < count($menu_item); $i++) {

                        $order_menu_item[$i]['name'] = $menu_item[$i]['menu_item_name'];
                        $order_menu_item[$i]['quantity'] = $menu_item[$i]['menu_item_quantity'];
                        $order_menu_item[$i]['price'] = $menu_item[$i]['menu_item_price'];
                        $order_menu_item[$i]['instructions'] = $menu_item[$i]['menu_item_instructions'];

                        $order_menu_item[$i]['order_id'] = $order_id;
                        $this->OrderMenuItem->saveAll($order_menu_item[$i]);
                        $order_menu_item_id = $this->OrderMenuItem->getLastInsertId();
                        if (array_key_exists('menu_extra_item', $menu_item[$i])) {

                            if (count($menu_item[$i]['menu_extra_item']) > 0 && $menu_item[$i]['menu_extra_item'] != "") {
                                for ($j = 0; $j < count($menu_item[$i]['menu_extra_item']); $j++) {


                                    $order_menu_extra_item[$j]['name'] = $menu_item[$i]['menu_extra_item'][$j]['menu_extra_item_name'];
                                    $order_menu_extra_item[$j]['quantity'] = $menu_item[$i]['menu_extra_item'][$j]['menu_extra_item_quantity'];
                                    $order_menu_extra_item[$j]['price'] = $menu_item[$i]['menu_extra_item'][$j]['menu_extra_item_price'];
                                    $order_menu_extra_item[$j]['order_menu_item_id'] = $order_menu_item_id;
                                    $this->OrderMenuExtraItem->saveAll($order_menu_extra_item[$j]);
                                }
                            }
                        }
                    }
                    
                    $order_detail = $this->Order->getOrderDetailBasedOnID($order_id);
                    
                    $restaurant_device_token = $this->UserInfo->getUserToken($order_detail[0]['Restaurant']['user_id']);
                    
                    /************notification*************/


                    $notification['to'] =  $restaurant_device_token;
                    $notification['notification']['title'] = "New Order";
                    $notification['notification']['body'] = $order_detail[0]['Restaurant']['name'].' Order #'.$order_detail[0]['Order']['id'].' for '.$order_detail[0]['Order']['instructions'];
                    $notification['notification']['sound'] = 'alert.caf';
                    $notification['data']['order_id'] = $order_detail[0]['Order']['id'];
                    $push_notification = PushNotification::sendPushNotificationToMobileDevice(json_encode($notification));

                   

                    /********end notification***************/
                    
                    
                }


                if ($delivery == 1) {
                    $restaurant_will_pay = 0;


                    $distance_difference_btw_user_and_restaurant = Lib::getDurationTimeBetweenTwoDistances($restaurant_location[0]['RestaurantLocation']['lat'], $restaurant_location[0]['RestaurantLocation']['long'], $address_detail[0]['Address']['lat'], $address_detail[0]['Address']['long']);

                    //convert distance in Kms from miles
                    $distance = (float)$distance_difference_btw_user_and_restaurant['rows'][0]['elements'][0]['distance']['text'] * 1.6;


                    $min_order_price = $restaurant_detail[0]['Restaurant']['min_order_price'];
                    $delivery_free_range = $restaurant_detail[0]['Restaurant']['delivery_free_range'];

                    if ($sub_total >= $min_order_price && $distance > $delivery_free_range) { //case 1

                        $distance_difference = $distance - $delivery_free_range;
                        $delivery_fee_new = $restaurant_detail[0]['Tax']['delivery_fee_per_km'] * $distance_difference;
                        $restaurant_will_pay = $restaurant_detail[0]['Tax']['delivery_fee_per_km'] * $delivery_free_range;
                        // $total_amount = $delivery_fee + $sub_total;

                    } else if ($sub_total < $min_order_price && $distance > $delivery_free_range) {


                        $delivery_fee_new = $restaurant_detail[0]['Tax']['delivery_fee_per_km'] * $distance;
                        //$total_amount = $delivery_fee + $sub_total;


                    } else if ($sub_total > $min_order_price && $distance <= $delivery_free_range) {

                        // $total_amount = $sub_total;
                        $delivery_fee_new = "0";
                        $restaurant_will_pay = $restaurant_detail[0]['Tax']['delivery_fee_per_km'] * $distance;

                    } else if ($sub_total < $min_order_price && $distance <= $delivery_free_range) {
                        // $distance_difference = 5 - $distance;
                        $delivery_fee_new = $restaurant_detail[0]['Tax']['delivery_fee_per_km'] * $distance;
                        //$total_amount = $delivery_fee + $sub_total;

                    }


                    $delivery_fee_add_zero_in_the_end = strlen(substr(strrchr($delivery_fee, "."), 1));
                    if ($delivery_fee_add_zero_in_the_end == 1) {


                        $delivery_fee = $delivery_fee . "0";
                    }


                    $order_update['restaurant_delivery_fee'] = $restaurant_will_pay;
                    $order_update['total_distance_between_user_and_restaurant'] = $distance;
                    $order_update['delivery_fee_per_km'] = $restaurant_detail[0]['Tax']['delivery_fee_per_km'];
                    $order_update['delivery_free_range'] = $restaurant_detail[0]['Restaurant']['delivery_free_range'];

                    /*********/

                    $this->Order->id = $order_id;

                    if ($this->Order->save($order_update)) {


                        //$this->UserInfo->id = $user_id;

                        /*send an email*/

                        $user_details = $this->UserInfo->getUserDetailsFromID($user_id);

                        //$email_data['User'] = $user_details['User'];
                        $order_detail[0]['User'] = $user_details['User'];
                        $email_data['OrderDetail'] = $order_detail[0];

                        CustomEmail::sendEmailPlaceOrderToUser($email_data);
                        CustomEmail::sendEmailPlaceOrderToAdmin($email_data);
                        CustomEmail::sendEmailPlaceOrderToResmy($restaurant_detail_check["0"]["User"]["email"],$email_data);
                        /**********/


                    }


                }
                
                if ($delivery == 0) {

                    $order_update['restaurant_delivery_fee'] = 0;
                    $order_update['total_distance_between_user_and_restaurant'] = 0;
                    $order_update['delivery_fee_per_km'] = 0;
                    $order_update['delivery_free_range'] = 0;

                    $this->Order->id = $order_id;

                    if ($this->Order->save($order_update)) {


                        //$this->UserInfo->id = $user_id;

                        /*send an email*/

                        $user_details = $this->UserInfo->getUserDetailsFromID($user_id);

                        //$email_data['User'] = $user_details['User'];
                        $order_detail[0]['User'] = $user_details['User'];
                        $email_data['OrderDetail'] = $order_detail[0];

                        CustomEmail::sendEmailPlaceOrderToUser($email_data);
                        CustomEmail::sendEmailPlaceOrderToAdmin($email_data);
                        CustomEmail::sendEmailPlaceOrderToResmy($restaurant_detail_check["0"]["User"]["email"],$email_data);
                        /**********/


                    }


                }

                $output['code'] = 200;
                $output['msg'] = $order_detail;
                echo json_encode($output);
                die();
            }else{

                $output['code'] = 201;
                $output['msg'] = "user id or restaurant id do not exist";
                echo json_encode($output);
                die();


            }





        }
    }
    
    //keep
    public function placeDineInOrder()
    {
        
        $this->loadModel("Order");
        $this->loadModel("OrderMenuItem");
        $this->loadModel("OrderMenuExtraItem");
        $this->loadModel("Restaurant");
        $this->loadModel("User");
        $this->loadModel("UserInfo");


        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $order['user_id'] = '0';
            $order['delivery'] = '2';
            $order['deal_id'] = $data['table_id'];
            $order['restaurant_id'] = $data['restaurant_id'];
            $order['sub_total'] = $data['sub_total'];
            $order['price'] = $data['total'];
            $order['donation'] = 0;
            $order['created'] = $data['order_time'];
            $order['quantity'] = $data['quantity'];
            $order['cod'] = '2';
            $order['version'] = $data['version'];
            $order['device'] = $data['device'];
            
            $menu_item = $data['menu_item'];
            
            if ($this->Order->save($order)) {
                
                $order_id = $this->Order->getLastInsertId();

                for ($i = 0; $i < count($menu_item); $i++) {

                    $order_menu_item[$i]['name'] = $menu_item[$i]['menu_item_name'];
                    $order_menu_item[$i]['quantity'] = $menu_item[$i]['menu_item_quantity'];
                    $order_menu_item[$i]['price'] = $menu_item[$i]['menu_item_price'];
                    $order_menu_item[$i]['instructions'] = $menu_item[$i]['menu_item_instructions'];

                    $order_menu_item[$i]['order_id'] = $order_id;
                    $this->OrderMenuItem->saveAll($order_menu_item[$i]);
                    $order_menu_item_id = $this->OrderMenuItem->getLastInsertId();
                    if (array_key_exists('menu_extra_item', $menu_item[$i])) {

                        if (count($menu_item[$i]['menu_extra_item']) > 0 && $menu_item[$i]['menu_extra_item'] != "") {
                            for ($j = 0; $j < count($menu_item[$i]['menu_extra_item']); $j++) {


                                $order_menu_extra_item[$j]['name'] = $menu_item[$i]['menu_extra_item'][$j]['menu_extra_item_name'];
                                $order_menu_extra_item[$j]['quantity'] = $menu_item[$i]['menu_extra_item'][$j]['menu_extra_item_quantity'];
                                $order_menu_extra_item[$j]['price'] = $menu_item[$i]['menu_extra_item'][$j]['menu_extra_item_price'];
                                $order_menu_extra_item[$j]['order_menu_item_id'] = $order_menu_item_id;
                                $this->OrderMenuExtraItem->saveAll($order_menu_extra_item[$j]);
                            }
                        }
                    }
                }
                
                $order_detail = $this->Order->getOrderDetailBasedOnID($order_id);
                $restaurant_device_token = $this->UserInfo->getUserToken($order_detail[0]['Restaurant']['user_id']);
                
                /************notification*************/

                $notification['to'] =  $restaurant_device_token;
                $notification['notification']['title'] = "Dine In Order";
                $notification['notification']['body'] = 'Table #'.$order_detail[0]['Order']['deal_id'].' just placed an order from '.$order_detail[0]['Restaurant']['name'].'.';
                $notification['notification']['sound'] = 'alert.caf';
                $notification['data']['table_id'] = $order_detail[0]['Order']['deal_id'];
                $push_notification = PushNotification::sendPushNotificationToMobileDevice(json_encode($notification));

                /********end notification***************/
                
                $output['code'] = 200;
                $output['msg'] = 'Your dine in order is placed successfully!';
                echo json_encode($output);
                die();
                    
                
            } else {
                
                $output['code'] = 400;
                $output['msg'] = "Error. Please try again.";
                echo json_encode($output);
                die();
                
            }

        }
    }

    //keep
    public function showOrders()
    {

        $this->loadModel("Order");
        $this->loadModel("OrderDeal");
        $this->loadModel("RiderOrder");
        // $this->loadModel("RestaurantRating");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $user_id = $data['user_id'];

            $orders = $this->Order->getOrders($user_id);
        

            $output['code'] = 200;

            $output['msg'] = $orders; //Lib::convert_from_latin1_to_utf8_recursively($orders);
            // $output['CompletedOrders'] = $completed_orders;

            echo json_encode($output);


            die();





        }
    }
    
    public function getBanners()
    {
        $this->loadModel("AppSlider");
        
        if ($this->request->isPost()) {

            $result['mobile'] = $this->AppSlider->getMobileBanners();
            $result['desktop'] = $this->AppSlider->getDesktopBanners();
            
            $output['code'] = 200;
            $output['result'] = $result;
            echo json_encode($output);
            die();
        }
    }
    
    //keep
    public function showAppSliderImages()
    {

        $this->loadModel("AppSlider");


        if ($this->request->isPost()) {

            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);



            $images = $this->AppSlider->getImages();


            $output['code'] = 200;

            $output['msg'] = $images;
            echo json_encode($output);


            die();
        }
        
        if ($this->request->isGet()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);



            $images = $this->AppSlider->getImages();


            $output['code'] = 200;

            $output['msg'] = $images;
            echo json_encode($output);


            die();
        }
        
    }
    
    //kee?p
    public function showDistricts()
    {

        $this->loadModel("District");
        
        if ($this->request->isGet()) {


            $res = $this->District->getDistrictList();


            $output['code'] = 200;

            $output['msg'] = $res;
            echo json_encode($output);


            die();
        }
        
    }
    
    //keep
    public function getWebCoupon(){
        
        $this->loadModel("Coupon");
        
        if ($this->request->isPost()) {
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
            $dt->setTimestamp($timestamp);
            $datetime = $dt->format('Y-m-d H:i:s');
            
            $coupon = $this->Coupon->getWebCoupon($datetime);
            
            $output['code'] = 200;
            $output['msg'] = $coupon;
    
            echo json_encode($output);
            die();
        }
    }

    //keep
    public function verifyCoupon()
    {
        $this->loadModel("Coupon");
        $this->loadModel("CouponUsed");
        
        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $user       = $data['user_id'];
            $code       = $data['coupon_code'];
            $restaurant = $data['restaurant_id'];
            
            if(isset($data['current_time'])){
                $time = $data['current_time'];
            }else{
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
                $dt->setTimestamp($timestamp);
                $time = $dt->format('Y-m-d H:i:s');
            }
            
            if(isset($data['platform'])){
                $platform = $data['platform'];
            }else{
                $platform = '2';
            }
            
            if(isset($data['total'])){
                $total = $data['total'];
            }else{
                $total = '10';
            }
            
            $coupon = $this->Coupon->getCoupon($code, $restaurant, $platform, $time);
            
            if($coupon != null){
                if($coupon['Coupon']['user_limit']!=null){
                
                    $num = $this->CouponUsed->countCouponUsed($coupon['Coupon']['id']);
                    
                    if($num >= $coupon['Coupon']['user_limit']){
                        
                        $output['code'] = 201;
                        $output['msg'] = 'User limit reached for this coupon.';
                        echo json_encode($output);
                        die();
                        
                    }
                    
                }
                
                if($coupon['Coupon']['single_use'] == '1'){
                    
                    $use = $this->CouponUsed->checkIfUsedBefore($coupon['Coupon']['id'], $user);
                    
                    if($use != null){
                        $output['code'] = 201;
                        $output['msg'] = 'This coupon is valid for one-time use only.';
                        echo json_encode($output);
                        die();  
                    }
                    
                }
                
                if($coupon['Coupon']['min_amount'] != null){
                    if($total<$coupon['Coupon']['min_amount']){
                        $output['code'] = 201;
                        $output['msg'] = 'The min order amount for this coupon is: $' .$coupon['Coupon']['min_amount'].'.';
                        echo json_encode($output);
                        die();
                    }
                }
                
        
                $output['code'] = 200;
                $output['msg'] = $coupon;
    
                echo json_encode($output);
                die();
                
                
            }else{
                
                $output['code'] = 201;
                $output['msg'] = 'This coupon is invalid.';
    
                echo json_encode($output);
                die();
                
            }
            
        }
        
    }
    
    
    //keep
    function forgotPassword()
    {

        $this->loadModel('User');
        $this->loadModel('UserInfo');
        if ($this->request->isPost()) {


            $result = array();
            $json   = file_get_contents('php://input');

            $data = json_decode($json, TRUE);


            $email     = $data['email'];
            $user_info = $this->UserInfo->getUserDetailsFromEmail($email);

            $code     = Lib::randomNumber(4);

            if (!empty($user_info)) {


                $user_id = $user_info[0]['User']['id'];
                $email   = $user_info[0]['User']['email'];
                $first_name   = $user_info[0]['UserInfo']['first_name'];
                $last_name   = $user_info[0]['UserInfo']['last_name'];
                $full_name   = $first_name. ' '.$last_name;


                $response = CustomEmail::sendEmailResetPassword($email, $full_name,$code);




                if ($response) {

                    $this->User->id = $user_id;
                    $savedField     = $this->User->saveField('token', $code);
                    $result['code'] = 200;
                    $result['msg']  = "An email has been sent to " . $email . ". You should receive it shortly.";
                } else {

                    $result['code'] = 201;
                    $result['msg']  = "invalid email";


                }

            } else {

                $result['code'] = 201;
                $result['msg']  = "Email doesn't exist";
            }



            echo json_encode($result);
            die();
        }




    }


    //keep
    public function verifyforgotPasswordCode()
    {
        $this->loadModel('User');
        $this->loadModel('UserInfo');

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');

            $data = json_decode($json, TRUE);
            $code = $data['code'];
            $email = $data['email'];

            $code_verify = $this->User->verifyToken($code,$email);
            $user_info = $this->UserInfo->getUserDetailsFromEmail($email);
            if (!empty($code_verify)) {
                $this->User->id = $user_info[0]['User']['id'];
                $this->User->saveField('token',$code);

                $user_info = $this->UserInfo->getUserDetailsFromEmail($email);
                $result['code'] = 200;
                $result['msg']  = $user_info;
                echo json_encode($result);
                die();
            } else {
                $result['code'] = 201;
                $result['msg']  = "invalid code";
                echo json_encode($result);
                die();
            }
        }
    }

    //keep
    public function changePassword()
    {
        $this->loadModel('User');

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            //$json = $this->request->data('json');
            $data = json_decode($json, TRUE);


            $user_id        = $data['user_id'];
            $this->User->id = $user_id;
            $email          = $this->User->field('email');

            $old_password   = $data['old_password'];
            $new_password   = $data['new_password'];


            if ($this->User->verifyPassword($email, $old_password)) {

                $passwordBlowfishHasher = new BlowfishPasswordHasher();
                $this->request->data['password'] = $passwordBlowfishHasher->hash($new_password);
                $this->request->data['salt'] = Security::hash($new_password, 'sha256', true);
                $this->User->id                  = $user_id;


                if ($this->User->save($this->request->data)) {

                    echo Message::DATASUCCESSFULLYSAVED();

                    die();
                } else {


                    echo Message::DATASAVEERROR();
                    die();


                }

            } else {

                echo Message::INCORRECTPASSWORD();
                die();

            }


        }

    }

    //keep
    public function changePasswordForgot()
    {
        $this->loadModel('User');
        $this->loadModel('UserInfo');

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            //$json = $this->request->data('json');
            $data = json_decode($json, TRUE);


            $user_id        = $data['user_id'];
            $this->User->id = $user_id;



            $new_password   = $data['password'];
            
            $passwordBlowfishHasher = new BlowfishPasswordHasher();
            $this->request->data['password'] = $passwordBlowfishHasher->hash($new_password);
            $this->request->data['salt'] = Security::hash($new_password, 'sha256', true);
            $this->User->id                  = $user_id;


                if ($this->User->save($this->request->data)) {

                    $user_info = $this->UserInfo->getUserDetailsFromID($user_id);
                    $result['code'] = 200;
                    $result['msg']  = $user_info;
                    echo json_encode($result);
                    die();
                } else {


                    echo Message::DATASAVEERROR();
                    die();


                }

            } else {

                echo Message::INCORRECTPASSWORD();
                die();




        }

    }
    
    //keep
    public function getPopularItemsByRestaurant(){
        $this->loadModel('Order');
        $this->loadModel('OrderMenuItem');
        $this->loadModel('RestaurantMenu');
        $this->loadModel('RestaurantMenuItem');
        $this->loadModel('RestaurantMenuExtraItem');
        
        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $restaurant_id = $data['restaurant_id'];
            $orders = $this->Order->getOrdersByRestaurant($restaurant_id);
            
            $order_items = array();
            
            foreach($orders as $o){
                $order = $this->OrderMenuItem->getMenuItemStat($o['Order']['id']);
                $order_items = array_merge($order_items, $order);
            }
            
            $order_items_grouped = array();
            
            for ($i = 0; $i < count($order_items); $i++) {
                if(strpos($order_items[$i]['OrderMenuItem']['name'], 'Naan') !== false || strpos($order_items[$i]['OrderMenuItem']['name'], 'Roti') !== false){
                    continue;
                }else{
                    $new = true;
                    for($j = 0; $j < count($order_items_grouped); $j++){
                        if($order_items[$i]['OrderMenuItem']['name'] == $order_items_grouped[$j]['name']){
                            $order_items_grouped[$j]['quantity'] = $order_items_grouped[$j]['quantity'] + $order_items[$i]['OrderMenuItem']['quantity'];
                            $new = false;
                        }
                    }
                    if($new){
                        array_push($order_items_grouped, $order_items[$i]['OrderMenuItem']);
                    }
                }
            }
            
            function simple_quick_sort($arr)
            {
                if(count($arr) <= 1){
                    return $arr;
                }
                else{
                    $pivot = $arr[0];
                    $left = array();
                    $right = array();
                    for($i = 1; $i < count($arr); $i++)
                    {
                        if($arr[$i]['quantity'] > $pivot['quantity']){
                            $left[] = $arr[$i];
                        }
                        else{
                            $right[] = $arr[$i];
                        }
                    }
                    return array_merge(simple_quick_sort($left), array($pivot), simple_quick_sort($right));
                }
            }
            
            $sorted = simple_quick_sort($order_items_grouped);
            $test = $sorted;
            if(count($sorted)>8){
                $sorted = array_slice($sorted, 0, 8);
            }
            
            $menus = $this->RestaurantMenu->getMenuIDsFromID($restaurant_id);
            $id_list = array();
            
            foreach($menus as $m){
                array_push($id_list, $m['RestaurantMenu']['id']);
            }
            
            $menu_items = array();
            
            foreach($sorted as $s){
                $item = $this->RestaurantMenuItem->getMenuItemFromName($s['name'], $id_list);
                if($item != null){
                    $temp = $item['RestaurantMenuItem'];
                    $temp['RestaurantMenuExtraSection'] = $item['RestaurantMenuExtraSection'];
                    if(count($item['RestaurantMenuExtraSection'])>0){
                        $extra_items = array();
                        foreach($item['RestaurantMenuExtraSection'] as $extra){
                            $extra_item = $this->RestaurantMenuExtraItem->getExtraItemsMobile($extra['id']);
                            $items = array();
                            foreach($extra_item as $e){
                                array_push($items, $e['RestaurantMenuExtraItem']);
                            }
                            $extra['RestaurantMenuExtraItem'] = $items;
                            array_push($extra_items, $extra);
                        }
                        $temp['RestaurantMenuExtraSection'] = $extra_items;
                    }
                    array_push($menu_items, $temp);
                }
            }
            
            $output['code'] = 200;
            $output['msg'] = $menu_items;
            $output['top'] = $test;
            echo json_encode($output);
            die();
        }
        
    }
    
    //keep
    public function subscribeToNewsletter() {
        
        $this->loadModel('Subscriber');
        $this->loadModel('User');
        
        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $user = $this->User->getUserDetailsAgainstEmail($data['email']);
            
            $data['name'] = $user['UserInfo']['first_name'].' '.$user['UserInfo']['last_name'];
            $data['phone'] = $user['UserInfo']['phone'];
            
            if($this->Subscriber->isDuplicateRecord($data) == 0){
                $this->Subscriber->save($data);
            }
            
            $output['code'] = 200;
            $output['msg'] = 'You have successfully signed up for our newsletter!';
            echo json_encode($output);
            die();
            
        }
        
    }
    
    public function subscribe() {
        $this->loadModel('Subscriber');
        
        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if($this->Subscriber->isDuplicateRecord($data) == 0){
                $this->Subscriber->save($data);
            }
            
            $output['code'] = 200;
            $output['msg'] = 'You have successfully signed up for our newsletter!';
            echo json_encode($output);
            die();
            
        }
    }

}




?>