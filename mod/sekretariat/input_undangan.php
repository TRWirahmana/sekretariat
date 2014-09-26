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
 $save_url = "index.php?_mod=$_mod&task=simpan_undangan&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from undangan where undangan_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	        $no_undangan    =$row[3];
		 $tgl_undangan   =$row[4];
               $tgl_terima     =$row[5];
               $tanggal 	   =substr($row[6],0,10);
		 $jam		 =str_replace(":",".",substr($row[6],11,5));
		
		 $selesai 	=$row[7];
		 $tempat 	=$row[8];
		 $acara  	=$row[9];
		 $komite 	=$row[10];
		 $disposisi   =$row[11];
		 $keterangan  =$row[12];
		 $tanggal2 	=substr($row[13],0,10);
		 $tgl_masuk   =$row[14];
               $tgl_disposisi=$row[15];
               $status      =$row[16];	 
               $agenda_menteri =$row[17];
		 $disp_menteri   =$row[18];
		 $agenda_sesjen  =$row[19];
		 $disp_sesjen    =$row[20];

		 }
	 
 }else{
               $no_undangan    ="";
		 $tgl_undangan   ="";
              $tgl_terima 	=date("Y-m-d");
               $tanggal 	   ="";
		 $jam		 ="";
		 $selesai 	="";
		 $tempat 	="";
		 $acara  	="";
		 $komite 	="";
		 $disposisi   ="";
		 $keterangan  ="";
		 $tanggal2 	="";
		 $tgl_masuk   ="";
               $tgl_disposisi="";
               $status      =0;	
               $agenda_menteri ="";
		 $disp_menteri   ="";
		 $agenda_sesjen  ="";
		 $disp_sesjen    ="";

 }


$tahun=date("Y");
 $save_url = "index.php?_mod=$_mod&task=simpan_undangan";
 //echo "Input Undangan>> </br></br><br>";
   $bulan=date("m");
?>
<!--table border=0 width="100%" style="border:1px solid #cccccc"><tr><td-->
<form action="<?php echo $save_url;?>" method="post" name="form" enctype="multipart/form-data">

    <div class="span24"  style="margin-left: 0 !important;">
        <div class="nav nav-tabs">
            <h4>Input Undangan</h4>
        </div>
    </div>

    <div class="row-fluid">

        <!--left content-->
        <div class="span12">

            <div class="control-group">
                <label class="control-label span7">Nomor Surat Undangan</label>
                <div class="controls">
                    <input type="text" name="no_undangan" value="<?php echo $no_undangan;?>" size="35"/>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label span7">Tanggal Surat</label>
                <div class="controls">
                    <input type="text" id="tgl_undangan" name="tgl_undangan" value="<?php echo $tgl_undangan;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tgl_undangan').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tgl_undangan",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tgl_undangan').html(dateText);
                                }
                            });
                        });
                    </script>
<!--                    <input type="text" name="tgl_undangan" value="--><?php //echo $tgl_undangan;?><!--" size="10"/>-->
<!--                    <script language="JavaScript">-->
<!--                        new tcal ({-->
<!--                            'formname': 'form',-->
<!--                            'controlname': 'tgl_undangan'-->
<!--                        });-->
<!--                    </script>-->
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
                <label class="control-label span7">Tanggal Diterima</label>
                <div class="controls">
                    <input type="text" id="tgl_terima" name="tgl_terima" value="<?php echo $tgl_terima;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tgl_terima').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tgl_terima",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tgl_terima').html(dateText);
                                }
                            });
                        });
                    </script>
