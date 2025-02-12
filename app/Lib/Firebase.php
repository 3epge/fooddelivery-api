<?php

class Firebase
{


    public static function placeOrder($order_id,$restaurant_user_id,$delivery){

        $curl = curl_init();

        $curl_date2 =
            array (



                'status' => "0",
                'type' => (string)$delivery,
                'deal' => "0",
                'order_id'=>$order_id




            );

        curl_setopt_array($curl, array(
            CURLOPT_URL => FIREBASE_URL."restaurant/".$restaurant_user_id."/CurrentOrders.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($curl_date2),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token:"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

    }


    public static function verifyFirebaseUrl($FIREBASE_URL){

        $curl = curl_init();

        $curl_date2 =
            array (
                'test' => "1",
            );

        curl_setopt_array($curl, array(
            CURLOPT_URL => $FIREBASE_URL.'testing/.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($curl_date2),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token:"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;

    }

    public static function OrderDeal($order_id,$restaurant_user_id,$delivery){

        $curl = curl_init();



        $curl_data['status'] = "0";
        $curl_data['deal'] = "1";
        $curl_data['type'] = $delivery;
        $curl_data['order_id'] = $order_id;

        curl_setopt_array($curl, array(
            CURLOPT_URL => FIREBASE_URL."restaurant/".$restaurant_user_id."/CurrentOrders.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($curl_data),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token:"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

    }

    public static function updateRestaurantOrderStatus($order_id,$restaurant_name){



        $curl_data[$order_id]['order_status'] = $restaurant_name . 'has accepted your order and processing it';
        $curl_data[$order_id]['map_change'] = "0";


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => FIREBASE_URL."tracking_status.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($curl_data),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token:"
            ),
        ));

        $response_curl = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
        } else {
            //echo $response_curl;
        }




    }


    public static function showRiderStatus($order_id,$map_change,$msg){



        $curl_date[$order_id]['order_status']= $msg;
        $curl_date[$order_id]['map_change'] = $map_change;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => FIREBASE_URL."tracking_status.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($curl_date),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token:"
            ),
        ));

        $response_curl = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            //echo $response_curl;
        }
    }

    public static function deleteOrder($order_id){




        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => FIREBASE_URL."tracking_status/".$order_id.".json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Postman-Token:"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

    }

    public static function getRiderLocations(){





        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => FIREBASE_URL."tracking/.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            //CURLOPT_POSTFIELDS => json_encode($curl_date),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token:"
            ),
        ));

        $response_curl = curl_exec($curl);
        return $response_curl;
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            //echo $response_curl;
        }
    }



}

?>