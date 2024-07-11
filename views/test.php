<?php
include "header.php";
const event = "6";
const film = "1";
const messe = "3";
const promo = "5";
function fetchData($kategorie, $anzeige, $dblink) {
  $query = ("SELECT * FROM projekte WHERE kategorie = $kategorie AND anzeige = $anzeige ORDER BY datum DESC");
  $html = "";
  $projectid ="";
  foreach ($dblink->query($query) as $project) {
    $html .= "	<div class='box'>\n";
    $html .= "    <h2>$project[titel]</h2>\n";
    $html .= "    <p>$project[beschreibung]</p>\n";
    $html .= "    <p>$project[info]</p>\n";
    $html .= "	</div>\n";
    $projectid = "$project[id]";
    if (isset($project['bilder']))
  		$html .= "Bilder\n";
  }
echo "$projectid";
return $html;
}

$kategorie = film;
$anzeige = 1;
echo "<div class='container' id='event'>\n";
echo fetchData($kategorie, $anzeige, $dblink);
echo "</div>\n"; // closing div.container
?>
