<div id="buscar" style="border:1px">
<?php
 if(isset($Exito)){echo $cargar->msj_exito($Exito);}
if(isset($Error)){echo $cargar->msj_error($Error);}
  $paginator->options(array('url'=>array( 'controller' => 'Clientes', 'action' => 'vista_clientes'),'update' => 'buscar', 'indicator' => 'mini_loading','loading'=>'mini_loading'));
  echo $this->Ajax->link('Nuevo Cliente',
          array('controller'=>'Clientes', 'action'=>'nuevo'),
          array('class'=>'fa fa-user-plus btn btn-primary','update' => 'clienteadd .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#cliente").find(".panel-body").children().remove();  '
              . '  $("#cliente").hide(1000);$("#clienteadd").removeClass("animated zoomOut"); $("#clienteadd").fadeIn(500);'));
?>
    <div class="row pull-right">
  <div class="col-xs-8">
    <div class="input-group">
      <input type="text" id="busquedaorden" class="form-control">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Buscar</button>
      </span>
    </div>
  </div>
</div>
     <table id='tblMain' class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('ID','reg_id');?></th>
           		<th><?php echo $this->Paginator->sort('Cédula ó NIT','cedula');?></th>
			<th><?php echo $this->Paginator->sort('Nombre','fullname');?></th>
			<th><?php echo $this->Paginator->sort('Correo','email');?></th>
			<th><?php echo $this->Paginator->sort('Télefono','telefono');?></th>
			<th><?php echo $this->Paginator->sort('Movil','movil');?></th>
			
	</tr></thead><tbody id='tblcliente'>
	<?php
	$i = 0;
       	foreach ($Clientes as $Cliente):
           
		$class = ' class="fondo1"';
                    if($i++%2==0)
                   $class = ' class="fondo2"';
	?>
        <tr<?php echo $class;   echo "id='".$Cliente['Cliente']['reg_id']."'"?> >
            <td><?php echo $Cliente['Cliente']['reg_id']; ?>&nbsp;</td>
		<td><?php echo $Cliente['Cliente']['cedula']; ?>&nbsp;</td>
		<td><?php echo $Cliente['Cliente']['fullname']; ?>&nbsp;</td>
                <td><?php echo $Cliente['Cliente']['email']; ?>&nbsp;</td>
		<td><?php echo $Cliente['Cliente']['telefono']; ?>&nbsp;</td>
		<td><?php echo $Cliente['Cliente']['movil']; ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</tbody></table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('pag. %page% de %pages%,  %current% filas de %count% en total, desde %start%, hasta %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
        <script type="text/javascript">
        //<![CDATA[
        
$('#busquedaorden').focus();

    $('#tblcliente tr').bind('click', function(){ 
    var row=$(this).parent();
    
    var orden = $("#tblcliente").children().eq($(this).index());  
    var id = orden.attr('id');
    $.ajax({
        async:true, 
        type:'post', 
        beforeSend:function(request) {
            $('#mini_loading').show();
            $("#cliente").find(".panel-body").children().remove();
            $("#cliente").hide(1000);
            $("#vercliente").removeClass("animated zoomOut");
            $("#vercliente").fadeIn(500);
        }, 
        complete:function(request, json) {
            $('#vercliente .panel-body').html(request.responseText); 
            $('#vercliente .panel-heading i.info').html(orden.find('td').eq(2).text()); 
            $('#mini_loading').hide()},
        url:'Clientes/vercliente/'+id}) });
//]]>
</script>