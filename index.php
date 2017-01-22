<?php
	session_start();
	include_once("baseConnect.php");
	if(isset($_POST['login']) && isset($_POST['password'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$result = login($login, $password);
		if(count($result) > 0){
			$_SESSION['level'] = $result['level'];
			$_SESSION['login'] = $result['login'];
		}
	}
	if(isset($_SESSION['level'])){
		header("Location: menu.php"); 
	}
	require_once("header.php");
?>
	<center>
	By ubrać papcioszki, musisz się zalogować !<br /><br />
	</center>
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
