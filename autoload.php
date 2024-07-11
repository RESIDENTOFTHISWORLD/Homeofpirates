<?php
require_once  __DIR__ ."/". 'config/Config.php';
$config = new \homeOfPirates\config\Config();
$projectPath = $config->projectPath;
$dirArray= [
    "class/",
    "model/",
    "control/"
];
require_once "control\Base.php";
require_once "model\Base.php";

foreach($dirArray as $dir) {
    if (is_dir($projectPath . $dir)) {
        $fileArray = scandir($projectPath . $dir);
        foreach ($fileArray as $file) {
            if ($file !== "Base.php" && $file !== ".htaccess" ) {
                if (filetype($projectPath . $dir . $file) != "dir") {
                    require_once $projectPath . $dir . $file;
                }
            }
        }
    }
}