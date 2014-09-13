
<script language="JavaScript" src="include/calendar/calendar.js"></script>
	<link rel="stylesheet" href="include/calendar/calendar.css">

<?php
    #echo $themes;
	
include("include/block_functions.php");
#include("include/jcal.css");

//define('FPDF_FONTPATH','include/pdf-font/');
require('include/fpdf.php');

include("include/form_functions.php");
include("include/java_functions.php");
include("include/table_functions.php");
include("include/functions.php");
function mysqlExec($sql){
	$conn;
	$stm = mysql_query($sql);
	return $stm;
}

function form_mysqlselect($name,$title,$sql,$selected){
	global $conn;
	 $stat = mysql_query($sql);
	 #$row =mysql_fetch_row($stat);
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	while ($row=mysql_fetch_row($stat)){
		$isselected = ($selected==$row[0])?" selected":" ";
		echo "<option value=\"".$row[0]."\" ${isselected}>".$row[1]."</option>";
	}
	echo "</td></tr>";
}

function module_restrict(){
echo "<fieldset><legend>Unauthorised Access:</legend><center>
							<b>Access Denied</b><br>
							This menu or link may not need your actions.</center></fieldset>
							";	
}


?>
