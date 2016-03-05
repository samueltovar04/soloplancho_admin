<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
?>
<div role="tabpanel" id="sii">
    <div class="row pull-right">
<?php
      echo $this->Ajax->link('Atras',
          array('controller'=>'Usuarios', 'action'=>'index'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'empleados .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#verusuario").find(".panel-body").children().remove();
    $("#verusuario").hide(1000);$("#empleados").removeClass("animated zoomOut"); $("#empleados").fadeIn(500);'));

            
?>    </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#datosempleado" aria-controls="datosempleado" role="tab" data-toggle="tab">Datos del Empleado</a></li>
          <li role="presentation"><a href="#activausu" aria-controls="activausu" role="tab" data-toggle="tab">Activar o Inactivar</a></li>
          <li role="presentation"><a href="#ordendia" aria-controls="ordendia" role="tab" data-toggle="tab">Ordenes del Día</a></li>
          <li role="presentation"><a href="#ordenmes" aria-controls="ordenmes" role="tab" data-toggle="tab">Ordenes del Mes</a></li>
          
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="datosempleado">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Datos del Empleado
               </span>
                  <div class="panel-body">
                      <div id="aqui" class="row">
    	
        <?php     
          echo $this->Form->create('Usuario',array(
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                 echo $this->Form->input('Usuario.id_usuario',array('label' =>'id','type'=>'text','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"ID",'onKeyPress'=>'return numeros(event)'));
     		
                     echo $this->Form->input('Usuario.cedula',array('label' =>'Cédula','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Cédula",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('Usuario.fullname',array('label' =>'Nombre ó Razón Social','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Nombre Completo ó Razón Social"));
     		
                    echo $form->input('Usuario.sexo',array('Sexo','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('f'=>'Femenino','m'=>'Masculino')));
                    echo $this->Form->input('Usuario.movil',array('label' =>'Teléfono Móvil','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Celular",'onKeyPress'=>'return numeros(event)'));
     		
                    echo $this->Form->input('Usuario.tipo',array('label' =>'Tipo Empleado','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'options'=>array('1'=>'Administrador','2'=>'Asistente','3'=>'Delivery','4'=>'Operador')));
     	            echo $this->Form->input('Usuario.email',array('label' =>'Email','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Correo Electronico"));
     	          //  echo $this->Form->input('Usuario.clave',array('label' =>'Clave','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Clave para Ingresar"));
     	echo $this->Ajax->submit(__('Guardar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Usuarios', 'action'=>'usuarioedit'), 'update' => 'aqui','loading'=>'mini_loading','indicator'=>'mini_loading'));

                    ?>
     	 </div>
                  </div>
               </div>
            

          <form method="post" action=""></form>
          </div>
               
          <div role="tabpanel" class="tab-pane" id="activausu">
                  
           <div id="activausuario" class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-tags"></i> Activar o inactivar
                </span>
             <div class="panel-body">
                <?php   
                    echo $this->Form->create('Usuario',array(
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 

                   echo $this->Form->input('Usuario.id_usuario',array('type' => 'hidden','onKeyPress'=>'return numeros(event)'));
		   echo $this->Form->input('Usuario.status',array('label' =>'Estado','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'options'=>array('1'=>'Activo','0'=>'Inactivo')));
                
                   echo $this->Ajax->submit(__('Actualizar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Usuarios', 'action'=>'asigna_status',$id), 'update' => 'activausuario .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));

                ?>  
             </div>
           </div>
            <form method="post" action=""></form>

          </div>
            <div role="tabpanel" class="tab-pane" id="ordendia">
                  
           <div  class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-tags"></i> Ordenes del Hoy
                </span>
               <div class="panel-body"><div  style="border:1px" id="buscar">
               <?php
 if(isset($Exito)){echo $cargar->msj_exito($Exito);}
if(isset($Error)){echo $cargar->msj_error($Error);}
  $paginator->options(array('url'=>array( 'controller' => 'Usuarios', 'action' => 'ordendia',$id),'update' => 'buscar', 'indicator' => 'mini_loading','loading'=>'mini_loading'));

 ?>
                   
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
               <td><?php if($orden['UsuarioOrden']['status']=1 || $orden['UsuarioOrden']['status']=4){ 
                   echo "No Cumple";
               }  else {
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
           
            <div role="tabpanel" class="tab-pane" id="ordenmes">
                  
           <div  class="panel panel-default">
                <span class="title-window-panel"> 
                  <i class="fa fa-tags"></i> Ordenes por Mes
                </span>
             <div class="panel-body">
              <?php
 if(isset($Exito)){echo $cargar->msj_exito($Exito);}
if(isset($Error)){echo $cargar->msj_error($Error);}
  $paginator->options(array('url'=>array( 'controller' => 'Usuarios', 'action' => 'ordenmes',$id),'update' => 'buscar', 'indicator' => 'mini_loading','loading'=>'mini_loading'));

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
       	foreach ($ordenesm as $orden):
          
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
               }else if($orden['UsuarioOrden']['status']==0){
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
            
        </div>

</div>

