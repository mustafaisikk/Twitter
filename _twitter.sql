-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 May 2019, 10:17:15
-- Sunucu sürümü: 10.1.36-MariaDB
-- PHP Sürümü: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `twitter`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anketler`
--

CREATE TABLE `anketler` (
  `anket_id` int(11) NOT NULL,
  `kisi_id` int(11) NOT NULL,
  `soru` varchar(280) NOT NULL,
  `cevap_1` varchar(50) NOT NULL,
  `cevap_2` varchar(50) NOT NULL,
  `cevap_3` varchar(50) NOT NULL,
  `anket_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `anketler`
--

INSERT INTO `anketler` (`anket_id`, `kisi_id`, `soru`, `cevap_1`, `cevap_2`, `cevap_3`, `anket_tarih`) VALUES
(1, 1, 'En beğendiğiniz programlama dili nedir?', 'Python', 'Java', 'C', '2019-05-07 15:04:19'),
(2, 2, 'Sitemi Beğendiniz Mi?', 'Evet', 'Hayır', '', '2019-05-07 15:04:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket_cevap`
--

CREATE TABLE `anket_cevap` (
  `anket_cevap_id` int(11) NOT NULL,
  `anket_id` int(11) NOT NULL,
  `katilan_id` int(11) NOT NULL,
  `katilan_cevap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `anket_cevap`
--

INSERT INTO `anket_cevap` (`anket_cevap_id`, `anket_id`, `katilan_id`, `katilan_cevap`) VALUES
(1, 2, 3, 'Evet'),
(2, 2, 4, 'Hayır'),
(3, 1, 3, 'Java'),
(4, 2, 1, 'Evet'),
(5, 1, 6, 'Python'),
(6, 2, 6, 'Evet'),
(15, 1, 5, 'C'),
(16, 2, 5, 'Evet'),
(17, 2, 7, 'Evet'),
(18, 1, 7, 'C');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begeniler`
--

CREATE TABLE `begeniler` (
  `begeni_id` int(11) NOT NULL,
  `gonderi_id` int(11) NOT NULL,
  `kisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `begeniler`
--

INSERT INTO `begeniler` (`begeni_id`, `gonderi_id`, `kisi_id`) VALUES
(126, 145, 2),
(127, 161, 2),
(128, 162, 2),
(129, 150, 2),
(134, 174, 3),
(135, 173, 3),
(136, 174, 5),
(137, 174, 1),
(139, 150, 6),
(140, 174, 6),
(141, 170, 6),
(142, 150, 1),
(143, 157, 1),
(144, 144, 1),
(145, 150, 3),
(147, 161, 5),
(148, 161, 7),
(149, 178, 7),
(151, 150, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paylasim`
--

CREATE TABLE `paylasim` (
  `paylasim_id` int(11) NOT NULL,
  `kisi_id` int(11) NOT NULL,
  `icerik` varchar(280) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ust_id` int(11) DEFAULT '0',
  `retweet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `paylasim`
--

INSERT INTO `paylasim` (`paylasim_id`, `kisi_id`, `icerik`, `tarih`, `ust_id`, `retweet_id`) VALUES
(144, 1, 'qweqwe', '2019-05-04 22:52:38', 0, NULL),
(145, 1, 'dasdd', '2019-05-04 22:52:41', 0, 0),
(150, 2, 'rytrrty', '2019-05-04 22:54:42', 0, NULL),
(157, 1, 'weqwe', '2019-05-05 21:45:15', 144, NULL),
(158, 1, 'qweqwe', '2019-05-05 21:46:03', 157, NULL),
(161, 5, 'qweqwe', '2019-05-06 10:28:04', 0, NULL),
(162, 5, 'qweqwewqe', '2019-05-06 10:28:13', 0, NULL),
(166, 2, 'deneme', '2019-05-06 10:41:17', 0, NULL),
(167, 2, 'dewdewd', '2019-05-06 10:41:41', 150, NULL),
(168, 2, 'wedwed', '2019-05-06 10:41:45', 150, NULL),
(169, 2, 'dwedwed', '2019-05-06 10:41:50', 150, NULL),
(170, 2, 'wdqdqdqwd', '2019-05-06 10:42:38', 169, NULL),
(171, 2, 'qweweeq', '2019-05-06 10:45:02', 170, NULL),
(172, 2, 'meraaawd', '2019-05-06 11:33:41', 150, NULL),
(173, 2, 'weqwee', '2019-05-06 11:33:59', 150, NULL),
(174, 2, 'qweqwqwe', '2019-05-06 11:34:05', 173, NULL),
(175, 3, 'qwew', '2019-05-06 14:15:39', 0, NULL),
(176, 3, 'qweqw', '2019-05-06 14:15:53', 175, NULL),
(178, 7, 'böle tweet mi olur', '2019-05-09 08:29:40', 144, NULL),
(185, 5, 'qweqwe', '2019-05-09 09:48:23', 175, NULL),
(186, 5, 'gfhf', '2019-05-10 06:20:49', 175, NULL),
(187, 5, 'jgjh\r\n', '2019-05-10 06:20:55', 186, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `retweet`
--

CREATE TABLE `retweet` (
  `retweet_id` int(11) NOT NULL,
  `kisi_id` int(11) NOT NULL,
  `paylasim_id` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `retweet`
--

INSERT INTO `retweet` (`retweet_id`, `kisi_id`, `paylasim_id`, `tarih`) VALUES
(1, 3, 175, '2019-05-06 14:15:48'),
(2, 3, 166, '2019-05-06 14:37:51'),
(3, 7, 144, '2019-05-09 08:26:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `takipciler`
--

CREATE TABLE `takipciler` (
  `takip_id` int(11) NOT NULL,
  `teden_id` int(11) NOT NULL,
  `tedilen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `takipciler`
--

INSERT INTO `takipciler` (`takip_id`, `teden_id`, `tedilen_id`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 1, 2),
(4, 2, 4),
(5, 2, 3),
(6, 2, 6),
(7, 2, 5),
(8, 6, 2),
(9, 1, 4),
(10, 3, 1),
(11, 3, 2),
(16, 5, 1),
(18, 5, 4),
(19, 5, 6),
(20, 5, 3),
(21, 7, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `kadi` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL,
  `isim` varchar(50) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `resim` varchar(50) DEFAULT 'default.png',
  `eposta` varchar(50) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kadi`, `sifre`, `isim`, `telefon`, `resim`, `eposta`, `tarih`) VALUES
(1, 'Mustafaisik', 'c4ca4238a0b923820dcc509a6f75849b', 'Mustafa IŞIK', '', 'default.png', 'mustafaisikk16@hotmail.com', '2019-05-06 13:13:16'),
(2, 'OrcunTuna', 'c4ca4238a0b923820dcc509a6f75849b', 'Orçun Tuna', '', 'default.png', 'orcuntuna@hotmail.com', '2019-05-06 13:13:16'),
(3, 'enderimen', 'c4ca4238a0b923820dcc509a6f75849b', 'Ender IMEN', '', 'default.png', 'enderimen@hotmail.com', '2019-05-06 13:13:16'),
(4, 'Reburn', 'c4ca4238a0b923820dcc509a6f75849b', 'Oğuz', '', 'default.png', 'dewdwe@weqe.com', '2019-05-06 13:13:16'),
(5, 'a', '202cb962ac59075b964b07152d234b70', 'Denemedir', '02243604601', 'default.png', 'kaitrihin98@gmail.com', '2019-05-06 13:13:16'),
(6, 'yavuzmetinkoc', 'c4ca4238a0b923820dcc509a6f75849b', 'Yavuz Metin KOÇ', '', 'default.png', 'yavuzmetinkoc@gmail.com', '2019-05-06 13:13:16'),
(7, 'eliff', 'c4ca4238a0b923820dcc509a6f75849b', 'elif', '', 'default.png', 'elif@hhkhkh', '2019-05-09 08:22:32'),
(8, 'qweqw', '202cb962ac59075b964b07152d234b70', 'Semih Öksüzoğlu', '05376157076', 'default.png', 'semihoksuzoglu@hotmail.com', '2019-05-09 20:07:36');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anketler`
--
ALTER TABLE `anketler`
  ADD PRIMARY KEY (`anket_id`);

--
-- Tablo için indeksler `anket_cevap`
--
ALTER TABLE `anket_cevap`
  ADD PRIMARY KEY (`anket_cevap_id`);

--
-- Tablo için indeksler `begeniler`
--
ALTER TABLE `begeniler`
  ADD PRIMARY KEY (`begeni_id`);

--
-- Tablo için indeksler `paylasim`
--
ALTER TABLE `paylasim`
  ADD PRIMARY KEY (`paylasim_id`);

--
-- Tablo için indeksler `retweet`
--
ALTER TABLE `retweet`
  ADD PRIMARY KEY (`retweet_id`);

--
-- Tablo için indeksler `takipciler`
--
ALTER TABLE `takipciler`
  ADD PRIMARY KEY (`takip_id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anketler`
--
ALTER TABLE `anketler`
  MODIFY `anket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `anket_cevap`
--
ALTER TABLE `anket_cevap`
  MODIFY `anket_cevap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `begeniler`
--
ALTER TABLE `begeniler`
  MODIFY `begeni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- Tablo için AUTO_INCREMENT değeri `paylasim`
--
ALTER TABLE `paylasim`
  MODIFY `paylasim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Tablo için AUTO_INCREMENT değeri `retweet`
--
ALTER TABLE `retweet`
  MODIFY `retweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `takipciler`
--
ALTER TABLE `takipciler`
  MODIFY `takip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
