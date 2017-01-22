<?php
	$con = new mysqli("localhost", "root", "root", "zpapciapl");
	function login($login, $password){
		$login = addslashes($login);
		$password = addslashes($password);
		$con = new mysqli("localhost", "root", "root", "zpapciapl");
		$resultQ = $con -> query("select login, level from users where login = '$login' and password='$password';");
		$result = array();
		if($resultQ -> num_rows > 0){
			$row = $resultQ -> fetch_assoc();
			$result['level'] = $row['level'];
			$result['login'] = $row['login'];
		}
		return $result;
	}
?>
