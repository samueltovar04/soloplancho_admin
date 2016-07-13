<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo $title_for_layout;  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php
//echo $this->Html->meta('favicon');
echo $this->Html->css('cake.generic');
echo $this->Html->css('cantv_estilos_rojo');

echo $javascript->link('jquery-2.1.4.min')."\n";
echo $javascript->link('jquery.dataTables.min')."\n";
echo $javascript->link('bootstrap.min')."\n";
echo $javascript->link('dataTables.bootstrap.min')."\n";
echo $javascript->link('bootstrapValidator.min')."\n";
echo $javascript->link('bootstrap-datepicker.min')."\n";
echo $javascript->link('bootstrap-switch/js/bootstrap-switch.min')."\n";
echo $javascript->link('funciones')."\n";

?>
