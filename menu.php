<?php include 'MenuStyle.php'; ?>
<?php include 'database_login.php'; ?>
<?php session_start(); ?>

<style>
	/*Theme #0B75AF*/
	body{
		background:#333 url(http://tympanus.net/Tutorials/SlideDownBoxMenu/bg.jpg) repeat top left;
		font-family:Arial;
	}
	span.reference{
		position:fixed;
		left:10px;
		bottom:10px;
		font-size:12px;
	}
	span.reference a{
		color:#aaa;
		text-transform:uppercase;
		text-decoration:none;
		text-shadow:1px 1px 1px #000;
		margin-right:30px;
	}
	span.reference a:hover{
		color:#ddd;
	}
	.product-header{
		color:#fff;
		font-size:34px;
		clear:both;
		
		text-transform:uppercase;
		text-shadow:1px 1px 1px #000;
		text-align:center;
		margin-bottom:10px;
		display:inline-block;
	}
	.product-desc{
		color:#0B75AF;
		font-size:16px;
		//font-weight:bold;
	}	
</style>

<style type="text/css">

	.gg-logo {
		 background: url(images/LogoWhite.png);
		 background-repeat: no-repeat;
		 background-repeat: no-repeat;
		 
		 background-position:center;
 			
 		background-size:contain;
 		margin-left:-80px;
		 
		 width:auto;
		 
		 padding:0px;
		 height:100px;
		 display:block;
		 border:0px;
		 outline:none;
	}

</style>

<?php 
	function AddMenu(){
		echo "<center>";
		BeginAddMenu('mainmenu'); 
		
		echo "<center><a class='gg-logo' href='index.php' style='margin-left:-85px;'></a></center>";
			AddMenuItem("index.php","images/Home.png","Home 🏠","Zur Startseite");
			BeginAddMenuItem("products.php","images/Products.png","Produkte","Die GG-Preme Line"); 
			echo "	
				<div class='sdt_box' style='z-index:1;'>
						<a href='t-shirts.php'>T-Shirts</a>
						<a href='product.php?ProdNr=10'>Hoodies</a>
						<a href='poloshirts.php'>Polo-Shirts</a>
						<a href='sweater.php'>Sweater</a>
						<a href='more.php'>und mehr...</a>
				</div>
			";
			EndAddMenuItem();
			AddMenuItem("aboutus.php","images/aboutus.png","&Uuml;ber uns","Die Sch&uuml;lerfirma der QI");
			AddMenuItem("contact.php","images/Kontakt.png","Kontakt","Schreib uns doch mal");
			$CartMsg = "Deine Bestellungen";
			if(isset($_SESSION['User'])){
				$select = "select Amount from Orders where Username='".$_SESSION['User']."';";
				$result = mysql_query($select);
				$count = 0;
				while($data = mysql_fetch_array($result)){
					$count += $data[0];	
				}
				if($count != "0"){
					$CartMsg = "Du hast $count Shirts im Korb";
				}
			}
			AddMenuItem("orders.php","images/Warenkorb.png","Warenkorb",$CartMsg);
			if(!isset($_SESSION['User'])){
				AddMenuItem("login.php","images/Login.png","Anmelden","oder registrieren"); 
			}
			else{
				BeginAddMenuItem("profile.php","images/Login.png",$_SESSION['User'],"Mein Account");
				echo "
		 			<div class='sdt_box' style='z-index:1;'>
						<a href='profile.php'>Mein Profil</a>
						<a href='orders.php'>Bestellungen</a>
						<a href='logout.php'>Logout</a>
					</div>
		 		";
				EndAddMenuItem();
			}
		EndAddMenu(); 
		echo "</center>";
	}
	function AddFooter(){
		$added = "";
		$select = "select * from Accounts where Username = '".$_SESSION['User']."';";
		$result = mysql_fetch_array(mysql_query($select));
		if($result['Nachname'] == "Venizelos" && $result['Vorname'] == "Lara"){
			$added = "<a href='loveyou.php' style='float:right;text-transform: none'>Hi Lara, ich liebe dich <3</a>";
		}
		echo "
			<div>
	            <span class='reference' style='width:100%'>
	                <a href='Impressum.php'>Impressum</a>
					<a href='Datenschutz.php'>Datenschutz</a>
					
					<a href='' style='float:right;text-transform: none'>Copyright &copy;2017 Dominik Sander f&uuml;r GG-Preme</a>
					$added
	            </span>
			</div>
		";
	}
	function Alert($msg){
		echo "<script>alert(\"$msg\");</script>";
	}
?>