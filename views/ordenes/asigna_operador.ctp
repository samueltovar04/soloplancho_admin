<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
    ?>
  <div class="col-xs-2">
                               <strong> Peso:</strong>
                            </div> 
                            <div class="col-xs-2">
                                <strong>Asignar Operador:</strong>
                            </div>
                    <?php
                        echo $this->Form->create('UsuarioOrden',array('class'=>'form-group'));
                   ?><div class="col-xs-12">
                        <div class="col-xs-2">
                        <div class="input-group"> 
                    <?php
                        echo $this->Form->input('OrdenServicio.peso_libras',array('readonly'=>true,'size'=>'6','label' =>false,'div'=>false,'class'=>"form-control",'id'=>'peso','maxlength'=>'5','onKeyPress'=>'return numeros_punto(event)'));
                 ?>
                       <span class="input-group-btn">
                            ...<button class="buscar_peso btn btn-default" type="button"><span class="glyphicon glyphicon-refresh"></span></button>
                      </span>  
                            </div>
                            </div>
                            <div class="col-xs-8">
                  <?php          
                        
                        //echo $this->Form->input('OrdenServicio.observacion',array('label' =>'Observación','div'=>array('class'=>'col-xs-5 form-group'),'class'=>"form-control",'onKeyPress'=>'return letras(event)'));
                                       
                        echo $this->Form->input('UsuarioOrden.id_orden',array('type' => 'hidden','value'=>$id,'onKeyPress'=>'return numeros(event)'));
                        echo $this->Form->input('UsuarioOrden.id_usuario',array('label' =>false,'div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>$operador));
                       if(isset($id))
                        echo $this->Ajax->submit(__('Guardar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-8 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'asigna_operador',$id), 'update' => 'asignar','loading'=>'mini_loading','indicator'=>'mini_loading'));
                    ?>
                                 </div>
                         </div>
                <script type="text/javascript">
                   $(function() {
                        $("form:not(.filter) :input:visible:enabled:first").focus();
                        $.getJSON("http://localhost/leer_puerto.php", function(json) { 
                            console.log(json);	
                            $('#peso').val(json.peso);
                        });
                        $('.buscar_peso').on('click', function(){ 
                            $.getJSON("http://localhost/leer_puerto.php", function(json) { 
                                console.log(json);	
                                $('#peso').val(json.peso);
                            });
                        }); 
                        
                    });
                </script>