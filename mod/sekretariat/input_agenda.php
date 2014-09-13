<script type="text/javascript" src="include/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php	
$act=$_REQUEST["act"];
 $save_url = "index.php?_mod=$_mod&task=simpan_jadwal&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from agenda where agenda_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	     $agenda_id =$row[0];
		 $tanggal 	=substr($row[1],0,10);
		 $jam		=str_replace(":",".",substr($row[1],11,5));
		
		 $selesai 	=$row[2];
		 $tempat 	=$row[3];
		 $acara  	=$row[4];
		 $comite 	=$row[5];
		 $disposisi =$row[6];
		 $keterangan =$row[7];
		 $tanggal2 	=substr($row[8],0,10);
		 $tgl_masuk  =$row[9];
		 }
	 
 }else{
         $agenda_id ="";
		 $tanggal 	="";
		 $tanggal2 	="";
		 $jam		="";
		
		 $selesai 	="";
		 $tempat 	="";
		 $acara  	="";
		 $comite 	="";
		 $disposisi ="";
		 $keterangan ="";
		 $tgl_masuk  ="";
 }



 $save_url = "index.php?_mod=$_mod&task=simpan_jadwal";
 echo "Input Schedule >> </br></br><br>";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $save_url;?>" method="post" name="form" >
<table>
<tr><td width="220px">Tanggal</td><td><input type="text" name="tanggal" value="<?php echo $tanggal;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tanggal'
	});
	</script>&nbsp;s.d Tanggal&nbsp;<input type="text" name="tanggal2" value="<?php echo $tanggal2;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tanggal2'
	});
	</script>
	</td></tr>
	<tr><td width="220px">Waktu</td><td><input type="text" name="jam" value="<?php echo $jam;?>" size="6"/>:<input type="text" name="selesai" value="<?php echo $selesai;?>" size="6"/></td></tr>
	<tr><td width="220px">Tempat</td><td><input type="text" name="tempat" value="<?php echo $tempat;?>" size="35"/></td></tr>	
	<tr><td width="150px" valign="top">Acara</td><td><textarea rows=4 cols=30 name="acara"><?php echo $acara;?></textarea></td></tr>
	<tr><td width="220px">Komite</td><td><input type="text" name="comite" value="<?php echo $comite;?>" size="35"/></td></tr>
	<tr><td width="220px">Disposisi</td><td><input type="text" name="disposisi" value="<?php echo $disposisi;?>" size="35"/></td></tr>
	<tr><td width="150px" valign="top">Keterangan</td><td><textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea></td></tr>
	<tr><td><input class="button3d" type="reset" name="reset" value="Reset"/></td>
	<td><input class="button3d" type="submit" name="submit" value="Submit"/>
				</td></tr>
				<?php if ($act=="edit"){ ?>
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<?php 
				}
				?>
				<input type="hidden" name="act" value="<?php echo $act;?>"/>
			</table>
				
			</form>
			</td></tr>
			</table>