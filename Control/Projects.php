<?php

namespace Homeofpirates\Control;

use Homeofpirates\Config\Config;
use Homeofpirates\Model\Projects as MProjects;
use Homeofpirates\Model\Sozials;

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
        $oProjects = new MProjects();
        $oSozials = new Sozials();
        if ($year === "") {
            $aProjects = $oProjects->loadList(false, false, false, $limit, $offset);
            foreach ($aProjects as $key => $row) {
                $rows_oSozials = $oSozials->loadList("project_id = " . $row->id);

                $this->projectList[$key] =  ["id" => $row->id];
                $this->projectList[$key] += ["titel" => strip_tags($row->titel)];
                $this->projectList[$key] += ["beschreibung" => strip_tags($row->beschreibung)];
                $this->projectList[$key] += ["info" => strip_tags($row->info)];

                if (!empty($rows_oSozials)) {
                    foreach ($rows_oSozials as $sozialKey=> $sozial) {
                        $this->projectList[$key]["sozialLinks"][$sozialKey] = ["id" => $sozial->id];;
                        $this->projectList[$key]["sozialLinks"][$sozialKey] += ["url" => $sozial->url];;
                        $this->projectList[$key]["sozialLinks"][$sozialKey] += ["type" => $sozial->type];;
                    }
                }

                $this->projectList[$key] += ["showLink" => (is_dir($row->bildpfad)) ? "show" : false];
            }
            echo json_encode($this->projectList);
        } else if ($year !== "") {
            $aProjects = $oProjects->loadList("kategorie = '" . $category . "' AND datum " . $operator . " " . $year . " AND datum IS NOT NULL", false, false, $limit, $offset);
            foreach ($aProjects as $key => $row) {
                $rows_oSozials = $oSozials->loadList("project_id = " . $row->id);

                $this->projectList[$key] =  ["id" => $row->id];
                $this->projectList[$key] += ["titel" => strip_tags($row->titel)];
                $this->projectList[$key] += ["beschreibung" => strip_tags($row->beschreibung)];
                $this->projectList[$key] += ["info" => strip_tags($row->info)];

                if (!empty($rows_oSozials)) {
                    foreach ($rows_oSozials as $sozialKey=> $sozial) {
                        $this->projectList[$key]["sozialLinks"][$sozialKey] = ["id" => $sozial->id];;
                        $this->projectList[$key]["sozialLinks"][$sozialKey] += ["url" => $sozial->url];;
                        $this->projectList[$key]["sozialLinks"][$sozialKey] += ["type" => $sozial->type];;
                    }
                }

                $this->projectList[$key] += ["picture_modal" => (is_dir($row->bildpfad)) ? "show" : false];
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
                $pictureArray[] .= $oProjects->bildpfad . "/" . $file;
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
