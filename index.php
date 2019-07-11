
<?php 
	session_start();
	include "baglanti.php";


	if(isset($_SESSION['session_id']))
		header("location:anasayfa.php");

	if(isset($_COOKIE['kid'])){
		$_SESSION['session_id'] = $_COOKIE['kid'];
		header("location:anasayfa.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css1/font-awesome.css">
	<title>TWİTTER</title>
</head>
<body>

<div class="ana">

		<div class="sol">
			<div class="sol_orta">
			
				<div class="sol_ic_bir">
					<i class="fa fa-search" aria-hidden="true"></i>
			 		<h5>İlgili ilanlarını takip et</h5>
				</div>

				<div class="sol_ic_iki">

					<i class="fa fa-users" aria-hidden="true"></i>
					<h5>İnsanların konuştukları konular.</h5>

				</div>

				<div class="sol_ic_uc">
					<i class="fa fa-comment-o" aria-hidden="true"></i>
					<h5>Sohbete katıl.</h5>

				</div>

		</div>
	
	</div>
	
	<div class="sag">
		<div class="giris">
			
			<form name="form1" method="POST">

			<div class="kadi">
				<input type="text" name="username" placeholder="Kullanıcı adı giriniz." size="15">
			</div>

			<div class="sifre">
				<input type="password" name="password" size="15" placeholder="Sifre">
				<div class="unuttun">
					<a href="pdegis.php">Sifreni mi unuttun</a>
				</div>

			</div>
			
			<button type="submit" >Giris yap</button>

			
		</form>
		<?php 

				if($_POST){

					$username= $_POST["username"];
					$password = md5($_POST["password"]);

					$sql="SELECT * from uyeler where kadi='$username' or telefon='$username' or eposta='$username' ";
					$kontrol=mysqli_num_rows(mysqli_query($baglanti,$sql));

					if ($kontrol>0) {
						
						$sql1="SELECT * from uyeler where (kadi='$username' or telefon='$username' or eposta='$username') and sifre='$password'";
						$kontrol1=mysqli_num_rows(mysqli_query($baglanti,$sql1));

						if($kontrol1 >0){
							$bilgiler = mysqli_fetch_assoc(mysqli_query($baglanti,$sql1));
							$_SESSION['session_id'] = $bilgiler['id'];
							header("location:anasayfa.php");		
						}				
						else
							header("location:login.php");						

					}
					else
							header("location:login.php");						
				}
		
			 ?>

		</div>
	

		<div class="sagkayit">
			<div class="sag_bir">
				<img src="img/kus.png">
			</div>
			<div class="sag_iki">
				<h1>Şu anda dünyada neler olup bittiğini gör</h1>
			</div>
			<div class="sag_uc">
				<h2>Twitter'a bugün katıl.</h2>
				<div class="buton">
				<a href="kayit.php"><button type="submit" class="b1">Kaydol</button></a>
				<a href="login.php"><button type="submit" class="b2">Giriş yap</button></a>
				</div>
			</div>
		</div>
		
	</div>


	<div class="alt">
		<ul>
			<li><a href="">Hakkımızda</a></li>
			<li><a href="">Yardım Merkezi</a></li>
			<li><a href="">Blog</a></li>
			<li><a href="">Durum</a></li>
			<li><a href="">Kariyer</a></li>
			<li><a href="">Koşullar</a></li>
			<li><a href="">Gizlilik Politikası</a></li>
			<li><a href="">Çerezler</a></li>
			<li><a href="">Reklam bilgileri</a></li>
			<li><a href="">Marka</a></li>
			<li><a href="">Reklam</a></li>
			<li><a href="">Pazarlama</a></li>
			<li><a href="">İşletmeler</a></li>
			<li><a href="">Geliştiriciler</a></li>
			<li><a href="">Rehber</a></li>
			<li><a href="">Ayarlar</a></li>
			<li><a href="">© 2019 Twitter</a></li>
		</ul>

	</div>
</div>

</body>
</html>