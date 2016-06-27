<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
 ?>

<div role="tabpanel">
    <div class="row pull-right">
        <?php
        echo $this->Ajax->link('Atras',
          array('controller'=>'Clientes', 'action'=>'vista_clientes'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'cliente .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#vercliente").find(".panel-body").children().remove();
    $("#vercliente").hide(1000);$("#cliente").removeClass("animated zoomOut"); $("#cliente").fadeIn(500);'));
   
?>
    </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#datoscliente" aria-controls="datoscliente" role="tab" data-toggle="tab">Datos de Cliente</a></li>
          <li role="presentation"><a href="#dircliente" aria-controls="dircliente" role="tab" data-toggle="tab">Dirección</a></li>
          <li role="presentation"><a href="#dirclientegoogle" aria-controls="dirclientegoogle" role="tab" data-toggle="tab">Mapa Google</a></li>
          
         <!-- <li role="presentation"><a href="#balanzaasig" aria-controls="balanzaasig" role="tab" data-toggle="tab">Asignar Kit</a></li>
-->
          <li role="presentation"><a href="#hacerorden" aria-controls="hacerorden" role="tab" data-toggle="tab">Orden de Servicio</a></li>
           <li role="presentation"><a href="#listaorden" aria-controls="listaorden" role="tab" data-toggle="tab">Lista Ordenes de Servicio</a></li>

        </ul>
        <!-- Tab panes -->
        
        <div class="tab-content">
           
          <div role="tabpanel" class="tab-pane active" id="datoscliente">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Datos de Cliente
               </span>
                  <div class="panel-body">
                      <div class="row">
    	
        <?php   
         $errorCorrectionLevel = 'L';
 $matrixPointSize = 4;
$PNG_TEMP_DIR = 'qrcode/temp'.DIRECTORY_SEPARATOR;
 $filename = $PNG_TEMP_DIR.'test'.md5($cedula.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
echo $this->Html->image($filename, ['width'=>'150px','class' => 'img-responsive center-block']);
//echo qr($cedula);
 echo $this->Html->link('QRCODE',
          array('controller'=>'Clientes', 'action'=>'listado',  base64_encode(base64_encode($cedula))),
          array('target'=>'_blank','class'=>'fa fa-user-plus btn btn-primary'));

                    echo $this->Form->create('Cliente',array(
                                        'inputDefaults' => array(
                                            'autocomplete'=>'off',
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                 
                    echo $this->Form->input('Cliente.reg_id',array('type' => 'hidden','onKeyPress'=>'return numeros(event)'));
		  		    echo $this->Form->input('Cliente.cedula',array('maxlength'=>'12','label' =>'Cédula','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Cédula",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('Cliente.fullname',array('maxlength'=>'90','label' =>'Nombre ó Razón Social','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Nombre Completo ó Razón Social"));
                    echo $this->Form->input('Cliente.email',array('maxlength'=>'90','label' =>'Email','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Correo Electronico"));

                    echo $form->input('Cliente.sexo',array('Sexo','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('f'=>'Femenino','m'=>'Masculino')));
                    echo $this->Form->input('Cliente.movil',array('maxlength'=>'12','label' =>'Teléfono Móvil','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Celular",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('Cliente.telefono',array('maxlength'=>'12','label' =>'Teléfono Casa','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Teléfono Casa",'onKeyPress'=>'return numeros(event)'));      
                    echo $this->Form->input('Cliente.profesion',array('maxlength'=>'90','label' =>'Profesión ú Oficio','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Profesión u Oficio"));
     		
                    echo $this->Form->input('Cliente.fecha_nacimiento',array('type'=>'text' ,'label' =>'Fecha de Nacimiento','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Fecha de Nacimiento",'onKeyPress'=>'return letras(event)'));
                    echo $this->Ajax->datepicker('ClienteFechaNacimiento', array('dateFormat'=>'dd-mm-yy','readonly'=>'true','changeMonth' => true,'changeYear' => true,'maxDate' => '"+1M +2D"','buttonImageOnly' => true,'showOn' => 'button','buttonImage' => 'img/calendar.png'));
                    echo $this->Ajax->submit(__('Guardar Cambios', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'editarcli',$id), 'update' => 'datoscliente .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));

                    ?>
     	 </div>
                  </div>
               </div>
            
                    <form method="post" action=""></form>
          </div>
         <div role="tabpanel" class="tab-pane" id="dirclientegoogle">
           <!-- fondo de pantalla -->        
           <div class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-home"></i> Maps de Goolge
                </span>
             <div class="panel-body">
                 <div  class="row">
                    <div id="map" ></div>
                        <script>

function initMap() {
  var myLatLng = {lat: <?php if(empty($this->data['Cliente']['latitud'])) echo "10.89839839"; else echo $this->data['Cliente']['latitud']; ?>, lng: <?php if(empty($this->data['Cliente']['longitud'])) echo "-6.66787896"; else echo $this->data['Cliente']['longitud']; ?>};
  

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'soloplancho'
  });
}
    </script>
        <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBGHoFXvXLG_Pzwu9EjrQXhuN-y3mwz140&callback=initMap" type="text/javascript">
  
    </script>
                 </div>
             </div>
           </div>
         </div>
          
          <div role="tabpanel" class="tab-pane" id="dircliente">
           <!-- fondo de pantalla -->        
           <div class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-home"></i> Dirección
                </span>
             <div class="panel-body">
                 <div class="row">
                <?php   
                   echo $this->Form->create('DireccionCliente',array(
                                        'inputDefaults' => array(
                                            'autocomplete'=>'off',
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                   echo $this->Form->input('DireccionCliente.id_cliente',array('type' => 'hidden','onKeyPress'=>'return numeros(event)'));
		   
                    echo $this->Form->input('DireccionCliente.estado',array('maxlength'=>'50','label' =>'Estado','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Estado"));

                   echo $this->Form->input('DireccionCliente.ciudad',array('maxlength'=>'50','label' =>'Ciudad','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Ciudad"));
     		   echo $this->Form->input('DireccionCliente.direccion',array('maxlength'=>'90','label' =>'Dirección','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Dirección Completa"));
     		
                   echo $this->Ajax->submit(__('Guardar Cambios', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'editardir',$id), 'update' => 'dircliente .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));

                   ?>
                    </div>
                             
             </div>
           </div>
           <form method="post" action=""></form>
    
          </div>
               
         
          <div role="tabpanel" class="tab-pane" id="hacerorden">
                 
           <div class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-outdent"></i> Orden de Servicio
                </span>
             <div id="crearorden" class="panel-body">
                   <?php   
                    echo $this->Form->create('OrdenServicio',array(
                                        'inputDefaults' => array(
                                            'autocomplete'=>'off',
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                   
                    echo $this->Form->input('OrdenServicio.id_cliente',array('type' => 'hidden','value'=>$id,'onKeyPress'=>'return numeros(event)'));
                    echo $this->Form->input('OrdenServicio.id_empresa',array('type' => 'hidden','value'=>$idemp,'onKeyPress'=>'return numeros(event)'));
		    echo $this->Form->input('costo',array('id'=>'costo','type' => 'hidden','value'=>$costo));
		  
                    //echo $this->Form->input('OrdenServicio.peso_libras',array('id'=>'peso_libras','maxlength'=>'5','label' =>'Peso en Libras','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'placeholder'=>"Peso en Libras",'onKeyUp'=>'return costo2(this.value)','onKeyPress'=>'return numeros_punto(event)'));
     		     ?>
                    <div class="col-xs-2">Peso en Libras
                        <div class="input-group"> 
                    <?php
                        echo $this->Form->input('OrdenServicio.peso_libras',array('readonly'=>true,'size'=>'6','label' =>false,'div'=>false,'class'=>"form-control",'id'=>'peso_libras','maxlength'=>'5','onKeyUp'=>'return costo2(this.value)','onKeyPress'=>'return numeros_punto(event)'));
                 ?>
                       <span class="input-group-btn">
                            ...<button class="buscar_peso btn btn-default" type="button"><span class="glyphicon glyphicon-refresh"></span></button>
                      </span>  
                            </div>
                            </div>
     <?php
                    echo $this->Form->input('OrdenServicio.precio_orden',array('id'=>'precio_orden','readonly'=>'true','label' =>'Costo Servicio','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control", 'placeholder'=>"Costo del Servicio"));
                    echo $this->Form->input('OrdenServicio.recepcion',array('label' =>'Recepción','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('domicilio'=>'Domicilio','drop-off'=>'Drop-Off','personal'=>'Personal')));
                    
                     $this->Form->input('OrdenServicio.cantidad_piezas',array('type' => 'text','id'=>'cantidadorden','readonly'=>'true','label' =>'Cantidad de Piezas','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control", 'placeholder'=>"Cantidad de Piezas"));
                    echo '<h4 class="modal-title col-xs-12 form-group"></h4>';
                    foreach ($articulos as $key => $value) {
                        
                         echo $this->Form->input('OrdenArticulo.'.$value['Articulo']['id_articulo'],array('maxlength'=>'2','label' =>$value['Articulo']['descripcion'],'div'=>array('class'=>'col-xs-3 required form-group'),'class'=>"form-control", 'placeholder'=>$value['Articulo']['descripcion'],'onKeyPress'=>'return numeros(event)'));
     		  
                    }
                    echo $this->Ajax->submit(__('Crear Orden', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'crear_orden',$id), 'update' => 'crearorden','loading'=>'mini_loading','indicator'=>'mini_loading'));

                   ?>
                           <script type="text/javascript">
                   $(function() {
                       $("form:not(.filter) :input:visible:enabled:first").focus();
                        $.getJSON("http://localhost/leer_puerto.php", function(json) { 
                            console.log(json);	
                            $('#peso_libras').val(json.peso);
                        });
                        $('.buscar_peso').on('click', function(){ 
                            $.getJSON("http://localhost/leer_puerto.php", function(json) { 
                                console.log(json);	
                                $('#peso_libras').val(json.peso);
                            });
                        }); 
                        
                    });
                </script>
                 <script type="text/javascript">
        //<![CDATA[
             $('#peso_libras').focus();
        
//]]>
</script>
             </div>
           </div>

          </div> 
            
           <div role="tabpanel" class="tab-pane" id="listaorden">
                 
           <div class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-list-ol"></i> Lista Ordenes de Servicio
                </span>
             <div class="panel-body">
             <?php
  $paginator->options(array('url'=>array( 'controller' => 'Clientes', 'action' => 'ordenescliente',$id),'update' => 'listaorden .panel-body', 'indicator' => 'mini_loading','loading'=>'mini_loading'));

 ?>
<div id="buscar" style="border:1px">
     <table id='tblMain' class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('# Orden','OrdenServicio.id_orden');?></th>
           		<th><?php echo $this->Paginator->sort('Peso Libras','peso_libras');?></th>
			<th><?php echo $this->Paginator->sort('Costo','precio_orden');?></th>
			<th><?php echo $this->Paginator->sort('Cantidad Piezas','cantidad_piezas');?></th>
			<th><?php echo $this->Paginator->sort('Recepción','recepcion');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Solicitud','fecha_solicitud');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Entrega','fecha_entrega');?></th>
			<th><?php echo $this->Paginator->sort('Status','OrdenServicio.status');?></th>
			
	</tr></thead><tbody id='tblorden'>
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
		<td><?php echo $orden['OrdenServicio']['fecha_solicitud']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['fecha_entrega']; ?>&nbsp;</td>
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


