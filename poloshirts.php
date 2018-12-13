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
				AddImage("product.php?ProdNr=5","convertpic.php?Prod=poloshirt-men.png&Shirt=ffffff","Poloshirt men"); 
				AddImage("product.php?ProdNr=6","convertpic.php?Prod=poloshirt-women.png&Shirt=ffffff","Poloshirt women");
				?>
				
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>