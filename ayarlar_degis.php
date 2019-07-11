<?php 
	session_start();
	include "baglanti.php";
		
	if(!isset($_SESSION['session_id']))
		header("location:login.php");	

	
	$kisiselbilgilerim = mysqli_fetch_assoc(mysqli_query($baglanti, 'select * from uyeler where id='.$_SESSION['session_id']));
	$hata="";
	
	$islem=$_GET['i'];
	
	if($islem=="ka_k"){
			
			if(!isset($_POST['kadi_deg']))
				header("location:ayarlar_degis.php?i=ka_d");

			
			$kadi=$_POST['kadi_deg'];
			if($kadi!=""){
				$eski=$kisiselbilgilerim['kadi'];	
				$sql="SELECT * from uyeler where kadi='$kadi'";
				$kontrol=mysqli_num_rows(mysqli_query($baglanti,$sql));
					if($kontrol<1){
							mysqli_query($baglanti,"UPDATE uyeler SET kadi='$kadi' WHERE kadi='$eski'  ");
							header("Location:ayarlar_degis.php?i=ka_d");
						}
						else 
							$hata="Böyle Bir Kullanıcı var";
					}
			else
				$hata="Lütfen bir kullanıcı adı giriniz";

	}

	else if($islem=="sd_k"){

		if(!isset($_POST['password']))
			header("location:ayarlar_degis.php?i=s_d");

		if($_POST['password']!=""){

			$password1=@$_POST['password'];
			$password2=@$_POST['password1'];
			$password3=@$_POST['password2'];
			
			if($password2!="" && $password3!=""){

				if(md5($password1)==$kisiselbilgilerim['sifre']){
				
					if($password2==$password3){
							
						if($password1 != $password2){

							$sifre=md5($password2);
							mysqli_query($baglanti,"UPDATE uyeler SET sifre='$sifre' WHERE kadi='".$kisiselbilgilerim['kadi']."'  ");
							$hata="Şifreniz Değiştirildi";
						}
						else 
							$hata = "Lütfen mevcut şifrenizden farklı bir şifre seçiniz";

					}
					else
					$hata="Yeni Şifreler Uyuşmamaktadır.";
				}
				else
					$hata="Şifreniz Hatalıdır.";
			}
			else
				$hata = "Lütfen Yeni şifre alanlarını doldurunuz.";
		}
		else 
			$hata = "Lütfen Mevcut şifrenizi giriniz";
	}


	else if($islem=="td_k"){
		
		if(!isset($_POST['telefon']))
			header("location:ayarlar_degis.php?i=t_d");
		
		$telefon=$_POST['telefon'];
		if($telefon!=""){
			$kadi=$kisiselbilgilerim['kadi'];
			mysqli_query($baglanti,"UPDATE uyeler SET telefon='$telefon' WHERE kadi='$kadi'  ");
			header("Location:ayarlar_degis.php?i=t_d");
		}	
		else 
			$hata = "Lütfen bir telefon numarası giriniz";
	}

	else if($islem=="epd_k"){
		
		if(!isset($_POST['email']))
			header("location:ayarlar_degis.php?i=ep_d");

		$email=$_POST['email'];

		if($email!=""){
			mysqli_query($baglanti,"UPDATE uyeler SET eposta='$email' WHERE kadi='".$kisiselbilgilerim['kadi']."'");
			header("Location:ayarlar_degis.php?i=ep_d");
		}
		else
			$hata="Lütfen bir e-posta giriniz";
		
	}

	
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Twitter</title>
	<link rel="stylesheet" href="css/ayarlar_degis.css">
	<link rel="stylesheet" href="css/acilir.css">
	<link rel="stylesheet" href="css1/font-awesome.css">


