<?php 
	include "baglanti.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Twitter'a kaydol/Twitter</title>
	<link rel="stylesheet" href="css/kayit.css" type="text/css">
</head>
<body>
	
	<div class="ana">
		<div class="ic">
			<div class="ic_ust">
				<div class="h2"> <h2>Twitter'a kaydol</h2></div>
			</div>

			<div class="ic_alt">
				<div class="h1"><h1>Hesabını oluştur</h1></div>
				<form method="POST" action="">
					<div class="input"><input type="text" name="isim" placeholder="İsim"></div>
					<div class="input"><input type="text" name="kadi" placeholder="Kullanıcı adı"></div>
					<div class="input"><input type="email" name="e-posta" placeholder="E-posta"></div>
					<div class="input"><input type="tel" name="telefon" placeholder="Telefon"></div>
					<div class="input"><input type="password" name="sifre" placeholder="Şifre"></div>
					<div class="buton"><input type="submit" name="kbuton" value="Kayıt ol"></div>
				</form>
				<div class="eposta"> <a href="#">Telefon kullan</a></div>
				<?php 

					if($_POST){
						$isim = $_POST["isim"];
						$kadi = $_POST["kadi"];
						$e_posta = $_POST["e-posta"];
						$telefon = $_POST["telefon"];
						$sifre = $_POST["sifre"];

						
						if($isim!="" && ($kadi!="" || $e_posta!="" || $telefon!="") && $sifre!=""){

							$kadi_kontrol = mysqli_num_rows(mysqli_query($baglanti,"SELECT * from uyeler where kadi='$kadi' "));
							$eposta_kontrol = mysqli_num_rows(mysqli_query($baglanti,"SELECT * from uyeler where eposta='$e_posta' "));
							$telefon_kontrol = mysqli_num_rows(mysqli_query($baglanti,"SELECT * from uyeler where telefon='$telefon' "));

							if($kadi!="" && $kadi_kontrol>0){
								?>
								<div class="" style="padding: 15px; ">
									<span>Lütfen Başka bir kullanıcı adı giriniz.</span>
								</div>
							<?php
							}
							if($e_posta!="" && $eposta_kontrol>0){
								?>
								<div class="" style="padding: 15px; ">
									<span>Lütfen Başka bir E-posta giriniz.</span>
								</div>
							<?php
							}
							if($telefon!="" && $telefon_kontrol>0){
								?>
								<div class="" style="padding: 15px; ">
									<span>Lütfen Başka bir Telefon giriniz.</span>
								</div>
							<?php
							}
							if(($kadi_kontrol+$eposta_kontrol+$telefon_kontrol)==0){
								
							
								$sifre1=md5($sifre);
								mysqli_query($baglanti,"INSERT into uyeler (kadi,sifre,isim,telefon,eposta,tarih) 
									values ('$kadi','$sifre1','$isim','$telefon','$e_posta',now())");

								?>
									<div class="" style="padding: 15px; ">
										<span>Kayıdınız oluşturuldu.</span>
									</div>
								<?php

							}
							
						}	
						else
						{
							?>
								<div class="" style="padding: 15px; ">
									<span>Lütfen Boş Alan Bırakmayınız.</span>
								</div>
							<?php
						}
				
					}
				?>
			</div>
		</div>
	</div>

</body>
</html>

