<?php 
	
	session_start();
	include "baglanti.php";
	if(!isset($_SESSION['session_id']))
		header("location:login.php");

	if(!isset($_GET['id']))
		header("location:anasayfa.php");
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Twitter</title>
	<link rel="stylesheet" href="css/profil.css">
	<link rel="stylesheet" href="css/acilir.css">
	<link rel="stylesheet" href="css1/font-awesome.css">


</head>
<body>

	<div class="ana">
		
		<?php include('acilir.php'); ?>
		
		<div class="alt">
			<div class="alt_sol">		
				<div class="alt_sol_ust">
					<a href="">
						<div class="alt_sol_ust_orta yuvarlak">
						<img src="img/profil.png" alt="">
					</div>
					</a>
					<div class="alt_sol_ust_bir">
					</div>
					
					<div class="alt_sol_ust_iki">
						<?php 

							$profil = $_GET['id'];
							$benim_id=$_SESSION['session_id'];
							
							$kisiselbilgilerim = mysqli_fetch_assoc(mysqli_query($baglanti, "select * from uyeler where id='$profil' "));
							$teden_say = mysqli_fetch_assoc(mysqli_query($baglanti,"select count(*) as sayi from takipciler where tedilen_id='$profil' "));
							$tedilen_say = mysqli_fetch_assoc(mysqli_query($baglanti,"select count(*) as sayi from takipciler where teden_id='$profil' "));

							$takip_mi = mysqli_num_rows(mysqli_query($baglanti,"select * from takipciler where teden_id='$benim_id' and tedilen_id='$profil' "));

							?>
									<div class="alt_sol_ust_iki1 yuvarlak" style="height: 49px;">
										<?php 
											if($benim_id!=$profil){
												if($takip_mi>0){
											?>
													<a href="islemler.php?i=takip_et&id=<?=$profil?>">
														<button>Takipten ÇIK</button>
													</a>
												
											<?php
											}
											else {
												?>
													<a href="islemler.php?i=takip_et&id=<?=$profil?>">
														<button>Takip ET</button>
													</a>
												<?php
											}
											}
										?>
									</div>

						<div class="alt_sol_ust_iki2">
							<div class="alt_sol_ust_iki21"><span><?=$kisiselbilgilerim['isim'] ?></span></div>
							<div class="alt_sol_ust_iki22"><span><?=$kisiselbilgilerim['kadi'] ?></span></div>
						</div>
						<div class="alt_sol_ust_iki3"><span><i class="far fa-calendar-alt"></i><?=$kisiselbilgilerim['tarih']?> tarihinde katıldı</span></div>
						<div class="alt_sol_ust_iki4">
							<?php 
								$profil = $_GET['id'];
							 ?>
							<a href="arama.php?i=t_edilen&id=<?=$profil?>" style="text-decoration: none;"><b style="color: black;"><?=$tedilen_say['sayi']?></b><span>Takip edilen</span></a><a href="arama.php?i=t_eden&id=<?=$profil?>" style="text-decoration: none;"><b style="color: black;"><?=$teden_say['sayi']?></b><span>Takipçiler</span></a>
						</div>
					</div>
				</div>
				<div class="alt_sol_alt">
					<?php 
						if(!isset($_GET['i'])){
							?>
							<div class="alt_sol_alt_header">
								<a href="profil.php?id=<?=$profil?>"><div class="alt_sol_alt_header2"><span>Tweetler</span></div></a>
								<a href="profil.php?i=yanıt&id=<?=$profil?>"><div class="alt_sol_alt_header1"><span>Tweetler ve yanıtlar</span></div></a>
								<a href=""><div class="alt_sol_alt_header1"><span>Medya</span></div></a>
								<a href="profil.php?i=begeni&id=<?=$profil?>"><div class="alt_sol_alt_header1"><span>Beğeni</span></div></a>
							</div>
							<div class="alt_sol_alt_gonderiler">
								<?php
									$profil = $_GET['id'];

									$gonderiler = mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id and kisi_id='$profil' order by P.tarih desc");

									while($yaz = mysqli_fetch_assoc($gonderiler)) {
										$paylasim_id=$yaz['paylasim_id'];

										?>
										<a href="gonderi.php?id=<?= $paylasim_id?>" style="text-decoration: none;">
											<div class="paylasim hover">
												<div class="paylasim_sol">	
													<img src="img/profil.png" alt="">
												</div>
												<div class="paylasim_sag" style="overflow: hidden;">		
													<div class="paylasim_sag_bir">
														<div class="paylasim_sag_bir_sol">
															<div class="paylasim_sag_bir_bir">
																<span class="paylasim_sag_bir_bir_ad"><?php echo $yaz['isim']; ?></span> 
																<span class="paylasim_sag_bir_bir_kadi"><?php echo $yaz['kadi']; ?></span>
															</div>
															<div class="nokta"></div>
															<span class="paylasim_sag_bir_bir_time"><?php echo $yaz['tarih']; ?></span>
														</div>
										</a>	
										<?php 
										$benim_id=$_SESSION['session_id'];
										$kimin = mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim 
															where kisi_id='$benim_id' and paylasim_id='$paylasim_id' "));
										if($kimin>0){
											?>
											<a href="islemler.php?i=gonderi_sil&id=<?= $paylasim_id?>">
												<div class="paylasim_sag_bir_bir_icon yuvarlak hover3">
													<i class="fa fa-times-circle" aria-hidden="true"></i>
												</div>
											</a>
											<?php 
										}
										?>
											<a href="gonderi.php?id=<?= $paylasim_id?>" style="text-decoration: none;">	
												</div>

												<div class="paylasim_sag_iki">
													<span class="paylasim_sag_iki_span"><?php echo $yaz['icerik']; ?></span>
												</div>
												<?php 
													if(isset($yaz['retweet_id'])){

													if($yaz['retweet_id']==0)
														{
															?>
															<div class="div_retweet_yok">
																<div class="div_retweet_yok1">
																	<span>Bu Tweet kullanım dışı.</span>
																</div>
															</div>
															<?php
														}

													if($yaz['retweet_id']!=0)
													{
														$retweet_id=$yaz['retweet_id'];
														$retweet_bilgileri = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from paylasim P inner join uyeler U on U.id = P.kisi_id and  paylasim_id='$retweet_id'"));
													?>
													<div class="div_retweet">
														<div class="div_retweet_ust">
															<div class="div_retweet_ust1"><img src="img/profil.png" alt=""></div>
															<div class="div_retweet_ust2"><span><?=$retweet_bilgileri['isim']?></span></div>
															<div class="div_retweet_ust3"><span>@ <?=$retweet_bilgileri['kadi']?></span></div>
															<div class="nokta"></div>
															<div class="div_retweet_ust4"><span><?=$retweet_bilgileri['tarih']?></span></div>
														</div>
														<div class="div_retweet_alt">
															<span><?=$retweet_bilgileri['icerik']?></span>
														</div>
													</div>		
													<?php  	
													}
													}
												 ?>
												</a>

												<div class="paylasim_sag_uc">
													<?php 
														$yorum_say = mysqli_fetch_assoc(mysqli_query($baglanti, "select count(paylasim_id) as yorum_say from paylasim P inner join uyeler U on U.id = P.kisi_id where ust_id='$paylasim_id'"));

													 ?>
													<div class="paylasim_sag_uc_yorum">
														<a href="gonderi.php?i=yorum_yap&id=<?= $paylasim_id ?>" style="text-decoration: none;">
															<i class="fa fa-comment  yuvarlak hover3 gri" aria-hidden="true"></i>
														</a>
														<?php 
																if($yorum_say['yorum_say']>0)
																	echo $yorum_say['yorum_say'];
															 ?>
													</div>
													
													<div class="paylasim_sag_uc_retweet">
														<?php 
														$rtmi= mysqli_num_rows(mysqli_query($baglanti,"SELECT * from retweet where 
															kisi_id='".$_SESSION['session_id']."' and paylasim_id='".$yaz['paylasim_id']."'"));
														$rt_say = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(paylasim_id)as C from retweet where paylasim_id='".$yaz['paylasim_id']."'"));
													 
														if($rtmi<1){
															?>
														<i class="fa fa-retweet  yuvarlak hover3 gri" aria-hidden="true" style="cursor: pointer;"></i>
														<div class="retweet_acilir">
															<a href="islemler.php?i=retweet&id=<?=$paylasim_id ?>" style="text-decoration: none;">
																<div class="retweet_acilir1 hover">
																	<span style="color: black">Retweet</span>
																</div>
															</a>
															<a href="arama.php?i=retweet&id=<?=$paylasim_id ?>" style="text-decoration: none;">
																<div class="retweet_acilir1 hover">
																	<span style="color: black">Yorumla birlikte retweet</span>
																</div>
															</a>
														</div>
														<?php 
															if($rt_say['C']>0)
																echo $rt_say['C'];
															}
														
														else{
															?>
														<a href="islemler.php?i=retweet_yapma&id=<?=$paylasim_id ?>" style="text-decoration: none;">
															<i class="fa fa-retweet  yuvarlak hover3 mavi" aria-hidden="true" style="cursor: pointer;"></i>
														</a>
														<?php 
																if($rt_say['C']>0)
																		echo $rt_say['C'];
																	}
																?>
														
													</div>
													<div class="paylasim_sag_uc_like">
														<?php

														// Daha önce bu kişi bu gönderiyi beğenmiş mi 

														$begenimi=mysqli_num_rows(mysqli_query($baglanti,"SELECT * from begeniler where 
															kisi_id='".$_SESSION['session_id']."' and gonderi_id='".$yaz['paylasim_id']."'"));
															$begeni_sayisi=mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(gonderi_id)as C from begeniler where gonderi_id='".$yaz['paylasim_id']."'"));
															if($begenimi<1){
																?>
																	<a href="islemler.php?i=gonderi_begen&t=<?= $paylasim_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 gri" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															else {
																?>
																	<a href="islemler.php?i=gonderi_begenme&t=<?= $paylasim_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 mavi" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															if($begeni_sayisi['C']>0){
																$begenen= mysqli_query($baglanti,"select * from begeniler 
																	where gonderi_id='".$yaz['paylasim_id']."' limit 3");
																while($begenenler = mysqli_fetch_assoc($begenen)){

																	$begenen_adi = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from uyeler 
																		where id='".$begenenler['kisi_id']."' "));

																	if($begeni_sayisi['C']<=3){
																		?>
																		<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black;" class="begeni_link">
																			<span style="font-size: 10px;"><?=$begenen_adi['isim'] ?></span>
																		</a>
																		<?php
																	}
																	else{
																		?>
																			<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black;" class="begeni_link">
																				<span style="font-size: 10px;"><?php echo $begenen_adi['isim'] ?></span>
																			</a>
																		<?php
																	}
																}
																if($begeni_sayisi['C']>3){
																	?>
																	<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black; font-size: 13px;">...+<?=($begeni_sayisi['C']-3)?></a>
																	<?php
																}

														}
														 ?>
														
											</div>
											<div class="paylasim_sag_uc_yorum">
												<a href="">
													<i class="fa fa-external-link yuvarlak hover3 gri" aria-hidden="true"></i>	
												</a>
															</div>
														</div>
													
													</div>
												</div>		
											<?php 
											}
										?>					
										</div> 
										<?php
									}
									else if(@$_GET['i']=="yanıt"){
										?>
										<div class="alt_sol_alt_header">
											<a href="profil.php?id=<?=$profil?>"><div class="alt_sol_alt_header1"><span>Tweetler</span></div></a>
											<a href="profil.php?i=yanıt&id=<?=$profil?>"><div class="alt_sol_alt_header2"><span>Tweetler ve yanıtlar</span></div></a>
											<a href=""><div class="alt_sol_alt_header1"><span>Medya</span></div></a>
											<a href="profil.php?i=begeni&id=<?=$profil?>"><div class="alt_sol_alt_header1"><span>Beğeni</span></div></a>
										</div>
										<div class="alt_sol_alt_gonderiler">
											<?php
									$profil = $_GET['id'];

									$begendiklerim = mysqli_query($baglanti, "Select * from retweet where kisi_id='$profil' ");


									while($begendiklerim_id = mysqli_fetch_assoc($begendiklerim)) {
										$paylasim_id=$begendiklerim_id['paylasim_id'];

										$yaz =  mysqli_fetch_assoc(mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id and paylasim_id='$paylasim_id' order by P.tarih desc"));

										?>
										<a href="gonderi.php?id=<?= $paylasim_id?>" style="text-decoration: none;">
											<div class="paylasim hover">
												<div class="paylasim_sol">	
													<img src="img/profil.png" alt="">
												</div>
												<div class="paylasim_sag" style="overflow: hidden;">		
													<div class="paylasim_sag_bir">
														<div class="paylasim_sag_bir_sol">
															<div class="paylasim_sag_bir_bir">
																<span class="paylasim_sag_bir_bir_ad"><?php echo $yaz['isim']; ?></span> 
																<span class="paylasim_sag_bir_bir_kadi"><?php echo $yaz['kadi']; ?></span>
															</div>
															<div class="nokta"></div>
															<span class="paylasim_sag_bir_bir_time"><?php echo $yaz['tarih']; ?></span>
														</div>
										</a>	
										<?php 
										$benim_id=$_SESSION['session_id'];
										$kimin = mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim 
															where kisi_id='$benim_id' and paylasim_id='$paylasim_id' "));
										if($kimin>0){
											?>
											<a href="islemler.php?i=gonderi_sil&id=<?= $paylasim_id?>">
												<div class="paylasim_sag_bir_bir_icon yuvarlak hover3">
													<i class="fa fa-times-circle" aria-hidden="true"></i>
												</div>
											</a>
											<?php 
										}
										?>
											<a href="gonderi.php?id=<?= $paylasim_id?>" style="text-decoration: none;">	
												</div>

												<div class="paylasim_sag_iki">
													<span class="paylasim_sag_iki_span"><?php echo $yaz['icerik']; ?></span>
												</div>
												<?php 
													if(isset($yaz['retweet_id'])){

													if($yaz['retweet_id']==0)
														{
															?>
															<div class="div_retweet_yok">
																<div class="div_retweet_yok1">
																	<span>Bu Tweet kullanım dışı.</span>
																</div>
															</div>
															<?php
														}

													if($yaz['retweet_id']!=0)
													{
														$retweet_id=$yaz['retweet_id'];
														$retweet_bilgileri = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from paylasim P inner join uyeler U on U.id = P.kisi_id and  paylasim_id='$retweet_id'"));
													?>
													<div class="div_retweet">
														<div class="div_retweet_ust">
															<div class="div_retweet_ust1"><img src="img/profil.png" alt=""></div>
															<div class="div_retweet_ust2"><span><?=$retweet_bilgileri['isim']?></span></div>
															<div class="div_retweet_ust3"><span>@ <?=$retweet_bilgileri['kadi']?></span></div>
															<div class="nokta"></div>
															<div class="div_retweet_ust4"><span><?=$retweet_bilgileri['tarih']?></span></div>
														</div>
														<div class="div_retweet_alt">
															<span><?=$retweet_bilgileri['icerik']?></span>
														</div>
													</div>		
													<?php  	
													}
													}
												 ?>
												</a>

												<div class="paylasim_sag_uc">
													<?php 
														$yorum_say = mysqli_fetch_assoc(mysqli_query($baglanti, "select count(paylasim_id) as yorum_say from paylasim P inner join uyeler U on U.id = P.kisi_id where ust_id='$paylasim_id'"));

													 ?>
													<div class="paylasim_sag_uc_yorum">
														<a href="gonderi.php?i=yorum_yap&id=<?= $paylasim_id ?>" style="text-decoration: none;">
															<i class="fa fa-comment  yuvarlak hover3 gri" aria-hidden="true"></i>
														</a>
														<?php 
																if($yorum_say['yorum_say']>0)
																	echo $yorum_say['yorum_say'];
															 ?>
													</div>
													
													<div class="paylasim_sag_uc_retweet">
														<?php 
														$rtmi= mysqli_num_rows(mysqli_query($baglanti,"SELECT * from retweet where 
															kisi_id='".$_SESSION['session_id']."' and paylasim_id='".$yaz['paylasim_id']."'"));
														$rt_say = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(paylasim_id)as C from retweet where paylasim_id='".$yaz['paylasim_id']."'"));
													 
														if($rtmi<1){
															?>
														<i class="fa fa-retweet  yuvarlak hover3 gri" aria-hidden="true" style="cursor: pointer;"></i>
														<div class="retweet_acilir">
															<a href="islemler.php?i=retweet&id=<?=$paylasim_id ?>" style="text-decoration: none;">
																<div class="retweet_acilir1 hover">
																	<span style="color: black">Retweet</span>
																</div>
															</a>
															<a href="arama.php?i=retweet&id=<?=$paylasim_id ?>" style="text-decoration: none;">
																<div class="retweet_acilir1 hover">
																	<span style="color: black">Yorumla birlikte retweet</span>
																</div>
															</a>
														</div>
														<?php 
															if($rt_say['C']>0)
																echo $rt_say['C'];
															}
														
														else{
															?>
														<a href="islemler.php?i=retweet_yapma&id=<?=$paylasim_id ?>" style="text-decoration: none;">
															<i class="fa fa-retweet  yuvarlak hover3 mavi" aria-hidden="true" style="cursor: pointer;"></i>
														</a>
														<?php 
																if($rt_say['C']>0)
																		echo $rt_say['C'];
																	}
																?>
														
													</div>
													<div class="paylasim_sag_uc_like">
														<?php

														// Daha önce bu kişi bu gönderiyi beğenmiş mi 

														$begenimi=mysqli_num_rows(mysqli_query($baglanti,"SELECT * from begeniler where 
															kisi_id='".$_SESSION['session_id']."' and gonderi_id='".$yaz['paylasim_id']."'"));
															$begeni_sayisi=mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(gonderi_id)as C from begeniler where gonderi_id='".$yaz['paylasim_id']."'"));
															if($begenimi<1){
																?>
																	<a href="islemler.php?i=gonderi_begen&t=<?= $paylasim_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 gri" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															else {
																?>
																	<a href="islemler.php?i=gonderi_begenme&t=<?= $paylasim_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 mavi" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															if($begeni_sayisi['C']>0){
																$begenen= mysqli_query($baglanti,"select * from begeniler 
																	where gonderi_id='".$yaz['paylasim_id']."' limit 3");
																while($begenenler = mysqli_fetch_assoc($begenen)){

																	$begenen_adi = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from uyeler 
																		where id='".$begenenler['kisi_id']."' "));

																	if($begeni_sayisi['C']<=3){
																		?>
																		<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black;" class="begeni_link">
																			<span style="font-size: 10px;"><?=$begenen_adi['isim'] ?></span>
																		</a>
																		<?php
																	}
																	else{
																		?>
																			<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black;" class="begeni_link">
																				<span style="font-size: 10px;"><?php echo $begenen_adi['isim'] ?></span>
																			</a>
																		<?php
																	}
																}
																if($begeni_sayisi['C']>3){
																	?>
																	<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black; font-size: 13px;">...+<?=($begeni_sayisi['C']-3)?></a>
																	<?php
																}

														}
														 ?>
														
											</div>
											<div class="paylasim_sag_uc_yorum">
												<a href="">
													<i class="fa fa-external-link yuvarlak hover3 gri" aria-hidden="true"></i>	
												</a>
															</div>
														</div>
													
													</div>
												</div>		
											<?php 
											}
										?>	
											
										</div>
										<?php
									}
									else if(@$_GET['i']=="begeni"){
										?>
										<div class="alt_sol_alt_header">
											<a href="profil.php?id=<?=$profil?>"><div class="alt_sol_alt_header1"><span>Tweetler</span></div></a>
											<a href="profil.php?i=yanıt&id=<?=$profil?>"><div class="alt_sol_alt_header1"><span>Tweetler ve yanıtlar</span></div></a>
											<a href=""><div class="alt_sol_alt_header1"><span>Medya</span></div></a>
											<a href="profil.php?i=begeni&id=<?=$profil?>"><div class="alt_sol_alt_header2"><span>Beğeni</span></div></a>
										</div>
										<div class="alt_sol_alt_gonderiler">
											<?php
									$profil = $_GET['id'];

									$begendiklerim = mysqli_query($baglanti, "Select * from begeniler where kisi_id='$profil' ");


									while($begendiklerim_id = mysqli_fetch_assoc($begendiklerim)) {
										$paylasim_id=$begendiklerim_id['gonderi_id'];

										$yaz =  mysqli_fetch_assoc(mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id and paylasim_id='$paylasim_id' order by P.tarih desc"));

										?>
										<a href="gonderi.php?id=<?= $paylasim_id?>" style="text-decoration: none;">
											<div class="paylasim hover">
												<div class="paylasim_sol">	
													<img src="img/profil.png" alt="">
												</div>
												<div class="paylasim_sag" style="overflow: hidden;">		
													<div class="paylasim_sag_bir">
														<div class="paylasim_sag_bir_sol">
															<div class="paylasim_sag_bir_bir">
																<span class="paylasim_sag_bir_bir_ad"><?php echo $yaz['isim']; ?></span> 
																<span class="paylasim_sag_bir_bir_kadi"><?php echo $yaz['kadi']; ?></span>
															</div>
															<div class="nokta"></div>
															<span class="paylasim_sag_bir_bir_time"><?php echo $yaz['tarih']; ?></span>
														</div>
										</a>	
										<?php 
										$benim_id=$_SESSION['session_id'];
										$kimin = mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim 
															where kisi_id='$benim_id' and paylasim_id='$paylasim_id' "));
										if($kimin>0){
											?>
											<a href="islemler.php?i=gonderi_sil&id=<?= $paylasim_id?>">
												<div class="paylasim_sag_bir_bir_icon yuvarlak hover3">
													<i class="fa fa-times-circle" aria-hidden="true"></i>
												</div>
											</a>
											<?php 
										}
										?>
											<a href="gonderi.php?id=<?= $paylasim_id?>" style="text-decoration: none;">	
												</div>

												<div class="paylasim_sag_iki">
													<span class="paylasim_sag_iki_span"><?php echo $yaz['icerik']; ?></span>
												</div>
												<?php 
													if(isset($yaz['retweet_id'])){

													if($yaz['retweet_id']==0)
														{
															?>
															<div class="div_retweet_yok">
																<div class="div_retweet_yok1">
																	<span>Bu Tweet kullanım dışı.</span>
																</div>
															</div>
															<?php
														}

													if($yaz['retweet_id']!=0)
													{
														$retweet_id=$yaz['retweet_id'];
														$retweet_bilgileri = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from paylasim P inner join uyeler U on U.id = P.kisi_id and  paylasim_id='$retweet_id'"));
													?>
													<div class="div_retweet">
														<div class="div_retweet_ust">
															<div class="div_retweet_ust1"><img src="img/profil.png" alt=""></div>
															<div class="div_retweet_ust2"><span><?=$retweet_bilgileri['isim']?></span></div>
															<div class="div_retweet_ust3"><span>@ <?=$retweet_bilgileri['kadi']?></span></div>
															<div class="nokta"></div>
															<div class="div_retweet_ust4"><span><?=$retweet_bilgileri['tarih']?></span></div>
														</div>
														<div class="div_retweet_alt">
															<span><?=$retweet_bilgileri['icerik']?></span>
														</div>
													</div>		
													<?php  	
													}
													}
												 ?>
												</a>

												<div class="paylasim_sag_uc">
													<?php 
														$yorum_say = mysqli_fetch_assoc(mysqli_query($baglanti, "select count(paylasim_id) as yorum_say from paylasim P inner join uyeler U on U.id = P.kisi_id where ust_id='$paylasim_id'"));

													 ?>
													<div class="paylasim_sag_uc_yorum">
														<a href="gonderi.php?i=yorum_yap&id=<?= $paylasim_id ?>" style="text-decoration: none;">
															<i class="fa fa-comment  yuvarlak hover3 gri" aria-hidden="true"></i>
														</a>
														<?php 
																if($yorum_say['yorum_say']>0)
																	echo $yorum_say['yorum_say'];
															 ?>
													</div>
													
													<div class="paylasim_sag_uc_retweet">
														<?php 
														$rtmi= mysqli_num_rows(mysqli_query($baglanti,"SELECT * from retweet where 
															kisi_id='".$_SESSION['session_id']."' and paylasim_id='".$yaz['paylasim_id']."'"));
														$rt_say = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(paylasim_id)as C from retweet where paylasim_id='".$yaz['paylasim_id']."'"));
													 
														if($rtmi<1){
															?>
														<i class="fa fa-retweet  yuvarlak hover3 gri" aria-hidden="true" style="cursor: pointer;"></i>
														<div class="retweet_acilir">
															<a href="islemler.php?i=retweet&id=<?=$paylasim_id ?>" style="text-decoration: none;">
																<div class="retweet_acilir1 hover">
																	<span style="color: black">Retweet</span>
																</div>
															</a>
															<a href="arama.php?i=retweet&id=<?=$paylasim_id ?>" style="text-decoration: none;">
																<div class="retweet_acilir1 hover">
																	<span style="color: black">Yorumla birlikte retweet</span>
																</div>
															</a>
														</div>
														<?php 
															if($rt_say['C']>0)
																echo $rt_say['C'];
															}
														
														else{
															?>
														<a href="islemler.php?i=retweet_yapma&id=<?=$paylasim_id ?>" style="text-decoration: none;">
															<i class="fa fa-retweet  yuvarlak hover3 mavi" aria-hidden="true" style="cursor: pointer;"></i>
														</a>
														<?php 
																if($rt_say['C']>0)
																		echo $rt_say['C'];
																	}
																?>
														
													</div>
													<div class="paylasim_sag_uc_like">
														<?php

														// Daha önce bu kişi bu gönderiyi beğenmiş mi 

														$begenimi=mysqli_num_rows(mysqli_query($baglanti,"SELECT * from begeniler where 
															kisi_id='".$_SESSION['session_id']."' and gonderi_id='".$yaz['paylasim_id']."'"));
															$begeni_sayisi=mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(gonderi_id)as C from begeniler where gonderi_id='".$yaz['paylasim_id']."'"));
															if($begenimi<1){
																?>
																	<a href="islemler.php?i=gonderi_begen&t=<?= $paylasim_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 gri" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															else {
																?>
																	<a href="islemler.php?i=gonderi_begenme&t=<?= $paylasim_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 mavi" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															if($begeni_sayisi['C']>0){
																$begenen= mysqli_query($baglanti,"select * from begeniler 
																	where gonderi_id='".$yaz['paylasim_id']."' limit 3");
																while($begenenler = mysqli_fetch_assoc($begenen)){

																	$begenen_adi = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from uyeler 
																		where id='".$begenenler['kisi_id']."' "));

																	if($begeni_sayisi['C']<=3){
																		?>
																		<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black;" class="begeni_link">
																			<span style="font-size: 10px;"><?=$begenen_adi['isim'] ?></span>
																		</a>
																		<?php
																	}
																	else{
																		?>
																			<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black;" class="begeni_link">
																				<span style="font-size: 10px;"><?php echo $begenen_adi['isim'] ?></span>
																			</a>
																		<?php
																	}
																}
																if($begeni_sayisi['C']>3){
																	?>
																	<a href="arama.php?i=begenenler&id=<?=$yaz['paylasim_id'] ?> " style="text-decoration: none; color: black; font-size: 13px;">...+<?=($begeni_sayisi['C']-3)?></a>
																	<?php
																}

														}
														 ?>
														
											</div>
											<div class="paylasim_sag_uc_yorum">
												<a href="">
													<i class="fa fa-external-link yuvarlak hover3 gri" aria-hidden="true"></i>	
												</a>
															</div>
														</div>
													
													</div>
												</div>		
											<?php 
											}
										?>	
										</div>
										<?php
									}
								?>
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
				
				<div class="gundemler">
					<div class="gundemler_ust">
						<div class="icgundemler"><p>İlgini çekebilecek gündemler</p></div>
						<div class="gundemler_icon yuvarlak"><i class="fa fa-cog" aria-hidden="true"></i></div>
					</div>
					<div class="gundemler_alt">
						<?php 

							$trendler= mysqli_query($baglanti,"SELECT gonderi_id,COUNT(*)as sayi FROM `begeniler` GROUP by gonderi_id ORDER by sayi DESC");

							$son=0;
							while ($trend_yaz = mysqli_fetch_assoc($trendler)) {
								if($son==3){
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
						<a href="gundemler.php">
							<div class="dfgoster hover">
							<span>Daha fazla göster</span>
						</div>
						</a>
					</div>
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