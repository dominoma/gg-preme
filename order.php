<html>
	<head>
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'useful.php'; ?>
		
		
		<?php 
		if(isset($_SESSION['User'])){
		
			$ProdNr = $_GET['ProdNr'];
			$SpecialPrint = isset($_POST['SpecialPrint']);
			$Product = GetProduct($ProdNr);
			$ColorCodes = GetColorArr();
			$Colors = mysql_fetch_array(mysql_query("select PrimCol,SecCol from ColorComb where CombNr = '".$_POST['Color']."'"));
			$insert = "insert into Orders Values('".$_SESSION['User']."','$ProdNr','".$_POST['Color']."','".$_POST['Amount']."','".$_POST['Size']."','".$SpecialPrint."');";
			
			if(!mysql_query($insert)){
	
				$select = "select Amount from Orders  where ProdNr='".$ProdNr."' and Username='".$_SESSION['User']."' and Size='".$_POST['Size']."' and CombNr='".$_POST['Color']."';";
				$amount = mysql_fetch_array(mysql_query($select))[0]+$_POST['Amount'];
				$update = "update Orders set Amount='".$amount."' where ProdNr='".$ProdNr."' and Username='".$_SESSION['User']."' and Size='".$_POST['Size']."' and CombNr='".$_POST['Color']."'";
				
				if(!mysql_query($update)){
					Alert(mysql_error());
				}
			}
			
		}
		else{
			echo "<script>document.location.href='login.php';</script>";
		}
		
		?>
		<style>
			.order b{
				color:#0B75AF;
				font-size:20px;
				font-weight:normal;
				
			}
			.order {
				color:#fff;
				font-size:20px;
				font-weight:normal;
				margin-right:5px;
			}
		</style>
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
			<div style="display:inline-block">
				<table>
					<tr>
						<td>
						    <div class="ps-slider" style="width:400px;height:400px;" id="productslider">
						    	<img style='width:100%;height:100%;' src="convertpic.php?<?php echo "Prod=".$Product['Image']."&Shirt=".$ColorCodes[$Colors['PrimCol']]."&Logo=".$ColorCodes[$Colors['SecCol']]; ?>">
						    </div>
					    </td>
					    <td>
						    <div style='float:right;display:inline-block;'>
						    	
					    		<center>
					    			<div class='product-header'><?php echo $Product['Name']."  ".number_format($Product['Preis'],2,',','.')."€"; ?></div>
					    		</center>
					    		<hr>
								<div style='float:right;display:inline-block;margin-top:10px' class="order">
						    		wurde zum Warenkorb hinzugefügt<br><br>
						    		<b>Sie werden zum Warenkorb weitergeleitet</b>
						    	</div>
						    	
						    </div>
					    </td>
				    </tr>
			    </table>
			</div>
		</center>
		<?php 
			echo "<script>setTimeout(function(){ document.location.href = 'orders.php'; }, 3000);</script>"; 
		?>
		<?php AddFooter(); ?>
	</body>
</html>