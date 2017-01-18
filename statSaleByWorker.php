<?php
	require_once("header.php");
	require_once("baseConnect.php");
	$result = $con -> query("select id, name from workers;");
	$id = $_GET['id'];
	$year = $_GET['year'];
	echo("<center>");
	echo("<h2>Wybierz kapcia do wykresu</h2>");
	echo("<form method='get'>
			Pracownik <select name='id' onchange='this.form.submit()'>");
	while($row = $result -> fetch_assoc()){
		echo("<option value='".$row['id']."' >".$row['name']."</option>");
	}
	echo("</select>");
	echo("<br />");
	echo("Rok ");
	echo("<select name='year' onchange='this.form.submit()'>");
	echo("<option value='0' selected>-----</option>");
	for($i=2000;$i<2017;$i++){
		echo("<option value='$i'");
		if($_GET['year'] == $i){
			echo("selected");
		}
		echo(">$i</option>");
	}
	echo("</select>");
	echo("<br />");
	echo("</form>");
	if(isset($_GET['id']) && isset($_GET['year']) && $_GET['year']>0){
		echo("<img src='statSaleByWorkerImg.php?id=$id&y=$year' />");
	}
	echo("</center>");
	require_once("footer.php");
?>
