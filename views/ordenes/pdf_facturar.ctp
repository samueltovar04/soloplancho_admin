<?php
App::import('Vendor', 'tcpdf/config/lang/eng');
App::import('Vendor', 'tcpdf/tcpdf');


class HOJASOL extends tcpdf
{

    function Header()
    {
	$this->SetMargins(0,2,0);	
        $this->SetDisplayMode(100) ;

    }

    function Footer()
    {
	$this->setFooterMargin(0);
	$this->SetY(0);
    }
}
$pdf = new HOJASOL('P', 'mm', array(57,86), true, 'UTF-8', false);
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
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 $pdf->SetAutoPageBreak(TRUE, 0);
// add a page
$pdf->AddPage();
//$pdf->Image(K_PATH_IMAGES.'iuet.jpg',12,15,30,25);

$pdf->SetLineWidth(0.5);

$pdf->SetFont('arial','B',6);


    $emp=$ordenes['Empresa']['descripcion'];
     $nit=$ordenes['Empresa']['nit'];
     $correo=$ordenes['Empresa']['correo'];
      $dir=$ordenes['Empresa']['ubicacion'].'    '.$correo;
       $tel=$ordenes['Empresa']['telefono'];
        
        $web=$ordenes['Empresa']['web'];
        $fact=$pagorden['PagoOrden']['numero_factura'];
        $ced=$ordenes['Cliente']['cedula'];
        $nom=$ordenes['Cliente']['fullname'];
        $dircli=$ordenes['Cliente']['DireccionCliente']['direccion'].'<br />Ciudad:  '
                .$ordenes['Cliente']['DireccionCliente']['ciudad'];
        $fechap=$pagorden['PagoOrden']['fecha_pago'];
        $libras=$ordenes['OrdenServicio']['peso_libras']-$ordenes['OrdenServicio']['peso_descuento'];
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
            

$tabla='<table>
    
        <tr rowspan="2">
            <th><h4><center>SoloPlancho &+</center></h4></th>
            <th align="right"><font size="4">FACTURA #  '.$fact.'<br />FECHA: '.$fechap.'</font></th>
        </tr>
        <tr><th colspan="2" align="left"><font size="7"> '.$emp.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="7">NIT: '.$nit.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="6">Dirección: '.$dir.'</font></th></tr>
        <tr>
            <th align="left"><font size="6">Teléfono: '.$tel.'</font></th>
            <th align="left"><font size="6">'.$web.'</font></th>
        </tr>
       
        <tr border="2"><td colspan="2" align="left"><h4>Datos del Cliente:</h4></td></tr>
        <tr border="2"><td colspan="2" align="left"><font size="8">Nit: '.$ced.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="8">Nombre: '.$nom.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="6">Dirección: '.$dircli.'</font></td></tr>
        <tr><td colspan="2">___________________________</td></tr>
        <tr><td align="left">Descripción:</td><td align="left">Valor Lb.: $'.number_format($valor, 2, '.', ',').'</td></tr>
        <tr><td rowspan="4" align="left"><h5>'.$desc.'</h5></td><td align="left">Cant. Lbs.: '.$libras.'</td></tr> 
        <tr><td align="left"><b>Monto:       $'.number_format($monto, 2, '.', ',').'</b></td></tr>
        <tr><td align="left"><b> '.$diva.':   $'.number_format($iva, 2, '.', ',').'</b></td></tr>
        <tr><td align="left"><b>Total:         $'.number_format($total, 2, '.', ',').'</b></td></tr>
        <tr><td colspan="2">___________________________</td></tr>
        <tr><td colspan="2"><font size="3">(Ley 1231 del 17 de Julio de 2008) Acepto el presente documento y <br />certificó que recibí físicamente 
        la mercancia y/o la prestación <br />del servicio y la factura Autoriza consecutivo de la IM 0001 al IM <br />10000 Según Resolución No. 110000675250 de 2016/04/14 de la DIAN<br />
        "Nuestras facturas son pequeñas para preservar el medio ambiente"</font></td></tr>
</table>';
//$pdf->Image(K_PATH_IMAGES.'recicla.png',6,86,6,6);
$pdf->writeHTMLCell(0, 0, '', '', $tabla,0, 1, 0, true, 'C',true);

$pdf->writeHTMLCell(0, 0, '', '', $tabla,10, 1, 0, true, 'C',true);

//$pdf->lastPage();
$filename='factura_'.$fact.'.pdf';

$pdf->Output($filename,'I');

?>