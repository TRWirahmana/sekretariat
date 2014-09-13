<link rel="stylesheet" type="text/css" href="style.css">

<?php
include('include/classpaging.php');
$sql = "SELECT * FROM user ";

	$sql .=" order by jenis_id";

	$link = 'index.php?_mod=peraturan&task=report_jenis&act=go';
	//echo $page;
	$row_perpage=10;
	$rs=mysql_query($sql);
	
echo "User >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=report_jenis";
?>
<h2 align="center">DAFTAR USER</h2>
 <table class=table cellpadding=2 cellspacing=1 bordercolor=#111111 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3"><td width="6"><b>No</b></td><td align=center width="30%"><b>User ID</b></td><td align=center width="55%"><b>User Name</b></td><td width="15%"><b>-</b></td></tr>
	<?php
	
	$no=1;
	while ($row=mysql_fetch_array($rs)){
	    if ($no%2==0){
		    $bg="#C8C8C8";
		} else {
		    $bg="#CCCCCC";
			}
		echo "<tr bgcolor=$bg><td align=\"center\">$no</td><td >".$row[1]."</td>";?>
		<td align="center"><a href="index.php?_mod=peraturan&task=input_jenis&act=edit&id=<?php echo $row[0];?>">Edit |</a><a href="index.php?_mod=peraturan&task=delete_jenis&id=<?php echo $row[0];?>" onclick="return confirm('Are you sure you want to delete <?php echo $row[1];?> ?')">Delete</a></td></tr>	
		<?php
		$no++;
	}
	?>	
</table>
<table>	
<tr><td><input type=button onClick="location.href='index.php?_mod=peraturan&task=input_jenis&act=new'" value='Add New'> </td></tr>
</table>
