<?php
extract($_POST);
$bulan = date("m");
$tahun = date("Y");

function no_terakhir()
{
  $tahun=date("Y");
  $sql="select * from no_agenda where tahun=$tahun";
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
function no_terakhir_puu()
{
  $tahun=date("Y");
  $sql="select * from agenda_puu where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
      $nomor=$row[2];
	 	}else{
	 $sql1="insert into agenda_puu(tahun,no_terakhir) values($tahun,$nomor)";
     $result1=mysql_query($sql1);
	}
	 $nomor=$nomor+1;
    return $nomor;
}

function no_terakhir_bk()
{
  $tahun=date("Y");
  $sql="select * from agenda_bk where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
      $nomor=$row[2];
	 	}else{
	 	 $sql1="insert into agenda_bk(tahun,no_terakhir) values($tahun,$nomor)";
     $result1=mysql_query($sql1);
	}
	 $nomor=$nomor+1;
    return $nomor;
}

function no_terakhir_klb()
{
  $tahun=date("Y");
  $sql="select * from agenda_klb where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
        $nomor=$row[2];
	 	}else{
	 $sql1="insert into agenda_klb(tahun,no_terakhir) values($tahun,$nomor)";
        $result1=mysql_query($sql1);
	}
	 $nomor=$nomor+1;
    return $nomor;
}

function no_terakhir_ktl()
{
  $tahun=date("Y");
  $sql="select * from agenda_ktl where tahun=$tahun";
  $query=mysql_query($sql);
  if ($row=mysql_fetch_array($query)) {
      $nomor=$row[2];
	 	}else{
	 $sql1="insert into agenda_ktl(tahun,no_terakhir) values($tahun,$nomor)";
     $result1=mysql_query($sql1);
	}
	 $nomor=$nomor+1;
    return $nomor;
}
if(isset($_POST['diteruskan_2'])) {
     $diteruskan_2=$_POST['diteruskan_2'];
	 }
else{
     $diteruskan_2="";
	}
	
if(empty($diteruskan_2))
  {
    $diteruskan2="";
  }
  else
  {
    $N = count($diteruskan_2);
	$diteruskan2="";
    for($i=0; $i < $N; $i++)
    {
      $diteruskan2 .=$diteruskan_2[$i]."/";
    }
  }
 if(isset($_POST['disposisi'])) {
     $disposisi=$_POST['disposisi'];
 }else{
     $disposisi="";
 }
if(empty($disposisi))
  {
    $disp="";
  }
  else
  {
    $N = count($disposisi);
	$disp="";
    for($i=0; $i < $N; $i++)
    {
      $disp .=$disposisi[$i]."/";
    }
  }
  
if(isset($_POST['status'])) {
   $status=$_POST['status'];
 }else{
   $status=0;
} 

