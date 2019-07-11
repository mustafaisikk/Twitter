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
	<link rel="stylesheet" href="css/anasayfa.css">
	<link rel="stylesheet" href="css1/font-awesome.css">

</head>
<body>
	<div class="ana">
		<?php include('acilir.php'); ?>

		<div class="alt">
		
			<div class="alt_sol">	
				<div class="alt_sol_ic">
					<div class="alt_sol_anasayfa">
						<h2>Anasayfa</h2>
					</div>
					<div class="alt_sol_icon ">
						<i class="fa fa-yelp yuvarlak hover3" aria-hidden="true"></i>
					</div>
				</div>
				<div class="tweet_at">
					<div class="tweet_at_ic">
						<div class="tweet_at_ic_sol">
							<img src="img/profil.png" alt="">
						</div>
						<div class="tweet_at_ic_sag">
							<form action="islemler.php?i=gonderi_paylas&ust=0" method="POST" >
								<div class="tweet_at_ic_sag_ust">
									<div class="tweet_at_ic_sag_ust_text">
										<textarea style="font-size: 19px;" maxlength="240" placeholder="Neler oluyor?" name="tweet"></textarea>
									</div>
								</div>
								<div class="tweet_at_ic_sag_alt">
									<div class="tweet_at_ic_sag_alt_icon">
										<div class="tweet_at_ic_sag_alt_1 yuvarlak hover3">
											<i class="fa fa-picture-o" aria-hidden="true"></i>
										</div>
										<div class="tweet_at_ic_sag_alt_1 yuvarlak hover3">
											<i class="fa fa-picture-o" aria-hidden="true"></i>
										</div>
										<a href="arama.php?i=anket">
											<div class="tweet_at_ic_sag_alt_1 yuvarlak hover3">
											<i class="fa fa-align-left" aria-hidden="true"></i>
										</div>
										</a>
									</div>
									<div class="tweet_at_ic_sag_alt_buton yuvarlak">
										<input type="submit" value="Tweetle">
									</div>
								</div>	
							</form>
						</div>
					</div>
				</div>
	 			
				<?php
					$gonderiler = mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id and ust_id=0 order by P.tarih desc");

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
		
			<div class="alt_sag">
					
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
				<?php 
					$anketler = mysqli_query($baglanti,"SELECT * FROM anketler as A INNER join uyeler as U on A.kisi_id = U.id ");

					while($anketler_bilgi = mysqli_fetch_assoc($anketler) ){

						$benim_id=$_SESSION['session_id'];
						
						
						$c1_say= mysqli_num_rows(mysqli_query($baglanti,"select * from anket_cevap where anket_id='".$anketler_bilgi['anket_id']."' and katilan_cevap='".$anketler_bilgi['cevap_1']."' "));
						$c2_say= mysqli_num_rows(mysqli_query($baglanti,"select * from anket_cevap where anket_id='".$anketler_bilgi['anket_id']."' and katilan_cevap='".$anketler_bilgi['cevap_2']."' "));
						$c3_say= mysqli_num_rows(mysqli_query($baglanti,"select * from anket_cevap where anket_id='".$anketler_bilgi['anket_id']."' and katilan_cevap='".$anketler_bilgi['cevap_3']."' "));
						$toplam_oy = $c1_say+$c2_say+$c3_say;
						if($toplam_oy==0)
							$oran=0;
						else 
							$oran = 100/$toplam_oy;



						?>
							<div class="anketler">
								<div class="anketler_sol">
									<img src="img/profil.png" alt="">
								</div>
								<div class="anketler_sag">
									<div class="anketler_sag1" style="width: 268px;">
										<div class="anketler_sag11" style="float: left;">
											<div class="anketler_sag111"><span style="font-size: 15px; color:#14171A; font-weight: bold;"><?=$anketler_bilgi['isim']?></span></div>
											<div class="anketler_sag111"><span style="font-size: 15px; color: #657786;">@<?=$anketler_bilgi['kadi']?></span></div>
										</div>
										<div class="anketler_sag112" style="float: right;">
											<?php 
												if($benim_id==$anketler_bilgi['kisi_id']){
													?>
													<a href="islemler.php?i=anket_sil&id=<?=$anketler_bilgi['anket_id']?>" >
														<div class="anketler_sag1121">
															<i class="fa fa-times-circle" aria-hidden="true" style="float: right; color: black"></i>
														</div>
													</a>
													<?php
												}
											?>
											<div style="clear: both;"></div>
											<div class="anketler_sag1122"><span style="font-size: 10px;"><?=$anketler_bilgi['anket_tarih']?></span></div></div>
										<div style="clear: both;"></div>
									</div>
									<div class="anketler_sag2" style=" margin-top: 10px;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['soru']?></span></div>
									<?php 
									$katildim_mi=mysqli_num_rows(mysqli_query($baglanti,"Select * from anket_cevap where anket_id='".$anketler_bilgi['anket_id']."' and katilan_id='$benim_id' "));

										if($benim_id==$anketler_bilgi['kisi_id'] || $katildim_mi>0){

											$secimim=mysqli_fetch_assoc(mysqli_query($baglanti,"select * from anket_cevap where anket_id='".$anketler_bilgi['anket_id']."' and katilan_id=$benim_id"));
											?>
												<div class="anketler_sag3" style=" margin-top: 10px;">
													<?php 
														if($anketler_bilgi['cevap_1']!=""){

															if($secimim['katilan_cevap'] == $anketler_bilgi['cevap_1']){
																?>
																<div class="anketler_sag31 yuvarlak" style="padding: 5px; background-color: #CCD6DD ">
																	<div class="anketler_sag311 " style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_1']?></span></div>
																	<div class="anketler_sag312" style="float: right;"><span><?=($toplam_oy==0 ? 0 : round(($c1_say*$oran),2) ) ?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
																<?php
															}
															else{
																?>
																<div class="anketler_sag31 yuvarlak" style="padding: 5px;">
																	<div class="anketler_sag311 " style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_1']?></span></div>
																	<div class="anketler_sag312" style="float: right;"><span><?=($toplam_oy==0 ? 0 : round(($c1_say*$oran),2) ) ?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
																<?php
															}
														}
													?>
													<?php 
														if($anketler_bilgi['cevap_2']!=""){
															if($secimim['katilan_cevap']==$anketler_bilgi['cevap_2']){
																?>
																<div class="anketler_sag31 yuvarlak" style="padding: 5px;background-color: #CCD6DD;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_2']?></span></div>
																	<div class="anketler_sag312" style="float: right;"><span><?=($toplam_oy==0 ? 0 : round(($c2_say*$oran),2) ) ?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
																<?php
															}
															else{
																?>
																<div class="anketler_sag31 yuvarlak" style="padding: 5px;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_2']?></span></div>
																	<div class="anketler_sag312" style="float: right;"><span><?=($toplam_oy==0 ? 0 : round(($c2_say*$oran),2) ) ?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
																<?php
															}
														}
													?>
													<?php 
														if($anketler_bilgi['cevap_3']!=""){
															if($secimim['katilan_cevap']==$anketler_bilgi['cevap_3']){
																?>
																<div class="anketler_sag31  yuvarlak" style="padding: 5px;background-color: #CCD6DD;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_3']?></span></div>
																	<div class="anketler_sag312" style="float: right;"><span><?=($toplam_oy==0 ? 0 : round(($c3_say*$oran),2)) ?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
																<?php
															}
															else{
																?>
																<div class="anketler_sag31  yuvarlak" style="padding: 5px;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_3']?></span></div>
																	<div class="anketler_sag312" style="float: right;"><span><?=($toplam_oy==0 ? 0 : round(($c3_say*$oran),2)) ?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
																<?php
															}
														}
													 ?>
													 <div class="anketler_sag4" style=" margin-top: 10px;"><span style="font-size: 15px; color:#657786;"><?=$toplam_oy?> OY</span></div>
												</div>
											<?php
										}
										else{
											?>
												<div class="anketler_sag3" style=" margin-top: 10px;">
													<?php 
														if($anketler_bilgi['cevap_1']!=""){
															?>
															<a href="islemler.php?i=anket_yap&c=<?=$anketler_bilgi['cevap_1']?>&id=<?=$anketler_bilgi['anket_id']?>">
																<div class="anketler_sag31 yuvarlak hover3" style="padding: 5px;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_1']?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
															</a>
															<?php
														}
													?>
													<?php 
														if($anketler_bilgi['cevap_2']!=""){
															?>
															<a href="islemler.php?i=anket_yap&c=<?=$anketler_bilgi['cevap_2']?>&id=<?=$anketler_bilgi['anket_id']?>">
																<div class="anketler_sag31 hover3 yuvarlak " style="padding: 5px;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_2']?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
															</a>
															<?php
														}
													?>
													<?php 
														if($anketler_bilgi['cevap_3']!=""){
															?>
															<a href="islemler.php?i=anket_yap&c=<?=$anketler_bilgi['cevap_3']?>&id=<?=$anketler_bilgi['anket_id']?>">
																<div class="anketler_sag3 hover3 yuvarlak " style="padding: 5px;">
																	<div class="anketler_sag311" style="float: left;"><span style="font-size: 15px; color:#14171A;"><?=$anketler_bilgi['cevap_3']?></span></div>
																	<div class="divv" style="clear: both;"></div>
																</div>
															</a>
															<?php
														}
													 ?>
												</div>
											<?php
										}
									?>
									
								</div>
							</div>
						<?php
					}
				?>
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
							<span class="daha_fazla_span">Daha fazla<i class="fas fa-chevron-down"></i>
								<div class="acilir">
									<div class="acilir1 hover3"><span>Hakkında</span></div>
									<div class="acilir1 hover3"><span>Durum</span></div>
									<div class="acilir1 hover3"><span>İşletmeler</span></div>
									<div class="acilir1 hover3"><span>Geliştiriciler</span></div>
								</div>
							</span>
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
