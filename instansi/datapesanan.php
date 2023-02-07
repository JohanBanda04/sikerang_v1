<?php
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";
if (isset($_GET['aksi']) && isset($_GET['tgl'])) {
    $tgl = $_GET['tgl'];
    echo $tgl;
    if ($_GET['aksi'] == 'detil') {
        header("location:?p=detil&tgl=$tgl");
    }
}
$query = mysqli_query($koneksi, "SELECT tgl_permintaan, count(kode_brg)  FROM permintaan WHERE unit='$_SESSION[username]'  GROUP BY tgl_permintaan  DESC");
?>
<!--Isi Utama dari menu Data Permintaan Barang (Side Instansi)-->
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan Barang</h3>
                </div>
                <div class="box-body">
                    <a href="index.php?p=formpesan&pa=FormPermintaanBarang" style="margin:10px 15px; background-color: #99ccb5 " class="btn btn-success">
                        <i class='fa fa-plus' style="color: #0c0c0c; font-weight: bold" >
                            Form Permintaan Barang
                        </i>
                    </a>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead style="background-color: #99ccb5">
                            <tr>
                                <th style="color: black">No</th>
                                <th style="color: black">Tanggal Permintaan</th>
                                <th style="color: black">Jumlah Permintaan</th>
                                <th style="color: black">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($query)) {
                                while ($row = mysqli_fetch_assoc($query)):
                                ?>
                                <td> <?= $no; ?> </td>
                                <td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>
                                <td> <?= $row['count(kode_brg)']; ?> </td>
                                <td>
                                    <!--error disini, saat klik detail permintaan, tidak di redirect-->
                                    <a href="?p=datapesanan&aksi=detil&tgl=<?= $row['tgl_permintaan']; ?>">
                                    <a href="?p=detil&tgl=<?= $row['tgl_permintaan']; ?>&pa=DetailPermintaan" >
                                                <span style="font-weight: bold; " data-placement='top'
                                                      data-toggle='tooltip' title='Detail Permintaan'>
                                                    <button class="btn btn-info" style="font-weight: bold; color: #0c0c0c;
                                                    background-color: #99ccb5">
                                                        Detail Permintaan
                                                    </button>
                                                </span>
                                    </a>

                                    <!--dibawah ini hanya sebagai acuan utk mencontoh format penulisan-->
<!--                                    <a href="?p=detil_datapengeluaran&unit=--><?//= $row['unit'];?><!--&tgl=--><?//= $row['tgl_permintaan']; ?><!--"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button class="btn btn-info">Detail Barang</button></span></a>-->
                                </td>
                            </tr>

                            <?php $no++;
                            endwhile;
                            } else {
                                echo "<tr><td colspan=9>Tidak ada Data.</td></tr>";
                            } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