$perihal=str_replace("'","#",$perihal);
if($act=="new"){
   $no_agenda_tu=no_urut_tu();
   $no_agend_tu = $no_agenda_tu."/TU/".$bulan."/".$tahun;
   $no_agenda    = no_urut();
   $no_agend  = $no_agenda."/KHO/".$tahun;
   if($tgl_surat!="" && $tgl_selesai!=""){
      $sql="insert into surat_masuk(no_agenda,agenda_tu,tgl_surat,no_surat,pengirim,perihal,diteruskan_2,disposisi,tgl_selesai,keterangan,date_insert,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen,tgl_terima) values('$no_agend','$no_agend_tu','$tgl_surat','$no_surat','$pengirim','$perihal','$diteruskan2','$disp','$tgl_selesai','$keterangan',now(),$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen','$tgl_terima')";            
     }else{
      if($tgl_surat!="" && $tgl_selesai==""){
	      $sql="insert into surat_masuk(no_agenda,agenda_tu,tgl_surat,no_surat,pengirim,perihal,diteruskan_2,disposisi,tgl_selesai,keterangan,date_insert,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen,tgl_terima) values('$no_agend','$no_agend_tu','$tgl_surat','$no_surat','$pengirim','$perihal','$diteruskan2','$disp',NULL,'$keterangan',now(),$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen','$tgl_terima')";
        } else {
          if($tgl_selesai!="" && $tgl_surat==""){
		     $sql="insert into surat_masuk(no_agenda,agenda_tu,tgl_surat,no_surat,pengirim,perihal,diteruskan_2,disposisi,tgl_selesai,keterangan,date_insert,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen,tgl_terima) values('$no_agend','$no_agend_tu',NULL,'$no_surat','$pengirim','$perihal','$diteruskan2','$disp','$tgl_selesai','$keterangan',now(),$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen','$tgl_terima')";
            } else{
			        $sql="insert into surat_masuk(no_agenda,agenda_tu,tgl_surat,no_surat,pengirim,perihal,diteruskan_2,disposisi,tgl_selesai,keterangan,date_insert,status,agenda_menteri,disposisi_menteri,agenda_sesjen,disposisi_sesjen,tgl_terima) values('$no_agend','$no_agend_tu',NULL,'$no_surat','$pengirim','$perihal','$diteruskan2','$disp',NULL,'$keterangan',now(),$status,'$agenda_menteri','$disp_menteri','$agenda_sesjen','$disp_sesjen','$tgl_terima')"; 
		  }
      }
   }
   //echo $sql;	
   $result=mysql_query($sql);
   $id=mysql_insert_id();
 
	if($_FILES['fileupload']['size'] > 0) {
       $fileName = $_FILES['fileupload']['name'];
       $tmpName  = $_FILES['fileupload']['tmp_name'];
       $fileSize = $_FILES['fileupload']['size'];
       $fileType = $_FILES['fileupload']['type'];

       $fp      = fopen($tmpName, 'r');
       $content = fread($fp, filesize($tmpName));
       $content = addslashes($content);
       fclose($fp);

       if(!get_magic_quotes_gpc()) {
          $fileName = addslashes($fileName);
       }
	   $namafile=str_replace("/","_",$no_agend);
          $namafile .=".pdf";

	   $sql2="update surat_masuk set nama_file='$namafile',type='$fileType',size='$fileSize',content='$content' where surat_id=$id";
	   $result2=mysql_query($sql2);
   	}
	
   /*if(!empty($diteruskan_2))
   {
     $N = count($diteruskan_2);
	 $diteruskan2="";
     for($i=0; $i < $N; $i++)
     {
	    switch ($diteruskan_2[$i]) {
          case 1:
		      $no_agenda_puu=no_terakhir_puu()."/PUU/".date("j-n-Y");
              $sql1="insert into surat_puu(surat_id,no_agenda_puu,date_insert) values('$id','$no_agend_tu',now())";
              $result1=mysql_query($sql1);
			  $no_terakhir_puu=no_terakhir_puu();		
              $sql1="update agenda_puu set no_terakhir=$no_terakhir_puu where tahun=$tahun";
              $result1=mysql_query($sql1);
              break;
          case 2:
              $no_agenda_bk=no_terakhir_bk()."/PUU/".date("j-n-Y");
              $sql1="insert into surat_puu(surat_id,no_agenda_puu,date_insert) values('$id','$no_agend_tu',now())";
              $result1=mysql_query($sql1);
			  $no_terakhir_puu=no_terakhir_puu();		
              $sql1="update agenda_puu set no_terakhir=$no_terakhir_puu where tahun=$tahun";
              $result1=mysql_query($sql1);
              break;
          case 3:
              $no_agenda_puu=no_terakhir_puu()."/PUU/".date("j-n-Y");
              $sql1="insert into surat_puu(surat_id,no_agenda_puu,date_insert) values('$id','$no_agend_tu',now())";
              $result1=mysql_query($sql1);
			  $no_terakhir_puu=no_terakhir_puu();		
              $sql1="update agenda_puu set no_terakhir=$no_terakhir_puu where tahun=$tahun";
              $result1=mysql_query($sql1);
              break;
		  case 4:
              $no_agenda_puu=no_terakhir_puu()."/PUU/".date("j-n-Y");
              $sql1="insert into surat_puu(surat_id,no_agenda_puu,date_insert) values('$id','$no_agend_tu',now())";
              $result1=mysql_query($sql1);
			  $no_terakhir_puu=no_terakhir_puu();		
              $sql1="update agenda_puu set no_terakhir=$no_terakhir_puu where tahun=$tahun";
              $result1=mysql_query($sql1);
              break;
          default:
              echo "i is not equal to 0, 1 or 2";
        }
     }
   }*/
   $no_terakhir=no_terakhir();		
   if ($no_agenda>$no_terakhir){
      $sql1="update no_agenda set no_terakhir=$no_agenda where tahun=$tahun";
      $result1=mysql_query($sql1);
   }
   
   $no_terakhir_tu=no_terakhir_tu();		
   if ($no_agenda_tu>$no_terakhir_tu){
      $sql1="update agenda_tu set no_terakhir=$no_agenda_tu where tahun=$tahun";
      $result1=mysql_query($sql1);
   }
 }else{
       if($tgl_surat!="" && $tgl_selesai!=""){
          $sql="update surat_masuk set tgl_surat='$tgl_surat',no_surat='$no_surat',pengirim='$pengirim',perihal='$perihal',diteruskan_2='$diteruskan2',disposisi='$disp',tgl_selesai='$tgl_selesai',keterangan='$keterangan',status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen',tgl_terima='$tgl_terima' where surat_id=$id";
		  }else{ 
		     if($tgl_surat!="" && $tgl_selesai==""){
			   $sql="update surat_masuk set tgl_surat='$tgl_surat',no_surat='$no_surat',pengirim='$pengirim',perihal='$perihal',diteruskan_2='$diteruskan2',disposisi='$disp',tgl_selesai=NULL,keterangan='$keterangan',status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen',tgl_terima='$tgl_terima' where surat_id=$id";
		     } else{
  			    if($tgl_selesai!="" && $tgl_surat==""){
				   $sql="update surat_masuk set tgl_surat=NULL,no_surat='$no_surat',pengirim='$pengirim',perihal='$perihal',diteruskan_2='$diteruskan2',disposisi='$disp',tgl_selesai=NULL,keterangan='$keterangan',status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen',tgl_terima='$tgl_terima' where surat_id=$id";
		       }else{
			      $sql="update surat_masuk set tgl_surat=NULL,no_surat='$no_surat',pengirim='$pengirim',perihal='$perihal',diteruskan_2='$diteruskan2',disposisi='$disp',tgl_selesai=NULL,keterangan='$keterangan',status=$status,agenda_menteri='$agenda_menteri',disposisi_menteri='$disp_menteri',agenda_sesjen='$agenda_sesjen',disposisi_sesjen='$disp_sesjen',tgl_terima='$tgl_terima' where surat_id=$id";
		          }
			   }
			}
//echo $sql;	 
   $result=mysql_query($sql);
   
   if($_FILES['fileupload']['size'] > 0)
   {
    $fileName = $_FILES['fileupload']['name'];
    $tmpName  = $_FILES['fileupload']['tmp_name'];
    $fileSize = $_FILES['fileupload']['size'];
    $fileType = $_FILES['fileupload']['type'];

    $fp      = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    if(!get_magic_quotes_gpc())
    {
    $fileName = addslashes($fileName);
    }
	$namafile=str_replace("/","_",$no_agend);
	$namafile .=".pdf";
	 $sql2="update surat_masuk set nama_file='$namafile',type='$fileType',size='$fileSize',content='$content' where surat_id=$id";
	 $result=mysql_query($sql2);
    }
	}
  if($result){
     if ($submit=="Save & Print"){
	   if($act=="new"){
	     ?>
          <SCRIPT language="JavaScript">
            alert('Data sudah tersimpan!');
          </SCRIPT> <?php
	   }else{
	     ?>
          <SCRIPT language="JavaScript">
            alert('Edit Sukses!');
          </SCRIPT> <?php
	   }
	  $link = "<script>window.open('http://118.98.233.100/sekretariat/lembar_disposisi_kotak.php?id=$id')</script>";
      echo $link;
     }else{
       header("Location: index.php?_mod=sekretariat&task=admin_surat&act=new");
 }
  
 }
  
?>