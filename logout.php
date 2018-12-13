<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		
	</head>
	<body>
		<?php unset($_SESSION['User']); AddMenu(); ?>
		<center>
		<div style="display:inline-block">
			<div class="product-header">Logout erfolgreich</div>
			<div class="product-desc">Du wirst nun zur Hauptseite umgeleitet</div>
		</div>
		</center>
		<?php 
			echo "<script>setTimeout(function(){ document.location.href = 'index.php'; }, 3000);</script>"; 
		?>
		<?php AddFooter(); ?>
	</body>
</html>