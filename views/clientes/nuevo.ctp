<div role="tabpanel" id="sii">
    <div class="row pull-right">
<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
 echo $this->Ajax->link('Atras',
          array('controller'=>'Clientes', 'action'=>'vista_clientes'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'cliente .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#clienteadd").find(".panel-body").children().remove();
    $("#clienteadd").hide(1000);$("#cliente").removeClass("animated zoomOut"); $("#cliente").fadeIn(500);'));
   ?></div>
    <?php
    echo $this->Form->create('Cliente',array(
                                        'inputDefaults' => array(
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
            
?>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#datoscliente" aria-controls="datoscliente" role="tab" data-toggle="tab">Datos de Cliente</a></li>
          <li role="presentation"><a href="#dircliente" aria-controls="dircliente" role="tab" data-toggle="tab">Dirección</a></li>
         
        </ul>
        <!-- Tab panes -->
        
        <div class="tab-content" >

          <div role="tabpanel" class="tab-pane active" id="datoscliente">
            
              <div class="panel panel-info">
               <span class="title-window-panel">
                 <i class="fa fa-user-plus"></i>Datos de Cliente
               </span>
                  <div class="panel-body">
                      <div class="row">
    	
        <?php     
                
                    echo $this->Form->input('Cliente.reg_id',array('type' => 'hidden','onKeyPress'=>'return numeros(event)'));
		    echo $this->Form->input('Cliente.cedula',array('maxlength'=>'12','label' =>'Cédula','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Cédula",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('Cliente.fullname',array('maxlength'=>'90','label' =>'Nombre ó Razón Social','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Nombre Completo ó Razón Social"));
                    echo $this->Form->input('Cliente.email',array('maxlength'=>'90','label' =>'Email','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Correo Electronico"));

                    echo $form->input('Cliente.sexo',array('Sexo','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('f'=>'Femenino','m'=>'Masculino')));
                    echo $this->Form->input('Cliente.movil',array('maxlength'=>'12','label' =>'Teléfono Móvil','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Celular",'onKeyPress'=>'return numeros(event)'));
     		     echo $this->Form->input('Cliente.password',array('maxlength'=>'4','label' =>'Clave','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Clave para Ingresar"));

                    echo $this->Form->input('Cliente.telefono',array('maxlength'=>'12','label' =>'Teléfono Casa','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Teléfono Casa",'onKeyPress'=>'return numeros(event)'));      
                    
                    echo $this->Form->input('Cliente.fecha_nacimiento',array('type'=>'text' ,'label' =>'Fecha de Nacimiento','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Fecha de Nacimiento",'onKeyPress'=>'return letras(event)'));
                    echo $this->Ajax->datepicker('ClienteFechaNacimiento', array('dateFormat'=>'dd-mm-yy','readonly'=>'true','changeMonth' => true,'changeYear' => true,'maxDate' => '"+1M +2D"','buttonImageOnly' => true,'showOn' => 'button','buttonImage' => 'img/calendar.png'));
                    echo $this->Form->input('Cliente.profesion',array('maxlength'=>'90','label' =>'Profesión ú Oficio','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Profesión u Oficio"));
     		
                        	
                    ?>
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
                   echo $this->Form->input('DireccionCliente.id_cliente',array('type' => 'hidden','onKeyPress'=>'return numeros(event)'));
		   
                   echo $this->Form->input('DireccionCliente.estado',array('maxlength'=>'50','label' =>'Estado','readonly'=>'true','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Estado"));

                   echo $this->Form->input('DireccionCliente.ciudad',array('maxlength'=>'50','label' =>'Ciudad','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Ciudad"));
     		   echo $this->Form->input('DireccionCliente.direccion',array('maxlength'=>'200','label' =>'Dirección','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control", 'placeholder'=>"Dirección Completa"));
     		
                      	          
            ?>
                    </div>
                             
             </div>
           </div>
           
          </div>
                  
           </div>
   <?php
 echo $this->Ajax->submit(__('Guardar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'nuevo'), 'update' => 'sii','loading'=>'mini_loading','indicator'=>'mini_loading'));


?> 
</div>
 



