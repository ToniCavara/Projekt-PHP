<?php

session_start();

if(!isset($_POST['_action_'])) {
	$_POST['_action_'] = FALSE;
}
if (!isset($menu)) {
	$menu = 1; 
}
if(isset($_GET['menu'])) { 
	$menu   = (int)$_GET['menu']; 
}
if(isset($_GET['action'])) {
	$action   = (int)$_GET['action']; 
}


include ("dbconn.php");

include_once("funkcije.php");


print '
<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="UTF-8">
		<title>Napredne tehnike programiranja - projekt</title>
		<meta http-equiv="content-type" content="text/html">
		<meta name="description" content="Prva vjezba">
		<meta name="keywords" content="HTML, CSS">
		<meta name="author" content="Toni Čavara">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style.css">
	</head>
<body>
	<header>
		<div'; if ($_GET['menu']>1) {print ' class="hero1"'; } else { print ' class="hero"'; }  print '></div>
		<nav>';
			include("menu.php");
			print'
		</nav>
	</header>
	<main>';
	if (isset($_SESSION['message'])) {
		print $_SESSION['message'];
		unset($_SESSION['message']);
	}
	# Početna
	if (!isset($_GET['menu']) || $_GET['menu'] == 1) { include("home.php"); }
	
	# Vijesti
	else if ($_GET['menu'] == 2) { include("news.php"); }
	
	# Kontakt
	else if ($_GET['menu'] == 3) { include("contact.php"); }
	
	# O nama
	else if ($_GET['menu'] == 4) { include("aboutus.php"); }

	# Galerija
	else if ($_GET['menu'] == 5) { include("gallery.php"); }

	# Registracija
	else if ($_GET['menu'] == 6) { include("registracija.php"); }

	# Prijava
	else if ($_GET['menu'] == 7) { include("prijava.php"); }

	# Administracija
	else if ($_GET['menu'] == 8) { include("admin.php"); }

	print '
	</main>
	<footer>
		<p>Toni Čavara &copy; 2022 <a href="https://github.com/ToniCavara"><img src="img/GitLogo.png" title="Github" alt="Github"></a></p>
	</footer>
</body>
</html>';
?>