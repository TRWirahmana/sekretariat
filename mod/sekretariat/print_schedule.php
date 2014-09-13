<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php


echo "Print Schedule >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=print_rtf";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $send_url;?>" method="post" name="form">
	<table>
		   <tr><td width="150px">Start Date</td>
			<td><input type="text" name="tanggal" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tanggal'
	});
	</script>
			    
			</td>
			</tr>
			<tr><td><input class="button" type="submit" name="submit" value="Print"/></td></tr>
			
	</table>
</form>
</td></tr>
</table>