</head>
<body>

	<div class="ana">
		
		<?php include ('acilir.php'); ?>
		
		<div class="alt">

			<div class="alt_sol">

				<div class="ayarlar_alt_sol1">
					<h2>Ayarlar</h2>
				</div>
				<div class="ayarlar_alt_sol2">
					<h3><?=$kisiselbilgilerim['kadi'] ?></h3>
				</div>
				<a href="ayarlar.php" style="text-decoration: none;">
					<div class="ayarlar_alt_sol3">
						<div class="ayarlar_alt_sol3_span"><span>Hesap</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</a>
				<div class="ayarlar_alt_sol4 hover">
					<div class="ayarlar_alt_sol4_span"><span>Gizlilik ve güvenlik</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sol4 hover">
					<div class="ayarlar_alt_sol4_span"><span>Bildirimler</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sol4 hover">
					<div class="ayarlar_alt_sol4_span"><span>İçerik tercihleri</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sol2">
					<h3>Genel</h3>
				</div>
				<div class="ayarlar_alt_sol4 hover">
					<div class="ayarlar_alt_sol4_span"><span>Veri kullanımı</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sol4 hover">
					<div class="ayarlar_alt_sol4_span"><span>Erişilebilirlik</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sol4 hover">
					<div class="ayarlar_alt_sol4_span"><span>Twitter hakkında</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
			</div>

			<div class="alt_sag">

				<?php 
					
					$islem=$_GET['i'];

					if($islem=="ka_d" || $islem=="ka_k"){
						?>
						
						<div class="ka_d">
							<div class="ayarlar_alt_sag1">
								<a href="ayarlar.php">
									<div class="ayarlar_alt_sag1_i yuvarlak hover3">
										<i class="fa fa-arrow-left" aria-hidden="true"></i>
									</div>
								</a>
								<h2>Kullanıcı adını değiştir</h2>
							</div>
							<div class="ayarlar_alt_sag_2">
								<div class="ayarlar_alt_sag_11" style="margin-bottom: 10px;">
									<span>Geçerli</span>
								</div>
								<div class="ayarlar_alt_sag_11">
									<span><?=$kisiselbilgilerim['kadi'] ?></span>
								</div>
							</div>
							<div class="ayarlar_alt_sag3">
								<form action="ayarlar_degis.php?i=ka_k" method="POST">
									<div class="ayarlar_alt_sag31">
										<div class="ayarlar_alt_sag311">
											<span>Yeni</span>
										</div>
										<div class="ayarlar_alt_sag312">
											<input type="text" name="kadi_deg">
										</div>
									</div>
							</div>
							<div class="ayarlar_alt_sag3"   style="margin-top: 20px;">
								<div class="ayarlar_alt_sag3_buton">
									<div class="ayarlar_alt_sag3_buton1">
										<input type="submit" value="Kaydet">
									</div>
									<div class="" style="clear: both;"></div>
								</div>
								</form>
							</div>
							<?php 
								if($islem=='ka_k'){
									if(isset($_POST)){
										?>
									<div class="ayarlar_alt_sag3"  style="margin-top: 20px;">
										<span class="sonuc"><?=$hata?></span>
									</div>
									<?php
									}
								}
							 ?>
						
						</div>	

						<?php
					}

					else if($islem=="t_d" || $islem =="td_k"){
						?>
						
						<div class="t_d">
							<div class="ayarlar_alt_sag1">
								<a href="ayarlar.php">
									<div class="ayarlar_alt_sag1_i yuvarlak hover3">
										<i class="fa fa-arrow-left" aria-hidden="true"></i>
									</div>
								</a>
								<h2>Telefon değiştir</h2>
							</div>
							<div class="ayarlar_alt_sag_2">
								<div class="ayarlar_alt_sag_11" style="margin-bottom: 10px;">
									<span>Geçerli</span>
								</div>
								<div class="ayarlar_alt_sag_11">
									<span><?=$kisiselbilgilerim['telefon'] ?></span>
								</div>
							</div>
							<div class="ayarlar_alt_sag3">
								<form action="ayarlar_degis.php?i=td_k" method="POST">
									<div class="ayarlar_alt_sag31">
										<div class="ayarlar_alt_sag311">
											<span>Yeni</span>
										</div>
										<div class="ayarlar_alt_sag312">
											<input type="text" name="telefon" pattern="\d{11}" title="Bu input'a sadece 11 karakterli sayısal değer girilebilir">
										</div>
									</div>
							</div>
							<div class="ayarlar_alt_sag3"   style="margin-top: 20px;">
								<div class="ayarlar_alt_sag3_buton">
									<div class="ayarlar_alt_sag3_buton1">
										<input type="submit" value="Kaydet">
									</div>
									<div class="" style="clear: both;"></div>
								</div>
								</form>
							</div>
							<?php 
								if($islem=='td_k'){
									if($_POST){
										?>
										<div class="ayarlar_alt_sag3"  style="margin-top: 20px;">
											<span class="sonuc"><?=$hata?></span>
										</div>
										<?php
									}
								}
							 ?>
						</div>	

						<?php
					}

					else if($islem=="ep_d" || $islem=="epd_k"){
						?>
						
						<div class="ep_d">
							<div class="ayarlar_alt_sag1">
								<a href="ayarlar.php">
									<div class="ayarlar_alt_sag1_i yuvarlak hover3">
										<i class="fa fa-arrow-left" aria-hidden="true"></i>
									</div>
								</a>
								<h2>E-postayı değiştir</h2>
							</div>
							<div class="ayarlar_alt_sag_2">
								<div class="ayarlar_alt_sag_11" style="margin-bottom: 10px;">
									<span>Geçerli</span>
								</div>
								<div class="ayarlar_alt_sag_11">
									<span><?=$kisiselbilgilerim['eposta'] ?></span>
								</div>
							</div>
							<div class="ayarlar_alt_sag3">
								<form action="ayarlar_degis.php?i=epd_k" method="POST">
									<div class="ayarlar_alt_sag31">
										<div class="ayarlar_alt_sag311">
											<span>Yeni</span>
										</div>
										<div class="ayarlar_alt_sag312">
											<input type="email" name="email">
										</div>
									</div>
							</div>
							<div class="ayarlar_alt_sag3"   style="margin-top: 20px;">
								<div class="ayarlar_alt_sag3_buton">
									<div class="ayarlar_alt_sag3_buton1">
										<input type="submit" value="Kaydet">
									</div>
									<div class="" style="clear: both;"></div>
								</div>
								</form>
							</div>
							<?php 
								if($islem=='epd_k'){
									if($_POST){
										?>
										<div class="ayarlar_alt_sag3"  style="margin-top: 20px;">
											<span class="sonuc"><?=$hata?></span>
										</div>
										<?php
									}
								}
							 ?>
						</div>	

						<?php
					}

					else if ($islem=="s_d" || $islem=="sd_k") {
						?>
						
						<div class="s_D">
							<div class="ayarlar_alt_sag1">
								<a href="ayarlar.php">
									<div class="ayarlar_alt_sag1_i yuvarlak hover3">
										<i class="fa fa-arrow-left" aria-hidden="true"></i>
									</div>
								</a>
								<h2>Şifreyi değiştir</h2>
							</div>
							<div class="ayarlar_alt_sag3">
								<form action="ayarlar_degis.php?i=sd_k" method="POST">
									<div class="ayarlar_alt_sag31">
										<div class="ayarlar_alt_sag311">
											<span>Şimdiki Şifre</span>
										</div>
										<div class="ayarlar_alt_sag312">
											<input type="password" name="password">
										</div>
									</div>
									<div class="ayarlar_alt_sag31" style="margin-top: 20px;">
										<div class="ayarlar_alt_sag311">
											<span>Yeni Şifre</span>
										</div>
										<div class="ayarlar_alt_sag312">
											<input type="password" name="password1">
										</div>
									</div>
									<div class="ayarlar_alt_sag31"  style="margin-top: 20px;">
										<div class="ayarlar_alt_sag311">
											<span>Parolayı doğrula</span>
										</div>
										<div class="ayarlar_alt_sag312">
											<input type="password" name="password2">
										</div>
									</div>
							</div>
							<div class="ayarlar_alt_sag3"   style="margin-top: 20px;">
								<div class="ayarlar_alt_sag3_buton">
									<div class="ayarlar_alt_sag3_buton1">
										<input type="submit" value="Kaydet">
									</div>
									<div class="" style="clear: both;"></div>
								</div>
								</form>
							</div>
							<?php 
								if($islem=='sd_k'){
									if($_POST){
										?>
										<div class="ayarlar_alt_sag3"  style="margin-top: 20px;">
											<span class="sonuc"><?=$hata?></span>
										</div>
										<?php
									}
								}
							 ?>
						</div>	

						<?php

					}
				 ?>
			</div>

		</div>

	</div>
	
</body>
</html>
