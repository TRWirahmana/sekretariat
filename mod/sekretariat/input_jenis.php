<link rel="stylesheet" type="text/css" href="style.css">

<?php
 
 echo "Input Jenis Peraturan >> </br></br><br>";
 $act=$_REQUEST["act"];
 $save_url = "index.php?_mod=$_mod&task=simpan_jenis&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from jenis_peraturan where jenis_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) $nama=$row[1];
	 
 }else{
    $nama=""; 
 }
 
 
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $save_url;?>" method="post" name="form" enctype="multipart/form-data">
<table>
	<tr><td width="220px">Nama Peraturan</td><td><input type="text" name="nama" value="<?php echo $nama;?>" size="35"/></td></tr>
	
				<tr><td>
				<input class="button3d" type="reset" name="reset" value="Reset"/></td>
				<td>
				<input class="button3d" type="submit" name="submit" value="Save"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="button3d" type="button" name="cancel" onClick="location.href='index.php?_mod=peraturan&task=report_jenis&act=new'" value="Cancel"/>
				<?php if ($act=="edit"){ ?>
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<?php 
				}
				?>
				<input type="hidden" name="act" value="<?php echo $act;?>"/>
				</td></tr>
			</table>
				
			</form>
			</td></tr>
			</table>