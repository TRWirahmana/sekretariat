<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php


global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $tanggal = "";
       $page = 1;
    }else{
       $key   = $_REQUEST['key'];
       $tanggal = $_REQUEST['tanggal'];
       $page  = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $tanggal = "";
    $page = 1;
}
$today=date("Y-m-d");
$tomorrow= date('Y-m-d',mktime(0,0,0,date('m'), date('d')+1, date('Y')));
include('include/classpaging.php');
$sql = "SELECT * FROM agenda ";

	if($key!=''){
		$sql .= " WHERE (comite like '%$key%' or acara like '%$key%' or disposisi like '%$key%')";
		if ($tanggal!=''){
		    $sql .= " AND DATE(tanggal)='$tanggal'";
	   }		
	}else{
	  if ($tanggal!=''){
		    $sql .= " WHERE DATE(tanggal)='$tanggal'";
	   }else {
	   $sql .=" WHERE tanggal>='$tomorrow'";
	   }	
	}	
	$sql .=" order by tanggal";
	$link = 'index.php?_mod=sekretariat&task=report_agenda&act=go&key='.$key.'&tanggal='.$tanggal;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
//echo "Cari Jadwal >> </br></br>";


$send_url = "index.php";
?>
<div class="content-non-title">
    <form action="index.php" method="get" name="form">
        <div class="row-fluid">
            <div class="span24">
                <fieldset>
                    <div class="nav nav-tabs">
                        <h3> Jadwal Kepala Biro</h3>
                    </div>

                    <div class="control-group">
                        <label class="control-label span7">Acara/Komite</label>
                        <div class="controls span17">
                            <input type="text" name="key" value="<?php echo $key;?>" size="35"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label span7">Tanggal Terima</label>
                        <div class="controls span17">
                            <input type="text" id="date" name="tanggal" value="<?php echo $tanggal;?>" size="10"/>
                            <script language="JavaScript">
                                $(function(){
                                    $('#date').datepicker({
                                        inline:true,
                                        showOtherMonths: true,
                                        altField: "#date",
                                        altFormat: "yy-mm-dd",
                                        dateFormat: "yy-mm-dd",
//                                changeMonth: true,
//                                changeYear: true,
                                        onSelect: function(dateText){
                                            $('#date').html(dateText);
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label span7"></label>
                        <div class="controls span17">
                            <input class="btn btn-primary" type="submit" name="submit" value="Proses"/>
                        </div>
                    </div>



                </fieldset>
            </div>

        </div>

        <!--<div class="form-actions">-->

        <input type="hidden" name="act" value="go">
        <input type="hidden" name="_mod" value="sekretariat">
        <input type="hidden" name="task" value="admin_agenda">
        <input type="hidden" name="page" value="1">
        <!--</div>-->

    </form>
</div>
<hr>
<!--<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>-->
<!--<form action="--><?php //echo $send_url;?><!--" method="get" name="form">-->
<!--	<table>-->
<!--		   <tr><td width="150px">Acara/Komite</td><td><input type="text" name="key" value="--><?php //echo $key;?><!--" size="35"/></td></tr>-->
<!--		   <tr><td width="150px">Tanggal</td>-->
<!--			<td><input type="text" name="tanggal" value="--><?php //echo $tanggal;?><!--" size="10"/><script language="JavaScript">-->
<!--	new tcal ({-->
<!--		'formname': 'form',-->
<!--		'controlname': 'tanggal'-->
<!--	});-->
<!--	</script>-->
<!--			    -->
<!--			</td>-->
<!--			</tr>-->
<!--			<tr><td><input class="button" type="submit" name="submit" value="Proses"/></td></tr>-->
<!--			<input type="hidden" name="act" value="go">-->
<!--			<input type="hidden" name="_mod" value="sekretariat">-->
<!--			<input type="hidden" name="task" value="admin_agenda">-->
<!--			<input type="hidden" name="page" value="1">-->
<!--	</table>-->
<!--</form>-->
<!--</td></tr>-->
<!--</table>-->
<?php
extract($_POST);
?>
<!--<h2 align="center">JADWAL KEPALA BIRO</h2>-->
<?php
echo "<table border=0 width=100%>";?>
<tr><td><a href="index.php?_mod=sekretariat&task=print_schedule">
</a></td>
<?php	echo "<td align=right>";
	if ($jml!=0){
	//echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
 <table class=table cellpadding=2 cellspacing=1 width=100%>
	<tr class=\"bodystyle\" bgcolor='#757575' align=center height="3">
        <td class="table-menu" align="center" width="3"><b>No</b></td>
        <td class="table-menu" align="center" width="5"><b>Hari</b></td>
        <td class="table-menu" align="center" width="5"><b>Tanggal</b></td>
        <td class="table-menu" align="center" width="12%"><b>Waktu</b></td>
        <td class="table-menu" align="center" width="10%"><b>Tempat</b></td>
        <td class="table-menu" align="center" width="30%"><b>Acara</b></td>
        <td class="table-menu" align="center" width="10"><b>Komite</b></td>
        <td class="table-menu" align="center" width="10"><b>Disposisi</b></td>
        <td class="table-menu" align="center" width="10"><b>Ket</b></td>
    </tr>
	<?php
	
	$no=$row_perpage*($page-1)+1;
	$hari_awal="";
	while ($row=mysql_fetch_array($rs)){
	   // <?php
	
	$no=$row_perpage*($page-1)+1;
	 $hari = array( "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu");
	    $bulan= array(1=> "Januari", "Februari","Maret","April", "Mei","Juni","Juli","Agustus", "September", "Oktober", "November", "Desember" );
	    
	    $hr  = date("d", strtotime($row['tanggal']));
	    $bln = date("n", strtotime($row['tanggal']));
	    $thn = date("Y", strtotime($row['tanggal']));
	    $nama_bln = $bulan[$bln];
	    $tgl_acara = $hr."-".$nama_bln."-".$thn;
		$hr = date("w", strtotime($row['tanggal']));
		$hr = date("w", strtotime($row['tanggal']));
		$nama_hari = $hari[$hr];
		if ($row['tanggal2']!=""){
			$hr2 = date("d", strtotime($row['tanggal2']));
	        $bln2 = date("n", strtotime($row['tanggal2']));
	        $thn2 = date("Y", strtotime($row['tanggal2']));
	        $nama_bln2 = $bulan[$bln2];
	        $tgl2 = $hr2."-".$nama_bln2."-".$thn2;
			$tgl_text=$tgl_acara."<br>"."s.d"."<br>".$tgl2;
			
			}else{$tgl_text=$tgl_acara;}

        $jam=substr($row['tanggal'],11,5);
		$waktu=substr($jam,0,2).".".substr($jam,3,2)."-".$row[6];

		if ($row[12]==0){$bg="#99CCFF";} else {$bg="#CCCCCC";}
		if ($row[12]==0){$imgdoc="images/docblue.gif";} else {$imgdoc="images/doc1.gif";}
		if ($row[12]==0){$imgedit="images/ico.edit.blue.gif";} else {$imgedit="images/ico_edit_grey.gif";}
		echo "
		<tr bgcolor=$bg>
		    <td align=\"center\" valign=\"top\"><p>$no</p></td>
		    <td align=\"center\" valign=\"top\"><p>$row[1]</p></td>
		    <td align=\"center\" valign=\"top\"><p>$row[2]</p></td>
		    <td align=\"left\" valign=\"top\"><p>$tgl_text</p></td>
		    <td valign=\"top\"><p>$waktu</p></td>
		    <td valign=\"top\"><p>$row[8]</p></td>
		    <td valign=\"top\">$row[9]</td>
		    <td valign=\"top\"><p>$row[10]</p></td>
		    <td valign=\"top\"><p>$row[11]</p></td>";?>
		    <td valign="top">
                <a href="index.php?_mod=sekretariat&task=detail_und&id=<?php echo $row[0];?>" title="detail undangan"><img border=0 src="<?php echo $imgdoc;?>"></a>&nbsp;<a href="index.php?_mod=sekretariat&task=input_surat&act=edit&id=<?php echo $row[0];?>" title="edit"><img border=0 src="<?php echo $imgedit;?>"</a></td>
	    </tr>
		<?php
		$no++;
	}
	?></table>	
