<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'database_login.php'; ?>
		
		<?php 
			$errmsg = "Passwort ändern fehlgeschlagen";
			$select = "select Passwort from Accounts where Username = '".$_SESSION['User']."';";
			$daten = mysql_fetch_array(mysql_query($select));
			if($_POST['NewPassword'] == ""){
				$errmsg = "Sie müssen ein Passwort vergeben";
			}
			else if($_POST['NewPassword'] != $_POST['NewPasswordRep']){
				$errmsg = "Passwörter stimmen nicht überein";
			}
			else if($daten[0] != $_POST['OldPassword']){
				$errmsg = "Falsches Passwort";
			}
			else{
				$update = "update Accounts set Passwort = '".$_POST['NewPassword']."' where Username = '".$_SESSION['User']."';";
				if(mysql_query($update)){
					$errmsg = "Passwort erfolgreich geändert";
				}
				else{
					Alert(mysql_error());
				}
			}
		
		?>
		
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
		<div style="display:inline-block">
			<div class="product-header"><?php echo $errmsg; ?></div>
			<div class="product-desc">Du wirst nun zur Hauptseite umgeleitet</div>
		</div>
		</center>
		<?php 
			echo "<script>setTimeout(function(){ document.location.href = 'index.php'; }, 3000);</script>"; 
		?>
		<?php AddFooter(); ?>
	</body>
</html>