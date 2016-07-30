<?php 
App::import('Vendor', 'tcpdf/config/lang/eng');
App::import('Vendor', 'tcpdf/tcpdf');

class HOJASOL extends tcpdf
{

    function Header()
    {
	$this->SetMargins(2,5,2);	
        $this->SetDisplayMode(75) ;

    }

    function Footer()
    {
	$this->setFooterMargin(0);
	$this->SetY(0);
    }
}
$pdf = new HOJASOL('P', 'mm', array(62,100), true, 'UTF-8', false);
 $pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SETB');
$pdf->SetTitle('QRCODE');
$pdf->SetSubject('SETB');
$pdf->SetKeywords('SETB');
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 $pdf->SetAutoPageBreak(TRUE, 0);
// add a page
$pdf->AddPage();
 
$style = array(
    'border' => true,
    'padding' => 2,
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
);
 $errorCorrectionLevel = 'L';
 $matrixPointSize = 4;
//code name: QR, specify error correction level after semicolon (L,M,Q,H)
//$pdf->write2DBarcode('PHP QR Code :)', 'QR,L', '', '', 30, 30, $style, 'N');
$PNG_TEMP_DIR = 'img/qrcode/temp'.DIRECTORY_SEPARATOR;
 $filename = $PNG_TEMP_DIR.'test'.md5(base64_decode(base64_decode($cedula)).'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
 QRcode::png($cedula, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

$pdf->setJPEGQuality(75);

// Image example
$pdf->Image($filename , 6, 0, 50 ,50, '', '', '', true, 100);
$style = array(
    'position' => 'C',
    'align' => 'C',
    'stretch' => true,
    'fitwidth' => true,
    'cellfitalign' => 'R',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(12,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => false,
    'font' => 'helvetica',
    'fontsize' => 0.1,
    'stretchtext' => 6
);
$cedula=  base64_decode(base64_decode($cedula));
 $pdf->write1DBarcode($cedula, 'C128A', '', 50, '',6, 0.4, $style, '');
$pdf->Image('img/logo1.png' , 11, 60, 40 ,34, '', '', '', false, 100);
$pdf->lastPage();
$pdf->Output('Codigobarra_'.$cedula.'.pdf', 'I');