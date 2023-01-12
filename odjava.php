<?php
	session_start();
	
	
	unset($_POST);
	unset($_SESSION['user']);

	$_SESSION['user']['valid'] = 'false';
	$_SESSION['message'] = '<p>Uspješna odjava!</p>';
	
	header("Location: index.php?menu=1");
	exit;
?>