<?php

class OrdenesController extends AppController {

        var $paginate = array('limit' => 10,'order'=>'OrdenServicio.fecha_solicitud ASC');
	var $name = 'Ordenes';
        var  $con=array();
        var $uses=array('Cliente','Articulo','Usuario','CodbarraArticulo','Configuracion','PagoOrden','OrdenServicio','UsuarioOrden');
        var $components = array('RequestHandler');
	var $helpers = array('Html','Form','Cargar','Ajax','Js','Paginator'=>array('ajax'=>'Ajax'));
        var $layout = 'ajax';
	function index() {
		
           $this->redirect('/Bienvenidos');
	}
        function asignar_delivery(){
            $emp = $this->Session->read('id_empresa');
           /* $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']='1';
            $this->con['OrdenServicio.recepcion']='domicilio';*/
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'OrdenServicio.status'=>array('1','2'),
                        'OrdenServicio.recepcion'=>array('drop-off','domicilio')
                    );
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
          
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
            $this->set('ordenes',$ordenes);
        }
        
        function asignar_delivery_nuevo(){
            $emp = $this->Session->read('id_empresa');
           /* $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']='1';
            $this->con['OrdenServicio.recepcion']='domicilio';*/
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'OrdenServicio.status'=>array('1','2'),
                        'OrdenServicio.recepcion'=>array('drop-off','domicilio')
                    );
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
          
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
            $this->set('ordenes',$ordenes);
            $this->render('asignar_delivery');
        }
        
        function deliverydatos($id){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'1')));
            
            if(isset($usu['UsuarioOrden']) && !empty($usu['UsuarioOrden']['id_orden'])){
                $this->set('Error','Posee Delivery Asignado si asigna otro se anular el anterior');
            }
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
            
        }
        
        function asigna_orden($id=null){
            $this->UsuarioOrden->create();
            if(!empty($this->data['UsuarioOrden']['id_usuario']))
            {
                $date=date("Y-m-d H:i:s");
                $usu=$this->data['UsuarioOrden']['id_usuario'];
                $ord=$this->data['UsuarioOrden']['id_orden'];
                $this->data=null;
                $up="update usuario_ordenes set status='0' where status='1' and id_orden='$ord'";
                $u=$this->UsuarioOrden->query($up);
                  $de="insert into usuario_ordenes (id_usuario,id_orden,fecha_asigna) VALUES('$usu','$ord','$date')";
                  $q=$this->UsuarioOrden->query($de);
                if ($q) {
                    $this->data['OrdenServicio']['id_orden']=$ord;
		    $this->data['OrdenServicio']['status']='2';
                    
                    if ($this->OrdenServicio->save($this->data)) {
                        $this->set('Exito',__('El Delivery ha sido Asignado', true));
                        $cli=$this->OrdenServicio->find('first',array('fields'=>'Cliente.reg_id,Cliente.fullname,Cliente.email','conditions'=>array('OrdenServicio.id_orden'=>$id)));
                        $deli=$this->Usuario->find('first',array('fields'=>'Usuario.fullname,Usuario.email','conditions'=>array('Usuario.id_usuario'=>$this->data['UsuarioOrden']['id_usuario'])));
                        
                        $are=array(0=>strtolower(trim($cli['Cliente']['email'])),1=>strtolower(trim($deli['Usuario']['email'])));
                        $mensaje="Estimado(a) ".$cli['Cliente']['fullname']."\n\n\t\tEn ateción a su orden de servicio # $ord ha sido asignada a nuestro representante domiciliario ".$deli['Usuario']['fullname'].", sera retirada en su domicilio\n Muchas gracias por su atención .\n\"No manejamos dinero en efectvo\"\n";
                        $arreglo=array('id_cliente'=>$cli['Cliente']['reg_id'],'titulo'=>"ORDEN SERVICIO ASIGNADA A DELIVERY",'mensaje'=>$mensaje);
			$this->enviar_curl("http://api.soloplancho.com/notifications/sendNotification.php", $arreglo);
                        $this->enviar_mensaje($are, $mensaje, 'ORDEN SERVICIO ASIGNADA A DELIVERY, SOLOPLANCHO.COM');
                            
                        
                            ?> <script type="text/javascript" language="javascript">
		 	     $.ajax({
                                url: 'Ordenes/asignar_delivery/',
                                data: {"data": '1'},
                                type: 'post'
            }                ).done(function(data) {
                                $("#mini_loading").hide();
                                $("#verdelivery .panel-body").html(data);
            }                ).error(function(data){ $("#mini_loading").hide();});
                           </script>
                        <?php
                    } else {
                        $this->set('Error',__('No se pudo Asignar Delivery.', true));
                    }
                } else {
                    $this->set('Error',__('No se pudo Asignar Delivery.', true));
                }
            }else {
		$this->set('Error',__('Seleccione Delivery', true));
            }
            $emp = $this->Session->read('id_empresa');
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
            $this->set('id',$id);
        }
        
        function recibir_ordenes(){
            $emp = $this->Session->read('id_empresa');
            $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']=array('3','4','5');
            $this->con['OrdenServicio.recepcion']=array('drop-off','domicilio');
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);

            $this->set('ordenes',$ordenes);
            $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']=array('1','4','5');
            $this->con['OrdenServicio.recepcion']=array('personal');
           
            $ordenesc=$this->paginate('OrdenServicio',$this->con);
            $this->set('ordenesc',$ordenesc);
        }
        
        function recibir_ordenes_domicilio(){
            $emp = $this->Session->read('id_empresa');
            $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']=array('3','4','5');
            $this->con['OrdenServicio.recepcion']=array('drop-off','domicilio');
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
            /*$resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'4','Usuario.id_empresa'=>$emp)));
	    $this->set('delivery',$resu);*/
            $this->set('ordenes',$ordenes);
        }
        
        
        function recibir_ordenes_personal(){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'4','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
            $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']=array('1','4','5');
            $this->con['OrdenServicio.recepcion']='personal';
           
            $ordenesc=$this->paginate('OrdenServicio',$this->con);
            $this->set('ordenesc',$ordenesc);
        }
        
        function qrordenes($ced=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('Cliente.cedula'=>base64_decode(base64_decode($ced)),'OrdenServicio.status'=>array('3','4','6'))
            ));
            $id=$orden['OrdenServicio']['id_orden'];
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'2')));
            if(isset($orden['OrdenArticulo'])){
            foreach ($orden['OrdenArticulo'] as $key => $value) 
            {
                $art=$this->CodbarraArticulo->find('count',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.id_articulo'=>$value['id_articulo'])));
                $orden['OrdenArticulo'][$key]['guarda']=$art;
                
            }
            }else{
                $this->set('Error',__('Cliente sin Orden por recibir', true));
            }
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'4','Usuario.id_empresa'=>$emp)));
            $this->set('operador',$resu);
            $this->render('recibirordenes');
        }
        
        
        function recibirordenes($id=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'2')));
            foreach ($orden['OrdenArticulo'] as $key => $value) 
            {
                $art=$this->CodbarraArticulo->find('count',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.id_articulo'=>$value['id_articulo'])));
                $orden['OrdenArticulo'][$key]['guarda']=$art;
                
            }
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'4','Usuario.id_empresa'=>$emp)));
            $this->set('operador',$resu);
        }
        
            function info_orden($id=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'2')));
            
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
           
        }
        
        function asigna_operador($id=null){
            
            $this->UsuarioOrden->create();
          if(!empty($this->data['OrdenServicio']['peso_libras'])){
            if(!empty($this->data['UsuarioOrden']['id_usuario']))
            {
                $date=date("Y-m-d H:i:s");
                $usu=$this->data['UsuarioOrden']['id_usuario'];
                $ord=$this->data['UsuarioOrden']['id_orden'];
                //$this->data=null;
                //status 2 usuario inactivo 10 operador usuario delivery 1  inactivo 0
                $up2="update usuario_ordenes set status='10' where status='2' and id_orden='$ord'";
                $u=$this->UsuarioOrden->query($up2);
                $de="insert into usuario_ordenes (id_usuario,id_orden,fecha_asigna,status) VALUES('$usu','$ord','$date','2')";
                $q=$this->UsuarioOrden->query($de);
                $costo=$this->Configuracion->find('first',array('conditions'=>array('Configuracion.status'=>'1','Configuracion.codigo'=>'costo')));
                $peso_viejo=$this->OrdenServicio->find('first',array('fields'=>'Cliente.reg_id,Cliente.fullname,Cliente.email,OrdenServicio.peso_libras','conditions'=>array('OrdenServicio.id_orden'=>$ord)));
                if ($q) {
 
                    $this->data['OrdenServicio']['id_orden']=$ord;
		    $this->data['OrdenServicio']['status']='5';
                  if(!empty($this->data['OrdenServicio']['peso_libras'])){
                    if(($peso_viejo['OrdenServicio']['peso_libras']+$peso_viejo['OrdenServicio']['peso_libras']*0.10)<$this->data['OrdenServicio']['peso_libras'] || ($peso_viejo['OrdenServicio']['peso_libras']-$peso_viejo['OrdenServicio']['peso_libras']*0.10)>$this->data['OrdenServicio']['peso_libras'])
                    {
                       ($peso_viejo['OrdenServicio']['peso_libras']+$peso_viejo['OrdenServicio']['peso_libras']*0.10).' > '.$this->data['OrdenServicio']['peso_libras'].' || '.($peso_viejo['OrdenServicio']['peso_libras']-$peso_viejo['OrdenServicio']['peso_libras']*0.10).' <'.$this->data['OrdenServicio']['peso_libras'];
                       $up="update orden_servicios set peso_cliente=peso_libras where id_orden='$ord' and peso_cliente is null";
                       $u=$this->UsuarioOrden->query($up);
                       $this->data['OrdenServicio']['precio_orden']=$costo['Configuracion']['valor']*$this->data['OrdenServicio']['peso_libras'];
                       $this->data['OrdenServicio']['peso_libras']=$this->data['OrdenServicio']['peso_libras'];   
                       $this->data['OrdenServicio']['observacion']="Estimado(a) ".$peso_viejo['Cliente']['fullname']."\n\n\t\tSe le notifica que el peso de la Orden de Servicio # "
                                .$ord.' es de : '.$this->data['OrdenServicio']['peso_libras'].' Lbs. , notando una pequeña diferencia'
                                .' con la colocada online por usted de '.$peso_viejo['OrdenServicio']['peso_libras'].' Lbs. , de igual manera seguiremos con el proceso normal de su orden.'; 
                           $are=array(0=>strtolower(trim($peso_viejo['Cliente']['email'])));
                          $arreglo=array('id_cliente'=>$peso_viejo['Cliente']['reg_id'],'titulo'=>"ORDEN SERVICIO CON PESO DIFERENTE EN TIENDA",'mensaje'=>$this->data['OrdenServicio']['observacion']);
			$this->enviar_curl("http://api.soloplancho.com/notifications/sendNotification.php", $arreglo);
                           $this->enviar_mensaje($are, $this->data['OrdenServicio']['observacion'], 'ORDEN SERVICIO CON PESO DIFERENTE EN TIENDA, WWW.SOLOPLANCHO.COM');
                            $this->set('Exito',__('El Operador ha sido Asignado y el Cliente se a notificado vía correo por error en las libras de la orden', true));
                    }else{
                            $this->data['OrdenServicio']['observacion']='';
                    }
                  }
                    if ($this->OrdenServicio->save($this->data)) {
                        
                        $this->set('Exito',__('El Operador ha sido Asignado', true));
                        ?> <script type="text/javascript" language="javascript">
		 	    $.ajax({
                                url: 'Ordenes/recibir_ordenes/',
                                data: {"data": '1'},
                                type: 'post'
                            }).done(function(data) {
                                $("#mini_loading").hide();
                                $("#recibeorden .panel-body").html(data);
                            }).error(function(data){ $("#mini_loading").hide();});
                            $.ajax({
                                url: 'Ordenes/info_orden/<?=$ord ?>',
                                data: {"id": "<?=$ord ?>"},
                                type: 'post'
                            }).done(function(data) {
                                $("#mini_loading").hide();
                                $("#ordeninfo").html(data);
                            }).error(function(data){ $("#mini_loading").hide();});
                           </script>
                        <?php
                        $this->data=null;
                    } else {
                        $this->set('Error',__('No se pudo Actualizar la Orden.', true));
                    }
                } else {
                    $this->set('Error',__('No se pudo Asignar Operador.', true));
                }
            }else {
		$this->set('Error',__('Seleccione Operador', true));
            }
        }else{
                      $this->set('Error',__('No se encontro peso, verifique el sistema de Balanza', true));
                  }
            $emp = $this->Session->read('id_empresa');
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'4','Usuario.id_empresa'=>$emp)));
            $this->set('operador',$resu);
            $this->set('id',$id);
        }
        function asigna_codbarra($id=null){
            
            if(!empty($this->data)){
                $this->CodbarraArticulo->create();
                $this->CodbarraArticulo->primaryKey='';
               $orden=$this->data['CodbarraArticulo']['id_orden'];
               unset($this->data['CodbarraArticulo']['id_orden']);
               $n=$this->data;
               $gd=0;
                foreach ($n['CodbarraArticulo'] as $key => $value) 
                { 
                   
                    $art=$value['id_articulo'];
                    $cant=$value['cantidad'];
                    unset($value['id_articulo']);
                    unset($value['cantidad']);
                    foreach  ($value as  $articulo){
                      $gd++;
                      $d['CodbarraArticulo']['id_orden']=$orden;
                      $d['CodbarraArticulo']['id_articulo']=$art;
                      $d['CodbarraArticulo']['codigo_barra']=$articulo['codigo_barra'];
                      $d['CodbarraArticulo']['categoria']=$articulo['categoria'];
                      $d['CodbarraArticulo']['marca']=$articulo['marca'];
                      $d['CodbarraArticulo']['observacion']=$articulo['observacion'];
                      
                      $codb=$this->CodbarraArticulo->find('first',array('fields'=>'id_orden,id_articulo','conditions'=>array('CodbarraArticulo.codigo_barra'=>$articulo['codigo_barra'])));//si se van a liberar el codigo,'CodbarraArticulo.status'=>'1')));
                      
                      if(!isset($codb['CodbarraArticulo']['id_orden'])){
                        if(!empty($articulo['marca']))
                            if(!empty($articulo['codigo_barra'])){
                                $this->CodbarraArticulo->saveAll($d);
                                $this->data=NULL;
                               if($gd>2){
                                 ?> <script type="text/javascript" language="javascript">
                                     
                                     $("#mini_loading").hide();
                                   document.getElementById('codigobarra01').focus();
                                  
                                     </script>
                                    <?php
                                }
                            }else{
                                $this->set('Error',__('Campos Vácios', true));
                                $this->data['CodbarraArticulo']['1']['0']['codigo_barra']='';
                                if(isset($this->data['CodbarraArticulo']['0']))
                                    $this->data['CodbarraArticulo']['0']['0']['codigo_barra']='';
                                 ?> <script type="text/javascript" language="javascript">
                                  document.getElementById('codigobarra01').focus();
                                     $("#mini_loading").hide();
                                    </script>
                                    <?php
                                  
                            }
                      }else{
                          $this->set('Error',__('Código de barra ya existe para otro artículo', true));
                      
                            $this->data['CodbarraArticulo']['1']['0']['codigo_barra']='';
                            if(isset($this->data['CodbarraArticulo']['0']))
                            $this->data['CodbarraArticulo']['0']['0']['codigo_barra']='';
                                ?> <script type="text/javascript" language="javascript">
                                    document.getElementById('codigobarra01').focus();
                                     $("#mini_loading").hide();
                             </script>
                              <?php
                             
                      }
                  }
                }
                
                
            }
            $this->data['CodbarraArticulo']['id_orden']=$orden;
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            foreach ($orden['OrdenArticulo'] as $key => $value) 
            {
                $art=$this->CodbarraArticulo->find('count',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.id_articulo'=>$value['id_articulo'])));
                $orden['OrdenArticulo'][$key]['guarda']=$art;
            }
            $this->data['CodbarraArticulo']['1']['0']['codigo_barra']='';
             if(isset($this->data['CodbarraArticulo']['0']))
                 $this->data['CodbarraArticulo']['0']['0']['codigo_barra']='';
                                
            $this->set('ordenes',$orden);
        }
        
        function buscar_ordenes(){
            $emp = $this->Session->read('id_empresa');
            $this->con['OrdenServicio.id_empresa']=$emp;
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
            /*$resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
		$this->set('delivery',$resu);*/
                $this->set('ordenes',$ordenes);
        }
        function resultado_buscar(){
            $emp = $this->Session->read('id_empresa');
            $this->con['OrdenServicio.id_empresa']=$emp;
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
            /*$resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
		$this->set('delivery',$resu);*/
                $this->set('ordenes',$ordenes);
        }
        
        function qrordenesbuscar($ced=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->paginate('OrdenServicio',array('Cliente.cedula'=>base64_decode(base64_decode($ced)),'OrdenServicio.fecha_solicitud>=DATE_SUB(curdate(), INTERVAL 1 MONTH)'));
               //pr($orden);
            $this->set('ordenes',$orden);
            $this->set('ced',$ced);
        }
        
        function busquedaordenes($id=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('all',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>array('1','2','3','4','5'))));
            $pag=$this->PagoOrden->find('first',array('conditions'=>array('PagoOrden.id_orden'=>$id)));
            $pago=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'costo','status'=>'1')));
            $iva=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'impuesto','status'=>'1')));
            
            $this->set('impuesto',$iva);
            $this->set('costo',$pago);
            $this->set('pagorden',$pag);
            $codb=$this->CodbarraArticulo->find('all',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.status'=>'2')));
                
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $this->set('codbarra',$codb);
        }
        
       function verificar_ordenes(){
            $emp = $this->Session->read('id_empresa');
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'OrdenServicio.status'=>array('5','6')
                    );
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);

            $this->set('ordenes',$ordenes);
        }
        
        function qrordenesver($ced=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                 'conditions'=>array('Cliente.cedula'=>base64_decode(base64_decode($ced)),'OrdenServicio.status'=>'5')));
            $id=$orden['OrdenServicio']['id_orden'];
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'2')));
           /* foreach ($orden['OrdenArticulo'] as $key => $value) 
            {
                $art=$this->CodbarraArticulo->find('count',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.id_articulo'=>$value['id_articulo'])));
                $orden['CodbarraArticulo'][$key]['guarda']=$art; 
                $orden['CodbarraArticulo'][$key]['cantidad']=$art;
            }*/
           // pr($orden);
            $codb=$this->CodbarraArticulo->find('all',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.status'=>'2')));
                
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $this->set('codbarra',$codb);
            if(count($orden)<1){
                 $this->set('Error',__('No existe Orden pendiente por verificar', true));
            }  
            $this->render('verificarordenes');
        }
        
        
        
        function verificarordenes($id=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'2')));
           /* foreach ($orden['OrdenArticulo'] as $key => $value) 
            {
                $art=$this->CodbarraArticulo->find('count',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.id_articulo'=>$value['id_articulo'])));
                $orden['CodbarraArticulo'][$key]['guarda']=$art; 
                $orden['CodbarraArticulo'][$key]['cantidad']=$art;
            }*/
           // pr($orden);
            $codb=$this->CodbarraArticulo->find('all',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.status'=>'2')));
                
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $this->set('codbarra',$codb);
        }
        function verifica_codbarra(){
            //pr($this->data);
           $date=date("Y-m-d H:i:s");
            if(!empty($this->data['CodbarraArticulo']['verificacodbarra'])){
                $codb=$this->CodbarraArticulo->find('first',array('conditions'=>array('CodbarraArticulo.id_orden'=>$this->data['CodbarraArticulo']['id_orden'],'CodbarraArticulo.codigo_barra'=>$this->data['CodbarraArticulo']['verificacodbarra'],'CodbarraArticulo.status'=>'1')));
                if($codb){
                    $this->data['CodbarraArticulo']['status']=2;
                    $ido=$this->data['CodbarraArticulo']['id_orden'];
                    $codb=$this->data['CodbarraArticulo']['codigo_barra']=$this->data['CodbarraArticulo']['verificacodbarra'];
                    $upd="update codbarra_articulos set status='2' where codigo_barra='$codb' and id_orden='$ido'";
                    $this->CodbarraArticulo->query($upd);
                    $codok=$this->CodbarraArticulo->find('count',array('conditions'=>array('CodbarraArticulo.id_orden'=>$ido,'CodbarraArticulo.status'=>'1')));
                        if($codok=='0'){
                            $upd="update orden_servicios set status='7' where  id_orden='$ido'";
                            $this->CodbarraArticulo->query($upd);
                            $upd="update usuario_ordenes set status='6',fecha_cumple='$date' where  id_orden='$ido' and status='2'";
                            $this->CodbarraArticulo->query($upd);
                            $this->enviarfactura($ido);
                        }else{
                            $upd="update orden_servicios set status='6' where  id_orden='$ido'";
                            $this->CodbarraArticulo->query($upd);
                        }
                     ?> <script type="text/javascript" language="javascript">
                        
		 	    $.ajax({
                                url: 'Ordenes/verifica_codbarrav/<?=$ido ?>',
                                data: {"data": '1'},
                                type: 'post'
                            }).done(function(data) {
                                $("#mini_loading").hide();
                                $("#codigobarra .panel-body").html(data);
                            }).error(function(data){ $("#mini_loading").hide();});
                            
                           </script>
                        <?php
                    $this->set('Exito',__('Código de Barra Verificado', true));
                }else{
                    $this->set('Error',__('No existe el Código', true));
                }
            }else{
                    $this->set('Error',__('Error Inserte el Código', true));
                }
                 $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$this->data['CodbarraArticulo']['id_orden'])
            ));
            ?> <script type="text/javascript" language="javascript">
                         $('#verificacodbarra').val('');
                         $('#verificacodbarra').focus();
                </script>
            <?php
            $this->set('ordenes',$orden);
        }
        
        function verifica_codbarrav($id=null){
            $codb=$this->CodbarraArticulo->find('all',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.status'=>'2')));
                
            $this->set('codbarra',$codb);
        }
        
        function pendiente_pagos(){
            $emp = $this->Session->read('id_empresa');
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'OrdenServicio.status'=>array('7')
                    );
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);

            $this->set('ordenes',$ordenes);
        }
        
        function pendientepagos($id=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $pag=$this->PagoOrden->find('first',array('conditions'=>array('id_orden'=>$id)));
            $this->set('pago',$pag);
            $pago=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'costo','status'=>'1')));
            $iva=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'impuesto','status'=>'1')));
            
            $this->set('impuesto',$iva);
            $this->set('costo',$pago);
            $this->set('ordenes',$orden);
        }
        
        function facturar($id=null){
             $emp = $this->Session->read('id_empresa');
             $usu = $this->Session->read('id_usuario');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            
            $pago=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'costo','status'=>'1')));
            $iva=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'impuesto','status'=>'1')));
            $pag=$this->PagoOrden->find('first',array('conditions'=>array('id_orden'=>$id)));
            $this->set('pago',$pag);
            $this->set('impuesto',$iva);
            $this->set('costo',$pago);
            
            if($id<10){
                $num='000000'.$id;
            }elseif($id<100){
                $num='00000'.$id;
            }elseif($id<1000){
                $num='0000'.$id;
            }elseif($id<10000){
                $num='000'.$id;
            }elseif($id<100000){
                $num='00'.$id;
            }elseif($id<1000000){
                $num='0'.$id;
            }
            if(($this->data['PagoOrden']['metodo_pago']=='deposito' || $this->data['PagoOrden']['metodo_pago']=='transferencia') && $this->data['PagoOrden']['forma_pago']=='datafono'){
                 $this->set('Error',__('Forma Pago solo puede ser en Tienda', true));
            }else
            if(empty($this->data['OrdenServicio']['forma_entrega'])){
                $this->set('Error',__('Seleccione Forma Entrega', true));
            }else{
                $this->data['PagoOrden']['numero_factura']=$num;
                $this->PagoOrden->create();
                $date=date("Y-m-d H:i:s");
                $cli=$this->OrdenServicio->find('first',array('fields'=>'Cliente.reg_id,Cliente.fullname,Cliente.email','conditions'=>array('OrdenServicio.id_orden'=>$id)));
                        $deli=$this->UsuarioOrden->find('first',array('fields'=>'Usuario.fullname,Usuario.email','conditions'=>array('UsuarioOrden.status'=>'1','UsuarioOrden.id_orden'=>$id)));
                        
                        $are=array(0=>strtolower(trim($cli['Cliente']['email'])),1=>strtolower(trim($deli['Usuario']['email'])));
                        
                           
                if($this->data['PagoOrden']['forma_pago']=='datafono')
                {
                    $this->data['PagoOrden']['status']='1';
                    $this->data['OrdenServicio']['status']='7';
                    $this->data['PagoOrden']['fecha_pago']=NULL;
                    $this->data['PagoOrden']['id_usuario']=$usu;
                    $mensaje="Estimado(a) ".$cli['Cliente']['fullname']."\n\n\t\tLa orden de servicio de planchado # $id, Según fáctura # ".$num.", en fecha $date, \n a solicitud del cliente será cancelada por Datafono en su domicilio en un lapso menor a tres horas\n por soloplancho empresa líder en planchado también visite nuestra web http://www.soloplancho.com\n"
                                    . "Su cuenta email: ".strtolower(trim($cli['Cliente']['email']));
                }else
                    if($this->data['OrdenServicio']['forma_entrega']=='tienda')
                {
                    $this->data['PagoOrden']['status']='2';
                    $this->data['OrdenServicio']['status']='10';
                    $this->data['PagoOrden']['fecha_pago']="$date";
                    $this->data['PagoOrden']['id_usuario']=$usu;
                    $mensaje="Estimado(a) ".$cli['Cliente']['fullname']."\n\n\t\tLa orden de servicio de planchado # $id, Según fáctura # ".$num.", en fecha $date, \n la cual ha sido cancelada y entregada al cliente en la tienda \n por soloplancho empresa líder en planchado también visite nuestra web http://www.soloplancho.com\n"
                                    . "Su cuenta email: ".strtolower(trim($cli['Cliente']['email']));
                }else
                {
                    $this->data['PagoOrden']['status']='2';
                    $this->data['OrdenServicio']['status']='8';
                    $this->data['PagoOrden']['fecha_pago']="$date";
                    $this->data['PagoOrden']['id_usuario']=$usu;
                     $mensaje="Estimado(a) ".$cli['Cliente']['fullname']."\n\n\t\tLa orden de servicio de planchado # $id, Según fáctura # ".$num.", en fecha $date, \n la cual ha sido cancelada y en espera por asignar delivery para entregar al domicilio del cliente \n por soloplancho empresa líder en planchado también visite nuestra web http://www.soloplancho.com\n"
                                    . "Su cuenta email: ".strtolower(trim($cli['Cliente']['email']));
                }
                if($this->PagoOrden->save($this->data)){
                     $this->data['OrdenServicio']['id_orden']=$id;
                    $this->OrdenServicio->save($this->data);
                    if($this->data['PagoOrden']['status']==1){
                        $arreglo=array('id_cliente'=>$cli['Cliente']['reg_id'],'titulo'=>"ORDEN SERVICIO  POR PAGAR, WWW.SOLOPLANCHO.COM",'mensaje'=>$mensaje);
			$this->enviar_curl("http://api.soloplancho.com/notifications/sendNotification.php", $arreglo);
                        $this->enviar_mensaje($are, $mensaje, 'ORDEN SERVICIO  POR PAGAR, WWW.SOLOPLANCHO.COM');
                    }else {
                        $arreglo=array('id_cliente'=>$cli['Cliente']['reg_id'],'titulo'=>"ORDEN SERVICIO PAGADA, WWW.SOLOPLANCHO.COM",'mensaje'=>$mensaje);
			$this->enviar_curl("http://api.soloplancho.com/notifications/sendNotification.php", $arreglo);
                        $this->enviar_mensaje($are, $mensaje, 'ORDEN SERVICIO PAGADA, WWW.SOLOPLANCHO.COM');
 
                    }   
                    $this->set('Exito',__('Pago Realizado con exito', true));
                    
                } else {
                    $this->set('Error',__('Error Al Realizar Pago', true));
                }
                
            }
            $this->set('ordenes',$orden);
        }
        
         function asignar_entrega($id){
             $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('first',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>'4')));
            
            if(isset($usu['UsuarioOrden']) && !empty($usu['UsuarioOrden']['id_orden'])){
                $this->set('Error','Posee Delivery Asignado para la entrega si asigna otro se anular el anterior');
            }
            $pago=$this->PagoOrden->find('first',array('conditions'=>array('PagoOrden.id_orden'=>$id)));
            $this->set('pagos',$pago);
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
        }
        
        function asignaentrega($id=null){
            $this->UsuarioOrden->create();
            if(!empty($this->data['UsuarioOrden']['id_usuario']))
            {
                $date=date("Y-m-d H:i:s");
                $usu=$this->data['UsuarioOrden']['id_usuario'];
                $ord=$this->data['UsuarioOrden']['id_orden'];
                $this->data=null;
                $up="update usuario_ordenes set status='0' where status='4' and id_orden='$ord'";
                $u=$this->UsuarioOrden->query($up);
                  $de="insert into usuario_ordenes (id_usuario,id_orden,fecha_asigna,status) VALUES('$usu','$ord','$date','4')";
                  $q=$this->UsuarioOrden->query($de);
                if ($q) {
                    $this->data['OrdenServicio']['id_orden']=$ord;
		    $this->data['OrdenServicio']['status']='9';
                    
                    if ($this->OrdenServicio->save($this->data)) {
                          $cli=$this->OrdenServicio->find('first',array('fields'=>'Cliente.reg_id,Cliente.fullname,Cliente.email','conditions'=>array('OrdenServicio.id_orden'=>$ord)));
                        $deli=$this->UsuarioOrden->find('first',array('fields'=>'Usuario.fullname,Usuario.email','conditions'=>array('UsuarioOrden.status'=>'4','UsuarioOrden.id_orden'=>$ord)));
                        
                        $are=array(0=>strtolower(trim($cli['Cliente']['email'])),1=>strtolower(trim($deli['Usuario']['email'])));
                        $mensaje="Estimado(a) ".$cli['Cliente']['fullname']."\n\n\t\tLa orden de servicio de planchado # $ord ha sido asignada al delivery ".$deli['Usuario']['fullname'].", sera entregada en su domicilio en un lapso menor a tres horas\n por soloplancho empresa líder en planchado\n";
                        $arreglo=array('id_cliente'=>$cli['Cliente']['reg_id'],'titulo'=>"ORDEN SERVICIO ASIGNADA A DELIVERY PARA ENTREGA AL CLIENTE",'mensaje'=>$mensaje);
			$this->enviar_curl("http://api.soloplancho.com/notifications/sendNotification.php", $arreglo);
                        $this->enviar_mensaje($are, $mensaje, 'ORDEN SERVICIO ASIGNADA A DELIVERY PARA ENTREGA AL CLIENTE, WWW.SOLOPLANCHO.COM');
                        
                        $this->set('Exito',__('El Delivery ha sido Asignado', true));
                        
                    } else {
                        $this->set('Error',__('No se pudo Asignar Delivery.', true));
                    }
                } else {
                    $this->set('Error',__('No se pudo Asignar Delivery.', true));
                }
            }else {
		$this->set('Error',__('Seleccione Delivery', true));
            }
            $emp = $this->Session->read('id_empresa');
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3','Usuario.id_empresa'=>$emp)));
            $this->set('delivery',$resu);
            $this->set('id',$id);
        }
        
        function impfactura($id=null){
            if(!empty($id)){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('all',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>array('1','2','3','4','5'))));
            $pag=$this->PagoOrden->find('first',array('conditions'=>array('PagoOrden.id_orden'=>$id)));
            $pago=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'costo','status'=>'1')));
            $iva=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'impuesto','status'=>'1')));
            
            $this->set('impuesto',$iva);
            $this->set('costo',$pago);
            $this->set('pagorden',$pag);
            $codb=$this->CodbarraArticulo->find('all',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.status'=>'2')));
                
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $this->set('codbarra',$codb);
            $this->set('orden',$id);
            $this->set('adjunto',1);
            $this->layout='pdf';
            $this->render('pdf_facturar');
            }  else {
                $this->redirect('/Bienvenidos');
            }
        }
        
        function enviarfactura($id=null){
            if(!empty($id)){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            $usu=$this->UsuarioOrden->find('all',array('conditions'=>array('UsuarioOrden.id_orden'=>$id,'UsuarioOrden.status'=>array('1','2','3','4','5'))));
            $pag=$this->PagoOrden->find('first',array('conditions'=>array('PagoOrden.id_orden'=>$id)));
            $pago=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'costo','status'=>'1')));
            $iva=$this->Configuracion->find('first',array('conditions'=>array('codigo'=>'impuesto','status'=>'1')));
            
            $this->set('impuesto',$iva);
            $this->set('costo',$pago);
            $this->set('pagorden',$pag);
            $codb=$this->CodbarraArticulo->find('all',array('conditions'=>array('CodbarraArticulo.id_orden'=>$id,'CodbarraArticulo.status'=>'2')));
            
            $this->set('ordenes',$orden);
            $this->set('usuario',$usu);
            $this->set('codbarra',$codb);
            $this->set('orden',$id);
            $this->set('adjunto',1);
            $this->layout='pdf';
            $this->render('pdf_facturaenviar');
            }  else {
                $this->redirect('/Bienvenidos');
            }
        }
        function enviar_notificacion($id=null){
            $emp = $this->Session->read('id_empresa');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            
            if(!empty($this->data)){
                 $mensaje="Estimado(a) ".$orden['Cliente']['fullname']."\n\n\t\tNotificado:\n  ".$this->data['OrdenServicio']['observacion'].", para orden de servicio de planchado # $id \n";
                 $arreglo=array('id_cliente'=>$orden['Cliente']['reg_id'],'titulo'=>"Notificado de problema con la orden de servicio o alguna(s) prenda(s)",'mensaje'=>$mensaje);
			$this->enviar_curl("http://api.soloplancho.com/notifications/sendNotification.php", $arreglo);
                        $this->enviar_mensaje(array(0=>$orden['Cliente']['email']), $mensaje, 'Notificado de problema con la orden de servicio o alguna(s) prenda(s) , SOLOPLANCHO.COM');
                        $this->OrdenServicio->save($this->data);
            }
            
            $this->set('ordenes',$orden);
        }
        
        
        function ordenes_canceladas(){
            $emp = $this->Session->read('id_empresa');
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'OrdenServicio.status'=>array('7','8','9')
                    );
            $this->paginate = array(
                    'recursive'=>-1, // should be used with joins
                    'joins'=>array(
                                array(
                                    'table'=>'pago_ordenes',
                                    'type'=>'left',
                                    'alias'=>'PagoOrden',
                                    'conditions'=>array("PagoOrden.id_orden = OrdenServicio.id_orden and PagoOrden.forma_pago='datafono'")
                                )
                            )
                );
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
            $date=date("d-m-Y");
            $this->PagoOrden->recursive = -1;
            $this->OrdenServicio->recursive = -1;
            $pagos=$this->PagoOrden->find('all',array('fields'=>"DATE_FORMAT(PagoOrden.fecha_pago, '%d-%m-%Y') AS fecha,metodo_pago,sum(PagoOrden.total) total",'conditions'=>array('PagoOrden.status'=>'2',"DATE_FORMAT(PagoOrden.fecha_pago, '%d-%m-%Y')"=>$date),
                'joins'=>array(
                                array(
                                    'table'=>'orden_servicios',
                                    'type'=>'left',
                                    'alias'=>'OrdenServicio',
                                    'conditions'=>array("PagoOrden.id_orden = OrdenServicio.id_orden and OrdenServicio.id_empresa='$emp'")
                                )
                            ),
                'group'=>'PagoOrden.metodo_pago',
                'order'=>'PagoOrden.metodo_pago'));
            $date2=date("m-Y");
            $pagosm=$this->PagoOrden->find('all',array('fields'=>"DATE_FORMAT(PagoOrden.fecha_pago, '%d-%m-%Y') AS fecha,metodo_pago,sum(PagoOrden.total) total",'conditions'=>array('PagoOrden.status'=>'2',"DATE_FORMAT(PagoOrden.fecha_pago, '%m-%Y')"=>$date2),
                'joins'=>array(
                                array(
                                    'table'=>'orden_servicios',
                                    'type'=>'left',
                                    'alias'=>'OrdenServicio',
                                    'conditions'=>array("PagoOrden.id_orden = OrdenServicio.id_orden and OrdenServicio.id_empresa='$emp'")
                                )
                            ),
                'group'=>"PagoOrden.metodo_pago,DATE_FORMAT(PagoOrden.fecha_pago, '%d-%m-%Y')",
                'order'=>"DATE_FORMAT(PagoOrden.fecha_pago, '%d-%m-%Y'),PagoOrden.metodo_pago"));
            
            $this->OrdenServicio->recursive = 2;
           
            
            $date3=date("Y");
            $pagosa=$this->PagoOrden->find('all',array('fields'=>"DATE_FORMAT(PagoOrden.fecha_pago, '%M') AS fecha,metodo_pago,sum(PagoOrden.total) total",'conditions'=>array('PagoOrden.status'=>'2',"DATE_FORMAT(PagoOrden.fecha_pago, '%Y')"=>$date3),
                'joins'=>array(
                                array(
                                    'table'=>'orden_servicios',
                                    'type'=>'left',
                                    'alias'=>'OrdenServicio',
                                    'conditions'=>array("PagoOrden.id_orden = OrdenServicio.id_orden and OrdenServicio.id_empresa='$emp'")
                                )
                            ),
                'group'=>"PagoOrden.metodo_pago,DATE_FORMAT(PagoOrden.fecha_pago, '%M')",
                'order'=>"DATE_FORMAT(PagoOrden.fecha_pago, '%m'),PagoOrden.metodo_pago"));
            
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('all',array(
                'conditions'=>array('OrdenServicio.id_empresa'=>$emp,'OrdenServicio.status'=>'10')
            ));
            
            $this->set('pagosdia',$pagos);
            $this->set('pagosmes',$pagosm);
            $this->set('pagosano',$pagosa);
            $this->set('ordenes',$ordenes);
            $this->set('ordenes_entregadas',$orden);
        }
}
?>