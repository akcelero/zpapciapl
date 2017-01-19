<?php
	include_once('header.php');
	include_once('baseConnect.php');
	$id = -1;
	if(isset($_POST['addClient'])){
		echo("abcee");
		$name = $_POST['name'];
		$birth = $_POST['birth'];
		$adr = $_POST['address'];
		if(isset($_POST['addClient']) && isset($_POST['name']) && isset($_POST['birth']) && isset($_POST['address'])){
			$con->query("insert into clients(name, address, dateOfBirth) values('$name', '$adr', '$birth');");
		}
		$id = $con->insert_id;
	} else {
		if(isset($_POST['idClient'])){
			$id = $_POST['idClient'];
		}
	}

	$busyDay = 0;
	$busyStartFlight = 0;
	$busyEndFlight = 0;
	print_r($_POST);
	echo("<center>");
	if($id < 0){
		$showForm = 0;
		$result = $con -> query("select id, name from clients;");
		echo("<h3>Wybierz klienta</h3>");
		echo("<form method='POST'>
			Wybierz bamboszka:
			<select onchange='this.form.submit()' name='idClient'>	
			");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			echo(">".$row['name']."</option>");
		}
		echo("</select>");
		echo("</form>");
		echo("<h3>Lub dodaj</h3>");
		echo("
			<form method='POST' >
			<input type='hidden' name='option' value='add' />
			Imie nazwisko: <input type='text' class='name' name='name' /><br />
			Data urodzenia: <input type='date' size='10' class='birth' name='birth' /><br />
			Adres: <input type='text' class='address' name='address' /><br />
			<input type='submit' class='edit' name='addClient' value='Dodaj Bambosza!' />
			</form>
		");
	} else {
		$result = $con -> query("select id, name from workers;");
		echo("<form method='POST' action='addTravel2.php'>");
		echo("ID to: ".$id."<br />");
		echo("<input type='hidden' name='idClient' value='$id' />");
		echo("Wybierz bamboszka:
			<select name='idWorker'>	
			");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			if($_POST['idWorker']==$row['id']){
				echo(" selected ");
			}
			echo(">".$row['name']."</option>");
		}
		echo("</select>");
		echo("<br />");
		echo("<br />");
		 
		$result = $con -> query("select id, destination, price from flights;");
		echo("Wybierz lot: <select name='idFlight'>");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			if($_POST['idFlight']==$row['id']){
				echo(" selected ");
			}
			echo(">".$row['destination']." (".$row['price']."$)</option>");
		}
		echo("</select>");
		echo("<br />");
		echo("<span style='font-size:0.7em'> (cena za lot w jedną stronę*)</span>");
		echo("<br />");
		echo("<br />");
		$result = $con -> query("select id, address, pricePerNight,stars from hotels;");
		echo("Wybierz hotel: <select name='idHotel'>");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			if($_POST['idHotel']==$row['id']){
				echo(" selected ");
			}
			echo(">".$row['address']." ".$row['stars']."  (".$row['pricePerNight']."$)</option>");
		}
		echo("</select>");
		echo("<br />");
		echo("<span style='font-size:0.7em'> (cena za jedną noc*)</span>");
		echo("<br />");
		echo("<br />");
		echo("Data wylotu ");
		echo("<input type='date' name='dayStart' value='".$_POST['dayStart']."'/><br />");
		echo("Data powrotu ");
		echo("<input type='date' name='dayEnd' value='".$_POST['dayEnd']."' /><br />");
		echo("<br />");
		echo("<input type='submit' value='dalej' />");
		echo("</form>");

	}
	echo("</center>");



	include_once('footer.php');
?>
