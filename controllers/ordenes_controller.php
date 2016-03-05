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
                        'OrdenServicio.recepcion'=>'domicilio'
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
                        'OrdenServicio.status'=>array('1'),
                        'OrdenServicio.recepcion'=>'domicilio'
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
            $this->con['OrdenServicio.recepcion']='domicilio';
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);

            $this->set('ordenes',$ordenes);
            $this->con['OrdenServicio.id_empresa']=$emp;	
            $this->con['OrdenServicio.status']=array('1','4','5');
            $this->con['OrdenServicio.recepcion']=array('drop-off','personal');
           
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
                'conditions'=>array('Cliente.cedula'=>base64_decode(base64_decode($ced)),'OrdenServicio.status'=>'3')
            ));
            $id=$orden['OrdenServicio']['id_orden'];
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
            if(!empty($this->data['UsuarioOrden']['id_usuario']))
            {
                $date=date("Y-m-d H:i:s");
                $usu=$this->data['UsuarioOrden']['id_usuario'];
                $ord=$this->data['UsuarioOrden']['id_orden'];
                //$this->data=null;
                $up="update orden_servicios set peso_cliente=peso_libras where id_orden='$ord'";
                $u=$this->UsuarioOrden->query($up);
                //status 2 usuario inactivo 10 operador usuario delivery 1  inactivo 0
                $up="update usuario_ordenes set status='10' where status='2' and id_orden='$ord'";
                $u=$this->UsuarioOrden->query($up);
                $de="insert into usuario_ordenes (id_usuario,id_orden,fecha_asigna,status) VALUES('$usu','$ord','$date','2')";
                $q=$this->UsuarioOrden->query($de);
                $costo=$this->Configuracion->find('first',array('conditions'=>array('Configuracion.status'=>'1','Configuracion.codigo'=>'costo')));
            
                if ($q) {
                   
                    $this->data['OrdenServicio']['precio_orden']=$costo['Configuracion']['valor']*$this->data['OrdenServicio']['peso_libras'];
                    $this->data['OrdenServicio']['peso_libras']=$this->data['OrdenServicio']['peso_libras'];  
                    $this->data['OrdenServicio']['id_orden']=$ord;
		    $this->data['OrdenServicio']['status']='5';
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
            $emp = $this->Session->read('id_empresa');
            $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'4','Usuario.id_empresa'=>$emp)));
            $this->set('operador',$resu);
            $this->set('id',$id);
        }
        function asigna_codbarra($id=null){
            
            if(!empty($this->data)){
                $this->CodbarraArticulo->create();
               $orden=$this->data['CodbarraArticulo']['id_orden'];
               unset($this->data['CodbarraArticulo']['id_orden']);
                foreach ($this->data['CodbarraArticulo'] as $key => $value) 
                { 
                    $art=$value['id_articulo'];
                    $cant=$value['cantidad'];
                    unset($value['id_articulo']);
                     unset($value['cantidad']);
                  foreach  ($value as  $articulo){
                      //pr($key);
                      $d['CodbarraArticulo']['id_orden']=$orden;
                      $d['CodbarraArticulo']['id_articulo']=$art;
                      $d['CodbarraArticulo']['codigo_barra']=$articulo['codigo_barra'];
                      $d['CodbarraArticulo']['categoria']=$articulo['categoria'];
                      $d['CodbarraArticulo']['marca']=$articulo['marca'];
                      $d['CodbarraArticulo']['observacion']=$articulo['observacion'];
                      if(!empty($articulo['codigo_barra'])){
                        $this->CodbarraArticulo->saveAll($d);
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
               
            $this->set('ordenes',$orden);
            $this->set('ced',$ced);
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
                        'OrdenServicio.status'=>array('6','7')
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
           
            $this->set('ordenes',$orden);
        }
        
        function facturar($id=null){
             $emp = $this->Session->read('id_empresa');
             $usu = $this->Session->read('id_usuario');
            $this->OrdenServicio->recursive = 2;
            $orden=$this->OrdenServicio->find('first',array(
                'conditions'=>array('OrdenServicio.id_orden'=>$id)
            ));
            
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
            }elseif($id<10000000){
                $num=$id;
            }
            if(($this->data['PagoOrden']['metodo_pago']=='deposito' || $this->data['PagoOrden']['metodo_pago']=='transferencia') && $this->data['PagoOrden']['forma_pago']=='punto_inalambrico'){
                 $this->set('Error',__('Forma Pago solo puede ser en Tienda', true));
            }else
            if(empty($this->data['OrdenServicio']['forma_entrega'])){
                $this->set('Error',__('Seleccione Forma Entrega', true));
            }else{
                $this->data['PagoOrden']['numero_factura']=$num;
                $this->PagoOrden->create();
                $date=date("Y-m-d H:i:s");
                if($this->data['PagoOrden']['forma_pago']=='punto_inalambrico')
                {
                    $this->data['PagoOrden']['status']='1';
                    $this->data['OrdenServicio']['status']='7';
                    $this->data['PagoOrden']['fecha_pago']='';
                    $this->data['PagoOrden']['id_usuario']=$usu;
                }else
                    if($this->data['OrdenServicio']['forma_entrega']=='tienda')
                {
                    $this->data['PagoOrden']['status']='2';
                    $this->data['OrdenServicio']['status']='10';
                    $this->data['PagoOrden']['fecha_pago']="$date";
                    $this->data['PagoOrden']['id_usuario']=$usu;
                }else
                {
                    $this->data['PagoOrden']['status']='2';
                    $this->data['OrdenServicio']['status']='8';
                    $this->data['PagoOrden']['fecha_pago']="$date";
                    $this->data['PagoOrden']['id_usuario']=$usu;
                }
                if($this->PagoOrden->save($this->data)){
                     $this->data['OrdenServicio']['id_orden']=$id;
                    $this->OrdenServicio->save($this->data);
                    $this->set('Exito',__('Pago Realizado con exito', true));
                } else {
                    $this->set('Error',__('Error Al Realizar Pago', true));
                }
                
            }
            $this->set('ordenes',$orden);
        }
        function ordenes_canceladas(){
            $emp = $this->Session->read('id_empresa');
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'OrdenServicio.status'=>array('8','9')
                    );
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);

            $this->set('ordenes',$ordenes);
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
}
?>