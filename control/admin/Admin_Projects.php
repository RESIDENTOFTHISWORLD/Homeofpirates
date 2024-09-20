<?php

namespace homeOfPirates\Control\Admin;


use homeOfPirates\config\Config;
use homeOfPirates\Model\Projects;

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
//            $aProjects = $oProjects->loadList("admin_id = '" . $admin->id . "' AND (  username COLLATE UTF8_GENERAL_CI LIKE '%" . $searchTerm . "%' OR name COLLATE UTF8_GENERAL_CI LIKE '%" . $searchTerm . "%')");
            $aProjects = $oProjects->loadList("titel  LIKE '%" . $searchTerm . "%' OR kategorie  LIKE '%" . $searchTerm . "%' OR datum  LIKE '%" . $searchTerm . "%'");
        } else {
//            $aProjects = $oProjects->loadList("admin_id = '" . $admin->id . "'");
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
        $oProject->aImgPaths = [];
        $dir = $config->projectPath . $oProject->bildpfad;
        if ($aFiles = scandir($dir)) {
            foreach ($aFiles as $file) {
                if (file_exists($dir."/".$file) && $file != "." && $file != "..") {
                    $oProject->aImgPaths[] .= $config->protocol.$config->domain . "/" . $oProject->bildpfad."/".$file;
                }
            }
        }
        echo json_encode($oProject);
        return true;
    }
}