<?php
extract($_POST);
function no_terakhir()
{
  $tahun=date("Y");
  $sql="select * from no_undangan where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
         $nomor=$row[2];	 
	}else{
	  $nomor="";
	}
	return $nomor;
}

function no_urut()
{
  $nomor=0;
  $tahun=date("Y");
  $sql="select * from no_undangan where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
         $nomor=$row[2];
	}else{
	  $sql1="insert into no_undangan(tahun,no_terakhir) values($tahun,$nomor)";
         $result1=mysql_query($sql1);
	}
    $nomor=$nomor+1;
    return $nomor;
}

function no_terakhir_tu()
{
  $tahun=date("Y");
  $sql="select * from agenda_tu where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
      $nomor=$row[2];
	 	}else{
	  $nomor="";
	}
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
$bulan = date("m");
$tahun=date("Y");
$jam=str_replace(".",":",$jam);
$tgl=$tanggal." ".$jam.":00";
if(isset($_POST['status'])) {
   $status=$_POST['status'];
 }else{
   $status=0;
} 


if($act=="new"){
   $no_agenda    = no_urut();
   $no_agend  = $no_agenda."/UND/KHO/".$tahun;
   $no_agenda_tu=no_urut_tu();
   $no_agend_tu = $no_agenda_tu."/TU/".$bulan."/".$tahun;

   if ($tanggal2=="" && $tgl_disposisi==""){
      $sql="insert into undangan(agenda_und,agenda_tu,no_undangan,tgl_undangan,tgl_terima,tanggal,jam_selesai,tempat,acara,komite,disposisi,keterangan,tanggal2,date_insert,tgl_disposisi,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen) values('$no_agend','$no_agend_tu','$no_undangan','$tgl_undangan','$tgl_terima','$tgl','$selesai','$tempat','$acara','$komite','$disposisi','$keterangan',NULL,now(),NULL,$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen')";
      }else{ if ($tanggal2=="" && $tgl_disposisi==!""){
          $sql="insert into undangan(agenda_und,agenda_tu,no_undangan,tgl_undangan,tgl_terima,tanggal,jam_selesai,tempat,acara,komite,disposisi,keterangan,tanggal2,date_insert,tgl_disposisi,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen) values('$no_agend','$no_agend_tu','$no_undangan','$tgl_undangan','$tgl_terima','$tgl','$selesai','$tempat','$acara','$komite','$disposisi','$keterangan',NULL,now(),'$tgl_disposisi',$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen')";
           }else{ if ($tanggal2==!"" && $tgl_disposisi==""){
                     $sql="insert into undangan(agenda_und,agenda_tu,no_undangan,tgl_undangan,tgl_terima,tanggal,jam_selesai,tempat,acara,komite,disposisi,keterangan,tanggal2,date_insert,tgl_disposisi,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen) values('$no_agend','$no_agend_tu','$no_undangan','$tgl_undangan','$tgl_terima','$tgl','$selesai','$tempat','$acara','$komite','$disposisi','$keterangan','$tanggal2',now(),NULL,$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen')";
                  }else{
                     $sql="insert into undangan(agenda_und,agenda_tu,no_undangan,tgl_undangan,tgl_terima,tanggal,jam_selesai,tempat,acara,komite,disposisi,keterangan,tanggal2,date_insert,tgl_disposisi,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen) values('$no_agend','$no_agend_tu','$no_undangan','$tgl_undangan','$tgl_terima','$tgl','$selesai','$tempat','$acara','$komite','$disposisi','$keterangan',NULL,now(),'$tgl_disposisi',$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen')";
                    }
               }
			   }
   $no_terakhir=no_terakhir();		
   if ($no_agenda>$no_terakhir){
      $sql1="update no_undangan set no_terakhir=$no_agenda where tahun=$tahun";
      $result1=mysql_query($sql1);
   }
   $no_terakhir_tu=no_terakhir_tu();		
   if ($no_agenda_tu>$no_terakhir_tu){
      $sql1="update agenda_tu set no_terakhir=$no_agenda_tu where tahun=$tahun";
      $result1=mysql_query($sql1);
   }
 $result=mysql_query($sql);
 $id=mysql_insert_id();
			   
 }else{
    if ($tanggal2=="" && $tgl_disposisi==""){
      $sql="update undangan set no_undangan='$no_undangan',tgl_undangan='$tgl_undangan',tgl_terima='$tgl_terima',tanggal='$tgl',jam_selesai='$selesai',tempat='$tempat',acara='$acara',komite='$komite',disposisi='$disposisi',keterangan='$keterangan',tanggal2=NULL,date_insert=now(),tgl_disposisi=NULL,status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen' where undangan_id=$id";
      }else{if ($tanggal2=="" && $tgl_disposisi==!"")
	         {
               $sql="update undangan set no_undangan='$no_undangan',tgl_undangan='$tgl_undangan',tgl_terima='$tgl_terima',tanggal='$tgl',jam_selesai='$selesai',tempat='$tempat',acara='$acara',komite='$komite',disposisi='$disposisi',keterangan='$keterangan',tanggal2=NULL,date_insert=now(),tgl_disposisi='$tgl_disposisi',status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen' where undangan_id=$id";
             }else{ if ($tanggal2==!"" && $tgl_disposisi=="")
		            {
                       $sql="update undangan set no_undangan='$no_undangan',tgl_undangan='$tgl_undangan',tgl_terima='$tgl_terima',tanggal='$tgl',jam_selesai='$selesai',tempat='$tempat',acara='$acara',komite='$komite',disposisi='$disposisi',keterangan='$keterangan',tanggal2='$tanggal2',date_insert=now(),tgl_disposisi=NULL,status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen' where undangan_id=$id";
                    }else{
                       $sql="update undangan set no_undangan='$no_undangan',tgl_undangan='$tgl_undangan',tgl_terima='$tgl_terima',tanggal='$tgl',jam_selesai='$selesai',tempat='$tempat',acara='$acara',komite='$komite',disposisi='$disposisi',keterangan='$keterangan',tanggal2='$tanggal2',date_insert=now(),tgl_disposisi='$tgl_disposisi',status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen' where undangan_id=$id";
                     }
                  }
	       }
   $result=mysql_query($sql);

 }

if($result){
     if ($submit=="Save & Print"){
	   if($act=="new"){
	     ?>
             <SCRIPT language="JavaScript">
                alert('Data sudah tersimpan!');
             </SCRIPT> <?php
	   }else{?>
             <SCRIPT language="JavaScript">
                alert('Edit Sukses!');
             </SCRIPT> <?php
	   }
	  $link = "<script>window.open('http://118.98.233.100/sekretariat/lembar_disposisi_undangan.php?id=$id')</script>";
      echo $link;
     }else{
       header("Location: index.php?_mod=sekretariat&task=admin_undangan&act=new");
     }
}
