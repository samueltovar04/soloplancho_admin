<div role="tabpanel" id="verificarord">
<div class="row pull-right">
    <div class="qrcode col-md-2 img-rounded">
        <i data-parent="4"  class="fa fa-qrcode fa-3x"></i>
       
    </div>  
    
  <div class="col-xs-8"> <?php echo $this->Form->create('Ordenes'); ?>
    <div class="input-group">
    <?php 
            echo $this->Form->input('Ordenes.asigna',array('readonly'=>true,'id'=>"asigna",'maxlength'=>8,'class'=>"form-control",'value'=>'8','type' => 'hidden','div'=>false,'label'=>FALSE));
         echo $this->Form->input('Ordenes.verificacodbarra',array('readonly'=>true,'id'=>"verificacodbarra",'maxlength'=>8,'class'=>"form-control",'value'=>'','type' => 'text','div'=>false,'label'=>FALSE));
       ?>
      <span class="input-group-btn">
       <?php
         echo $this->Ajax->submit(__('Buscar', true), array('div'=>false,'class'=>'btn btn-default form-group','url'=> array('controller'=>'Ordenes', 'action'=>'codordenesbuscar'), 'update' => 'buscarord .panel-body','loading'=>'mini_loading','indicator'=>'mini_loading'));
       ?>
      </span>
    </div>
  </div>
</div>
            <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#buscaorden" aria-controls="buscaorden" role="tab" data-toggle="tab">Articulos a Verificar </a></li>
         
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="buscaorden">
            
                  <div class="panel-body">
                      <?php
  $paginator->options(array('url'=>array( 'controller' => 'Ordenes', 'action' => 'verificar_ordenes'),'update' => 'verificarord', 'indicator' => 'mini_loading','loading'=>'mini_loading'));

 ?>
<div  style="border:1px">
     <table id='tblMain' class="table table-bordered table-hover" cellpadding="0" cellspacing="0"  width="100%">
	<thead><tr>
                <th><?php echo $this->Paginator->sort('# Orden','OrdenServicio.id_orden');?></th>
           		<th><?php echo $this->Paginator->sort('Peso Libras','peso_libras');?></th>
			<th><?php echo $this->Paginator->sort('Costo','precio_orden');?></th>
			<th><?php echo $this->Paginator->sort('Cantidad Piezas','cantidad_piezas');?></th>
			<th><?php echo $this->Paginator->sort('Recepción','recepcion');?></th>
			<th><?php echo $this->Paginator->sort('Fecha Solicitud','fecha_solicitud');?></th>
			<th><?php echo $this->Paginator->sort('Status','OrdenServicio.status');?></th>
                      
	</tr></thead><tbody id='tbordenv'>
	<?php
	$i = 0;
       	foreach ($ordenes as $orden):
          
		$class = "fondo1";
                    if($i++%2==0){
                   $class = "fondo2";
                    }
    
    if($orden['OrdenServicio']['status']=='1'){ $status='Nueva Orden'; $class='primary-color';}
    if($orden['OrdenServicio']['status']=='2'){ $status='Asignada Delivery'; $class='success-color';}
    if($orden['OrdenServicio']['status']=='3'){ $status='Entregada Delivery'; $class='warning-color';}
    if($orden['OrdenServicio']['status']=='4'){ $status='En Tienda';$class='info-color'; }
    if($orden['OrdenServicio']['status']=='5'){ $status='Asignada Operador'; $class='operador-color';}
    if($orden['OrdenServicio']['status']=='6'){ $status='Planchada'; $class='planchada-color';}
    if($orden['OrdenServicio']['status']=='7'){ $status='Pendiente Pago'; $class='pendienp-color'; }
    if($orden['OrdenServicio']['status']=='8'){ $status='Verificando Pago'; $class='cancelada-color'; }
    if($orden['OrdenServicio']['status']=='9'){ $status='Enviada Cliente'; $class='enviada-color';}
    if($orden['OrdenServicio']['status']=='10'){ $status='Entregada Cliente'; $class='entragada-color';}
    
    if($orden['OrdenServicio']['status']=='11'){ $status='>Observación'; $class='danger-color';}
    
    if($orden['OrdenServicio']['status']=='20'){ $status='Anulada'; $class='danger-color';}
             
