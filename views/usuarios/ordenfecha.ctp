          <div role="tabpanel" class="tab-pane" id="ordenfecha">
                  
           <div  class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-tags"></i> Ordenes por Fecha
                </span>
             <div class="panel-body">
              <?php
 if(isset($Exito)){echo $cargar->msj_exito($Exito);}
if(isset($Error)){echo $cargar->msj_error($Error);}
  $paginator->options(array('url'=>array( 'controller' => 'Usuarios', 'action' => 'ordenfecha',$id),'update' => 'buscar', 'indicator' => 'mini_loading','loading'=>'mini_loading'));

 ?>
                   <div  style="border:1px" id="buscar">
     <table id='tblMain' class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('# Orden','OrdenServicio.id_orden');?></th>
           		<th><?php echo $this->Paginator->sort('Peso Libras','OrdenServicio.peso_libras');?></th>
			<th><?php echo $this->Paginator->sort('Costo','OrdenServicio.precio_orden');?></th>
			<th><?php echo $this->Paginator->sort('Cantidad Piezas','OrdenServicio.cantidad_piezas');?></th>
			<th><?php echo $this->Paginator->sort('Recepción','OrdenServicio.recepcion');?></th>
			
                        <th><?php echo $this->Paginator->sort('Entrega','OrdenServicio.forma_entrega');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Solicitud','OrdenServicio.fecha_solicitud');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Entrega','OrdenServicio.fecha_entrega');?></th>

                        <th><?php echo $this->Paginator->sort('Status','OrdenServicio.status');?></th>
                        <th><?php echo $this->Paginator->sort('Fecha Asignada','UsuarioOrden.fecha_asigna');?></th>
                        <th><?php echo $this->Paginator->sort('Fecha Cumplimiento','UsuarioOrden.fecha_cumple');?></th>
<th></th>

                        
	</tr></thead><tbody id='tblordend'>
	<?php
	$i = 0;
       	foreach ($ordenesf as $orden):
          
		$class = "fondo1";
                    if($i++%2==0){
                   $class = "fondo2";
                    }
    
    if($orden['OrdenServicio']['status']=='1'){ $status='Nueva Orden'; $class='primary-color';}
    if($orden['OrdenServicio']['status']=='2'){ $status='Asignada Delivery'; $class='success-color';}
    if($orden['OrdenServicio']['status']=='3'){ $status='Entregada Delivery'; $class='warning-color';}
    if($orden['OrdenServicio']['status']=='4'){ $status='En Tienda';$class='info-color'; }
    if($orden['OrdenServicio']['status']=='5'){ $status='Asignada Operador'; $class='operador-color';}
    if($orden['OrdenServicio']['status']=='6'){ $status='Planchada'; $class='planchada-color';}
    if($orden['OrdenServicio']['status']=='7'){ $status='Pendiente Pago'; $class='pendienp-color'; }
    if($orden['OrdenServicio']['status']=='8'){ $status='Verificando Pago'; $class='cancelada-color'; }
    if($orden['OrdenServicio']['status']=='9'){ $status='Enviada Cliente'; $class='enviada-color';}
    if($orden['OrdenServicio']['status']=='10'){ $status='Entregada Cliente'; $class='entragada-color';}
    
    if($orden['OrdenServicio']['status']=='11'){ $status='>Observación'; $class='danger-color';}
    
    if($orden['OrdenServicio']['status']=='20'){ $status='Anulada'; $class='danger-color';}
             
?>
        <tr<?php echo " class='".$class."'  id='".$orden['OrdenServicio']['id_orden']."'"?> >
            <td><?php echo $orden['OrdenServicio']['id_orden']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['peso_libras']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['precio_orden']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['cantidad_piezas']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['recepcion']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['forma_entrega']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['fecha_solicitud']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['fecha_entrega']; ?>&nbsp;</td>
                <td><?php echo $status; ?>&nbsp;</td>
               <td><?php echo $orden['UsuarioOrden']['fecha_asigna']; ?>&nbsp;</td>
               <td><?php echo $orden['UsuarioOrden']['fecha_cumple']; ?>&nbsp;</td>
               <td><?php if($orden['UsuarioOrden']['status']==1 || $orden['UsuarioOrden']['status']==4){ 
                   echo "No Cumple";
               }else if($orden['UsuarioOrden']['status']==0 || $orden['UsuarioOrden']['status']==10){
                   echo "Reasignada";
               }                
               else {
                    echo "Si Cumple";
               }
?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</tbody></table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('pag. %page% de %pages%,  %current% filas de %count% en total, desde %start%, hasta %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>    
             </div>
             </div>
           </div>
            <form method="post" action=""></form>

          </div>  