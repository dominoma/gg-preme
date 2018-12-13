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
	
				
				AddImage("product.php?ProdNr=12","convertpic.php?Prod=college-jacke-uni.png&Shirt=000000&Logo=ffffff","Collage-Jacken");
				AddImage("product.php?ProdNr=13","convertpic.php?Prod=jutebeutel.png&Shirt=000000&Logo=ffffff","Jutebeutel");
				AddImage("product.php?ProdNr=9","convertpic.php?Prod=zip-jacke-uni.png&Shirt=000000&Logo=ffffff","Zip-Jacken");
				AddImage("product.php?ProdNr=11","images/default/jogginghose-uni.png","Jogginghosen"); ?>
				
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>