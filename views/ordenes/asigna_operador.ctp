<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
    echo $this->Form->create('UsuarioOrden',array('class'=>'form-group'));
 
    echo $this->Form->input('OrdenServicio.peso_libras',array('label' =>'Peso Libras','div'=>array('class'=>'col-xs-2 form-group'),'class'=>"form-control",'id'=>'peso','maxlength'=>'5','onKeyPress'=>'return numeros_punto(event)'));
    echo $this->Form->input('OrdenServicio.observacion',array('label' =>'Observación','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'onKeyPress'=>'return letras(event)'));
                          
    echo $this->Form->input('UsuarioOrden.id_orden',array('type' => 'hidden','value'=>$id,'onKeyPress'=>'return numeros(event)'));
    echo $this->Form->input('UsuarioOrden.id_usuario',array('label' =>'operador','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>$operador));
    echo $this->Ajax->submit(__('Guardar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-8 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'asigna_operador',$id), 'update' => 'asignar','loading'=>'mini_loading','indicator'=>'mini_loading'));
?>
 <script type="text/javascript">
                   $(function() {
                        $("form:not(.filter) :input:visible:enabled:first").focus();
                    });
                </script>