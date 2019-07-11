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
	<link rel="stylesheet" href="css/acilir.css">	
	<link rel="stylesheet" href="css/gonderi.css">
	<link rel="stylesheet" href="css1/font-awesome.css">

</head>
<body>
	<div class="ana">
		<?php include('acilir.php'); ?>

		<div class="alt">
		
			<div class="alt_sol">
				
				<?php 

				$paylasim_id=$_GET['id'];
				$yaz =mysqli_fetch_assoc( mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id  where paylasim_id='$paylasim_id' "));

				 ?>

				<div class="paylasim hover" style="cursor: pointer;">
						
						<div class="paylasim_sag">
							
							<div class="paylasim_sag_sag">
								
								<div class="paylasim_sol">	
									<img src="img/profil.png" alt="">
								</div>
									
								<div class="paylasim_sag_bir">
									<div class="paylasim_sag_bir_sol">

										<div class="paylasim_sag_bir_bir">
											<span class="paylasim_sag_bir_bir_ad"><?php echo $yaz['isim']; ?></span> 
										</div>

										<div class="paylasim_sag_bir_bir">
											<span class="paylasim_sag_bir_bir_kadi"><?php echo $yaz['kadi']; ?></span>
										</div>

									</div>
									
									<div class="paylasim_sag_bir_bir1">
										
										<?php 
											$ust_site = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from paylasim where paylasim_id='$paylasim_id' "));
											if($ust_site['ust_id']==0){
										?>
										<a href="anasayfa.php">
											<div class="paylasim_sag_bir_bir11 yuvarlak hover3">
												<i class="fa fa-hand-o-left" aria-hidden="true"></i>
											</div>
										</a>
							
										<?php 
										}

										else{
										?>
										<a href="gonderi.php?id=<?=$ust_site['ust_id']?> ">
											<div class="paylasim_sag_bir_bir11 yuvarlak hover3">
												<i class="fa fa-hand-o-left" aria-hidden="true"></i>
											</div>
										</a>
							
										<?php 
										}



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
									</div>

									<div class="div" style="clear: both;"></div>
								</div>
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

								<div class="paylasim_sag_dort">
									<span class="paylasim_sag_bir_bir_time"><?php echo $yaz['tarih']; ?></span>
									<div class="nokta"></div>
									<a href="" style="text-decoration: none; color: #1c94e0;">İnstagram</a>
								</div>

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
						
							$islem=@$_GET['i'];
							
							if($islem=="yorum_yap"){
							?>
							<div class="yorum_yap">
								
								<form action="islemler.php?i=yorum_yap&t=<?=$paylasim_id ?>" method="POST">
									<div class="yorum_yap_ic">
									<textarea maxlength="240" placeholder="Yanıtını Tweetle ?" name="yorum"></textarea>
								</div>

								<div class="yorum_yap_buton">
									<input type="submit" value="Yorum yap">
								</div>
								</form>
							</div>
								
							<?php
							}

							$yorum =mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id where ust_id='$paylasim_id' order by P.tarih desc");
							if($yorum_say['yorum_say']>0){
								while($yorumlar= mysqli_fetch_assoc($yorum)){
										$yorum_id=$yorumlar['paylasim_id'];
									?>
									
									<a href="gonderi.php?id=<?= $yorum_id?>" style="text-decoration: none;">
										<div class="yorum hover" style="display: flex;">
											<div class="paylasim_sol">	
												<img src="img/profil.png" alt="">
											</div>
											<div class="yorum_sag" style=" overflow: hidden;">
												<div class="yorum_sag_bir">
													<div class="yorum_sag_bir_sol">
														<div class="paylasim_sag_bir_bir">
															<span class="yorum_sag_bir_bir_ad"><?php echo $yorumlar['isim']; ?></span> 
																<span class="yorum_sag_bir_bir_kadi"><?php echo $yorumlar['kadi']; ?></span>
														</div>
															<div class="nokta"></div>
															<span class="yorum_sag_bir_bir_time"><?php echo $yorumlar['tarih']; ?></span>
														</div>
													<?php 
														$benim_id=$_SESSION['session_id'];
														$kimin = mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim 
															where kisi_id='$benim_id' and paylasim_id='$yorum_id' "));
														if($kimin>0){
														 ?>
														<a href="islemler.php?i=gonderi_sil&id=<?=$yorum_id?>">
															<div class="paylasim_sag_bir_bir_icon yuvarlak hover3">
																<i class="fa fa-times-circle" aria-hidden="true"></i>
															</div>
														</a>
														<?php 
														}
													 ?>
												</div>
												
												<div class="yorum_sag_iki">
													<span class="yorum_sag_iki_span"><?php echo $yorumlar['icerik']; ?></span>
												</div>
									</a>
									
												<div class="yorum_sag_uc">
													<?php 
														$yorum_say = mysqli_fetch_assoc(mysqli_query($baglanti, "select count(paylasim_id) as yorum_say from paylasim P inner join uyeler U on U.id = P.kisi_id where ust_id='$yorum_id'"));

													 ?>
													<div class="paylasim_sag_uc_yorum">
														<a href="gonderi.php?i=yorum_yap&id=<?= $yorum_id ?>" style="text-decoration: none;">
															<i class="fa fa-comment  yuvarlak hover3 gri" aria-hidden="true"></i>
														</a>
														<?php 
																if($yorum_say['yorum_say']>0)
																	echo $yorum_say['yorum_say'];
															 ?>
													</div>
													<div class="paylasim_sag_uc_retweet">
														<?php 
															$yor_rtmi= mysqli_num_rows(mysqli_query($baglanti,"SELECT * from retweet where 
																kisi_id='".$_SESSION['session_id']."' and paylasim_id='$yorum_id'"));
															$yor_rt_say = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(paylasim_id)as C from retweet where paylasim_id='$yorum_id'"));
														 
															if($yor_rtmi<1){
																?>
															<i class="fa fa-retweet  yuvarlak hover3 gri" aria-hidden="true" style="cursor: pointer;"></i>
															<div class="retweet_acilir">
																<a href="islemler.php?i=retweet&id=<?=$yorum_id ?>" style="text-decoration: none;">
																	<div class="retweet_acilir1 hover">
																		<span style="color: black">Retweet</span>
																	</div>
																</a>
																<a href="arama.php?i=retweet&id=<?=$yorum_id ?>" style="text-decoration: none;">
																	<div class="retweet_acilir1 hover">
																		<span style="color: black">Yorumla birlikte retweet</span>
																	</div>
																</a>
															</div>
															<?php 
																if($yor_rt_say['C']>0)
																	echo $yor_rt_say['C'];
																}
															
															else{
																?>
															<a href="islemler.php?i=retweet_yapma&id=<?=$yorum_id ?>" style="text-decoration: none;">
																<i class="fa fa-retweet  yuvarlak hover3 mavi" aria-hidden="true" style="cursor: pointer;"></i>
															</a>
															<?php 
															if($yor_rt_say['C']>0)
																	echo $yor_rt_say['C'];
																}
															?>
									
													</div>
													<div class="yorum_sag_uc_like">
														<?php

															$begenimi=mysqli_num_rows(mysqli_query($baglanti,"SELECT * from begeniler where 
															kisi_id='".$_SESSION['session_id']."' and gonderi_id='$yorum_id'"));
															
															$begeni_sayisi=mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(gonderi_id)as C from begeniler where gonderi_id='$yorum_id'"));
															if($begenimi<1){
																?>
																	<a href="islemler.php?i=gonderi_begen&t=<?=$yorum_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 gri" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															else {
																?>
																	<a href="islemler.php?i=gonderi_begenme&t=<?=$yorum_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 mavi" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															if($begeni_sayisi['C']>0){
																$begenen= mysqli_query($baglanti,"select * from begeniler 
																	where gonderi_id='$yorum_id' limit 3");
																
																while($begenenler = mysqli_fetch_assoc($begenen)){

																	$begenen_adi = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from uyeler 
																		where id='".$begenenler['kisi_id']."' "));

																	if($begeni_sayisi['C']<=3){
																		?>
																		<a href="arama.php?i=begenenler&id=<?=$yorum_id ?> " style="text-decoration: none; color: black;" class="begeni_link">
																			<span style="font-size: 10px;"><?=$begenen_adi['isim'] ?></span>
																		</a>
																		<?php
																	}
																	else{
																		?>
																			<a href="arama.php?i=begenenler&id=<?=$yorum_id ?> " style="text-decoration: none; color: black;" class="begeni_link">
																				<span style="font-size: 10px;"><?php echo $begenen_adi['isim'] ?></span>
																			</a>
																		<?php
																	}
																}
																if($begeni_sayisi['C']>3){
																	?>
																	<a href="arama.php?i=begenenler&id=<?=$yorum_id ?> " style="text-decoration: none; color: black; font-size: 13px;">...+<?=($begeni_sayisi['C']-3)?></a>
																	<?php
																}

															}
														?>
													</div>
													<div class="yorum_sag_uc_yorum">
														<a href="">
															<i class="fa fa-external-link yuvarlak hover3 gri" aria-hidden="true"></i>	
														</a>
													</div>
												</div>
											
											</div>
										</div>		

									 
										<?php

										$yanıt=mysqli_query($baglanti, "select * from paylasim P inner join uyeler U on U.id = P.kisi_id and ust_id='$yorum_id' order by P.tarih desc");
										
										$yanıt_say =mysqli_fetch_assoc(mysqli_query($baglanti, "select count(paylasim_id) as yanıt_say from paylasim P inner join uyeler U on U.id = P.kisi_id and paylasim_id='$yorum_id'"));

										if($yanıt_say['yanıt_say']>0){
											
											while($yanıtlar= mysqli_fetch_assoc($yanıt)){
												$yanıt_id = $yanıtlar['paylasim_id'];
												?>
									<a href="gonderi.php?id=<?= $yanıt_id ?>" style="text-decoration: none;">
										<div class="yorum hover" style="display: flex; width: 540px; margin-left: 40px;">
											<div class="paylasim_sol">	
												<img src="img/profil.png" alt="">
											</div>
											<div class="yorum_sag" style="width: 480px; overflow: hidden;">
												<div class="yorum_sag_bir" style="width: 480px;">
													<div class="yorum_sag_bir_sol">
														<div class="paylasim_sag_bir_bir">
															<span class="yorum_sag_bir_bir_ad"><?php echo $yanıtlar['isim']; ?></span> 
																<span class="yorum_sag_bir_bir_kadi"><?php echo $yanıtlar['kadi']; ?></span>
														</div>
															<div class="nokta"></div>
															<span class="yorum_sag_bir_bir_time"><?php echo $yanıtlar['tarih']; ?></span>
														</div>
													<?php 
														$benim_id=$_SESSION['session_id'];
														$kimin = mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim 
															where kisi_id='$benim_id' and paylasim_id='$yanıt_id' "));
														if($kimin>0){
														 ?>
														<a href="islemler.php?i=gonderi_sil&id=<?= $yanıt_id?>">
															<div class="paylasim_sag_bir_bir_icon yuvarlak hover3">
																<i class="fa fa-times-circle" aria-hidden="true"></i>
															</div>
														</a>
														<?php 
														}
													 ?>
												</div>
												
												<div class="yorum_sag_iki">
													<span class="yorum_sag_iki_span"><?php echo $yanıtlar['icerik']; ?></span>
												</div>
									</a>

												<div class="yorum_sag_uc">
													<?php 
														$yorum_say = mysqli_fetch_assoc(mysqli_query($baglanti, "select count(paylasim_id) as yorum_say from paylasim P inner join uyeler U on U.id = P.kisi_id where ust_id='$yanıt_id'"));

													 ?>
													<div class="paylasim_sag_uc_yorum">
														<a href="gonderi.php?i=yorum_yap&id=<?= $yanıt_id ?>" style="text-decoration: none;">
															<i class="fa fa-comment  yuvarlak hover3 gri" aria-hidden="true"></i>
														</a>
														<?php 
																if($yorum_say['yorum_say']>0)
																	echo $yorum_say['yorum_say'];
															 ?>
													</div>
													
													<div class="paylasim_sag_uc_retweet">
														<?php 
															$yan_rtmi= mysqli_num_rows(mysqli_query($baglanti,"SELECT * from retweet where 
																kisi_id='".$_SESSION['session_id']."' and paylasim_id='$yanıt_id'"));
															$yan_rt_say = mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(paylasim_id)as C from retweet where paylasim_id='$yanıt_id'"));
														 
															if($yan_rtmi<1){
																?>
															<i class="fa fa-retweet  yuvarlak hover3 gri" aria-hidden="true" style="cursor: pointer;"></i>
															<div class="retweet_acilir">
																<a href="islemler.php?i=retweet&id=<?=$yanıt_id ?>" style="text-decoration: none;">
																	<div class="retweet_acilir1 hover">
																		<span style="color: black">Retweet</span>
																	</div>
																</a>
																<a href="arama.php?i=retweet&id=<?=$yanıt_id ?>" style="text-decoration: none;">
																	<div class="retweet_acilir1 hover">
																		<span style="color: black">Yorumla birlikte retweet</span>
																	</div>
																</a>
															</div>
															<?php 
																if($yan_rt_say['C']>0)
																	echo $yan_rt_say['C'];
																}
															
															else{
																?>
															<a href="islemler.php?i=retweet_yapma&id=<?=$yanıt_id ?>" style="text-decoration: none;">
																<i class="fa fa-retweet  yuvarlak hover3 mavi" aria-hidden="true" style="cursor: pointer;"></i>
															</a>
															<?php 
															if($yan_rt_say['C']>0)
																	echo $yan_rt_say['C'];
																}
															?>
													</div>
												
													<div class="yorum_sag_uc_like">
														<?php

															$begenimi=mysqli_num_rows(mysqli_query($baglanti,"SELECT * from begeniler where 
															kisi_id='".$_SESSION['session_id']."' and gonderi_id='$yanıt_id'"));
															
															$begeni_sayisi=mysqli_fetch_assoc(mysqli_query($baglanti,"SELECT COUNT(gonderi_id)as C from begeniler where gonderi_id='$yanıt_id'"));
															if($begenimi<1){
																?>
																	<a href="islemler.php?i=gonderi_begen&t=<?=$yanıt_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 gri" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															else {
																?>
																	<a href="islemler.php?i=gonderi_begenme&t=<?=$yanıt_id ?>" style="text-decoration: none;">
																		<i class="fa fa-heart  yuvarlak hover3 mavi" aria-hidden="true"></i>
																	</a>
																	<?php 
															}
															if($begeni_sayisi['C']>0){
																$begenen= mysqli_query($baglanti,"select * from begeniler 
																	where gonderi_id='$yanıt_id' limit 3");
																
																while($begenenler = mysqli_fetch_assoc($begenen)){

																	$begenen_adi = mysqli_fetch_assoc(mysqli_query($baglanti,"select * from uyeler 
																		where id='".$begenenler['kisi_id']."' "));

																	if($begeni_sayisi['C']<=3){
																		?>
																		<a href="arama.php?i=begenenler&id=<?=$yanıt_id ?> " style="text-decoration: none; color: black;" class="begeni_link">
																			<span style="font-size: 10px;"><?=$begenen_adi['isim'] ?></span>
																		</a>
																		<?php
																	}
																	else{
																		?>
																			<a href="arama.php?i=begenenler&id=<?=$yanıt_id ?> " style="text-decoration: none; color: black;" class="begeni_link">
																				<span style="font-size: 10px;"><?php echo $begenen_adi['isim'] ?></span>
																			</a>
																		<?php
																	}
																}
																if($begeni_sayisi['C']>3){
																	?>
																	<a href="arama.php?i=begenenler&id=<?=$yanıt_id ?> " style="text-decoration: none; color: black; font-size: 13px;">...+<?=($begeni_sayisi['C']-3)?></a>
																	<?php
																}

															}
														?>
													</div>
													<div class="yorum_sag_uc_yorum">
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
												
				
										

									}

								}

							 ?>

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
