<?php

set_time_limit(0);

include("../vendors/correo.php");

$m = new cMailer();
$m->AddAddress("tovar.samuel@gmail.com");
//$m->AddAddress("dir2@dominio.com");

$m->AddSender("stovar@soloplancho.com");
$m->AddSubject("Mensaje de prueba");

$m->AddMessage("Este es un sencillo mensaje de prueba");

$m->AddHost("soloplancho.com",25);

$m->Send();

?>
