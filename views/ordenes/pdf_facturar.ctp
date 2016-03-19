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
$pdf = new HOJASOL('P', 'mm', array(77,92), true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SETB');
$pdf->SetTitle('FACTURA');
$pdf->SetSubject('SETB');
$pdf->SetKeywords('SETB');


//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 $pdf->SetAutoPageBreak(TRUE, 0);
// add a page
$pdf->AddPage();
//$pdf->Image(K_PATH_IMAGES.'iuet.jpg',12,15,30,25);

$pdf->SetLineWidth(0.5);

$pdf->SetFont('helvetica','B',8);


    $emp=$ordenes['Empresa']['descripcion'];
     $nit=$ordenes['Empresa']['nit'];
     $correo=$ordenes['Empresa']['correo'];
      $dir=$ordenes['Empresa']['ubicacion'].'    '.$correo;
       $tel=$ordenes['Empresa']['telefono'];
        
        $web=$ordenes['Empresa']['web'];
        $fact=$pagorden['PagoOrden']['numero_factura'];
        $ced=$ordenes['Cliente']['cedula'];
        $nom=$ordenes['Cliente']['fullname'];
        $dircli=$ordenes['Cliente']['DireccionCliente']['calle_av'].' '
                .$ordenes['Cliente']['DireccionCliente']['localidad'].'<br />Ciudad:  '
                .$ordenes['Cliente']['DireccionCliente']['ciudad'];
        $fechap=$pagorden['PagoOrden']['fecha_pago'];
        $libras=$ordenes['OrdenServicio']['peso_libras'];
         $pp='Sin Pago';
            if(isset($pagorden['PagoOrden'])){
                if($pagorden['PagoOrden']['status']=='1'){
                  $pp='Pendiente por verificar Pago';  
                }  else if($pagorden['PagoOrden']['status']=='2'){
                  $pp='Pago Aceptado';  
                } else if($pagorden['PagoOrden']['status']=='3'){
                  $pp='Pago Rechazado';  
                }
                
            }
        $desc='Servicio de planchado de Ropas y otros, Según orden # '
                .$ordenes['OrdenServicio']['id_orden'].' y '.$pp;
        if($ordenes['OrdenServicio']['peso_descuento']>0){
            $desc=$desc.' con un obsequio de '.$ordenes['OrdenServicio']['peso_descuento']
                    .'Lb. ya reflejados en Factura';
        }
            $valor=$costo['Configuracion']['valor'];
            $dto=$ordenes['OrdenServicio']['peso_descuento'];
            $precio=$pagorden['PagoOrden']['precio_pago']-($ordenes['OrdenServicio']['peso_descuento']*$costo['Configuracion']['valor']);
            $diva=$impuesto['Configuracion']['descripcion'];
            $iva=$pagorden['PagoOrden']['iva'];
            $monto=$precio;
            $total=$pagorden['PagoOrden']['total'];
            

$tabla='<table cellpadding="0" cellspacing="0"  width="180px">
    
        <tr rowspan="2">
            <th><h4><center><b>SÓLO PLANCHO</b></center></h4></th>
            <th align="right"><font size="6">FACTURA #  '.$fact.'<br />FECHA: '.$fechap.'</font></th>
        </tr>
        <tr><th colspan="2" align="left"><font size="9"> '.$emp.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="9">NIT: '.$nit.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="6">Dirección: '.$dir.'</font></th></tr>
        <tr>
            <th align="left"><font size="6">Teléfono: '.$tel.'</font></th>
            <th align="left"><font size="6">'.$web.'</font></th>
        </tr>
       
        <tr border="2"><td colspan="2" align="left"><h5>Datos del Cliente:</h5></td></tr>
        <tr border="2"><td colspan="2" align="left"><font size="9">Nit: '.$ced.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="9">Nombre: '.$nom.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="6">Dirección: '.$dircli.'</font></td></tr>
        <tr><td colspan="2">___________________________</td></tr>
        <tr><td align="left">Descripción:</td><td align="left">Valor Lb.: $'.number_format($valor, 2, '.', ',').'</td></tr>
        <tr><td rowspan="4" align="left"><h5><b>'.$desc.'</b></h5></td><td align="left">Total Lbs.: '.$libras.'</td></tr> 
        <tr><td align="left"><b>Monto:     $'.number_format($monto, 2, '.', ',').'</b></td></tr>
        <tr><td align="left"><b> '.$diva.':     $'.number_format($iva, 2, '.', ',').'</b></td></tr>
        <tr><td align="left"><b>Total:       $'.number_format($total, 2, '.', ',').'</b></td></tr>
        <tr><td colspan="2">___________________________</td></tr>
        <tr><td colspan="2"><font size="5">DIAN Resolución No. xxxxxx Fecha de expedición 2016/03/15<br /> Numeración de 1 al 100000</font></td></tr>
        <tr><td colspan="2"><font size="5">"Nuestras facturas son pequeñas para preservar el medio ambiente"</font></td></tr>
</table>';
$pdf->Image(K_PATH_IMAGES.'recicla.png',9,79,6,6);
$pdf->writeHTMLCell(0, 0, '', '', $tabla,10, 1, 0, true, 'C',true);

$pdf->writeHTMLCell(0, 0, '', '', $tabla,10, 1, 0, true, 'C',true);

$pdf->lastPage();
$filename='factura_'.$fact.'.pdf';

$pdf->Output($filename,'I');

?>