<?php


global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $tgl_surat = "";
       $page = 1;
    }else{
       $key   = $_REQUEST['key'];
       $tgl_surat = $_REQUEST['tgl_surat'];
       $page  = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $tgl_surat = "";
    $page = 1;
}
include('include/classpaging.php');
$sql = "SELECT * FROM surat_keluar ";

	if($key!=''){
		$sql .= " WHERE (no_surat like '%$key%' or kode_hal IN (select kode_hal from kode_hal where hal_desc like '%$key%' ) or pemroses IN (select kode_bagian from kode_bagian where nama_bagian like '%$key%' ) or tujuan_surat like '%$key%' or perihal like '%$key%')";
		
	}
	if ($tgl_surat!=''){
		    $sql .= " AND tgl_surat='$tgl_surat'";
	   }
	
	$sql .=" order by surat_keluar_id DESC";

	$link = 'index.php?_mod=administrasi&task=admin_surat_keluar&act=go&key='.$key.'&tgl_surat='.$tgl_surat;
	//echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();

echo "<table border=0 width=100%>";?>
<tr><td><a href="http://localhost/administrasi/index.php?_mod=administrasi&task=input_print_stock"><img border=0 src="images/excel_ico_vert.jpg"
</a></td>
<?php	echo "<td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td align="center" width="3"><b>No</b></td><td align="center" width="15%"><b>No. Surat</b></td><td align="center" width="10"><b>Tgl Surat</b></td><td align="center" width="10"><b>Asal Surat</b></td><td align="center" width="10"><b>Tujuan Surat</b></td><td align="center" width="45%"><b>Perihal</b></td><td align="center" width="10"><b>Sifat Surat</b></td><td align="center" width="40"><b>-</b></td></tr>
	<?php
	
	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){
	    $tgl_srt=date("j-n-Y", strtotime($row['tanggal_surat']));
		$tgl_input=date("j-n-Y", strtotime($row['date_insert']));
		$asal_surat=$row['pemroses'];
		switch ($asal_surat) {
			case 1: $pemroses="Bagian Peraturan Perundang-undangan";
			     break;
			case 2: $pemroses="Bagian Bantuan Hukum";
			     break;
			case 3: $pemroses="Bagian Kelembagaan";
			     break;
			case 4: $pemroses="Bagian Ketatalaksanaan";
			     break;   
       }
		
		//$tgl_selesai=date("d-M-Y", strtotime($row['tgl_selesai']));
		if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		echo "<tr bgcolor=$bg><td align=\"center\">$no</td><td align=\"center\" valign=\"middle\">$row[2]</td><td >$tgl_srt</td><td >$pemroses</td><td align=\"left\">$row[6]</td><td>$row[8]</td><td>$row[9]</td>";?>
		<td><a href="index.php?_mod=administrasi&task=input_surat_keluar&act=edit&id=<?php echo $row[0];?>">Edit |</a><a href="index.php?_mod=administrasi&task=delete_surat_keluar&id=<?php echo $row[0];?>" onclick="return confirm('Anda yakin akan menghapus <?php echo $row[1];?> ?')">Hapus</a></td>
	</tr>	
		<?php
		$no++;
	}
	?>
</table>	
<table>	
<tr><td><input type=button onClick="location.href='index.php?_mod=administrasi&task=input_surat_keluar&act=new'" value='Tambah Baru'> </td></tr>
</table>	