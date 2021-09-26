<?php
@ob_start();
@session_start();
require_once('baglan.php');

if(isset($_POST['admingiris'])){
    $admin_kullanici=$_POST['admin_kullanici'];
    $admin_parola=md5($_POST['admin_parola']);
 
    $sorgu=$db->prepare("SELECT * FROM user where admin_id=:id and admin_kullanici=:kullanici and admin_parola=:parola");
    $sorgu->execute(array(
        'id'=>0,
        'kullanici'=>$admin_kullanici,
        'parola'=>$admin_parola
      ));
      
      echo $kontrol=$sorgu->rowCount();
 
      if($kontrol==1){
 
        $_SESSION['admin_kullanici']=$admin_kullanici;
        session_regenerate_id();
        
        header("Location:../anasayfa.php");
        exit;
 
      }else{
          header("Location:../login.php?durum=basarisiz");
          exit;
      }
 }


if(isset($_POST['seoayarkaydet'])){ //seo ayarları
    $seoayarkaydet=$db->prepare("UPDATE seoayar SET 
    
    seoayar_title=:seoayar_title,
    seoayar_description=:seoayar_description,
    seoayar_keywords=:seoayar_keywords
    ");

    $guncelle=$seoayarkaydet->execute(array(
        'seoayar_title' => htmlspecialchars($_POST["seoayar_title"],ENT_QUOTES,'UTF-8'),
        'seoayar_description' => htmlspecialchars($_POST["seoayar_description"],ENT_QUOTES,'UTF-8'),
        'seoayar_keywords' => htmlspecialchars($_POST["seoayar_keywords"],ENT_QUOTES,'UTF-8'),
    ));

    if($guncelle){
        header("Location:../seoayar?islem=basarili");
    }else{
        header("Location:../seoayar?islem=basarisiz");
    }

}

if(isset($_POST['ayarlarkaydet'])){ //site ayarları

    $ayarlarkaydet=$db->prepare("UPDATE ayarlar SET 
    
    ayarlar_title=:ayarlar_title,
    ayarlar_input=:ayarlar_input,
    ayarlar_btn=:ayarlar_btn,
    ayarlar_yazi=:ayarlar_yazi,
    ayarlar_ornkod=:ayarlar_ornkod,
    ayarlar_footer=:ayarlar_footer,
    ayarlar_karakter=:ayarlar_karakter,
    ayarlar_firma=:ayarlar_firma
    ");

    $guncelle=$ayarlarkaydet->execute(array(
        'ayarlar_title' => htmlspecialchars($_POST["ayarlar_title"],ENT_QUOTES,'UTF-8'),
        'ayarlar_input' => htmlspecialchars($_POST["ayarlar_input"],ENT_QUOTES,'UTF-8'),
        'ayarlar_btn' => htmlspecialchars($_POST["ayarlar_btn"],ENT_QUOTES,'UTF-8'),
        'ayarlar_yazi' => htmlspecialchars($_POST["ayarlar_yazi"],ENT_QUOTES,'UTF-8'),
        'ayarlar_ornkod' => htmlspecialchars($_POST["ayarlar_ornkod"],ENT_QUOTES,'UTF-8'),
        'ayarlar_footer' => htmlspecialchars($_POST["ayarlar_footer"],ENT_QUOTES,'UTF-8'),
        'ayarlar_karakter' => htmlspecialchars($_POST["ayarlar_karakter"],ENT_QUOTES,'UTF-8'),
        'ayarlar_firma' => htmlspecialchars($_POST["ayarlar_firma"],ENT_QUOTES,'UTF-8'),
    ));

    if($guncelle){
        header("Location:../ayar?islem=basarili");
    }else{
        header("Location:../ayar?islem=basarisiz");
    }

}

if(isset($_POST["productekle"])){ //ürün ekle	
	
	$kaydet=$db->prepare("INSERT INTO lisanslar SET
		lisanslar_ad=:ad,
		lisanslar_kod=:kod
		");
	$insert=$kaydet->execute(array(
		'ad' => htmlspecialchars($_POST['lisanslar_ad'],ENT_QUOTES,'UTF-8'),
		'kod' => htmlspecialchars($_POST['lisanslar_kod'],ENT_QUOTES,'UTF-8'),
		));

		if($insert){
			Header("Location:../products?islem=basarili");
		}else{
			Header("Location:../products?islem=basarisiz");
		}


}

if(isset($_POST['productduzenle'])){ //ürün düzenle
	
	$lisanslar_id=$_POST["lisanslar_id"];
	$duzenle=$db->prepare("UPDATE lisanslar SET
			lisanslar_ad=:ad,
		    lisanslar_kod=:kod,
            lisanslar_status=:status
			WHERE lisanslar_id={$_POST['lisanslar_id']}");
		$update=$duzenle->execute(array(
			'ad' => htmlspecialchars($_POST['lisanslar_ad'],ENT_QUOTES,'UTF-8'),
			'kod' => htmlspecialchars($_POST['lisanslar_kod'],ENT_QUOTES,'UTF-8'),
            'status' => htmlspecialchars($_POST['lisanslar_status'],ENT_QUOTES,'UTF-8'),
			));

			if($update){
				Header("Location:../product-duzenle?lisanslar_id=$lisanslar_id&islem=basarili");
			}else{
				Header("Location:../product-duzenle?&islem=basarisiz");
			}

}

if($_GET['lisanssil']=="basarili"){ //ürün sil 

	$sil=$db->prepare("DELETE FROM lisanslar WHERE lisanslar_id=:lisanslar_id");
    $kontrol=$sil->execute(array(
        'lisanslar_id' => $_GET["lisanslar_id"]
    ));

    if($kontrol){

        Header("Location:../products?lisanssil=basarili");
    }else{
        Header("Location:../products?lisanssil=basarisiz");
    }

}

if(isset($_POST['howkaydet'])){ //nasıl yapılır alanı
    $howkaydet=$db->prepare("UPDATE how SET 
    
    how_baslik=:how_baslik,
    how_yazi=:how_yazi
    ");

    $guncelle=$howkaydet->execute(array(
        'how_baslik' => htmlspecialchars($_POST["how_baslik"],ENT_QUOTES,'UTF-8'),
        'how_yazi' => htmlspecialchars($_POST["how_yazi"],ENT_QUOTES,'UTF-8'),
    ));

    if($guncelle){
        header("Location:../how?islem=basarili");
    }else{
        header("Location:../how?islem=basarisiz");
    }

}

if(isset($_POST["contactekle"])){ //iletişim formu	
	
	$kaydet=$db->prepare("INSERT INTO contact SET
		contact_ad=:ad,
		contact_mail=:mail,
        contact_mesaj=:mesaj
		");
	$insert=$kaydet->execute(array(
		'ad' => htmlspecialchars($_POST['contact_ad'],ENT_QUOTES,'UTF-8'),
		'mail' => htmlspecialchars($_POST['contact_mail'],ENT_QUOTES,'UTF-8'),
        'mesaj' => htmlspecialchars($_POST['contact_mesaj'],ENT_QUOTES,'UTF-8'),
		));

		if($insert){
			Header("Location:../../contact?islem=basarili");
		}else{
			Header("Location:../../contact?islem=basarisiz");
		}


}

if($_GET['contactsil']=="basarili"){ //iletişim sil 

	$sil=$db->prepare("DELETE FROM contact WHERE contact_id=:contact_id");
    $kontrol=$sil->execute(array(
        'contact_id' => $_GET["contact_id"]
    ));

    if($kontrol){

        Header("Location:../contact?contactsil=basarili");
    }else{
        Header("Location:../contact?contactsil=basarisiz");
    }

}

if(isset($_POST['userkaydet'])){

    $userkaydet=$db->prepare("UPDATE user SET 
    
    admin_kullanici=:admin_kullanici
    ");

    $guncelle=$userkaydet->execute(array(
        'admin_kullanici' => htmlspecialchars($_POST["admin_kullanici"],ENT_QUOTES,'UTF-8'),
    ));

    if($guncelle){
        header("Location:../user.php?islem=basarili");
    }else{
        header("Location:../user.php?islem=basarisiz");
    }

}
if(isset($_POST['userkaydet1'])){

    $userkaydet1=$db->prepare("UPDATE user SET 
    
    admin_parola=:admin_parola
    ");

    $guncelle=$userkaydet1->execute(array(
        'admin_parola' => md5($_POST["admin_parola"])
    ));

    if($guncelle){
        header("Location:../user.php?islem=basarili");
    }else{
        header("Location:../user.php?islem=basarisiz");
    }

}
?>