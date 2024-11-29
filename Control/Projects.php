<?php

namespace Homeofpirates\Control;

use Homeofpirates\Config\Config;
use Homeofpirates\Model\Projects as MProjects;

class Projects extends Base
{
    public $title = "Projekte";
    public $template = "projects.php";
    public $projectList = [];


    public function getList()
    {
        $operator = $this->getRequestParameter("operator");
        $year = $this->getRequestParameter("year");
        $category = $this->getRequestParameter("category");
        $limit = $this->getRequestParameter("limit");
        $offset = $this->getRequestParameter("offset");
        switch ($operator) {
            case "SM":
                $operator = "<";
                break;
            case "SMEQ":
                $operator = "<=";
                break;
            case "BG":
                $operator = ">";
                break;
            case "BGEQ":
                $operator = ">=";
                break;
        }


        //todo STOP injection right here after getting this list thing to work
        if ($year !== "") {
            $oProjects = new MProjects();
            $oProjects = $oProjects->loadList("kategorie = '" . $category . "' AND datum " . $operator . " " . $year . " AND datum IS NOT NULL");
            foreach ($oProjects as $row) {
                $this->projectList[] = ["id" => $row->id, "titel" => strip_tags($row->titel), "beschreibung" => strip_tags($row->beschreibung), "info" => strip_tags($row->info), "showlink" => (is_dir($row->bildpfad)) ? "show": false];
            }
            echo json_encode($this->projectList);
        } else {
            $oProjects = new MProjects();
            $oProjects = $oProjects->loadList();
            foreach ($oProjects as $row) {
                $this->projectList[] = ["id" => $row->id, "titel" => strip_tags($row->titel), "beschreibung" => strip_tags($row->beschreibung), "info" => strip_tags($row->info), "showlink" => (is_dir($row->bildpfad)) ? "show": false];
            }
            echo json_encode($this->projectList);
        }
    }


    public function getPictures()
    {
        $projectID = $this->getRequestParameter("id");
        //todo STOP injection right here after getting this list thing to work
        $oProjects = new MProjects();
        $oProjects->loadById($projectID);
        $mConfig = new Config();

        $handle = opendir($oProjects->bildpfad);
        $pictureArray = [];
        while ($file = readdir($handle)) {
            if ($file !== '.' && $file !== '..') {
                $pictureArray[] .= $oProjects->bildpfad."/".$file;
            }
        }
//        this works with the previous images in database underneath
//        $pictureArray = [];
//
//        if (!empty($oProjects->bilder)) {
//            $pictureArray = explode("|", $oProjects->bilder);
//            foreach ($pictureArray as $key => $pic) {
//                $pictureArray[$key] = $oProjects->bildpfad . "/" . trim($pic);
//            }
//        }
        echo json_encode($pictureArray);
    }
}
