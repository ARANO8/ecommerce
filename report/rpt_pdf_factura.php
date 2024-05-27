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
        $this -> Cell(0,10,'Factura', 0,1,'C');
    }
    function Footer(){
        $this -> SetY(-15);
        $this -> SetFont('Arial','I',8);
        $this -> Cell(0,10,$this -> convertxt("Pagína") .$this->PageNo(). '/{nb}',0,0,'c');
    }
}

$rpt=new Seg_usuarioModel();


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Output();

?>