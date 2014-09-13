<?php
	session_start();
	$conn = mysql_connect("localhost","root",""); 
    $db=mysql_select_db("sekretariat");
 	require_once("include/PHPRtfLite.php");
	
	
	/*function _createHeader()
	{
		global $project_info,$rtf,$sect;
		//$experd_logo = 'images/experd_small.jpg';
		//$client_logo = 'images/'.$project_info->project_logo;
		$header = &$rtf->addHeader('all');
		$table = &$header->addTable('center');
		$table->addRows(1, 0.8);
		$table->setLeftPosition(-2.5);
		$table->addColumnsList(array(3,9.5,5));
		$cell = &$table->getCell(1, 1);
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
	}*/
	
	function _createTable()
	{
		global $rtf,$sect;
		$table = &$sect->addTable('center');
		$table->addRows(2, 0.4);
		
		$total_posisi = 3;$arr_cols[] = 0.99; // width "kompetensi name"
		for ($i=0;$i<($total_posisi*3);$i++) $arr_cols[] = 3; 
		$table->addColumnsList($arr_cols);
		$font = new PHPRtfLite_Font(8,'Tahoma');
		//$table->mergeCellRange(1, 1, 2, 1);
		//for ($i=0;$i<$total_posisi;$i++) $table->mergeCellRange(1, 2+(3*$i), 1, 4+(3*$i));
		$table->writeToCell(1, 1, '<b>No</b>', $font, new PHPRtfLite_ParFormat('center'));
		$cell = &$table->getCell(1, 1);$cell->setVerticalAlignment('center');
		//$qup = mysql_query("select posisi_id,pp_standar from t_project_posisi where project_id = $project_id group by posisi_id limit $a,$b");	
		//for ($i=0;$i<$total_posisi;$i++)
		//{
		//	$rup = mysql_fetch_object($qup);
		//	$table->writeToCell(1, 2+(3*$i), '<b>TEST</b>', $font, new PHPRtfLite_ParFormat('center'));
		//	$table->writeToCell(2, 2+(3*$i), '<b>Stdr</b>', $font, new PHPRtfLite_ParFormat('center'));
		//	$table->writeToCell(2, 3+(3*$i), '<b>Lvl</b>', $font, new PHPRtfLite_ParFormat('center'));
		//	$table->writeToCell(2, 4+(3*$i), '<b>Gap</b>', $font, new PHPRtfLite_ParFormat('center'));
		//}
		$border = new PHPRtfLite_Border_Format("1px", "#000000", "solid", null);
		//$border1 = new PHPRtfLite_Border_Format("1px", "#0000ff", "dash", null); 
		//$table->setBordersOfCells($border,1,1,2,1+($total_posisi*3),true,true,true,true);
		//$table->setBackgroundForCellRange('#CCCCCC',1,1,2,1+($total_posisi*3));
		
		/* table kompetensi */
		//$qup = mysql_query("select * from t_project_kompetensi where project_id = $project_id");
		//$totalkomp = mysql_num_rows($qup);
		//$brs=0;
		//for ($i=0;$i<mysql_num_rows($qup);$i++)
		//{
		//	$rup = mysql_fetch_object($qup);
		//	$table->addRows(1, 0.4);
		//	$table->writeToCell( (3+$i),1, getKompetensiName($rup->kompetensi_id), $font, new PHPRtfLite_ParFormat('left'));
		//	$qup2 = mysql_query("select posisi_id,pp_standar from t_project_posisi where project_id = $project_id group by posisi_id limit $a,$b");	
			
		//	for ($j=0;$j<mysql_num_rows($qup2);$j++)
		//	{
				//$rup2 = mysql_fetch_object($qup2);
				//$rek_komp[$j]=getRekKompetensi($project_id,$rup2->posisi_id,$ps_id);
				//$rek_study[$j]=getKesesuaianStudi($rup2->posisi_id,$ps_id);
				//$rek_akhir[$j]=getRekAkhir($project_id,$rup2->posisi_id,$ps_id);
				
				//if (checkPosisiExist($project_id,$rup->pk_id,$rup2->posisi_id))
				//{
					//$level = getLevelPeserta($ps_id,$rup->kompetensi_id);	
		//			$table->setBackgroundForCellRange('#CCCCCC',(3+$i),2+(3*$j),(3+$i),2+(3*$j));				
		//			$table->writeToCell((3+$i), 2+(3*$j), $rup2->pp_standar, $font, new PHPRtfLite_ParFormat('center'));
		//			$table->setBackgroundForCellRange('#C5EFFD',(3+$i),3+(3*$j),(3+$i),3+(3*$j));						
		//			$table->writeToCell((3+$i), 3+(3*$j), $level, $font, new PHPRtfLite_ParFormat('center'));	
		//			$table->setBackgroundForCellRange('#FFFFFF',(3+$i),4+(3*$j),(3+$i),4+(3*$j));					
		//			if (($level-$rup2->pp_standar) < 0)
		//				$table->writeToCell((3+$i), 4+(3*$j), '<b>'.($level-$rup2->pp_standar).'</b>', new PHPRtfLite_Font(8,'Tahoma','#FF0000'), new PHPRtfLite_ParFormat('center'));
		//			else
		//				$table->writeToCell((3+$i), 4+(3*$j), ($level-$rup2->pp_standar), $font, new PHPRtfLite_ParFormat('center'));
		//		}
		//		else
		//		{
		//			$table->setBackgroundForCellRange('#A8B1B8',(3+$i),2+(3*$j),(3+$i),4+(3*$j));
					
		//		}
		//	}
			//$brs++;
		//}
		$table->setBordersOfCells($border,3,1,1,1,true,true,true,true);
	/*	$table->addRows(1, 0.4);
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
	}*/
	
	
	
	
	/*$project_id = $_GET["project_id"];
	$ps_id = $_GET["ps_id"];
	
	$qup = mysql_query("select * from t_project where project_id = $project_id");
	$project_info = mysql_fetch_object($qup);
	
	$qup = mysql_query("select *,date_format(ps_test_tanggal,'%d-%b-%Y') ps_test_tanggal2 from t_project_source where ps_id = $ps_id");
	$project_source_info = mysql_fetch_object($qup);*/
	
	}
	// Init
	
	$null = null;
	PHPRtfLite::registerAutoloader();
	$parFormat = new PHPRtfLite_ParFormat();
	$rtf = new PHPRtfLite();
	//setLandscape()
	$rtf->setLandscape();
	
	//$rtf->setMargins(3,2,3,2);
	//_createHeader($project_info);

	$rtf->setMargins(3,2,3,2);
	
	$sect = &$rtf->addSection();
	//_createTitle($project_info);
	_createTable();
	//

	/*$sect = &$rtf->addSection();
	_createTable(3,3);
	//
	$sect = &$rtf->addSection();
	_createUraian();*/

    $namafile="Schedule.rtf";
	$rtf->sendRtf($namafile);

	
	
?>