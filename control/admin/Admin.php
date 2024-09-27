<?php

namespace homeOfPirates\Control\Admin;


use homeOfPirates\config\Config;
use homeOfPirates\Control\Base;
use homeOfPirates\Model\Users as MUsers;

class Admin extends Base
{
    public $title = "ADMIN";
    public $template = "admin/admin_login.php";
    public $auth = false;

    public function render()
    {
        $config = new Config();
        if ($this->auth) {
            if ($this->verifyOnLoad()) {
                $this->render_Admin();
            } else {
                header("location:".$config->protocol. $config->domain . "/Admin");
            }
        } else {
            $this->render_Admin();
        }
    }

    public function render_Admin()
    {
        $config = new Config();
        $controller = $this;
        include $config->getProjectPath() . "views/admin/admin_header.php";
        include $config->getProjectPath() . "views/admin/admin_navbar.php";
        include $config->getProjectPath() . "views/" . $controller->template;
        include $config->getProjectPath() . "views/admin/admin_footer.php";
    }

    public function verifyOnLoad()
    {
        if (!isset($_SESSION["username"]) && !isset($_SESSION["pass"])) {
            return false;
        }
        if ($this->checkUserAndPass($_SESSION["username"], $_SESSION["pass"])) {
            return true;
        } else {
            return false;
        }
    }

    public function verify()
    {
        $config = new Config();
        $username = $this->getRequestParameter("username", "");
        $pass = $this->getRequestParameter("pass", "");
        if (!$this->checkUserAndPass($username, $pass) || ($username == "" && $pass == "")) {
            echo json_encode(["verify" => false]);
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["pass"] = $pass;
            echo json_encode(["verify" => true]);
        };

    }

    public function checkUserAndPass($username, $pass)
    {
        $user = $this->loadUser($username);
        if ($user === false) {
            return false;
        } else {
            if (password_verify($pass, $user->passhash)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function loadUser($username)
    {
        $oUser = new MUsers();
        if ($oUser->loadByUsername($username)) {
            return $oUser;
        } else {
            return false;
        }
    }
//todo users
//    public function setAdmin($username, $pass, $name)
//    {
//        $users = new MUsers();
//        if ($this->checkUserForID($username) === false) {
//            $data = [];
//            $data["username"] = $username;
//            $data["passhash"] = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 14]);
//            $data["name"] = $name;
//            $users->assign($data);
//            $users->save();
//            $users->loadByUsername($username);
//            return $users;
//        } else {
//            return false;
//        }
//    }
}