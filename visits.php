<?php
	include_once('header.php');
	include_once('baseConnect.php');

	echo("<center>");
	echo("<h1>Szukaj Bamboszy</h1>");
	if(isset($_POST['add'])){
		$idClient = $_POST['idClient'];
		$idPlace = $_POST['idPlace'];
		$con->query("insert into visits(idClient, idPlace, data) values('$idClient', '$idPlace', CURDATE());");
		echo("Dodano wizytę!");
	}

	$clients = $con -> query('Select * from clients;');
	$places = $con -> query('Select * from places');

	echo("<div id='visit'>");
	echo("<div id='visitByClient'>");
	echo("<h3>Szukaj po kliencie</h3>");
	echo("<form method='post'>
		<input type='hidden' name='byClient' />
		<select name='id'>
		");
	while($row = $clients->fetch_assoc()){
		$id = $row['id'];
		$name = $row['name'];
		echo("
			<option value='$id'
			");
		if($_POST['id'] === $id && isset($_POST['byClient'])){
			echo(" selected ");
		}
		echo(">$name</option>
			");
	}
	echo("</select>
		<input type='submit' value='Szukaj!' />
		</form>
		");
	echo("</div>");
	echo("<div id='visitByPlace'>");
	echo("<h3>Szukaj po palcówce</h3>");
	echo("<form method='post'>
		<input type='hidden' name='byPlace' />
		<select name='id'>
		");
	while($row = $places->fetch_assoc()){
		$id = $row['id'];
		$adr = $row['address'];
		echo("
			<option value='$id'
			");
		if($_POST['id'] === $id && isset($_POST['byPlace'])){
			echo(" selected ");
		}
		echo(">$adr</option>
			");
	}
	echo("</select>
		<input type='submit' value='Szukaj!' />
		</form>
		");
	echo("</div>");
	echo("</div>");
	// -------------------------------------------------------------

	$clients = $con -> query('Select * from clients;');
	$places = $con -> query('Select * from places');
	echo("<tr />");
	echo("<form method='post'>
		Dodaj wizytę: 
		<select name='idPlace'>
		");
	while($row = $places->fetch_assoc()){
		$id = $row['id'];
		$adr = $row['address'];
		echo("
			<option value='$id'>$adr</option>
			");
	}
	echo("</select>");
	echo("
		<select name='idClient'>
		");
	while($row = $clients->fetch_assoc()){
		$id = $row['id'];
		$name = $row['name'];
		echo("
			<option value='$id'>$name</option>
			");
	}
	echo("</select>
		<input type='submit' name='add' value='Dodaj!' />
		</form>
		");
	if(isset($_POST['byPlace'])){
		$condition = "places.id = '".$_POST['id']."'";
	} else if(isset($_POST['byClient'])){
		$condition = "clients.id = '".$_POST['id']."'";
	}
	
	if(isset($condition)){
		$result = $con -> query("select visits.id, data, name, places.address from
		clients inner join visits on idClient=clients.id
		join places on idPlace=places.id
		where ".$condition." order by data;");

		echo("<table id='visits'>");
		echo("<tr><td>l.p.</td><td>data</td><td>Imię i nazwisko</td><td>adres</td>");
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$data = $row['data'];
			$name = $row['name'];
			$adr = $row['address'];
			echo("<tr><td>$id</td><td>$data</td><td>$name</td><td>$adr</td></tr>");
			
		}
		echo("</table>");
	}



	// -------------------------------------------------------------

	echo("</ center>");
	include_once('footer.php');
?>
