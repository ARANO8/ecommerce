<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/ecommerce/config/global.php");
require_once ( ROOT_DIR ."/model/Seg_facturaModel.php");
include (ROOT_CORE.'/fpdf/fpdf.php');

class PDF extends FPDF{
    function convertxt($p_txt){
        return iconv('UTF-8', 'iso-8859-1', $p_txt);
    }
    function Header(){
        $this -> Setfont('Arial','B',12);
        $this -> Cell(0,10,'Reporte de Facturas', 0,1,'C');
    }
    function Footer(){
        $this -> SetY(-15);
        $this -> SetFont('Arial','I',8);
        $this -> Cell(0,10,$this -> convertxt("Pagína") .$this->PageNo(). '/{nb}',0,0,'c');
    }
}

$rpt= new Seg_facturaModel();
$records = $rpt->findall();
$records = $records['DATA'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$header = array($pdf->convertxt("idfactura"),$pdf->convertxt("montoTotal"),$pdf->convertxt("fecha"),$pdf->convertxt("id"));
$widths = array(45,45,45,45);
for ($i=0; $i < count($header); $i++) { 
    $pdf->Cell($widths[$i],7,$header[$i],1);
}
$pdf->Ln();
//Cuerpo
$pdf->SetFont('Arial','',10);
foreach ($records as $row) {
    $pdf->Cell($widths[0], 6,$pdf->convertxt($row['idfactura']),1);
    $pdf->Cell($widths[1], 6,$pdf->convertxt($row['montoTotal']),1);
    $pdf->Cell($widths[2], 6,$pdf->convertxt($row['fecha']),1);
    $pdf->Cell($widths[3], 6,$pdf->convertxt($row['id']),1);
    $pdf->Ln();
}

$pdf->Output();
?>