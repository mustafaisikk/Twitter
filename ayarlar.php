<?php 
	
	session_start();
	include "baglanti.php";
		
	if(!isset($_SESSION['session_id']))
		header("location:login.php");

	
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Twitter</title>
	<link rel="stylesheet" href="css/ayarlar.css">
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
				<div class="ayarlar_alt_sol3">
					<div class="ayarlar_alt_sol3_span"><span>Hesap</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
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
				<div class="ayarlar_alt_sol1">
					<h2>Hesap</h2>
				</div>
				<div class="ayarlar_alt_sol2">
					<h3>Giriş ve güvenlik</h3>
				</div>
				<a href="ayarlar_degis.php?i=ka_d">
					<div class="ayarlar_alt_sag1 hover">
					<div class="ayarlar_alt_sag11">
						<div class="ayarlar_alt_sag111"><span>Kullanıcı adı</span></div>
						<div class="ayarlar_alt_sag112"><span><?=$kisiselbilgilerim['kadi'] ?></span></div>
					</div>
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				</a>
				<a href="ayarlar_degis.php?i=t_d">
					<div class="ayarlar_alt_sag1 hover">
					<div class="ayarlar_alt_sag11">
						<div class="ayarlar_alt_sag111"><span>Telefon</span></div>
						<div class="ayarlar_alt_sag112"><span><?=$kisiselbilgilerim['telefon'] ?></span></div>
					</div>
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				</a>
				<a href="ayarlar_degis.php?i=ep_d">
					<div class="ayarlar_alt_sag1 hover">
					<div class="ayarlar_alt_sag11">
						<div class="ayarlar_alt_sag111"><span>E-posta</span></div>
						<div class="ayarlar_alt_sag112"><span><?=$kisiselbilgilerim['eposta'] ?></span></div>
					</div>
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				</a>
				<a href="ayarlar_degis.php?i=s_d">
					<div class="ayarlar_alt_sag4 hover">
						<div class="ayarlar_alt_sag4_span"><span>Şifre</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</a>
				<div class="ayarlar_alt_sag4 hover">
					<div class="ayarlar_alt_sag4_span"><span>Güvenlik</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sol2">
					<h3>Veriler ve izinler</h3>
				</div>
				<div class="ayarlar_alt_sag1 hover">
					<div class="ayarlar_alt_sag11">
						<div class="ayarlar_alt_sag111"><span>Dil</span></div>
						<div class="ayarlar_alt_sag112"><span>Türkçe</span></div>
					</div>
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sag1 hover">
					<div class="ayarlar_alt_sag11">
						<div class="ayarlar_alt_sag111"><span>Ülke</span></div>
						<div class="ayarlar_alt_sag112"><span>Türkiye</span></div>
					</div>
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sag4 hover">
					<div class="ayarlar_alt_sag4_span"><span>Tweet verilerin</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sag4 hover">
					<div class="ayarlar_alt_sag4_span"><span>Uygulamalar ve oturumlar</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
				<div class="ayarlar_alt_sag5 hover">
					<div class="ayarlar_alt_sag5_span"><span>Hesabını Devre Dışı Bırak</span></div><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</div>
			</div>

		</div>

	</div>
	
</body>
</html>