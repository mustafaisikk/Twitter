<?php 
	
	session_start();
	include "baglanti.php";
	if(isset($_SESSION['session_id'])){
	 
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Twitter</title>
	<link rel="stylesheet" href="css/acilir.css">
	<link rel="stylesheet" href="css/mesajlar.css">
	<link rel="stylesheet" href="css1/font-awesome.css">


</head>
<body>

	<div class="ana">
		
		<?php include('acilir.php'); ?>

		<div class="alt">
			
			<div class="alt_sol">		
				
				<div class="mesajlar_sol_ust">
					<h2>Mesajlar</h2>
				</div>

				<div class="mesajlar_sol_alt">
					<div class="mesajlar_sol_alt_ic">
						<div class="mgal"><span>Mesaj gönder, mesaj al</span></div>
						<div class="mgal_alt1"><span>Direkt Mesajlar, sen ve Twitter'daki diğer kişiler
						arasında gerçekleşen özel sohbetlerdir.
					Tweetleri, medyaları ve daha fazlasını paylaşabilirsin!</span></div>
						<div class="mgal_buton"><button class="mgal_buton1">Sohbet başlat</button></div>
					</div>
				</div>
			
			</div>

			<div class="alt_sag">
				<div class="mesajlar_sag_alt">
					<div class="mesajlar_sol_alt_ic">
						<div class="mgal"><span>Seçili bir mesajın yok</span></div>
						<div class="mgal_alt1"><span>Mevcut mesajlarından birini seç veya yeni bir mesaja başla.</span></div>
						<div class="mgal_buton"><button class="mgal_buton1">Yeni mesaj</button></div>
					</div>
				</div>
					
			</div>
		

		</div>

	</div>
	
</body>
</html>

<?php 
}
	else
		header("location:login.php");
 ?>