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
 $save_url = "index.php?_mod=$_mod&task=simpan_dok&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from dokumen where dokumen_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	     $tgl_masuk    =substr($row[1],0,10);
		 $nama_dokumen =$row[2];
		 $pembawa      =$row[3];
		 $keperluan    =$row[4];
		 $tujuan       =$row[5];
		 $tgl_keluar   =substr($row[6],0,10);
		 $penerima     =$row[7];
		 $keterangan  =$row[8];
		 $status   =$row[9];
		 }
	 
 }else{
         $tgl_masuk    ="";
		 $nama_dokumen ="";
		 $pembawa      ="";
		 $keperluan    ="";
		 $tujuan       ="";
		 $tgl_keluar   ="";
		 $penerima     ="";
		 $keterangan  ="";
		 $status      ="";
	
 }


$tahun=date("Y");
 $save_url = "index.php?_mod=$_mod&task=simpan_dok";
 //echo "Input Dokumen >> </br></br><br>";
?>
<!--table border=0 width="100%" style="border:1px solid #cccccc"><tr><td-->
<form action="<?php echo $save_url;?>" method="post" name="form" >

    <div class="span24"  style="margin-left: 0 !important;">
        <div class="nav nav-tabs">
            <h4>Input Dokumen</h4>
        </div>
    </div>

    <div class="row-fluid">

        <!--left content-->
        <div class="span12">

            <div class="control-group">
                <label class="control-label span7">Tanggal Masuk</label>
                <div class="controls">
                    <input type="text" id="tgl_masuk" name="tgl_masuk" value="<?php echo $tgl_masuk;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tgl_masuk').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tgl_masuk",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tgl_masuk').html(dateText);
                                }
                            });
                        });
                    </script>
<!--                    <input type="text" name="tgl_masuk" value="--><?php //echo $tgl_masuk;?><!--" size="10"/>-->
<!--                    <script language="JavaScript">-->
<!--                        new tcal ({-->
<!--                            'formname': 'form',-->
<!--                            'controlname': 'tgl_masuk'-->
<!--                        });-->
<!--                    </script>-->
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Nama Dokumen</label>
                <div class="controls">
                    <textarea rows=4 cols=30 name="nama_dokumen"><?php echo $nama_dokumen;?></textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Yang Menyerahkan</label>
                <div class="controls">
                    <input type="text" name="pembawa" value="<?php echo $pembawa;?>" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Keperluan</label>
                <div class="controls">
                    <select name="keperluan">
                        <option value="1" <?php if ($keperluan=="1") echo "selected";?>>Tanda Tangan Karo</option>
                        <option value="2" <?php if ($keperluan=="2") echo "selected";?>>Paraf Karo</option>
                        <option value="3" <?php if ($keperluan=="3") echo "selected";?>>Tanda Tangan & Paraf Karo</option>
                    </select>
                </div>
            </div>

        </div>

        <!--right content-->
        <div clas="span12">
            <div class="control-group">
                <label class="control-label span5">Tujuan Dokumen</label>
                <div class="controls">
                    <input type="text" name="tujuan" value="<?php echo $tujuan;?>" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span5">Tanggal Keluar (dari Karo)</label>
                <div class="controls">
                    <input type="text" id="tgl_keluar" name="tgl_keluar" value="<?php echo $tgl_keluar;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tgl_keluar').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tgl_keluar",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tgl_keluar').html(dateText);
                                }
                            });
                        });
                    </script>
<!--                    <input type="text" name="tgl_keluar" value="--><?php //echo $tgl_keluar;?><!--" size="10"/>-->
<!--                    <script language="JavaScript">-->
<!--                        new tcal ({-->
<!--                            'formname': 'form',-->
<!--                            'controlname': 'tgl_keluar'-->
<!--                        });-->
<!--                    </script>-->
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span5">Penerima</label>
                <div class="controls">
                    <input type="text" name="penerima" value="<?php echo $penerima;?>" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span5">Keterangan</label>
                <div class="controls">
                    <textarea rows=4 name="keterangan"><?php echo $keterangan;?></textarea>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="control-group">
                <label class="control-label span3" style="margin-right: 25px;">Status</label>
                <div class="controls">
                    <INPUT TYPE=CHECKBOX NAME="status" value="1" <?php if (($act=="edit") && ($row[9]=="1")){ echo "checked";}?> >Selesai
                </div>
            </div>
        </div>

     </div>

    <div class="row-fluid" style="margin-top: 24px; margin-bottom: 48px;">
        <div class="span10 offset9">
            <button class="btn btn-primary" type="reset" name="reset">Cancel</button>
            <button class="btn btn-primary" type="submit" name="submit">Save</button>
            <button class="btn btn-primary" type="submit" name="submit">Save & Print</button>
            <?php if ($act=="edit"){ ?>
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <?php
            }
            ?>
            <input type="hidden" name="act" value="<?php echo $act;?>"/>

        </div>
    </div>

</form>
<!--table>
<tr><td width="220px">Tanggal Masuk</td><td><input type="text" name="tgl_masuk" value="<?php echo $tgl_masuk;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_masuk'
	});
	</script></td></tr>
    <tr><td width="150px" valign="top">Nama Dokumen</td><td><textarea rows=4 cols=30 name="nama_dokumen"><?php echo $nama_dokumen;?></textarea></td></tr>
	<tr><td width="220px">Yang Menyerahkan</td><td><input type="text" name="pembawa" value="<?php echo $pembawa;?>" size="35"/></td></tr>
	
	<tr><td width="220px">Keperluan</td>
	<td><select name="keperluan">
			<option value="1" <?php if ($keperluan=="1") echo "selected";?>>Tanda Tangan Karo</option>
			<option value="2" <?php if ($keperluan=="2") echo "selected";?>>Paraf Karo</option>
			<option value="3" <?php if ($keperluan=="3") echo "selected";?>>Tanda Tangan & Paraf Karo</option>
			</select>			    
			</td><tr>
	<tr><td width="220px">Tujuan Dokumen</td><td><input type="text" name="tujuan" value="<?php echo $tujuan;?>" size="35"/></td></tr>
	
	<tr><td width="220px">Tanggal Keluar (dari Karo)</td><td><input type="text" name="tgl_keluar" value="<?php echo $tgl_keluar;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_keluar'
	});
	</script></td></tr>
<tr><td width="220px">Penerima</td><td><input type="text" name="penerima" value="<?php echo $penerima;?>" size="35"/></td></tr>
	
	<tr><td width="150px" valign="top">Keterangan</td><td><textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea></td></tr>
	<tr><td width="150px" valign="top">Status</td><td><INPUT TYPE=CHECKBOX NAME="status" value="1" <?php if (($act=="edit") && ($row[9]=="1")){ echo "checked";}?>>Selesai</td></tr>
	
	<tr><td><input class="button3d" type="reset" name="reset" value="Batal"/></td>
	<td><input class="button3d" type="submit" name="submit" value="Simpan"/>&nbsp&nbsp
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
			</table-->