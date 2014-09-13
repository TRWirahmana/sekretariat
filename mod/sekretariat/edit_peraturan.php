<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<script type="text/javascript">
function ShowForm(select) {
var selectedOption = select.options[select.selectedIndex];
 var op= selectedOption.value;
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


<?php
 $save_url = "index.php?_mod=$_mod&task=simpan";
 echo "Input Peraturan >> </br></br><br>";
 $id= $id=$_REQUEST["id"];
 $sql="select * from peraturan where peraturan_id=$id";
 $query=mysql_query($sql);
 if ($row=mysql_fetch_array($query)){
     $tanggal  = $row[0];
     $jenis    = $row[1];
	 $nomor    = $row[2];
	 $tentang  = $row[3];
	 $unit     = $row[4];
	 $tg_terima = $row[5];
	 $keterangan = $row[6];
	 $tgl_distribusi = $row[7];
 
 }
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $save_url;?>" method="post" name="form" enctype="multipart/form-data">
<table>
		   <tr><td width="220px">Jenis Peraturan</td>
			<td><select name="jenis" onChange="ShowForm(this)"><?php
			$sql="select * from jenis_peraturan";
			echo '<option value="">--Pilih--</option>';
			$qup = mysql_query($sql);
			for ($i=0;$i<mysql_num_rows($qup);$i++){
				$rup = mysql_fetch_array($qup);	
				if ($jenis==$rup[0]){
                   echo '<option value="'.$rup[0].'" selected>'.$rup[1].'</option>';
				}else{
				   echo '<option value="'.$rup[0].'">'.$rup[1].'</option>';						  
				}   
			}?> </select>
			    
			</td>
			</tr>
	<tr><td colspan=2>	
    <?php //if ($jenis==1 || $jenis==2){?>	
         <div id="permen" style="display:none">
		 <?php //}else{?>
		 <?php //} ?>
           	<table>		
		   <tr><td width="220px">Tanggal Peraturan</td><td><input type="text" name="tgl_tetap" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_tetap'
	});
	</script></td></tr>
	<tr><td width="220px">Nomor Peraturan</td><td><input type="text" name="nomor" value="<?php echo $nomor;?>" size="35"/></td></tr>
	<tr><td width="220px" valign="top">Tentang</td><td><textarea rows=4 cols=30 name="tentang"><?php echo $tentang;?></textarea></td></tr>
	<tr><td width="220px">Unit Pemroses</td><td><input type="text" name="unit" value="" size="35"/><?php echo $unit;?></td></tr>	 
    <tr><td width="220px">Tanggal Diterima Untuk Digandakan</td><td><input type="text" name="tgl_terima" value="<?php echo $tgl_terima;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_terima'
	});

	</script></td></tr>	
	<tr><td width="220px">Tanggal Selesai Didistribusikan</td><td><input type="text" name="tgl_selesai" value="<?php echo $tgl_distribusi;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_selesai'
	});

	</script></td></tr>	
	</table>
</div>	
<div id="skb" style="display:none">	
<table>
<tr><td width="220px">Tanggal</td><td><input type="text" name="tgl_perjanjian" value="<?php echo $tanggal;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_perjanjian'
	});
	</script></td></tr>	  
	<tr><td width="220px">Nomor Perjanjian / Kesepakatan</td><td><input type="text" name="nomor_perjanjian" value="<?php echo $nomor;?>" size="35"/></td></tr>
	<tr><td width="220px" valign="top">Judul Perjanjian</td><td><textarea rows=4 cols=30 name="judul"><?php echo $tentang;?></textarea></td></tr>
			<tr><td width="150px" valign="top">Keterangan</td><td><textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea></td></tr>
			</table>
</div>
</td></tr>
<tr><td width="220px">File Dokumen (PDF/Word Document)</td>
<td>
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="fileupload" type="file" id="fileupload">
</td>
</tr>
				<tr><td>
				<input class="button3d" type="reset" name="reset" value="Reset"/></td>
				<td>
				<input class="button3d" type="submit" name="submit" value="Submit"/>
				</td></tr>
			</table>
				
			</form>
			</td></tr>
			</table>