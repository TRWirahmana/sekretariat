
<link rel="stylesheet" type="text/css" href="template/sekretariat/style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php	
function dit_show($id)
{
  $dit="";
  $sql="select * from surat_masuk where surat_id=$id";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     if($row[7]!=""){
	  $diteruskan=explode("/",$row[7]);;
	  $N = count($diteruskan);
	  for($i=0; $i < $N; $i++)
      {
	    switch ($diteruskan[$i])
        {
          case 1: $dit .="-Bagian Peraturan Perundang-undangan \n";
	              break;
	      case 2: $dit .="-Bagian Bantuan Hukum \n";
	              break;
          case 3: $dit .="-Bagian Kelembagaan \n";
	              break;
	      case 4: $dit .="-Bagian Ketatalaksanaan \n";
	              break;
	      case 5: $dit .="-Sekretariat \n";
                  break;
        }   
      }
	 }
	}
    return $dit;
}

function disp_show($id)
{
  $dis="";
  $sql="select * from surat_masuk where surat_id=$id";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
     if($row[8]!=""){
	  $diteruskan=explode("/",$row[8]);;
	  $N = count($diteruskan);
	  for($i=0; $i < $N; $i++)
      {
	   $kode=$diteruskan[$i];
	   $ket="";
	   if ($kode!=""){
	   $sql1="select * from disposisi where kode_disposisi=$kode";
       $query1=mysql_query($sql1);
       if ($row1=mysql_fetch_array($query1)) {
	     $ket=$row1[1];
		 $dis.="-".$ket."\n";
        }
		}
      }
	 }
	}
    return $dis;
}

 
     $id=$_REQUEST["id"];
	 $sql="select * from surat_masuk where surat_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	 
	     $no_agenda    =$row[1];
		 $agenda_tu    =$row[2];
		 $tgl_surat    =date("d-M-Y", strtotime($row[3]));
		 $no_surat     =$row[4];
		 $pengirim     =$row[5];
		 $search       = array('<p>','</p>');
		 $perihal      =str_replace($search,"",$row[6]);
		 $dit          =$row[7];
		 $diteruskan   =dit_show($row[0]);
		 $disp          =$row[8];
		 $disposisi    =disp_show($row[0]);
		 $tgl_selesai  =date("d-M-Y", strtotime($row[9]));
		 $keterangan   =str_replace($search,"",$row[10]);
		 $tgl_masuk    =$row[11];
		 $status       =$row[12];
		 $agenda_menteri     =$row[13];
		 $disposisi_menteri  =$row[14];
		 $agenda_sesjen      =$row[15];
		 $disposisi_sesjen   =$row[16];
		 $tgl_terima         =date("d-M-Y", strtotime($row[17]));
		 $file               =$row[18];
		 
		 }
	 

$tahun=date("Y");
//echo "Detail Surat</br></br>";
?>
<div class="content-non-title">
    <form action="" method="post" name="form" >
        <div class="row-fluid">
            <div class="span24">
                <fieldset>
                    <div class="nav nav-tabs">
                        <h3> Detail Surat</h3>
                    </div>

                    <div class="control-group form-center">
                        <label class="control-label span4">No. Agenda</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="no_agenda" value="<?php echo $no_agenda;?>" size="20" READONLY/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group form-center">
                        <label class="control-label span4">No. Agenda TU</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="agenda_tu" value="<?php echo $agenda_tu;?>" size="20" READONLY/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group form-center">
                        <label class="control-label span4">Tanggal Surat</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="tgl_surat"  value="<?php echo $tgl_surat;?>" size="20" READONLY/>
