<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/ecommerce/config/global.php");
require_once ( ROOT_DIR ."/model/Seg_usuarioModel.php");
include (ROOT_CORE.'/fpdf/fpdf.php');

class PDF extends FPDF{
    function convertxt($p_txt){
        return iconv('UTF-8', 'iso-8859-1', $p_txt);
    }
    function Header(){
        $this -> Setfont('Arial','B',12);
        $this -> Cell(0,10,'Reporte de usuarios', 0,1,'C');
    }
    function Footer(){
        $this -> SetY(-15);
        $this -> SetFont('Arial','I',8);
        $this -> Cell(0,10,$this -> convertxt("Pagína") .$this->PageNo(). '/{nb}',0,0,'c');
    }
}

$rpt= new Seg_usuarioModel();
$records = $rpt->findall();
$records = $records['DATA'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$header = array($pdf->convertxt("id"),$pdf->convertxt("nombre"),$pdf->convertxt("correo"),$pdf->convertxt("cliente"),$pdf->convertxt("vendedor"));
$widths = array(10,55,75,17,22);
for ($i=0; $i < count($header); $i++) { 
    $pdf->Cell($widths[$i],7,$header[$i],1);
}
$pdf->Ln();
//Cuerpo
$pdf->SetFont('Arial','',10);
foreach ($records as $row) {
    $pdf->Cell($widths[0], 6,$pdf->convertxt($row['idusuario']),1);
    $pdf->Cell($widths[1], 6,$pdf->convertxt($row['nombre']),1);
    $pdf->Cell($widths[2], 6,$pdf->convertxt($row['correo']),1);
    $pdf->Cell($widths[3], 6,$pdf->convertxt($row['cliente']),1);
    $pdf->Cell($widths[3], 6,$pdf->convertxt($row['vendedor']),1);
    $pdf->Ln();
}

$pdf->Output();
?>