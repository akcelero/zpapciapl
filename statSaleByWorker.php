<?php
	require_once("header.php");
	require_once("baseConnect.php");
	$result = $con -> query("select id, name from workers;");
	$id = $_GET['id'];
	$year = $_GET['year'];
	echo("<center>");
	echo("<h2>Wybierz kapcia do wykresu</h2>");
	echo("<form method='get'>
			<select name='id'>");
	while($row = $result -> fetch_assoc()){
		echo("<option value='".$row['id']."' >".$row['name']."</option>");
	}
	echo("</select>");
	echo("<br />");
	echo("Rok <input size='4' type='text' name='year' value='$year' />");
	echo("<br />");
	echo("<input type='submit' value='Sprawdz!' />");
	echo("</form>");
	if(isset($_GET['id']) && isset($_GET['year'])){
		echo("<img src='statSaleByWorkerImg.php?id=$id&y=$year' />");
	}
	echo("<center>");
	require_once("footer.php");
?>
