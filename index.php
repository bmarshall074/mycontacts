<?php
// Must be called first to have access to any session data
session_start();

// "Import" functions - require copies and pastes the content of the file being called here
require('config/db.php');
require('config/app.php');
require('lib/functions.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css" />
		<!-- MyContacts CSS -->
		<link rel="stylesheet" type="text/css" href="styles.css" />
		<title>MyContacts</title>
		<!-- jQuery JS -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="wrapper" class="container">
			<header>
				<?php include('layout/header.php') ?>
			</header>
			<nav>
				<?php include('layout/nav.php') ?>
			</nav>
			<section role="main">
				<?php include('layout/main.php') ?>
			</section>
			<footer>
				<?php include('layout/footer.php') ?>
			</footer>
		</div>
	</body>
</html>