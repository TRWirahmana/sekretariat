<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php

global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $tgl_terima = "";
       $page = 1;
    }else{
       $key   = $_REQUEST['key'];
       $tgl_terima = $_REQUEST['tgl_terima'];
       $page  = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $tgl_terima = "";
    $page = 1;
}
include('include/classpaging.php');
$sql = "SELECT * FROM undangan ";

	if($key!=''){
		$sql .= " WHERE (no_undangan like '%$key%' or acara like '%$key%' or agenda_und like '%$key%' or komite like '%$key%')";
		
	}
	if ($tgl_terima!=''){
	    if($key!=''){
		   $sql .= " AND tgl_terima='$tgl_terima'";
		}else{
		    $sql .= " WHERE tgl_terima='$tgl_terima'";}
	   }
	
	$sql .=" order by undangan_id DESC";

	$link = 'index.php?_mod=sekretariat&task=admin_undangan&act=go&key='.$key.'&tgl_terima='.$tgl_terima;
	echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
echo "Cari Undangan >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=admin_undangan";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="index.php" method="get" name="form">
	<table>
		   <tr><td width="150px">Acara/Nomor Agenda/No Undangan</td><td><input type="text" name="key" value="" size="35"/></td></tr>
		   <tr><td width="150px">Tanggal Terima</td>
			<td><input type="text" name="tgl_terima" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_terima'
	});
	</script>
			    
			</td>
			</tr>
			<tr><td><input class="button" type="submit" name="submit" value="Proses"/></td></tr>
			<input type="hidden" name="_mod" value="sekretariat">
			<input type="hidden" name="task" value="admin_undangan">
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="page" value="1">
			
	</table>
</form>
</td></tr>
</table>
<?php
//extract($_POST);
?>
<h2 align="center">DAFTAR UNDANGAN</h2>
<?php
echo "<table border=0 width=100%>";
	echo "<td><input type=button onClick=\"location.href='index.php?_mod=sekretariat&task=input_undangan&act=new'\" value='Input Undangan Baru'> </td><td align=right>";
	if ($jml!=0){
	//echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
<table class=table cellpadding=2 cellspacing=1 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3">
        <td class="table-menu" align="center"  valign="top" width="2%"><b>No</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Agenda</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Undangan</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Tanggal Acara</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>Waktu</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Tempat</b></td>
        <td class="table-menu" align="center"  valign="top" width="25%"><b>Acara</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>Komite</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Disposisi</b></td>
        <td class="table-menu" align="center"  valign="top" width="15%"><b>Ket</b></td>
        <td class="table-menu" align="center"  valign="top" width="13%"><b>Aksi</b></td>
    </tr>
<?php
$no=$row_perpage*($page-1)+1;
	$hari_awal="";
	while ($row=mysql_fetch_array($rs)){
	    $hari = array( "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu");
		$bulan= array(1=> "Jan", "Feb","Mar","Apr", "Mei","Juni","Juli","Ags", "Sept", "Okt", "Nov", "Des" );
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
              if ($jam=="00:00"){
                  $waktu="";
                  }else{
          		$waktu=substr($jam,0,2).".".substr($jam,3,2)."-".$row[7];
                  }
              $today=date("Y-m-d");
              $test="";
              if ($row['tanggal']<$today){ $bg="#99CCFF";} else {$bg="#CCCCCC";}
		if ($row['tanggal']<$today){$imgdoc="images/docblue.gif";} else {$imgdoc="images/doc1.gif";}
		if ($row['tanggal']<$today){$imgedit="images/ico.edit.blue.gif";} else {$imgedit="images/ico_edit_grey.gif";}

		if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		 $imgdoc="images/doc1.gif";
		 $imgedit="images/ico_edit_grey.gif";		    
		    echo "
		    <tr bgcolor=$bg>
		        <td align=\"center\" valign=\"top\"><p>$no</p></td>
		        <td align=\"left\" valign=\"top\"><p>$row[1]</p></td>
		        <td valign=\"top\"><p>$row[3]</p></td>
		        <td align=\"center\" valign=\"top\"><p>$tgl_text</p></td>
		        <td valign=\"top\"><p>$waktu</p></td>
		        <td valign=\"top\"><p>$row[8]</p></td>
		        <td align=\"top\">$row[9]</td>
		        <td valign=\"top\"><p>$row[10]</p></td>
		        <td valign=\"top\"><p>$row[11]</p></td>
		        <td valign=\"top\">$row[12]</td>";?>
	            <td valign="top">
                    <a href="index.php?_mod=sekretariat&task=detail_undangan&id=<?php echo $row[0];?>" title="detail undangan"><img border=0 src="<?php echo $imgdoc;?>"></a>&nbsp;<a href="index.php?_mod=sekretariat&task=input_undangan&act=edit&id=<?php echo $row[0];?>" title="edit"><img border=0 src="<?php echo $imgedit;?>"</a></td>
	        </tr>
		<?php
		$no++;
	}

	?>

	
</table>