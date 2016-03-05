<div role="tabpanel" id="ordenescanceladas">
<div class="row pull-right">
  <div class="col-xs-8">
    <div class="input-group">
      <input type="text" id="busquedaordenc" class="form-control">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Buscar</button>
      </span>
    </div>
  </div>
</div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#buscaorden" aria-controls="buscaorden" role="tab" data-toggle="tab">Datos de las Ordenes</a></li>
          
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
<div  style="border:1px">
     <table id='tblMain' class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="100%">
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
    if($orden['OrdenServicio']['status']=='8'){ $status='Cancelada'; $class='cancelada-color'; }
    if($orden['OrdenServicio']['status']=='9'){ $status='Enviada Cliente'; $class='enviada-color';}
    if($orden['OrdenServicio']['status']=='10'){ $status='Entregada Cliente'; $class='entragada-color';}
    
    if($orden['OrdenServicio']['status']=='11'){ $status='>Observación'; $class='danger-color';}
    
    if($orden['OrdenServicio']['status']=='20'){ $status='Anulada'; $class='danger-color';}
             
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
            
            
