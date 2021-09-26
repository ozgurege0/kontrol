<?php
require_once('admin/ayarlar/baglan.php');

$seoayar=$db->prepare("SELECT * FROM seoayar where seoayar_id=:id");
$seoayar->execute(array(
        'id'=>0
      ));
$seoayarcek=$seoayar->fetch(PDO::FETCH_ASSOC);

$ayarlar=$db->prepare("SELECT * FROM ayarlar where ayarlar_id=:id");
$ayarlar->execute(array(
        'id'=>0
      ));
$ayarlarcek=$ayarlar->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $seoayarcek['seoayar_description'] ?>">
    <meta name="keywords" content="<?php echo $seoayarcek['seoayar_keywords'] ?>">
    <meta name="author" content="Özgür Medya">

    <!-- Style CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title><?php echo $seoayarcek['seoayar_title'] ?></title>   
    <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
  </head>
  <body class="body">
   
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <nav class="navbar navbar-expand-lg navbar-light style="background-color: #ffffff;"">
  <div class="container-fluid">
    <a class="navbar-brand" href="anasayfa"><?php echo $ayarlarcek['ayarlar_firma'] ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="anasayfa">Ana Sayfa</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="how">Nasıl Kullanılır?</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="contact">İletişim</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

            <div class="card shadow-lg mt-1">
  <div class="card-body">
    <h3 class="text-center mt-2 title"><?php echo $ayarlarcek['ayarlar_title'] ?></h3>

<form action="" method="POST">

    <div class="col-md-6 mt-3 mx-auto width: 200px;">
    <input class="form-control" type="text" name="lisans" placeholder="<?php echo $ayarlarcek['ayarlar_input'] ?>" minlength="<?php echo $ayarlarcek['ayarlar_karakter'] ?>" required>
</div>

<div class="d-grid gap-2 col-6 mx-auto mt-3">
  <button class="btn btn-primary" name="buton" type="submit"><?php echo $ayarlarcek['ayarlar_btn'] ?></button>
</div>

</form>



<?php

if(isset($_POST["buton"])){
    $lisans=$_POST['lisans'];
    
    $sorgu=$db->prepare("SELECT * FROM lisanslar");
    $sorgu->execute(); 
    
    $lisanscek=$sorgu->fetch(PDO::FETCH_ASSOC);
    $lisanskod = $lisanscek["lisanslar_kod"];
    
    if($lisans==$lisanskod){
              echo '<script>Swal.fire("Doğrulandı!", "Bu ürün tamamen bize aittir.", "success"); </script>';
        }else{
            echo '<script>Swal.fire("Doğrulanamadı", "Bu ürün bize ait değildir. Bize iletişim kutusundan bildirebilirsiniz.", "error"); </script>';
          }
    }
    
?>

<div class="text-center mt-3">
    <a class="a" href="javascript:void(0)"><b><?php echo $ayarlarcek['ayarlar_yazi'] ?></b></a> <p><?php echo $ayarlarcek['ayarlar_ornkod'] ?></p>
</div>
<p class="text-center footer"><b><?php echo $ayarlarcek['ayarlar_footer'] ?></b></p>
  </div
</div>

</div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js"></script>

  </body> 
</html>