<?php
App::import('Vendor', 'tcpdf/config/lang/eng');
App::import('Vendor', 'tcpdf/tcpdf');


class HOJASOL extends tcpdf
{

    function Header()
    {
	$this->SetMargins(10,10, 10);	
        $this->SetDisplayMode(75) ;

    }

    function Footer()
    {
	$this->setFooterMargin(0);
	$this->SetY(-15);
    }
}
$pdf = new HOJASOL(PDF_PAGE_ORIENTATION, PDF_UNIT, 'RA3', true, 'UTF-8', false);
$pdf->SetAutoPageBreak(true,1);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SACE');
$pdf->SetTitle('FACTURA');
$pdf->SetSubject('SACE');
$pdf->SetKeywords('SACE');


$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
$pdf->AddPage();
//$pdf->Image(K_PATH_IMAGES.'iuet.jpg',12,15,30,25);

$pdf->SetY(15);
$pdf->SetLineWidth(0.3);

$pdf->SetFont('helvetica','B',10);


    $emp=$ordenes['Empresa']['descripcion'];
     $nit=$ordenes['Empresa']['nit'];
      $dir=$ordenes['Empresa']['ubicacion'];
       $tel=$ordenes['Empresa']['telefono'];
        $correo=$ordenes['Empresa']['correo'];
        $fact=$pagorden['PagoOrden']['numero_factura'];
        $ced=$ordenes['Cliente']['cedula'];
        $nom=$ordenes['Cliente']['fullname'];
        $dircli=$ordenes['Cliente']['DireccionCliente']['calle_av'].' '
                .$ordenes['Cliente']['DireccionCliente']['localidad'].'<br />Ciudad: '
                .$ordenes['Cliente']['DireccionCliente']['ciudad'];
        $fechap=$pagorden['PagoOrden']['fecha_pago'];
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
        $desc='Servicio de planchado de '.$ordenes['OrdenServicio']['peso_libras']
                .' Lb. de Ropa y otros, Según orden # '
                .$ordenes['OrdenServicio']['id_orden'].' y '.$pp;
        if($ordenes['OrdenServicio']['peso_descuento']>0){
            $desc=$desc.' con un obsequio de '.$ordenes['OrdenServicio']['peso_descuento']
                    .'Lb. ya reflejados en Factura';
        }
        $valor=$costo['Configuracion']['valor'];
        $dto=$ordenes['OrdenServicio']['peso_descuento'];
         $precio=$ordenes['OrdenServicio']['precio_orden']-($ordenes['OrdenServicio']['peso_descuento']*$costo['Configuracion']['valor']);
            $diva=$impuesto['Configuracion']['descripcion'];
            $iva=$precio*$impuesto['Configuracion']['valor'];
            $monto=$precio-$iva;
            $total=$precio;
            

$tabla='<table cellpadding="0" cellspacing="0"  width="200px">
    
        <tr rowspan="2">
            <th><h4><center><b>SoloPlancho</b></center></h4></th>
            <th align="right"><font size="7">FACTURA #  '.$fact.'<br />FECHA: '.$fechap.'</font></th>
        </tr>
        <tr><th colspan="2" align="left"><font size="9"> '.$emp.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="9">NIT: '.$nit.'</font></th></tr>
        <tr><th colspan="2" align="left"><font size="6">Dirección: '.$dir.'</font></th></tr>
        <tr>
            <th><font size="6" align="left">Teléfono: '.$tel.'</font></th>
            <th><font size="6" align="left">Email: '.$correo.'</font></th>
        </tr>
        <tr><td colspan="2">__________________________________</td></tr>
        <tr border="2"><td colspan="2" align="left"><h5>Datos del Cliente:</h5></td></tr>
        <tr border="2"><td colspan="2" align="left"><font size="9">Nit: '.$ced.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="9">Nombre: '.$nom.'</font></td></tr>
        <tr><td colspan="2" align="left"><font size="6">Dirección:'.$dircli.'</font></td></tr>
        <tr><td colspan="2">__________________________________</td></tr>
        <tr><td align="left"><h5><b>Descripción:</b></h5></td><td align="left"><h5><b>Valor por Libra:</b></h5></td></tr>
        <tr><td rowspan="4" align="left">'.$desc.'</td><td> '.$valor.'</td></tr>
            <tr><td align="left"></td></tr>
                <tr><td align="left"></td></tr>
        <tr><td align="left"><b>Monto:     '.$monto.'</b></td></tr>
        <tr><td align="left"></td><td align="left"><b> '.$diva.':     '.$iva.'</b></td></tr>
        <tr><td align="left"></td><td align="left"><b>Total:       '.$total.'</b></td></tr>
        <tr><td colspan="2">________________________________________________</td></tr>
        <tr><td colspan="2"><font size="5">DIAN Resolución No. xxxxxx Fecha de expedición 2016/03/15<br /> Numeración de 1 al 100000</font></td></tr>
 </table>';
$pdf->writeHTMLCell(0, 0, '', '', $tabla,0, 1, 0, true, 'C',true);

$pdf->writeHTMLCell(0, 0, '', '', $tabla,0, 1, 0, true, 'C',true);
$pdf->Output('factura_'.$fact.'.pdf', 'I');

?>