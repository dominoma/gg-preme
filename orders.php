<html>
	<head>
		<link href="css/csspin.css" rel="stylesheet" type="text/css">
		<?php include 'menu.php'; ?>
		<?php include 'Slideshow.php'; ?>
		<?php include 'image.php'; ?>
		<?php include 'useful.php'; ?>
		<?php
			if(isset($_SESSION['User'])){
				$SpecialPrint = isset($_POST['SpecialPrint']);
				if(isset($_POST['update'])){
					$update = "update Orders set CombNr='".$_POST['Color']."', Size='".$_POST['Size']."',Amount='".$_POST['Amount']."', SpecialPrint='$SpecialPrint' where ProdNr='".$_POST['ProdNr']."' and Username='".$_SESSION['User']."' and Size='".$_POST['OldSize']."' and CombNr='".$_POST['OldColor']."'";
					if(!mysql_query($update)){
						$delete = "delete from Orders where ProdNr='".$_POST['ProdNr']."' and Username='".$_SESSION['User']."' and Size='".$_POST['OldSize']."' and CombNr='".$_POST['OldColor']."' and SpecialPrint='$SpecialPrint'";
						if(!mysql_query($delete)){
							Alert($delete);
							Alert(mysql_error());
						}
						$select = "select Amount from Orders  where ProdNr='".$_POST['ProdNr']."' and Username='".$_SESSION['User']."' and Size='".$_POST['Size']."' and CombNr='".$_POST['Color']."' and SpecialPrint='$SpecialPrint';";
						$amount = mysql_fetch_array(mysql_query($select))[0]+$_POST['Amount'];
						$update = "update Orders set Amount='".$amount."' where ProdNr='".$_POST['ProdNr']."' and Username='".$_SESSION['User']."' and Size='".$_POST['Size']."' and CombNr='".$_POST['Color']."' and SpecialPrint='$SpecialPrint'";
						if(!mysql_query($update)){
							Alert(mysql_error());
						}
					}
					//echo "<script>document.location.href='orders.php';</script>";
				}
				else if(isset($_POST['delete'])){
					$delete = "delete from Orders where ProdNr='".$_POST['ProdNr']."' and Username='".$_SESSION['User']."' and Size='".$_POST['OldSize']."' and CombNr='".$_POST['OldColor']."' and SpecialPrint='$SpecialPrint';";
					if(!mysql_query($delete)){
						Alert($delete);
						Alert(mysql_error());
					}
					//echo "<script>document.location.href='orders.php';</script>";
				}
				$select = "select * from Orders,Product where Orders.ProdNr = Product.ProdNr and Orders.Username = '".$_SESSION['User']."'";
				$result = mysql_query($select);
				$BillPositions = array();
				while($BillPosition = mysql_fetch_array($result)){
					array_push($BillPositions,$BillPosition);
				}
			}
			else{
				echo "<script>document.location.href='login.php';</script>";
			}
			
				
				
			
			
			
			
			
															
			function GetColorOptions($ProdNr,$Selected,$row){
				$returnstr="<table>";
				$Colors = GetProdColors($ProdNr);
				$ColorCodes = GetColorArr();
				$Product = GetProduct($ProdNr);
				foreach($Colors as $Color){
					$checked = "";
					if($Color['CombNr'] == $Selected){
						$checked = "checked";
					}
					$returnstr .= "
						<td>
						<input type='radio' $checked hidden id='Color".$Color['CombNr'].$row."' name='Color' value='".$Color['CombNr']."' onchange='EnableButton(this)'>
						<label for='Color".$Color['CombNr'].$row."' class='colorbigradio' style=\"background:#".$ColorCodes[$Color['PrimCol']]."\">
							<span class='colorpopup' style='background:#222'>
								<img src='convertpic.php?Prod=".$Product['Image']."&Shirt=".$ColorCodes[$Color['PrimCol']]."&Logo=".$ColorCodes[$Color['SecCol']]."'/>
							</span>
						</label>
						</td>
					";
				}
				return $returnstr."</table>";
			}
			function GetSizeOptions($DefSize=''){
				$returnstr="";
				$Sizes = array('S','M','L');
				foreach($Sizes as $Size){
					if($Size == $DefSize){
						$returnstr.= "<option selected value='$Size'>$Size</option>";
					}
					else{
						$returnstr.= "<option value='$Size'>$Size</option>";
					}
				}
				return $returnstr;
			}
		?>
		<style>
			.ordertable thead tr th{
				color:fff;
				font-size:18px;
			}
			.ordertable tbody tr td{
				padding:5px;
			}
			.ordertable{
				margin-bottom:10px;
			}
		</style>
		<script>
			var MsgClose=false;
			function EnableButton(Sender){
				try{Sender.parentElement.parentElement.querySelectorAll("[name=update]")[0].disabled=false;}catch(err){}
				try{Sender.parentElement.parentElement.parentElement.querySelectorAll("[name=update]")[0].disabled=false;}catch(err){}
				
				MsgClose=true;
			}
			function SwitchClick(){
				MsgClose = false;
			}
			function askDel()
			{
				var retVal=confirm('Bestellung wirklich löschen?');
				return retVal;
			}
			function LoadBill(){
				document.getElementById('ordertable').hidden = true;
				document.getElementById('buttons').hidden = true;
				document.getElementById('spinner').className = "cp-spinner cp-round";
				document.getElementById('spinnertext').innerHTML = "Bitte warte einen Augenblick";
			}
			window.onbeforeunload = function(){
				if(MsgClose){
					return "Einige Einträge wurden noch nicht übernommen, diese gehen verloren, wenn Sie die Seite verlassen.";
				}
			}
		</script>
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
			<div style="display:inline-block">
				<div class='product-header' style= 'margin-bottom:20px'>Warenkorb</div>
				<table class='ordertable' id='ordertable'>
					<thead>
						<?php 
							if(count($BillPositions) == 0){
								echo "<div class='product-desc' style='margin-top:-10px'>Noch keine Produkte im Warenkorb</div>";
							}
							else{
								echo "
									<tr>
										<th>Produkt</th>
										<th>Größe</th>
										<th>Farbe</th>
										<th>Anzahl</th>
										<th>Sonderdruck</th>
										<th>Preis</th>
									</tr>
								";
							}
						?>
					</thead>
					<tbody>
						<?php 
							$FullPrice=0.0;
							$row=0;
							foreach($BillPositions as $BillPos){
								$Price = ($BillPos['Preis'] + $BillPos['SpecialPrint']*4.80 )*$BillPos['Amount'];
								$FullPrice += $Price;
								$checked = $BillPos['SpecialPrint'] ? "checked" : "";
								$row++;
								echo "
									<tr>
										<form action='orders.php' method='post'>
											<td><input readonly size=18 type='text' value='".$BillPos['Name']." ".number_format($BillPos['Preis'],2,',','.')."€'></td>
											<td><select name='Size' style='width:80px' onchange='EnableButton(this)'>".GetSizeOptions($BillPos['Size'])."</select></td>
											<td><fieldset style='border:0' onchange='EnableButton(this)'>".GetColorOptions($BillPos['ProdNr'],$BillPos['CombNr'],$row)."</fieldset></td>
											<td><input style='width:100px' name='Amount' type='number' value='".$BillPos['Amount']."' oninput='EnableButton(this)'></td>
											<td><center><input name='SpecialPrint' type='checkbox' $checked hidden id='check$row' onclick='EnableButton(this)'><label for='check$row' class='checklabel' style='width:50px;height:50px;font-size:32px;'></label></center></td>
											<td><input readonly size=7 style='' type='text' value='".number_format($Price,2,',','.')."€'></td>
											<td padding:0px><input type=submit name='delete' onclick='return askDel();' class='ff_btn btn_black' style='height:50px;width:50px;margin:0px;' value='✘'></td>
											<td padding:0px><input disabled onclick='SwitchClick()' type=submit name='update' class='ff_btn btn_black' style='height:50px;width:50px;margin:0px;' value='✔'></td>
											<input type='hidden' value='".$BillPos['ProdNr']."' name = 'ProdNr'>
											<input type='hidden' value='".$BillPos['Preis']."' name = 'Price'>
											<input type='hidden' value='".$BillPos['Size']."' name = 'OldSize'>
											<input type='hidden' value='".$BillPos['CombNr']."' name = 'OldColor'>
										</form>
									</tr>
								";
								
								
							}
						?>
						<?php	
							if(count($BillPositions) != 0){
								echo "
									<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><div style='float:right;color:#fff;font-size:18px;'>Gesamt:</div></td>
									<td><input type=text size=7 readonly value='".number_format($FullPrice,2,',','.')."€'></td>
									</tr>";
								
							}
						?>
					</tbody>
				</table>
				<?php 
					if(count($BillPositions) != 0){
						echo "
							<hr>
							<div style='margin-top:10px' id='buttons'>
							<button onclick=\"document.location.href='products.php'\" class='ff_btn btn_black' style='width:20%;height:50px'>Noch eins</button>
							<button onclick=\"LoadBill();document.location.href='createbill.php'\" class='ff_btn btn_black' style='width:20%;height:50px'>Bezahlen</button>
							</div>
						";
					}
				?>
				<div  id='spinner' style='margin-top:20px;'></div>
				<div  id='spinnertext' class='product-desc' style='margin-top:20px;color:#fff'></div>
			</div>
		</center>
		<?php AddFooter(); ?>
	</body>
</html>