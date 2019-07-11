<?php 
	
	$benim_id = $_SESSION['session_id'];
	$kisiselbilgilerim = mysqli_fetch_assoc(mysqli_query($baglanti, "select * from uyeler where id='$benim_id' "));

	$teden_say = mysqli_fetch_assoc(mysqli_query($baglanti,"select count(*) as sayi from takipciler where tedilen_id='$benim_id' "));
	$tedilen_say = mysqli_fetch_assoc(mysqli_query($baglanti,"select count(*) as sayi from takipciler where teden_id='$benim_id' "));

 ?>

		<div class="ust">
			<div class="orta">
				<a href="anasayfa.php">
					<div class="anasayfa hover2">
						<div class="anasayfa_ic yuvarlak">
							<i class="fa fa-home" aria-hidden="true"></i>
						</div>
					</div>	
				</a>
				<a href="gundemler.php">
					<div class="gundemler_sayfa hover2">
						<div class="gundemler_sayfa_ic yuvarlak">
							<i class="fa fa-hashtag" aria-hidden="true"></i>
						</div>
					</div>
				</a>
				<a href="bildirimler.php">
					<div class="bildirimler hover2">
						<div class="bildirimler_ic yuvarlak">
							<i class="fa fa-bell-o" aria-hidden="true"></i>
						</div>
					</div>
				</a>
				<a href="">
					


				</a>
				<a href="mesajlar.php">
					<div class="mesajlar hover2">
						<div class="mesajlar_ic yuvarlak">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</div>
					</div>
				</a>

				<div class="arama">
					<div class="kutu">
						<form action="arama.php?i=arama" method="POST">
							<input type="image" value="" src="img/search.png" class="abuton"/>
							<input type="text" name="ara" class="akutu" placeholder="Twitter'da Ara" />
						</form>
					</div>
				</div>
				
				<div class="profil">
					<div class="menu">
						<div class="profil_ic yuvarlak hover">
							<img src="img/profil.png" alt="">
							<span><?= $kisiselbilgilerim['isim'] ?></span>
							<i class="fa fa-angle-down" aria-hidden="true"></i>
						</div>	
						<div class="hesapbilgileri  kapali" id="hesap">

			<div class="hesapbilgileri_ust borderb">
				
				<div class="hesapbilgileri_ust_ic">
					<div class="hesapbilgileri_ust_h2">
						<h2>Hesap bilgileri</h2>
					</div>
					<div class="hesapbilgileri_ust_icon yuvarlak hover">
						<i class="fa fa-times" aria-hidden="true"></i>
					</div>
				</div>
			</div>

			<div class="hesapbilgileri_alt">
				<a href="profil.php?id=<?=$benim_id?>" class="textdecoration">
					<div class="hesapbilgileri_alt_profil">
					<div class="hesapbilgileri_alt_profil1">
						<img src="img/profil.png" alt="">
					</div>
				</div>
				</a>				
				<a href="profil.php?id=<?=$benim_id?>" class="textdecoration">
					<div class="hesapbilgileri_alt_isim">
					<div class="hesapbilgileri_alt_isim1">
						<div class="hesapbilgileri_alt_isim11"><span><?=$kisiselbilgilerim['isim'] ?></span></div>
						<div class="hesapbilgileri_alt_isim12"><span><?=$kisiselbilgilerim['kadi'] ?></span></div>
					</div>
				</div>
				</a>
				<div class="hesapbilgileri_alt_takiptakipci">
					<div class="hesapbilgileri_alt_takiptakipci1">
						<div class="hesapbilgileri_alt_takiptakipci11"><a href="arama.php?i=t_edilen&id=<?=$benim_id?>" style="text-decoration: none"><b><?=$tedilen_say['sayi']?></b><span>Takip Ediliyor</span></a></div>
						<div class="hesapbilgileri_alt_takiptakipci11"><a href="arama.php?i=t_eden&id=<?=$benim_id?>" style="text-decoration: none;"><b><?=$teden_say['sayi']?></b><span>Takipçiler</span></a></div>
					</div>
				</div>
				<div class="hesapbilgileri_alt_proflist borderb">

					<a href="profil.php?id=<?=$benim_id?>" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-user" aria-hidden="true"></i><span>Profil</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-list-ul" aria-hidden="true"></i><span>Listeler</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-bookmark-o" aria-hidden="true"></i><span>Yer işaretleri</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrb">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-bolt" aria-hidden="true"></i><span>Anlar</span>
							</div>
						</div>
					</a>

				</div>
				<div class="reklamlar_istatistikler borderb">
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrt">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-life-ring" aria-hidden="true"></i><span>Tanıtma Modu</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrt">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-external-link-square" aria-hidden="true"></i><span>Twitter Reklamları</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrb">
							<div class="hesapbilgileri_alt_proflist11">
								<i class="fa fa-bar-chart" aria-hidden="true"></i><span>İstatistikler</span>
							</div>
						</div>
					</a>
				</div>
				<div class="yardimmerkezi_ayarlar borderb">
					<a href="ayarlar.php" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrt">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Ayarlar ve Gizlilik</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Yardım Merkezi</span>
							</div>
						</div>
					</a>
					<a href="cikis.php" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Çıkış yap</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Geri bildirim gönder</span>
							</div>
						</div>
					</a>
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrb">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Eski Twitter'a geç</span>
							</div>
						</div>
					</a>
				</div>


				<div class="hesapbilgileri_input">
					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrt">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Veri Tasarrufu</span>
							</div>
						</div>
					</a>

					<a href="" class="textdecoration">
						<div class="hesapbilgileri_alt_proflist1 hover mrb">
							<div class="hesapbilgileri_alt_proflist11">
								<span>Gece modu</span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
					</div>
				</div>
			</div>
		</div>
		