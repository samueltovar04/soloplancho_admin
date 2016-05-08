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