<?php 
	print '
	<h1>Registracija</h1>
	<div id="registracija">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" id="forma_registracija" name="forma_registracija" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="fname">Ime *</label>
			<input type="text" id="fname" name="firstname" placeholder="Vaše ime..." required>
			<label for="lname">Prezime *</label>
			<input type="text" id="lname" name="lastname" placeholder="Vaše prezime..." required>
				
			<label for="email">E-mail adresa *</label>
			<input type="email" id="email" name="email" placeholder="Vaša e-mail adresa.." required>
			
			<label for="username">Korisničko ime:* <small>(Korisničko ime mora imati 5-10 znakova)</small></label>
			<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Korisničko ime..." required><br>
			
									
			<label for="password">Lozinka:* <small>(Lozinka mora imati minimalno 4 znaka)</small></label>
			<input type="password" id="password" name="password" placeholder="Lozinka..." pattern=".{4,}" required>
			<label for="country">Država:</label>
			<select name="country" id="country">
				<option value="">Molimo odaberite:</option>';
				#Sve države iz tablice countries
				$query  = "SELECT * FROM countries";
				$result = @mysqli_query($Baza, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
				}
			print '
			</select>
			<label for="city">Grad</label>
			<input type="text" id="city" name="city" placeholder="Grad...">
			<label for="address">Adresa</label>
			<input type="text" id="address" name="address" placeholder="Adresa...">
			<label for "date">Datum rođenja:</label>
			<input type="date" name="date" id="date">
			<input type="submit" value="Registriraj se">
			
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM korisnici";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR korisnicko_ime='" .  $_POST['username'] . "'";
		$result = @mysqli_query($Baza, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (!isset ($row['email']) || !isset($row['korisnicko_ime'])) {
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO korisnici (ime, prezime, email, korisnicko_ime, lozinka, drzava, grad, ulica, datum_rodenja)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "','" . $_POST['city'] . "','" . $_POST['address'] . "','" . $_POST['date'] . "')";
			$result = @mysqli_query($Baza, $query);
			
			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', hvala na registraciji! </p>
			<hr>';
		}
		else {
			echo '<p>Korisnik s tim korisničkim imenom ili e-mail adresom već postoji!</p>';
		}
	}
	print '
	</div>';
?>