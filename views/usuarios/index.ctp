<div id="buscar" style="border:1px">
<?php
 if(isset($Exito)){echo $cargar->msj_exito($Exito);}
if(isset($Error)){echo $cargar->msj_error($Error);}
  $paginator->options(array('url'=>array( 'controller' => 'Usuarios', 'action' => 'index'),'update' => 'buscar', 'indicator' => 'mini_loading','loading'=>'mini_loading'));
  echo $this->Ajax->link('Nuevo Empleado',
          array('controller'=>'Usuarios', 'action'=>'usuarioadd'),
          array('class'=>'fa fa-user-plus btn btn-primary','update' => 'usuarioadd .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading','beforeSend'=>'$("#empleados").find(".panel-body").children().remove();    $("#empleados").hide(1000);$("#usuarioadd").removeClass("animated zoomOut"); $("#usuarioadd").fadeIn(500);'));
?>

     <table id='tblMain' class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('ID','id_usuario');?></th>
           		<th><?php echo $this->Paginator->sort('Cédula ó NIT','cedula');?></th>
			<th><?php echo $this->Paginator->sort('Nombre','fullname');?></th>
			<th><?php echo $this->Paginator->sort('Correo','email');?></th>
			<th><?php echo $this->Paginator->sort('Tipo Usuario','tipo');?></th>
			<th><?php echo $this->Paginator->sort('Movil','movil');?></th>
                        <th>Estado</th>
	</tr></thead><tbody id='tblusuario'>
	<?php
	$i = 0;
       	foreach ($usuarios as $Cliente):
           $class = ' class="fondo1"';
           if($i++%2==0)
               $class = ' class="fondo2"';
	?>
        <tr<?php echo $class;   echo "id='".$Cliente['Usuario']['id_usuario']."'"?> >
            <td><?php echo $Cliente['Usuario']['id_usuario']; ?>&nbsp;</td>
		<td><?php echo $Cliente['Usuario']['cedula']; ?>&nbsp;</td>
		<td><?php echo $Cliente['Usuario']['fullname']; ?>&nbsp;</td>
                <td><?php echo $Cliente['Usuario']['email']; ?>&nbsp;</td>
		<td><?php 
                if($Cliente['Usuario']['tipo']==1) 
                {
                    echo "Administrador";
                }else if($Cliente['Usuario']['tipo']==2) 
                {
                    echo "Asistente";
                }else if($Cliente['Usuario']['tipo']==3) 
                {
                    echo "Delivery";
                }else if($Cliente['Usuario']['tipo']==4) 
                {
                    echo "Operador";
                }
                ?>&nbsp;</td>
		<td><?php echo $Cliente['Usuario']['movil']; ?>&nbsp;</td>
                <td><?php /*if($Cliente['Usuario']['status']) echo "Activo"; else echo "Inactivo"; */
                if($Cliente['Usuario']['status']) $true='true'; else $true='false';
                echo $this->Form->input('status', array(
    'div' => false,
    'label' => false,
    'hiddenField' => false,
                    'checked'=>$true,
                    'value'=>$Cliente['Usuario']['status'],
                    'type'=>'checkbox',
    'before' => '<label>',
    'after' => '<span class="toggle"></span></label>'
));
                ?>
                </td>
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
        $("[id='status']").bootstrapSwitch();
        $('input[id="status"]').on('switchChange.bootstrapSwitch', function(event, state) {
            var tr=$(this).parent().parent().parent().parent().parent();
            var id = tr.attr('id');
            $.ajax({
                async:true, 
                type:'post', 
                beforeSend:function(request) {
                    $('#mini_loading').show();
                }, 
                complete:function(request, json) { 
                    console.log(json);
                    $('#mini_loading').hide()},
                url:'Usuarios/asigna_status/'+id+'/'+state});
            //console.log($(this).parent().parent().parent().parent().parent().attr('id')); // DOM element
            //console.log(event); // jQuery event
            //console.log(state); // true | false
            });
        
$('#tblusuario tr').bind('click', function(){ 
    var row=$(this).parent();
    
    var orden = $("#tblusuario").children().eq($(this).index());  
    var id = orden.attr('id');
    console.log(orden.find('td').eq(2).text());
    $.ajax({
        async:true, 
        type:'post', 
        beforeSend:function(request) {
            $('#mini_loading').show();
          
    //$('#empleados').addClass("animated zoomOut");
     $("#empleados").find(".panel-body").children().remove();
    $("#empleados").hide(1000);
            $("#verusuario").removeClass("animated zoomOut");
            $("#verusuario").fadeIn(500);
        }, 
        complete:function(request, json) {
            $('#verusuario .panel-body').html(request.responseText);
            $('#mini_loading').hide()},
        url:'Usuarios/verusuario/'+id}) });
//]]>
</script>

