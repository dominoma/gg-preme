<html>
    <head>
    	
        <title>GG-Preme</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      
        <meta name="description" content="Die GG-Preme Kollektion" />
        <meta name="keywords" content="Gymnasium Glinde, Glinde, Schulkleidung, GG-Preme, Kollektion, Sch�lerfirma"/>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
        
    </head>
    <body>
    		
		<?php AddMenu(); ?>
		<!-- Inhalt in Slides mit <div class="inner"></div> -->
		<div class="container-fluid" style="width:800px;height:500px">
			<center>
			<div class='product-header' style='color:#0B75AF'>Schülerfirma GG-Preme</div><br>
			<div class='product-desc' style='color:#fff'>Wir verkaufen Schulkleidung für euch!<br>
			Ein Projekt in Zusammenarbeit mit der JUINOR gGmbH<br><br></div></center>
		    <div class="ps-slider" id="mainmenuslider">
		        <div class="ps-slides">
		            <div class="ps-slide" style="background-image: url('images/Home/hoodie.png');"></div>
		            <div class="ps-slide" style="background-image: url('images/Home/t-shirt-v.png');"></div>
		            <div class="ps-slide" style="background-image: url('images/Home/t-shirt-v-frau.png');"></div>
		            <div class="ps-slide" style="background-image: url('images/Home/t-shirt.png');"></div>
		            <div class="ps-slide" style="background-image: url('images/Home/sweater.png');"></div>
		        </div>
		    </div>
		</div>
		<?php 
	
		?>
		
        <?php AddFooter(); ?>
        
    </body>
    <?php RegisterSlideShow("mainmenuslider"); ?>
</html>