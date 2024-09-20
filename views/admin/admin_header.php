<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title><?= $controller->title;?></title>
    <meta name="title" content="<?= $controller->title;?>">
    <link rel="icon" type="image/x-icon" href="http://<?=$config->domain;?>/img/icons/hop_favicon.ico">
	<link rel="shortcut icon" href="http://<?=$config->domain;?>/img/icons/hop_favicon.ico">
	<link rel="stylesheet" href="http://<?=$config->domain;?>/css/style.css" type="text/css">
	<script type="text/javascript" src="http://<?=$config->domain;?>/js/scripts.js"></script>
    <script src="http://<?=$config->domain;?>/js/jquery.js"></script>

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