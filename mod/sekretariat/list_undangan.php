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

$sql = "SELECT * FROM undangan ";

	if($key!=''){
		$sql .= " WHERE (no_undangan like '%$key%' or komite like '%$key%' or acara like '%$key%' or disposisi like '%$key%')";
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
	$row_perpage=30;
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
			<td><input type="text" name="tanggal" id="date" value="<?php echo $tanggal;?>" size="10"/><script language="JavaScript">
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
<h2 align="center">Daftar Undangan</h2>
<?php
echo "<table border=0 width=100%>";?>
<tr><td></td>
<?php	echo "<td align=right>";
	if ($jml!=0){
	//echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3">
        <td class="table-menu" align="center" width="2%"><b>No</b></td>
        <td class="table-menu" align="center" width="3%"><b>Hari</b></td>
        <td class="table-menu" align="center" width="10%"><b>Tanggal</b></td>
        <td class="table-menu" align="center" width="5%"><b>Waktu</b></td>
        <td class="table-menu" align="center" width="10%"><b>Tempat</b></td>
        <td class="table-menu" align="center" width="20%"><b>Acara</b></td>
        <td class="table-menu" align="center" width="10%"><b>Komite</b></td>
        <td class="table-menu" align="center" width="10%"><b>Disposisi</b></td>
        <td class="table-menu" align="center" width="10%"><b>Ket</b></td>
    </tr>
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
		$waktu=substr($jam,0,2).".".substr($jam,3,2)."-".$row[7];
		if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		 if ($nama_hari!=$hari_awal){
		    
		    echo "
		    <tr bgcolor=$bg>
		    <td align=\"center\" valign=\"top\"><p>$no</p></td>
		    <td align=\"left\" valign=\"top\"><p>$nama_hari</p></td>
		    <td align=\"center\" valign=\"top\"><p>$tgl_text</p></td>
		    <td  valign=\"top\"><p>$waktu</p></td>
		    <td valign=\"top\" ><p>$row[8]</p></td>
		    <td valign=\"top\">$row[9]</td>
		    <td valign=\"top\"><p>$row[10]</p></td>
		    <td valign=\"top\"><p>$row[11]</p></td>
		    <td valign=\"top\">$row[12]</td></tr>";?>
			
	<?php  $hari_awal=$nama_hari;
	       $no++;
	     }else{
		   echo "<tr bgcolor=$bg><td align=\"center\" valign=\"top\"></td><td align=\"left\" valign=\"top\"></td><td align=\"center\" valign=\"top\">$tgl_text</td><td  valign=\"top\">$waktu</td><td valign=\"top\" >$row[8]</td><td valign=\"top\">$row[9]</td><td valign=\"top\">$row[10]</td><td valign=\"top\">$row[11]</td><td valign=\"top\">$row[12]</td></tr>";?>
 	     <?php
		
		}
		
	}
	?>
</table>	
