<?php

namespace Homeofpirates\Control;

use Homeofpirates\Config\Config;

class Base
{

    /**
     * @var null|string
     */
    public $template = null;

    /**
     * @var null|string
     */
    public $title = null;

    /**
     * Rendert die View
     *
     * @return void
     */
    public function render()
    {
        $config = new Config();
        $controller = $this;
        include $config->getProjectPath() . "views/header.php";
        include $config->getProjectPath() . "views/navbar.php";
        include $config->getProjectPath() . "views/noscript.php";

        include $config->getProjectPath() . "views/" . $this->template;

        include $config->getProjectPath() . "views/footer.php";

    }


//    public function getUrl()
//    {
//        $path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
//        $elements = explode('/', $path);                // Split path on slashes
//        if(empty($elements[0])) {                       // No path elements means home
//            ShowHomepage();
//        } else switch(array_shift($elements))             // Pop off first item and switch
//        {
//            case 'Some-text-goes-here':
//                ShowPicture($elements); // passes rest of parameters to internal function
//                break;
//            case 'more':
//                ...
//            default:
//                header('HTTP/1.1 404 Not Found');
//                Show404Error();
//        }
//    }


    /**
     * erstellt sich aus dem Token ein Admin Object und speichert username des Admins in der Datenbank
     *
     * und gibt diesen wieder
     * @param string $token
     * @return Admin
     */
    public function getAndSetAdmin($token)
    {
        $gitApi = GitApi::getInstance();
        $user = $gitApi->getUserFromToken($token);
        $user = json_decode($user);

        $admin = new Admin();
        if ($admin->loadByUsername($user->login) === false) {
            $newAdmin = new Admin();
            $data = [];
            $data["tokenmd5"] = md5($token);
            $data["username"] = $user->login;
            $newAdmin->assign($data);
            $newAdmin->save();

        } else if ($admin->loadByUsername($user->login) === true) {
            $newAdmin = new Admin();
            $newAdmin->loadByUsername($user->login);
        }
        return $newAdmin;
    }



    /**
     * Checks if Alias is given for Username and returns username or Alias
     *
     * @param array $mitarbeiterArray
     * @param string $username
     * @return string
     */
    protected function checkUsernameDatabase($mitarbeiterArray, $username)
    {
        $mitarbeiterName = null;

        foreach ($mitarbeiterArray as $mitarbeiterRow) {
            if ($mitarbeiterRow->username == $username) {
                $mitarbeiterName = $mitarbeiterRow->name;
            }
        }
        if ($mitarbeiterName === null) {
            $mitarbeiterName = $username;
        }
        return $mitarbeiterName;
    }

    /**
     * removes all users from array that are already in Repo or are Repo Owner
     * returns array afterwards
     *
     * @param array $dupeArray
     * @param array $checkArray
     * @param string $repoName
     * @return array
     */
    protected function removeAlreadyInRepo($dupeArray, $checkArray, $repoName)
    {
        foreach ($dupeArray as $index => $userToAdd) {
            if (strpos($repoName, $userToAdd) === 0) {
                unset($dupeArray[$index]);
            }

            if (in_array($userToAdd, $checkArray)) {
                unset($dupeArray[$index]);
            }
        }
        return $dupeArray;
    }

    /**
     * removes all users from array that are not in Repo or are already removed
     * returns array afterwards
     *
     * @param array $dupeArray
     * @param array $checkArray
     * @param string $repoName
     * @return array
     */
    protected function removeAlreadyRemoved($dupeArray, $checkArray, $repoName)
    {
        foreach ($dupeArray as $index => $user) {
            if (strpos($repoName, $user) === 0) {
                unset($dupeArray[$index]);
            }

            if (!in_array($user, $checkArray)) {
                unset($dupeArray[$index]);
            }
        }
        return $dupeArray;
    }

    /**
     * removes all invite id´s from array that are already invited to Repo
     * returns array afterwards
     *
     * @param array $removeArray
     * @param array $invitesIds
     * @return array|array[]
     */
    protected function removeSendInvites($removeArray, $invitesIds)
    {
        $returnArray = ["users" => [], "invites" => []];
        foreach ($removeArray as $user) {
            if (!in_array($user, $invitesIds)) {
                $returnArray["users"][] = $user;
            } else {
                $returnArray["invites"][] = $user;
            }
        }
        return $returnArray;
    }

    /**
     * Prüft array oder string nach nicht validen zeichen und Tags zur Eingabe sicherheit und entfernt diese Zeichen
     *
     * @param array|mixed|string $stringOrArray
     * @return array|mixed|string
     */
    protected function removeInjectablesFromStrings($stringOrArray)
    {
        if (is_array($stringOrArray)) {
            foreach ($stringOrArray as $index => $value) {
                if(!is_array($value)){
                    $value = str_replace(['"', "'"], "", $value);
                    $index = str_replace(['"', "'"], "", $index);
                    $stringOrArray[strip_tags($index)] = strip_tags($value);
                }else{
                    $this->removeInjectablesFromStrings($value);
                }
            }
        } else {
            $stringOrArray = str_replace(['"', "'"], "", $stringOrArray);
            $stringOrArray = strip_tags($stringOrArray);
        }
        return $stringOrArray;
    }

    /**
     * Prüft ob Request parameter gesetzt ist und gibt dann diesen zurück
     * wenn nicht gesetzt, gibt dann default aus
     *
     * @param string $parameter
     * @param array|mixed|string $default
     * @return array|mixed|string
     */
    public function getRequestParameter($parameter, $default = '')
    {
        if (isset($_REQUEST[$parameter])) {
            return $this->removeInjectablesFromStrings($_REQUEST[$parameter]);
        }
        return $default;
    }

    /**
     * Führt die getRequestParameter() für gitToken aus und gibt ergebnis zurück
     *
     * @return string
     */
    protected function getToken()
    {
        return $this->getRequestParameter("gitToken");
    }
}
