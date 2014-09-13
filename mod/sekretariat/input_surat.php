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
function no_urut()
{
  $nomor=0;
  $tahun=date("Y");
  $sql="select * from no_agenda where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     $nomor=$row[2];
	}else{
	 $sql1="insert into no_agenda(tahun,no_terakhir) values($tahun,$nomor)";
     $result1=mysql_query($sql1);
	}
	$nomor=$nomor+1;
    return $nomor;
}

function no_urut_tu()
{
  $nomor=0;

  $tahun=date("Y");
  $sql="select * from agenda_tu where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     $nomor=$row[2];
	}else{
	 $sql1="insert into agenda_tu(tahun,no_terakhir) values($tahun,$nomor)";
     $result1=mysql_query($sql1);
	}
	$nomor=$nomor+1;
    return $nomor;
}

function dit_check($id,$k)
{
  $ada=false;
  $sql="select * from surat_masuk where surat_id=$id";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     if($row[7]!=""){
	  $diteruskan=explode("/",$row[7]);;
	  $N = count($diteruskan);
	  for($i=0; $i < $N; $i++)
      {
        if ($diteruskan[$i]==$k){
		 $ada=true;
		}
      }
	 }
	}
    return $ada;
}
function disp_check($id,$k)
{
  $ada=false;
  $sql="select * from surat_masuk where surat_id=$id";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     if($row[8]!=""){
	  $disposisi=explode("/",$row[8]);;
	  $N = count($disposisi);
	  for($i=0; $i < $N; $i++)
      {
        if ($disposisi[$i]==$k){
		 $ada=true;
		}
      }
	 }
	}
    return $ada;
}
$act=$_REQUEST["act"];
 $save_url = "index.php?_mod=$_mod&task=simpan&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from surat_masuk where surat_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	     $agenda         =explode("/",$row[1]);
	     $no_agenda      =$agenda[0];
		 $agenda_tu      =explode("/",$row[2]);
		 $no_agenda_tu   =$agenda_tu[0];
		 $tgl_surat      =substr($row[3],0,10);
		 $no_surat       =$row[4];
		 $pengirim       =$row[5];
		 $perihal=str_replace("#","'",$row[6]);
		 $diteruskan_2   =$row[7];
		 $disposisi      =$row[8];
		 $tgl_selesai    =substr($row[9],0,10);
		 $keterangan     =$row[10];
		 $tgl_masuk      =$row[11];
		 $status         =$row[12];
		 $agenda_menteri =$row[13];
		 $disp_menteri   =$row[14];
		 $agenda_sesjen  =$row[15];
		 $disp_sesjen    =$row[16];
		 $tgl_terima     =$row[17];
		 $nama_file      =$row[18];
		 $type		     =$row[19];
		 $size		     =$row[20];
		 $content	     =$row[21];
		 }
	 
 }else{
         $no_agenda 	=no_urut();
		 $no_agenda_tu	=no_urut_tu();
		 $tgl_surat 	="";
		 $no_surat  	="";
		 $pengirim  	="";
		 $perihal   	="";
		 $diteruskan_2 	="";
		 $disposisi   	="";
		 $tgl_selesai 	="";
		 $keterangan  	="";
		 $tgl_masuk   	="";
		 $status  		=0;
		 $agenda_menteri ="";
		 $disp_menteri   ="";
		 $agenda_sesjen  ="";
		 $disp_sesjen    ="";
		 $tgl_terima 	=date("Y-m-d");
		 $nama_file      ="";
		 $type		     ="";
		 $size		     ="";
		 $content	     ="";
 }


$tahun=date("Y");
 $save_url = "index.php?_mod=$_mod&task=simpan";
 echo "Input Surat Masuk >> </br></br><br>";
   $bulan=date("m");
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $save_url;?>" method="post" name="form" enctype="multipart/form-data">
<table>
    
	<tr><td width="150px">Nomor Surat Masuk</td><td><input type="text" name="no_surat" value="<?php echo $no_surat;?>" size="35"/></td></tr>
	<tr><td width="150px">Tanggal Surat</td><td><input type="text" name="tgl_surat" value="<?php echo $tgl_surat;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_surat'
	});
	</script></td></tr>
	<tr><td width="150px">No. Agenda Menteri</td><td><input type="text" name="agenda_menteri" value="<?php echo $agenda_menteri;?>" size="35"/></td></tr>
	<tr><td width="150px">Disposisi Menteri</td><td><input type="text" name="disp_menteri" value="<?php echo $disp_menteri;?>" size="35"/></td></tr>
	<tr><td width="150px">No. Agenda Sesjen</td><td><input type="text" name="agenda_sesjen" value="<?php echo $agenda_sesjen;?>" size="35"/></td></tr>
	<tr><td width="150px">Disposisi Sesjen</td><td><input type="text" name="disp_sesjen" value="<?php echo $disp_sesjen;?>" size="35"/></td></tr>
	<tr><td width="150px">Pengirim</td><td><input type="text" name="pengirim" value="<?php echo $pengirim;?>" size="35"/></td></tr>
	<tr><td width="150px" valign="top">Perihal</td><td><textarea rows=4 cols=30 name="perihal"><?php echo $perihal;?></textarea></td></tr>
	<tr><td width="150px">File (PDF)</td><td><input type="hidden" name="MAX_FILE_SIZE" value="200000000"><input name="fileupload" type="file" id="fileupload"></td></tr>
	<tr><td width="150px">Tanggal Diterima</td><td><input type="text" name="tgl_terima" value="<?php echo $tgl_terima;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_terima'
	});
	</script></td></tr>
	<tr><td width="150px" valign="top">Diteruskan Ke</td><td><?php
		 $sql_bag="select * from kode_bagian";
	     $query_bag=mysql_query($sql_bag);
	     while ($row_bag=mysql_fetch_array($query_bag)) {
	       ?><INPUT TYPE=CHECKBOX NAME="diteruskan_2[]" value="<?php echo $row_bag[0];?>" <?php if (($act=="edit")&&(dit_check($id,$row_bag[0])==true)){ echo "checked";}?>><?php echo $row_bag[1];?><BR><?php
	     }?>
	<!--<input type="text" name="diteruskan_2" value="<?php //echo $diteruskan_2;?>" size="35"/>--></td></tr>
	<tr><td width="150px" valign="top">Disposisi</td><td><?php
		 $sql_dis="select * from disposisi where view=1";
	     $query_dis=mysql_query($sql_dis);
	     while ($row_dis=mysql_fetch_array($query_dis)) {
	        ?><INPUT TYPE=CHECKBOX NAME="disposisi[]" value="<?php echo $row_dis[0];?>" <?php if (($act=="edit")&&(disp_check($id,$row_dis[0])==true)){ echo "checked";}?>><?php echo $row_dis[1];?><BR><?php
	     }?>
	<tr><td width="150px" valign="top">Keterangan</td><td><textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea></td></tr>
	<tr><td width="150px" valign="top">Status</td><td><INPUT TYPE=CHECKBOX NAME="status" value="1" <?php if (($act=="edit") && ($row[12]=="1")){ echo "checked";}?>>Selesai</td></tr>
	<tr><td width="150px">Tanggal Selesai</td><td><input type="text" name="tgl_selesai" value="<?php echo $tgl_selesai;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_selesai'
	});
	</script></td></tr>	
	<tr><td><input class="button3d" type="reset" name="reset" value="Cancel"/></td>
	<td><input class="button3d" type="submit" name="submit" value="Save"/>&nbsp&nbsp
	<input class="button3d" type="submit" name="submit" value="Save & Print"/>
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