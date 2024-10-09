<?php
ini_set('error_log', __DIR__ . '/log/error_log.txt');
error_reporting(E_ALL);
ini_set('display_errors', false);
require __DIR__ . '/autoload.php';
$development = true; // this has to be set to false if on a real server

global $config;
$projectPath = $config->projectPath;

session_start();

if(empty($_SESSION['expire'])){
    $_SESSION['expire'] = time() + $config->sessionLifeTime;
}


if(time() > $_SESSION['expire'])
{
    session_unset();
    session_destroy();
    error_log("SessionExpired");
}

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
if(ucfirst($elements[$elementLength])=="Admin"){
    header('Location: '."http://".$config->domain."/Admin/Admin_Login");
}
$urlSegment = "";

$fullUrl = "";
$namespaceURL = "";
$controller_dir = "control/";
for ($i=0;$i<=$elementLength;$i++){
    if($elements[$i]!=""){
        $urlSegment = ucfirst($elements[$i]);
        $fullUrl = $fullUrl.$urlSegment;
        $namespaceURL = $namespaceURL.$urlSegment;
        if(is_dir($controller_dir.$fullUrl) && $i!=$elementLength){
            $fullUrl = $fullUrl. "/";
            $namespaceURL = $namespaceURL . '\\';
        }else if(file_exists($controller_dir.$fullUrl.".php")){
            $controller_file = $fullUrl;

        }
    }else{
        break;
    }
}

if (empty($request_control) && !empty($controller_file) && file_exists("{$controller_dir}{$controller_file}.php")) {
    $classname = "homeOfPirates\\Control\\{$namespaceURL}";
    $controller = new $classname();
}elseif (!empty($request_control) && file_exists("control/{$request_control}.php")) {
    $elements = explode('/', $request_control);
    $request_control = "";
    foreach ($elements as $element){
        $request_control .= "\\".ucfirst($element);
    }
    $classname = "homeOfPirates\\Control{$request_control}";
    $controller = new $classname();
}elseif(empty($request_control)){
    $controller = new homeOfPirates\Control\Home();
}else{
    echo "controller not Found ";
    exit;
}

if (!empty($request_action) && !method_exists($controller, $request_action)) {
    echo "action {$request_action} not found";
    exit;
}

$controller->$request_action();

