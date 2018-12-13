<?php

function AddBill($User,$Products){
 
$rechnungs_datum = date("d.m.Y");
$lieferdatum = "05.03.2017";
$pdfAuthor = "GG-Preme.de";
 
$rechnungs_header = '<br><br><br><br>		
GG-PREME
Kian Stötzer
www.gg-preme.de';
 
$rechnungs_empfaenger = $User['Username']."\n".$User['Vorname']." ".$User['Nachname']."\n".$User['Klasse']."\n";
 
$rechnungs_footer = "Wir bitten darum, dass die unterschriebene Rechnung dem Geldbetrag in einem Briefumschlag beigelegt und bis zum 31.01.2017 im Raum der Schülerfirma abgegeben wird.";
 
//Auflistung eurer verschiedenen Posten im Format [Produktbezeichnuns, Menge, Einzelpreis]
 
//Höhe eurer Umsatzsteuer. 0.19 für 19% Umsatzsteuer
 
$pdfName = "pdf/Rechnung_".$User['Username'].".pdf";
 
 
//////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 
// Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.

$html = '<p style="vertical-align: middle;text-align:center;margin-top:-20px;"><img src="images/LogoBlackSmall.png" style="background-size:contain;background-position:center"></p>
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
	<tr>
 		<td>'.nl2br(trim($rechnungs_header)).'</td>
    	<td style="text-align: right">
			Rechnungsdatum: '.$rechnungs_datum.'<br>
			Lieferdatum: '.$lieferdatum.'<br>
 		</td>
 	</tr>
 
 	<tr>
 		<td style="font-size:1.3em; font-weight: bold;">
			<br><br>
			Rechnung
			<br>
 		</td>
 	</tr>
 
 	<tr>
 		<td colspan="2">'.nl2br(trim($rechnungs_empfaenger)).'</td>
 	</tr>
</table>
 				
<br><br><br>
 
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
 	<tr style="background-color: #cccccc; padding:5px;">
 		<td style="padding:5px;"><b>Produkt</b></td>
 		<td style="text-align: center;"><b>Größe</b></td>
 		<td style="text-align: center;"><b>Farbe</b></td>
 		<td style="text-align: center;"><b>Anzahl</b></td>
 		<td style="text-align: center;"><b>Sonderdruck</b></td>
 		<td style="text-align: center;"><b>Preis</b></td>
 	</tr>';
 
 
	$gesamtpreis = 0;
 
	foreach($Products as $Product) {
		$sonderstr = $Product['SpecialPrint'] ? "+ 4,80€/Stk" : "-";
	 	$preis = $Product['Amount']*($Product['Preis']+ $Product['SpecialPrint']*4.80);
	 	$gesamtpreis += $preis;
	 	$html .= '
	 		<tr>
	        	<td>'.$Product['Name']." ".number_format($Product['Preis'], 2, ',', '').'€</td>
	 			<td style="text-align: center;">'.$Product['Size'].'</td> 
	 			<td style="text-align: center;">'.$Product['CombNr'].'</td> 
	 			<td style="text-align: center;">'.$Product['Amount'].'</td> 
	 			<td style="text-align: center;">'.$sonderstr.'</td>
	 			<td style="text-align: right;">'.number_format($preis, 2, ',', '.').'€</td> 
	       	</tr>';
	}
$html .="</table>";
 
 
 
$html .= '
	<hr>
	<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">';
 
$html .='
    	<tr>
        	<td colspan="3"><b>Gesamtsumme: </b></td>
            <td style="text-align: right;"><b>'.number_format($gesamtpreis, 2, ',', '.').'€</b></td>
        </tr> 
    </table>
	<br><br><br>';
 
$html .= 'Nach § 19 Abs. 1 UStG wird keine Umsatzsteuer berechnet.<br><br>';
 
$html .= nl2br($rechnungs_footer);
$html .= '<br><br><br><br><br>
		<table style="width:100%;position:fixed;bottom:10px;">
			<tr>
				<td>_______________________________<br><font size="8"><i> Unterschrift Erziehungsberechtigter</i></font></td>
				<td style="text-align: right;">_________________________________<br><font size="8"><i> Unterschrift Verkäufer (bitte frei lassen)</i></font></td>
			</tr>
		</table>'; 
 
 
//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 
// TCPDF Library laden
require_once('tcpdf/tcpdf.php');
 
// Erstellung des PDF Dokuments
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// Dokumenteninformationen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pdfAuthor);
$pdf->SetTitle('Rechnung '.$rechnungs_nummer);
$pdf->SetSubject('Rechnung '.$rechnungs_nummer);
 
 
// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// Auswahl der MArgins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// Image Scale 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// Schriftart
$pdf->SetFont('dejavusans', '', 10);
 
// Neue Seite
$pdf->AddPage();
//$pdf->Image("images/LogoBlackSmall.png", 'C', 6, '', '', 'PNG', false, 'C', false, 300, 'C', false, false, 0, false, false, false);
// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');
 
//Ausgabe der PDF
 
//Variante 1: PDF direkt an den Benutzer senden:
//$pdf->Output($pdfName, 'I');
 
//Variante 2: PDF im Verzeichnis abspeichern:
$pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
echo "<script>document.location.href='$pdfName'</script>";
} 
?>