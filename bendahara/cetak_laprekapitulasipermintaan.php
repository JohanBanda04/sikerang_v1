<?php

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

ob_start();
$id = isset($_GET['id']) ? $_GET['id'] : false;


$tanggala = $_POST['tanggala'];
$tanggalb = $_POST['tanggalb'];

?>
    <!-- Setting CSS bagian header/ kop -->
    <style type="text/css">
        table.page_header {
            width: 1020px;
            border: none;
            background-color: #DDDDFF;
            border-bottom: solid 1mm #AAAADD;
            padding: 2mm
        }

        table.page_footer {
            width: 1020px;
            border: none;
            background-color: #DDDDFF;
            border-top: solid 1mm #AAAADD;
            padding: 2mm
        }


    </style>
    <!-- Setting Margin header/ kop -->
    <!-- Setting CSS Tabel data yang akan ditampilkan -->
    <style type="text/css">
        .tabel2 {
            border-collapse: collapse;
            margin-left: 20px;
        }

        .tabel2 th, .tabel2 td {
            padding: 5px 5px;
            border: 1px solid #000000;
        }

        div.kanan {
            width: 300px;
            float: right;
            margin-left: 250px;
            margin-top: -141px;
        }

        div.kiri {
            width: 300px;
            float: left;
            margin-left: 20px;
            display: inline;
        }

    </style>
    <table>
<!--        <tr>-->
<!---->
<!--            <th rowspan="3"><img src="../gambar/lobar_logo.png" style="width:90px;height:100px"/></th>-->
<!--            <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>PEMERINTAH KABUPATEN LOBAR <br>-->
<!--                        RSUD AWET MUDA NARMADA</b></font>-->
<!--                <br>Nyur Lembang, Kec. Narmada, Kabupaten Lombok Barat, Nusa Tenggara Bar. 83371 <br>Telp : (0370)-->
<!--                7561792-->
<!--            </td>-->
<!--            <th rowspan="3"><img src="../gambar/rsam_narmada.png" style="width:95px;height:95px" /></th>-->
<!---->
<!--        </tr>-->
        <tr>
            <!--    <th rowspan="3"><img src="../gambar/jy.png" style="width:100px;height:100px" /></th>-->
            <th rowspan="3"><img src="../gambar/lobar_logo.png" style="width:100px;height:100px; " /></th>
            <td align="center" style="width: 520px;"><font style="font-size: 15px"><b>PEMERINTAH KABUPATEN LOMBOK BARAT  </b></font><br>
                <font style="font-size: 18px"><b>BADAN PELAYANAN UMUM DAERAH</b></font><br>
                <font style="font-size: 24px; font-weight: bold"><b>RSUD AWET MUDA NARMADA</b></font> <br>
                <font style="font-size: 15px; ">Jl. Ahmad Yani No.69 Narmada Kode Pos 83371</font><br>Telepon (0370) 7563630 - (0370) 7561792
                <br>
                <font style="font-size: 15px; ">E-mail : rsudam.lombokbarat@gmail.com</font>
                <!--      <br>Jl. TB. Badaruddin No. 1 RT.1/RW.5, Kel. Jatinegara Kaum, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13250 <br>Telp : (021) 4751119-->
            </td>
            <th rowspan="1"><img src="../gambar/rsam_narmada.png" style="width:95px;height:95px"/></th>
        </tr>
    </table>
    <hr>
    <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PENGELUARAN PERMINTAAN BARANG (BPP)</u></p>

    <div class="isi" style="margin: 0 auto;">
        Periode : <?= tanggal_indo($tanggala); ?> S/d <?= tanggal_indo($tanggalb); ?>
        <br><br>
        <table class="tabel2">
            <thead>
            <tr>
                <td style="text-align: center; "><b>No.</b></td>
                <td style="text-align: center; "><b>Tanggal Keluar</b></td>
                <td style="text-align: center; "><b>Nama </b></td>
