<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<script type="text/javascript">
function ShowForm(op) {
  document.getElementById('permen').style.display='none';
  document.getElementById('skb').style.display='none';

if (op == 1 || op==2) {
    document.getElementById('permen').style.display="block";
  }
  if (op == 3 || op==4 || op==5 || op==6 || op==7 ) {
    document.getElementById('skb').style.display="block";
  }
}


</script>

<br>
<br>
<form action="simpan.php" method="post" name="form">
		   <table>
		   <tr><td width="220px">Jenis Peraturan</td>
			<td><select name="jenis" value="" onChange="ShowForm(this.selectedIndex)><?php
			$sql="select * from jenis_peraturan";
			$qup = mysql_query($sql);
			for ($i=0;$i<mysql_num_rows($qup);$i++){
				$rup = mysql_fetch_array($qup);						  
				echo '<option value="'.$rup[0].'">'.$rup[1].'</option>';						  
				}?> </select>
			    
			</td>
			</tr>
<div id="permen" style="display:none">
           			
		   <tr><td width="150px">Tanggal Peraturan</td><td><input type="text" name="tgl_tetap" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_tetap'
	});
	</script></td></tr>
	<tr><td width="150px">Nomor Peraturan</td><td><input type="text" name="nomor" value="" size="35"/></td></tr>
	<tr><td width="150px" valign="top">Tentang</td><td><textarea rows=4 cols=30 name="tentang"></textarea></td></tr>
	<tr><td width="150px">Unit Pemroses</td><td><input type="text" name="unit" value="" size="35"/></td></tr>	 
    <tr><td width="150px">Tanggal Diterima Untuk Digandakan</td><td><input type="text" name="tgl_terima" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_terima'
	});

	</script></td></tr>	
	<tr><td width="150px">Tanggal Selesai Didistribusikan</td><td><input type="text" name="tgl_selsai" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_selsai'
	});

	</script></td></tr>	
</div>	
<div id="skb" style="display:none">	
<tr><td width="150px">Tanggal</td><td><input type="text" name="tgl_perjanjian" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_perjanjian'
	});
	</script></td></tr>	  
	<tr><td width="150px">Nomor Perjanjian / Kesepakatan</td><td><input type="text" name="nomor_perjanjian" value="" size="35"/></td></tr>
	<tr><td width="150px" valign="top">Judul Perjanjian</td><td><textarea rows=4 cols=30 name="judul"></textarea></td></tr>
			<tr><td width="150px" valign="top">Keterangan</td><td><textarea rows=4 cols=30 name="keterangan"></textarea></td></tr>
</div>
			
			<tr><td>
				<input class="button3d" type="reset" name="reset" value="Reset"/></td>
				<td>
				<input class="button3d" type="submit" name="submit" value="Submit"/>
				</td></tr>
			</table>
			</form>