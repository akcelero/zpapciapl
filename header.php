<?php
	session_start();
	if(!isset($_SESSION['level']) && basename($_SERVER['REQUEST_URI']) != 'index.php'){
		die();
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="styleLinks.css">
</head>
<body>
<div id="header">

	<center>
	<a href="index.php">
	<img id="logo" src="logo2.jpg" width="750px"/>
	</a>
	<br />
	<div id="barMenu">
	<?php
		if(isset($_SESSION['login'])){
			echo(
				"Masz papcie z loginem <b>".$_SESSION['login']."</b> !".
				" <a href=\"logout.php\">Wyloguj</a>"
		    );
		} else {
			echo("Nie zalogowany : <");
		}
	?>
	</div>
	</center>
</div>
<div id="all">
	<div id="content">

