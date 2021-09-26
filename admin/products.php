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

$lisanslar=$db->prepare("SELECT * FROM lisanslar ORDER BY lisanslar_id DESC;");
      $lisanslar->execute();

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

                    <div class="row">
                    <div class="col-md-6 mx-auto width: 200px;">
                            Ürün Eklemek İçin Tıkla: <a href="product-ekle"><button class="btn btn-primary">EKLE</button></a>
                    </div>
                    </div>         

                        <div class="card shadow mb-4 mt-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ürünlerimiz</h6>
        
                        
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                            <th>Ürün Adı</th>
                                            <th>Ürün Kodu</th>
                                            <th>Tarih</th>
                                            <th>Durum</th>
                                            <th></th>
                                            <th></th>                                      
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

$no=0;

while ($vericek=$lisanslar->fetch(PDO::FETCH_ASSOC)) { $no++; ?>

    <tr>
        <th scope="row"><?php echo $no; ?></th>
        <td><?php echo $vericek["lisanslar_ad"] ?></td>
        <td><?php echo $vericek["lisanslar_kod"] ?></td>
        <td><?php echo $vericek["lisanslar_tarih"] ?></td>
        
        <td>
                        <?php 
                        if($vericek["lisanslar_status"]==1){
                          echo '<button class="btn btn-success btn-xs">Aktif</button>';
                        }else{
                          echo '<button class="btn btn-danger btn-xs">Pasif</button>';
                        }
                        
                        ?>
                        </td>
        <td><a href="product-duzenle?lisanslar_id=<?php echo $vericek["lisanslar_id"] ?>"><button class="btn-sm btn-success">Düzenle</button></a></td>
        <td><a href="ayarlar/islem.php?lisanslar_id=<?php echo $vericek["lisanslar_id"] ?>&lisanssil=basarili"><button class="btn-sm btn-danger">Sil</button></td>
    </tr>

    
    
<?php }

?>
               


                                    </tbody>
                                    
                                </table>
                                
                            </div>
                        </div>
                    </div>
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

            if(@$_GET["lisanssil"]=="basarili"){
                echo '<div class="text-center"><div class="alert alert-success solid alert-dismissible fade show mt-5">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <strong>Başarılı!</strong> Tebrikler, veri Güncellendi.
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div></div>';
            }elseif(@$_GET["lisanssil"]=="basarisiz"){
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once("includes/footer.php");
            ?>