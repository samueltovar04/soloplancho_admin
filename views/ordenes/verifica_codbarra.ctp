<?php             
     if(isset($Exito)){echo $cargar->msj_exito($Exito);}
    if(isset($Error)){echo $cargar->msj_error($Error);}
    ?>
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
                ?>
       
        </tbody>
      </table>
