<?php
	include_once('header.php');
	include_once('baseConnect.php');

	if(isset($_POST['id']) || isset($_POST['add'])){
		$id = $_POST['id'];
		$numberOfPlaces = $_POST['numberOfPlaces'];
		$adr = $_POST['address'];
		$pricePerNight = $_POST['pricePerNight'];
		$stars = $_POST['stars'];
		$block = isset($_POST['block'])?1:0;
		if(isset($_POST['edit'])){
			$con->query("update hotels set pricePerNight='$pricePerNight', stars='$stars', block='$block', numberOfPlaces='$numberOfPlaces' where id=$id;");
		} else if(isset($_POST['remove'])){
			$con->query("delete from hotels where id = '$id';");
		} else if(isset($_POST['add']) && isset($_POST['numberOfPlaces']) && isset($_POST['address'])){
			$con->query("insert into hotels(address, numberOfPlaces, stars) values('$adr', '$numberOfPlaces', '$stars');");
		}
		echo($con->error);
	}
	
	$result = $con -> query("select * from hotels;");

	echo("<center>");

	if($result == false){
		echo("Coś bamboszki nie chcą dać się edytować!");
		echo($con -> error);
	} else {
		echo ("<table id='hotels'>");
		echo ("<tr><td>
				l.p.
				</td><td>
				Adres
				</td><td>
				Ilość miejsc
				</td><td>
				Cena/noc
				</td><td>
				Ban
				</td><td>
				Ocena
				</td><td>
				Akcje
				</td></tr>");
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$numberOfPlaces = $row['numberOfPlaces'];
			$address = $row['address'];
			$stars = $row['stars'];
			$block = $row['block'];
			$price = $row['pricePerNight'];
			echo("
				<tr>	
				<form method='POST'>
					<td>
					<input type='hidden' name='id' value='$id' />
					<b> $id </b>
					</td><td>
					$address
					</td><td>
					<input type='text' size='5' class='birth' name='numberOfPlaces' value='$numberOfPlaces' />
					</td><td>
					<input type='text' size='7' class='price' name='pricePerNight' value='$price' />
					</td><td>
					<input type='checkbox' size='1'name='block' ".($block==1?"checked":"")." size='1'/>
					</td><td>
					<input type='text' size='6' name='stars' value='$stars' />
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
			<input type='text' class='address' name='address' />
			</td><td>
			<input type='text' size='5' class='numberOfPlaces' name='numberOfPlaces' />
			</td><td>
			<input type='text' size='7' class='price' name='price' />
			</td><td>
			</td><td>
			<input type='text' size='6' name='stars' />
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

