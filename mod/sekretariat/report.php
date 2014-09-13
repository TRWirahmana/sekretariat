<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php

function dit_show($id)
{
  $dit="";
  $sql="select * from surat_masuk where surat_id=$id";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     if($row[7]!=""){
	  $diteruskan=explode("/",$row[7]);;
	  $N = count($diteruskan);
	  for($i=0; $i < $N; $i++)
      {
	  switch ($diteruskan[$i])
      {
       case 1: $dit .="-PUU<BR>";
	   break;
	   case 2: $dit .="-Bankum<BR>";
	   break;
       case 3: $dit .="-Kelembagaan<BR>";
	   break;
	   case 4: $dit .="-Ketatalaksanaan<BR>";
	   break;
	   case 5: $dit .="-Sekretariat<BR>";
        break;
      }
        
      }
	 }
	}
    return $dit;
}
function disp_show($id)
{
  $dis="";
  $sql="select * from surat_masuk where surat_id=$id";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     if($row[8]!=""){
	  $diteruskan=explode("/",$row[8]);;
	  $N = count($diteruskan);
	  for($i=0; $i < $N; $i++)
      {
	   $kode=$diteruskan[$i];
	   $ket="";
	   if ($kode!=""){
	   $sql1="select * from disposisi where kode_disposisi=$kode";
       $query1=mysql_query($sql1);
       if ($row1=mysql_fetch_array($query1)) {
	     $ket=$row1[1];
		 $dis.="-".$ket."<BR>";
        }
		}
      }
	 }
	}
    return $dis;
}
global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $tgl_surat = "";
       $page = 1;
    }else{
       $key       = $_REQUEST['key'];
       $tgl_surat = $_REQUEST['tgl_surat'];
       $page      = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $tgl_surat = "";
    $page = 1;
}
include('include/classpaging.php');
$sql = "SELECT * FROM surat_masuk ";

	if($key!=''){
		$sql .= " WHERE (no_surat like '%$key%' or pengirim like '%$key%' or perihal like '%$key%' or no_agenda like '%$key%' or agenda_sesjen like '%$key%')";
		
	}
	if ($tgl_surat!=''){
	    if($key!=''){
		   $sql .= " AND tgl_surat='$tgl_surat'";
		}else{
		    $sql .= " WHERE tgl_surat='$tgl_surat'";}
	   }
	
	$sql .=" order by surat_id DESC";

	$link = 'index.php?_mod=sekretariat&task=report&act=go&key='.$key.'&tgl_surat='.$tgl_surat;
	//echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
echo "Cari Surat Masuk >> </br></br>";

//if ($key=="" && $tgl_surat==""){
$send_url = "index.php";
/*}else{
	$send_url = 'index.php?_mod=sekretariat&task=report&act=go&key='.$key.'&tgl_surat='.$tgl_surat;
	}*/
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $send_url;?>" method="get" name="form">
	<table>
		   <tr><td width="150px">Perihal/Nomor Agenda/No surat/Pengirim</td><td><input type="text" name="key" value="<?php echo $key;?>" size="35"/></td></tr>
		   <tr><td width="150px">Tanggal Surat</td>
			<td><input type="text" name="tgl_surat" value="<?php echo $tgl_surat;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_surat'
	});
	</script>
			    
			</td>
			</tr>
			<tr><td><input class="button" type="submit" name="submit" value="Proses"/></td></tr>
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="_mod" value="sekretariat">
			<input type="hidden" name="task" value="report">
			<input type="hidden" name="page" value="1">
	</table>
</form>
</td></tr>
</table>
<?php
extract($_POST);

?>
<h2 align="center">DAFTAR SURAT MASUK</h2><?php
echo "<table border=0 width=100%>";
	echo "<td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td align="center" valign="top" width="3"><b>No</b></td><td align="center" valign="top" width="5"><b>No. Agenda TU</b></td><td align="center" valign="top" width="5"><b>No. Agenda KHO</b></td><td align="center" valign="top" width="15%"><b>No. Surat</b></td><td align="center" valign="top" width="10"><b>Tgl Surat</b></td><td align="center" valign="top" width="10%"><b>Pengirim</b></td><td align="center" valign="top" width="53%"><b>Perihal</b></td><td align="center" valign="top" width="10"><b>Tgl Diterima</b></td><td align="center" valign="top" width="10"><b>-</b></td></tr>
	<?php

	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){	
        $no_srt_masuk=$row['no_surat'];
	    if ($row['tgl_surat']==NULL){
		   $tgl_srt="";
		}else{
		   $tgl_srt=date("d-M-Y", strtotime($row['tgl_surat']));
		}
		$tgl_terima=date("d-M-Y", strtotime($row['date_insert']));
		if ($row['tgl_selesai']==NULL){
		    $tgl_selesai="";
		}else{
		   $tgl_selesai=date("d-M-Y", strtotime($row['tgl_selesai']));
		}
		$tgl_terima=date("d-M-Y", strtotime($row['tgl_terima']));
		if ($row[12]==0){$bg="#99CCFF";} else {$bg="#CCCCCC";}
		if ($row[12]==0){$imgdoc="images/docblue.gif";} else {$imgdoc="images/doc1.gif";}
		echo "<tr bgcolor=$bg><td align=\"center\" valign=\"top\">$no</td><td align=\"center\" valign=\"top\">$row[2]</td><td align=\"center\" valign=\"top\">$row[1]</td><td align=\"left\" valign=\"top\">$no_srt_masuk</td><td valign=\"top\">$tgl_srt</td><td valign=\"top\">$row[5]</td><td valign=\"top\">$row[6]</td><td valign=\"top\">$tgl_terima</td>";?>
		<td valign="top"><a href="index.php?_mod=sekretariat&task=detail&id=<?php echo $row[0];?>" title="detail"><img border=0 src="<?php echo $imgdoc;?>"</a></td>
	    </tr>	
		<?php
		$no++;
	}
	?>
</table>	