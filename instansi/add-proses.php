<?php
//proses
session_start();

include "../fungsi/koneksi.php";
if (isset($_POST['simpan'])) {

    //name dari elemen html-nya yg dijadikan acuan
    $unit = $_POST['unit'];
    $instansi = $_POST['instansi'];
    $kode_brg = $_POST['kode_brg'];
    $jumlah = $_POST['jumlah'];
    $tgl_pemesanan = date('Y-m-d');
    $id_jenis = $_POST['id_jenis'];
    $stok = $_POST['stok'];
    $sekarang  = date("Y-m-d");

    $jmlReq = "";

    $nama_user = $_SESSION['username'];

    //dari sini hapus
    $query_count = mysqli_query($koneksi,"select * from sementara 
    where unit='$_SESSION[username]' and tgl_permintaan='$sekarang'");

    if (mysqli_num_rows($query_count)) {

        if((mysqli_num_rows($query_count))>=1000){
            //input dgn kode_brg baru tidak diperbolehkan tapi cek dulu klo mau nambah jumlah dgn kode barang
            // sebelumnya, masih diperbolehkan

            //cek dlu kesamaan kode_brg yg sebelumny sudah ada di db, dgn kode barang yg diinput user

            $eksis = mysqli_query($koneksi,"select * from sementara where unit='$_SESSION[username]' 
            and kode_brg='$kode_brg' and tgl_permintaan='$sekarang'");
            if(mysqli_num_rows($eksis) > 0){
                //akan menambahkan ke record sebelumnya
                $dt = mysqli_fetch_array($eksis);
                $jml_brg_sebelumnya = $dt['jumlah'];
                $id_sementara = $dt['id_sementara'];
                $jmlTotal = $jml_brg_sebelumnya+$jumlah;
                $query_update = mysqli_query($koneksi,"update sementara set 
jumlah='$jmlTotal' where unit='$_SESSION[username]' and id_sementara='$id_sementara' and tgl_permintaan='$sekarang'");
                            echo "<script>window.alert('Berhasil menambah jumlah ')
		window.location='index.php?p=formpesan'</script>";
            } else {
                echo "<script>window.alert('Jumlah Permintaan Sudah Maksimum Pada Sesi ini, Ajukan Minta Barang terlebih dahulu')
		window.location='index.php?p=formpesan'</script>";
            }

        } else if(mysqli_num_rows($query_count)<1000 ) {
            //input dgn kode_brg baru diperbolehkan

            $eksis = mysqli_query($koneksi,"select * from sementara where unit='$_SESSION[username]' and 
            kode_brg='$kode_brg' and tgl_permintaan='$sekarang'");
            if(mysqli_num_rows($eksis) > 0){
                $dt = mysqli_fetch_array($eksis);
                $jml_brg_sebelumnya = $dt['jumlah'];
                $id = $dt['id_sementara'];
                $jmlTotal = $jml_brg_sebelumnya+$jumlah;
                $query_update = mysqli_query($koneksi,"update sementara set 
jumlah='$jmlTotal' where unit='$_SESSION[username]' and id_sementara='$id' and tgl_permintaan='$sekarang'");
                echo "<script>window.alert('Berhasil menambah jumlah ')
		window.location='index.php?p=formpesan'</script>";
            } else {
                $query_insert = mysqli_query($koneksi,"INSERT INTO sementara ( unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan)
VALUES ('$_SESSION[username]', '$instansi', '$kode_brg', '$id_jenis', '$jumlah', '$sekarang');");

                if($query_insert){
                    echo "<script>window.alert('Sukses Input Data')
		window.location='index.php?p=formpesan'</script>";
                }
            }


//            $query_insert = mysqli_query($koneksi,"INSERT INTO sementara ( unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan)
//VALUES ('$_SESSION[username]', '$instansi', '$kode_brg', '$id_jenis', '$jumlah', '$sekarang');");
//
//            if($query_insert){
//                echo "<script>window.alert('Sukses Input Data')
//		window.location='index.php?p=formpesan'</script>";
//            }

        }

    } else {
        if(mysqli_num_rows($query_count)<2){
            $query_insert = mysqli_query($koneksi,"INSERT INTO sementara ( unit, instansi, kode_brg, id_jenis, jumlah, tgl_permintaan)
VALUES ('$_SESSION[username]', '$instansi', '$kode_brg', '$id_jenis', '$jumlah', '$sekarang');");

            if($query_insert){
                echo "<script>window.alert('Sukses Input Data')
		window.location='index.php?p=formpesan'</script>";
            }
        }
    }


}
?>

