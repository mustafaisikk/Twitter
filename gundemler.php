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
	<link rel="stylesheet" href="css/acilir.css">
	<link rel="stylesheet" href="css/gundemler.css">
	<link rel="stylesheet" href="css1/font-awesome.css">


</head>
<body>

	<div class="ana">
		
		<?php include("acilir.php") ?>


		<div class="alt">
			<div class="alt_sol">
				
					<div class="gundemler">
					<div class="gundemler_ust">
						<div class="icgundemler"><p>İlgini çekebilecek gündemler</p></div>
					</div>
					<div class="gundemler_alt">
						<?php 

							$trendler= mysqli_query($baglanti,"SELECT gonderi_id,COUNT(*)as sayi FROM `begeniler` GROUP by gonderi_id ORDER by sayi DESC");

							$son=0;
							while ($trend_yaz = mysqli_fetch_assoc($trendler)) {
								if($son==5){
							 		break;
							 	}
							 	else 
							 		$son+=1;

								$trend_bil = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from paylasim 
									where paylasim_id = '".$trend_yaz['gonderi_id']."' "));

									?>
										<a href="gonderi.php?id=<?=$trend_yaz['gonderi_id']?>">
											<div class="gundemler_alt_bir hover">
												<div class="gundemler_alt_bir_bir"><span>Twitter gündeminde</span></div>
												<div class="gundemler_alt_bir_iki"><span>#<?=$trend_bil['icerik'] ?></span></div>
												<div class="gundemler_alt_bir_uc"><span><?=$trend_yaz['sayi'] ?> Beğeni</span></div>
											</div>
										</a>

									<?php
							}

						 ?>
						<a href="">
							<div class="dfgoster hover">
							<span>Daha fazla göster</span>
						</div>
						</a>
					</div>
				</div>

				

			</div>

			<div class="alt_sag">

					<div class="alt_sag_bir">

						<div class="alt_sag_bir_bir">
							<h3>Kimi takip etmeli</h3>
						</div>
							<?php 
								$benim_id=$_SESSION['session_id'];
								$benim_t_e=array();
								$takip_takip_dizi = array();

								$t_ettiklerim=mysqli_query($baglanti,"SELECT * from takipciler where teden_id='$benim_id' ");
								while($tek=mysqli_fetch_assoc($t_ettiklerim)){
									array_push($benim_t_e, $tek['tedilen_id']);

									$takip_id = $tek['tedilen_id'];

									$takip_takip=mysqli_query($baglanti,"SELECT * from takipciler where tedilen_id!='$benim_id' and teden_id='$takip_id' ");
									while($takip_takipler = mysqli_fetch_assoc($takip_takip)){
										array_push($takip_takip_dizi, $takip_takipler['tedilen_id']);
									
									}
								}
							
							$result1 = array_diff($takip_takip_dizi, $benim_t_e);
							$result = array_unique($result1);
							
							$result_say=count($result);

							$son=0;
							 foreach ($result as $key) {
							 	$bilgiler = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT * from uyeler where id='$key' "));
							 	if($son==3){
							 		break;
							 	}
							 	else 
							 		$son+=1;
							 	?>
									<a href="profil.php?id=<?=$key?>">
										<div class="alt_sag_bir_iki">
											<div class="alt_sag_bir_iki_teden">
											</div>
											<div class="alt_sag_bir_iki_profil hover">
												<img src="img/profil.png" alt="">
												<div class="resim_sag">
													<div class="resim_sag_bir">
														<div class="resim_sag_bir_bir"><span><?php echo $bilgiler['isim']; ?></span></div>
														<div class="span_alti"><span><?php echo $bilgiler['kadi']; ?></span></div>
													</div> 
													<a href="islemler.php?i=takip_et&id=<?=$key?>">
														<div class="resim_sag_buton">
															<button class="resim_sag_buton1">Takip et</button>
														</div>
													</a>
												</div>
											</div>
										</div>
									</a> 

							<?php
							 }
							 if($result_say>3){
							 	?>
							 	<a href="arama.php?i=kte_dhf">
									<div class="dfgoster hover">
										<span>Daha fazla göster</span>
									</div>
								</a>
							 	<?php
							 }
							 ?>
					</div>
				<div class="domain">
					<div class="liste_sag">
						<ul>
							<li><a href="">Şartlar</a></li>
							<li><a href="">Gizlilik politikası</a></li> 
							<li><a href="">Çerezler</a></li>
							<li><a href="">Reklam bilgileri</a></li>
						</ul>
					</div>
					<div class="domain_alt">
						<div class="daha_fazla">
							<span>Daha fazla<i class="fas fa-chevron-down"></i></span>
						</div>
						<div class="t2019">
							<span>© 2019 Twitter, Inc.</span>
						</div>
					</div>
				</div>

			</div>
		

		</div>

	</div>
	
</body>
</html>
