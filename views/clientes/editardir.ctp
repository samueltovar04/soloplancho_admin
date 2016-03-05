<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
         
?>
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
     		   echo $this->Form->input('DireccionCliente.localidad',array('maxlength'=>'90','label' =>'Urbanismo ó Localidad','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Urbanismo ó Localidad"));
     		
                   echo $this->Form->input('DireccionCliente.calle_av',array('maxlength'=>'90','label' =>'Av. Calle ó Carrera','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Celular"));
     		
                   echo $this->Form->input('DireccionCliente.edificio',array('maxlength'=>'50','label' =>'Edificio','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Descripción de Edificio"));
     	           echo $this->Form->input('DireccionCliente.numero',array('maxlength'=>'8','label' =>'# Casa ó Apto','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número Casa ó Apartamento"));
     	           echo $this->Ajax->submit(__('Guardar Cambios', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'editardir',$id), 'update' => 'dircliente .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));

        ?>
     	 </div>



