<div role="tabpanel" id="ordenescanceladas">
<div class="row pull-right">
  <div class="col-xs-8"> <?php echo $this->Form->create('Ordenes'); ?>
    <div class="input-group">
    <?php 
            echo $this->Form->input('Ordenes.asigna',array('readonly'=>true,'id'=>"cancela",'maxlength'=>8,'class'=>"form-control",'value'=>'9','type' => 'hidden','div'=>false,'label'=>FALSE));
         echo $this->Form->input('Ordenes.verificacodbarra',array('readonly'=>false,'id'=>"busquedaordenc",'maxlength'=>8,'class'=>"form-control",'value'=>'','type' => 'text','div'=>false,'label'=>FALSE));
       ?>
      <span class="input-group-btn">
       <?php
         echo $this->Ajax->submit(__('Buscar', true), array('div'=>false,'class'=>'btn btn-default form-group','url'=> array('controller'=>'Ordenes', 'action'=>'codordenesbuscar'), 'update' => 'buscarord .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));
       ?>
      </span>
    </div>
  </div>
</div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#buscaorden" aria-controls="buscaorden" role="tab" data-toggle="tab">Datos de las Ordenes</a></li>
          <li role="presentation" ><a href="#canceladasdia" aria-controls="canceladasdia" role="tab" data-toggle="tab">Pagos del Día</a></li>
          <li role="presentation" ><a href="#canceladasmes" aria-controls="canceladasmes" role="tab" data-toggle="tab">Pagos del Mes</a></li>
          <li role="presentation" ><a href="#canceladasano" aria-controls="canceladasano" role="tab" data-toggle="tab">Pagos del Año</a></li>
          
          <li role="presentation" ><a href="#entregadas" aria-controls="entregadas" role="tab" data-toggle="tab">Ordenes Entregadas</a></li>
          
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">

          <div role="tabpanel" class="tab-pane active" id="buscaorden">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Ordenes de Servicio
               </span>
                  <div class="panel-body">
                      <?php
  $paginator->options(array('url'=>array( 'controller' => 'Ordenes', 'action' => 'ordenes_canceladas'),'update' => 'ordenescanceladas', 'indicator' => 'mini_loading','loading'=>'mini_loading'));

 ?>
                      <div  style="border:1px" class=" table-responsive">
     <table id='tblMain' class="table table-striped table-bordered" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('# Orden','OrdenServicio.id_orden');?></th>
           		<th><?php echo $this->Paginator->sort('Peso Libras','peso_libras');?></th>
			<th><?php echo $this->Paginator->sort('Costo','precio_orden');?></th>
			<th><?php echo $this->Paginator->sort('Cantidad Piezas','cantidad_piezas');?></th>
                        <th><?php echo $this->Paginator->sort('Recepcion','recepcion');?></th>
			<th><?php echo $this->Paginator->sort('Entrega','forma_entrega');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Solicitud','fecha_solicitud');?></th>
			<th><?php echo $this->Paginator->sort('Status','OrdenServicio.status');?></th>
                      
            </tr></thead><tbody id='tblordenc'>
	<?php
	$i = 0;
       	foreach ($ordenes as $orden):
                   
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
             if(!empty($orden['OrdenServicio']['forma_entrega'])){
?>
        <tr<?php echo " class='".$class."' ";   echo "id='".$orden['OrdenServicio']['id_orden']."'"?> >
            <td><?php echo $orden['OrdenServicio']['id_orden']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['peso_libras']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['precio_orden']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['cantidad_piezas']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['recepcion']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['forma_entrega']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['fecha_solicitud']; ?>&nbsp;</td>
                <td><?php echo $status; ?>&nbsp;</td>
               

	</tr>
<?php 
             }
endforeach; ?>
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
            
          </div>
            
        <div role="tabpanel" class="tab-pane" id="canceladasdia">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Ordenes Canceladas en el día
               </span>
                  <div class="panel-body table-responsive">
                   <table id='tblMain' class="table table-striped table-bordered" cellpadding="0" cellspacing="0"  width="100%">
                    <thead><tr>
                        <th>Fecha de Pago</th>
                        <th>Metodo de Pago</th>
                        <th>Monto SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                                $total=0;
                          foreach ($pagosdia as $key => $value) {
                              $total+=round($value[0]['total'],2);
                                 
                                 echo "<tr><td>".$value[0]['fecha']."</td><td>".$value['PagoOrden']['metodo_pago']."</td><td>".round($value[0]['total'],2)."</td></tr>";
                          }
                          echo "<tr class='alert-success'><td></td><td><b>Monto Total</b></td><td><b>".round($total, 2)."</b></td></tr>";
                      ?>
                   </tbody>
                   </table>
                  </div>
              </div>
        </div>
            
        <div role="tabpanel" class="tab-pane" id="canceladasmes">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Ordenes Canceladas en el mes
               </span>
                  <div class="panel-body table-responsive">
                   <table id='tblMain' class="table table-striped  table-bordered" cellpadding="0" cellspacing="0"  width="100%">
                    <thead>
                      <tr>
                        
                        <th>Fecha de Pago</th>
                        <th>Metodo de Pago</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                            $totalmes=$mes=$total=0;
                          foreach ($pagosmes as $key => $value) 
                          {      
                              if($mes!=$value[0]['fecha']){
                                  if($total!=0)
                                   echo "<tr class='alert-success'><td></td><td><b>Monto Total</b></td><td><b>".round($total, 2)."</b></td></tr>";
                                    
                                    $totalmes+=$total;
                                    $total=0;
                                }
                                echo "<tr><td>".$value[0]['fecha']."</td><td>".$value['PagoOrden']['metodo_pago']."</td><td>".round($value[0]['total'],2)."</td></tr>";
                                $total+=round($value[0]['total'],2);
                                 
                                 $mes=$value[0]['fecha'];
                          } 
                          echo "<tr class='alert-success'><td></td><td><b>Monto Total</b></td><td><b>".round($total, 2)."</b></td></tr>";
                           echo "<tr class='alert-box'><td></td><td><b> Total en el Mes:</b></td><td><b>".round($totalmes, 2)."</b></td></tr>";

                          ?>
                   </tbody>
                   </table>
                  </div>
              </div>
        </div>
            
        <div role="tabpanel" class="tab-pane al" id="canceladasano">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Ordenes Canceladas en el Año
               </span>
                  <div class="panel-body table-responsive">
                   <table id='tblMain' class="table table-striped table-bordered" cellpadding="0" cellspacing="0"  width="100%">
                    <thead>
                      <tr>
                        <th>Metodo de Pago</th>
                        <th>fecha de Pago</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                            $mes=$total=0;
                          foreach ($pagosano as $key => $value) 
                          {      
                              if($mes!=$value[0]['fecha']){
                                   echo "<tr class='alert-success'><td></td><td><b>Monto Total</b></td><td><b>".round($total, 2)."</b></td></tr>";
                                    $total=0;
                                }
                                 echo "<tr><td>".$value[0]['fecha']."</td><td>".$value['PagoOrden']['metodo_pago']."</td><td>".round($value[0]['total'],2)."</td></tr>";
                                $total+=round($value[0]['total'],2);
                                 
                                 $mes=$value[0]['fecha'];
                          } 
                          echo "<tr class='alert-success'><td></td><td><b>Monto Total</b></td><td><b>".round($total, 2)."</b></td></tr>";
                      ?>
                   </tbody>
                   </table>
                  </div>
              </div>
        </div>
            
        <div role="tabpanel" class="tab-pane " id="entregadas">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Ordenes Entregadas al Cliente
               </span>
                  <div class="panel-body table-responsive">

<div  style="border:1px">
     <table id='tblMain' class="table table-striped table-bordered" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('# Orden','OrdenServicio.id_orden');?></th>
           		<th><?php echo $this->Paginator->sort('Peso Libras','peso_libras');?></th>
			<th><?php echo $this->Paginator->sort('Costo','precio_orden');?></th>
			<th><?php echo $this->Paginator->sort('Cantidad Piezas','cantidad_piezas');?></th>
                        <th><?php echo $this->Paginator->sort('Recepcion','recepcion');?></th>
			<th><?php echo $this->Paginator->sort('Entrega','forma_entrega');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Solicitud','fecha_solicitud');?></th>
			<th><?php echo $this->Paginator->sort('Status','OrdenServicio.status');?></th>
                      
            </tr></thead><tbody id='tblordenc'>
	<?php
	$i = 0;
       	foreach ($ordenes_entregadas as $orden):
                   
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
    if($orden['OrdenServicio']['status']=='8'){ $status='Cancelada'; $class='cancelada-color'; }
    if($orden['OrdenServicio']['status']=='9'){ $status='Enviada Cliente'; $class='enviada-color';}
    if($orden['OrdenServicio']['status']=='10'){ $status='Entregada Cliente'; $class='entragada-color';}
    
    if($orden['OrdenServicio']['status']=='11'){ $status='>Observación'; $class='danger-color';}
    
    if($orden['OrdenServicio']['status']=='20'){ $status='Anulada'; $class='danger-color';}
             if(!empty($orden['OrdenServicio']['forma_entrega'])){
?>
        <tr<?php echo " class='".$class."' ";   echo "id='".$orden['OrdenServicio']['id_orden']."'"?> >
            <td><?php echo $orden['OrdenServicio']['id_orden']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['peso_libras']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['precio_orden']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['cantidad_piezas']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['recepcion']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['forma_entrega']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['fecha_solicitud']; ?>&nbsp;</td>
                <td><?php echo $status; ?>&nbsp;</td>
               

	</tr>
<?php 
             }
endforeach; ?>
	</tbody></table>

             </div>
            </div>
         </div>
      </div>    
        
   </div>
</div>
 <script type="text/javascript">
        //<![CDATA[
             $('#busquedaordenc').focus();
        $('#tblordenc tr').on('click', function(){ 
    var row=$(this).parent();
    
    var orden = $("#tblordenc").children().eq($(this).index());  
    var id = orden.attr('id');
    $.ajax({
        async:true, 
        type:'post', 
        beforeSend:function(request) {
            $('#mini_loading').show();
            $("#ordencancelar").find(".panel-body").children().remove();
            $("#ordencancelar").hide(1000);
            $("#ordencancelarv").removeClass("animated zoomOut");
            $("#ordencancelarv").fadeIn(500);
        }, 
        complete:function(request, json) {
            $('#ordencancelarv .panel-body').html(request.responseText); 
            $('#mini_loading').hide();
        },
        url:'Ordenes/asignar_entrega/'+id}) });

//]]>
</script>
            
            
