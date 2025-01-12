<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Security', 'Utility');


class User extends AppModel
{
    public $useTable = 'user';

    public $hasOne = array(
        'UserInfo' => array(
            'className' => 'UserInfo',
            'foreignKey' => 'user_id',
            'conditions' => array('User.id = UserInfo.user_id')
        ));


    //keep
    public function isEmailAlreadyExist($email){

        return $this->find('count', array(
            'conditions' => array('email' => $email)
        ));

    }

    //keep
    public function getUserDetailsAgainstEmail($email){

        return $this->find('first', array(
            'conditions' => array('email' => $email)
        ));

    }
    
    //keep
    public function iSUserExist($id){

        return $this->find('count', array(
            'conditions' => array('id' => $id)
        ));

    }



    //keep
    public function verifyToken($code,$email){

        return $this->find('count', array(
            'conditions' => array(

                'email' => $email,
                'token'=>$code

            )
        ));

    }

    //keep
    public function getUsersCount($role){

        return $this->find('count', array(
            'conditions' => array(
                'User.role' => $role
            )
        ));

    }
    
    //keep
    public function getUserCountByDate($start_date, $end_date){
        return $this->find('count', array(
            'conditions' => array(
                'User.role' => 'user',
                'User.created >=' => $start_date." 00:00:00",
                'User.created <=' => $end_date." 23:59:59",
            )
        ));
    }

    //keep
    public function verifyPassword($email,$old_password){


        $userData = $this->findByEmail($email, array(
            'id',
            'password',
            'salt',
            'active',
            'block'

        ));

        if (empty($userData) || $userData['User']['active']==3) {


            return false;

        }

        $passwordHash = Security::hash($old_password, 'blowfish', $userData['User']['password']);
        $salt = Security::hash($old_password, 'sha256', true);


        if ($passwordHash == $userData['User']['password']  && $userData['User']['block'] == 0) {


            return true;

        }else{
            return false;


        }



    }



    function updatepassword($password)
    {
        $passwordBlowfishHasher = new BlowfishPasswordHasher();
        $user['password'] = $passwordBlowfishHasher->hash($password);
        $user['salt'] = Security::hash($password, 'sha256', true);
        return $user;
    }

    public function updateUserbystdid($user,$std_id){
        return $this->updateAll($user,array('std_id' => $std_id));
    }

    public function getEmailBasedOnUserID($user_id){

        return $this->find('all', array(
            'conditions' => array(
                'User.id' => $user_id

            )
        ));


    }

    /*public function getAllRiders(){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => "rider",
                'User.active' => 1,



            ),
            'fields' =>array('UserInfo.*')
        ));


    }

  public function getAllRidersadmin(){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => "rider",
                



            ),
            'fields' =>array('UserInfo.*')
        ));


    }


   
    
    public function getOnlineOfflineRiders($online){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => "rider",
                'User.active' => 1,
                'UserInfo.online' => $online,


            ),
            'fields' =>array('UserInfo.*','User.*')
        ));


    }
     public function getOnlineOfflineRidersadmin($online){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => "rider",
                
                'UserInfo.online' => $online,


            ),
            'fields' =>array('UserInfo.*','User.*')
        ));


    }

    public function getAllRidersTimings(){

        $this->bindModel(
            array('hasMany' => array(
                'RiderTiming' => array(
                    'className' => 'RiderTiming',
                    'foreignKey' => 'user_id'
                    //'conditions' => array('User.id = RiderTiming.user_id')
                )
            )
            ),
            false
        );

        $this->Behaviors->attach('Containable');
        return $this->find('all', array(



            'conditions' => array(
                'User.role' => "rider",
                'User.active' => 1,

            ),
            'contain' => array(
                'RiderTiming' => array(

                    'order' => 'RiderTiming.id DESC',

                ),'UserInfo'
            ),



            //'fields' =>array('UserInfo.*','RiderTiming.*')
        ));


    }

    public function getAdminDetails(){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => "admin"

            ),
            'fields' =>array('UserInfo.*')
        ));


    }*/
    

    //keep
    public function login($email,$user_password,$role)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(
                    'User.email' => $email,
                    'User.role' => $role

                )
            ));

            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['User']['password']);


        if ($passwordHash == $userData[0]['User']['password'] && $userData[0]['User']['block'] == 0) {

            return $userData;
        } else {

            return false;


        }



    }


}?>