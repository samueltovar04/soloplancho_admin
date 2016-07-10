<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
    ?> <div class="panel-body">
                <div class="row col-xs-12">
                    
                        <div class="input-group">
                            <span class="input-group-addon">Observación de preda(s) Dañada(s) o extraviada(s) en la orden</span>
                            <span class="col-xs-6">
                            <?php echo $this->Form->create('OrdenServicio');
                
                                echo $this->Form->input('OrdenServicio.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden'],'onKeyPress'=>'return numeros(event)'));
                                echo $this->Form->input('OrdenServicio.observacion',array('label' =>false,'div'=>false,'class'=>"form-control",'onKeyPress'=>'return letras(event)'));
                            ?>
                            </span>
                            <span class="input-group-btn">
                            <?php
                                echo $this->Ajax->submit(__('Notificar correo al Cliente', true), array('div'=>false,'class'=>'btn btn-primary form-group','url'=> array('controller'=>'Ordenes', 'action'=>'enviar_notificacion',$ordenes['OrdenServicio']['id_orden']), 'update' => 'enviarcorreo','loading'=>'mini_loading','indicator'=>'mini_loading'));
                            ?> 
                            </span>
                        </div>
                    
                </div>
            </div>