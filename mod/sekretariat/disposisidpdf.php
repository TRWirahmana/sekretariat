<?
	session_start();
	$conn = mysql_connect("localhost","root",""); 
    $db=mysql_select_db("sekretriat");
    if(isset($_GET['id']))
    {
     $id    = $_GET['id'];
	 }
	
require('../inc/fpdf/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Biro Hukum dan Organisasi!');
$pdf->Output();
?>



	
	
