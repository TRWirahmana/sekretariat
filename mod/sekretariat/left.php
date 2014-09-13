
<?php
//session_start();
if (isset($_SESSION['mlevel'])){
$mlevel=$_SESSION['mlevel'];
//echo $mlevel;
}
if (isset($mlevel)){
if ($mlevel==1){
		//admin_block();
		surat_block();
		dokumen_block();
              undangan_block();

		//sch_block();
		report_block();
		}else{
		report_block();
		}
	}
	
//echo $home_url;
function getJmlSurat(){
    $sql="select * from surat_masuk where status=0";
    $qup=mysql_query($sql);	
	$jml=mysql_num_rows($qup);
	  
	return $jml;
}
function getJmlStock(){
    $sql="select * from stock_nomor where status=0";
    $qup=mysql_query($sql);	
	$jml=mysql_num_rows($qup);
	  
	return $jml;
}
function getJmlDok(){
    $sql="select * from dokumen where status=0";
    $qup=mysql_query($sql);	
	$jml=mysql_num_rows($qup);
	  
	return $jml;
}
function report_block(){
   global $home_url;
            $sekretariat_url = "index.php?_mod=sekretariat";
			$logout_url = "index.php?_mod=logout";	
			$rep_content  = "<li><a href=${sekretariat_url}&task=report&act=new><span class=rulycon-drawer-3></span>Surat Masuk</a></li>";
			$rep_content  .= "<li><a href=${sekretariat_url}&task=report_agenda&act=new><span class=rulycon-drawer-3></span>Jadwal</a></li>";
			//$rep_content  .= "<li><a href=${sekretariat_url}&task=report_dokumen&act=new>Dokumen</a></li>";
			$rep_content  .= "<li><a href=${logout_url}&task=logout class=btn id='btn-signin' type='button'><i>Logout</i></a></li>";
			
			//$rep_content  .= "<li><a href=${sekretariat_url}&task=login><i>Login Admin</i></a></li>";	
			
            block_create('Report',$rep_content);
                    }
					