<!--                    <input type="text" name="tgl_terima" value="--><?php //echo $tgl_terima;?><!--" size="10"/>-->
<!--                    <script language="JavaScript">-->
<!--                        new tcal ({-->
<!--                            'formname': 'form',-->
<!--                            'controlname': 'tgl_terima'-->
<!--                        });-->
<!--                    </script>-->
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Tanggal Acara</label>
                <div class="controls">
                    <input type="text" class="span5" id="tanggal" name="tanggal" value="<?php echo $tanggal;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tanggal').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tanggal",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tanggal').html(dateText);
                                }
                            });
                        });
                    </script>

                    -

                    <input type="text" id="tanggal2" class="span5" name="tanggal2" value="<?php echo $tanggal2;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tanggal2').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tanggal2",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tanggal2').html(dateText);
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Waktu</label>
                <div class="controls">
                    <input type="text" name="jam" class="span5" value="<?php echo $jam;?>" size="6"/>
                    :
                    <input type="text" name="selesai" class="span5" value="<?php echo $selesai;?>" size="6"/>
                </div>
            </div>

        </div>

        <!--right content-->
        <div class="span12">

            <div class="control-group">
                <label class="control-label span7">Tempat</label>
                <div class="controls">
                    <input type="text" name="tempat" value="<?php echo $tempat;?>" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Acara</label>
                <div class="controls">
                    <textarea rows=4 cols=30 name="acara"><?php echo $acara;?></textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Komite</label>
                <div class="controls">
                    <input type="text" name="komite" value="<?php echo $komite;?>" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Disposisi</label>
                <div class="controls">
                    <input type="text" name="disposisi" value="<?php echo $disposisi;?>" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Keterangan</label>
                <div class="controls">
                    <textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Tanggal Disposisi</label>
                <div class="controls">
                    <input type="text" id="tgl_disposisi" name="tgl_disposisi" value="<?php echo $tgl_disposisi;?>" size="10"/>
                    <script language="JavaScript">
                        $(function(){
                            $('#tgl_disposisi').datepicker({
                                inline:true,
                                showOtherMonths: true,
                                altField: "#tgl_disposisi",
                                altFormat: "yy-mm-dd",
                                dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                onSelect: function(dateText){
                                    $('#tgl_disposisi').html(dateText);
                                }
                            });
                        });
                    </script>

                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Status</label>
                <div class="controls">
                    <INPUT TYPE=CHECKBOX NAME="status" value="1" <?php if (($act=="edit") && ($row[14]=="1")){ echo "checked";}?>>Jadwalkan Karo
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
    
	<tr><td width="150px">Nomor Surat Undangan</td><td><input type="text" name="no_undangan" value="<?php echo $no_undangan;?>" size="35"/></td></tr>
	<tr><td width="150px">Tanggal Surat</td><td><input type="text" name="tgl_undangan" value="<?php echo $tgl_undangan;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_undangan'
	});
	</script></td></tr>
       <tr><td width="150px">No. Agenda Menteri</td><td><input type="text" name="agenda_menteri" value="<?php echo $agenda_menteri;?>" size="35"/></td></tr>
	<tr><td width="150px">Disposisi Menteri</td><td><input type="text" name="disp_menteri" value="<?php echo $disp_menteri;?>" size="35"/></td></tr>
	<tr><td width="150px">No. Agenda Sesjen</td><td><input type="text" name="agenda_sesjen" value="<?php echo $agenda_sesjen;?>" size="35"/></td></tr>
	<tr><td width="150px">Disposisi Sesjen</td><td><input type="text" name="disp_sesjen" value="<?php echo $disp_sesjen;?>" size="35"/></td></tr>
	
       <tr><td width="150px">Tanggal Diterima</td><td><input type="text" name="tgl_terima" value="<?php echo $tgl_terima;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_terima'
	});
	</script></td></tr>
       <tr><td width="220px">Tanggal Acara</td><td><input type="text" name="tanggal" value="<?php echo $tanggal;?>" size="10"/><script language="JavaScript">
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
	<tr><td width="220px">Komite</td><td><input type="text" name="komite" value="<?php echo $komite;?>" size="35"/></td></tr>
	<tr><td width="220px">Disposisi</td><td><input type="text" name="disposisi" value="<?php echo $disposisi;?>" size="35"/></td></tr>
	<tr><td width="150px" valign="top">Keterangan</td><td><textarea rows=4 cols=30 name="keterangan"><?php echo $keterangan;?></textarea></td></tr>
       <tr><td width="150px">Tanggal Disposisi</td><td><input type="text" name="tgl_disposisi" value="<?php echo $tgl_disposisi;?>" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_disposisi'
	});
	</script></td></tr>

	<tr><td width="150px" valign="top"></td><td><INPUT TYPE=CHECKBOX NAME="status" value="1" <?php if (($act=="edit") && ($row[14]=="1")){ echo "checked";}?>>Jadwalkan Karo</td></tr>
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
			</table-->