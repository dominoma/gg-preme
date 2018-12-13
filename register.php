<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'database_login.php'; ?>
		<script>

			function CheckInput(Check){
				document.getElementById('InputClass').value = Check.checked ? "Lehrer" : "";
				document.getElementById('InputClass').disabled = Check.checked;
			}

		</script>
		<?php 
			function PrintRegisterScreen(){
				echo "
					<center>
						<div style='display:inline-block'>
							
							<form name='register' method='post' action='register.php'>	
								<div class='product-header'>Registrieren</div>
								<input name='Vorname' type='text' placeholder='Vorname' style='text-transform: capitalize;margin-bottom:10px'>
								<input name='Nachname' type='text' placeholder='Nachname' style='text-transform: capitalize;margin-bottom:10px'>
								<input name='Klasse' id='InputClass' type='text' placeholder='Klasse' style='text-transform: capitalize;margin-bottom:3px'>
								<table style= 'margin-bottom:3px'>
								<tr>
								<td>
								<div style='font-size:18px;color:#fff;'>
									Ich bin Lehrer:
								</div>
								</td>
								<td>
								<input type='checkbox' id='LehrerCheck' hidden onchange='CheckInput(this)'>
								<label for='LehrerCheck' class='checklabel' style='font-size:16px'></label>
								</td>
								</tr>
								</table>		    	
								<hr>
								<input name='Username' maxlength='15' type='text' placeholder='Benutzername' style='margin-bottom:10px;margin-top:10px'>
								<input name='Password' type='password' placeholder='Passwort' style='margin-bottom:10px'>
								<input name='PasswordRepeat' type='password' placeholder='Passwort wiederholen' style='margin-bottom:10px'>
								<input type=submit value='Account erstellen' class='ff_btn btn_black btn_medium' style='width:100%;margin-bottom:15px'>
							</form>	
						</div>
					</center>
				";
			}
		
		?>
		
	</head>
	<body>
		<?php  ?>
		<?php 
			
			if(isset($_POST['Vorname'])){
				$errorstr="";
				if($_POST['Vorname'] == ""){
					$errorstr .= "Bitte Vorname eingeben";
				}
				else if($_POST['Nachname'] == ""){
					$errorstr .= "Bitte Nachname eingeben";
				}
				else if($_POST['Klasse'] == ""){
					$errorstr .= "Bitte Klasse eingeben";
				}
				else if($_POST['Username'] == ""){
					$errorstr .= "Bitte Benutzernamen eingeben";
				}
				else if($_POST['Password'] == ""){
					$errorstr .= "Bitte Passwort eingeben";
				}
				else if($_POST['PasswordRepeat'] != $_POST['Password']){
					$errorstr .= "Passwörter stimmen nicht überein";
				}
				if($errorstr != ""){
					Alert($errorstr);
					AddMenu();
					PrintRegisterScreen();
				}
				else{
					$insert = "insert into Accounts Values('".trim($_POST['Username'])."','".$_POST['Password']."','".trim($_POST['Vorname'])."','".trim($_POST['Nachname'])."','".trim($_POST['Klasse'])."');";
					if(!mysql_query($insert)){
						$errorstr = "Ein Fehler ist aufgetreten: ".mysql_error();
						Alert($errorstr);
						AddMenu();
						PrintRegisterScreen();
					}
					else{
						$_SESSION['User'] = trim($_POST['Username']);
						AddMenu();
						echo "
							<center><div style='display:inline-block'>
								<div class='product-header'>Registrierung erfolgreich</div>
								<div class='product-desc'>Du wirst nun zur Startseite weitergeleitet</div>
							</div></center>
							<script>
								setTimeout(function(){ document.location.href = 'index.php'; }, 3000);
							</script>
						";
					}
				}
			}
			else{
				AddMenu();
				PrintRegisterScreen();
			}
		
		?>
		<?php AddFooter(); ?>
	</body>
</html>