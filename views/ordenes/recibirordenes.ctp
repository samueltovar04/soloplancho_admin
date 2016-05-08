<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
   ?>
<div role="tabpanel">
     <div class="row pull-right">
        <?php
         echo $this->Ajax->link('Atras',
          array('controller'=>'Ordenes', 'action'=>'recibir_ordenes'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'recibeorden .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#ordenarticulo").find(".panel-body").children().remove();
    $("#ordenarticulo").hide(1000);$("#recibeorden").removeClass("animated zoomOut"); $("#recibeorden").fadeIn(500);'));

?>
         </div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#datoscliente2" aria-controls="datoscliente2" role="tab" data-toggle="tab">Asignar Operador</a></li>
        <li role="presentation"><a href="#codigobarra" aria-controls="codigobarra" role="tab" data-toggle="tab">Asignar Código de Barra</a></li>
        <li role="presentation"><a href="#enviarcorreo" aria-controls="enviarcorreo" role="tab" data-toggle="tab">Notificar Por Correo</a></li>

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

    echo "<div class='col-lg-4'><strong>Orden # ".$ordenes['OrdenServicio']['id_orden']."</strong><br />"
          ."<strong><h4>Peso : ".$ordenes['OrdenServicio']['peso_libras']." Lb. </h4></strong>"
            ."Cant. Piezas: ".$ordenes['OrdenServicio']['cantidad_piezas']."<br />"
          ." Recepcion:".$ordenes['OrdenServicio']['recepcion']."</div>";
?></div><?php
if(isset($usuario['UsuarioOrden'])){
    echo "<div class='row'> <address class='col-lg-12'><strong>Operador Asignado</strong><br>"
        ."Nombre Operador: ".$usuario['Usuario']['fullname']."<br />"
        ." Movil:".$usuario['Usuario']['movil']."</div>";
}


?>
                       
                    </div>
                        <div id='asignar' class="row col-xs-12">
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
                                       
                        echo $this->Form->input('UsuarioOrden.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden'],'onKeyPress'=>'return numeros(event)'));
                        echo $this->Form->input('UsuarioOrden.id_usuario',array('label' =>false,'div'=>array('class'=>'col-xs-3 form-group'),'class'=>"form-control",'empty'=>array(0=>'SELECCIONE'),'options'=>$operador));
                       if(isset($ordenes['OrdenServicio']))
                        echo $this->Ajax->submit(__('Guardar', true), array('class'=>'btn btn-primary','div'=>array('class'=>'col-xs-8 form-group'),'url'=> array('controller'=>'Ordenes', 'action'=>'asigna_operador',$ordenes['OrdenServicio']['id_orden']), 'update' => 'asignar','loading'=>'mini_loading','indicator'=>'mini_loading'));
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
                        <form method="post" action=""></form>
                   </div>
                </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="codigobarra">
            <div class="panel-body">
                <?php echo $this->Form->create('Articulo');
            
                echo $this->Form->input('CodbarraArticulo.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden'],'onKeyPress'=>'return numeros(event)'));

              $cant=1; 
                    ?>
                 <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr >
                            <th class="text-center">
                                #
                            </th>
                            <th class="text-center">
                                Cant.
                            </th>
                            <th class="text-center">
                                Articulo
                            </th>
                            
                            <th class="text-center">
                                Categoria
                            </th>
                            <th class="text-center">
                                Marca / Modelo
                            </th>
                            <th class="text-center">
                                Observación
                            </th>
                            <th class="text-center">
                                Código Barra
                            </th>
                        </tr>
                    </thead>
                    <tbody>
              <?php        $m=1;     
              if(isset($ordenes['OrdenArticulo']))
               foreach ($ordenes['OrdenArticulo'] as $key => $value) 
               {
                    echo $this->Form->input("CodbarraArticulo.$key.id_articulo",array('type' => 'hidden','value'=>$value['id_articulo'],'onKeyPress'=>'return numeros(event)'));
                    echo $this->Form->input("CodbarraArticulo.$key.cantidad",array('type' => 'hidden','value'=>$value['cantidad'],'onKeyPress'=>'return numeros(event)'));
                    for($i=0;$i<$value['cantidad']-$value['guarda'];$i++){
                            
                      echo "<tr id='art$key$i'>"
                           . "<td>".$cant."</td>"
                           . "<td>".($i+1)."</td>"
                           . "<td><label>".$value['Articulo']['descripcion']."</label></td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.categoria",array('label' =>false,'div'=>false,'class'=>"form-control",'empty'=>array('nino'=>"Niño"),'options'=>array("nina"=>"Niña","dama"=>"Dama","caballero"=>"Caballero","otros"=>"Otros")))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.marca",array('label' =>false,'div'=>false,"maxlength"=>50,'class'=>"form-control","placeholder"=>"Marca / Modelo"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.observacion",array('label' =>false,'div'=>false,"maxlength"=>180,'class'=>"form-control","placeholder"=>"Observación"))."</td>"
                            . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.codigo_barra",array('id'=>"codigobarra0$m",'label' =>false,'div'=>false,"maxlength"=>20,"placeholder"=>"Código de Barra",'class'=>"form-control"))."</td></tr>";
                         $m++; 
                      $cant+=1;
                        }
                   }
                ?>
        <?php
            if(isset($ordenes['OrdenServicio']))
                 echo $this->Ajax->submit(__('Asignar Cod. Barra', true), array('class'=>'btn btn-primary form-group','url'=> array('controller'=>'Ordenes', 'action'=>'asigna_codbarra',$ordenes['OrdenServicio']['id_orden']), 'update' => 'codigobarra','loading'=>'mini_loading','indicator'=>'mini_loading'));
        ?>
        </tbody>
      </table> 
                 
            </div>
         </div>
          <div role="tabpanel" class="tab-pane" id="enviarcorreo">
            <div class="panel-body">
                <div class="row pull-10">
                    
                        <div class="input-group">
                            <span class="input-group-addon">Observación de preda(s) Dañada(s) o extraviada(s) en la orden</span>
                            <span class="">
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
         </div>
        </div>
    </div>
</div>