?>
        <tr<?php echo " class='".$class."' ";   echo "id='".$orden['OrdenServicio']['id_orden']."'"?> >
            <td><?php echo $orden['OrdenServicio']['id_orden']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['peso_libras']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['precio_orden']; ?>&nbsp;</td>
                <td><?php echo $orden['OrdenServicio']['cantidad_piezas']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['recepcion']; ?>&nbsp;</td>
		<td><?php echo $orden['OrdenServicio']['fecha_solicitud']; ?>&nbsp;</td>
                <td><?php echo $status; ?>&nbsp;</td>
               

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
             </div>
                  </div>
               </div>
            
          </div>
</div>



<div id="modal_qrcode" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lector de QR</h4>
      </div>
      <div class="modal-body">
         
            <div class="col-md-12" style="text-align: center;">
                    <div class="well" style="position: relative;display: inline-block;">
                        <canvas id="qr-canvas" width="320" height="240"></canvas>
                        <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                    </div>         
            </div>
        
          
   <script type="text/javascript">
        //<![CDATA[       
 $('#qr-canvas').WebCodeCam({
            ReadQRCode: true, // false or true
            ReadBarecode: true, // false or true
            width: 320,
            height: 240,
            videoSource: {  
                    id: true,      //default Videosource
                    maxWidth: 640, //max Videosource resolution width
                    maxHeight: 480 //max Videosource resolution height
            },
            flipVertical: false,  // false or true
            flipHorizontal: false,  // false or true
            zoom: -1, // if zoom = -1, auto zoom for optimal resolution else int
            beep: "sonidos/beep.mp3", // string, audio file location
            autoBrightnessValue: 8, // functional when value autoBrightnessValue is int
            brightness: 8, // int 
            grayScale: false, // false or true
            contrast: 0, // int 
            threshold: 0, // int 
            sharpness: [], //or matrix, example for sharpness ->  [0, -1, 0, -1, 5, -1, 0, -1, 0]
            resultFunction: function(resText, lastImageSrc) {
                        /* resText as decoded code, lastImageSrc as image source
                        example:*/ 
                        $.ajax({
                                url: 'Ordenes/qrordenesver/'+resText,
                                data: {"ced": resText},
                                type: 'post'
                            }).done(function(data) {
                                $("#mini_loading").hide();
                                 $('#modal_qrcode').modal('hide');
                                 $(".modal-backdrop").remove();
                                $("#verificarorden").find(".panel-body").children().remove();
                                $("#verificarorden").hide(1000);
                                $("#verificararti").removeClass("animated zoomOut");
                                $("#verificararti").fadeIn(500);
                                $('#verificararti .panel-body').html(data); 
                            }).error(function(data){ $("#mini_loading").hide();});
                        //alert(resText);
                        $('#qr-canvas').plugin_WebCodeCam.cameraStopAll();
                        $('#qr-canvas').plugin_WebCodeCam.cameraStop();
            },
            getUserMediaError: function() {
                        /* callback funtion to getUserMediaError
                        example:*/
                        alert('Disculpe su navegador no esta usando soporte getUserMedia');
                        
            },
            cameraError: function(error) {
                        /* callback funtion to cameraError, 
                        example:*/
                        var p, message = 'Error no hay dispositivo:\n';
                        for (p in error) {
                                message += p + ': ' + error[p] + '\n';
                        }
                        //alert(message);
                        
            }
        });
//]]>
</script>
      </div>
         <div class="modal-footer">
         </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



     <script type="text/javascript">
        //<![CDATA[
  $('.qrcode i').on('click', function(){ 
      $('#modal_qrcode').modal('show');
  }); 
             $('#verificacodbarra').focus();
        $('#tbordenv tr').on('click', function(){ 
    var row=$(this).parent();
    
    var orden = $("#tbordenv").children().eq($(this).index());  
    var id = orden.attr('id');
    $.ajax({
        async:true, 
        type:'post', 
        beforeSend:function(request) {
            $('#mini_loading').show();
            $("#verificarorden").find(".panel-body").children().remove();
            $("#verificarorden").hide(1000);
            $("#verificararti").removeClass("animated zoomOut");
            $("#verificararti").fadeIn(500);
        }, 
        complete:function(request, json) {
            $('#verificararti .panel-body').html(request.responseText); 
            $('#mini_loading').hide();
        },
        url:'Ordenes/verificarordenes/'+id}) });

//]]>
</script>
            
