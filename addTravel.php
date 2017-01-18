<?php
	include_once('header.php');
	include_once('baseConnect.php');
	$id = -1;
	if(isset($_POST['addClient'])){
		$name = $_POST['name'];
		$birth = $_POST['birth'];
		$adr = $_POST['address'];
		if(isset($_POST['add']) && isset($_POST['name']) && isset($_POST['birth']) && isset($_POST['address'])){
			$con->query("insert into clients(name, address, dateOfBirth) values('$name', '$adr', '$birth');");
		}
		$result = $con->query("select id from clients where name='$name' and address='$adr' and dateOfBirth='$birth';");
		$row = $result->fetch_assoc();
		$id = $row['id'];
	} else {
		if(isset($_POST['idClient'])){
			$id = $_POST['idClient'];
		}
	}

	$showForm = 1;
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
			<form method='POST'>
			<input type='hidden' name='option' value='add' />
			Imie nazwisko: <input type='text' class='name' name='name' /><br />
			Data urodzenia: <input type='text' size='10' class='birth' name='birth' /><br />
			Adres: <input type='text' class='address' name='address' /><br />
			<input type='submit' class='edit' name='addClient' value='Dodaj Bambosza!' />
			</form>
		");
	} elseif(isset($_POST['idWorker']) && isset($_POST['idFlight']) && isset($_POST['idHotel'])) {
		$showForm = 0;
		print_r($_POST);
	}
	if($showForm == 1){
		$result = $con -> query("select id, name from workers;");
		echo("<form method='POST'>");
		echo("ID to: ".$id."<br />");
		echo("<input type='hidden' name='idClient' value='$id' />");
		echo("<form metho='GET'>
			Wybierz bamboszka:
			<select name='idWorker'>	
			");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			if($_POST['idWorker']==$row['id']){
				echo(" checked ");
			}
			echo(">".$row['name']."</option>");
		}
		echo("</select>");
		echo("<br />");
		 
		$result = $con -> query("select id, destination, price from flights;");
		echo("Wybierz lot: <select name='idFlight'>");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			if($_POST['idFlight']==$row['id']){
				echo(" checked ");
			}
			echo(">".$row['destination']." (".$row['price']."$)</option>");
		}
		echo("</select>");
		echo("<br />");
		$result = $con -> query("select id, address, pricePerNight from hotels;");
		echo("Wybierz lot: <select name='idHotel'>");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			if($_POST['idHotel']==$row['id']){
				echo(" checked ");
			}
			echo(">".$row['address']."  (".$row['pricePerNight']."$)</option>");
		}
		echo("</select>");
		echo("<br />");
		echo("Data wylotu ");
		echo("<input type='date' name='dayStart' /><br />");
		echo("Data powrotu ");
		echo("<input type='date' name='dayEnd' /><br />");
		echo("<br />");
		echo("<input type='submit' value='dalej' />");
		echo("</form>");

	}
	echo("</center>");



	include_once('footer.php');
?>
