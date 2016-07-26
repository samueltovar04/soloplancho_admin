<div role="tabpanel" id="sii">
    <div class="row pull-right">
<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
         echo $this->Ajax->link('Atras',
          array('controller'=>'Usuarios', 'action'=>'index'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'empleados .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#usuarioadd").find(".panel-body").children().remove();
    $("#usuarioadd").hide(1000);$("#empleados").removeClass("animated zoomOut"); $("#empleados").fadeIn(500);'));
   
?>       
</div>
          <div role="tabpanel" class="tab-pane active" id="datoscliente">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Datos del Empleado
               </span>
                  <div class="panel-body">
                      <div class="row">
    	
        <?php     
          echo $this->Form->create('Usuario',array(
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                
                     echo $this->Form->input('Usuario.cedula',array('label' =>'Cédula','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Cédula",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('Usuario.fullname',array('label' =>'Nombre ó Razón Social','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Nombre Completo ó Razón Social"));
     		
                    echo $form->input('Usuario.sexo',array('Sexo','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('f'=>'Femenino','m'=>'Masculino')));
                    echo $this->Form->input('Usuario.movil',array('label' =>'Teléfono Móvil','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Celular",'onKeyPress'=>'return numeros(event)'));
     		
                    echo $this->Form->input('Usuario.tipo',array('label' =>'Tipo Empleado','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'options'=>array('1'=>'Administrador','2'=>'Asistente','3'=>'Ikaro','4'=>'Operador')));
     	            echo $this->Form->input('Usuario.email',array('label' =>'Email','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Correo Electronico"));
     	            echo $this->Form->input('Usuario.clave',array('label' =>'Clave','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Clave para Ingresar"));
     	echo $this->Ajax->submit(__('Guardar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Usuarios', 'action'=>'usuarioadd'), 'update' => 'sii','loading'=>'mini_loading','indicator'=>'mini_loading'));

                    ?>
     	 </div>
                  </div>
               </div>
            

          </div>

</div>

