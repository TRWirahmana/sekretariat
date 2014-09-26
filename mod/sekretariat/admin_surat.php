<link rel="stylesheet" type="text/css" href="template/sekretariat/style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
<link rel="stylesheet" href="inc/Calendar/calendar.css">

<script>
//    document.title = "Layanan Biro Hukum dan Organisasi | Status Usulan Bantuan Hukum";
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Surat Masuk";
</script>

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
       case 1: $dit .="-PUU<BR>";
	   break;
	   case 2: $dit .="-Bankum<BR>";
	   break;
       case 3: $dit .="-Kelembagaan<BR>";
	   break;
	   case 4: $dit .="-Ketatalaksanaan<BR>";
	   break;
	   case 5: $dit .="-Sekretariat<BR>";
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
		 $dis.="-".$ket."<BR>";
        }
		}
      }
	 }
	}
    return $dis;
}

global $key,$key_word;
 if (isset($_REQUEST['act'])){
    if ($_REQUEST['act']=="new"){
       $key   = "";
       $tgl_terima = "";
       $page = 1;
    }else{
       $key   = $_REQUEST['key'];
       $tgl_terima = $_REQUEST['tgl_terima'];
       $page  = $_REQUEST['page'];
	}
}else{
    $key   = "";
    $tgl_terima = "";
    $page = 1;
}
include('include/classpaging.php');
$sql = "SELECT * FROM surat_masuk ";

	if($key!=''){
		$sql .= " WHERE (no_surat like '%$key%' or perihal like '%$key%' or no_agenda like '%$key%' or pengirim like '%$key%')";
		
	}
	if ($tgl_terima!=''){
	    if($key!=''){
		   $sql .= " AND tgl_terima='$tgl_terima'";
		}else{
		    $sql .= " WHERE tgl_terima='$tgl_terima'";}
	   }
	
	$sql .=" order by surat_id DESC";

	$link = 'index.php?_mod=sekretariat&task=admin_surat&act=go&key='.$key.'&tgl_terima='.$tgl_terima;
	//echo $sql;
	$row_perpage=10;
	$jml=mysql_num_rows(mysql_query($sql));
	$pager = new PS_Pagination($conn,$sql,$row_perpage,5,$link);
	$rs = $pager->paginate();
//echo "Cari Surat Masuk >> </br></br>";


$send_url = "index.php?_mod=$_mod&task=admin_surat";
?>
<div class="content-non-title">
<form action="index.php" method="get" name="form">
<div class="row-fluid">
    <div class="span24">
        <fieldset>
            <div class="nav nav-tabs">
                <h3> Daftar Surat Masuk</h3>
            </div>

            <div class="control-group">
                <label class="control-label span7">Perihal/Nomor Agenda/No surat/Tanggal</label>
                <div class="controls span17">
                    <input type="text" name="key" value="" size="35"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label span7">Tanggal Terima</label>
                <div class="controls span17">
                    <input type="text" id="date" name="tgl_terima" value="" size="10"/>
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

    <input type="hidden" name="_mod" value="sekretariat">
    <input type="hidden" name="task" value="admin_surat">
    <input type="hidden" name="act" value="go">
    <input type="hidden" name="page" value="1">
<!--</div>-->

</form>
    </div>
<hr>
<?php
//extract($_POST);
?>
<!--<h2 align="center">DAFTAR SURAT MASUK</h2>-->
<?php
echo "<table border=0 width=100%>";
	echo "<td><input class='btn btn-primary' type=button onClick=\"location.href='index.php?_mod=sekretariat&task=input_surat&act=new'\" value='Input Surat Baru'> </td><td align=right>";
	if ($jml!=0){
	//echo "Page ";
	echo $pager->renderFullNav();	}
	echo "</td></tr>";
	echo "</table>";	
	?>
	<table class=table cellpadding=2 cellspacing=5 width=100%>
	<tr  bgcolor='#757575' align=center height="3">
        <td class="table-menu" align="center"  valign="top" width="2%"><b>No</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Agenda KHO</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Agenda TU</b></td>
        <td class="table-menu" align="center"  valign="top" width="5%"><b>No. Surat</b></td>
        <td class="table-menu" align="center"  valign="top" width="15%"><b>Tgl Surat</b></td>
        <td class="table-menu" align="center"  valign="top" width="15%"><b>Pengirim</b></td>
        <td class="table-menu" align="center"  valign="top" width="30%"><b>Hal</b></td>
        <td class="table-menu" align="center"  valign="top" width="10%"><b>Tgl Diterima</b></td>
        <td class="table-menu" align="center"  valign="top" width="13%"><b>Aksi</b></td>
    </tr>

	<?php
	
	$no=$row_perpage*($page-1)+1;
	while ($row=mysql_fetch_array($rs)){
	   if ($row['agenda_sesjen']!=""){
	  $no_srt_masuk="-".$row[3]."<BR>-".$row[13];
	}else{
	$no_srt_masuk=$row[3];
	}
        if ($row['tgl_surat']!=""){
	   $tgl_srt=date("d-M-Y", strtotime($row['tgl_surat']));
	}else{
	   $tgl_srt="";
	}

	       //$tgl_srt=date("d-M-Y", strtotime($row['tgl_surat']));
		$tgl_terima=date("d-M-Y", strtotime($row['date_insert']));
		$tgl_selesai=date("d-M-Y", strtotime($row['tgl_selesai']));
		$tgl_terima=date("d-M-Y", strtotime($row['tgl_terima']));
              $perihal=str_replace("#","'",$row[6]);

		if ($row[12]==0){$bg="#99CCFF";} else {$bg="#CCCCCC";}
		if ($row[12]==0){$imgdoc="images/docblue.gif";} else {$imgdoc="images/doc1.gif";}
		if ($row[12]==0){$imgedit="images/ico.edit.blue.gif";} else {$imgedit="images/ico_edit_grey.gif";}
		echo "
		<tr bgcolor=$bg><td align=\"center\" valign=\"top\">$no</td>
		    <td align=\"center\" valign=\"top\"><p>$row[1]</p></td>
		    <td align=\"center\" valign=\"top\"><p>$row[2]</p></td>
		    <td align=\"left\" valign=\"top\"><p>$row[4]</p></td>
		    <td valign=\"top\"><p>$tgl_srt</p></td>
		    <td valign=\"top\"><p>$row[5]</p></td>
		    <td valign=\"top\">$perihal</td>
		    <td valign=\"top\"><p>$tgl_terima</p></td>";?>
		    <td valign="top">
            <a  align="center" href="index.php?_mod=sekretariat&task=detail&id=<?php echo $row[0];?>" title="detail surat"><img border=0 src="<?php echo $imgdoc;?>"></a>&nbsp;<a href="index.php?_mod=sekretariat&task=input_surat&act=edit&id=<?php echo $row[0];?>" title="edit"><img border=0 src="<?php echo $imgedit;?>"</a></td>
	</tr>	
		<?php
		$no++;
	}
	?>
</table>
 
