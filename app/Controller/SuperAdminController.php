<?php
App::uses('Lib', 'Utility');
App::uses('Firebase', 'Lib');
App::uses('Postmark', 'Utility');
App::uses('Message', 'Utility');

App::uses('CustomEmail', 'Utility');
App::uses('Security', 'Utility');
App::uses('PushNotification', 'Utility');

class SuperAdminController extends AppController
{


    public $autoRender = false;
    public $layout = false;
    
    public function adminLogin()
    {
        $this->loadModel('UserAdmin');

        if ($this->request->isPost()) {

            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $email = strtolower($data['email']);
            $password = $data['password'];

            if ($email != null && $password != null) {
                
                $count = $this->UserAdmin->emailExists($email);
                
                if ( $count < 1) {
                    
                    $output['code'] = 201;
                    $output['msg']  = "Please register this admin email first.";
                    
                    echo json_encode($output);
                    die();
                }
                
                if($this->UserAdmin->verify($email, $password)){
                    $output['code'] = 200;
                    $output['token'] = 'temporary_token';
                    echo json_encode($output);
                }else{
                    echo Message::INVALIDDETAILS();
                    die();
                }

            } else {
                echo Message::ERROR();
                die();
            }
        }

    }
    
    public function showDashboardData()
    {
        $this->loadModel("Order");
        $this->loadModel("User");
        
        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if(isset($data['option'])){
                
                if($data['option'] == 'week'){
                    $zone = new DateTimeZone('Asia/Hong_Kong');
                    $end = new DateTime("now", $zone);
                    $end_date = $end->format('Y-m-d');
                    
                    $start = new DateTime("now", $zone);
                    $start->sub(new DateInterval('P6D'));
                    $start_date = $start->format('Y-m-d');
                    
                    $p_end = $end;
                    $p_end->sub(new DateInterval('P7D'));
                    $prev_end = $p_end->format('Y-m-d');
                    
                    $p_start = $p_end;
                    $p_start->sub(new DateInterval('P6D'));
                    $prev_start = $p_start->format('Y-m-d');
                } else if ($data['option'] == 'month'){
                    $zone = new DateTimeZone('Asia/Hong_Kong');
                    $end = new DateTime("now", $zone);
                    $end_date = $end->format('Y-m-d');
                    
                    $start = new DateTime("now", $zone);
                    $start->sub(new DateInterval('P29D'));
                    $start_date = $start->format('Y-m-d');
                    
                    $p_end = $end;
                    $p_end->sub(new DateInterval('P30D'));
                    $prev_end = $p_end->format('Y-m-d');
                    
                    $p_start = $p_end;
                    $p_start->sub(new DateInterval('P29D'));
                    $prev_start = $p_start->format('Y-m-d');
                }
                
                $current_earnings = $this->Order->getTotalEarningsByDate($start_date,$end_date);
                $prev_earnings = $this->Order->getTotalEarningsByDate($prev_start, $prev_end);
                
                $output['current'] = $current_earnings[0][0];
                $output['previous'] = $prev_earnings[0][0];
                
                $current_count = $this->User->getUserCountByDate($start_date, $end_date);
                $prev_count = $this->User->getUserCountByDate($prev_start, $prev_end);
                
                $output['current']['user_count'] = $current_count;
                $output['previous']['user_count'] = $prev_count;
                
                $order_data = $this->Order->getDailyOrdersByDate($start_date, $end_date);
                $order_stats = array();
                
                foreach($order_data as $data){
                    $new_data = $data[0];
                    $new_data['date'] = date("M d", strtotime($data[0]['date']));  
                    array_push($order_stats, $new_data);
                }
                
                $output['order_stats'] = $order_stats;
                
                $devices = $this->Order->getOrderDeviceByDate($start_date, $end_date);
                $order_device = array();
                
                foreach($devices as $d){
                    $device = $d[0];
                    $device['value'] = floatval($d[0]['value']);
                    $device['name'] = $d['Order']['device'];
                    array_push($order_device, $device);
                }
                
                $output['order_device'] = $order_device;
                
                $items = $this->Order->getTopMenuItemsByDate($start_date, $end_date);
                $output['top_items'] = $items;
                echo json_encode($output);
                die();
                
            }
        }
        
    }
    
    public function showAnalyticsData()
    {
        $this->loadModel("Order");
        $this->loadModel("User");
        $this->loadModel("Address");
        
        if ($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if(isset($data['start_date']) && isset($data['end_date'])){
                
                if($data['option'] == 'week'){
                    $zone = new DateTimeZone('Asia/Hong_Kong');
                    $end = new DateTime("now", $zone);
                    $end_date = $end->format('Y-m-d');
                    
                    $start = new DateTime("now", $zone);
                    $start->sub(new DateInterval('P6D'));
                    $start_date = $start->format('Y-m-d');
                    
                    $p_end = $end;
                    $p_end->sub(new DateInterval('P7D'));
                    $prev_end = $p_end->format('Y-m-d');
                    
                    $p_start = $p_end;
                    $p_start->sub(new DateInterval('P6D'));
                    $prev_start = $p_start->format('Y-m-d');
                    
                } else if ($data['option'] == 'month'){
                    
                    $zone = new DateTimeZone('Asia/Hong_Kong');
                    $end = new DateTime("now", $zone);
                    $end_date = $end->format('Y-m-d');
                    
                    $start = new DateTime("now", $zone);
                    $start->sub(new DateInterval('P29D'));
                    $start_date = $start->format('Y-m-d');
                    
                    $p_end = $end;
                    $p_end->sub(new DateInterval('P30D'));
                    $prev_end = $p_end->format('Y-m-d');
                    
                    $p_start = $p_end;
                    $p_start->sub(new DateInterval('P29D'));
                    $prev_start = $p_start->format('Y-m-d');
                }
                
                $current_earnings = $this->Order->getTotalEarningsByDate($start_date,$end_date);
                $prev_earnings = $this->Order->getTotalEarningsByDate($prev_start, $prev_end);
                
                $output['current'] = $current_earnings[0][0];
                $output['previous'] = $prev_earnings[0][0];
                
                $current_count = $this->User->getUserCountByDate($start_date, $end_date);
                $prev_count = $this->User->getUserCountByDate($prev_start, $prev_end);
                
                $output['current']['user_count'] = $current_count;
                $output['previous']['user_count'] = $prev_count;
                
                $order_data = $this->Order->getDailyOrdersByDate($start_date, $end_date);
                $order_stats = array();
                
                foreach($order_data as $data){
                    $new_data = $data[0];
                    $new_data['date'] = date("M d", strtotime($data[0]['date']));  
                    array_push($order_stats, $new_data);
                }
                
                $output['order_stats'] = $order_stats;
                
                $devices = $this->Order->getOrderDeviceByDate($start_date, $end_date);
                $order_device = array();
                
                foreach($devices as $d){
                    $device = $d[0];
                    $device['value'] = floatval($d[0]['value']);
                    $device['name'] = $d['Order']['device'];
                    array_push($order_device, $device);
                }
                
                $output['order_device'] = $order_device;
                
                $items = $this->Order->getTopMenuItemsByDate($start_date, $end_date);
                $output['top_items'] = $items;
                echo json_encode($output);
                die();
                
            }else{
                
                $current_earnings = $this->Order->getTotalEarnings();
                $output['current'] = $current_earnings[0][0];
                
                $current_count = $this->User->getUsersCount('user');
                $output['current']['user_count'] = $current_count;
                
                /*$order_data = $this->Order->getMonthlyOrder();
                $order_stats = array();
                
                foreach($order_data as $data){
                    $new_data = $data[0];
                    $new_data['date'] = date("YY MM", strtotime($data[0]['date']));  
                    array_push($order_stats, $new_data);
                }
                
                $output['order_stats'] = $order_stats;*/
                
                $devices = $this->Order->getOrderDevice();
                $order_device = array();
                
                foreach($devices as $d){
                    $device = $d[0];
                    $device['value'] = floatval($d[0]['value']);
                    $device['name'] = $d['Order']['device'];
                    array_push($order_device, $device);
                }
                
                $output['order_device'] = $order_device;
                
                $items = $this->Order->getTopMenuItems();
                $output['top_items'] = $items;
                
                $addresses = $this->Order->getOrderAddresses();
                $output['addresses'] = $addresses;
                echo json_encode($output);
                die();
            }
        }
        
    }
    
    public function getAllDistricts()
    {
        $this->loadModel('District');
        
        if($this->request->isPost()){
            
            $districts = $this->District->getDistrictList();
            $result = array();
            
            foreach($districts as $d){
                $district = $d['District'];
                $district['radius'] = intval($d['District']['radius']);
                array_push($result, $district);
            }
            
            echo json_encode($result);
            die();
        }
    }
    
    public function addDistrict()
    {
        $this->loadModel('District');
        
        if($this->request->isPost()){
        
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $districts = $this->District->getDistrictList();
            $id = $districts[count($districts)-2]['District']['id'] + 1;
            
            $data['id'] = $id;
            
            if(!$this->District->save($data)){
                echo Message::DATASAVEERROR();
                die();
            }else{
                $districts = $this->District->getDistrictList();
                $result = array();
                
                foreach($districts as $d){
                    $district = $d['District'];
                    $district['radius'] = intval($d['District']['radius']);
                    array_push($result, $district);
                }
                
                echo json_encode($result);
                die();
            }
        
        }
    }
    
    public function deleteDistrict()
    {
        $this->loadModel('District');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if(!$this->District->delete($data['id'])){
                echo Message::DATADELETEERROR();
                die();
            }else{
                $districts = $this->District->getDistrictList();
                $result = array();
                
                foreach($districts as $d){
                    $district = $d['District'];
                    $district['radius'] = intval($d['District']['radius']);
                    array_push($result, $district);
                }
                
                echo json_encode($result);
                die();
            }
        }
    }
    
    public function updateDistrict()
    {
        $this->loadModel('District');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->District->id = $data['id'];
            $this->District->saveField($data['field'], $data['value']);
            
            $districts = $this->District->getDistrictList();
            $result = array();
            
            foreach($districts as $d){
                $district = $d['District'];
                $district['radius'] = intval($d['District']['radius']);
                array_push($result, $district);
            }
            
            echo json_encode($result);
            die();
        }
    }
    
    public function showAllKitchens()
    {
        $this->loadModel("Kitchen");
        
        if($this->request->isPost()){
            $kitchens = $this->Kitchen->getAllKitchens();
            
            $output['code'] = 200;
            $output['msg'] = $kitchens;
            echo json_encode($output);

            die();
        }
    }
    
    public function addKitchen()
    {
        $this->loadModel("Kitchen");
        
        if($this->request->isPost()){
        
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if(!$this->Kitchen->save($data)){
                echo Message::DATASAVEERROR();
                die();
            }else{
                $kitchens = $this->Kitchen->getAllKitchens();
            
                $output['code'] = 200;
                $output['msg'] = $kitchens;
                echo json_encode($output);
                die();
                
            }
        }
        
    }
    
    public function deleteKitchen()
    {
        $this->loadModel('Kitchen');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->Kitchen->delete($data['id']);
            
            $kitchens = $this->Kitchen->getAllKitchens();
            
            $output['code'] = 200;
            $output['msg'] = $kitchens;
            echo json_encode($output);
            die();
        }
    }
    
    public function updateKitchen()
    {
        $this->loadModel('Kitchen');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->Kitchen->id = $data['id'];
            $this->Kitchen->saveField($data['field'], $data['value']);
            
            $kitchens = $this->Kitchen->getAllKitchens();
            
            $output['code'] = 200;
            $output['msg'] = $kitchens;
            echo json_encode($output);
            die();
        }
    }
    
    public function showAllRestaurants()
    {

        $this->loadModel("Restaurant");

        if ($this->request->isPost()) {

            //$active = $this->Restaurant->getActiveRestaurants();
            //$blocked = $this->Restaurant->getNonActiveRestaurants();
            
            $restaurants = $this->Restaurant->getAllRestaurants();

            $output['code'] = 200;
            $output['restaurants'] = $restaurants;
            
            echo json_encode($output);
            die();
        }
    }
    
    public function addRestaurant()
    {
        $this->loadModel("User");
        $this->loadModel('UserInfo');
        $this->loadModel("Restaurant");

        if ($this->request->isPost()) {
            
            if ($_POST['email'] != null){
                
                $user['email'] = strtolower($_POST['email']);
                $user['role'] = 'hotel';
                $user['active'] = '1';
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong'));
                $dt->setTimestamp($timestamp);
                $user['created'] = $dt->format('Y-m-d H:i:s');

                $count = $this->User->isEmailAlreadyExist($_POST['email']);

                if ($count && $count > 0) {
                    
                    echo Message::DATAALREADYEXIST();
                    die();

                } else {

                    if (!$this->User->save($user)) {
                        echo Message::DATASAVEERROR();
                        die();
                    }

                    $user_id = $this->User->id;
                    
                    $user_info['user_id'] = $user_id;
                    $user_info['first_name'] = $_POST['name'];
                    $user_info['last_name'] = 'Restaurant';

                    if (!$this->UserInfo->save($user_info)) {
                        echo Message::DATASAVEERROR();
                        die();
                    }
                    
                    $restaurant['name'] = $_POST['name'];
                    $restaurant['slogan'] = $_POST['slogan'];
                    $restaurant['kitchen_id'] = $_POST['kitchen'];
                    $restaurant['self_pickup'] = $_POST['self_pickup'];
                    $restaurant['user_id'] = $user_id;
                    $restaurant['block'] = '1';
                    $restaurant['created'] = $user['created'];
                    
                    if(!$this->Restaurant->save($restaurant)){
                        
                        echo Message::DATASAVEERROR();
                        die();
                        
                    }else{
                        
                        $id = $this->Restaurant->id;
                        
                        if(!empty($_FILES)){
                
                            if(array_key_exists('logo', $_FILES)){
                                if (!file_exists(UPLOADS_FOLDER_URI.'/'.$id)) {
                                    mkdir(UPLOADS_FOLDER_URI.'/'.$id , 0777, true);
                                }
                                $logo = UPLOADS_FOLDER_URI.'/'.$id.'/logo.'.pathinfo( $_FILES["logo"]["name"], PATHINFO_EXTENSION );
                                move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
                                $this->Restaurant->saveField('image', $logo);
                                $output['logo'] = $logo;
                            }
                            
                            if(array_key_exists('cover', $_FILES)){
                                if (!file_exists(UPLOADS_FOLDER_URI.'/'.$id)) {
                                    mkdir(UPLOADS_FOLDER_URI.'/'.$id, 0777, true);
                                }
                                $cover = UPLOADS_FOLDER_URI.'/'.$id.'/cover.'.pathinfo( $_FILES["cover"]["name"], PATHINFO_EXTENSION );
                                move_uploaded_file($_FILES['cover']['tmp_name'], $cover);
                                $this->Restaurant->saveField('cover_image', $cover);
                                $output['cover'] = $cover;
                            }
                            
                            if(array_key_exists('banner', $_FILES)){
                                if (!file_exists(UPLOADS_FOLDER_URI.'/'.$id)) {
                                    mkdir(UPLOADS_FOLDER_URI.'/'.$id, 0777, true);
                                }
                                $banner = UPLOADS_FOLDER_URI.'/'.$id.'/banner.'.pathinfo( $_FILES["banner"]["name"], PATHINFO_EXTENSION );
                                move_uploaded_file($_FILES['banner']['tmp_name'], $banner);
                                $this->Restaurant->saveField('banner', $banner);
                                $output['banner'] = $banner;
                            }
                        }
            
                        $output['code'] = 200;
                        $output['id'] = $id;
                        
                        echo json_encode($output);
                        die();
                        
                    }

                }
            } else {
                echo Message::ERROR();
            }
        }
    }
    
    public function updateRestaurantStatus()
    {
        $this->loadModel('Restaurant');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->Restaurant->id = $data['id'];
            if($this->Restaurant->saveField('block', $data['block'])){
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
            }else{
                echo Message::DATASAVEERROR();
                die();
            }
        }
    }
    
    public function updateRestaurant()
    {
        $this->loadModel("User");
        $this->loadModel("Restaurant");
        
        if($this->request->isPost()){
            
            $this->Restaurant->id = $_POST['restaurant_id'];
            
            if(!empty($_FILES)){
                
                if(array_key_exists('logo', $_FILES)){
                    if (!file_exists(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'])) {
                        mkdir(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'], 0777, true);
                    }
                    $logo = UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'].'/logo.'.pathinfo( $_FILES["logo"]["name"], PATHINFO_EXTENSION );
                    move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
                    $this->Restaurant->saveField('image', $logo);
                    $output['logo'] = $logo;
                }
                
                if(array_key_exists('cover', $_FILES)){
                    if (!file_exists(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'])) {
                        mkdir(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'], 0777, true);
                    }
                    $cover = UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'].'/cover.'.pathinfo( $_FILES["cover"]["name"], PATHINFO_EXTENSION );
                    move_uploaded_file($_FILES['cover']['tmp_name'], $cover);
                    $this->Restaurant->saveField('cover_image', $cover);
                    $output['cover'] = $cover;
                }
                
                if(array_key_exists('banner', $_FILES)){
                    if (!file_exists(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'])) {
                        mkdir(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'], 0777, true);
                    }
                    $banner = UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'].'/banner.'.pathinfo( $_FILES["banner"]["name"], PATHINFO_EXTENSION );
                    move_uploaded_file($_FILES['banner']['tmp_name'], $banner);
                    $this->Restaurant->saveField('banner', $banner);
                    $output['banner'] = $banner;
                }
            }
            
            if( $this->Restaurant->saveField('name', $_POST['name']) &&
                $this->Restaurant->saveField('slogan', $_POST['slogan']) &&
                $this->Restaurant->saveField('kitchen_id', $_POST['kitchen']) &&
                $this->Restaurant->saveField('self_pickup', $_POST['self_pickup']))
            {
                $user_id = $this->Restaurant->getUserID($_POST['restaurant_id']);
                $this->User->id = $user_id;
                
                if($this->User->saveField('email', $_POST['email'])){
                    
                    $output['code'] = 200;
                    echo json_encode($output);
                    
                    die();
                    
                }else{
                    
                    echo 'There was an error updating the email.';
                    die();
                    
                }
            }else{
                
                echo 'There was an error updating the restaurant info.';
                die();
                
            }
        }
    }
    
    public function deleteRestaurant()
    {
        $this->loadModel("User");
        $this->loadModel('UserInfo');
        $this->loadModel('Restaurant');
        $this->loadModel("RestaurantMenu");
        $this->loadModel("RestaurantMenuItem");
        $this->loadModel('RestaurantMenuExtraSection');
        $this->loadModel('RestaurantMenuExtraItem');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $menus = $this->RestaurantMenu->getMenuIds($data['restaurant_id']);
            
            if(!empty($menus)){
                
                foreach($menus as $menu){
                    
                    $menu_items = $this->RestaurantMenuItem->getMenuItemIds($menu);
            
                    if(!empty($menu_items)){
                        
                        foreach($menu_items as $id) {
                            
                            $extra_sections = $this->RestaurantMenuExtraSection->getExtraSectionIds($id);
                            
                            if(!empty($extra_sections)){
                                
                                foreach($extra_sections as $extra) {
                                    
                                    $this->RestaurantMenuExtraItem->deleteMenuExtraItems($extra);
                                    
                                    if(!$this->RestaurantMenuExtraSection->delete($extra)){
                                        
                                        echo 'Extra Section Error';
                                        die();
                                        
                                    }
                
                                }
                                
                            }
                            
                            $image = $this->RestaurantMenuItem->getImage($id);
                            @unlink($image);
                            
                            if(!$this->RestaurantMenuItem->delete($id)){
                                echo 'Menu Item Error';
                                die();
                            }
                        }
                        
                    }
            
                    if(!$this->RestaurantMenu->delete($menu)){
                        echo 'Menu Error';
                        die();
                    }
                    
                }
            }
            
            $user_id = $this->Restaurant->getUserID($data['restaurant_id']);
            
            if($this->User->delete($user_id) && $this->UserInfo->delete($user_id)){
                
                $banner = $this->Restaurant->getBanner($data['restaurant_id']);
                @unlink($banner);
                
                $logo = $this->Restaurant->getLogo($data['restaurant_id']);
                @unlink($logo);
                
                $cover = $this->Restaurant->getCover($data['restaurant_id']);
                @unlink($cover);
                
                if($this->Restaurant->delete($data['restaurant_id'])){
                    
                    if (file_exists(UPLOADS_FOLDER_URI.'/'.$data['restaurant_id'])) {
                        rmdir(UPLOADS_FOLDER_URI.'/'.$data['restaurant_id']);
                    }
                
                    echo Message::DELETEDSUCCESSFULLY();
                    die();
                
                }else{
                    
                    echo Message::DATADELETEERROR();
                    die();
                }
                
            }else{
                
                echo Message::DATADELETEERROR();
                die();
                
            }
            
        }
    }
    
    public function showRestaurantTiming()
    {
        $this->loadModel("RestaurantTiming");
        
        if($this->request->isPost()) {
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $id = $data['id'];
            $timing = $this->RestaurantTiming->getTiming($id);
            
            $output['code'] = 200;
            $output['timing'] = $timing;
            echo json_encode($output);
            
            die();
            
        }
    }
    
    public function showRestaurantMenu()
    {
        $this->loadModel("Restaurant");
        $this->loadModel("RestaurantMenu");
        $this->loadModel("RestaurantMenuItem");
        $this->loadModel("RestaurantMenuExtraSection");
        $this->loadModel("RestaurantMenuExtraItem");

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);

            $restaurant_id = $data['restaurant_id'];

            $menus = $this->RestaurantMenu->getMenu($restaurant_id);
            $name = $this->Restaurant->getName($restaurant_id);

            $output['code'] = 200;
            $output['name'] = $name;
            $output['menus'] = $menus;
            echo json_encode($output);
            
            die();
        }
    }
    
    public function addRestaurantMenu()
    {
        $this->loadModel('RestaurantMenu');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            $data['has_menu_item'] = 1;
            
            if(!$this->RestaurantMenu->save($data)){
                
                echo Message::DATASAVEERROR();
                die();
                
            } else {
                $id = $this->RestaurantMenu->id;

                $output['code'] = 200;
                $output['id'] = $id;
                echo json_encode($output);
                
                die();
            }
            
        }
    }
    
    public function changeRestaurantMenuName()
    {
        $this->loadModel('RestaurantMenu');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->RestaurantMenu->id = $data['id'];
            if($this->RestaurantMenu->saveField('name', $data['name'])){
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
            }else{
                echo Message::DATASAVEERROR();
                die();
            }
        }
    }
    
    public function changeRestaurantMenuStatus()
    {
        $this->loadModel('RestaurantMenu');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->RestaurantMenu->id = $data['id'];
            
            if($this->RestaurantMenu->saveField('active', $data['active'])){
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
            }else{
                echo Message::DATASAVEERROR();
                die();
            }
        }
        
    }
    
    public function deleteRestaurantMenu()
    {
        $this->loadModel("RestaurantMenu");
        $this->loadModel("RestaurantMenuItem");
        $this->loadModel('RestaurantMenuExtraSection');
        $this->loadModel('RestaurantMenuExtraItem');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $menu_items = $this->RestaurantMenuItem->getMenuItemIds($data['menu_id']);
            
            if(!empty($menu_items)){
                foreach($menu_items as $id) {
                    $extra_sections = $this->RestaurantMenuExtraSection->getExtraSectionIds($id);
                    if(!empty($extra_sections)){
                        foreach($extra_sections as $extra) {
                            $this->RestaurantMenuExtraItem->deleteMenuExtraItems($extra);
                        }
                        if(!$this->RestaurantMenuExtraSection->deleteMenuExtraSections($id)){
                           echo Message::DATADELETEERROR();
                           die();
                        }
                    }
                    $image = $this->RestaurantMenuItem->getImage($id);
                    @unlink($image);
                    
                    if(!$this->RestaurantMenuItem->delete($id)){
                        echo Message::DATADELETEERROR();
                        die();
                    }
                }
            }
            
            if($this->RestaurantMenu->delete($data['menu_id'])){
                
                echo Message::DELETEDSUCCESSFULLY();
                die();
                
            }else{
                
                echo Message::DATADELETEERROR();
                die();
            }
        }
    }
    
    public function addRestaurantMenuItem()
    {
        $this->loadModel("RestaurantMenuItem");
        
        if($this->request->isPost()){
            
            $item['name'] = $_POST['name'];
            $item['description'] = $_POST['description'];
            $item['price'] = $_POST['price'];
            $item['active'] = '1';
            if(isset($_POST['old_price'])){
                $item['old_price'] = $_POST['old_price'];
            }else{
                $item['old_price'] = null;
            }
            $item['restaurant_menu_id'] = $_POST['restaurant_menu_id'];
            
            if( $this->RestaurantMenuItem->save($item))
            {
                $id = $this->RestaurantMenuItem->id;
                
                if(!empty($_FILES)){
                
                    if(array_key_exists('image', $_FILES)){
                        if (!file_exists(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'])) {
                            mkdir(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'], 0777, true);
                        }
                        $image = UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'].'/'.$id.'.'.pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION );
                        move_uploaded_file($_FILES['image']['tmp_name'], $image);
                        $this->RestaurantMenuItem->saveField('image', $image);
                        $output['image'] = $image;
                    }
                }
                
                $output['code'] = 200;
                $output['id'] = $id;
                echo json_encode($output);
                die();
                
            }else{
                
                echo Message::DATASAVEERROR();
                die();
            }
        }
    }
    
    public function updateRestaurantMenuItem()
    {
        $this->loadModel("RestaurantMenuItem");
        
        if($this->request->isPost()){
            
            $this->RestaurantMenuItem->id = $_POST['id'];
            
            if(!empty($_FILES)){
                
                if(array_key_exists('image', $_FILES)){
                    if (!file_exists(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'])) {
                        mkdir(UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'], 0777, true);
                    }
                    $image = UPLOADS_FOLDER_URI.'/'.$_POST['restaurant_id'].'/'.$_POST['id'].'.'.pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION );
                    move_uploaded_file($_FILES['image']['tmp_name'], $image);
                    $this->RestaurantMenuItem->saveField('image', $image);
                    $output['image'] = $image;
                }
            }
            
            if(isset($_POST['old_price'])){
                $old_price = $_POST['old_price'];
            }else{
                $old_price = null;
            }
            
            if( $this->RestaurantMenuItem->saveField('name', $_POST['name']) &&
                $this->RestaurantMenuItem->saveField('description', $_POST['description']) &&
                $this->RestaurantMenuItem->saveField('price', $_POST['price']) &&
                $this->RestaurantMenuItem->saveField('old_price', $old_price))
            {
                
                $output['code'] = 200;
                echo json_encode($output);
                die();
                
            }else{
                
                echo Message::DATASAVEERROR();
                die();
            }
        }
    }
    
    public function updateRestaurantMenuItemStatus()
    {
        $this->loadModel("RestaurantMenuItem");
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->RestaurantMenuItem->id = $data['id'];
            
            if($this->RestaurantMenuItem->saveField('active', $data['active'])){
                
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
                
            }else{
                
                echo Message::DATASAVEERROR();
                die();
                
            }
            
        }
    
    }
    
    public function deleteRestaurantMenuItem()
    {
        $this->loadModel("RestaurantMenuItem");
        $this->loadModel('RestaurantMenuExtraSection');
        $this->loadModel('RestaurantMenuExtraItem');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $extra_sections = $this->RestaurantMenuExtraSection->getExtraSectionIds($data['menu_item_id']);
                
            if(!empty($extra_sections)){
                foreach($extra_sections as $id) {
                    $this->RestaurantMenuExtraItem->deleteMenuExtraItems($id);
                }
                if(!$this->RestaurantMenuExtraSection->deleteMenuExtraSections($data['menu_item_id'])){
                   echo Message::DATADELETEERROR();
                   die();
                }
            }
            
            $image = $this->RestaurantMenuItem->getImage($data['menu_item_id']);
            @unlink($image);
            
            if($this->RestaurantMenuItem->delete($data['menu_item_id'])){
                
                echo Message::DELETEDSUCCESSFULLY();
                die();
                
            }else{
                
                echo Message::DATADELETEERROR();
                die();
            }
        }
    }
    
    public function addRestaurantMenuExtraSection()
    {
        $this->loadModel('RestaurantMenuExtraSection');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if($this->RestaurantMenuExtraSection->save($data)){
                
                $output['code'] = 200;
                $output['id'] = $this->RestaurantMenuExtraSection->id;
                echo json_encode($output);
                die();
                
            } else {
                
                echo Message::DATASAVEERROR();
                die();
                
            }
            
        }
    }
    
    public function renameRestaurantMenuExtraSection()
    {
        $this->loadModel('RestaurantMenuExtraSection');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->RestaurantMenuExtraSection->id = $data['extra_section_id'];
            
            if($this->RestaurantMenuExtraSection->saveField('name', $data['name'])){
                
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
                
            }else{
                
                echo Message::DATASAVEERROR();
                die();
                
            }
        }
        
    }
    
    public function updateRestaurantMenuExtraSection()
    {
        $this->loadModel('RestaurantMenuExtraSection');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->RestaurantMenuExtraSection->id = $data['id'];
            
            if($this->RestaurantMenuExtraSection->saveField('required', $data['required'])){
                
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
                
            }else{
                
                echo Message::DATASAVEERROR();
                die();
                
            }
        }
    }
    
    public function updateRestaurantMenuExtraSectionStatus()
    {
        $this->loadModel('RestaurantMenuExtraSection');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            $this->RestaurantMenuExtraSection->id = $data['id'];
            
            if($this->RestaurantMenuExtraSection->saveField('active', $data['active'])){
                
                echo Message::DATASUCCESSFULLYUPDATED();
                die();
                
            }else{
                
                echo Message::DATASAVEERROR();
                die();
                
            }
        }
    }
    
    public function deleteRestaurantMenuExtraSection()
    {
        $this->loadModel('RestaurantMenuExtraSection');
        $this->loadModel('RestaurantMenuExtraItem');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if($this->RestaurantMenuExtraItem->deleteMenuExtraItems($data['extra_section_id'])){
                
                if($this->RestaurantMenuExtraSection->delete($data['extra_section_id'])){
                    
                    echo Message::DELETEDSUCCESSFULLY();
                    die();
                    
                }else{
                    
                    echo Message::DATADELETEERROR();
                    die();
                }
                
            }else{
                
                echo Message::DATADELETEERROR();
                die();
            }
        }
    }
    
    public function addRestaurantMenuExtraItem()
    {
        $this->loadModel('RestaurantMenuExtraItem');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if($this->RestaurantMenuExtraItem->save($data)) {
                $output['code'] = 200;
                $output['id'] = $this->RestaurantMenuExtraItem->id;
                echo json_encode($output);
                die();
            }else{
                
                echo Message::DATASAVEERROR();
                die();
                
            }
        }
    }
    
    public function deleteRestaurantMenuExtraItem()
    {
        $this->loadModel('RestaurantMenuExtraItem');
        
        if($this->request->isPost()){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            
            if($this->RestaurantMenuExtraItem->delete($data['extra_item_id'])) {
                echo Message::DELETEDSUCCESSFULLY();
                die();
            }else{
                echo Message::DATADELETEERROR();
                die();
            }
        }
    }

    public function showAllOrders()
    {

        $this->loadModel("Order");

        if ($this->request->isPost()) {


            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            $option = $data['option'];
            
            switch ($option) {
              case "active":
                $status = ['0', '1', '2'];
                break;
              case "completed":
                $status = ['3'];
                break;
              case "rejected":
                $status = ['4'];
                break;
              case "all":
                $status = ['0', '1', '2', '3', '4'];
                break;
              default:
                $status = ['0', '1', '2'];
                break;
            }

            $orders = $this->Order->getAllDeliveryOrdersByRestaurantStatus($status);

            foreach ($orders as $key => $val) {
                
                $order_status = $val['Order']['restaurant_status'];
                
                if ( $order_status == 0 ){
                    $msg = "New Order";
                } else if ( $order_status == 1 ){
                    $msg = "Being Prepared";
                } else if ( $order_status == 2 ){
                    $msg = "Being Delivered";
                } else if ( $order_status == 3 ){
                    $msg = "Order Complete";
                } else if ( $order_status == 4 ){
                    $msg = "Restaurant Rejected";
                } else {
                    $msg = "Test";
                }
                
                $orders[$key]['Order']['order_status'] = $msg;
                
            }


            $output['code'] = 200;

            $output['msg'] = $orders;
            echo json_encode($output);

            die();
        }
    }
}
?>