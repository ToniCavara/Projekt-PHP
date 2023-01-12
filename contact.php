<?php
	print '
		<h1>Kontakt</h1>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5566.271398978846!2d15.850565008791232!3d45.76847064818622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d3b49d3d13d7%3A0xa3f51a5b2a7a496e!2sAerodrom%20Lu%C4%8Dko!5e0!3m2!1shr!2shr!4v1670537621795!5m2!1shr!2shr" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		<div id="contact">';
		if ($_POST['_action_'] == FALSE) {
			print '
			<form action="" id="kontakt_forma" name="kontakt_forma" method="POST">
				<input type="hidden" id="_action_" name="_action_" value="TRUE">

				<label for="fname">Ime *</label>
				<input type="text" id="fname" name="firstname" placeholder="Vaše ime..." required>

				<label for="lname">Prezime *</label>
				<input type="text" id="lname" name="lastname" placeholder="Vaše prezime..." required>
				
				<label for="email">E-mail adresa *</label>
				<input type="email" id="email" name="email" placeholder="Vaša e-mail adresa..." required>

				<label for="country">Država</label>
				<select id="country" name="country">
				  <option value="">Odaberite:</option>';
					#Sve države iz tablice countries
					$query  = "SELECT * FROM countries";
					$result = @mysqli_query($Baza, $query);
					while($row = @mysqli_fetch_array($result)) {
						print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
					}
				print '
				</select>

				<label for="message">Upit</label>
				<textarea id="message" name="message" placeholder="Vaš upit..." style="height:200px"></textarea>

				<input type="submit" value="Pošalji">
			</form>';
		}
		if ($_POST['_action_'] == TRUE) {
			$query  = "INSERT INTO kontakt (ime, prezime, email, drzava, poruka)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['country'] . "','" . $_POST['message'] . "')";
			$result = @mysqli_query($Baza, $query);
			echo '<p>Zahvaljujemo na Vašem upitu!</p>';
		}

		
		print '
		</div>
		<div id="info">
			<h1>Padobranski klub</h1>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
			<p>Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
			<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
			<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
		</div>';
?>