<!--                            <script language="JavaScript">-->
<!--                                $(function(){-->
<!--                                    $('#tanggal_surat').datepicker({-->
<!--                                        inline:true,-->
<!--                                        showOtherMonths: true,-->
<!--                                        altField: "#tanggal_surat",-->
<!--                                        altFormat: "yy-mm-dd",-->
<!--                                        dateFormat: "yy-mm-dd",-->
<!--//                                changeMonth: true,-->
<!--//                                changeYear: true,-->
<!--                                        onSelect: function(dateText){-->
<!--                                            $('#tanggal_surat').html(dateText);-->
<!--                                        }-->
<!--                                    });-->
<!--                                });-->
<!--                            </script>-->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group form-center">
                        <label class="control-label span4">No. Surat</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="no_surat" value="<?php echo $no_surat;?>" size="41" READONLY/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group form-center">
                        <label class="control-label span4">Pengirim</label>
                        <div class="controls span17">
                            <input type="text" class="span17" name="pengirim" value="<?php echo $pengirim;?>" size="41" READONLY/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group form-center">
                        <label class="control-label span4">Hal</label>
                        <div class="controls span17">
                            <textarea rows=4 class="span15" cols=40 name="perihal" readonly ><?php echo $perihal;?></textarea>
                        </div>
                    </div>
                    <?php if ($agenda_menteri!=""){?>
                    <div class="control-group form-center">
                        <label class="control-label span4">No. Agenda Menteri</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="agenda_menteri" value="<?php echo $agenda_menteri;?>" size="20" READONLY/>
                        </div>
                    </div>
                    <?php }
                    if ($disposisi_menteri!=""){?>
                    <div class="control-group form-center">
                        <label class="control-label span4">Disposisi Menteri</label>
                        <div class="controls span17">
                            <textarea rows=2 cols=40 class="span15" name="disposisi_menteri" readonly ><?php echo $disposisi_menteri;?></textarea>
                        </div>
                    </div>
                    <?php }
                    if ($agenda_sesjen!=""){?>

                    <div class="control-group form-center">
                        <label class="control-label span4">No. Agenda Sesjen</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="agenda_sesjen" value="<?php echo $agenda_sesjen;?>" size="20" READONLY/>
                        </div>
                    </div>
                    <?php }
                    if ($disposisi_sesjen!=""){?>

                    <div class="control-group form-center">
                        <label class="control-label span4">Disposisi Sesjen</label>
                        <div class="controls span17">
                            <textarea rows=2 cols=40 class="span15" name="disposisi_sesjen" readonly ><?php echo $disposisi_sesjen;?></textarea>
                        </div>
                    </div>
<?php } ?>

                    <div class="control-group form-center">
                        <label class="control-label span4">Tanggal Diterima</label>
                        <div class="controls span17">
                            <input type="text" class="span15" name="tgl_terima" value="<?php echo $tgl_terima;?>" size="20" READONLY/>
                        </div>
                    </div>
                    <?php
                    if ($dit!=""){?>

                    <div class="control-group form-center">
                        <label class="control-label span4">Diteruskan Ke</label>
                        <div class="controls span17">
                            <textarea rows=1 class="span15" cols=40 name="diteruskan" readonly ><?php echo $diteruskan;?></textarea>
                        </div>
                    </div>

                    <?php }
                    if ($disp!=""){?>

                    <div class="control-group form-center">
                        <label class="control-label span4">Disposisi</label>
                        <div class="controls span17">
                            <textarea rows=1 class="span15" cols=40 name="disposisi" readonly ><?php echo $disposisi;?></textarea>
                        </div>
                    </div>

                    <?php }
                    if ($keterangan!=""){?>

                    <div class="control-group form-center">
                        <label class="control-label span4">Keterangan</label>
                        <div class="controls span17">
                            <textarea rows=2 class="span15" cols=40 name="keterangan" readonly ><?php echo $keterangan;?></textarea>
                        </div>
                    </div>

                    <?php }
                    if ($file!=""){
                    ?>

                    <div class="control-group form-center">
                        <label class="control-label span4">File</label>
                        <div class="controls span17">
                            <a href="surat.php?id=<?php echo $id;?>" target="_blank"><?php echo $file;?></a>
                        </div>
                    </div>
                    <?php }
                    if ($status=="1"){
                    ?>
<div class="clearfix"></div>
                    <div class="control-group form-center">
                        <label class="control-label span4">Status</label>
                        <div class="controls span17">
                           <?php echo "<b>Selesai pada tanggal ".$tgl_selesai.". </b>";?>
                        </div>
                    </div>
                    <?php }else{?>

                    <div class="control-group form-center">
                        <label class="control-label span4">Status</label>
                        <div class="controls span17">
                            <?php echo "Belum didisposisi";?>
                        </div>
                    </div>

                    <?php }?>


<div class="clearfix"></div>
                    <div class="control-group">
                        <label class="control-label span7"></label>
                        <div class="controls span17">
<!--                            <input type="button" value="Kembali" onClick="javascript:history.go(-1)" /></td><td valign="top">-->
                            <input class="btn btn-primary" type="button" onClick="javascript:history.go(-1)" value="Kembali"/>
                        </div>
                    </div>



                </fieldset>
            </div>

        </div>

    </form>
</div>