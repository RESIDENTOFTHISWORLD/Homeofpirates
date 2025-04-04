<?php

namespace Homeofpirates\Control\Admin;


use Homeofpirates\Config\Config;
use Homeofpirates\Model\Projects;
use Homeofpirates\Model\Sozials;

class Admin_Projects extends Admin
{
    public $title = "ADMIN_ PROJECTS";
    public $template = "admin/admin_projects.php";
    public $auth = true;
    public $projectList = array();


//    public function renderEdit()
//    {
//        $this->title = "User Bearbeitung";
//        $this->template = "user_edit.php";
//        $this->oUser = $this->getUser($this->getRequestParameter("mitarbeiterId"));
//        parent::render();
//    }

    public function uploadFiles()
    {
        $picturePath = $this->getRequestParameter("picturePath");
        $config = new Config();
        $dir = $config->projectPath . $picturePath;


        foreach ($_FILES as $file) {
            $typeAndName = explode(".", $file["name"]);
            move_uploaded_file($file["tmp_name"], $dir . "/" . md5($typeAndName[0]) . "." . $typeAndName[1]);
        }
    }

    public function loadProjects()
    {
        if (!$this->verifyOnLoad()) {
            return false;
        }

        $searchTerm = $this->getRequestParameter("searchTerm");
        $this->projectList = [];
        $oProjects = new Projects();
        //todo with UsersHyarchy
        if (isset($_REQUEST["searchTerm"])) {
//            $aProjects = $oProjects->loadList("admin_id = '" . $Admin->id . "' AND (  username COLLATE UTF8_GENERAL_CI LIKE '%" . $searchTerm . "%' OR name COLLATE UTF8_GENERAL_CI LIKE '%" . $searchTerm . "%')");
            $aProjects = $oProjects->loadList("titel  LIKE '%" . $searchTerm . "%' OR kategorie  LIKE '%" . $searchTerm . "%' OR datum  LIKE '%" . $searchTerm . "%'");
        } else {
//            $aProjects = $oProjects->loadList("admin_id = '" . $Admin->id . "'");
            $aProjects = $oProjects->loadList();
        }

        foreach ($aProjects as $row) {
            $this->projectList[] = ["id" => $row->id, "title" => $row->titel, "category" => $row->kategorie, "date" => $row->datum];
        }
        if (isset($_REQUEST["searchTerm"])) {
            echo json_encode($this->projectList);
        }
        return true;
    }

    public function getProject()
    {
        if (!$this->verifyOnLoad()) {
            return false;
        }

        $oProject = new Projects();
        $projectID = $this->getRequestParameter("projectId");
        $oProject->loadById($projectID);
        $config = new Config();
        //DIR CHECK
        $dir = $config->projectPath . $oProject->bildpfad;
        if (!file_exists($dir)) {
            $oProject->bildpfadOld = $oProject->bildpfad;
        }

        $oProject->aImgPaths = [];
        if ($aFiles = scandir($dir)) {
            foreach ($aFiles as $file) {
                if (file_exists($dir . "/" . $file) && $file != "." && $file != "..") {
                    $oProject->aImgPaths[] .= $config->protocol . $config->domain . "/" . $oProject->bildpfad . "/" . $file;
                }
            }
        }
        $oSozials = new Sozials();
        if($aSozials = $oSozials->loadList("project_id = ".$projectID)){
            $oProject->sozials = $aSozials;
        }

        echo json_encode($oProject);
        return true;
    }

    public function setNewSozialLink()
    {
        $aProjectData = [];
        $aProjectData["project_id"] = $this->getRequestParameter("id");
        $aProjectData["url"] = $this->getRequestParameter("link");
        $aProjectData["type"] = $this->getRequestParameter("type");
        $oSozials = new Sozials();
        $oSozials->assign($aProjectData);
        if ($oSozials->save()) {
            echo "created";
            return true;
        }
        return false;
    }

    public function setNewPath()
    {
        $aProjectData = [];
        $aProjectData["id"] = $this->getRequestParameter("id");

        $newPath = $this->getRequestParameter("value");

        $config = new Config();

        //DIR CHECK
        $dir = $config->projectPath . $newPath;
        if (file_exists($dir)) {
            echo "exists";
            return false;
        } else {
            if (mkdir($dir, 0700, true)) {
                $oProjects = new Projects();
                $oProjects->loadById($aProjectData["id"]);
                $aProjectData["bildpfad"] = $newPath;
                $oProjects->assign($aProjectData);
                if ($oProjects->save()) {
                    echo "created";
                    return true;
                } else {
                    echo "invalid";
                    return false;
                }
            } else {
                echo "invalid";
                return false;
            }
        }

    }

    public function updateValue()
    {
        $aProjectData = [];
        $aProjectData["id"] = $this->getRequestParameter("id");
        $aProjectData[$this->getRequestParameter("column")] = $this->getRequestParameter("value");

//        ob_start();
//        var_dump($aProjectData);
//
//        error_log(ob_get_contents());
//        ob_end_clean();
        //        $aData["admin_id"] = $this->removeInjectablesFromStrings($Admin->id); todo Use USER HYARCHY
        $oProjects = new Projects();
        if (!empty($aProjectData["id"])) {
            $oProjects->loadById($aProjectData["id"]);
        }
        $oProjects->assign($aProjectData);
        if ($oProjects->save()) {
            echo $oProjects->id;
            return true;
        }
        return false;
    }

    public function save()
    {
        $aProjectDataRaw = $this->getRequestParameter("projectData");

        $aProjectData = [];
        foreach ($aProjectDataRaw as $columnInput) {
            $name = str_replace(["projectData[", "]"], "", $columnInput["name"]);
            $aProjectData[$name] = $columnInput["value"];
        }

        //        $aData["admin_id"] = $this->removeInjectablesFromStrings($Admin->id); todo Use USER HYARCHY
        $oProjects = new Projects();
        if (!empty($aProjectData["id"])) {
            $oProjects->loadById($aProjectData["id"]);
        }
        $oProjects->assign($aProjectData);
        if ($oProjects->save()) {
//            ob_start();
//            var_dump($aProjectData);
//            error_log(ob_get_contents());
//            ob_end_clean();
            echo $oProjects->id;
            return true;
        }
        return false;
    }

//    public function delete()
//    {
//        $aProjectData = $this->getRequestParameter("projectData");
//        foreach ($aProjectData as $index => $value) {
//            $aProjectData[$this->removeInjectablesFromStrings($index)] = $this->removeInjectablesFromStrings($value);
//        }
//        $Projects = new Projects();
//        $Projects->delete($this->removeInjectablesFromStrings($aProjectData["id"]));
//    }

}