<?php

include "../fungsi/koneksi.php";
if (isset($_GET['id_sementara'])) {
    $id_sementara = $_GET['id_sementara'];
    $sekarang = date('Y-m-d');
    $kode_brg = $_GET['kode_brg'];



    $query = mysqli_query($koneksi, "select * from sementara where unit='$_SESSION[username]' 
and id_sementara='$id_sementara' and tgl_permintaan='$sekarang'");
    if (mysqli_num_rows($query)) {
        $row2 = mysqli_fetch_assoc($query);
    }
}
?>

<section>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Edit Data Permintaan Barang</h3>
                </div>
                <form method="post"  action="edit_prosesmohon.php" class="form-horizontal">
                    <div class="box-body">
                        <input type="hidden" name="id_sementara" value="<?= $row2['id_sementara']; ?>">
                        <input type="hidden" name="tgl_permintaan" value="<?= $row2['tgl_permintaan']; ?>">
                        <div class="form-group ">
                            <label for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Instansi</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= $row2['unit']; ?>" readonly name="unit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Nama Barang</label>
                            <?php
//                               echo $kode_brg;
                               $query_get_nama_brg = mysqli_query($koneksi,"select * from stokbarang 
                                where kode_brg='$kode_brg'");
                               if(mysqli_num_rows($query_get_nama_brg)){
                                   $dt = mysqli_fetch_array($query_get_nama_brg);
                               }
                            ?>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="nama_brg" value="<?= $dt['nama_brg']; ?>" readonly>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-sm-offset-1 col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-2">
                                <input type="number" value="<?= $row2['jumlah'] ?>"class="form-control" name="jumlah">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary col-sm-offset-4 " value="Update" >
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">
                            <a href="index.php?p=formpesan"
                               style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
