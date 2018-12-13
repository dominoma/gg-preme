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
				AddImage("product.php?ProdNr=1","images/default/t-shirt-men.png","T-Shirts unisex"); 
				AddImage("product.php?ProdNr=2","images/default/t-shirt-frau.png","Girlieshirts");
				AddImage("product.php?ProdNr=3","images/default/t-shirt-v-men.png","T-Shirt V unisex");
				AddImage("product.php?ProdNr=4","images/default/t-shirt-v-frau.png","T-Shirt V women");
				?>
				
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>