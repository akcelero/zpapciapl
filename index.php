<?php
	include_once("header.php");
	include_once("baseConnect.php");
	if(isset($_POST['login']) && isset($_POST['password'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$result = $con -> query("select login, level from users where login = '$login' and password='$password';");
		if($result -> num_rows == 0){
			die("Error ".$result->error);
		}
		$row = $result->fetch_assoc();
		$_SESSION['level'] = $row['level'];
		$_SESSION['login'] = $row['login'];
	}
	if(isset($_SESSION['level'])){
		// przekierowanie na adres loklany 
		header("Location: menu.php"); 

		// przekierowanie na adres zdalny 
		// header("wLocation: http://www.domena.pl/");
	}
?>
	<form method="POST">
		<div style="width:800px;">
			<div style="width:390px; float:left; text-align:right; padding-right:5px;">
				Login:<br />
				Hasełko:
			</div>
			<div style="float:right; width:400px;" >
				<input type="text" name="login" /><br />
				<input type="password" name="password" /><br />
				<input type="submit" value="wjeżdżam!" />
			</div>
		</div>
	</form>

<?php
	include_once("footer.php");
?>
