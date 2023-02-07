<?php 

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

ob_start(); 
$id  = isset($_GET['id']) ? $_GET['id'] : false;


$unit = $_GET['unit'];
$tgl= $_GET['tgl'];

?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  

</style>
<!-- Setting Margin header/ kop -->
<!-- Setting CSS Tabel data yang akan ditampilkan -->
<style type="text/css">
 .tabel2 {
  border-collapse: collapse;
  margin-left: 5px;
}
.tabel2 th, .tabel2 td {
  padding: 5px 5px;
  border: 1px solid #000;
}
div.kanan {
 width:300px;
 float:right;
 margin-left:210px;
 margin-top:-235px;
}

div.kiri {
 width:300px;
 float:left;
 margin-left:30px;
 display:inline;
}

</style>
<table>
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
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>FORM PENGAJUAN BARANG</u></p>
  <div class="isi" style="margin: 0 auto;">
    <p style="color: black; text-align: left;">Permintaan Pembelian Barang  <br>Pada Tanggal : <b> <?=  tanggal_indo($tgl); ?> </b></p>
    <table class="tabel2">
      <thead>
        <tr>
          <td style="text-align: center; width=10px;"><b>No.</b></td>        
          <td style="text-align: center; width=90px;"><b>Kode Barang</b></td>
          <td style="text-align: center; width=150px;"><b>Nama Barang</b></td>
          <td style="text-align: center; width=50px;"><b>Satuan</b></td>
          <td style="text-align: center; width=50px;"><b>Jumlah</b></td> 
          <td style="text-align: center; width=90px;"><b>Harga Barang</b></td>
          <td style="text-align: center; width=70px;"><b>Total</b></td>                                        
        </tr>
      </thead>
      <tbody>
        <?php


        $query = mysqli_query($koneksi, "SELECT  pengajuan.kode_brg, nama_brg, pengajuan.jumlah,pengajuan.satuan, pengajuan.hargabarang, pengajuan.total, tgl_pengajuan FROM pengajuan INNER JOIN stokbarang ON pengajuan.kode_brg = stokbarang.kode_brg  WHERE tgl_pengajuan='$tgl' "); 

        $i   = 1; 
        while($data=mysqli_fetch_array($query))
        {
          ?>

          <tr>
            <td style="text-align: center; font-size: 12px;"><?php echo $i; ?></td>             
            <td style="text-align: center; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
            <td style="text-align: left; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>
            <td style="text-align: center; font-size: 12px;"><?php echo $data['satuan']; ?></td>
            <td style="text-align: center; font-size: 12px;"><?php echo $data['jumlah']; ?></td>
            <td style="text-align: center; font-size: 12px;"><?php echo number_format($data['hargabarang']); ?></td>
            <td style="text-align: center; font-size: 12px;"><?php echo number_format($data['total']); ?></td>

          </tr>
          <?php
          $i++;

        }
        ?>
      </tbody>
      <?php 

      $query2 = mysqli_query($koneksi, "SELECT SUM(jumlah), SUM(hargabarang), SUM(total) FROM pengajuan WHERE unit='$unit' AND tgl_pengajuan='$tgl' ");  
      $data2 = mysqli_fetch_assoc($query2);

      ?>
    </table>
  </div>
  <table class="tabel2">
    <tr>
      <td style="text-align: center; width=369px;"><b>Sub Total</b></td>  
      <td style="text-align: center; width=50px;"><b><?= number_format($data2['SUM(jumlah)']); ?></b></td>       
      <td style="text-align: center; width=90px;"><b>Rp.<?= number_format($data2['SUM(hargabarang)']); ?>.-</b></td> 
      <td style="text-align: center; width=70px;"><b>Rp.<?= number_format($data2['SUM(total)']); ?>.-</b></td>                                        
    </tr>
  </table>




  <div class="kiri">
    <p> </p>
<!--    <p>Diminta Oleh :<br>Bendahara  </p>-->
    <p>Diminta Oleh :<br>Pembantu Pengelola Aset  </p>
    <p></p>
    <p></p>
<!--    <b><p><u>Siti Rusdah </u><br>NIK: 198507122010012039</p></b>-->
    <b><p><u>Ulfatisa Cahyani, S.Kom.</u><br>NIP: 199505242022032019</p></b>
    <br>
    <br>
    <br>


  </div>



  <div class="kanan">
    <p></p>
<!--    <p>Disetujui Oleh :<br>Lurah </p>-->
<!--    <p>Disetujui Oleh :<br>Yg Menyetujui </p>-->
    <p>Disetujui Oleh :<br>Kabag Tata Usaha </p>
    <p></p>
    <p> </p>       
<!--    <b><p><u>Darsito, S.Sos </u><br>NIK: 196606051986031015</p></b>-->
<!--    <b><p><u>Nama </u><br>NIP: ..........</p></b>-->
    <b><p><u>Tutik Kurniawati, S.E. </u><br>NIP: 197702232000032004</p></b>
    <br>
    <br>
    <br>

  </div>

  <!-- Memanggil fungsi bawaan HTML2PDF -->
  <?php
  $content = ob_get_clean();
  include '../assets/html2pdf_backup/html2pdf.class.php';
  try
  {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('bukti_permintaan_dan_pengeluaran_barang.pdf');
  }
  catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
  }
  ?>