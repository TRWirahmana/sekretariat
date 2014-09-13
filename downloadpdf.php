<?
	session_start();
	$conn = mysql_connect("localhost","root",""); 
    $db=mysql_select_db("peraturan");
    if(isset($_GET['id']))
    {
     $id    = $_GET['id'];
	 }
	include("module/mod.config.php");
	include("module/mod.global.php");
 	require_once("inc/PHPRtfLite.php");
	//require_once("inc/rtf/Rtf.php");
	define(_DIRPATH,"F:/new.php/psikogram.local");
	define(_WEBPATH,"http://psikogram.local");
	
	function _createHeader()
	{
		global $project_info,$pdf,$sect;
		$experd_logo = 'images/experd_small.jpg';
		$client_logo = 'images/'.$project_info->project_logo;
		//$header = &$pdf->Header('all');
		//$table = &$header->addTable('center');
		$table->addRows(1, 0.8);
		$table->setLeftPosition(-2.5);
		$table->addColumnsList(array(3,9.5,5));
		$cell = &$table->getCell(1, 1);
		//$cell->addImage(_DIRPATH.'/images/'.$experd_logo, new PHPRtfLite_ParFormat('left'));
		$cell->addImage($experd_logo, new PHPRtfLite_ParFormat('left'));
		$table->writeToCell(1, 2, '<b>HASIL PSIKOASESMEN<br/>'.$project_info->project_adv.'<br/>'.$project_info->project_perusahaan.'</b>', new PHPRtfLite_Font(12, 'Arial'), new PHPRtfLite_ParFormat('center'));
		$cell = &$table->getCell(1, 3);
		//$cell->addImage(_DIRPATH.'/images/'.$client_logo, new PHPRtfLite_ParFormat('right'));
		$cell->addImage($client_logo, new PHPRtfLite_ParFormat('right'));
		//$sect = &$rtf->addSection();
		$header->writeText('', new PHPRtfLite_Font(12, 'Arial'), new PHPRtfLite_ParFormat('center'));
		_createCandidateInfo($header);
	}
	
	function _createCandidateInfo($header)
	{
		global $project_source_info,$rtf,$sect;
		$table = &$header->addTable('center');
		$table->addRows(2, 0.4);
		$table->setVerticalAlignmentOfCells('center',1,1,2,5);
		//$colWidth = ($sect->getLayoutWidth()-1)/4;
		$colWidth = 14/4;
		$table->addColumnsList(array($colWidth-0.5,$colWidth+0.5, 1, $colWidth-0.5,$colWidth+0.5));
		$font = new PHPRtfLite_Font(8,'Tahoma');
		$table->writeToCell(1, 1, '<b>Nomor Peserta</b>', $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(1, 2, $project_source_info->ps_peserta_no, $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(2, 1, '<b>Nama Peserta</b>', $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(2, 2, $project_source_info->ps_peserta_nama, $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(1, 4, '<b>Kota Tes</b>', $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(1, 5, $project_source_info->ps_test_kota, $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(2, 4, '<b>Tanggal Tes</b>', $font, new PHPRtfLite_ParFormat());
		$table->writeToCell(2, 5, $project_source_info->ps_test_tanggal2, $font, new PHPRtfLite_ParFormat());
		$border = new PHPRtfLite_Border_Format("2px", "#000000", "solid", null);
		$cell = &$table->getCell(1, 1);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,true,false,false); //ltrb
		$cell = &$table->getCell(1, 2);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,true,false,false);
		$cell = &$table->getCell(1, 3);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,true,false,false);
		$cell = &$table->getCell(1, 4);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,true,false,false);
		$cell = &$table->getCell(1, 5);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,true,false,false);
		$cell = &$table->getCell(2, 1);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); //ltrb
		$cell = &$table->getCell(2, 2);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); //ltrb
		$cell = &$table->getCell(2, 3);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); //ltrb
		$cell = &$table->getCell(2, 4);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); //ltrb
		$cell = &$table->getCell(2, 5);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); //ltrb
	}
	
	function _createTable($a,$b)
	{
		global $rtf,$sect,$project_id,$ps_id;
		$table = &$sect->addTable('center');
		$table->addRows(2, 0.4);
		
		$total_posisi = 3;$arr_cols[] = 5; // width "kompetensi name"
		for ($i=0;$i<($total_posisi*3);$i++) $arr_cols[] = 0.99; 
		$table->addColumnsList($arr_cols);
		$font = new PHPRtfLite_Font(8,'Tahoma');
		$table->mergeCellRange(1, 1, 2, 1);
		for ($i=0;$i<$total_posisi;$i++) $table->mergeCellRange(1, 2+(3*$i), 1, 4+(3*$i));
		$table->writeToCell(1, 1, '<b>Kompetensi</b>', $font, new PHPRtfLite_ParFormat('center'));
		$cell = &$table->getCell(1, 1);$cell->setVerticalAlignment('center');
		$qup = mysql_query("select posisi_id,pp_standar from t_project_posisi where project_id = $project_id group by posisi_id limit $a,$b");	
		for ($i=0;$i<$total_posisi;$i++)
		{
			$rup = mysql_fetch_object($qup);
			$table->writeToCell(1, 2+(3*$i), '<b>'.getPosisiName($rup->posisi_id).'</b>', $font, new PHPRtfLite_ParFormat('center'));
			$table->writeToCell(2, 2+(3*$i), '<b>Stdr</b>', $font, new PHPRtfLite_ParFormat('center'));
			$table->writeToCell(2, 3+(3*$i), '<b>Lvl</b>', $font, new PHPRtfLite_ParFormat('center'));
			$table->writeToCell(2, 4+(3*$i), '<b>Gap</b>', $font, new PHPRtfLite_ParFormat('center'));
		}
		$border = new PHPRtfLite_Border_Format("1px", "#000000", "solid", null);
		$border1 = new PHPRtfLite_Border_Format("1px", "#0000ff", "dash", null); 
		$table->setBordersOfCells($border,1,1,2,1+($total_posisi*3),true,true,true,true);
		$table->setBackgroundForCellRange('#CCCCCC',1,1,2,1+($total_posisi*3));
		
		/* table kompetensi */
		$qup = mysql_query("select * from t_project_kompetensi where project_id = $project_id");
		$totalkomp = mysql_num_rows($qup);
		$brs=0;
		for ($i=0;$i<mysql_num_rows($qup);$i++)
		{
			$rup = mysql_fetch_object($qup);
			$table->addRows(1, 0.4);
			$table->writeToCell( (3+$i),1, getKompetensiName($rup->kompetensi_id), $font, new PHPRtfLite_ParFormat('left'));
			$qup2 = mysql_query("select posisi_id,pp_standar from t_project_posisi where project_id = $project_id group by posisi_id limit $a,$b");	
			
			for ($j=0;$j<mysql_num_rows($qup2);$j++)
			{
				$rup2 = mysql_fetch_object($qup2);
				$rek_komp[$j]=getRekKompetensi($project_id,$rup2->posisi_id,$ps_id);
				$rek_study[$j]=getKesesuaianStudi($rup2->posisi_id,$ps_id);
				$rek_akhir[$j]=getRekAkhir($project_id,$rup2->posisi_id,$ps_id);
				
				if (checkPosisiExist($project_id,$rup->pk_id,$rup2->posisi_id))
				{
					$level = getLevelPeserta($ps_id,$rup->kompetensi_id);	
					$table->setBackgroundForCellRange('#CCCCCC',(3+$i),2+(3*$j),(3+$i),2+(3*$j));				
					$table->writeToCell((3+$i), 2+(3*$j), $rup2->pp_standar, $font, new PHPRtfLite_ParFormat('center'));
					$table->setBackgroundForCellRange('#C5EFFD',(3+$i),3+(3*$j),(3+$i),3+(3*$j));						
					$table->writeToCell((3+$i), 3+(3*$j), $level, $font, new PHPRtfLite_ParFormat('center'));	
					$table->setBackgroundForCellRange('#FFFFFF',(3+$i),4+(3*$j),(3+$i),4+(3*$j));					
					if (($level-$rup2->pp_standar) < 0)
						$table->writeToCell((3+$i), 4+(3*$j), '<b>'.($level-$rup2->pp_standar).'</b>', new PHPRtfLite_Font(8,'Tahoma','#FF0000'), new PHPRtfLite_ParFormat('center'));
					else
						$table->writeToCell((3+$i), 4+(3*$j), ($level-$rup2->pp_standar), $font, new PHPRtfLite_ParFormat('center'));
				}
				else
				{
					$table->setBackgroundForCellRange('#A8B1B8',(3+$i),2+(3*$j),(3+$i),4+(3*$j));
					
				}
			}
			$brs++;
		}
		$table->addRows(1, 0.4);
		$table->writeToCell((3+$brs), 1, 'Rekomendasi Berdasarkan Kompetensi', $font, new PHPRtfLite_ParFormat('right'));
		for ($i=0;$i<$total_posisi;$i++) $table->mergeCellRange((3+$brs), 2+(3*$i), (3+$brs), 4+(3*$i));
		for ($i=0;$i<$total_posisi;$i++){
		   $table->writeToCell((3+$brs), 2+(3*$i), $rek_komp[$i], $font, new PHPRtfLite_ParFormat('center'));
		}
		$table->setBordersOfCells($border,3,1,$totalkomp+3,1+($total_posisi*3),true,true,true,true);
		$table->addRows(1, 0.4);
		$table->writeToCell((4+$brs), 1, 'Kesesuaian Bidang Studi', $font, new PHPRtfLite_ParFormat('right'));
		for ($i=0;$i<$total_posisi;$i++){
		    $table->writeToCell((4+$brs), 3+(3*$i), $rek_study[$i], $font, new PHPRtfLite_ParFormat('center'));
		}
		$table->setBordersOfCells($border,($brs+4),1,($brs+4),1,true,true,true,true);
		$table->setBordersOfCells($border,($brs+4),4,($brs+4),4,false,false,true,false);
		$table->setBordersOfCells($border,($brs+4),7,($brs+4),7,false,false,true,false);
		$table->setBordersOfCells($border,($brs+4),10,($brs+4),10,false,false,true,false);
		$table->addRows(1, 0.4);
		$table->writeToCell((5+$brs), 1, 'REKOMENDASI AKHIR', $font, new PHPRtfLite_ParFormat('right'));
		for ($i=0;$i<$total_posisi;$i++) $table->mergeCellRange((5+$brs), 2+(3*$i), (5+$brs), 4+(3*$i));
		for ($i=0;$i<$total_posisi;$i++){
		$table->writeToCell((5+$brs), 2+(3*$i), $rek_akhir[$i], $font, new PHPRtfLite_ParFormat('center'));
		}
		$table->mergeCellRange(1, 1, 2, 1);
		$table->setBordersOfCells($border,($brs+5),1,($brs+5),1+($total_posisi*3),true,true,true,true);
		$sect->writeText("<b>Keterangan:</b><br/><b>Stdr:</b> Standar penilaian kompetensi<br/><b>Lvl:</b> Level aktual kompetensi<br/><b>Gap:</b> Selisih level aktual dengan standar penilaian kompetensi", new PHPRtfLite_Font(8, 'Arial'), new PHPRtfLite_ParFormat('left'));
	}
	
	function getKesesuaianStudi($posisi_id,$ps_id)
	{
	    $qup = mysql_query("select ps_bidang_studi from t_project_source where ps_id = $ps_id");
		$rup = mysql_fetch_array($qup);
		$bid_studi = $rup[0];
		$comp="Tidak Sesuai";
		switch ($posisi_id){
			case 1 : if ($bid_studi==1||$bid_studi==2||$bid_studi==3||$bid_studi==4) $comp="Sesuai";			
			         break;
			case 2 : if ($bid_studi==1||$bid_studi==2||$bid_studi==3) $comp="Sesuai";			
			         break;
			case 3 : if ($bid_studi==1) $comp="Sesuai";			
			         break;
			case 4 : if ($bid_studi==2) $comp="Sesuai";			
			         break;
			case 5 : if ($bid_studi==2) $comp="Sesuai";			
			         break;
			case 6 : if ($bid_studi==1) $comp="Sesuai";			
			         break;
		}		
		return $comp;
	}
	
	function getRekKompetensi($project_id,$posisi_id,$ps_id)
	{
	
		$qup = mysql_query("select pp_standar from t_project_posisi where posisi_id = $posisi_id and project_id = $project_id");
		$rup = mysql_fetch_array($qup);
		$standar = $rup[0];		
	    $bt= getLevelPeserta($ps_id,5);	
		$total_gap=0;
		$qup = mysql_query("select pk_id, kompetensi_id from t_project_kompetensi where project_id = $project_id");	    
		while ($rup = mysql_fetch_array($qup)){		
		    $gap=0;
		  if (checkPosisiExist($project_id,$rup[0],$posisi_id)){		       
		       $level = getLevelPeserta($ps_id,$rup[1]);
			   if ($level<$standar)$gap=1;
		   }
		  $total_gap=$total_gap+$gap;
		}	
		$komp="";
		if ($bt>=$standar && $total_gap<=1)	{
		    $komp="Kompeten";
		}elseif ($bt>=$standar && $total_gap<=3 && $total_gap>1){
			$komp="Cukup Kompeten"; 
			}elseif ($bt>=$standar && $total_gap<=5 && $total_gap>3)	
			{ $komp="Kurang Kompeten";
		}else {
           $komp="Tidak Kompeten";		
		}
		return $komp;	
	}
	
	function getRekAkhir($project_id,$posisi_id,$ps_id)
	{
	   $komp = getRekKompetensi($project_id,$posisi_id,$ps_id);
	   $match_study = getKesesuaianStudi($posisi_id,$ps_id);
	   if ($match_study=="Sesuai") { 
		   $rek_akhir=$komp;
		   }else{
           $rek_akhir="Tidak Kompeten";		   
		   }
		 
		return $rek_akhir;
	}
	
	function getUraian($kompetensi_id,$level,$temp)
	{
	    if ($kompetensi_id==9) $kompetensi_id=18;
	    $qup = mysql_query("select count(*) from m_uraian_kompetensi where uk_template = '$temp' and kompetensi_id = $kompetensi_id and uk_level = $level and status_id = 1");
		$rup = mysql_fetch_array($qup);
		$total = $rup[0];
		
		if ($total <> 0)
		{
			$random_id = rand(1,10);
			$total++;
			
			$qup = mysql_query("select uk_uraian from m_uraian_kompetensi where uk_template = '$temp' and kompetensi_id = $kompetensi_id and uk_level = $level and status_id = 1 and uk_versi = $random_id");
			$rup = mysql_fetch_array($qup);
			return $rup[0];
		}
		else
		return "N/A";
	}
	
	function getUraianSaran($kompetensi_id)
	{
	    $qup = mysql_query("select count(*) from m_uraian_saran where kompetensi_id = $kompetensi_id");
		$rup = mysql_fetch_array($qup);
		$total = $rup[0];
		if ($total <> 0)
		{
			$random_id = rand(1,$total);
			$total++;
			$sql="select us_saran from m_uraian_saran where kompetensi_id = $kompetensi_id and us_kode = $random_id";
			$qup = mysql_query($sql);
			$rup = mysql_fetch_array($qup);
			return $rup[0];
		}
		else
		return "N/A";
	}
	
	function _createUraian($posisi_id=1)
	{
		global $rtf,$sect,$project_id,$ps_id;
		$table = &$sect->addTable();
		$rowact = 2;
		$qup = mysql_query("select pp_standar from t_project_posisi where posisi_id = $posisi_id and project_id = $project_id");
		$rup = mysql_fetch_array($qup);
		$standar = $rup[0];
        $sql ="select pu_area_kekuatan,pu_area_pengembangan,pu_kesimpulan,pu_saran_pengembangan from t_project_uraian where project_id = $project_id and ps_id=$ps_id";
		$qup=mysql_query($sql);
		if ($res=mysql_fetch_array($qup)) {
			$area_k = $res[0];
			$area_p = $res[1];
			$kes    = $res[2];
			$sp 	= $res[3];
		}
			
		 $area_k=explode("#",$area_k);
		 $awal=true;
		 for ($i=0;$i<count($area_k);$i++){
		    if ($area_k[$i]!=""){
			   if ($awal){
			    $table->addRows(1, 0.4);
				$table->addColumnsList(array(10.25,2,0.75,2));
				$font = new PHPRtfLite_Font(11,'Tahoma');
				$table->writeToCell(1, 1, '<b>AREA KEKUATAN</b>', $font, new PHPRtfLite_ParFormat('left'));
				$table->writeToCell(1, 2, '<b>Level</b>', $font, new PHPRtfLite_ParFormat('right'));
				$table->writeToCell(1, 3, '<b>/</b>', $font, new PHPRtfLite_ParFormat('center'));
				$table->writeToCell(1, 4, '<b>Standar</b>', $font, new PHPRtfLite_ParFormat('left'));
				$table->setBackgroundForCellRange('#CCCCCC',1,1,1,4);
				$awal=false;
			   }
			   $isi=explode("|",$area_k[$i]);
			   $title=$isi[0];
			   $uraian =$isi[1];
			   $kompetensi_id=getKompetensiId($title);
			   $table->addRows(1, 0.4);
			   $font = new PHPRtfLite_Font(11,'Tahoma');
			   $table->writeToCell($rowact, 1, '<b>'.$title.'</b>', $font, new PHPRtfLite_ParFormat('left'));
			   $table->writeToCell($rowact, 2, getLevelPeserta($ps_id,$kompetensi_id), $font, new PHPRtfLite_ParFormat('right'));
			   $table->writeToCell($rowact, 3, '/', $font, new PHPRtfLite_ParFormat('center'));
			   $table->writeToCell($rowact, 4, $standar, $font, new PHPRtfLite_ParFormat('left'));
			   $rowact++;
			   $table->addRows(1, 0.4);
			   $font = new PHPRtfLite_Font(10,'Tahoma');
			   $table->mergeCellRange($rowact, 1, $rowact, 4);
			   $table->writeToCell($rowact, 1, $uraian, $font, new PHPRtfLite_ParFormat('justify'));
			   $rowact++;
			}		 
		 }
		$sect = &$rtf->addSection();
		$table = &$sect->addTable();
        $rowact = 2;
		$area_p=explode("#",$area_p);
		$awal=true;
		 for ($i=0;$i<count($area_p);$i++){
		    if ($area_p[$i]!=""){
			   if ($awal){
			    $table->addRows(1, 0.4);
				$table->addColumnsList(array(10.25,2,0.75,2));
				$font = new PHPRtfLite_Font(11,'Tahoma');
				$table->writeToCell(1, 1, '<b>AREA PENGEMBANGAN</b>', $font, new PHPRtfLite_ParFormat('left'));
				$table->writeToCell(1, 2, '<b>Level</b>', $font, new PHPRtfLite_ParFormat('right'));
				$table->writeToCell(1, 3, '<b>/</b>', $font, new PHPRtfLite_ParFormat('center'));
				$table->writeToCell(1, 4, '<b>Standar</b>', $font, new PHPRtfLite_ParFormat('left'));
				$table->setBackgroundForCellRange('#CCCCCC',1,1,1,4);	
				$awal=false;
			   }
			   $isi_p=explode("|",$area_p[$i]);
			   $title_p=$isi_p[0];
			   $uraian_p =$isi_p[1];
			   $kompetensi_id=getKompetensiId($title_p);
			   $table->addRows(1, 0.4);
			   // echo $title_p;
			   $font = new PHPRtfLite_Font(11,'Tahoma');
			   $table->writeToCell($rowact, 1, '<b>'.$title_p.'</b>', $font, new PHPRtfLite_ParFormat('left'));
			   $table->writeToCell($rowact, 2, getLevelPeserta($ps_id,$kompetensi_id), $font, new PHPRtfLite_ParFormat('right'));
			   $table->writeToCell($rowact, 3, '/', $font, new PHPRtfLite_ParFormat('center'));
			   $table->writeToCell($rowact, 4, $standar, $font, new PHPRtfLite_ParFormat('left'));
			   $rowact++;
			   $table->addRows(1, 0.4);
			   $font = new PHPRtfLite_Font(10,'Tahoma');
			   $table->mergeCellRange($rowact, 1, $rowact, 4);
			   $table->writeToCell($rowact, 1, $uraian_p, $font, new PHPRtfLite_ParFormat('justify'));
			   $rowact++;
			}
		 
		 }	
		
		$sect = &$rtf->addSection();
		$table = &$sect->addTable();
		$rowact = 2;
		// Kesimpulan
		    $table->addRows(1, 0.4);
			$table->addRows(1, 0.4);
			$table->addColumnsList(array(10.25,2,0.75,2));			
			$font = new PHPRtfLite_Font(11,'Tahoma');
			$table->writeToCell(1, 1, '<b>Kesimpulan</b>', $font, new PHPRtfLite_ParFormat('left'));
			$table->setBackgroundForCellRange('#CCCCCC',1,1,1,4);
			$table = &$sect->addTable();		
			$table->addColumnsList(array(0.70,14.30,0,0));
		
			$font = new PHPRtfLite_Font(11,'Tahoma');
		    $kesimpulan = explode("#",$kes);
			$mf  = explode("|",$kesimpulan[0]);
			$isi = explode("$",$mf[1]);
			
			$table->addRows(1, 0.4);
			$table->mergeCellRange(1, 1,1, 4);			
			$table->writeToCell(1, 1, '<b>'.$mf[0].'</b>', $font, new PHPRtfLite_ParFormat('left'));
			
			$no=1;				
			for ($i=0;$i<count($isi);$i++){
			       if ($isi[$i]!=""){
				      	$table->addRows(1, 0.4);	
						$font = new PHPRtfLite_Font(10,'Tahoma');		
			         	$table->writeToCell($rowact, 1, $no.". ", $font, new PHPRtfLite_ParFormat('left'));
			         	$table->writeToCell($rowact, 2, $isi[$i], $font, new PHPRtfLite_ParFormat('justify'));
						$rowact++;	
						$no++;				      
				   }				   
			   }
			
		$r_akhir  = explode("|",$kesimpulan[1]);	
		
		$rowact++;		
		$table->addRows(1, 0.4);
		$table->writeToCell($rowact, 1, " ", $font, new PHPRtfLite_ParFormat('left'));
		$table->writeToCell($rowact, 2, " ", $font, new PHPRtfLite_ParFormat('justify'));
		$table = &$sect->addTable();		
		$table->addColumnsList(array(0.60,6.50,0.40,7.50));
		$font = new PHPRtfLite_Font(11,'Tahoma');
		$table->addRows(1, 0.4);
		$rowact=2;
		$table->mergeCellRange(1, 1,1, 4);
		$table->writeToCell(1, 1, '<b>'.$r_akhir[0].'</b>', $font, new PHPRtfLite_ParFormat('left'));
		$isi=explode("$",$r_akhir[1]);
		$no=1;
		for ($i=0;$i<count($isi);$i++){
			if ($isi[$i]!=""){
			    $detail_isi=explode("@",$isi[$i]);
			   	$table->addRows(1, 0.4);		
				$font = new PHPRtfLite_Font(10,'Tahoma');	
			    $table->writeToCell($rowact, 1, $no.". ", $font, new PHPRtfLite_ParFormat('left'));
			    $table->writeToCell($rowact, 2, $detail_isi[0], $font, new PHPRtfLite_ParFormat('justify'));
				$table->writeToCell($rowact, 3, ": ", $font, new PHPRtfLite_ParFormat('left'));
				$table->writeToCell($rowact, 4, $detail_isi[1], $font, new PHPRtfLite_ParFormat('left'));
				$rowact++;		
				$no++;	
			}
		}	  			
		
        $sect = &$rtf->addSection();
		$table = &$sect->addTable();
		//echo $sp;
		$saran=explode("|",$sp);
		$rowact = 2;
		$font = new PHPRtfLite_Font(10,'Tahoma');
		// Saran Pengembangan
		    $table->addRows(1, 0.4);
			$table->addColumnsList(array(0.70,14.30,0,0));
			$font = new PHPRtfLite_Font(11,'Tahoma');
			$table->mergeCellRange(1, 1, 1, 4);
			$table->writeToCell(1, 1, '<b>Saran Pengembangan</b>', $font, new PHPRtfLite_ParFormat('justify'));
			$table->setBackgroundForCellRange('#CCCCCC',1,1,1,4);
			
		$no=1;
		for ($i=0;$i<count($saran);$i++){
			if ($saran[$i]!=""){
		   	$table->addRows(1, 0.4);	
			$font = new PHPRtfLite_Font(10,'Tahoma');		
			$table->writeToCell($rowact, 1, $no.". ", $font, new PHPRtfLite_ParFormat('left'));
			$table->writeToCell($rowact, 2, str_replace("^","'",$saran[$i]), $font, new PHPRtfLite_ParFormat('justify'));
			$table->addRows(1, 0.4);	
			$rowact++;		
			
			$table->writeToCell($rowact, 1, " ", $font, new PHPRtfLite_ParFormat('left'));
			$table->writeToCell($rowact, 2, " ", $font, new PHPRtfLite_ParFormat('justify'));
			$rowact++;
			$no++;	
			}		
		}
		
		$table = &$sect->addTable();		
		$table->addColumnsList(array(7.50,7.50,0,0));
		$font = new PHPRtfLite_Font(10,'Tahoma');
		$border = new PHPRtfLite_Border_Format("2px", "#000000", "solid", null);		
	    $table->addRows(1, 0.4);		
		$cell = &$table->getCell(1, 1);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); 
		$cell = &$table->getCell(1, 2);$cell->setVerticalAlignment('center');$cell->setBorders($border,false,false,false,true); 
		$tgl     = date('d F Y');
		$ket     = "Kualitas psikoasesmen telah diperiksa oleh Project Manager.";
		$tanggal = "Jakarta, ".$tgl."<br>".$ket;
		
		$psikolog    = "Psikolog"."<br><br><br><br>"."BERNADETA KUSDIANTARI";
		$project_mgr = "Project Manager"."<br><br><br><br>"."YUNI LASTI FAULINDA";
		$table->addRows(1, 0.4);
			
		$table->addRows(1, 0.4);
		$table->mergeCellRange(2,1,2, 4);
		$table->writeToCell(2, 1, $tanggal, $font, new PHPRtfLite_ParFormat('center'));
		$table->addRows(1, 0.4);
		$table->writeToCell(4, 1, $psikolog, $font, new PHPRtfLite_ParFormat('center'));
		$table->writeToCell(4, 2, $project_mgr, $font, new PHPRtfLite_ParFormat('center'));
		$table->writeToCell(4, 3, "", $font, new PHPRtfLite_ParFormat('center'));
		$table->writeToCell(4, 4, "", $font, new PHPRtfLite_ParFormat('center'));
		
	}
	$project_id = $_GET["project_id"];
	$ps_id = $_GET["ps_id"];
	
	$qup = mysql_query("select * from t_project where project_id = $project_id");
	$project_info = mysql_fetch_object($qup);
	
	$qup = mysql_query("select *,date_format(ps_test_tanggal,'%d-%b-%Y') ps_test_tanggal2 from t_project_source where ps_id = $ps_id");
	$project_source_info = mysql_fetch_object($qup);
	
	
	$pdf=new FPDF();
    $pdf->AddPage();
   // $pdf->SetMargins(18,10,20);
	$pdf->SetMargins(1,2,1,2);
		
	$rtf->setMargins(1,2,1,2);
	_createHeader($project_info);

	//$rtf->setMargins(3,2,3,2);
	
	$sect = &$rtf->addSection();
	//_createTitle($project_info);
	_createTable(0,3);
	//

	$sect = &$rtf->addSection();
	_createTable(3,3);
	//
	$sect = &$rtf->addSection();
	_createUraian();

    $namafile="Psikogram_".$ps_id.".rtf";
	$rtf->sendRtf($namafile);

	
	
?>