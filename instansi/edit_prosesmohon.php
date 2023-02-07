<?php

include "../fungsi/koneksi.php";

if(isset($_POST['update'])){
    $unit = $_POST['unit'];
    $tgl_pemesanan = $_POST['tgl_permintaan'];
    $id_sementara = $_POST['id_sementara'];
    $jumlah = $_POST['jumlah'];

    $query = mysqli_query($koneksi, "UPDATE sementara SET jumlah ='$jumlah' 
    WHERE id_sementara='$id_sementara' ");

    if($query) {
//        header("location:index.php?p=formpesan&unit=$unit&tgl=$tgl_pemesanan");
        header("location:index.php?p=formpesan&unit=$unit&tgl=$tgl_pemesanan");
    } else {
        echo 'gagal';
    }

}

?>