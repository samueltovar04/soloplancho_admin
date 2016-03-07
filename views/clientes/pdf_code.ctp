<?php 
App::import('Vendor', 'tcpdf/config/lang/eng');
App::import('Vendor', 'tcpdf/tcpdf');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// add a page
$pdf->AddPage();
 
$style = array(
    'border' => true,
    'padding' => 4,
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
$pdf->Image($filename , 80, 10, 50 ,50, '', '', '', true, 100);
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
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 6,
    'stretchtext' => 6
);
$cedula=  base64_decode(base64_decode($cedula));
 $pdf->write1DBarcode($cedula, 'C128A', '', 60, '',16, 0.4, $style, '');

$pdf->lastPage();
$pdf->Output('Codigobarra_'.$cedula.'.pdf', 'I');