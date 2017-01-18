<?php
	include_once('header.php');
	include_once('baseConnect.php');

	if(isset($_POST['id']) || isset($_POST['add'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$birth = $_POST['birth'];
		$adr = $_POST['address'];
		$idBoss = $_POST['idBoss'];
		if(isset($_POST['edit'])){
			$con->query("update workers set name='$name', address='$adr', dateOfBirth='$birth' where id=$id;");
			$con->query("update bossOf set idBoss='$idBoss' where idWorker='$id';");
		} else if(isset($_POST['remove'])){
			$con->query("delete from workers where id = '$id';");
		} else if(isset($_POST['add']) && isset($_POST['name']) && isset($_POST['birth']) && isset($_POST['address'])){
			$con->query("insert into workers(name, address, dateOfBirth) values('$name', '$adr', '$birth');");
		}
		echo($con->error);
	}
	
	$result = $con -> query("select * from workers;");

	echo("<center>");

	if($result == false){
		echo("Coś bamboszki nie chcą dać się edytować!");
		echo($con -> error);
	} else {
		echo ("<table id='workers'>");
		echo ("<tr><td>
				l.p.
				</td><td>
				Imię nazwisko
				</td><td>
				Data uro.
				</td><td>
				Adres
				</td><td>
				Szef
				</td><td>
				Akcje
				</td></tr>");
		$options = "";
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];
			$options[] = array($id, $name);
		}
		$result = $con -> query("select id, name, dateOfBirth, address, idBoss from workers inner join bossOf on workers.id=idWorker order by id;");
		while($row = $result->fetch_assoc()){
			$id=$row['id'];
			$name=$row['name'];
			$birth=$row['dateOfBirth'];
			$address=$row['address'];
			echo("
				<tr>	
				<form method='POST'>
					<td>
					<input type='hidden' name='id' value='$id' />
					<b> $id </b>
					</td><td>
					<input type='text' class='name' name='name' value='$name' />
					</td><td>
					<input type='text' class='birth' name='birth' value='$birth' />
					</td><td>
					<input type='text' class='address' name='address' value='$address' />
					</td><td>
					<select name='idBoss'>");

			foreach($options as $op){
				echo("<option value='".$op[0]."' ");
				if($op[0]==$row['idBoss']){
					echo("selected");
				}
				echo(">".$op[1]."</option>");
			}


			echo("</select>
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
			<input type='text' class='name' name='name' />
			</td><td>
			<input type='text' class='birth' name='birth' />
			</td><td>
			<input type='text' class='address' name='address' />
			</td><td>
			<select name='idBoss'>");
		foreach($options as $op){
			echo("<option value='".$op[0]."' >".$op[1]."</option>");
		}
		echo("</select>
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

