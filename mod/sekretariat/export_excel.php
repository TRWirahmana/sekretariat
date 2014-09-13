<?
session_start();
include("../../module/mod.config.php");
include("../../module/mod.global.php");

$filename="surat_masuk";
////////////////////////////////////////////////////////////////
header ("Content-Type: application/vnd.ms-excel"); 
header ("Content-Disposition: inline, filename=".$filename.".xls"); 
header ("Pragma: no-cache"); 
header ("Expires: 0"); 
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0"); 


?>


<table border="1" cellpadding="2" cellspacing="0">
 <tr><td></td></tr>
  <tr><td></td></tr>

  <tr>
  <td align="center" bgcolor="#ffff99"><strong>No Agenda</strong></td>
  <td align="center" bgcolor="#ffff99"><strong>Tanggal Surat</strong></td>
  <td align="center" bgcolor="#ccffff"><strong>No Surat</strong></td>
  <td align="center" bgcolor="#ffff99"><strong>Perihal</strong></td>
  <td align="center" bgcolor="#ccffff"><strong>Diteruskan (1)</strong></td>
  <td align="center" bgcolor="#ccffff"><strong>Tanggal Masuk</strong></td>
  <td align="center" bgcolor="#ccffff"><strong>Diteruskan (2)</strong></td> 
  <td align="center" bgcolor="#ccffff"><strong>Disposisi</strong></td>
  <td align="center" bgcolor="#ccffff"><strong>Tanggal Selesai</strong></td>
  <td align="center" bgcolor="#ffff99"><strong>Keterangan</strong></td>
  </tr>  
   
  	<?
        $query=mysql_query("SELECT * from surat_masuk");
		
		while($rup=mysql_fetch_array($query))
		{
		
		$mf = $rup['ps_mf'];
		$mf_value = str_split($mf);
		$tgl=$rup['ps_test_tanggal'];
		$tgg=date("j/m/Y",strtotime($rup['ps_test_tanggal']));
		//echo $tgg
		$tgl1=explode("/",$tgg);
		$hr=$tgl1[0];
		$bulan=$tgl1[1];
		$thn=$tgl1[2];
		$bln=getBulanName($bulan);
		
		?>
		<tr>
		  <td ><?=$rup['no_agenda']?></td>
		  <td ><?=str_replace("^","'",$rup['ps_peserta_nama'])?></td>
		  <td ><?=$hr?>&nbsp;<?=$bln?>&nbsp;<?=$thn?></td>
		  <td ><?=$rup['ps_test_kota']?></td>
		  <td ><?=$rup['ps_assesor_nama']?></td>
		  <td ><?=getPosisiName($rup['ps_proyeksi_jabatan'])?></td>
		  <td ><?=$rup['ps_bidang_studi']?></td>
		  <td ><?=$mf_value[0]?></td>
		  <td ><?=$mf_value[1]?></td>
		  <td ><?=$mf_value[2]?></td>
		  <td ><?=$mf_value[3]?></td>
		  <td ><?=$mf_value[4]?></td>
		  <td ><?=$mf_value[5]?></td>
		  <td ><?=$mf_value[6]?></td>
		  <td ><?=$mf_value[7]?></td>
		  <td ><?=$mf_value[8]?></td>
		  <td ><?=$rup['ps_mf_add']?></td>
		    <?	 
			  $skompt=mysql_query("SELECT distinct(kompetensi_id), psk_level from t_project_source_kompetensi where project_id = ".$_GET['project_id']." and ps_id = ".$rup['ps_id']."");
			  //echo $skompt;
			  while($r_skompt=mysql_fetch_array($skompt))
			  {	
		  ?>
		<td align="center"><?=$r_skompt['psk_level']?></td>			
		  <?  }?>
		  <td ><?=$rup['ps_eit']?></td>		  
	 <?	 
			  $skompt=mysql_query("SELECT distinct(kompetensi_id), psk_level from t_project_source_kompetensi where project_id = ".$_GET['project_id']." and ps_id = ".$rup['ps_id']."");
			  //echo $skompt;
			  while($r_skompt=mysql_fetch_array($skompt))
			  {	
		  ?>
		<td align="center"><?=$r_skompt['psk_level']?></td>			
		  <?  }?>
		  <td ><?=$rup['ps_iq']?></td>
	
	</tr>
  <?	}
  ?>
</table>