function admin_block(){
   global $home_url;
            $sekretariat_url = "index.php?_mod=sekretariat";
						$logout_url = "index.php?_mod=logout";	
			if (getJmlSurat()==0){
			$adm_content  = "<li><a href=${sekretariat_url}&task=admin_surat&act=new><span class=rulycon-drawer-3></span>Surat Masuk</a></li>";
			}else{
			$adm_content  = "<li><a href=${sekretariat_url}&task=admin_surat&act=new><span class=rulycon-drawer-3></span>Surat Masuk (<font color=\"#FF7200\">".getJmlSurat()."</font>)</a></li>";
			}
			if (getJmlSurat()==0){
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_surat_baru&act=new><span class=rulycon-drawer-3></span>Surat Baru</a></li>";
			}else{
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_surat_baru&act=new><span class=rulycon-drawer-3></span>Surat Baru (<font color=\"#FF7200\">".getJmlSurat()."</font>)</a></li>";
			}
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_surat_keluar&act=new><span class=rulycon-drawer-3></span>Surat Keluar</a></li>";
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_stock><span class=rulycon-drawer-3></span>Nomor Surat(<font color=\"#FF7200\">".getJmlStock()."</font>)</a></li>";
			
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_dokumen&act=new><span class=rulycon-drawer-3></span>Distribusi Dokumen</a></li>";
			if (getJmlSurat()==0){
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_dokumen_baru&act=new><span class=rulycon-drawer-3></span>Dokumen Baru</a></li>";
			}else{
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_dokumen_baru&act=new><span class=rulycon-drawer-3></span>Dokumen Baru (<font color=\"#FF7200\">".getJmlDok()."</font>)</a></li>";
			}
			$adm_content  .= "<li><a href=${sekretariat_url}&task=admin_agenda&act=new><span class=rulycon-drawer-3></span>Jadwal</a></li>";
			
			//$adm_content  .= "<li><a href=${peraturan_url}&task=admin_skb&act=new>Daftar Kesepakatan Bersama</a></li>";
			//$adm_content  .= "<li><a href=${peraturan_url}&task=report_detail&act=new>Report Detail Peraturan</a></li>";	
			//$adm_content  .= "<li><a href=${peraturan_url}&task=logout>Logout</a></li>";	
	        $adm_content  .= "<li><a href=${logout_url}&task=logout class=btn id='btn-signin' type='button'><i>Logout</i></a></li>";
			 block_create('Menu',$adm_content);
                    }

 function surat_block(){
   global $home_url;
            $sekretariat_url = "index.php?_mod=sekretariat";
			$logout_url = "index.php?_mod=logout";	
			
			//if (getJmlSurat()==0){
			$srt_content  = "
                    <li><a href=${sekretariat_url}&task=admin_surat&act=new><span class=rulycon-drawer-3></span>Surat Masuk</a></li>
                    ";
			//}else{
			//$srt_content  = "<li><a href=${sekretariat_url}&task=admin_surat&act=new>Surat Masuk (<font color=\"red\">".getJmlSurat()."</font>)</a></li>";
			//}
			
			if (getJmlSurat()==0){
			$srt_content  .= "
			        <li><a href=${sekretariat_url}&task=admin_surat_baru&act=new><span class=rulycon-drawer-3></span>Surat Belum Didisposisi</a></li>";
			}else{
			$srt_content  .= "
                <li><a href=${sekretariat_url}&task=admin_surat_baru&act=new><span class=rulycon-drawer-3></span>Surat Belum Didisposisi (<font color=\"#FF7200\">".getJmlSurat()."</font>)</a></li>
                ";

            }
			//$srt_content  .= "<li><a href=${sekretariat_url}&task=admin_surat_keluar&act=new>Surat Keluar</a></li>";
			//$srt_content  .= "<li><a href=${sekretariat_url}&task=admin_stock>Nomor Surat(<font color=\"red\">".getJmlStock()."</font>)</a></li>";
			
	       // $srt_content  .= "<li><a href=${logout_url}&task=logout><i>Logout</i></a></li>";			
			 block_create("Surat", $srt_content);
                    }

function dokumen_block(){
   global $home_url;
            $sekretariat_url = "index.php?_mod=sekretariat";
			$logout_url = "index.php?_mod=logout";	
			if (getJmlDok()==0){
			$dok_content  = "<li><a href=${sekretariat_url}&task=admin_dokumen&act=new><span class=rulycon-drawer-3></span>Proses Dokumen</a></li>";
			}else{
			$dok_content  = "<li><a href=${sekretariat_url}&task=admin_dokumen&act=new><span class=rulycon-drawer-3></span>Proses Dokumen (<font color=\"#FF7200\">".getJmlDok()."</font>)</a></li>";
			}
			//$dok_content  .= "<li><a href=${sekretariat_url}&task=admin_dokumen_baru&act=new>Dokumen Baru</a></li>";
			
			//$dok_content  .= "<li><a href=${sekretariat_url}&task=admin_dokumen_baru&act=new>Dokumen Baru (<font color=\"red\">".getJmlDok()."</font>)</a></li>";
			//}
			
	       // $srt_content  .= "<li><a href=${logout_url}&task=logout><i>Logout</i></a></li>";			
			 block_create('Dokumen',$dok_content);
                    }
function undangan_block(){
   global $home_url;
            $sekretariat_url = "index.php?_mod=sekretariat";
			$logout_url = "index.php?_mod=logout";	
			
			$und_content  = "<li><a href=${sekretariat_url}&task=admin_undangan&act=new><span class=rulycon-drawer-3></span>Undangan</a></li>";
			$und_content  .= "<li><a href=${sekretariat_url}&task=list_undangan&act=new><span class=rulycon-drawer-3></span>Jadwal</a></li>";
		
			 block_create('Undangan',$und_content);
                    }

function sch_block(){
   global $home_url;
            $sekretariat_url = "index.php?_mod=sekretariat";
			$logout_url = "index.php?_mod=logout";	
			
			//$sch_content  = "<li><a href=${sekretariat_url}&task=admin_agenda&act=new>Jadwal</a></li>";
	       // $srt_content  .= "<li><a href=${logout_url}&task=logout><i>Logout</i></a></li>";			
			 block_create('Schedule',$sch_content);
                    }
?>