<?php
$conn = mysql_connect("localhost","root",""); 
$db=mysql_select_db("sekretariat");
$bulan= array(1=> "Januari", "Februari","Maret","April", "Mei","Juni","Juli","Agustus", "September", "Oktober", "November", "Desember" );

     $id=$_REQUEST["id"];
$sql="select * from surat_masuk where surat_id=$id";
$result=mysql_query($sql);
if ($row=mysql_fetch_array($result)){
   $no_agenda=$row[1];
   $agenda_tu=$row[2];
   if ($row['tgl_surat']==NULL){
     $tgl_surat="";
   }else{
     //$tgl_surat=date("d-M-Y", strtotime($row['tgl_surat']));
	 $hr=date("d", strtotime($row['tgl_surat']));
	 $bln=date("n", strtotime($row['tgl_surat']));
	 $thn=date("Y", strtotime($row['tgl_surat']));
	 $nama_bln=$bulan[$bln];
	 $tgl_surat=$hr."-".$nama_bln."-".$thn;
	 }
   $no_surat=$row[4];
   $pengirim=$row[5];
   $perihal=$row[6];
   //$tgl_diterima=date("d-M-Y", strtotime($row['tgl_terima']));
   	 $hr1=date("d", strtotime($row['tgl_terima']));
	 $bln1=date("n", strtotime($row['tgl_terima']));
	 $thn1=date("Y", strtotime($row['tgl_terima']));
	 $nama_bln1=$bulan[$bln1];
	 $tgl_diterima=$hr1."-".$nama_bln1."-".$thn1;
}
$rhs="Rahasia";
$spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//echo $no_agenda;
$data="coba";
//echo $data;
$table1 = "
<table border=1 align=center >
<tr  > 
    <td colspan=4 align=center border=0><b>LEMBAR DISPOSISI</b></td>
  </tr>
  <tr> 
    <td height=15 colspan=4 align=center border=0><b>BIRO HUKUM DAN ORGANISASI</b></td>
  </tr>

  <tr> 
    <td colspan=4 align=right border=0></td>
   </tr>
  <tr> 
    <td colspan=4 valign=middle><b>Nomor Agenda   : </b>".$no_agenda."</td>
   </tr>
  <tr> 
    <td colspan=4 valign=middle><i>Tanggal Terima : </i>".$tgl_diterima."</td>
  </tr>
 
  <tr> 
    <td colspan=2 valign=middle>Tanggal Surat : ".$tgl_surat."</td>
    <td colspan=2>Nomor Surat : ".$no_surat."</td>
  </tr>
  <tr> 
    <td colspan=4 valign=middle>Asal Surat : ".$pengirim."</td>
  </tr>
   <tr> 
    <td colspan=4 heihgt=25 valign=middle>Hal :<br> ".$perihal."</td>
  </tr>
  <tr> 
    <td colspan=4>Diteruskan Kepada :</td>
  </tr>
  <tr> 
    <td height=15 width=7 valign=middle>1.</td>
    <td  width=85 valign=middle>Kepala Bagian Peraturan Perundang-undangan</td>
    <td> </td>
	<td rowspan=5 width=75>a. Ikuti disposisi menteri/Wamen/Sesjen<br><img src='images/kotak.jpg'>Proses sesuai prosedur<br>c. Tindak lanjuti/selesaikan<br>d. Tanggapan/saran tertulis
	<br>e. Pelajari/pertimbangkan<br>f. Hadiri/wakili/jadwalkan<br>g. Siapkan bahan/buatkan konsep<br>h. Untuk diketahui<br>i. Koordinasikan<br>j. Arsip<br>k. Temui saya</td>
  </tr>
  <tr> 
    <td height=15 valign=middle>2.</td>
    <td valign=middle>Kepala Bagian Bantuan Hukum</td>
    <td> </td>
  </tr>
  <tr> 
    <td height=15 valign=middle>3.</td>
    <td valign=middle>Kepala Bagian Kelembagaan</td>
    <td width=8>".$spasi." </td>
  </tr>
  <tr> 
    <td height=15 valign=middle>4.</td>
    <td valign=middle>Kepala Bagian Ketatalaksanaan</td>
    <td> </td>
  </tr>
  <tr> 
    <td height=15 valign=middle>5.</td>
    <td valign=middle>Sekretariat</td>
    <td> </td>
  </tr>
  <tr> 
    <td height=25 colspan=4>Keterangan:</td>
  </tr>
    <tr> 
    <td colspan=3 align=right border=0>".$spasi." </td><td align=left border=0><b>Jakarta ,....................................... 2013</b></td>
  </tr>
    </tr>
    <tr> 
    <td colspan=3 align=right border=0>".$spasi." </td><td height=25 align=left border=0><b>Kepala Biro Hukum dan Organisasi</b></td>
  </tr>
  </tr>
    <tr> 
    <td colspan=3 align=right border=0>".$spasi." </td><td border=0><b>Muslikh S.H</b></td>
  </tr>
  </tr>
    <tr> 
    <td colspan=3 align=rght border=0>".$spasi." </td><td border=0><b>NIP 195809151985031001</b></td>
  </tr>
</table>
";
define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');
$p = new PDFTable();
$p->AddPage();
$p->SetMargins(1,1,1,1);
$p->setfont('arial','',11);
$p->htmltable($table1);
$p->output();
?>