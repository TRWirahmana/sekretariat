<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php


global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $tanggal = "";
       $page = 1;
    }else{
       $key   = $_REQUEST['key'];
       $tanggal = $_REQUEST['tanggal'];
       $page  = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $tanggal = "";
    $page = 1;
}
$today=date("Y-m-d");
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
//$tomorrow=date("Y-m-d", $tomorrow);
include('include/classpaging.php');
$sql = "SELECT * FROM agenda ";

	if($key!=''){
		$sql .= " WHERE (comite like '%$key%' or acara like '%$key%' or disposisi like '%$key%')";
		if ($tanggal!=''){
		    $sql .= " AND DATE(tanggal)='$tanggal'";
	   }		
	}else{
	  if ($tanggal!=''){
		    $sql .= " WHERE DATE(tanggal)='$tanggal'";
	   }else {
	   $sql .=" WHERE tanggal>='$today'";
	   }	
	}
	
	
	$sql .=" order by tanggal";

	//echo $sql;
	$link = 'index.php?_mod=sekretariat&task=admin_agenda&act=go&key='.$key.'&tanggal='.$tanggal;
	//echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
echo "Cari Jadwal >> </br></br>";


$send_url = "index.php";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $send_url;?>" method="get" name="form">
	<table>
		   <tr><td width="150px">Acara/Komite</td><td><input type="text" name="key" value="<?php echo $key;?>" size="35"/></td></tr>
		   <tr><td width="150px">Tanggal</td>
			<td><input type="text" name="tanggal" value="<?php echo $tanggal;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tanggal'
	});
	</script>
			    
			</td>
			</tr>
			<tr><td><input class="button" type="submit" name="submit" value="Proses"/></td></tr>
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="_mod" value="sekretariat">
			<input type="hidden" name="task" value="admin_agenda">
			<input type="hidden" name="page" value="1">
	</table>
</form>
</td></tr>
</table>
<?php
extract($_POST);
?>
<h2 align="center">Jadwal Kepala Biro</h2>
<?php
echo "<table border=0 width=100%>";?>
<tr><td><input type=button onClick="location.href='index.php?_mod=sekretariat&task=input_agenda&act=new'" value='Tambah Jadwal'></td>
<?php	echo "<td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td align="center" width="3"><b>No</b></td><td align="center" width="5"><b>Hari</b></td><td align="center" width="5"><b>Tanggal</b></td><td align="center" width="12%"><b>Waktu</b></td><td align="center" width="10%"><b>Tempat</b></td><td align="center" width="30%"><b>Acara</b></td><td align="center" width="10"><b>Komite</b></td><td align="center" width="10"><b>Disposisi</b></td><td align="center" width="10"><b>Ket</b></td><td align="center" width="10"><b>-</b></td</tr>
	<?php
	
	$no=$row_perpage*($page-1)+1;
	$hari_awal="";
	while ($row=mysql_fetch_array($rs)){
	    $hari = array( "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu");
		$bulan= array(1=> "Januari", "Februari","Maret","April", "Mei","Juni","Juli","Agustus", "September", "Oktober", "November", "Desember" );
	    //$tgl_agenda=date("d-M-Y", strtotime($row['tanggal']));
		$hr=date("d", strtotime($row['tanggal']));
	    $bln=date("n", strtotime($row['tanggal']));
	    $thn=date("Y", strtotime($row['tanggal']));
	    $nama_bln=$bulan[$bln];
	    $tgl_agenda=$hr."-".$nama_bln."-".$thn;
		$hr=date("w", strtotime($row['tanggal']));
		$nama_hari=$hari[$hr];
		if ($row['tanggal2']!=""){
			//$tgl2=date("d-M-Y", strtotime($row['tanggal2']));
			$hr2=date("d", strtotime($row['tanggal2']));
	        $bln2=date("n", strtotime($row['tanggal2']));
	        $thn2=date("Y", strtotime($row['tanggal2']));
	        $nama_bln2=$bulan[$bln2];
	        $tgl2=$hr2."-".$nama_bln2."-".$thn2;
			$tgl_text=$tgl_agenda."<br>"."s.d"."<br>".$tgl2;
			
			}else{$tgl_text=$tgl_agenda;}
		$jam=substr($row['tanggal'],11,5);
		$waktu=substr($jam,0,2).".".substr($jam,3,2)."-".$row[2];
		if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		 if ($nama_hari!=$hari_awal){
		    
		    echo "<tr bgcolor=$bg><td align=\"center\" valign=\"top\">$no</td><td align=\"left\" valign=\"top\">$nama_hari</td><td align=\"center\" valign=\"top\">$tgl_text</td><td  valign=\"top\">$waktu</td><td valign=\"top\" >$row[3]</td><td valign=\"top\">$row[4]</td><td valign=\"top\">$row[5]</td><td valign=\"top\">$row[6]</td><td valign=\"top\">$row[7]</td>";?>
			<td align="center" valign=\"top\"><a href="index.php?_mod=sekretariat&task=input_agenda&act=edit&id=<?php echo $row[0];?>"><img border=0 src="images/ico_edit_grey.gif"></a>&nbsp;&nbsp;<a href="index.php?_mod=sekretariat&task=delete_agenda&id=<?php echo $row[0];?>" onclick="return confirm('Are you sure you want to delete Schedule No <?php echo $no;?> ?')"><img border=0 src="images/deletegrey.gif"></a></td></tr>	
	<?php  $hari_awal=$nama_hari;
	       $no++;
	     }else{
		   echo "<tr bgcolor=$bg><td align=\"center\" valign=\"top\"></td><td align=\"left\" valign=\"top\"></td><td align=\"center\" valign=\"top\">$tgl_text</td><td  valign=\"top\">$waktu</td><td valign=\"top\" >$row[3]</td><td valign=\"top\">$row[4]</td><td valign=\"top\">$row[5]</td><td valign=\"top\">$row[6]</td><td valign=\"top\">$row[7]</td>";?>
 	       <td align="center" valign=\"top\"><a href="index.php?_mod=sekretariat&task=input_agenda&act=edit&id=<?php echo $row[0];?>"><img border=0 src="images/ico_edit_grey.gif"></a>&nbsp;&nbsp;<a href="index.php?_mod=sekretariat&task=delete_agenda&id=<?php echo $row[0];?>" onclick="return confirm('Are you sure you want to delete Schedule No <?php echo $no;?> ?')"><img border=0 src="images/deletegrey.gif"></a></td></tr>	
		<?php
		
		}
		
	}
	?>
</table>	
