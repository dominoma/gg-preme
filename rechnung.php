<?php 
	$FullPrice = 0;
	function GetProductTableRows($Produkte, &$FullPrice){
		$returnStr = "";
		$FullPrice = 0;
		foreach($Produkte as $Produkt){
			$Price = $Produkt['Amount']*$Produkt['Price'];
			$FullPrice += $Price;
			$returnStr .= "
				<tr>
					<td>".$Produkt['Name']." ".number_format($Produkt['Price'],2,',','.')."€</td>
					<td style='text-align: center;'>".$Produkt['Size']."</td>
					<td style='text-align: center;'>".$Produkt['Color']."</td>
					<td style='text-align: center;'>".$Produkt['Amount']."</td>
					<td style='text-align: center;'>".number_format($Price,2,',','.')."€</td>
				</tr>
			";
		}
		return $returnStr;
	}
	function GetBill($User,$Produkte){
		return "
			<center>
				<img src='images\LogoBlack.png' style='width:500px;height:75px;'>
				<table style='width:100%'>
					<tr>
						<td>
							
						</td>
						<td style='text-align:right'>
							<br>
							Rechnungsdatum: 22.01.2017<br>
							Lieferdatum: 12.02.2017
						</td>
					</tr>
					<tr>
						<td>
							<br>
							GG-PREME<br>
							Kian Stötzer<br>
							www.gg-preme.de
						</td>
					</tr>
					<tr>
						<td>
							<br>
							<h2>Rechnung</h2>
						</td>
					</tr>
					<tr>
						<td>
							".$User['Username']."<br>
							".$User['Vorname']." ".$User['Nachname']."<br>
							Klasse ".$User['Klasse']."<br>
						</td>
					</tr>
					<tr>
						<td colspan = 2>
						
							<br>
							<br>
							<table style='width:100%' tableborder=0>
								
									<tr style='background:gray;'>
										<th style='background:gray;'>Produkt</th>
										<th style='background:gray;'>Größe</th>
										<th style='background:gray;'>Farbe</th>
										<th style='background:gray;'>Menge</th>
										<th style='background:gray;'>Preis</th>
									</tr>
								
									".
									GetProductTableRows($Produkte, $FullPrice)
									."
									<tr>
										<td colspan=5>
										<hr>
										</td>
									</tr>
									<tr>
										<td>
											<b>Gesamtbetrag:</b>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td  style='text-align:center'>
											<b>".number_format($FullPrice,2,',','.')."€</b>
										</td>
									</tr>
								
							</table>
						</td>
					</tr>
					<tr>
						<td colspan = 2>
							<br>Nach § 19 Abs. 1 UStG wird keine Umsatzsteuer berechnet.<br><br>
						</td>
					</tr>
					<tr>
						<td colspan = 2>
							Wir bitten darum, dass die unterschriebene Rechnung dem Geldbetrag in einem Briefumschlag beigelegt und bis zum 31.01.2017 im Raum der Schülerfirma abgegeben wird.
						</td>
					</tr>
					<tr>
						<td>
							<br><br><br><br><br>
							<hr>
							<p style='font-size:12px;margin-top:-7px'>Unterschrift Erziehungsberechtigter</p>
						</td>
					</tr>
				</table>
			</center>
		";
	}