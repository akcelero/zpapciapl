<?php
	include_once('baseConnect.php');
	if($_POST['type']=="add"){
		$con->query("insert into workers(name, dateOfBirth, address) values(
			'".$_POST['name']."', '".$_POST['birth']."', '".$_POST['address']."');");
		$result = $con->query("select id from workers where name='".$_POST['name']."'
				and dateOfBirth='".$_POST['birth']."' and address='".$_POST['address']."';");
		$row = $result->fetch_assoc();
		$id = $row['id'];
		$con->query("insert into workIn(idWorker, idPlace, agreement, salary, position) values(
			'".$id."',
			'".$_POST['idPlace']."',
			'".$_POST['agreement']."',
			'".$_POST['salary']."',
			'".$_POST['position']."');");
		$con->query("insert into bossOf(idWorker, idBoss) values('".$id."','".$_POST['idBoss']."');");
		echo($con->error);
	}

	if((isset($_POST['id']) && $_POST['id']>-1) || isset($_POST['add'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$birth = $_POST['birth'];
		$adr = $_POST['address'];
		$idBoss = $_POST['idBoss'];
		$salary = $_POST['salary'];
		$agreement = $_POST['agreement'];
		$idPlace = $_POST['idPlace'];
		$position = $_POST['position'];

		if(isset($_POST['edit'])){
			$con->query("update workers set name='$name', address='$adr', dateOfBirth='$birth' where id=$id;");
			$con->query("update bossOf set idBoss='$idBoss' where idWorker='$id';");
			$con->query("update workIn set idPlace='$idPlace', agreement='$agreement', salary='$salary', position='$position' where idWorker='$id';");
		} else if(isset($_POST['remove'])){
			$con->query("delete from workers where id = '$id';");
			header("Location: workers.php"); 
		} else if(isset($_POST['add']) && isset($_POST['name']) && isset($_POST['birth']) && isset($_POST['address'])){
			$con->query("insert into workers(name, address, dateOfBirth) values('$name', '$adr', '$birth');");
		}
		echo($con->error);
	}
	include_once('header.php');
	
	$result = $con -> query("select id, name from workers;");

	echo("<center>");

	if(!isset($_GET['id']) || $_GET['id']<0){
		echo("<form method='GET'>
			<h3>Wybierz bamboszka:</h3>
			<select onchange='this.form.submit()' name='id'>	
			");
		echo("<option value='-1' selected>-----</option>");
			while($row = $result->fetch_assoc()){
				echo("<option value='".$row['id']."' ");
				echo(">".$row['name']."</option>");
			}
		echo("</select>");
		echo("</form>");
		echo("<form method='POST'>");
		echo("<input type='hidden' name='type' value='add' />");
		echo("<h3>Lub utwórz:</h3>");
		echo("Imie Nazwisko <input type='text' name='name' /><br />");
		echo("Data urodzenia <input type='date' name='birth' /><br />");
		echo("Posada <input type='text' name='position' /><br />");
		$result = $con -> query("select id, name from workers;");
		echo("Szef: <select name='idBoss'>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			echo(">".$row['name']."</option>");
		}
		echo("</select><br />");
		echo("Adres <input type='text' name='address' /><br />");
		echo("Pensja <input type='text' name='salary' /><br />");
		echo("Data umowy <input type='date' name='agreement' /><br />");
		$result = $con -> query("select id, address from places;");
		echo("Placówka <select name='idPlace'>");
		echo("<option value='-1' selected>-----</option>");
		while($row = $result->fetch_assoc()){
			echo("<option value='".$row['id']."' ");
			echo(">".$row['address']."</option><br />");
		}
		echo("</select><br />");
		echo("<input type='submit' value='stwórz' />");

		echo("</form>");

	} else {
		$result = $con -> query("select * from workers;");
		$options = [];
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];
			$options[] = array($id, $name);
		}

		$result = $con -> query("select * from places;");
		$places = [];
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$adres = $row['address'];
			$places[] = array($id, $adres);
		}
		
		$id = $_GET['id'];
		$result = $con -> query("
				select
					workers.dateOfBirth,
					workers.name,
					workers.address,
					bossOf.idBoss,
					workIn.idPlace,
					workIn.agreement,
					workIn.salary,
					workIn.position
				from workers
					inner join workIn on workIn.idWorker=workers.id
					inner join bossOf on workers.id=bossOf.idWorker
					inner join workers as boss on bossOf.idBoss=boss.id
					where workers.id = $id;
				");
		$row = $result->fetch_assoc();
		$id=$_GET['id'];
		$name=$row['name'];
		$birth=$row['dateOfBirth'];
		$address=$row['address'];
		$salary=$row['salary'];
		$position=$row['position'];
		$agreement=$row['agreement'];

		echo("
			<h2>Edytuj klapucia $name!</h2>
			<form method='POST'>
			<table>
			<input type='hidden' name='id' value='$id' />
			<tr><td>
			Imię nazwisko
			</td><td>
			<input type='text' name='name' value='$name' />
			</td></tr><tr><td>
			Data urodzenia
			</td><td>
			<input type='text' class='birth' name='birth' value='$birth' />
			</td></tr><tr><td>
			Pozycja
			</td><td>
			<input type='text' class='address' name='position' value='$position' />
			</td></tr><tr><td>
			Szef
			</td><td>
			<select name='idBoss'>");
		foreach($options as $op){
			echo("<option value='".$op[0]."' ");
			if($op[0]==$row['idBoss']){
				echo("selected");
			}
			echo(">".$op[1]."</option>");
		}
		echo("</select></td></tr><tr><td>");
		echo("
			Adres
			</td><td>
			<input type='text' class='address' name='address' value='$address' />
			</td></tr><tr><td>
			Pensja
			</td><td>
			<input type='text' class='address' name='salary' value='$salary' />
			</td></tr><tr><td>
			Do kiedy umowa
			</td><td>
			<input type='text' class='address' name='agreement' value='$agreement' />
			</td></tr><tr><td>
			Placówka
			</td><td>
			<select name='idPlace'>");
		foreach($places as $op){
			echo("<option value='".$op[0]."' ");
			if($op[0]==$row['idPlace']){
				echo("selected");
			}
			echo(">".$op[1]."</option>");
		}
		echo("</select></td></tr>
				<tr><td><input type='submit' name='edit' value='edytuj!' /></td>
				<td><input type='submit' name='remove' value='usuń!' /></td></tr>");

		echo("");

		echo("<table />");
	}

	echo("</center>");

	include_once('footer.php');
?>

