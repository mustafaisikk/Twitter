<?php

	session_start();
	include 'baglanti.php';
	$kisi_id=$_SESSION['session_id'];

	$islem="";
	if(isset($_GET['i']))
	{
		$islem=$_GET['i'];
	}

	if ($islem=='gonderi_paylas') {
		$tweet=$_POST['tweet'];
		mysqli_query($baglanti,"INSERT INTO paylasim (kisi_id,icerik,tarih) values ('".$_SESSION['session_id']."', '".$tweet."', now())");
		header("location:anasayfa.php");
	}

	else if($islem=='gonderi_begen'){
		mysqli_query($baglanti,"INSERT INTO begeniler (gonderi_id,kisi_id) values ('".$_GET['t']."','$kisi_id')");
		header("location:anasayfa.php");
	}
	else if($islem=='gonderi_begenme'){
		mysqli_query($baglanti,"DELETE from begeniler where kisi_id='$kisi_id' and gonderi_id='".$_GET['t']."'");
		header("location:anasayfa.php");
	}
	else if($islem=='yorum_yap'){
		$ust_id=$_GET['t'];
		$yorum = $_POST['yorum'];
		mysqli_query($baglanti,"INSERT INTO paylasim (kisi_id,icerik,tarih,ust_id) values ('".$_SESSION['session_id']."', '".$yorum."', now(),'".$ust_id."')");
		header("location:gonderi.php?i=&id=$ust_id");
	}
	else if($islem=='retweet'){
		$yorum_id=$_GET['id'];
		mysqli_query($baglanti,"INSERT INTO retweet (kisi_id,paylasim_id,tarih) values ('$kisi_id','$yorum_id',now())");
		header("location:anasayfa.php");
	}

	else if($islem=='yorum_ret'){
		$retweet_yorumu=$_POST['retweet'];
		$yorum_id=$_GET['id'];
		mysqli_query($baglanti,"INSERT INTO paylasim (kisi_id,icerik,tarih,retweet_id) values ('$kisi_id','$retweet_yorumu',now(),'$yorum_id')");
		header("location:anasayfa.php");
	}
	else if($islem=='retweet_yapma'){
		mysqli_query($baglanti,"DELETE from retweet where kisi_id='$kisi_id' and paylasim_id='".$_GET['id']."'");
		header("location:anasayfa.php");
	}
	else if ($islem=='gonderi_sil') {
		$gonderi_id=$_GET['id'];
		
		function gonderisil($gonderi_id){
			global $baglanti;
			$yorum_Say=mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim where ust_id='$gonderi_id' ")); 
			
			if($yorum_Say>0){
				$yorumlar = mysqli_query($baglanti,"select * from paylasim where ust_id='$gonderi_id' ");

				while($yorumlar1 = mysqli_fetch_assoc($yorumlar)){
					
					$yorum_Say1=mysqli_num_rows(mysqli_query($baglanti,"select * from paylasim where ust_id='$gonderi_id' "));
						if($yorum_Say1>0){
							gonderisil($yorumlar1['paylasim_id']);
						}
						
						mysqli_query($baglanti,"DELETE from paylasim where paylasim_id='".$yorumlar1['paylasim_id']."'");
						mysqli_query($baglanti,"DELETE from retweet where paylasim_id='".$yorumlar1['paylasim_id']."' ");
						mysqli_query($baglanti,"DELETE from begeniler where gonderi_id='".$yorumlar1['paylasim_id']."'");
				}
			}
		}
		gonderisil($gonderi_id);
		mysqli_query($baglanti,"DELETE from paylasim where paylasim_id='$gonderi_id'");
		mysqli_query($baglanti,"UPDATE paylasim SET retweet_id='0' WHERE retweet_id='$gonderi_id'  ");
		mysqli_query($baglanti,"DELETE from retweet where paylasim_id='$gonderi_id'");
		mysqli_query($baglanti,"DELETE from begeniler where gonderi_id='$gonderi_id'");
		header("location:anasayfa.php");
	}
	else if($islem=='takip_et'){
		$t_edilecek = $_GET['id'];
		mysqli_query($baglanti,"INSERT into takipciler (teden_id,tedilen_id) values ($kisi_id,$t_edilecek)");
		header("location:anasayfa.php");
	}
	else if($islem=="takip_sil"){
		$id = $_GET['id'];
		mysqli_query($baglanti,"DELETE from takipciler where teden_id='$kisi_id' and tedilen_id='$id' ");
		header("location:anasayfa.php");

	}
	else if($islem=='anket_yap'){
		$secim=$_GET['c'];
		$id= $_GET['id'];
		$sayi=mysqli_num_rows(mysqli_query($baglanti,"select * from anket_cevap where anket_id='$id' and katilan_id='$kisi_id'"));
		if($sayi>0){
			header("location:anasayfa.php");
		}
		else{
			mysqli_query($baglanti,"INSERT INTO anket_cevap (anket_id,katilan_id,katilan_cevap) values ('$id','$kisi_id','$secim')");	
			header("location:anasayfa.php");
		}

	}
	else if($islem=='anket_sil'){
		$id= $_GET['id'];

		mysqli_query($baglanti,"DELETE from anketler where anket_id='$id' and kisi_id='$kisi_id'");
		mysqli_query($baglanti,"DELETE from anket_cevap where anket_id='$id'");
		header("location:anasayfa.php");

	}
	else 
		echo "İŞlem YOK";

 ?>