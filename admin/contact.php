<?php
require_once("includes/session.php");
?>
<?php
require_once("ayarlar/baglan.php");

$seoayar=$db->prepare("SELECT * FROM seoayar where seoayar_id=:id");
$seoayar->execute(array(
        'id'=>0
      ));
$vericek=$seoayar->fetch(PDO::FETCH_ASSOC);

$sayfa = intval($_GET["sayfa"]);
if(!$sayfa) {
  $sayfa = 1;
}
$v = $db->prepare("SELECT * FROM contact");
$v->execute(array());
$toplam = $v->rowCount();
$limit = 5;
$goster = $sayfa*$limit-$limit;
$sayfa_sayisi = ceil($toplam/$limit);
$forlimit = 2;

$contact=$db->prepare("SELECT * FROM contact ORDER BY contact_id DESC limit $goster,$limit");
      $contact->execute();

require_once("includes/header.php");
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
require_once("includes/sidebar.php");
?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <?php
            require_once("includes/navbar.php");
               ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
                    
                    <div class="row">

                    <div class="col-md-12">
                    <div class="col-md-4"></div>

<h2><b>Mesaj Kutusu</b></h2>
<div class="table-responsive">
                    <table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Ad Soyad</th>
      <th scope="col">Tarih</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php 

$no=0;

while ($vericek=$contact->fetch(PDO::FETCH_ASSOC)) { $no++; ?>
      <th scope="col"><?php echo $no; ?></td>
      <td><?php echo $vericek["contact_ad"] ?></td>
      <td><?php echo $vericek["contact_tarih"] ?></td>
      <td><a href="contact-oku?contact_id=<?php echo $vericek["contact_id"] ?>"><button class="btn-sm btn-success">Oku</button></a></td>
        <td><a href="ayarlar/islem.php?contact_id=<?php echo $vericek["contact_id"] ?>&contactsil=basarili"><button class="btn-sm btn-danger">Sil</button></td>
    </tr>
    <?php
}
?>
  </tbody>
</table>

<nav aria-label="...">
  <ul class="pagination mt-5">
  <?php 

if($sayfa < 2){
    echo "";
}else{
    echo "<li class='page-item'>
    <a class='page-link' href='?sayfa=".($sayfa - 1)."'>Önceki</a>
  </li>";
}

?>
    

      <?php
for($i = $sayfa - $forlimit; $i<$sayfa + $forlimit +1; $i++){
  if($i>0 && $i<= $sayfa_sayisi){
      if($i == $sayfa){
        echo "<li class='page-item active' aria-current='page'>
        <a class='page-link'>".$i."</a>
      </li>";
      }else{
        echo "<li class='page-item'><a class='page-link' href='?sayfa=".$i."'>".$i."</a></li>";
      }
  }
}

?>

<?php 

if($sayfa == $sayfa_sayisi){
  echo "";
}else{
  echo "<li class='page-item'>
  <a class='page-link' href='?sayfa=".($sayfa + 1)."'>Sonraki</a>
</li>";
}

?>
  
  </ul>
</nav>
    </div>       
    <?php 
            
            if(@$_GET["islem"]=="basarili"){
                echo '<div class="alert alert-success solid alert-dismissible fade show mt-5">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <strong>Başarılı!</strong> Tebrikler, veri Güncellendi.
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div>';
            }elseif(@$_GET["islem"]=="basarisiz"){
                echo ' <div class="alert alert-danger solid alert-dismissible fade show mt-5">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <strong>Başarısız!</strong> İşlem başarısız oldu. Lütfen tekrar deneyiniz.
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div>';
            }

            if(@$_GET["contactsil"]=="basarili"){
                echo '<div class="text-center"><div class="alert alert-success solid alert-dismissible fade show mt-5">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <strong>Başarılı!</strong> Tebrikler, veri Güncellendi.
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div></div>';
            }elseif(@$_GET["contactsil"]=="basarisiz"){
                echo '<div class="text-center"><div class="alert alert-danger solid alert-dismissible fade show mt-5">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <strong>Başarısz!</strong> İşlem başarısız oldu. Lütfen tekrar deneyiniz.
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div></div>';
            }
            
            ?>
                            </div>
                   
                 
                   
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once("includes/footer.php");
            ?>