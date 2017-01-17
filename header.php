<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="styleLinks.css">
</head>
<body>
<div id="all">
	<div id="header">
		<img id="logo" src="logo.jpg" width="800px"/>
		<?php
			session_start();
			if(isset($_SESSION['login'])){
				echo(
					"Masz papcie o loginie ".$_SESSION['login']." !".
					" <a href=\"logout.php\">Wyloguj</a>"
			    );
			} else {
				echo("Nie zalogowany : <");
			}
		?>
	</div>
	<div id="content">

