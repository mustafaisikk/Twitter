<?php 
	
	session_start();
	include "baglanti.php";
		
	if(!isset($_SESSION['session_id']))
		header("location:login.php");
	
	if(!isset($_GET['i']))
		header("location:anasayfa.php");

	$islem=$_GET['i'];

	if($islem=="anket_k"){
		if(!isset($_POST['anket_sor'])){
			header("location:arama.php?i=anket");
		}

		else if($_POST['anket_sor']!=""){
			$id=$_SESSION['session_id'];
			$soru=$_POST['anket_sor'];
			$anket_1=$_POST['anket_sor_c1'];
			$anket_2=$_POST['anket_sor_c2'];
			$anket_3=$_POST['anket_sor_c3'];

			if($anket_1!="" || $anket_2!="" || $anket_1!="" )
			{
				if($anket_1!=$anket_2 && $anket_1!=$anket_3 && $anket_2!=$anket_3){
					mysqli_query($baglanti,"INSERT INTO anketler (kisi_id,soru,cevap_1,cevap_2,cevap_3,anket_tarih) values ('$id','$soru','$anket_1','$anket_2','$anket_3',now())");
					header("location:anasayfa.php");
				}	
				else{
					$hata="Lütfen Farklı cevaplar seçiniz";
				}
			}
			else {
				$hata= "en azından biri dolmalı";
			}
		}
			
		else
			$hata= "Soru boş bırakılmamalı.";

	}
	else if($islem=="arama"){
		if(!isset($_POST['ara']))
			header("location:anasayfa.php");
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Twitter</title>
	<link rel="stylesheet" href="css/acilir.css">	
	<link rel="stylesheet" href="css/arama.css">
	<link rel="stylesheet" href="css1/font-awesome.css">

</head>
<body>
	<div class="ana">
		<?php 
		include('acilir.php'); 

		$retweet_id=@$_GET['id'];
		$retweet_bilgileri = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from paylasim P inner join uyeler U on U.id = P.kisi_id and  paylasim_id='$retweet_id'"));

		?>

		<div class="alt">
		
			<div class="alt_sol">	
				<?php 
					
					$islem=$_GET['i'];

					if($islem == "retweet"){
						?>
							<div class="tweet_at">
								<div class="tweet_at_ic">
									<div class="tweet_at_ic_sol">
										<img src="img/profil.png" alt="">
									</div>
									<div class="tweet_at_ic_sag">
										<form action="islemler.php?i=yorum_ret&id=<?=$retweet_id?>" method="POST" >
											<div class="tweet_at_ic_sag_ust">
												<div class="tweet_at_ic_sag_ust_text">
													<textarea style="font-size: 19px;" maxlength="240" placeholder="Neler oluyor?" name="retweet"></textarea>
														<div class="gonderi">
														<div class="gonderi_ust">
															<div class="gonderi_ust1"><img src="img/profil.png" alt=""></div>
															<div class="gonderi_ust2"><span><?=$retweet_bilgileri['isim']?></span></div>
															<div class="gonderi_ust3"><span>@ <?=$retweet_bilgileri['kadi']?></span></div>
															<div class="nokta"></div>
															<div class="gonderi_ust4"><span><?=$retweet_bilgileri['tarih']?></span></div>
														</div>
														<div class="gonderi_alt">
															<span><?=$retweet_bilgileri['icerik']?></span>
														</div>
													</div>
												</div>
												
											</div>
											<div class="tweet_at_ic_sag_alt">
												<div class="tweet_at_ic_sag_alt_buton yuvarlak">
													<input type="submit" value="Retweet">
												</div>
											</div>	
										</form>

									</div>
								</div>
							</div>

						<?php
					}

					else if($islem == "anket" || $islem=="anket_k"){
						?>
							<div class="tweet_at">
								<div class="tweet_at_ic">
									<div class="tweet_at_ic_sol">
										<img src="img/profil.png" alt="">
									</div>
									<div class="tweet_at_ic_sag">
										<form action="arama.php?i=anket_k" method="POST" >
											<div class="tweet_at_ic_sag_ust">
												<div class="tweet_at_ic_sag_ust_text">
													<textarea style="font-size: 19px;" maxlength="240" placeholder="Bir soru sor?" name="anket_sor"></textarea>
														<div class="anket_gonderi">
															<div class="anket_gonderi_ic">
																<label >
																	<div class="anket_gonderi_ic1"><span class="anket_gonderi_ic1_span">Seçenek 1</span></div>
																<div class="anket_gonderi_ic1"><input type="text" class="secenek_say" name="anket_sor_c1"></div>
																</label>
															</div>
															<div class="anket_gonderi_ic">
																<label >
																	<div class="anket_gonderi_ic1"><span class="anket_gonderi_ic1_span">Seçenek 2</span></div>
																<div class="anket_gonderi_ic1"><input type="text" class="secenek_say" name="anket_sor_c2"></div>
																</label>
															</div>
															<div class="anket_gonderi_ic">
																<label >
																	<div class="anket_gonderi_ic1"><span class="anket_gonderi_ic1_span">Seçenek 3</span></div>
																<div class="anket_gonderi_ic1"><input type="text" class="secenek_say" name="anket_sor_c3"></div>
																</label>
															</div>
														</div>
												</div>
												
											</div>
											<div class="tweet_at_ic_sag_alt">
												<div class="tweet_at_ic_sag_alt_buton yuvarlak">
													<input type="submit" value="Soru Sor">
												</div>
											</div>	
										</form>
									<?php 
										if($islem=="anket_k"){
											echo @$hata;
										}
									?>
									</div>
									
								</div>
							</div>

						<?php
					}

					else if($islem=="begenenler"){
						?>
						<div class="icgundemler" style="border-bottom: 1px solid #e6ecf0; ">
							<p>BEĞENENLER</p>
						</div>
						<?php
						$begenen1= mysqli_query($baglanti,"select * from begeniler where gonderi_id='$retweet_id'");
						while($begenenler=mysqli_fetch_assoc($begenen1)){	
							$begenen_kisi=mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT * from uyeler where id='".$begenenler['kisi_id']."' "));
						?>
							<a href="profil.php?id=<?=$begenenler['kisi_id']?>">
								<div class="alt_sag_bir_iki">
									<div class="alt_sag_bir_iki_teden">
									</div>
									<div class="alt_sag_bir_iki_profil hover">
										<img src="img/profil.png" alt="">
										<div class="resim_sag" style="width: 600px;">
											<div class="resim_sag_bir">
												<div class="resim_sag_bir_bir"><span><?=$begenen_kisi['isim']?></span></div>
												<div class="span_alti"><span><?=$begenen_kisi['kadi']?></span></div>
											</div> 
											<?php 
											$benim_id=$_SESSION['session_id'];
												$begenimi=mysqli_num_rows(mysqli_query($baglanti,"select * from takipciler 
													where teden_id='$benim_id' and tedilen_id='".$begenenler['kisi_id']."' "));
												
												if($benim_id!=$begenenler['kisi_id']){
													if($begenimi<1){
														
													?>
														<a href="islemler.php?i=takip_et&id=<?=$begenenler['kisi_id']?>">
															<div class="resim_sag_buton">
																<button class="resim_sag_buton1">Takip et</button>
															</div>
														</a>
													<?php
												}
												else{
													?>
														<a href="islemler.php?i=takip_sil&id=<?=$begenenler['kisi_id']?>">
															<div class="resim_sag_buton">
																<button class="resim_sag_buton2">Takipten çık</button>
															</div>
														</a>
													<?php
												}
												}

											 ?>
										</div>
									</div>
								</div>
							</a> 

						<?php
						}
					}
					
					else if($islem=="arama"){

						if($_POST['ara']!=""){
								
								$aranacak = $_POST['ara'];

								$k_sonuc = mysqli_num_rows(mysqli_query($baglanti,"SELECT * FROM uyeler WHERE kadi like '%$aranacak%' "));
								$g_sonuc = mysqli_num_rows(mysqli_query($baglanti,"SELECT * FROM paylasim WHERE icerik like '%$aranacak%' "));

								if($g_sonuc>0){
									?>
										<div class="icgundemler" style="border-bottom: 1px solid #e6ecf0; ">
											<p>Gönderiler</p>
										</div>
									<?php		
										$gonderiler = mysqli_query($baglanti,"select * from paylasim P inner join uyeler U on U.id = P.kisi_id and p.icerik LIKE '%$aranacak%' order by P.tarih desc");

										while($yaz = mysqli_fetch_assoc($gonderiler)){
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
								}
								if($k_sonuc>0){
									?>
										<div class="icgundemler" style="border-bottom: 1px solid #e6ecf0; ">
											<p>Kişiler</p>
										</div>
									<?php
									$a_kisi= mysqli_query($baglanti,"SELECT * FROM uyeler WHERE kadi like '%$aranacak%' ");
									
									while($a_kisiler=mysqli_fetch_assoc($a_kisi)){	
									?>
										<a href="profil.php?id=<?=$a_kisiler['id']?>">
											<div class="alt_sag_bir_iki">
												<div class="alt_sag_bir_iki_teden">
												</div>
												<div class="alt_sag_bir_iki_profil hover">
													<img src="img/profil.png" alt="">
													<div class="resim_sag" style="width: 600px;">
														<div class="resim_sag_bir">
															<div class="resim_sag_bir_bir"><span><?=$a_kisiler['isim']?></span></div>
															<div class="span_alti"><span><?=$a_kisiler['kadi']?></span></div>
														</div> 
														<?php 
														$benim_id=$_SESSION['session_id'];
															$begenimi=mysqli_num_rows(mysqli_query($baglanti,"select * from takipciler 
																where teden_id='$benim_id' and tedilen_id='".$a_kisiler['id']."' "));
															
															if($benim_id!=$a_kisiler['id']){
																if($begenimi<1){
																	
																?>
																	<a href="islemler.php?i=takip_et&id=<?=$a_kisiler['id']?>">
																		<div class="resim_sag_buton">
																			<button class="resim_sag_buton1">Takip et</button>
																		</div>
																	</a>
																<?php
															}
															else{
																?>
																	<a href="islemler.php?i=takip_sil&id=<?=$a_kisiler['id']?>">
																		<div class="resim_sag_buton">
																			<button class="resim_sag_buton2">Takipten çık</button>
																		</div>
																	</a>
																<?php
															}
															}

														 ?>
													</div>
												</div>
											</div>
										</a> 

									<?php
									}



								}
								if(($g_sonuc+$k_sonuc)==0)
									{
										?>
											<div class="div" style="padding: 15px;"><span>Sonuç Bulunamadı</span></div>
										<?php
									}



							}
					
						else{
							?>
								<div class="div" style="padding: 15px;"><span>Lütfen Aranacak Bilgiyi Giriniz</span></div>
							<?php
							}
						
					}
					else if($islem=="kte_dhf"){
						?>
							<div class="icgundemler" style="border-bottom: 1px solid #e6ecf0; ">
								<p>Kimi Takip Etmeli</p>
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

							$result = array_diff($takip_takip_dizi, $benim_t_e);
							 foreach ($result as $key) {
							 	$bilgiler = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT * from uyeler where id='$key' "));
							 	?>
									<a href="profil.php?id=<?=$key?>">
										<div class="alt_sag_bir_iki">
											<div class="alt_sag_bir_iki_teden">
											</div>
											<div class="alt_sag_bir_iki_profil hover">
												<img src="img/profil.png" alt="">
												<div class="resim_sag" style="width: 550px;">
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
					}

					else if($islem=="t_edilen"){

						?>
										<div class="icgundemler" style="border-bottom: 1px solid #e6ecf0; ">
											<p>Takip Edilenler</p>
										</div>
									<?php

									$aranacak_id=$_GET['id'];


									$a_kisi= mysqli_query($baglanti,"SELECT * FROM takipciler WHERE teden_id='$aranacak_id'");
									
									while($a_kisiler1=mysqli_fetch_assoc($a_kisi)){	

										$a_kisiler = mysqli_fetch_assoc(mysqli_query($baglanti,"Select * from uyeler where id='".$a_kisiler1['tedilen_id']."' "));
									?>
										<a href="profil.php?id=<?=$a_kisiler['id']?>">
											<div class="alt_sag_bir_iki">
												<div class="alt_sag_bir_iki_teden">
												</div>
												<div class="alt_sag_bir_iki_profil hover">
													<img src="img/profil.png" alt="">
													<div class="resim_sag" style="width: 600px;">
														<div class="resim_sag_bir">
															<div class="resim_sag_bir_bir"><span><?=$a_kisiler['isim']?></span></div>
															<div class="span_alti"><span><?=$a_kisiler['kadi']?></span></div>
														</div> 
														<?php 
														$benim_id=$_SESSION['session_id'];
															$begenimi=mysqli_num_rows(mysqli_query($baglanti,"select * from takipciler 
																where teden_id='$benim_id' and tedilen_id='".$a_kisiler['id']."' "));
															
															if($benim_id!=$a_kisiler['id']){
																if($begenimi<1){
																	
																?>
																	<a href="islemler.php?i=takip_et&id=<?=$a_kisiler['id']?>">
																		<div class="resim_sag_buton">
																			<button class="resim_sag_buton1">Takip et</button>
																		</div>
																	</a>
																<?php
															}
															else{
																?>
																	<a href="islemler.php?i=takip_sil&id=<?=$a_kisiler['id']?>">
																		<div class="resim_sag_buton">
																			<button class="resim_sag_buton2">Takipten çık</button>
																		</div>
																	</a>
																<?php
															}
															}

														 ?>
													</div>
												</div>
											</div>
										</a> 

									<?php
									}


					}
					else if($islem=="t_eden"){

						?>
										<div class="icgundemler" style="border-bottom: 1px solid #e6ecf0; ">
											<p>Takip Edenler</p>
										</div>
									<?php

									$aranacak_id=$_GET['id'];
									
									$a_kisi= mysqli_query($baglanti,"SELECT * FROM takipciler WHERE tedilen_id='$aranacak_id' ");
									
									while($a_kisiler1=mysqli_fetch_assoc($a_kisi)){	

										$a_kisiler = mysqli_fetch_assoc(mysqli_query($baglanti,"Select * from uyeler where id='".$a_kisiler1['teden_id']."' "));
									?>
										<a href="profil.php?id=<?=$a_kisiler['id']?>">
											<div class="alt_sag_bir_iki">
												<div class="alt_sag_bir_iki_teden">
												</div>
												<div class="alt_sag_bir_iki_profil hover">
													<img src="img/profil.png" alt="">
													<div class="resim_sag" style="width: 600px;">
														<div class="resim_sag_bir">
															<div class="resim_sag_bir_bir"><span><?=$a_kisiler['isim']?></span></div>
															<div class="span_alti"><span><?=$a_kisiler['kadi']?></span></div>
														</div> 
														<?php 
														$benim_id=$_SESSION['session_id'];
															$begenimi=mysqli_num_rows(mysqli_query($baglanti,"select * from takipciler 
																where teden_id='$benim_id' and tedilen_id='".$a_kisiler['id']."' "));
															
															if($benim_id!=$a_kisiler['id']){
																if($begenimi<1){
																	
																?>
																	<a href="islemler.php?i=takip_et&id=<?=$a_kisiler['id']?>">
																		<div class="resim_sag_buton">
																			<button class="resim_sag_buton1">Takip et</button>
																		</div>
																	</a>
																<?php
															}
															else{
																?>
																	<a href="islemler.php?i=takip_sil&id=<?=$a_kisiler['id']?>">
																		<div class="resim_sag_buton">
																			<button class="resim_sag_buton2">Takipten çık</button>
																		</div>
																	</a>
																<?php
															}
															}

														 ?>
													</div>
												</div>
											</div>
										</a> 

									<?php
									}


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
