<?php
	include_once('header.php');
	include_once('baseConnect.php');

	if(isset($_POST['id']) || isset($_POST['add'])){
		$id = $_POST['id'];
		$destination = $_POST['destination'];
		$price = $_POST['price'];
		$numberOfPlaces = $_POST['numberOfPlaces'];
		if(isset($_POST['edit'])){
			$con->query("update flights set numberOfPlaces='$numberOfPlaces', price='$price', destination='$destination'  where id=$id;");
		} else if(isset($_POST['remove'])){
			$con->query("delete from flights where id = '$id';");
		} else if(isset($_POST['add']) && isset($_POST['price']) && isset($_POST['numberOfPlaces']) && isset($_POST['destination'])){
			$con->query("insert into flights(numberOfPlaces, price, destination) values('$numberOfPlaces', '$price', '$destination');");
		}
		echo($con->error);
	}
	
	$result = $con -> query("select * from flights;");

	echo("<center>");

	if($result == false){
		echo("Coś bamboszki nie chcą dać się edytować!");
		echo($con -> error);
	} else {
		echo ("<table id='flights'>");
		echo ("<tr><td>
				l.p.
				</td><td>
				Cel
				</td><td>
				Cena
				</td><td>
				Ilość miejsc
				</td><td>
				Akcje
				</td></tr>");
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$destination = $row['destination'];
			$price = $row['price'];
			$date = $row['date'];
			$numberOfPlaces = $row['numberOfPlaces'];
			echo("
				<tr>	
				<form method='POST'>
					<td>
					<input type='hidden' name='id' value='$id' />
					<b> $id </b>
					</td><td>
					<input type='text' class='destination' name='destination' value='$destination' />
					</td><td>
					<input type='text' class='price' name='price' value='$price' />
					</td><td>
					<input type='text' class='numberOfPlaces' name='numberOfPlaces' value='$numberOfPlaces' />
					</td><td>
					<input type='submit' class='edit' name='edit' value='Edytuj' />
					<input type='submit' onclick='return confirm(\"Aby na pewno chcesz usunąć $name?\")' class='remove' name='remove' value='Usuń' />
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
			<input type='text' class='destination' name='destination' />
			</td><td>
			<input type='text' class='price' name='price' />
			</td><td>
			<input type='text' class='numberOfPlaces' name='numberOfPlaces' />
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

