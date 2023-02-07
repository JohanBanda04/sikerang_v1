<?php
session_start();
ob_start();
//include "cekuser.php";
include "../fungsi/koneksi.php";

$page = isset($_GET['p']) ? $_GET['p'] : false;
$query = mysqli_query($koneksi, "SELECT COUNT(id_jenis) AS jumlah FROM jenis_barang ");
$data = mysqli_fetch_assoc($query);

if(isset($_GET['pa'])){
    if($_GET['pa']=='Dashboard'){
        $dashboard = 'active';
        $datauser = '';
    } else if($_GET['pa']=='DataUser'){
        $dashboard = '';
        $datauser = 'active';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Kelola Barang</title>
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
    <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">

    <script src="../assets/plugins/jQuery/jquery.min.js"></script>

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


            </a>


        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header"><h4
                            class="text-center"><?= $_SESSION['jabatan']; ?> <?= $_SESSION['username']; ?></h4></li>
                <li class="active treeview">
                    <a href="index.php?pa=Dashboard"
                       style="<?php if($dashboard=='active') { ?> background-color: #c7fff1; opacity: 80% <?php } ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?p=user&pa=DataUser"
                       style="<?php if($datauser=='active') { ?> background-color: #c7fff1; opacity: 80% <?php } ?>">
                        <i class="fa fa-users"></i> <span>Data User</span>
                    </a>
                </li>
                <li class="treeview <?php if($_GET['pas']=='atk' || $_GET['pas']=='kebersihan' || $_GET['pas']=='perlengkapan') { ?> active <?php } ?>">
                    <a href="index.php?pa=DataStokBarang"
                       style="<?php if ((isset($_GET['pas']) && $_GET['pas']=='atk') || (isset($_GET['pas']) && $_GET['pas']=='kebersihan') || (isset($_GET['pas']) && $_GET['pas']=='perlengkapan')) {?> background-color: #c7fff1; opacity: 85% <?php } ?>">
                        <i class="fa fa-cubes"></i>
                        <span>Data Stok Barang</span>
                        <span class="pull-right-container">
            <span class="label label-primary pull-right"><?= $data['jumlah']; ?></span>
          </span>
                    </a>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='atk') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=material-m1&id_jenis=1&pas=atk">
                                <i class="fa fa-circle-o"></i>ATK
                            </a>
                        </li>
                        <li style="<?php if($_GET['pas']=='kebersihan') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=material-m2&id_jenis=2&pas=kebersihan">
                                <i class="fa fa-circle-o"></i>ALAT KEBERSIHAN
                            </a>
                        </li>
                        <li style="<?php if($_GET['pas']=='perlengkapan') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=material-m3&id_jenis=3&pas=perlengkapan">
                                <i class="fa fa-circle-o"></i>PERLENGKAPAN LAIINYA
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="treeview <?php if($_GET['pas']=='permintaanbarang' || $_GET['pas']=='datapermintaanbarang') { ?> active <?php } ?>">
                    <a href="index.php?pa=PermintaanBarang"
                       style="<?php if((isset($_GET['pas']) && $_GET['pas']=='permintaanbarang') || (isset($_GET['pas']) && $_GET['pas']=='datapermintaanbarang') ) { ?>
                               background-color: #c7fff1; opacity: 85%
                       <?php } ?>">
                        <i class="fa fa-retweet"></i>
                        <span>Permintaan Barang</span>
                        <span class="pull-right-container">
          <span class="label label-primary pull-right"></span>
        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='permintaanbarang') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=datapermintaan&pas=permintaanbarang">
                                <i class="fa fa-circle-o"></i>Permintaan Barang
                            </a>
                        </li>
                    </ul>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='datapermintaanbarang') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=datapengeluaran&pas=datapermintaanbarang">
                                <i class="fa fa-circle-o"></i>Data Permintaan Barang
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if($_GET['pas']=='formpengajuanbarang' || $_GET['pas']=='datapengajuanbarang') { ?> active <?php } ?>">
                    <a href="index.php?pa=PengajuanBarang"
                       style="<?php if((isset($_GET['pas']) && $_GET['pas']=='formpengajuanbarang') || (isset($_GET['pas']) && $_GET['pas']=='datapengajuanbarang')) { ?>
                               background-color: #c7fff1; opacity: 85%
                       <?php } ?>">
                        <i class="fa fa-pencil-square"></i>
                        <span>Pengajuan Barang</span>
                        <span class="pull-right-container">
          <span class="label label-primary pull-right"></span>
        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='formpengajuanbarang') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=formpengajuan&pas=formpengajuanbarang">
                                <i class="fa fa-circle-o"></i>Form Pengajuan Barang
                            </a>
                        </li>
                    </ul>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='datapengajuanbarang') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=datapengajuan&pas=datapengajuanbarang">
                                <i class="fa fa-circle-o"></i>Data Pengajuan Barang
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($_GET['pas']=='detillaporanpermintaan' || $_GET['pas']=='rekapitulasipermintaan') { ?> active <?php } ?>">
                    <a href="index.php?pa=LaporanPermintaanBarang"
                       style="<?php if ((isset($_GET['pas']) && $_GET['pas']=='detillaporanpermintaan') || (isset($_GET['pas']) && $_GET['pas']=='rekapitulasipermintaan')) { ?>
                               background-color: #c7fff1; opacity: 85%
                       <?php } ?>">
                        <i class="fa fa-file-pdf-o"></i>
                        <span>Laporan Permintaan Barang</span>
                        <span class="pull-right-container">
          <span class="label label-primary pull-right"></span>
        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='detillaporanpermintaan') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=detil_lap_permintaan&pas=detillaporanpermintaan">
                                <i class="fa fa-circle-o"></i>Detil Laporan Permintaan
                            </a>
                        </li>
                    </ul>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='rekapitulasipermintaan') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=rekapitulasipermintaan&pas=rekapitulasipermintaan">
                                <i class="fa fa-circle-o"></i>Rekapitulasi Permintaan
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if($_GET['pas']=='detillaporanpengajuan' || $_GET['pas']=='rekapitulasipengajuan') { ?> active <?php } ?>">
                    <a href="index.php?pa=LaporanPengajuanBarang"
                       style="<?php if((isset($_GET['pas']) && $_GET['pas']=='detillaporanpengajuan') || (isset($_GET['pas']) && $_GET['pas']=='rekapitulasipengajuan')) { ?>
                               background-color: #c7fff1; opacity: 85%
                       <?php } ?>">
                        <i class="fa fa-file-pdf-o"></i>
                        <span>Laporan Pengajuan Barang</span>
                        <span class="pull-right-container">
          <span class="label label-primary pull-right"></span>
        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li style="<?php if($_GET['pas']=='detillaporanpengajuan') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=detil_lap_pengajuan&pas=detillaporanpengajuan">
                                <i class="fa fa-circle-o"></i>Detil Laporan Pengajuan
                            </a>
                        </li>
                    </ul>
                    <ul class="treeview-menu">
                        <li style="<?php if ($_GET['pas']=='rekapitulasipengajuan') { ?> background-color: #87b2a4 <?php } ?>">
                            <a href="index.php?p=rekapitulasipengajuan&pas=rekapitulasipengajuan">
                                <i class="fa fa-circle-o"></i>Rekapitulasi Pengajuan
                            </a>
                        </li>
                    </ul>
                </li>

                <li><a href="../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php include "page.php"; ?>
    </div>

    <footer class="main-footer">
        <marquee hspace="40" width="full-width">Bendahara mengolah data user dan data stok Barang.</marquee>
<!--        <strong>Copyright &copy; Komputerisasi Akuntansi Mercusuar 2020 </strong>-->
    </footer>

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

    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

</body>
</html>
