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