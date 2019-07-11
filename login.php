

<?php 

	session_start();
	include "baglanti.php";

	if(isset($_SESSION['session_id']))
		header("location:anasayfa.php");

	if(isset($_COOKIE['kid'])){
		$_SESSION['session_id']=$_COOKIE['kid'];
		header("location:anasayfa.php");
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/loginstyle.css">
</head>
<body>
	<div class="ust">
		<div class="ust_orta">
			<a href="#">
				<div class="anasayfa">
				<img src="img/kus.png" alt="">
				<p>Anasayfa</p>
			</div>		
			</a>
			<div style="clear: both;"></div>

			<a href="##">
			<div class="hakkımızda">
				<p>Hakkımızda</p>
			</div>
			</a>

			<div style="clear: both;"></div>
			<div class="dil">
				<div class="dil2">
					<a href="">Dil:<strong> Türkçe</strong> <div class="ucgen"></div></a>
				</div>
				</div>
			<div style="clear: both;"></div>
		</div>
	</div>

	<div class="alt">
		<div class="girisyap">
			
			<div class="alt_bir">
				<div class="tgyap">
					<h1>Twitter'a giriş yap</h1>
				</div>
				<form action="" method="POST">
					<div class="eposta">
						<div class="e-posta">
							<input type="text" name="username" placeholder="Telefon, e-posta veya kullanıcı adı">
						</div>
						<div class="sifre">
							<input type="password" name="password" placeholder="Şifre">
						</div>
					</div>
					<div class="son">
						<div class="buton">
							<button type="submit">Giris yap</button>
						</div>

						<div class="benihatırla">
							<input name="beni_hatırla" type="checkbox" value="1"> Beni hatırla
							<div class="nokta"></div> 
							<a href="pdegis.php">Şifreni mi unuttun</a>
						</div>
						
					</div>
				</form>
				
			</div>
			<div class="alt_iki">
				<p>Twitter'da yeni misin? <a href="kayit.php">Hemen kaydol »</a></p>
				<p>Twitter'ı zaten kısa mesaj yoluyla mı kullanıyorsun? <a href="#">Hesabını etkinleştir »</a></p>
			</div>
			
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
							
							if(@$_POST['beni_hatırla']=="1")
								setcookie('kid',$bilgiler['id'],time()+(60*60*24));
						}						
						else
							echo "Kullanıcı adı veya şifre hatalı";						

					}
					else
						echo "Böyle bir kullanıcı bulunmamaktadır";
				}
		
			 ?>
		</div>
	</div>
</body>
</html>