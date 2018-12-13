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
				AddImage("t-shirts.php","images/default/t-shirt-men.png","T-Shirts"); 
				AddImage("product.php?ProdNr=10","images/default/hoody-uni.png","Hoodies");
				AddImage("poloshirts.php","images/default/poloshirt-men.png","Polo-Shirts");
				AddImage("sweater.php","images/default/sweater-men.png","Sweater");
				?>
				<br>
				<?php
				AddImage("product.php?ProdNr=12","images/default/college-jacke-uni.png","Collage-Jacken");
				AddImage("product.php?ProdNr=13","images/default/jutebeutel.png","Jutebeutel");
				AddImage("product.php?ProdNr=9","images/default/zip-jacke-uni.png","Zip-Jacken");
				AddImage("product.php?ProdNr=11","images/default/jogginghose-uni.png","Jogginghosen"); ?>
				
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>