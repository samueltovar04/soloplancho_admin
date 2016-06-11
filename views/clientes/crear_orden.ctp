<?php
    if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
         
?>

 <div class="row">
    	
        <?php   
                    echo $this->Form->create('OrdenServicio',array(
                                        'inputDefaults' => array(
                                            'autocomplete'=>'off',
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                   
                    echo $this->Form->input('OrdenServicio.id_cliente',array('type' => 'hidden','value'=>$id,'onKeyPress'=>'return numeros(event)'));
                    echo $this->Form->input('OrdenServicio.id_empresa',array('type' => 'hidden','value'=>$idemp,'onKeyPress'=>'return numeros(event)'));
		    echo $this->Form->input('costo',array('id'=>'costo','type' => 'hidden','value'=>$costo));
		  
                   // echo $this->Form->input('OrdenServicio.peso_libras',array('id'=>'peso_libras','maxlength'=>'5','label' =>'Peso en Libras','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'placeholder'=>"Peso en Libras",'onKeyUp'=>'return costo2(this.value)','onKeyPress'=>'return numeros_punto(event)'));
     		     ?>
                    <div class="col-xs-2">Peso en Libras
                        <div class="input-group"> 
                    <?php
                        echo $this->Form->input('OrdenServicio.peso_libras',array('readonly'=>true,'size'=>'6','label' =>false,'div'=>false,'class'=>"form-control",'id'=>'peso_libras','maxlength'=>'5','onKeyUp'=>'return costo2(this.value)','onKeyPress'=>'return numeros_punto(event)'));
                 ?>
                       <span class="input-group-btn">
                            ...<button class="buscar_peso btn btn-default" type="button"><span class="glyphicon glyphicon-refresh"></span></button>
                      </span>  
                            </div>
                            </div>
     <?php
                    echo $this->Form->input('OrdenServicio.precio_orden',array('id'=>'precio_orden','readonly'=>'true','label' =>'Costo Servicio','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control", 'placeholder'=>"Costo del Servicio"));
                    echo $this->Form->input('OrdenServicio.recepcion',array('label' =>'Recepción','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('domicilio'=>'Domicilio','drop-off'=>'Drop-Off','personal'=>'Personal')));
                    
                    echo $this->Form->input('OrdenServicio.cantidad_piezas',array('type' => 'text','id'=>'cantidadorden','readonly'=>'true','label' =>'Cantidad de Piezas','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control", 'placeholder'=>"Cantidad de Piezas"));
                    echo '<h4 class="modal-title col-xs-12 form-group"></h4>';
                    foreach ($articulos as $key => $value) {
                        
                         echo $this->Form->input('OrdenArticulo.'.$value['Articulo']['id_articulo'],array('maxlength'=>'2','label' =>$value['Articulo']['descripcion'],'div'=>array('class'=>'col-xs-3 required form-group'),'class'=>"form-control", 'placeholder'=>$value['Articulo']['descripcion'],'onKeyPress'=>'return numeros(event)'));
     		  
                    }
                    echo $this->Ajax->submit(__('Crear Orden', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Clientes', 'action'=>'crear_orden',$id), 'update' => 'crearorden','loading'=>'mini_loading','indicator'=>'mini_loading'));

                   ?>
     	 </div>
                <script type="text/javascript">
                   $(function() {
                        $("form:not(.filter) :input:visible:enabled:first").focus();
                        $.getJSON("http://localhost/leer_puerto.php", function(json) { 
                            console.log(json);	
                            $('#peso_libras').val(json.peso);
                        });
                        $('.buscar_peso').on('click', function(){ 
                            $.getJSON("http://localhost/leer_puerto.php", function(json) { 
                                console.log(json);	
                                $('#peso_libras').val(json.peso);
                            });
                        }); 
                        
                    });
                </script>


