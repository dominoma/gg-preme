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
				AddImage("product.php?ProdNr=7","images/default/sweater-men.png","Sweater men"); 
				AddImage("product.php?ProdNr=8","convertpic.php?Prod=sweater-women.png&Shirt=ffffff","Sweater women");
				?>
				
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>