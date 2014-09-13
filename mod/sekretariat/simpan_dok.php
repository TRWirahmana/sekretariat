<?php
extract($_POST);

if(isset($_POST['status'])) {
$status=$_POST['status'];
}else{
$status=0;
} 


//echo $diteruskan2."<BR>".$disp."<BR>".$status;
if($act=="new"){
   if($status==0){
      $sql="insert into dokumen(tgl_masuk,nama_dokumen,pembawa,keperluan,tujuan,tgl_keluar,penerima,keterangan,status) values('$tgl_masuk','$nama_dokumen','$pembawa',$keperluan,'$tujuan',NULL,'$penerima','$keterangan',$status)";
              
   }else{
      $sql="insert into dokumen(tgl_masuk,nama_dokumen,pembawa,keperluan,tujuan,tgl_keluar,penerima,keterangan,status) values('$tgl_masuk','$nama_dokumen','$pembawa',$keperluan,'$tujuan','$tgl_keluar','$penerima','$keterangan',$status)";

          }
        
		 $result=mysql_query($sql);
		  header("Location: index.php?_mod=sekretariat&task=admin_dokumen&act=new");
 }else{
   $sql="update dokumen set tgl_masuk='$tgl_masuk',nama_dokumen='$nama_dokumen',pembawa='$pembawa',keperluan=$keperluan,tujuan='$tujuan',tgl_keluar='$tgl_keluar',penerima='$penerima',keterangan='$keterangan',status=$status where dokumen_id=$id";
   $result=mysql_query($sql);
  header("Location: index.php?_mod=sekretariat&task=admin_dokumen&act=new");
 }

   //$sql="insert into surat_masuk(no_agenda,tgl_surat,no_surat,pengirim,perihal,diteruskan_1,diteruskan_2,disposisi,tgl_selesai,keterangan,date_insert) values('$no_agenda','$tgl_surat','$no_surat','$pengirim','$perihal','$diteruskan_1','$diteruskan2','$disp','$tgl_selesai','$keterangan',now())";
//echo $sql;

  $id=mysql_insert_id();
  
  /*if($result){
     if ($submit=="Save & Print"){
	 echo "test";
     header("Location: disposisidpdf.php?id=$id");
  }else{
    echo "sukses";
  }
  
  }
  */
?>