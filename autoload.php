<?php
require_once  __DIR__ ."/". 'config/Config.php';
$config = new \homeOfPirates\config\Config();
$projectPath = $config->projectPath;
$dirArray= [
    "class/",
    "model/",
    "control/",
    "control/admin/"
];
require_once "control\Base.php";
require_once "model\Base.php";

function requireFilesRecursively($projectPath,$directory)
{
    if (is_dir($projectPath . $directory)) {
        $fileArray = scandir($projectPath . $directory);
        foreach ($fileArray as $file) {
            if ($file !== "Base.php" && $file !== ".htaccess" ) {
                if (filetype($projectPath . $directory . $file) != "dir") {
//                    error_log($projectPath . $directory . $file);
                    require_once $projectPath . $directory . $file;
                }
            }
        }
    }
}

foreach($dirArray as $dir) {
    if (is_dir($projectPath . $dir)) {
        $fileArray = scandir($projectPath . $dir);
        foreach ($fileArray as $file) {
            if ($file !== "Base.php" && $file !== ".htaccess" && $file != "." && $file != ".." ) {
//                if (filetype($projectPath . $dir . $file) == "dir" ) {
////                    error_log($projectPath.$dir.$file);
//                    requireFilesRecursively($projectPath,$dir.$file."/");
//                }else
                    if (filetype($projectPath . $dir . $file) != "dir" ){
                    require_once $projectPath . $dir . $file;
                }
            }
        }
    }
}