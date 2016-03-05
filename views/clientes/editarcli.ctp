<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
         
?>
 <div class="row">
    	
        <?php     
                    echo $this->Form->create('Cliente',array(
                                        'inputDefaults' => array(
                                            'autocomplete'=>'off',
                                        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'label', 'class' => 'alert-danger')))
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



