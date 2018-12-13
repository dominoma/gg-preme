<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'database_login.php'; ?>
		
		<?php 
		
			function PrintLoginScreen($error=false){
				$title = $error ? "Login fehlgeschlagen" : "Anmelden";
				echo "
		
					<form name='login' method='post' action='login.php'>
						<center>
							<div class='product-header'>$title</div><br>
							<div style='display:inline-block'>
								<input name='Username' type='text' placeholder='Benutzername' style='margin-bottom:10px'>
								<input name='Password' type='password' placeholder='Passwort'>
								<input type=submit value='Login' class='ff_btn btn_black btn_medium' style='width:100%;margin-bottom:15px'>
								<hr>
								<a class='ff_btn btn_black btn_medium' href='register.php'  style='width:100%;margin-top:15px'>Account erstellen</a>
							</div>
						</center>
					</form>	
				
				";
			}
		
		?>
		
	</head>
	<body>
		<?php AddMenu(); ?>
		<?php 
			if(isset($_SESSION['User'])){
				echo "<script>document.location.href='index.php';</script>";
			}
			else if(!isset($_POST['Username'])){
				PrintLoginScreen();
			}
			else{
				$select = "select Passwort from Accounts where Username = '".$_POST['Username']."';";
				$result = mysql_query($select);
				$daten = mysql_fetch_array($result);
				if($daten[0] != $_POST['Password']){
					PrintLoginScreen(true);
				}
				else{
					$_SESSION['User'] = $_POST['Username'];
					echo "<script>document.location.href='index.php';</script>";
				}
			}
		?>
		<?php AddFooter(); ?>
	</body>
</html>