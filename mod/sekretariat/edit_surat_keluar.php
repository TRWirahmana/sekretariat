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
<script type="text/javascript">
function ShowForm1() {
  document.getElementById('surat_dinas').style.display='block';
  document.getElementById('surat_tugas').style.display='none';


}
function ShowForm2() {
  document.getElementById('surat_dinas').style.display='none';
  document.getElementById('surat_tugas').style.display='block';


}
</script>
<?php	
 $jml=getJmlStock();
 $act=$_REQUEST["act"];
 
 $save_url = "index.php?_mod=$_mod&task=simpan_edit_surat_keluar&act=".$act;
 
       $id=$_REQUEST["id"];
	   $sql="select * from surat_keluar where surat_keluar_id=$id";
	   $query=mysql_query($sql);
	   if ($row=mysql_fetch_array($query)) {
	     //$agenda=explode("/",$row[1]);
		 $jns_surat     =$row[2];
	     $no_surat      =$row[3];
		 $nomor=explode("/",$no_surat);
		 $no_awal       =$nomor[0];
		 $tgl_surat     =substr($row[4],0,10);
		 $asal_surat    =$row[5];
		 $ttd           =$row[6];
		 $tujuan        =$row[7];
		 $kode_hal      =$row[8];
		 if ($jns_surat==1){
		     $perihal       =$row[9];
			 $pelaksana     ="";
		  }else{
		  
		  }
		 $sifat			=$row[10];
		 $tgl_input     =substr($row[15],0,10);
		 }
	$save_url = "index.php?_mod=$_mod&task=simpan_edit_surat_keluar";
 echo "Input Surat Keluar >> </br></br><br>";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $save_url;?>" method="post" name="form" >
<table>
<?php
if ($act=="edit"){?>
   <tr><td width="150px">Nomor Surat</td><td><?php echo $no_surat;?></td>
   </tr>
   <?php
}
?>
<tr><td width="150px" valign="top">Jenis Surat</td><td>
	<INPUT TYPE=RADIO NAME="jns_surat" VALUE="1" onclick="ShowForm1()">Surat Dinas
    <INPUT TYPE=RADIO NAME="jns_surat" VALUE="2" onclick="ShowForm2()">Surat Tugas</td></tr>
   
	<tr><td colspan=2>	
	<div id="surat_tugas" style="display:<?php if ($jns_surat==2){echo "block";} else {echo "none";?>">
           	<table>	
         <tr><td width="110px">Tanggal Surat</td><td><input type="text" name="tgl_surat" value="<?php echo $tgl_surat;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_surat'
	});
	</script></td></tr>			
		  <tr><td width="150px">Asal Surat</td><td><select name="asal_surat">
<?php
	   $sql_bag="select * from kode_bagian order by kode_bagian";
	   $result_bag=mysql_query($sql_bag);
	   while ($row_bag=mysql_fetch_array($result_bag)){?>
	     <option value="<?php echo $row_bag[0];?>" <?php if ($asal_surat==$row_bag[0]) echo "selected";?>> <?php echo $row_bag[1];?></option>
	  <?php
	 }
	 ?>			
		</select>			    
	</td></tr>
	<tr><td width="150px">Yang Bertandatangan</td><td><select name="ttd">
			<option value="1" <?php if ($ttd=="1") echo "selected";?>>Sesjen</option>
			<option value="2" <?php if ($ttd=="2") echo "selected";?>>a.n Sesjen</option>
			<option value="3" <?php if ($ttd=="3") echo "selected";?>>Kepala Biro</option>
			<option value="4" <?php if ($ttd=="4") echo "selected";?>>a.n Kepala Biro</option>
			<option value="5" <?php if ($ttd=="5") echo "selected";?>>Kepala Bagian</option>
			</select>			    
	</td></tr>
	<tr><td width="150px" valign="top">Pelaksana Tugas</td><td><textarea rows=3 cols=50 name="pelaksana"><?php echo $pelaksana;?></textarea></td></tr>
	<tr><td width="150px" valign="top">Tujuan</td><td><textarea rows=2 cols=50 name="tujuan"><?php echo $tujuan;?></textarea></td></tr>
	<tr><td width="150px" valign="top">Hal</td><td><textarea rows=3 cols=50 name="hal"><?php echo $perihal;?></textarea></td></tr>
	</table>	
	
