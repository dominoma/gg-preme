<html>
	<head>
		<meta charset='UTF-8'>
		<?php include 'menu.php'; ?>
		
		
		<?php include 'useful.php'; ?>
		
		
		<script>
			function CheckButton(){
				if(document.getElementById("Size").value != "" && document.getElementById("Amount").value != ""){
					document.getElementById("submit").disabled = false;
				}
				else{
					document.getElementById("submit").disabled = true;
				} 
			}
			function RadioChecked(Product,PrimCol,SecCol){
				document.getElementById('productimg').style.backgroundImage="url('convertpic.php?Prod="+Product+"&Shirt="+PrimCol+"&Logo="+SecCol+"')";
			}
		</script>
		
		<?php
			
			$ProdNr = 1;
			if(isset($_GET['ProdNr'])){
				$ProdNr = $_GET['ProdNr']; 
			}
			
			$Product = GetProduct($ProdNr);
			
			$ColorCodes = GetColorArr();
			$Colors = GetProdColors($ProdNr);
			echo "<script>window.onload=function(){document.getElementById('Color".$Colors[0]['CombNr']."').checked=true;document.getElementById('Color".$Colors[0]['CombNr']."').onchange();}</script>"
		?>
		
	</head>
	<body>
		<?php AddMenu(); ?>
		<center>
		<div style="display:inline-block;">
			<table>
				<tr>
					<td>
					    <div style="width:400px;height:400px;border:0;background-size:contain;-webkit-transition: background-image 0.2s ease-in-out;transition: background-image 0.2s ease-in-out;" id="productimg"></div>
				    </td>
				    <td>
					    <div style='float:right;display:inline-block;'>
					    	<table>
						    	<tr>
							    	<td colspan=3>
							    		<center>
							    			<div class='product-header'><?php echo $Product['Name']."  ".number_format($Product['Preis'],2,',','.')."€"; ?></div>
							    		</center>
							    		<hr>
							    		<br>
							    		<br>
							    	</td>
						    	</tr>
						    	<form name='order' action='order.php?ProdNr=<?php echo $ProdNr; ?>' method="post">
							    	<tr>
								    	<td>
										    <select name='Size' id='Size' onchange='CheckButton()'>
										    	<option value='' selected disabled hidden>Größe</option>
										    	<option value='S'>Klein</option>
										    	<option value='M'>Mittel</option>
										    	<option value='L'>Groß</option>
										    </select>
									    </td>
									    <td>
										    <select name='Color' id='Color' onchange='CheckButton()'>
										    	<option value='' selected disabled hidden>Farbe</option>
										    	
										    </select>
									    </td>
									    <td style='width:80px'>
									    	<input name='Amount' id='Amount' style='width:100%' placeholder='Anzahl' type='number' oninput='CheckButton()'>
									    </td>
									    
								    </tr>
								    <tr>
								    	<td colspan=3 style='height:50px'>
								    		<table>	
								    		<tr>
									    		<td>
										    	<div style='font-size:18px;color:#fff;'>
										    		Sonderdruck:
										    	</div>
										    	</td>
										    	<td>
										    		<!-- <div class='inputborder' style='width:20px;height:20px'><p style='width:0px;height:0px;text-align:center;color:#fff'>✔</p></div> -->
										    		<input type="checkbox" name='SpecialPrint' id="toggle" hidden>
													<label for="toggle" class='checklabel'></label>
										    	</td>
										    	<td>
										    		<div style='font-size:18px;color:#fff;margin-left:10px'>
										    			Farbe:
										    		</div>
										    	</td>
										    	
										    	<fieldset hidden>
										    			
													
												<?php 
												
													foreach($Colors as $Color){
														echo "
															<td>
														    <input type='radio' hidden id='Color".$Color['CombNr']."' name='Color' value='".$Color['CombNr']."' onchange=\"RadioChecked('".$Product['Image']."','".$ColorCodes[$Color['PrimCol']]."','".$ColorCodes[$Color['SecCol']]."')\">
														    <label for='Color".$Color['CombNr']."' class='colorradio' style=\"background:#".$ColorCodes[$Color['PrimCol']]."\"></label> 
														    </td>
													    ";
													}
												
												?>
												</fieldset>
										    	
									    	</tr>
									    	</table>
									    </td>
								    </tr>
								    <tr>
									    <td colspan=4>
									    	<input id='submit' disabled type='submit' class='ff_btn btn_black btn_medium' value='Bestellen'  style='width:100%;margin-top:0px'>
									    </td>
								    </tr>
							    </form>
						    </table>     
					    </div>
				    </td>
			    </tr>
		    </table>
		</div>
		</center>
		<?php AddFooter(); ?>
	</body>
	
</html>