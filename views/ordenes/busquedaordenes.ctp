<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}

            $precio=$ordenes['OrdenServicio']['precio_orden']-($ordenes['OrdenServicio']['peso_descuento']*$costo['Configuracion']['valor']);
            
            $iva=$precio*$impuesto['Configuracion']['valor'];
            $monto=$precio;
            $total=$precio+$iva;
             $pp="Sin Pago";
            if(isset($pagorden['PagoOrden'])){
                if($pagorden['PagoOrden']['status']=='1'){
                  $pp="Pendiente por verificar Pago";  
                }  else if($pagorden['PagoOrden']['status']=='2'){
                  $pp="Pago Aceptado";  
                } else if($pagorden['PagoOrden']['status']=='3'){
                  $pp="Pago Rechazado";  
                }
                
            }

 if($ordenes['OrdenServicio']['status']=='1'){ $status='Nueva Orden'; $class='primary-color';}
    if($ordenes['OrdenServicio']['status']=='2'){ $status='Asignada Delivery'; $class='success-color';}
    if($ordenes['OrdenServicio']['status']=='3'){ $status='Entregada Delivery'; $class='warning-color';}
    if($ordenes['OrdenServicio']['status']=='4'){ $status='En Tienda';$class='info-color'; }
    if($ordenes['OrdenServicio']['status']=='5'){ $status='Asignada Operador'; $class='operador-color';}
    if($ordenes['OrdenServicio']['status']=='6'){ $status='Planchada'; $class='planchada-color';}
    if($ordenes['OrdenServicio']['status']=='7'){ $status='Pendiente Pago'; $class='pendienp-color'; }
    if($ordenes['OrdenServicio']['status']=='8'){ $status='Cancelada'; $class='cancelada-color'; }
    if($ordenes['OrdenServicio']['status']=='9'){ $status='Enviada Cliente'; $class='enviada-color';}
    if($ordenes['OrdenServicio']['status']=='10'){ $status='Entregada Cliente'; $class='entragada-color';}
    
    if($ordenes['OrdenServicio']['status']=='11'){ $status='>Observación'; $class='danger-color';}
    
    if($ordenes['OrdenServicio']['status']=='20'){ $status='Anulada'; $class='danger-color';}
           
            foreach ($usuario as $key => $value) {
                if(($value['UsuarioOrden']['status']=='1' || $value['UsuarioOrden']['status']=='2') && $value['Usuario']['tipo']=='3')
                {
                    $del['status']=$value['UsuarioOrden']['status'];
                    $del['fecha_asigna']=$value['UsuarioOrden']['fecha_asigna'];
                    $del['fecha_cumple']=$value['UsuarioOrden']['fecha_cumple'];
                    $del['usuario']=$value['Usuario']['cedula']." ".$value['Usuario']['fullname'];
                }
            else if(($value['UsuarioOrden']['status']=='4' || $value['UsuarioOrden']['status']=='5') && $value['Usuario']['tipo']=='3')
                {
                    $env['status']=$value['UsuarioOrden']['status'];
                    $env['fecha_asigna']=$value['UsuarioOrden']['fecha_asigna'];
                    $env['fecha_cumple']=$value['UsuarioOrden']['fecha_cumple'];
                    $env['usuario']=$value['Usuario']['cedula']." ".$value['Usuario']['fullname'];
                }  else if( $value['Usuario']['tipo']=='4')
                {
                    $ope['status']=$value['UsuarioOrden']['status'];
                    $ope['fecha_asigna']=$value['UsuarioOrden']['fecha_asigna'];
                    $ope['fecha_cumple']=$value['UsuarioOrden']['fecha_cumple'];
                    $ope['usuario']=$value['Usuario']['cedula']." ".$value['Usuario']['fullname'];
                }
                    
               
}
                   
