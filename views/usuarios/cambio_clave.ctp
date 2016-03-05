<div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Cambiar Clave
               </span>
                  <div class="panel-body">
                      <div id="aqui2" class="row">
    	
        <?php     
          echo $this->Form->create('Usuario',array(
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                 echo $this->Form->input('Usuario.id_usuario',array('label' =>'id','type'=>'hidden','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"ID",'onKeyPress'=>'return numeros(event)'));
     		
                    echo $this->Form->input('Usuario.fullname',array('readonly'=>'true','label' =>'Nombre ó Razón Social','div'=>array('class'=>'col-xs-12 form-group'),'class'=>"form-control", 'placeholder'=>"Nombre Completo ó Razón Social"));
     		   echo $this->Form->input('Usuario.clave_actual',array('label' =>'Clave Actual','div'=>array('class'=>'col-xs-8 form-group'),'class'=>"form-control", 'placeholder'=>"Clave Actual"));
     		
                    echo $this->Form->input('Usuario.clave_nueva',array('label' =>'Nueva Clave','div'=>array('class'=>'col-xs-8 form-group'),'class'=>"form-control", 'placeholder'=>"Nueva Clave"));
     	            echo $this->Form->input('Usuario.confirma',array('label' =>'Confirma Clave','div'=>array('class'=>'col-xs-8 form-group'),'class'=>"form-control", 'placeholder'=>"Confirma La Clave"));
     	          //  echo $this->Form->input('Usuario.clave',array('label' =>'Clave','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Clave para Ingresar"));
     	echo $this->Ajax->submit(__('Guardar Cambios', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Usuarios', 'action'=>'cambioclave'), 'update' => 'aqui2','loading'=>'mini_loading','indicator'=>'mini_loading'));

                    ?>
     	 </div>
                  </div>
               </div>

