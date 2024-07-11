<?php

namespace homeOfPirates\Control;


use homeOfPirates\Model\Users as MUsers;

class Admin extends Base
{
    public $title = "ADMIN";
    public $template = "admin.php";


    public function verify()
    {
        $username = $this->getRequestParameter("username");
        $pass = $this->getRequestParameter("pass");
        if($this->checkUserAndPass($username,$pass)){
            echo "valid";
        }else{
            echo "wrong";
        };
    }
    public function checkUserAndPass($username, $pass)
    {
        if(isset($_SESSION["username"]) && isset($_SESSION["pass"])){
            return true;
        }
        $user = $this->loadUser($username);
        if($user===false){
            return false;
        }else{

            if(password_verify($pass,$user->passhash)){
            return true;
            }
        }


        return false;
    }

    public function loadUser($username)
    {
        $oUser = new MUsers();
        if($oUser->loadByUsername($username)){
            return $oUser;
        }
        else{
            return false;
        }
    }

    public function setAdmin($username, $pass, $name)
    {
        $users = new MUsers();
        if ($this->checkUserForID($username) === false) {
            $data = [];
            $data["username"] = $username;
            $data["passhash"] = password_hash($pass,PASSWORD_BCRYPT,['cost' => 14]);
            $data["name"] = $name;
            $users->assign($data);
            $users->save();
            $users->loadByUsername($username);
            return $users;
        } else {
            return false;
        }
    }
}