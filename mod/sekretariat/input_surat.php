<script type="text/javascript" src="include/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>

<link rel="stylesheet" type="text/css" href="template/sekretariat/style.css">
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
// echo "Input Surat Masuk >> </br></br><br>";
   $bulan=date("m");
?>
<form action="<?php echo $save_url;?>" method="post" name="form" enctype="multipart/form-data">
<div class="span24"  style="margin-left: 0 !important;">
    <div class="nav nav-tabs">
        <h4>Input Surat Masuk</h4>
    </div>
<!--    <strong>Silahkan lengkapi formulir berikut untuk melakukan pendaftaran. Isian dengan tanda <span class="required"></span> wajib diisi.</strong>-->
</div>
<div class="row-fluid">
    <!--            left content-->
    <div class="span12">
<!--        <div class="nav nav-tabs">-->
<!--            <h4>Akun Pendaftar</h4>-->
<!--        </div>-->

        <div class="control-group">
            <label class="control-label span7">Nomor Surat Masuk</label>
            <div class="controls">
                <input type="text" name="no_surat" id="no_surat" value="<?php echo $no_surat;?>" size="35" class="text-input"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="control-group">
            <label class="control-label span7">Tanggal Surat</label>
            <div class="controls">
                <input type="text" name="tgl_surat" id="tanggal_surat" value="<?php echo $tgl_surat;?>" size="10"/>
                <script language="JavaScript">
                    $(function(){
                        $('#tanggal_surat').datepicker({
                            inline:true,
                            showOtherMonths: true,
                            altField: "#tanggal_surat",
                            altFormat: "yy-mm-dd",
                            dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                            onSelect: function(dateText){
                                $('#tanggal_surat').html(dateText);
                            }
                        });
                    });
                </script>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">No. Agenda Menteri</label>
            <div class="controls">
                <input type="text" name="agenda_menteri" value="<?php echo $agenda_menteri;?>" size="35"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">Disposisi Menteri</label>
            <div class="controls">
                <input type="text" name="disp_menteri" value="<?php echo $disp_menteri;?>" size="35"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">No. Agenda Sesjen</label>
            <div class="controls">
                <input type="text" name="agenda_sesjen" value="<?php echo $agenda_sesjen;?>" size="35"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">Disposisi Sesjen</label>
            <div class="controls">
                <input type="text" name="disp_sesjen" value="<?php echo $disp_sesjen;?>" size="35"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">Pengirim</label>
            <div class="controls">
                <input type="text" name="pengirim" value="<?php echo $pengirim;?>" size="35"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">Perihal</label>
            <div class="controls">
                <textarea rows=4 cols=30 name="perihal"><?php echo $perihal;?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label span7">File (PDF)</label>
            <div class="controls">
                <input type="hidden" name="MAX_FILE_SIZE" value="200000000"><input name="fileupload" type="file" id="fileupload">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">Tanggal Diterima</label>
            <div class="controls">
                <input type="text" name="tgl_terima" id="tanggal_terima" value="<?php echo $tgl_terima;?>" size="10"/>
                <script language="JavaScript">
                    $(function(){
                        $('#tanggal_terima').datepicker({
                            inline:true,
                            showOtherMonths: true,
                            altField: "#tanggal_terima",
                            altFormat: "yy-mm-dd",
                            dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                            onSelect: function(dateText){
                                $('#tanggal_terima').html(dateText);
                            }
                        });
                    });
                </script>
            </div>
        </div>

    </div>
    <!--            right content-->
    <div class="span12">
<!--        <div class="nav nav-tabs">-->
<!--            <h4>Data Pendaftar</h4>-->
<!--        </div>-->



        <div class="control-group">
            <label class="control-label span7">Diteruskan Ke</label>
            <div class="controls span17">
                <?php
                $sql_bag="select * from kode_bagian";
                $query_bag=mysql_query($sql_bag);
                while ($row_bag=mysql_fetch_array($query_bag)) {
                    ?><INPUT TYPE=CHECKBOX NAME="diteruskan_2[]" value="<?php echo $row_bag[0];?>" <?php if (($act=="edit")&&(dit_check($id,$row_bag[0])==true)){ echo "checked";}?>><?php echo $row_bag[1];?><BR><?php
                }?>
            </div>
        </div>
<div class="clearfix"></div>
        <div class="control-group" style="margin-top: 20px;">
            <label class="control-label span7">Disposisi</label>
            <div class="controls span17">
                <?php
                $sql_dis="select * from disposisi where view=1";
                $query_dis=mysql_query($sql_dis);
                while ($row_dis=mysql_fetch_array($query_dis)) {
                    ?><INPUT TYPE=CHECKBOX NAME="disposisi[]" value="<?php echo $row_dis[0];?>" <?php if (($act=="edit")&&(disp_check($id,$row_dis[0])==true)){ echo "checked";}?>><?php echo $row_dis[1];?><BR><?php
                }?>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="control-group">
            <label class="control-label span7">Keterangan</label>
            <div class="controls">
                <textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label span7">Status</label>
            <div class="controls">
                <INPUT TYPE=CHECKBOX NAME="status" value="1" <?php if (($act=="edit") && ($row[12]=="1")){ echo "checked";}?>>Selesai
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="control-group">
            <label class="control-label span7">Tanggal Selesai</label>
            <div class="controls">
                <input type="text" name="tgl_selesai" id="tanggal_selesai" value="<?php echo $tgl_selesai;?>" size="10"/>
                <script language="JavaScript">
                    $(function(){
                        $('#tanggal_selesai').datepicker({
                            inline:true,
                            showOtherMonths: true,
                            altField: "#tanggal_selesai",
                            altFormat: "yy-mm-dd",
                            dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                            onSelect: function(dateText){
                                $('#tanggal_selesai').html(dateText);
                            }
                        });
                    });
                </script>
            </div>
        </div>

    </div>
</div>

<div class="row-fluid" style="margin-top: 24px; margin-bottom: 48px;">
    <div class="span10 offset7">
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