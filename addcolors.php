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
			<?php 
				$User = mysql_fetch_array(mysql_query("select * from Accounts where Username='".$_SESSION['User']));
				if(($User['Vorname'] == "Torben" && $User['Nachname'] == "Keller") ||
					($User['Vorname'] == "Dominik" && $User['Nachname'] == "Sander")){
					echo "
						<form action='addcolors.php' method='post'>
							<table>
								<tr>
									<td>
								</tr>
							</table>
						</form>
					";
				}
			?>
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>