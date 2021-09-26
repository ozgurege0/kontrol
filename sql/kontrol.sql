-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 Eyl 2021, 19:24:55
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kontrol`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `ayarlar_id` int(11) NOT NULL DEFAULT 0,
  `ayarlar_title` varchar(2500) NOT NULL,
  `ayarlar_input` varchar(2500) NOT NULL,
  `ayarlar_btn` varchar(2500) NOT NULL,
  `ayarlar_yazi` varchar(2500) NOT NULL,
  `ayarlar_ornkod` varchar(2500) NOT NULL,
  `ayarlar_footer` varchar(2500) NOT NULL,
  `ayarlar_karakter` varchar(2500) NOT NULL,
  `ayarlar_firma` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`ayarlar_id`, `ayarlar_title`, `ayarlar_input`, `ayarlar_btn`, `ayarlar_yazi`, `ayarlar_ornkod`, `ayarlar_footer`, `ayarlar_karakter`, `ayarlar_firma`) VALUES
(0, 'Ürün Sorgula', 'Ürün Anahtarınız...', 'SORGULA', 'Örnek lisans kodu:', 'YNOS-DNDB-HBDR-SMNM', '2021 | Özgür Medya Ürün Kontrol Scripti', '19', 'Özgür Medya');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_ad` varchar(2500) NOT NULL,
  `contact_mail` varchar(2500) NOT NULL,
  `contact_mesaj` varchar(5000) NOT NULL,
  `contact_tarih` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `how`
--

CREATE TABLE `how` (
  `how_id` int(11) NOT NULL DEFAULT 0,
  `how_baslik` varchar(2500) NOT NULL,
  `how_yazi` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `how`
--

INSERT INTO `how` (`how_id`, `how_baslik`, `how_yazi`) VALUES
(0, 'Nasıl Kullanılır?', '&lt;b&gt;Anasayfa&#039;daki &lt;/b&gt;ilgili yere size verilen ürün kodunu giriniz. Çıktı olarak sizlere ürünün orjinal yada korsan olduğunu verecektir. İyi günler dileriz.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lisanslar`
--

CREATE TABLE `lisanslar` (
  `lisanslar_id` int(11) NOT NULL,
  `lisanslar_ad` varchar(2200) NOT NULL,
  `lisanslar_kod` varchar(2200) NOT NULL,
  `lisanslar_tarih` date DEFAULT current_timestamp(),
  `lisanslar_status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seoayar`
--

CREATE TABLE `seoayar` (
  `seoayar_id` int(11) NOT NULL DEFAULT 0,
  `seoayar_keywords` varchar(2000) NOT NULL,
  `seoayar_description` varchar(2500) NOT NULL,
  `seoayar_title` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `seoayar`
--

INSERT INTO `seoayar` (`seoayar_id`, `seoayar_keywords`, `seoayar_description`, `seoayar_title`) VALUES
(0, 'ürün, ürün sorgula, özgür medya, ürün kontrol, kontrol', 'Özgür Medya Ücretsiz Ürün Kontrol Scripti', 'Özgür Medya - Ürün Kontrol');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `admin_kullanici` varchar(2500) NOT NULL,
  `admin_parola` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`admin_id`, `admin_kullanici`, `admin_parola`) VALUES
(0, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Tablo için indeksler `lisanslar`
--
ALTER TABLE `lisanslar`
  ADD PRIMARY KEY (`lisanslar_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `lisanslar`
--
ALTER TABLE `lisanslar`
  MODIFY `lisanslar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
