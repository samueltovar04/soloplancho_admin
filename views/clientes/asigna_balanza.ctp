<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
         
?>
 <div class="row">
    	
 <?php   
                    echo $this->Form->create('Balanza',array(
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                    if(!empty($this->data['Balanza']['codigo'])){
                ?>
                 <div class="col-md-9">
              <div class="panel panel-info">
                <span class="title-window-panel"> 
                  <i class="fa fa-user-times"></i> Cliente ya Posee Kit si se requiere una nueva, ingrese la información
                </span>
                   </div>
           </div>
                 <?php
                    
                    echo $this->Form->input('Balanza.codigo',array('readonly'=>'true','label' =>'Kit','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Código de la balanza"));
     		    echo $this->Form->input('Balanza.Usuario.fullname',array('readonly'=>'true','label' =>'Entregada por','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Nombre del Empleado Delivery"));
                }
                   echo $this->Form->input('Cliente.reg_id',array('type' => 'hidden','onKeyPress'=>'return numeros(event)'));
		    
                   echo $this->Form->input('Balanza.codigo2',array('readonly'=>'true','value'=>$token,'label' =>'Código Kit','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Código de la balanza"));
     		   echo $this->Form->input('Balanza.id_usuario',array('label' =>'Nombre Delivery','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array($delivery)));
     		 
                   echo $this->Ajax->submit(__('Asignar Kit', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'asigna_balanza',$id), 'update' => 'asignarbalanza .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));

                ?>
     	 </div>



