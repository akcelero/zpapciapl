<?php
	require_once("header.php");
	require_once("baseConnect.php");
	$result = $con -> query("select id, address from places;");
	echo("<center>");
	echo("<h2>Wybierz kapcia do wykresu</h2>");
	echo("<form method='get'>
			<select name='id' onchange='this.form.submit()'>");
	while($row = $result -> fetch_assoc()){
		echo("<option value='".$row['id']."' >".$row['address']."</option>");
	}
	echo("</select>");
	echo("<br />");
	echo("Rok <input size='4' type='text' name='year' />");
	echo("</form>");
	if(isset($_GET['id']) && isset($_GET['year'])){
		$id = $_GET['id'];
		$year = $_GET['year'];
		echo("<img src='statVisitsImg.php?id=$id&y=$year />");
	}
	echo("<center>");
	require_once("footer.php");
?>
