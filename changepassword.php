<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
		<div style="display:inline-block">
			<div class="product-header">Passwort ändern</div>
			<form name='changepassword' action='updatepassword.php' method='post'>
				<input type='password' name='OldPassword' placeholder='altes Passwort' style='margin-bottom:10px;margin-top:10px'>
				<input type='password' name='NewPassword' placeholder='neues Passwort' style='margin-bottom:10px;margin-top:10px'>
				<input type='password' name='NewPasswordRep' placeholder='neues Passwort wiederholen' style='margin-bottom:10px;margin-top:10px'>
				<input type='submit' class='ff_btn btn_black btn_medium' value='Passwort ändern' style='width:100%'>
			</form>
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>