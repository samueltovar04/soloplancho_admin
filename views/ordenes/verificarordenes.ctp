<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
?>
<div role="tabpanel">
    <div class="row pull-right">
<?php
    echo $this->Ajax->link('Atras',
          array('controller'=>'Ordenes', 'action'=>'verificar_ordenes'),
          array('class'=>'fa fa-arrow-left btn btn-default','update' => 'verificarorden .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#verificararti").find(".panel-body").children().remove();
    $("#verificararti").hide(1000);$("#verificarorden").removeClass("animated zoomOut"); $("#verificarorden").fadeIn(500);'));

?></div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a href="#datoscliente2" aria-controls="datoscliente2" role="tab" data-toggle="tab"><i class="fa fa-angle-up"></i>Datos Orden</a></li>
        <li role="presentation" class="active"><a href="#articulosbarra" aria-controls="articulosbarra" role="tab" data-toggle="tab">Verificar Planchado</a></li>
        <li role="presentation"><a href="#codigobarra" aria-controls="codigobarra" role="tab" data-toggle="tab">Prendas Verificadas</a></li>

    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="datoscliente2">
            <div class="panel panel-info">
                <span class="title-window-panel">
                <i class="fa fa-user-plus"></i>Datos de Cliente
                </span>
                <div class="panel-body">
                    <div class="container">
                        <div class="jumbotron">
                               
<?php  
$id='';
if(count($ordenes)>1){
    ?>
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
            ."Cant. Piezas: ".$ordenes['OrdenServicio']['cantidad_piezas']."<br />";
            foreach ($ordenes['OrdenArticulo'] as $key => $value) {
              echo  "<strong>".$value['Articulo']['descripcion'].":</strong> ".$value['cantidad']."<br />";
            }
            echo " Recepcion:".$ordenes['OrdenServicio']['recepcion']."</div>";
?></div><?php
    if(isset($usuario['UsuarioOrden'])){
        echo "<div class='row'> <address class='col-lg-12'><strong>Operador Asignado</strong><br>"
        ."Nombre Operador: ".$usuario['Usuario']['fullname']."<br />"
        ." Movil:".$usuario['Usuario']['movil']."</div>";
    }
    $id=$ordenes['OrdenServicio']['id_orden'];
}

?>
                       
                    </div>

                </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane active" id="articulosbarra">
            
                    <div class="row pull-right">
                      <div class="col-xs-8">
                        <div class="input-group">
                        <?php echo $this->Form->create('CodbarraArticulo');
                            echo $this->Form->input('CodbarraArticulo.id_orden',array('type' => 'hidden','value'=>$ordenes['OrdenServicio']['id_orden'],'onKeyPress'=>'return numeros(event)'));
                            echo $this->Form->input('CodbarraArticulo.verificacodbarra',array('id'=>"verificacodbarra",'maxlength'=>8,'class'=>"form-control",'type' => 'text','div'=>false,'label'=>FALSE));
                        
                            ?>
                            <span class="input-group-btn">
                            <?php
                                echo $this->Ajax->submit(__('Buscar', true), array('div'=>false,'class'=>'btn btn-default form-group','url'=> array('controller'=>'Ordenes', 'action'=>'verifica_codbarra',$id), 'update' => 'asignar','loading'=>'mini_loading','indicator'=>'mini_loading'));
                            ?>
                            </span>
                        </div>
                      </div>
                    </div>
            <div class="panel panel-info">
                <span class="title-window-panel">Prendas Por Orden
                <i class="fa fa-user-plus"></i>
                </span>
                <div class="panel-body">
                    <div id='asignar' class="row">
                         
                 <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr >
                            <th class="text-center">
                                #
                            </th>
                           
                            <th class="text-center">
                                Articulo
                            </th>
                            <th class="text-center">
                                Código Barra
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
                        </tr>
                    </thead>
                    <tbody>
              <?php             
              $cant=1; 
              if(count($ordenes)>1){
               foreach ($ordenes['CodbarraArticulo'] as $key => $value) 
               {
                            
                      echo "<tr id='art$key'>"
                           . "<td>".$cant."</td>"
                          // . "<td>".($i+1)."</td>"
                           . "<td><label>".$value['Articulo']['descripcion']."</label></td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.codigo_barra",array('readonly'=>'true','value'=>$value['codigo_barra'],'label' =>false,'div'=>false,"maxlength"=>20,"placeholder"=>"Código de Barra",'class'=>"form-control"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.categoria",array('value'=>$value['categoria'],'label' =>false,'div'=>false,'class'=>"form-control",'empty'=>array('niño'=>"Niño"),'options'=>array("niña"=>"Niña","dama"=>"Dama","caballero"=>"Caballero","otros"=>"Otros")))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.marca",array('readonly'=>'true','value'=>$value['marca'],'label' =>false,'div'=>false,"maxlength"=>50,'class'=>"form-control","placeholder"=>"Marca / Modelo"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.observacion",array('readonly'=>'true','value'=>$value['observacion'],'label' =>false,'div'=>false,"maxlength"=>180,'class'=>"form-control","placeholder"=>"Observación"))."</td></tr>";
                              $cant+=1;
                       
                   }
              }
                ?>
       
        </tbody>
      </table>
                        <form method="post" action=""></form>
                   </div>
                    <script type="text/javascript">
        //<![CDATA[
             $('#verificacodbarra').focus();

//]]>
</script>
                </div>
            </div>
        </div>
        
        <div role="tabpanel" class="tab-pane" id="codigobarra">
            <div class="panel panel-info">
               
                <div class="panel-body">
                    <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr >
                            <th class="text-center">
                                #
                            </th>
                           
                            <th class="text-center">
                                Articulo
                            </th>
                            <th class="text-center">
                                Código Barra
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php             
              $cant=1; 
              if(count($codbarra)>1){
               foreach ($codbarra as $key => $value) 
               {
                            
                      echo "<tr id='art$key'>"
                           . "<td>".$cant."</td>"
                          // . "<td>".($i+1)."</td>"
                           . "<td><label>".$value['Articulo']['descripcion']."</label></td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.codigo_barra",array('readonly'=>'true','value'=>$value['CodbarraArticulo']['codigo_barra'],'label' =>false,'div'=>false,"maxlength"=>20,"placeholder"=>"Código de Barra",'class'=>"form-control"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.categoria",array('value'=>$value['CodbarraArticulo']['categoria'],'label' =>false,'div'=>false,'class'=>"form-control",'empty'=>array('niño'=>"Niño"),'options'=>array("niña"=>"Niña","dama"=>"Dama","caballero"=>"Caballero","otros"=>"Otros")))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.marca",array('readonly'=>'true','value'=>$value['CodbarraArticulo']['marca'],'label' =>false,'div'=>false,"maxlength"=>50,'class'=>"form-control","placeholder"=>"Marca / Modelo"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.observacion",array('readonly'=>'true','value'=>$value['CodbarraArticulo']['observacion'],'label' =>false,'div'=>false,"maxlength"=>180,'class'=>"form-control","placeholder"=>"Observación"))."</td></tr>";
                              $cant+=1;
                       
                   }
              }
                ?>
       
        </tbody>
      </table>
                </div>
            </div>
        </div>
    </div>
</div>