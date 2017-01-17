<?php
	include_once('header.php');
	include_once('baseConnect.php');

	if(isset($_POST['id']) || isset($_POST['add'])){
		$id = $_POST['id'];
		$hours = $_POST['hours'];
		$adr = $_POST['address'];
		if(isset($_POST['edit'])){
			$con->query("update places set address='$adr', openingHours='$hours' where id=$id;");
		} else if(isset($_POST['remove'])){
			$con->query("delete from places where id = '$id';");
		} else if(isset($_POST['add']) && isset($_POST['hours']) && isset($_POST['address'])){
			$con->query("insert into places(address, openingHours) values('$adr', '$hours');");
		}
		echo($con->error);
	}
	
	$result = $con -> query("select * from places;");

	echo("<center>");

	if($result == false){
		echo("Coś bamboszki nie chcą dać się edytować!");
		echo($con -> error);
	} else {
		echo ("<table id='clients'>");
		echo ("<tr><td>
				l.p.
				</td><td>
				Adres
				</td><td>
				Godziny otwarcia
				</td><td>
				Akcje
				</td></tr>");
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$hours = $row['openingHours'];
			$adr = $row['address'];
			echo("
				<tr>	
				<form method='POST'>
					<td>
					<input type='hidden' name='id' value='$id' />
					<b> $id </b>
					</td><td>
					<input type='text' class='address' name='address' value='$adr' />
					</td><td>
					<input type='text' class='hours' name='hours' value='$hours' />
					</td><td>
					<input type='submit' class='edit' name='edit' value='Edytuj' />
					<input type='submit' onclick='return confirm(\"Aby na pewno chcesz usunąć $adr?\")' class='remove' name='remove' value='Usuń' />
					</td>
				</form>
				</tr>
			");
		}
		echo("
			<form method='POST'>
			<td>
			<b>[..]</b>
			</td><td>
			<input type='hidden' name='option' value='add' />
			<input type='text' class='address' name='address' />
			</td><td>
			<input type='text' class='hours' name='hours' />
			</td><td>
			<input type='submit' class='edit' name='add' value='Dodaj Bambosza!' />
			</td>
			</form>
		");

		echo("</table>");
	}
	echo("</center>");

	include_once('footer.php');
?>

