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
				<div class='product-header'>Mein Profil</div>
					<table>
					<tr>
						<td><div class='product-desc'>Benutzername:</div></td>
						<td><input readonly type='text' value='<?php echo $User['Username']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
					</tr>
					<tr>
						<td><div class='product-desc'>Vorname:</div></td>
						<td><input readonly type='text' value='<?php echo $User['Vorname']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
					</tr>
					<tr>
						<td><div class='product-desc'>Nachname:</div></td>
						<td><input readonly type='text' value='<?php echo $User['Nachname']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
					</tr>
					<tr>
						<td><div class='product-desc'>Klasse:</div></td>
						<td><input readonly type='text' value='<?php echo $User['Klasse']; ?>' style='margin-bottom:10px;margin-top:10px'></td>
					</tr>
					<tr>
						<td colspan=2>
							<a href='editprofile.php' class='ff_btn btn_black btn_medium' style='width:100%'>Profil bearbeiten</a>
						</td>
					</tr>
					<tr>
						<td colspan=2>
							<a href='changepassword.php' class='ff_btn btn_black btn_medium' style='width:100%'>Passwort ändern</a>
						</td>
					</tr>
					</table>
					
			</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>