</div>	
<div id="surat_dinas" style="display:<?php if ($jns_surat==1){echo "block";} else {echo "none";?>">	
<table>
<tr><td width="110px">Tanggal Surat</td><td><input type="text" name="tgl_surat" value="<?php echo $tgl_surat;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_surat'
	});
	</script></td></tr>
<tr><td width="150px">Asal Surat</td><td><select name="asal_surat">
<?php
	   $sql_bag="select * from kode_bagian order by kode_bagian";
	   $result_bag=mysql_query($sql_bag);
	   while ($row_bag=mysql_fetch_array($result_bag)){?>
	     <option value="<?php echo $row_bag[0];?>" <?php if ($asal_surat==$row_bag[0]) echo "selected";?>> <?php echo $row_bag[1];?></option>
	  <?php
	 }
	 ?>
			
			</select>			    
	</td></tr>
	<tr><td width="150px">Yang Bertandatangan</td><td><select name="ttd">
			<option value="1" <?php if ($ttd=="1") echo "selected";?>>Sesjen</option>
			<option value="2" <?php if ($ttd=="2") echo "selected";?>>a.n Sesjen</option>
			<option value="3" <?php if ($ttd=="3") echo "selected";?>>Kepala Biro</option>
			<option value="4" <?php if ($ttd=="4") echo "selected";?>>a.n Kepala Biro</option>
			<option value="5" <?php if ($ttd=="5") echo "selected";?>>Kepala Bagian</option>
			</select>			    
	</td></tr>
	<tr><td width="150px">Sifat Surat</td><td><select name="sifat">
	        <option value="Biasa" <?php if ($sifat=="Biasa") echo "selected";?>>Biasa</option>
			<option value="Segera" <?php if ($sifat=="Segera") echo "selected";?>>Segera</option>
			<option value="Penting" <?php if ($sifat=="Penting") echo "selected";?>>Penting</option>
			<option value="Rahasia" <?php if ($sifat=="Rahasia") echo "selected";?>>Rahasia</option>
			</select>			    
			</td></tr>
	<tr><td width="150px" valign="top">Tujuan Surat</td><td><textarea rows=4 cols=30 name="tujuan"><?php echo $tujuan;?></textarea></td></tr>
	
	<tr><td width="150px">Kode Hal</td><td><select name="kode_hal">
	 <?php
	   $sql_hal="select * from kode_hal order by hal_id";
	   $result_hal=mysql_query($sql_hal);
	   while ($row_hal=mysql_fetch_array($result_hal)){?>
	     <option value="<?php echo $row_hal[1];?>" <?php if ($kode_hal==$row_hal[1]) echo "selected";?>> <?php echo $row_hal[2]." - ".$row_hal[1];?></option>
	  <?php
	 }
	 ?></select>			    
	</td></tr>
	<tr><td width="150px" valign="top">Hal</td><td><textarea rows=4 cols=30 name="perihal"><?php echo $perihal;?></textarea></td></tr>
	</table>
	</div></td></tr>
	<tr><td><input class="button3d" type="reset" name="reset" value="Batal"/></td>
	<td><input class="button3d" type="submit" name="submit" value="Simpan"/>
				</td></tr>
				<?php 
				if ($act=="edit"){ ?>
				   <input type="hidden" name="id" value="<?php echo $id;?>"/>
				   <input type="hidden" name="no_urut" value="<?php echo $no_urut;?>"/>
				   <?php 
				}
				?>
				<input type="hidden" name="act" value="<?php echo $act;?>"/>
			</table>
				
			</form>
			</td></tr>
			</table>
			<?php
			}?>