<?php


session_start();
//include "../fungsi/ceklogin.php";
//ob_start();

include "../fungsi/koneksi.php";

//ditambah johan untuk mencegah direct url access
//if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
//    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
//    die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
//}

$page = isset($_GET['p']) ? $_GET['p'] : false;
//include 'cekuser.php';
$query = mysqli_query($koneksi, "SELECT COUNT(id_jenis) AS jumlah FROM jenis_barang ");
$data = mysqli_fetch_assoc($query);


if (isset($_GET['pa'])) {
    if($_GET['pa']=='Dashboard'){
        $dashboard = 'active';
        $dataBarang = '';
        $permintaan = '';
        $cetak = '';
        $detailpermintaan = '';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = '';
    } else if($_GET['pa']=='DataBarang'){
        $dashboard = '';
        $dataBarang = 'active';
        $permintaan = '';
        $cetak = '';
        $detailpermintaan = '';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = '';
    } else if($_GET['pa']=='Permintaan'){
        $dashboard = '';
        $dataBarang = '';
        $permintaan = 'active';
        $cetak = '';
        $detailpermintaan = '';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = '';
    }else if($_GET['pa']=='Cetak'){
        $dashboard = '';
        $dataBarang = '';
        $permintaan = '';
        $cetak = 'active';
        $detailpermintaan = '';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = '';
    } else if($_GET['pa']=='DetailPermintaan'){
        $dashboard = '';
        $dataBarang = '';
        $permintaan = '';
        $cetak = '';
        $detailpermintaan = 'active';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = '';
    } else if($_GET['pa']=='KembaliDataPesanan'){
        $dashboard = '';
        $dataBarang = '';
        $permintaan = '';
        $cetak = '';
        $detailpermintaan = '';
        $kembaliDataPesanan = 'active';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = '';
    } else if($_GET['pa']=='FormPermintaanBarang'){
        $dashboard = '';
        $dataBarang = '';
        $permintaan = '';
        $cetak = '';
        $detailpermintaan = '';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = 'active';
        $kembaliDataPesananForm = '';
    } else if($_GET['pa']=='KembaliDataPesananForm'){
        $dashboard = '';
        $dataBarang = '';
        $permintaan = '';
        $cetak = '';
        $detailpermintaan = '';
        $kembaliDataPesanan = '';
        $formPermintaanBarang = '';
        $kembaliDataPesananForm = 'active';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Kelola Barang</title>
    <link rel="shortcut icon" type="image/icon" href="../pv.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link href="../assets/bootstrap/css/custom.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="../assets/plugins/jQuery/jquery.min.js"></script>

    <!--Ditambah Johan :-->
    <!--Script mencegah button kembali/back-->
    <script type="text/javascript">
        function back() {
            window.history.forward();
        }

        // Force Client to forward to last (current) Page.
        setTimeout("back()", 0);

        window.onunload = function () {
            null
        };
    </script>

</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <div class="logo">
            <span class="logo-lg"><b>SIKERANG</b></span>
        </div>

        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </nav>

    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header"><h4
                            class="text-center" style="font-weight: bold; color: #0c0c0c"><?= $_SESSION['username']; ?></h4></li>
                <li class="<?= $dashboard; ?> treeview ">
                    <!--          <li><a href="index.php?p=cetakpesanan"><i class="fa fa-print"></i> Cetak BPP</a></li>-->
                    <a href="index.php?pa=Dashboard"
                       style="<?php if($dashboard=="active") { ?> background-color: #c7fff1; opacity: 80% <?php } ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="hidden treeview <?php if($_GET['pas'] == 'atk' || $_GET['pas'] == 'kebersihan' || $_GET['pas']=='perlengkapan') { ?> active <?php } ?>">
                    <!--          <a href="#">-->
                    <a href="index.php?pa=DataBarang"
                       style="<?php if((isset($_GET['pas']) && $_GET['pas']=='atk') || (isset($_GET['pas']) && $_GET['pas']=='kebersihan') || (isset($_GET['pas']) && $_GET['pas']=='perlengkapan')) { ?> background-color: #c7fff1; opacity: 85% <?php } ?>">
                        <i class="fa fa-table"></i>
                        <span>Data Stok Barang</span>
                        <span class="pull-right-container">
              <span class="label label-primary pull-right"><?= $data['jumlah']; ?></span>
            </span>
                    </a>
                    <ul class="treeview-menu" data-collapse="true">
                        <li style="<?php if($_GET['pas']=='atk'){ ?> background-color: #87b2a4 <?php } ?>" class="treeview">
                            <a href="index.php?p=material&id_jenis=1&pas=atk">
                                <i class="fa fa-circle-o"></i>ATK
                            </a>
                        </li>
                        <li style="<?php if($_GET['pas']=='kebersihan'){ ?> background-color: #87b2a4 <?php } ?>" class="">
                            <a href="index.php?p=material&id_jenis=2&pas=kebersihan">
                                <i class="fa fa-circle-o"></i>ALAT KEBERSIHAN
                            </a>
                        </li>
                        <li style="<?php if($_GET['pas']=='perlengkapan'){ ?> background-color: #87b2a4 <?php } ?>" class="">
                            <a href="index.php?p=material&id_jenis=3&pas=perlengkapan">
                                <i class="fa fa-circle-o"></i>PERLENGKAPAN LAINNYA
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?= $permintaan; ?>">
                    <a href="index.php?p=datapesanan&pa=Permintaan"
                       style="<?php if ($permintaan == "active" || (isset($_GET['pa']) && $_GET['pa']=='DetailPermintaan') || (isset($_GET['pa']) && $_GET['pa']=='KembaliDataPesanan') || (isset($_GET['pa']) && $_GET['pa']=='FormPermintaanBarang') || (isset($_GET['pa']) && $_GET['pa']=='KembaliDataPesananForm')) { ?> background-color: #c7fff1; opacity: 80% <?php } ?>">
                        <i class="fa fa-files-o"></i> Data Permintaan Barang
                    </a>
                </li>
                <li class="<?= $cetak; ?>">
                    <a href="index.php?p=cetakpesanan&pa=Cetak"
                       style="<?php if ($cetak == "active") { ?> background-color: #c7fff1; opacity: 80% <?php } ?>">
                        <i class="fa fa-print"></i> Cetak BPP
                    </a>
                </li>
                <li><a href="../logout.php">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <?php
        include "page.php";
        ?>
    </div>

    <footer class="main-footer">
        <marquee hspace="40" width="full-width">Setelah permintaan di konfirmasi oleh Bendahara, Unit/Instalasi ybs harap
            segera langsung dengan membawa Bukti Permintaan yang telah disahkan oleh Kepala Unit/Instalasi dan mengambil barang ke gudang.
        </marquee>

    </footer>

    <!-- jQuery 2.2.3 -->
    <script src="../assets/plugins/jQuery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->

    <script src="../assets/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../assets/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <!-- datepicker -->
    <script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/app.min.js"></script>

</body>
</html>
