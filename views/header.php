<?php
//header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
//header('Cache-Control: no-store, no-cache, must-revalidate');
//header('Cache-Control: post-check=0, pre-check=0', FALSE);
//header('Pragma: no-cache');?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title><?= $controller->title;?></title>
    <meta name="title" content="<?= $controller->title;?>">


	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="author" content="Jonathan Albrecht">
	<meta name="description" content="Constructed Atmosphere - Since 1994.">
	<link rel="shortcut icon" href="img/icons/hop_favicon.ico">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script language="javascript" type="text/javascript" src="js/scripts.js"></script>
    <script src="js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="/img/icons/hop_favicon.ico">
	<?php
	//$dblink = new PDO('mysql:host=database-5000683818.ud-webspace.de;dbname=dbs631942;charset=utf8','dbu1029478','p?xa5cmwFfgq'); //database connection enabled
    //	$dblink = new PDO('mysql:host=localhost;dbname=test','root',''); //test-database connection enabled
	?>
</head>
<body>
<form hidden id="mainForm" action="#" method="post">
    <input type="hidden" id="controller" name="ctrl" value="">
    <input type="hidden" id="action"     name="actn" value="">
</form>


<?php
    include "navbar.php";
    include "noscript.php";
?>