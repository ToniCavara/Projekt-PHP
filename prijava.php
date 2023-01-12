<?php 
	print '
	<h1>Prijava</h1>
	<div id="prijava">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="forma_prijava" id="forma_prijava" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<label for="username">Korisničko ime:*</label>
			<input type="text" id="username" name="username" value="" pattern=".{5,10}" required>
									
			<label for="password">Lozinka:*</label>
			<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
									
			<input type="submit" value="Prijava">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM korisnici";
		$query .= " WHERE korisnicko_ime='" .  $_POST['username'] . "'";
		$result = @mysqli_query($Baza, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (password_verify($_POST['password'], $row['lozinka']) && $row['prava'] != 0 && $row['arhiva'] == 'N') {

			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['firstname'] = $row['ime'];
			$_SESSION['user']['lastname'] = $row['prezime'];
			$_SESSION['user']['role'] = $row['prava'];
			$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';

			if ($row['prava'] == 2 || $row['prava'] == 3){
				header("Location: index.php?menu=8");
			}
			if ($row['prava'] == 1){
				header("Location: index.php?menu=1");
			}
		}
		else if ($row['arhiva'] == 'Y'){
			$_SESSION['message'] = '<p>Vaš račun je arhiviran!</p>';
			header("Location: index.php?menu=7");
		}
		else if ($row['prava'] == 0){
			$_SESSION['message'] = '<p>Još nemate pravo prijave!</p>';
			header("Location: index.php?menu=7");
		}
		else {
			unset($_SESSION['user']);
			$_SESSION['message'] = '<p>Krivo korisničko ime ili lozinka!</p>';
			header("Location: index.php?menu=7");
		}
	}
	print '
	</div>';
?>