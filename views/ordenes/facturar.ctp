<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}

    
    echo  "<div class='col-lg-4'>
            <strong>Cédula Nombre Apellido</strong>
            <br />".$ordenes['Cliente']['cedula']." ".$ordenes['Cliente']['fullname']."
            <br />Teĺefono Movil: ".$ordenes['Cliente']['movil']."
            <br />Correo: ".$ordenes['Cliente']['email']." </div>";
    echo "<div class='col-lg-4'>
            <strong>Dirección del Ciente</strong><br>".
            $ordenes['Cliente']['DireccionCliente']['direccion']."<br>Ciudad: ".
            $ordenes['Cliente']['DireccionCliente']['ciudad']."</div>";
            $ordendscuento=$ordenes['OrdenServicio']['precio_orden']-$ordenes['OrdenServicio']['peso_descuento'];
            $precio=$ordendscuento-($ordendscuento*$costo['Configuracion']['valor']);
            
            $iva=$precio*$impuesto['Configuracion']['valor'];
            $monto=$precio;
            $total=$precio+$iva;
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
		    echo $this->Form->input('PagoOrden.precio_pago',array('type' => 'hidden','value'=>$monto,'label' =>false,'div'=>false));
     		    echo $this->Form->input('PagoOrden.iva',array('type' => 'hidden','value'=>$iva,'label' =>false,'div'=>false));
                    echo $this->Form->input('PagoOrden.total',array('type' => 'hidden','value'=>$total,'label' =>false,'div'=>false));

                    echo $this->Form->input('PagoOrden.metodo_pago',array('Metodo de Pago','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('debito'=>'Debito','credito'=>'Credito','deposito'=>'Deposito','transferencia'=>'Transferencia')));
                    echo $this->Form->input('PagoOrden.numero',array('maxlength'=>'12','label' =>'Número','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control", 'placeholder'=>"Número de Transación",'onKeyPress'=>'return numeros(event)'));
     		    echo $this->Form->input('PagoOrden.forma_pago',array('Forma de Pago','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('tienda'=>'En Tienda','datafono'=>'Datafono')));
                    echo $this->Form->input('OrdenServicio.forma_entrega',array('Forma de Entrega','div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>array('tienda'=>'En Tienda','domicilio'=>'A Domicilio')));
                 //if(isset($pago['PagoOrden']['id_orden'])){
                      echo $this->Html->link('IMPRIMIR FACTURA',
          array('controller'=>'Ordenes', 'action'=>'impfactura', $ordenes['OrdenServicio']['id_orden'] ),
          array('target'=>'_blank','class'=>'fa fa-print btn btn-primary'));
    //}else
                if(!isset($pago['PagoOrden']['id_orden'])){
                    echo $this->Ajax->submit(__('Facturar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-12 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'facturar',$ordenes['OrdenServicio']['id_orden']), 'update' => 'ordeninfo','loading'=>'mini_loading','indicator'=>'mini_loading'));
                }
                echo "<strong><h4>Libras : ".$ordenes['OrdenServicio']['peso_libras']." Lb. </h4></strong>"
            ."<strong><h4>Libras Gratis: ".$ordenes['OrdenServicio']['peso_descuento']." Lb. </h4></strong>"
            ."<strong><h4>Monto : ".$monto." $$. </h4></strong>"
            ."<strong><h4>".$impuesto['Configuracion']['descripcion']." : ".$iva." $$. </h4></strong>"
            ."<strong><h4>TOTAL : ".$total." $$. </h4></strong>"
                   
?>