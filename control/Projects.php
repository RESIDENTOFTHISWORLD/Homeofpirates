<?php

namespace homeOfPirates\Control;
use homeOfPirates\Model\Projects as MProjects;
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
        switch ($operator){
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
            $oProjects = $oProjects->loadList("kategorie = '".$category ."' AND datum " . $operator . " " . $year ." AND datum IS NOT NULL");
            foreach ($oProjects as $row) {
                $this->projectList[] = ["id" => $row->id, "titel" => strip_tags($row->titel), "beschreibung" => strip_tags($row->beschreibung), "info" => strip_tags($row->info)];
            }
            echo json_encode($this->projectList);
        } else {
            $oProjects = new MProjects();
            $oProjects = $oProjects->loadList();
            foreach ($oProjects as $row) {
                $this->projectList[] = ["id" => $row->id, "titel" => strip_tags($row->titel), "beschreibung" => strip_tags($row->beschreibung), "info" => strip_tags($row->info)];
            }
            echo json_encode($this->projectList);
        }
//            $oProjects = new Projects();
//            $oProjects = $oProjects->loadList("");
//            $oCat_rootcat = $oCat_rootcat->loadList("");
//
//
//            foreach ($oCat_rootcat as $row) {
//                if($row->root_category_id == $year){
//                    foreach($oProjects as $oProject){
//                        if($oProject->id == $row->id) {
//                            $this->projectList[] = ["id" => $oProject->id, "name" => $oProject->name];
//                        }
//                    }
//                }
//            }


    }
}