?>
  <div class="row pull-right">
        <?php
         echo $this->Html->link('IMPRIMIR FACTURA',
          array('controller'=>'Ordenes', 'action'=>'impfactura', $ordenes['OrdenServicio']['id_orden'] ),
          array('target'=>'_blank','class'=>'fa fa-print btn btn-primary'));
        
        
           echo $this->Ajax->link('Atras',
          array('controller'=>'Ordenes', 'action'=>'buscar_ordenes'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'buscarorden .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#buscarresul").find(".panel-body").children().remove();
    $("#buscarresul").hide(1000);$("#buscarorden").removeClass("animated zoomOut"); $("#buscarorden").fadeIn(500);'));
   
?>
    </div>
<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="90%">
    <thead>
        <tr><th style="width: 30%;">Datos del Cliente</th><th> Dirección</th></tr>
        <tr><td><?php echo $ordenes['Cliente']['cedula']." ".$ordenes['Cliente']['fullname'].
                "<br>Teĺefono Movil: ".$ordenes['Cliente']['movil'].
                "<br>Correo: ".$ordenes['Cliente']['email']; ?></td>
            <td><?php echo $ordenes['Cliente']['DireccionCliente']['calle_av']." ".
                        $ordenes['Cliente']['DireccionCliente']['localidad']."<br>Ciudad: ".
                        $ordenes['Cliente']['DireccionCliente']['ciudad']; ?>
            </td>
        </tr>
        <tr><th>Datos de la Orden # <?php echo $ordenes['OrdenServicio']['id_orden']; ?></th>
            <th>Factura # <?php echo $pagorden['PagoOrden']['numero_factura']." Estado: ".$pp;?></th></tr>
        </thead>
        <tbody>
            <tr><td><strong>Fecha Solicitud:</strong> <?php echo $ordenes['OrdenServicio']['fecha_solicitud'];?></td>
                <td><strong>Fecha de Entrega:</strong> <?php echo $ordenes['OrdenServicio']['fecha_entrega'];?></td>
            </tr>
            <tr>
                <td><strong>Recepción: </strong><?php echo $ordenes['OrdenServicio']['recepcion'];?></td>
                <td><strong>Forma Entrega Al Cliente:</strong> <?php echo $ordenes['OrdenServicio']['forma_entrega'];?></td>
            </tr>
            <tr>
                <td><?php if(isset($del)) 
                {
                   echo "Delivery:".$del['usuario']."<br>Fecha Asignado: ".$del['fecha_asigna'];
                   echo "<br>Fecha Busqueda: ".$del['fecha_cumple'];
                }
                    ?>
                </td>
                <td><?php if(isset($env)) 
                {
                   echo "Delivery:".$env['usuario']."<br>Fecha Asignado: ".$env['fecha_asigna'];
                   echo "<br>Fecha Entrega: ".$env['fecha_cumple'];
                }
                    ?>
                </td>
            </tr>
            <tr>
                <td><strong>Status de la Orden:</strong> <?php echo $status;?></td>
                <td>Observación: <?php echo $ordenes['OrdenServicio']['observacion'];?></td>
            </tr>
            <tr>
                <td><strong>Cantidad de libras:</strong> <?php echo $ordenes['OrdenServicio']['peso_libras'];?></td>
                <td>Libras de Descuento: <?php echo $ordenes['OrdenServicio']['peso_descuento'];?></td>
            </tr>
            <tr>
                <td>
                <?php echo "<strong>Monto : ".$monto." $$. </strong>"
                            ."<strong>".$impuesto['Configuracion']['descripcion']." : ".$iva." $$. </strong>";
                ?>
                </td>
                <td>Monto Total a Pagar: <?php echo "<strong> ".$total." $$. </strong>";?></td>
            </tr>
            <tr><td><strong>Metodo de Pago:</strong> <?php echo $pagorden['PagoOrden']['metodo_pago'];?></td>
                <td>Número Transacción: <?php echo $pagorden['PagoOrden']['numero'];?> </td></tr>
            <tr><td><strong>Forma de Pago: </strong><?php echo $pagorden['PagoOrden']['forma_pago'];?> </td>
                <td>Fecha de Pago: <?php echo $pagorden['PagoOrden']['fecha_pago'];?></td></tr>
          
            <tr><td><strong>Cantidad de Piezas: </strong></td><td><?php echo $ordenes['OrdenServicio']['cantidad_piezas'];?></td></tr>
       <?php
            foreach ($ordenes['OrdenArticulo'] as $key => $value) {
              echo  "<tr><td>".$value['Articulo']['descripcion'].":</td><td> ".$value['cantidad']."</td></tr>";
            }
            
       ?>
        </tbody>
</table>