<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php


global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $page = 1;
    }else{
       $key   = $_REQUEST['key'];
       $page  = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $page = 1;
}
include('include/classpaging.php');
$sql = "SELECT * FROM dokumen WHERE status=0";

	if($key!=''){
		$sql .= " AND (nama_dokumen like '%$key%')";
		
	}
	
	
	$sql .=" order by dokumen_id DESC";

	$link = 'index.php?_mod=sekretariat&task=admin_dokumen_baru&act=go&key='.$key;
	//echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
echo "Cari Surat Masuk >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=admin_surat";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $send_url;?>" method="post" name="form">
	<table>
		   <tr><td width="150px">Nama Dokumen</td><td><input type="text" name="key" value="" size="35"/></td></tr>
			<tr><td><input class="button" type="submit" name="submit" value="Proses"/></td></tr>
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="page" value="1">
	</table>
</form>
</td></tr>
</table>
<?php
extract($_POST);
?>

<h2 align="center">DAFTAR DOKUMEN YANG DIPROSES</h2><?php

echo "<table border=0 width=100%>";
	echo "<td><input type=button onClick=\"location.href='index.php?_mod=sekretariat&task=input_dokumen&act=new'\" value='Add New'> </td><td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td align="center" width="3"><b>No</b></td><td align="center" width="5"><b>Tanggal</b></td><td align="center" width="40%"><b>Nama Dokumen</b></td><td align="center" width="10"><b>Yang Menyerahkan</b></td><td align="center" width="10"><b>Keperluan</b></td><td align="center" width="20"><b>Tujuan Dokumen</b></td><td align="center" width="10%"><b>Tanggal Diserahkan (dari Karo)</b></td><td align="center" width="13%"><b>Penerima</b></td><td align="center" width="13%"><b>Ket</b></td><td align="center" width="40"><b>-</b></td></tr>
	<?php
	
	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){
	     $tgl_msk=date("d-M-Y", strtotime($row['tgl_masuk']));
		 if ($row['tgl_keluar']==NULL){
		    $tgl_keluar="";
		 }else{
		$tgl_keluar=date("d-M-Y", strtotime($row['tgl_keluar']));
		}
		switch ($row['keperluan']) {
    case 1:
        $keperluan="Tanda Tangan Karo";
        break;
    case 2:
        $keperluan="Paraf Karo";
        break;
    case 3:
       $keperluan="Tanda Tangan & Paraf Karo";
        break;
}
		if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		echo "<tr bgcolor=$bg><td align=\"center\"valign=\"top\">$no</td><td align=\"center\" valign=\"top\">$tgl_msk</td><td align=\"left\" valign=\"top\">$row[2]</td><td valign=\"top\">$row[3]</td><td valign=\"top\">$keperluan</td><td valign=\"top\">$row[5]</td><td valign=\"top\">$tgl_keluar</td><td valign=\"top\">$row[7]</td><td valign=\"top\">$row[8]</td>";?>
		<td valign=\"top\"><a href="index.php?_mod=sekretariat&task=input_dokumen&act=edit&id=<?php echo $row[0];?>">Edit |</a><a href="index.php?_mod=sekretariat&task=delete_dokumen&id=<?php echo $row[0];?>" onclick="return confirm('Are you sure you want to delete <?php echo $row[1];?> ?')">Delete</a></td>
	</tr>	
		<?php
		$no++;
	}
	?>
</table>	
	