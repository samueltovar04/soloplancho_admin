<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
                echo $this->Form->create('UsuarioOrden',array('class'=>'form-group'));
              ?>
            <div class='col-xs-3'>
                <label class='form-group'>Delivery De Envio Al Cliente</label>
            </div>
            <?php
                echo $this->Form->input('UsuarioOrden.id_orden',array('type' => 'hidden','value'=>$id,'onKeyPress'=>'return numeros(event)'));
                echo $this->Form->input('UsuarioOrden.id_usuario',array('label' =>false,'div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>$delivery));
                
                echo $this->Ajax->submit(__('Asignar Delivery', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-3 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'asignaentrega',$id), 'update' => 'asignar','loading'=>'mini_loading','indicator'=>'mini_loading'));

            ?>