<?php 
	function    GetRGBFromHex( $hex)
	{
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
		
		return array($r,$g,$b);
	}
	
	$shirt = GetRGBFromHex($_GET['Shirt']);
	$logo = GetRGBFromHex($_GET['Logo']);

	$image = imagecreatefrompng('images/Products/'.$_GET['Prod']);
	
	
	ImageTrueColorToPalette($image, true, 3);
	imageAlphaBlending($image, true);
	imagesavealpha( $image, true );
	imagecolortransparent($image, imagecolorat($image,0,0));
	
	$index = imagecolorclosest ( $image,  255,255,255);
	imagecolorset($image,$index,$logo[0],$logo[1],$logo[2]);

	$index = imagecolorclosest ( $image,  255,0,255); 
	imagecolorset($image,$index,$shirt[0],$shirt[1],$shirt[2]);
	
	
	
	$type = 'image/png';
	header('Content-Type:'.$type);
	
	imagepng($image);
	
	imagedestroy($image);

?>