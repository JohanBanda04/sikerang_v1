<?php
session_start();
include "../fungsi/koneksi.php";
$tgl = date('Y-m-d');

//Ditambah Johan
//$sekarang = date('Y-m-d');
//$queryCekData = mysqli_query($koneksi,"SELECT sementara.unit,
//sementara.id_sementara, stokbarang.nama_brg, stokbarang.satuan, sementara.kode_brg,
//jumlah FROM sementara INNER JOIN
//stokbarang ON sementara.kode_brg  = stokbarang.kode_brg WHERE tgl_permintaan = '$sekarang'
//AND sementara.unit='$_SESSION[username]'");
//akhir dari yang ditambah johan

$query_cek_kode_brg = mysqli_query($koneksi, "select * from sementara where unit='$_SESSION[username]' and 
tgl_permintaan='$tgl'");

$array_cek_4 = array();
while ($dts = mysqli_fetch_array($query_cek_kode_brg)) {
//    echo $dts['jumlah'].":";
    array_push($array_cek_4, $dts['jumlah']);

}
//print_r($array_cek_4);
$array_cek = array();
foreach ($array_cek_4 as $val) {
    if ($val > 4) {
        array_push($array_cek, "tidak memenuhi syarat");
    } else if ($val <= 4) {
        array_push($array_cek, "memenuhi syarat");
    }
}

if (in_array("tidak memenuhi syarat", $array_cek)) {
//    echo "tidak memenuhi syarat";
    echo '<script language="javascript">alert("Jumlah Kuantitas per Item ada yang melebihi 4 (satuan)");
document.location="index.php?p=formpesan";</script>';
} else {
//    echo "memenuhi syarat";
    $query_get_kode_barang = mysqli_query($koneksi, "select * from sementara where unit='$_SESSION[username]' 
and tgl_permintaan='$tgl'");

    while ($itm = mysqli_fetch_array($query_get_kode_barang)) {
        $id_sementara = $itm['id_sementara'];
        $unit = $itm['unit'];
        $instansi = $itm['instansi'];
        $kode_brg = $itm['kode_brg'];
        $id_jenis = $itm['id_jenis'];
        $jumlah = $itm['jumlah'];
        $tgl_permintaan = $itm['tgl_permintaan'];
        $status = $itm['status'];
//        $kode_barang = $itm['kode_brg'];

        $query_insert_ke_sementara_history = mysqli_query($koneksi, "INSERT INTO sementara_history
(unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan, status,id_sementara)
VALUES ( '$unit' ,'$instansi', '$kode_brg', '$id_jenis', '$jumlah',
'$tgl_permintaan','$status','$id_sementara')");

        $query_insert_ke_permintaan = mysqli_query($koneksi, "INSERT INTO permintaan
( unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan, status, id_sementara)
VALUES ('$unit', '$instansi', '$kode_brg', '$id_jenis', '$jumlah',
'$tgl_permintaan','$status','$id_sementara')");

        $query_delete_from_sementara = mysqli_query($koneksi, "DELETE FROM sementara WHERE id_sementara='$id_sementara'");

        if ($query_insert_ke_sementara_history && $query_insert_ke_permintaan && $query_delete_from_sementara) {
            echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim ke Bendahara Barang!!!");
document.location="index.php?p=datapesanan";</script>';
        } else {
            echo "gagal euy" . mysqli_error($koneksi);
        }
    }
}


//foreach ($array_cek_4 as $key => $value){
//}

//while($item = mysqli_fetch_array($query_cek_kode_brg)){
//    $kode_brg = $item['kode_brg'];
////    echo $kode_brg."-";
//    $query_cek_jumlah_per_kode_brg = mysqli_query($koneksi,"select * from sementara where unit='$_SESSION[username]' and
//tgl_permintaan='$tgl' and kode_brg='$kode_brg'");
//
//
//    while($dt = mysqli_fetch_array($query_cek_jumlah_per_kode_brg)){
//        $jumlah_per_kode_brg = $dt['jumlah'];
//
//        if($jumlah_per_kode_brg > 4){
//            echo '<script language="javascript">alert("Kuantitas Maksimal per item : 4 (satuan)");
//document.location="index.php?p=formpesan";</script>';
//        } else if ($jumlah_per_kode_brg <= 4){
//            //masih boleh mengajukan permintaan
////            echo $dt['kode_brg']."::";
////            echo $dt['id_sementara']."::";
//
//
//            $id_sementara = $dt['id_sementara'];
//            $unit = $dt['unit'];
//            $instansi = $dt['instansi'];
//            $kode_barang = $dt['kode_brg'];
//            $id_jenis = $dt['id_jenis'];
//            $jumlah = $dt['jumlah'];
//            $tgl_permintaan = $dt['tgl_permintaan'];
//            $status = $dt['status'];
//
//            $query_insert_ke_sementara_history = mysqli_query($koneksi,"INSERT INTO sementara_history
//(unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan, status,id_sementara)
//VALUES ( '$unit' ,'$instansi', '$kode_brg', '$id_jenis', '$jumlah',
//'$tgl_permintaan','$status','$id_sementara')");
//
//            $query_insert_ke_permintaan = mysqli_query($koneksi,"INSERT INTO permintaan
//( unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan, status, id_sementara)
//VALUES ('$unit', '$instansi', '$kode_brg', '$id_jenis', '$jumlah',
//'$tgl_permintaan','$status','$id_sementara')");
//
//            $query_delete_from_sementara = mysqli_query($koneksi,"DELETE FROM sementara WHERE id_sementara='$id_sementara'");
//
//            if($query_insert_ke_sementara_history && $query_insert_ke_permintaan && $query_delete_from_sementara){
//                echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim ke Bendahara Barang!!!");
//document.location="index.php?p=datapesanan";</script>';
//            } else {
//                echo "gagal euy" . mysqli_error($koneksi);
//            }
//
//
//
//
////            if (mysqli_query($koneksi, $query)) {
////                mysqli_query($koneksi, $query2);
////                echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim ke Bendahara Barang!!!");
////document.location="index.php?p=datapesanan";</script>';
////            } else {
////                echo "gagal euy" . mysqli_error($koneksi);
////            }
//
////            $query =  "INSERT INTO permintaan SELECT * FROM sementara where unit='$_SESSION[username]' and
////tgl_permintaan='$tgl'";
////            $query2 = "DELETE FROM sementara WHERE unit='$_SESSION[username]' tgl_permintaan='$tgl'";
////
////
////            if (mysqli_query($koneksi, $query)) {
////                mysqli_query($koneksi, $query2);
////                echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim ke Bendahara Barang!!!");
////document.location="index.php?p=datapesanan";</script>';
////            } else {
////                echo "gagal euy" . mysqli_error($koneksi);
////            }
//        }
//    }
//}


//$query =  "INSERT INTO permintaan SELECT * FROM sementara where unit='$_SESSION[username]' and
//tgl_permintaan='$tgl'";
//
//$query2 = "DELETE FROM sementara WHERE unit='$_SESSION[username]' tgl_permintaan='$tgl'";
//
//if(mysqli_query($koneksi, $query)){
//	mysqli_query($koneksi, $query2);
//	echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim !!!");
//document.location="index.php?p=datapesanan";</script>';
//} else {
//	echo "gagal euy" . mysqli_error($koneksi);
//}


?>