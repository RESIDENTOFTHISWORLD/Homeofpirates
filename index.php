<?php
require __DIR__ . '/autoload.php';
$development = true; // this has to be set to false if on a real server


$projectPath = $config->projectPath;
ini_set('error_log', $projectPath . '/log/error_log.txt');
error_reporting(E_ALL);
ini_set('display_errors', true);

$defaultAction = "render";
$defaultLang = "GER";
$request_lang = (isset($_REQUEST["lang"])) ? $_REQUEST["lang"] : $defaultLang;
$request_control = (isset($_REQUEST["ctrl"])) ? $_REQUEST["ctrl"] : null;
$request_action = (isset($_REQUEST["actn"])) ? $_REQUEST["actn"] : $defaultAction;

$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$elements = explode('/', $path);        // Split path on slashes
$elementLength = count($elements);
if($development){
    array_shift($elements);
}
$elementLength = count($elements)-1;
$urlSegment = "";


for ($i=0;$i<=$elementLength;$i++){
//    error_log($elements[$i]);
    if($elements[$i]!=""){
        $urlSegment = ucfirst($elements[$i]);
        if(file_exists("control/{$urlSegment}.php")){
            $request_control = $urlSegment;
        }
    }else{
        break;
    }
}

$controller = new homeOfPirates\Control\Home();
if (!empty($request_control) && file_exists("control/{$request_control}.php")) {
    $classname = "homeOfPirates\\Control\\{$request_control}";
    $controller = new $classname();
} elseif (!empty($request_control) && !file_exists("control/{$request_control}.php")) {
    echo "controller control/{$request_control} not found";
    exit;
}

if (!empty($request_action) && !method_exists($controller, $request_action)) {
    echo "action {$request_control} not found";
    exit;
}

$controller->$request_action();


// todo make URL readable http://localhost/topos/?ctrl=CategoryList&actn=render = http://localhost/topos/CategoryList
// this will help #https://stackoverflow.com/questions/16388959/url-rewriting-with-php