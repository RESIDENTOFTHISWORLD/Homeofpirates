<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title><?= $controller->title;?></title>
    <meta name="title" content="<?= $controller->title;?>">


	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="author" content="Jonathan Albrecht">
	<meta name="description" content="Constructed Atmosphere - Since 1994.">
    <link rel="icon" type="image/x-icon" href="<?=$config->protocol;?><?=$config->domain;?>/img/icons/hop_favicon.ico">
	<link rel="shortcut icon" href="<?=$config->protocol;?><?=$config->domain;?>/img/icons/hop_favicon.ico">
	<link rel="stylesheet" href="<?=$config->protocol;?><?=$config->domain;?>/css/style.css" type="text/css">
	<script type="text/javascript" src="<?=$config->protocol;?><?=$config->domain;?>/js/scripts.js"></script>
    <script src="<?=$config->protocol;?><?=$config->domain;?>/js/jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery.localscroll@2.0.0/jquery.localScroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>
<body>
<form hidden id="mainForm" action="#" method="post">
    <input type="hidden" id="controller" name="ctrl" value="">
    <input type="hidden" id="action"     name="actn" value="">
</form>


<?php

?>