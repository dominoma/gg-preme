<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'database_login.php'; ?>
		
		<?php
			$select = "select * from Accounts where Username = '".$_SESSION['User']."'";
			$User = mysql_fetch_array(mysql_query($select));
		?>
		<style type="text/css">
			.product-desc{
				font-size:18px;
				text-align:right;
				margin-right:10px;
				font-weight:bold;
			}
		</style>
		
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
			<div style="display:inline-block">
				<div class='product-header'>Profil bearbeiten</div>
					<form name='editprofile' action='updateprofile.php' method="post">
						<table>
							<tr>
								<td><div class='product-desc'>Benutzername:</div></td>
								<td><input type='text' maxlength='15' name='Username' value='<?php echo $User['Username']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
							</tr>
							<tr>
								<td><div class='product-desc'>Vorname:</div></td>
								<td><input type='text' name='Vorname' value='<?php echo $User['Vorname']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
							</tr>
							<tr>
								<td><div class='product-desc'>Nachname:</div></td>
								<td><input type='text' name='Nachname' value='<?php echo $User['Nachname']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
							</tr>
							<tr>
								<td><div class='product-desc'>Klasse:</div></td>
								<td><input type='text' name='Klasse' value='<?php echo $User['Klasse']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
							</tr>
							<tr>
								<td colspan=2>
									<input type=submit class='ff_btn btn_black btn_medium' value='Abschicken' style='width:100%'>
								</td>
							</tr>
						</table>
					</form>
					
			</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>