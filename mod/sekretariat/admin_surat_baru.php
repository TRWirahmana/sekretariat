<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
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
$sql = "SELECT * FROM surat_masuk WHERE status=0";

	if($key!=''){
		$sql .= " AND (no_surat like '%$key%' or perihal like '%$key%' or no_agenda like '%$key%')";
		
	}
	if ($tgl_surat!=''){
		    $sql .= " AND tgl_surat='$tgl_surat'";
	   }
	
	$sql .=" order by surat_id DESC";

	$link = 'index.php?_mod=sekretariat&task=admin_surat_baru&act=go&key='.$key.'&tgl_surat='.$tgl_surat;
	//echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
echo "Cari Surat Masuk >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=admin_surat_baru";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="index.php" method="get" name="form">
	<table>
		   <tr><td width="150px">Perihal/Nomor Agenda/No surat/Tanggal</td><td><input type="text" name="key" value="" size="35"/></td></tr>
		   <tr><td width="150px">Tanggal Surat</td>
			<td><input type="text" name="tgl_surat" id="date" value="" size="10"/> <script language="JavaScript">
                    $(function(){
                        $('#date').datepicker({
                            inline:true,
                            showOtherMonths: true,
                            altField: "#date",
                            altFormat: "yy-mm-dd",
                            dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                            onSelect: function(dateText){
                                $('#date').html(dateText);
                            }
                        });
                    });
                </script>
			    
			</td>
			</tr>
			<tr><td><input class="button" type="submit" name="submit" value="Proses"/></td></tr>
			<input type="hidden" name="_mod" value="sekretariat">
			<input type="hidden" name="task" value="admin_surat">
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="page" value="1">
			
	</table>
</form>
</td></tr>
</table>
<?php
//extract($_POST);
?>
<h2 align="center">DAFTAR SURAT BELUM DIDISPOSISI</h2><?php
echo "<table border=0 width=100%>";
	echo "<td><input type=button onClick=\"location.href='index.php?_mod=sekretariat&task=input_surat&act=new'\" value='Input Surat Baru'> </td><td align=right>";
	if ($jml!=0){
	//echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
	<table class=table cellpadding=2 cellspacing=5 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3">
        <td class="table-menu" align="center"  valign="top" width="2%"><b>No</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Agenda KHO</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Agenda TU</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Surat</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Tgl Surat</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Pengirim</b></td>
        <td class="table-menu" align="center"  valign="top" width="25%"><b>Hal</b></td>
        <td class="table-menu"align="center"  valign="top" width="10%"><b>Tgl Diterima</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Aksi</b></td>
    </tr>

	<?php
	
	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){
	   if ($row['agenda_sesjen']!=""){
	  $no_srt_masuk="-".$row[3]."<BR>-".$row[13];
	}else{
	$no_srt_masuk=$row[3];
	}
        if ($row['tgl_surat']!=""){
	   $tgl_srt=date("d-M-Y", strtotime($row['tgl_surat']));
	}else{
	   $tgl_srt="";
	}

	       //$tgl_srt=date("d-M-Y", strtotime($row['tgl_surat']));
		$tgl_terima=date("d-M-Y", strtotime($row['date_insert']));
		$tgl_selesai=date("d-M-Y", strtotime($row['tgl_selesai']));
		$tgl_terima=date("d-M-Y", strtotime($row['tgl_terima']));
		if ($row[12]==0){$bg="#99CCFF";} else {$bg="#CCCCCC";}
		if ($row[12]==0){$imgdoc="images/docblue.gif";} else {$imgdoc="images/doc1.gif";}
		if ($row[12]==0){$imgedit="images/ico.edit.blue.gif";} else {$imgedit="images/ico_edit_grey.gif";}
		echo "
		<tr bgcolor=$bg>
		    <td align=\"center\" valign=\"top\"><p>$no</p></td>
		    <td align=\"center\" valign=\"top\"><p>$row[1]</p></td>
		    <td align=\"center\" valign=\"top\"><p>$row[2]</p></td>
		    <td align=\"left\" valign=\"top\"><p>$row[4]</p></td>
		    <td valign=\"top\"><p>$tgl_srt</p></td>
		    <td valign=\"top\"><p>$row[5]</p></td>
		    <td valign=\"top\"><p>$row[6]</p></td>
		    <td valign=\"top\"><p>$tgl_terima</p></td>";?>
		<td valign="top"><a href="index.php?_mod=sekretariat&task=detail&id=<?php echo $row[0];?>" title="detail surat"><img border=0 src="<?php echo $imgdoc;?>"></a>&nbsp;<a href="index.php?_mod=sekretariat&task=input_surat&act=edit&id=<?php echo $row[0];?>" title="edit"><img border=0 src="<?php echo $imgedit;?>"</a></td>
	</tr>	
		<?php
		$no++;
	}
	?>
</table>
 
	