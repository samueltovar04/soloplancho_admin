<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
 ?>
<div role="tabpanel">
    <div class="row pull-right">
        <?php
           echo $this->Ajax->link('Atras',
          array('controller'=>'Ordenes', 'action'=>'asignar_delivery'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'verdelivery .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#deliverydatos").find(".panel-body").children().remove();
    $("#deliverydatos").hide(1000);$("#verdelivery").removeClass("animated zoomOut"); $("#verdelivery").fadeIn(500);'));
   
?>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="datoscliente">
            <div class="panel panel-info">
                <span class="title-window-panel">
                <i class="fa fa-user-plus"></i>Datos de Cliente
                </span>
                <div class="panel-body">
                        <div class="jumbotron">
                                <div class="row"> 
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

    echo "<div class='col-lg-4'><strong>Orden # ".$ordenes['OrdenServicio']['id_orden']."</strong><br>"
          ."Cant. Libras: ".$ordenes['OrdenServicio']['peso_libras']."<br />"
          ." Recepcion:".$ordenes['OrdenServicio']['recepcion']."</div></div>";

if(isset($usuario['UsuarioOrden'])){
    echo "<div class='row'> <address class='col-lg-12'><strong>Delivery Asignado</strong><br>"
        ."Nombre Delivery: ".$usuario['Usuario']['fullname']."<br />"
        ." Movil:".$usuario['Usuario']['movil']."</div>";
}


?>
                       
        </div> 
                 
          <div id='asignar' class="row">
              <?php
                echo $this->Form->create('UsuarioOrden',array('class'=>'form-group'));
              ?>
            <div class='col-xs-3'>
                <label class='form-group'>IKARO</label>
            </div>
            <?php
                echo $this->Form->input('UsuarioOrden.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden'],'onKeyPress'=>'return numeros(event)'));
                echo $this->Form->input('UsuarioOrden.id_usuario',array('label' =>false,'div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>$delivery));
                
                echo $this->Ajax->submit(__('Asignar ikaro', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-3 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'asigna_orden',$ordenes['OrdenServicio']['id_orden']), 'update' => 'asignar','loading'=>'mini_loading','indicator'=>'mini_loading'));

            ?>
            </div>
           </div>
          </div>
         </div>
        </div>
    </div>
</div>