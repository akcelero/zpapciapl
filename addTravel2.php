<?php
	require_once('header.php');
	require_once('baseConnect.php');
	print_r($_POST);
	Array ( [idClient] => 10 [idWorker] => 6 [idFlight] => 7 [idHotel] => 6 [dayStart] => 2017-01-03 [dayEnd] => 2017-01-28 )
	if(isset($_POST['idClient']) &&
			isset($_POST['idWorker']) &&
			isset($_POST['idFlight']) &&
			isset($_POST['idHotel']) &&
			isset($_POST['dayStart']) &&
			isset($_POST['dayEnd'])		
	) {
		$showForm = 0;
		$begin = new DateTime( $_GET['dayStart'] );
		$end   = new DateTime( $_GET['dayEnd'] );
		$idHotel = $_GET['idHotel'];
		$idFlight = $_GET['idFlight'];

		$d = new DateTime($begin."");
		$endDate = new DateTime($end."");

		while ($d <= $end) {
			
			$result = $con->query("select count(*)>(select numberOfPlaces from hotels where id = '$idHotel') as busy
				from travels where idHotel = '$idHotel' and dayStart <= '$d' and '$d' < dayEnd;");
			$row = $result->fetch_assoc();
			if($row['busy'] == "1"){
				$busyDay = 1;
			}
			$startDate->add(new DateInterval('P1D'));
		}

		$result = $con->query("select count(*)>=(select numberOfPlaces from flights where id = 1) as busy
			from travels where idFlight = 1 and dayStart = '$begin';");
		
		$row = $result->fetch_assoc();
		if($row['busy'] == "1"){
			$busyStartFlight = 1;
		}
		$result = $con->query("select count(*)>=(select numberOfPlaces from flights where id = 1) as busy
			from travels where idFlight = 1 and dayEnd = '$begin';");
		
		$row = $result->fetch_assoc();
		if($row['busy'] == "1"){
			$busyEndFlight = 1;
		}
		if($busyDay != 1 && $busyStartFlight != 1 && $busyEndFlight != 1){
			echo("wszystko ok");
		}
	}
	require_once('footer.php');
?>