<!--                <td style="text-align: center; " class="hidden"><b>Kode Barang</b></td>-->
                <td style="text-align: center; width: 20px"><b>Nama Barang</b></td>
                <td style="text-align: center; "><b>Satuan</b></td>
                <td style="text-align: center; "><b>Jumlah</b></td>
                <td style="text-align: center; width: 20px "><b>Harga Satuan</b></td>
                <td style="text-align: center; width: 50px "><b>Harga Total</b></td>
            </tr>
            </thead>
            <tbody>
            <?php

            $query_old = mysqli_query($koneksi, "SELECT pengeluaran.kode_brg, unit, nama_brg, jumlah, satuan, 
tgl_keluar FROM pengeluaran INNER JOIN stokbarang ON pengeluaran.kode_brg = stokbarang.kode_brg 
WHERE tgl_keluar BETWEEN '$tanggala' and '$tanggalb' ");
            $query = mysqli_query($koneksi, "SELECT pengeluaran.kode_brg, unit, nama_brg, jumlah, satuan, 
tgl_keluar,hargabarang FROM pengeluaran INNER JOIN stokbarang ON pengeluaran.kode_brg = stokbarang.kode_brg 
WHERE tgl_keluar BETWEEN '$tanggala' and '$tanggalb' ");
            $i = 1;
            $total = 0;
            $total_rupiah = 0;
            while ($data = mysqli_fetch_array($query)) {
                $harga_total = 0;
                ?>
                <tr>
                    <td style="text-align: center; width=10px; "><?php echo $i; ?></td>
                    <td style="text-align: center; width=70px; font-size: 12px;"><?php echo date('d/m/Y', strtotime($data['tgl_keluar'])); ?></td>
                    <td style="text-align: left; width=100px; font-size: 12px;"><?php echo $data['unit']; ?></td>
<!--                    <td style="text-align: center; width=70px; font-size: 12px;" class="hidden">--><?php //echo $data['kode_brg']; ?><!--</td>-->
                    <td style="text-align: left; width=100px; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>
                    <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['satuan']; ?></td>

                    <td style="text-align: center; font-size: 12px;"><?php echo $data['jumlah']; ?></td>
                    <td style="text-align: center; font-size: 12px; width: 40px"><?php echo number_format($data['hargabarang']); ?></td>
                    <?php
                        $harga_brg = $data['hargabarang'] ;
                        $jml_brg = $data['jumlah'] ;

                        $harga_total = $harga_brg*$jml_brg;
                        ?>
                    <td style="text-align: center; font-size: 12px; width: 40px"><?php echo number_format($harga_total); ?></td>

                </tr>
                <?php
                $i++;
                $total = $total + $data['jumlah'];
                $total_rupiah += $harga_total;
            }
            ?>
            </tbody>
        </table>
        <table class="tabel2">
            <tr>
                <td style="text-align: center; width=457px;"><b>Total Barang</b></td>


                <td style="text-align: center; width=34px;"><b><?= $total = $total; ?></b></td>
                <td style="text-align: center; width=40px;"><b>Total Rupiah</b></td>
                <td style="text-align: center; width=50px;"><b><?= number_format($total_rupiah); ?></b></td>
            </tr>
        </table>

    </div>

<!--    <div class="kiri hidden">-->
<!--        <br>-->
<!--        <p>Diketahui :<br>Lurah</p>-->
<!--        <br>-->
<!--        <br>-->
<!--        <br>-->
<!--        <p><b><u>Darsito, S.Sos</u><br>NIK: 196606051986031015</b></p>-->
<!--    </div>-->
<!---->
<!--    <div class="kanan">-->
<!--        <p>Mengetahui :<br>Bendahara Barang</p>-->
<!--        <br>-->
<!--        <br>-->
<!--        <br>-->
<!--        <p><b><u>Suhairi</u><br>NIP: 197705152007011020</b></p>-->
<!--    </div>-->

    <div class="" style="width: 300px; float: right; margin-left: 500px; margin-top: 25px">
        <p>Mengetahui :<br>Bendahara Barang</p>
        <br>
        <br>
        <br>
        <p><b><u>Suhairi</u><br>NIP: 197705152007011020</b></p>
    </div>

    <!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
//  include '../assets/html2pdf/html2pdf.class.php';
include '../assets/html2pdf_backup/html2pdf.class.php';
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('bukti_permintaan_dan_pengeluaran_barang.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>