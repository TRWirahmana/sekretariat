<link rel="stylesheet" type="text/css" href="style.css">
<?php
//session_start();
function getJenis($jenis_id){
  $sql="select nama_peraturan from jenis_peraturan where jenis_id=$jenis_id";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res)){
    return $row[0];
  }else return "#NA";
}
function getFileId($peraturan_id){
  $sql="select file_id from file_dokumen where peraturan_id=$peraturan_id";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res)){
    return $row[0];
  }else return "#NA";
}

global $key,$key_word;
 if ($_REQUEST['act']=="new"){
   $key   = "";
   $jenis = "0";
   $page = 1;
}else{
    $key   = $_REQUEST['key'];
    $jenis = $_REQUEST['jenis'];
    $page  = $_REQUEST['page'];
	}
include('include/classpaging.php');
$sql = "SELECT * FROM peraturan ";

	if($key!='' || $jenis!=0){
		$sql .= " WHERE";
	 }	 
	if($key!=''){
		$sql .= " (no_peraturan like '%$key%' or tentang like '%$key%')";
		if ($jenis!=0){
		    $sql .= " and jenis_id=$jenis";
		}else{
		    $sql .= " AND jenis_id BETWEEN 1 AND 2";
		}
	}else{
	if ($jenis!=0){
		    $sql .= " jenis_id=$jenis";
	   }else{
		    $sql .= " WHERE jenis_id BETWEEN 1 AND 2";
		}
	}
	
	$sql .=" order by peraturan_id";
     
	 //echo $sql;
	$link = 'index.php?_mod=peraturan&task=admin_perturan&act=go&key='.$key.'&jenis='.$jenis;
	//echo $page;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
echo "Cari Peraturan >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=admin_peraturan";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $send_url;?>" method="post" name="form">
	<table>
		   <tr><td width="150px">Tentang/Nomor/Tanggal</td><td><input type="text" name="key" value="<?php echo $key;?>" size="35"/></td></tr>
		   <tr><td width="150px">Jenis Peraturan</td>
			<td><select name="jenis" value="" >			
			<?php
			echo '<option value="0">Semua</option>';
			$sql1="select * from jenis_peraturan";
			$qup = mysql_query($sql1);
			for ($i=0;$i<mysql_num_rows($qup);$i++){
				$rup = mysql_fetch_array($qup);		
				if ($rup[0]==$jenis){
                    echo '<option value="'.$rup[0].'" selected>'.$rup[1].'</option>';					
				}else{
				echo '<option value="'.$rup[0].'">'.$rup[1].'</option>';						  
				}
				}?> </select>
			    
			</td>
			</tr>
			<tr><td><input class="button" type="submit" name="submit" value="Cari"/></td></tr>
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="page" value="1">
	</table>
</form>
</td></tr>
</table>
<?php
extract($_POST);

?>
<h2 align="center">DAFTAR PERATURAN</h2><?php
echo "<table border=0 width=100%>";
	echo "<td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td align="center" width="3"><b>No</b></td><td align="center" width="5"><b>Tanggal Peraturan</b></td><td align="center" width="10"><b>Jenis Peraturan</b></td><td align="center" width="10"><b>Nomor Peraturan</b></td><td align="center" width="53%"><b>Tentang</b></td><td align="center" width="3">-</td><td align="center" width="10%"><b>Action</b></td></tr>
	<?php
	
	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){
	    $tgl=date("d-M-Y", strtotime($row['tanggal']));
		$tgl_terima=date("d-M-Y", strtotime($row['tanggal_diterima']));
		$tgl_selesai=date("d-M-Y", strtotime($row['tanggal_distribusi']));
		if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		echo "<tr bgcolor=$bg><td align=\"center\">$no</td><td align=\"center\">$tgl</td><td >".getJenis($row[2])."</td><td align=\"center\">$row[3]</td><td>$row[4]</td>";?>
		
		<td align="center"><a target='_blank' href="download.php?id=<?php echo getFileId($row[0]);?>"><img border=0 src="images/doc.gif"
</a></td>
<td align="center"><a href="index.php?_mod=peraturan&task=edit_peraturan&id=<?php echo $row[0];?>">Edit |</a><a href="index.php?_mod=peraturan&task=delete_peraturan&id=<?php echo $row[0];?>" onclick="return confirm('Are you sure you want to delete Peraturan No <?php echo $row['no_peraturan'];?> ?')">Delete</a></td></tr>	
		<?php
		$no++;
	}
	?>
</table>	