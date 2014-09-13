<?php
extract($_POST);
function getNoId(){
    $sql="select * from stock_nomor where status=0 ORDER BY no_id ASC";
    $qup=mysql_query($sql);	
	$jml=mysql_num_rows($qup);
	if ($jml>0){
	  while ($row=mysql_fetch_array($qup)){
        $no_id=$row[0];
        break;		
	  }
	}else{
	  $no_id="X";
	}
	return $no_id;
}

function getNomor($no_id){
    $sql="select * from stock_nomor where no_id=$no_id and status=0";
    $qup=mysql_query($sql);	
	$nomor=0;
	  if ($row=mysql_fetch_array($qup)){
         $nomor=$row[2];
	  }
	return $nomor;
}
if($act=="new"){
  
   $no_id=getNoId();
   if ($no_id!="X"){
   
   $no_urut=getNomor($no_id);
   $tahun=date("Y");
   if ($ttd==1 || $ttd==2){
     if($jns_surat==2){
	    $nomor_surat=$no_urut."/A.A5/KP/".$tahun;
	 }else{
        if ($sifat=="Rahasia"){
            $nomor_surat=$no_urut."/A.A5/RHS/".$kode_hal."/".$tahun;
	    }else{
	        $nomor_surat=$no_urut."/A.A5/".$kode_hal."/".$tahun;
	     } 
	 }
   }else{
     if($jns_surat==2){
	    $nomor_surat=$no_urut."/A5.4/KP/".$tahun;
	 }else{
        if ($sifat=="Rahasia"){
            $nomor_surat=$no_urut."/A5.".$asal_surat."/RHS/".$kode_hal."/".$tahun;
	    }else{
	        $nomor_surat=$no_urut."/A5.".$asal_surat."/".$kode_hal."/".$tahun;
	    }
      }
   }
   if ($jns_surat==1){
        $sql="insert into surat_keluar(nomor_id,no_surat,tanggal_surat,pemroses,ttd,tujuan_surat,kode_hal,perihal,sifat_surat,date_insert,jenis) values($no_id,'$nomor_surat','$tgl_surat',$asal_surat,$ttd,'$tujuan','$kode_hal','$perihal','$sifat',now(),$jns_surat)";
   }else{
       $pelaksana=str_replace(";","#",$pelaksana);
	   $hal_surat=$pelaksana."/".$perihal;
       $sql="insert into surat_keluar(nomor_id,no_surat,tanggal_surat,pemroses,ttd,tujuan_surat,kode_hal,perihal,sifat_surat,date_insert,jenis) values($no_id,'$nomor_surat','$tgl_surat',$asal_surat,$ttd,'$tujuan',5,'$hal_surat','Biasa',now(),$jns_surat)";
   }
   $sql2="update stock_nomor set status=1 where no_id=$no_id";
   $result=mysql_query($sql);
   $result2=mysql_query($sql2);
   //echo $nomor_surat."<br>".$sql."<br>".$sql2;
 } 
 } else {
 
   $tahun=date("Y");
   if ($ttd==1 || $ttd==2){
     if($jns_surat==2){
	    $nomor_surat=$no_awal."/A.A5/KP/".$tahun;
	 }else{
        if ($sifat=="Rahasia"){
            $nomor_surat=$no_awal."/A.A5/RHS/".$kode_hal."/".$tahun;
	    }else{
	        $nomor_surat=$no_awal."/A.A5/".$kode_hal."/".$tahun;
	     } 
	 }
   }else{
     if($jns_surat==2){
	    $nomor_surat=$no_awal."/A5.4/KP/".$tahun;
	 }else{
        if ($sifat=="Rahasia"){
            $nomor_surat=$no_awal."/A5.".$asal_surat."/RHS/".$kode_hal."/".$tahun;
	    }else{
	        $nomor_surat=$no_awal."/A5.".$asal_surat."/".$kode_hal."/".$tahun;
	    }
      }
   }
   if ($jns_surat==1){
       $sql="update surat_keluar set no_surat='$nomor_surat',tanggal_surat='$tgl_surat',pemroses=$asal_surat,ttd=$ttd,tujuan_surat='$tujuan',kode_hal='$kode_hal',perihal='$perihal',sifat_surat='$sifat',jenis=$jns_surat where surat_keluar_id=$id";
   }else{
       $pelaksana=str_replace(";","#",$pelaksana);
	   $hal_surat=$pelaksana."/".$hal;
       $sql="update surat_keluar set no_surat='$nomor_surat',tanggal_surat='$tgl_surat',pemroses=$asal_surat,tujuan_surat='$tujuan',perihal='$perihal',sifat_surat='Biasa$',jenis=$jns_surat where surat_keluar_id=$id";
   }
   $result=mysql_query($sql);
 }
if($result){
     if($act=="new"){	
    ?>
	<font color="red">
      <SCRIPT language="JavaScript">
      alert('No. Surat:  <?php echo $nomor_surat;?>');
	  window.location="index.php?_mod=administrasi&task=admin_surat_keluar&act=new";
      </SCRIPT> </FONT><?php
	  //else{
	 // header("Location: index.php?_mod=administrasi&task=admin_surat_keluar&act=new");
	  }else {?>
	
      <SCRIPT language="JavaScript">
       window.location="index.php?_mod=administrasi&task=admin_surat_keluar&act=new";
      </SCRIPT> </FONT><?php
	  }
}
  
?>