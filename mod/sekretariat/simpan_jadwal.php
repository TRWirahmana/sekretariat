<?php
extract($_POST);
$jam=str_replace(".",":",$jam);
$tgl=$tanggal." ".$jam.":00";

if($act=="new"){
   if ($tanggal2==""){
   $sql="insert into agenda(tanggal,selesai,place,acara,comite,disposisi,keterangan,tanggal2,date_insert) values('$tgl','$selesai','$tempat','$acara','$comite','$disposisi','$keterangan',NULL,now())";
   }else{
   $sql="insert into agenda(tanggal,selesai,place,acara,comite,disposisi,keterangan,tanggal2,date_insert) values('$tgl','$selesai','$tempat','$acara','$comite','$disposisi','$keterangan','$tanggal2',now())";
   }
 }else{
 if ($tanggal2==""){
  $sql="update agenda set tanggal='$tgl',selesai='$selesai',place='$tempat',acara='$acara',comite='$comite',disposisi='$disposisi',keterangan='$keterangan',tanggal2=NULL where agenda_id=$id";
  }else{
   $sql="update agenda set tanggal='$tgl',selesai='$selesai',place='$tempat',acara='$acara',comite='$comite',disposisi='$disposisi',keterangan='$keterangan',tanggal2='$tanggal2' where agenda_id=$id";
  } //$result=mysql_query($sql);
 }
  $result=mysql_query($sql);
 //echo $sql;

  //$result=mysql_query($sql);
 if($result){
     if($act=="new"){
    ?>
      <SCRIPT language="JavaScript">
      
      </SCRIPT> <?php
	  header("Location: index.php?_mod=sekretariat&task=admin_agenda&act=new");
	 }else{?>
	   <SCRIPT language="JavaScript">
     
      </SCRIPT> <?php
	  header("Location: index.php?_mod=sekretariat&task=admin_agenda&act=new");
	 }
   }else{
       if($act=="new"){
    ?>
     <SCRIPT language="JavaScript">
      alert('Insert Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: sekretariat/index.php?_mod=sekretariat&task=admin_agenda&act=new");
	  }else{?>
	    <SCRIPT language="JavaScript">
         alert('Update Failed!');
        </SCRIPT> <?php
	   header("Location: sekretariat/index.php?_mod=sekretariat&task=admin_agenda&act=new");
	  }
    }

?>