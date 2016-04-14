<?php
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
    ?> <div class="panel-body">
  <?php echo $this->Form->create('Articulo');
            if(isset($ordenes['OrdenArticulo']))
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
              <?php             $m=1;
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
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.categoria",array('id'=>"categoria$key$i",'label' =>false,'div'=>false,'class'=>"form-control",'empty'=>array('nino'=>"Niño"),'options'=>array("nina"=>"Niña","dama"=>"Dama","caballero"=>"Caballero","otros"=>"Otros")))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.marca",array('label' =>false,'div'=>false,"maxlength"=>50,'class'=>"form-control","placeholder"=>"Marca / Modelo"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.observacion",array('label' =>false,'div'=>false,"maxlength"=>180,'class'=>"form-control","placeholder"=>"Observación"))."</td>"
                           . "<td>".$this->Form->input("CodbarraArticulo.$key.$i.codigo_barra",array('id'=>"codigobarra0$m",'label' =>false,'div'=>false,"maxlength"=>20,"placeholder"=>"Código de Barra",'class'=>"form-control"))."</td></tr>";
                              $cant+=1;
                              $m++; 
                        }
                   }
                ?>
        <?php
            if(isset($ordenes['OrdenArticulo']))
                 echo $this->Ajax->submit(__('Asignar Cod. Barra', true), array('class'=>'btn btn-primary form-group','url'=> array('controller'=>'Ordenes', 'action'=>'asigna_codbarra',$ordenes['OrdenServicio']['id_orden']), 'update' => 'codigobarra','loading'=>'mini_loading','indicator'=>'mini_loading'));
        ?>
        </tbody>
      </table> 
</div>