<?php

namespace homeOfPirates\Control;

class Crew extends Base
{
    public $title = "Crew";
    public $template = "crew.php";

    public function alter(){
        $birthday = new \DateTime("12:00 , 21.06.1994");
        $today = new \DateTime();
        $diff = $birthday->diff($today);
        return $diff->y;
    }
}