<?php
	require_once("header.php");
	require_once("baseConnect.php");
	echo("<center>");	
	$queryStr="select
				clients.name,
				flights.destination,
				travels.dateOfSale,
				travels.price,
				travels.discount
			from travels
			inner join clients on travels.idClient=clients.id
			inner join flights on flights.id=travels.idFlight where 1=1 and ";
	if("" != $_POST['nameF']){
		$queryStr .= " clients.name like binary '%".stripslashes($_POST['nameF'])."%' and ";
	}
	if("" != $_POST['destinationF']){
		$queryStr .= " flights.destination like binary '%".stripslashes($_POST['destinationF'])."%' and ";
	}
	if("" != $_POST['dateOfSaleF']){
		$queryStr .= " travels.dateOfSale = '".stripslashes($_POST['dateOfSaleF'])."' and ";
	}
	if("" != $_POST['priceF']){
		$queryStr .= " travels.price = '".stripslashes($_POST['priceF'])."' and ";
	}
	if("" != $_POST['discountF']){
		stripslashes($name);
		$queryStr .= " travel.discount = '".stripslashes($_POST['discountF'])."' and ";
	}
	$queryStr .= " 1=1;";
	// echo($queryStr);
	$result = $con -> query($queryStr);
	if($result -> num_rows == 0){
		echo("<h3>Nie znaleziono niczego :(</h3>");
	} else {
		echo("<h3>Zaneleziono ".$result->num_rows." wyniki :) !</h3>");
	}
		echo("<table id='travelsTab'>
				<tr>
				<td>Imie Nazwisko</td>
				<td>Cel</td>
				<td>Data kupna</td>
				<td>Cena<br />(z rab.)</td>
				<td>rabat</td>
				</tr>");
		echo("<tr>
				<form method='post'>
				<td><input value='".$_POST['nameF']."' type='text' name='nameF' onchange='this.form.submit()' /></td>
				<td><input value='".$_POST['destinationF']."' type='text' name='destinationF' onchange='this.form.submit()' /></td>
				<td><input value='".$_POST['dateOfSaleF']."' type='text' size='10' name='dateOfSaleF' onchange='this.form.submit()' /></td>
				<td><input value='".$_POST['priceF']."' type='text' size='7' name='priceF' onchange='this.form.submit()' /></td>
				<td><input value='".$_POST['discountF']."' type='text' size='4' name='discountF' onchange='this.form.submit()' />%</td>
				</form>
				</tr>");
		while($result->num_rows > 0 && $row = $result -> fetch_assoc()){
			$name = $row['name'];
			$destination = $row['destination'];
			$dateOfSale = $row['dateOfSale'];
			$price = $row['price'];
			$discount = $row['discount'];
			echo("
				<tr>
				<td>$name</td>
				<td>$destination</td>
				<td>$dateOfSale</td>
				<td>$price</td>
				<td>$discount</td>
				</tr>
			");
		}
		echo("</table>");

	echo("</center>");	
	require_once("footer.php");
?>
