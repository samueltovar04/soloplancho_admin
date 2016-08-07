<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
?>
<div role="tabpanel">
    <div class="row pull-right">
        
<?php

    echo $this->Ajax->link('Atras',
          array('controller'=>'Ordenes', 'action'=>'pendiente_pagos'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'pendientepago .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#pendientepagop").find(".panel-body").children().remove();
    $("#pendientepagop").hide(1000);$("#pendientepago").removeClass("animated zoomOut"); $("#pendientepago").fadeIn(500);'));

?></div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#datoscliente2" aria-controls="datoscliente2" role="tab" data-toggle="tab"><i class="fa fa-angle-up"></i>Datos Orden</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="datoscliente2">
            <div class="panel panel-info">
                <span class="title-window-panel">
                <i class="fa fa-user-plus"></i>Datos de Cliente
                </span>
                <div class="panel-body">
                    <div class="container">
                        <div class="jumbotron">
                                <div class="row" id="ordeninfo"> 
<?php                     
    echo  "<div class='col-lg-4'>
            <strong>Cédula Nombre Apellido</strong>
            <br />".$ordenes['Cliente']['cedula']." ".$ordenes['Cliente']['fullname']."
            <br />Teĺefono Movil: ".$ordenes['Cliente']['movil']."
            <br />Correo: ".$ordenes['Cliente']['email']." </div>";
    echo "<div class='col-lg-4'>
            <strong>Dirección del Ciente</strong><br>".
            $ordenes['Cliente']['DireccionCliente']['direccion']."<br>Ciudad: ".
            $ordenes['Cliente']['DireccionCliente']['ciudad']."</div>";
            
             $precio=$ordenes['OrdenServicio']['precio_orden']-($ordenes['OrdenServicio']['peso_descuento']*$costo['Configuracion']['valor']);
            
            $iva=$precio*$impuesto['Configuracion']['valor'];
            $monto=$precio-$iva;
            $total=$precio;
    echo "<div class='col-lg-4'><strong>Orden # ".$ordenes['OrdenServicio']['id_orden']."</strong><br />"
          ."Cant. Piezas: ".$ordenes['OrdenServicio']['cantidad_piezas']."<br />";
            foreach ($ordenes['OrdenArticulo'] as $key => $value) {
              echo  "<strong>".$value['Articulo']['descripcion'].":</strong> ".$value['cantidad']."<br />";
            }
            echo " Recepcion:".$ordenes['OrdenServicio']['recepcion']."</div>";
            echo $this->Form->create('PagoOrden',array(
                                        'inputDefaults' => array(
                                            'autocomplete'=>'off',
                                        'class' => 'form-control',
                                        'div' => array('class' => 'form-group'),
                                        'label' => array('class' => 'control-label'),
                                        'error' => array('attributes' => 
                                            array('wrap' => 'span', 'class' => 'alert-danger')))
                    )); 
                 
                    echo $this->Form->input('PagoOrden.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden']));
/*		    echo $this->Form->input('PagoOrden.precio_pago',array('type' => 'hidden','value'=>$monto,'label' =>false,'div'=>false));
     		    echo $this->Form->input('PagoOrden.iva',array('type' => 'hidden','value'=>$iva,'label' =>false,'div'=>false));
                    echo $this->Form->input('PagoOrden.total',array('type' => 'hidden','value'=>$total,'label' =>false,'div'=>false));
                    */
                    echo $this->Form->input('PagoOrden.metodo_pago',array('Metodo de Pago','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('debito'=>'Debito','credito'=>'Credito','deposito'=>'Deposito','transferencia'=>'Transferencia')));
                    echo $this->Form->input('PagoOrden.numero',array('maxlength'=>'12','label' =>'Número','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Transación",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('PagoOrden.forma_pago',array('Forma de Pago','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('tienda'=>'En Tienda','datafono'=>'Datafono')));
                  
                    echo $this->Form->input('OrdenServicio.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden']));
		    
                    echo $this->Form->input('OrdenServicio.forma_entrega',array('Forma de Entrega','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('tienda'=>'En Tienda','domicilio'=>'A Domicilio')));
                    
                    echo $this->Ajax->submit(__('Pagar Facturar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'facturar',$ordenes['OrdenServicio']['id_orden']), 'update' => 'ordeninfo','loading'=>'mini_loading','indicator'=>'mini_loading'));
                   
                        if(isset($pago['PagoOrden']['id_orden'])){
                      echo $this->Html->link('IMPRIMIR FACTURA',
          array('controller'=>'Ordenes', 'action'=>'impfactura', $ordenes['OrdenServicio']['id_orden'] ),
          array('target'=>'_blank','class'=>'fa fa-print btn btn-primary'));
    } 
                    echo "<strong><h4>Libras : ".$ordenes['OrdenServicio']['peso_libras']." Lb. </h4></strong>"
            ."<strong><h4>Libras Gratis: ".$ordenes['OrdenServicio']['peso_descuento']." Lb. </h4></strong>"
            ."<strong><h4>Monto : ".$monto." $$. </h4></strong>"
            ."<strong><h4>".$impuesto['Configuracion']['descripcion']." : ".$iva." $$. </h4></strong>"
            ."<strong><h4>TOTAL : ".$total." $$. </h4></strong>"
                   
?></div>
                       
                    </div>

                </div>
            </div>
          </div>
        </div>
        
        </div>
    </div>