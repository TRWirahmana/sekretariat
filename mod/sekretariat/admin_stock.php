<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php
global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       
      
       $page = 1;
    }else{
      
      
       $page  = $_REQUEST['page'];
	}
}else{
  
    
    $page = 1;
}
include('include/classpaging.php');
$sql="select * from stock_nomor where status=0";

	$sql .=" order by no_id ASC";

	$link = 'index.php?_mod=sekretariat&task=admin_stock&act=go';
	//echo $sql;
	$row_perpage=20;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();

$send_url = "index.php?_mod=$_mod&task=admin_stock";
?>

<?php
extract($_POST);
?>
<h2 align="left">Stock Nomor Surat</h2><?php
echo "<table border=0 width=100%>";?>
<tr>
<?php	echo "<td align=left>";
	if ($jml!=0){
	echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td align="center" width="30"><b>No</b></td><td align="center" width="150"><b>Nomor Surat</b></td></tr>
	<?php
	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){
	    if ($no%2==0){$bg="#C8C8C8";} else {$bg="#CCCCCC";}
		echo "<tr bgcolor=$bg><td align=\"center\">$no</td><td align=\"center\" valign=\"middle\">$row[2]</td>";?>
		</tr>	
		<?php
		$no++;
	}
	?>
</table>	
<table>	
<tr><td><input type=button onClick="location.href='index.php?_mod=sekretariat&task=input_stock&act=new'" value='Tambah Baru'> </td></tr>
</table>	