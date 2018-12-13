<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'database_login.php'; ?>
		<?php 
		
			$update = "Update Accounts set Username='".$_POST['Username']."', Vorname='".$_POST['Vorname']."', Nachname='".$_POST['Nachname']."', Klasse='".$_POST['Klasse']."' where Username = '".$_SESSION['User']."'";
			
			$returnstr = "Profiländerung fehlgeschlagen";
			if(mysql_query($update)){
				$returnstr = "Profil erfolgreich geändert";
				$_SESSION['User'] = $_POST['Username'];
			}
			else{
				Alert(mysql_error());
			}
		?>
		
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
		<div style="display:inline-block">
			<div class="product-header"><?php echo $returnstr; ?></div>
			<div class="product-desc">Du wirst nun zur Hauptseite umgeleitet</div>
		</div>
		</center>
		<?php 
			echo "<script>setTimeout(function(){ document.location.href = 'index.php'; }, 3000);</script>"; 
		?>
		<?php AddFooter(); ?>
	</body>
</html>