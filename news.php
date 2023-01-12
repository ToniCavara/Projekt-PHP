<?php
	
	if (isset($action) && $action != '') {
		$query  = "SELECT * FROM vijesti";
		$query .= " WHERE id=" . $_GET['action'];
		$result = @mysqli_query($Baza, $query);
		$row = @mysqli_fetch_array($result);

        $_query = "SELECT * FROM slike WHERE id_vijesti =" . $row['id'];
		$_result = @mysqli_query($Baza, $_query);

			print '
			<div class="news">
			<h1>VIJESTI</h1>';
            while ($_row = @mysqli_fetch_array($_result)) {
                print'
                    <img src="news/' . $_row['naziv'] . '" alt="' . $_row['naziv'] . '" title="' . $_row['naziv'] . '">
                    ';
		    }
            print '
				<hr>
                <h2>' . $row['naslov'] . '</h2>
				<p>'  . $row['opis'] . '</p>
				<p><time datetime="' . $row['datum'] . '">' . DatumVijestiMysql($row['datum']) . '</time></p>
				<hr>
			</div>';
	}
	else {
		print '<h1>VIJESTI</h1>';
		$query  = "SELECT * FROM vijesti";
		$query .= " WHERE arhiva='N'";
		$query .= " ORDER BY datum DESC";
		$result = @mysqli_query($Baza, $query);

		while($row = @mysqli_fetch_array($result)) {
            $_query = "SELECT * FROM slike WHERE id_vijesti =" . $row['id'] . " LIMIT 1";
		    $_result = @mysqli_query($Baza, $_query);
			$_row = @mysqli_fetch_array($_result);

			print '
			<div class="news">
				<a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '"><img src="news/' . $_row['naziv'] . '" alt="' . $_row['naziv'] . '" title="' . $_row['naziv'] . '"></a>
                <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '"><h2>' . $row['naslov'] . '</h2></a>';
				if(strlen($row['opis']) > 300) {
					echo substr(strip_tags($row['opis']), 0, 300).'... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '">Više</a>';
				} else {
					echo strip_tags($row['opis']);
				}
				print '
				<p><time datetime="' . $row['datum'] . '">' . DatumVijestiMysql($row['datum']) . '</time></p>
				<hr>
			</div>';
		}
	}
?>