<link rel="stylesheet" href="css/ImageStyle.css" type="text/css" media="screen"/>
<?php 
	function AddImage($href,$img,$text){
		echo "
			<div class='view third-effect'>
				<img src='$img' />
				<div class='mask' href='$href' style='width:100%;height:100%;'>
					<div style='position:absolute;left:0;bottom:0;width:100%;background:rgba(0,0,0,0.9);'>
						<a href='$href' class='ff_btn btn_black ff_medium' style='width:100%;background:transparent;font-weight:bold;color:#0B75AF;margin:0;font-size:15px;border:0'>$text</a>	
					</div>
					<a href = '$href' style='background:transparent;width:100%;height:100%;display: inline-block;'></a>
				</div>
			</div>
		";
	}
?>