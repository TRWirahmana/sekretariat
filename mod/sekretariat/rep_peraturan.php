<?php 
global $key,$jenis,$page;	
if ($_REQUEST['act']=="new"){
   $key   = "";
   $jenis = "0";
   $page = 1;
}else{
    $key   = $_REQUEST['key'];
    $jenis = $_REQUEST['jenis'];
    $page  = $_REQUEST['page'];
	}

	//if ($page==""){
	 // $page  = 1;
	//}else{
	  
	//}
include('include/classpaging.php');
$sql = "SELECT * FROM peraturan ";

	if($key!='' || $jenis!=0){
		$sql .= " WHERE";
	 }	 
	if($key!=''){
		$sql .= " (no_peraturan like '%$key%' or tentang like '%$key%')";
		if ($jenis!=0){
		    $sql .= " and jenis_id=$jenis";
		}
	}else{
	if ($jenis!=0){
		    $sql .= " jenis_id=$jenis";
	}
	}
	$sql .=" order by peraturan_id";

	$link = 'index.php?_mod=peraturan&task=rep_peraturan&act=go&key='.$key.'&jenis='.$jenis;
	echo $page;
	$row_perpage=2;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
	form_hiddenfield('_mod',$_mod);
	form_hiddenfield('task',$task);	
	echo "<Table border=0 width=100% style=\"border:1px solid #cccccc\">";
	echo "<tr><td colspan=4>";find();echo "</td></tr>";
	echo "<tr>";
	echo "<td colspan=4 align=right>";
	echo "<table border=0 width=100%>";
	echo "<td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	echo"</td></tr>";			
	echo "<tr>";
	echo "<td style=\"padding:3px;\">";?>
	<table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<?php
	//table_open('100%','#ffffff','0','2','2');
	echo "<tr class=\"bodystyle\" bgcolor='#757575' align=center>";?>
	<td align="center" width="3">No</td><td align="center" width="5">Tanggal Peraturan</td><td align="center" width="10">Jenis Peraturan</td><td align="center" width="10">Nomor Peraturan</td><td align="center" width="53%">Tentang</td><td align="center" width="15%">Unit Pemroses</td><td align="center" width="10">Tanggal Diterima Untuk Digandakan</td><td align="center" width="10">Tanggal Selesai Didistribusikan</td></tr>
	<?php
	//$header = array('No','Tanggal Peraturan','Jenis Peraturan','No. Peraturan','Tentang','Unit Pemroses','Tgl Diterima Untuk Digandakan','Tanggal Selesai Didistribusikan');
	//table_header('#757575',$header,'');
	$go = $row_perpage*($page-1)+1;
	while($row = mysql_fetch_array($rs)) {
	    $tgl = date("d-M-Y", strtotime($row['tanggal']));
		$tgl_terima = date("d-M-Y", strtotime($row['tanggal_diterima']));
		$tgl_selesai = date("d-M-Y", strtotime($row['tanggal_distribusi']));
		if ($go%2==0) {$bg="#C8C8C8";} else {$bg="#ffffff";}
		echo "<tr bgcolor=$bg>";
		echo "<td>".$go."</td>";
		echo "<td>".$tgl."</td>";
		echo "<td>".getJenis($row[2])."</td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td>".$row[5]."</td>";
		echo "<td>".$tgl_terima."</td>";
		echo "<td>".$tgl_selesai."</td>";
		echo "</tr>";
		$go++;
	}
	table_close();
	echo "</td></tr>";
	echo "<tr>"; 
	echo "<td colspan=4 align=right>";
	echo "<table border=0 width=100%>";
	echo "<tr>";
	echo "<td align=right>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	
	}
	echo "</td></tr>";
	echo "</table>";					
	echo "</td></tr></table>";
	//break;


function find(){
	global $key,$jenis;
    echo "<form method='post' action='index.php?_mod=peraturan&task=rep_peraturan'>"; ?>  
  <table>
		   <tr><td width="150px">Tentang/Nomor</td><td><input type="text" name="key" value="<?php echo $key;?>" size="35"/></td></tr>
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
			<tr><td><input class="button" type="submit" name="submit" value="Search"/></td></tr>
			<input type="hidden" name="act" value="go">
			<input type="hidden" name="page" value="1">
	</table><?php
   echo "</table>";
   echo "</form>";
}

function getJenis($jenis_id){
  $sql="select nama_peraturan from jenis_peraturan where jenis_id=$jenis_id";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res)){
    return $row[0];
  }else return "#NA";
}

?>