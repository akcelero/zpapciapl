<?php
	require_once('header.php');
	require_once('baseConnect.php');
	echo("<center>");
	// Array ( [idClient] => 10 [idWorker] => 6 [idFlight] => 7 [idHotel] => 6 [dayStart] => 2017-01-03 [dayEnd] => 2017-01-28 )
	// Array ( [idClient] => 10 [idWorker] => 8 [idFlight] => 8 [idHotel] => 5 [dayStart] => 2017-01-01 [dayEnd] => 2017-01-02 [approved] => akceptuj! )
	if(isset($_POST['approved'])){
		print_r($_POST);
		$result = $con -> query("insert into travels(idClient, idWorker, idPlace, idFlight, idHotel, dateOfSale, price, discount, dayStart, dayEnd)
				values(
					'".$_POST['idClient']."',
					'".$_POST['idWorker']."',
					'".$_POST['idPlace']."',
					'".$_POST['idFlight']."',
					'".$_POST['idHotel']."',
					curdate(),
					'".$_POST['price']."',
					'".$_POST['discount']."',
					'".$_POST['dayStart']."',
					'".$_POST['dayEnd']."');");
		print_r($result);
		echo("<h1>Wycieczka zatwierdzona!</h1>");

	}else if(isset($_POST['idClient']) &&
			isset($_POST['idWorker']) &&
			isset($_POST['idFlight']) &&
			isset($_POST['idHotel']) &&
			isset($_POST['dayStart']) &&
			isset($_POST['dayEnd'])		
	) {
		if(isset($_POST['approved'])){
			echo("<h1>Wycieczka zatwierdzona!</h1>");
		} else {
			$error = 0;
			$begin = $_POST['dayStart'];
			$end   = $_POST['dayEnd'];
			$idHotel = $_POST['idHotel'];
			$idFlight = $_POST['idFlight'];
			$idClient = $_POST['idClient'];
			$idWorker = $_POST['idFlight'];

	
			$result = $con->query("select count(*)>=(select numberOfPlaces from flights where id = $idFlight) as busy
				from travels where idFlight = $idFlight and dayStart = '$begin';");
			if($result -> num_rows > 0){
				// echo("<h1>Za dużo odlotów w dzień początku wycieczki</h1>");
				// $error=1;
			}
	
			$result = $con->query("select count(*)>=(select numberOfPlaces from flights where id = $flight) as busy
				from travels where idFlight = $idFlight and dayEnd = '$begin';");
			if($result -> num_rows > 0){
				// echo("<h1>Za dużo odlotów w dzień końca wycieczki</h1>");
				// $error=1;
			}
	
			$result = $con->query("select 1 from hotels where block='1' and id='$idHotel';");
			if($result -> num_rows > 0){
				echo("<h1>Hotel znajduje się na czarnej liście!</h1>");
				$error=1;
			}
	
			$result = $con->query("select 1 from flights where block='1' and id='$idFlight';");
			if($result -> num_rows){
				echo("<h1>Połączenie lotnicze znajduje się na czarnej liście!</h1>");
				$error=1;
			}
			
			if($error == 1){
				echo("<form method='POST' action='addTravel.php' >
				<input type='hidden' name='idClient' value='$idClient' />
				<input type='hidden' name='idWorker' value='$idWorker' />
				<input type='hidden' name='idFlight' value='$idFlight' />
				<input type='hidden' name='idHotel' value='$idHotel' />
				<input type='hidden' name='dayStart' value='$begin' />
				<input type='hidden' name='dayEnd' value='$end' />
				<input type='submit' value='Wróć do edycji' />");
			} else {
				$result = $con->query("select name from workers where id='$idWorker';");
				$row = $result->fetch_assoc();
				$nameWorker = $row['name'];
				
				
				$result = $con->query("select name from clients where id='$idClient';");
				$row = $result->fetch_assoc();
				$nameClient = $row['name'];

				$result = $con->query("select destination,price from flights where id='$idFlight';");
				$row = $result->fetch_assoc();
				$nameFlight = $row['destination'];
				$priceFlight = $row['price'];

				$result = $con->query("select address,pricePerNight from hotels where id='$idHotel';");
				$row = $result->fetch_assoc();
				$addressHotel = $row['address'];
				$priceHotel = $row['pricePerNight'];

				$result = $con->query("select count(*) as sum from travels where idClient='$idClient';");
				$row = $result->fetch_assoc();
				$countOfClientTravels = $row['sum'];
				
				
				$result = $con->query("select count(*) as sum from visits where idClient='$idClient';");
				$row = $result->fetch_assoc();
				$countOfClientVisits = $row['sum'];


				$discount = min(10, $countOfClientVisits) + min(2, $countOfClientTravels/4);

				$datetime1 = new DateTime($begin);
				$datetime2 = new DateTime($end);
				$interval = $datetime1->diff($datetime2);
				$time = $interval->days;
				$totalPrice = 2*$priceFlight + $time*$priceHotel;
				$totalPriceAfterDiscount = $totalPrice - ($totalPrice*$discount)/100;


				echo("<form method='POST'>
				<input type='hidden' name='idClient' value='$idClient' />
				<input type='hidden' name='idWorker' value='$idWorker' />
				<input type='hidden' name='idFlight' value='$idFlight' />
				<input type='hidden' name='idHotel' value='$idHotel' />
				<input type='hidden' name='dayStart' value='$begin' />
				<input type='hidden' name='dayEnd' value='$end' />
				<input type='hidden' name='price' value='$totalPriceAfterDiscount' />
				<input type='hidden' name='discount' value='$discount' />
				<table id='travelForm'>
				<tr><td>Imię i nazwisko klienta: </td><td>$nameClient<td></tr>
				<tr><td>Imię i nazwisko pracownika: </td><td>$nameWorker<td></tr>
				<tr><td>Cel lotu: </td><td>$nameFlight</td></tr>
				<tr><td>Cena lotu: </td><td>$priceFlight$</td></tr>
				<tr><td>Adres hotelu: </td><td>$addressHotel</td></tr>
				<tr><td>Cena hotelu za noc: </td><td>$priceHotel</td></tr>
				<tr><td>Cena ogółem: </td><td>$totalPrice$</td></tr>
				<tr><td>Wliczony rabat: </td><td>$discount%</td></tr>
				<tr><td>Cena z rabatem: </td><td>$totalPriceAfterDiscount$</td></tr>
				</table>
				<input type='submit' name='approved' value='akceptuj!' />
				</form>
				");
			}
		}
	} else {
		echo("<h1>UZUPEŁNIJ WSZYSTKO!</h1>");
	}
	echo("<center>");
	require_once('footer.php');
?>
