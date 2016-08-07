<?php
App::import('Vendor', 'tcpdf/config/lang/eng');
App::import('Vendor', 'tcpdf/tcpdf');


class HOJASOL extends tcpdf
{

    function Header()
    {
	$this->SetMargins(0,0.3,0);	
        $this->SetDisplayMode(70) ;
        $this->SetY(0);
        $this->SetX(0);

    }

    function Footer()
    {
	$this->setFooterMargin(0);
	$this->SetY(0);
    }
}
$pdf = new HOJASOL('P', 'cm', 'B8', true, 'UTF-8', false);
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
//$pdf->SetFooterMargin(1);
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 $pdf->SetAutoPageBreak(TRUE, 0);
// add a page
$pdf->AddPage();
//$pdf->Image(K_PATH_IMAGES.'iuet.jpg',12,15,30,25);

$pdf->SetLineWidth(0);

$pdf->SetFont('arial','B',8);


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
        $fechap=$pagorden['PagoOrden']['fecha_fact'];
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
          if(isset($pagorden['PagoOrden']['numero_factura'])){
            $precio=$pagorden['PagoOrden']['precio_pago'];
            $diva=$impuesto['Configuracion']['descripcion'];
            $iva=$pagorden['PagoOrden']['iva'];
            $monto=$precio;
            $total=$pagorden['PagoOrden']['total'];
          }else{
            $fact='N/A';
            $precio=$ordenes['OrdenServicio']['precio_orden']-($ordenes['OrdenServicio']['peso_descuento']*$costo['Configuracion']['valor']);
            $diva=$impuesto['Configuracion']['descripcion'];
            $iva=$precio*$impuesto['Configuracion']['valor'];
            $monto=$precio;
            $total=$monto+$iva;
          }
$tabla='<table cellpadding="0" cellspacing="0" width="134px">
    
        <tr rowspan="2">
            <th><h4><center>SoloPlancho &+</center></h4></th>
            <th align="right"><font size="5">FACTURA #  '.$fact.'<br />FECHA: '.$fechap.'</font></th>
        </tr>
        <tr><th colspan="2" align="left"><font size="7"> '.$emp.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="7">NIT: '.$nit.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="6">Dirección: '.$dir.'</font></th></tr>
        <tr>
            <th align="left"><font size="6">Teléfono: '.$tel.'</font></th>
            <th align="left"><font size="6">'.$web.'</font></th>
        </tr>
       
        <tr border="2"><td colspan="2" align="left"><font size="7">Datos del Cliente:</font></td></tr>
        <tr border="2"><td colspan="2" align="left"><font size="7">Nit: '.$ced.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="7">Nombre: '.$nom.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="6">Dirección: '.$dircli.'</font></td></tr>
       <tr><td colspan="2">___________________________</td></tr>
        <tr><td align="left">Descripción:</td><td align="left"><font size="6">Valor Lb.: $'.number_format($valor, 2, '.', ',').'</font></td></tr>
        <tr><td rowspan="4" align="left"><h5>'.$desc.'</h5></td><td align="left"><font size="6">Cant. Lbs.: '.$libras.'</font></td></tr> 
        <tr><td align="left"><font size="6">Monto:       $'.number_format($monto, 2, '.', ',').'</font></td></tr>
        <tr><td align="left"><font size="6"> '.$diva.':   $'.number_format($iva, 2, '.', ',').'</font></td></tr>
        <tr><td align="left"><font size="6">Total:         $'.number_format($total, 2, '.', ',').'</font></td></tr>
        <tr><td colspan="2">___________________________</td></tr>
        <tr><td colspan="2" align="center"><font size="3">(Ley 1231 del 17 de Julio de 2008) Acepto el presente documento y certificó que recibí físicamente 
        la mercancia y/o la prestación del servicio y la factura Autoriza consecutivo de la IM 0001 al IM 10000 Según Resolución No. 110000675250 de 2016/04/14 de la DIAN<br />
        "Nuestras facturas son pequeñas para preservar el medio ambiente"</font></td></tr>
</table>';
//$pdf->Image(K_PATH_IMAGES.'recicla.png',6,86,6,6);
$pdf->writeHTMLCell(0, 0, '', '', $tabla,10, 1, 0, true, 'L',true);

$pdf->writeHTMLCell(0, 0, '', '', $tabla,10, 1, 0, true, 'L',true);

//$pdf->lastPage();
$filename='factura_'.$fact.'.pdf';

$pdf->Output($filename,'I');

?>