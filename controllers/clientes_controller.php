<?php
App::import('Vendor', 'qrcode/qr');
class ClientesController extends AppController {

         var $paginate = array('limit' => 20,'order'=>'Cliente.cedula ASC');
	var $name = 'Clientes';
        var  $con=array();
        var $uses=array('Cliente','DireccionCliente','Balanza','OrdenArticulo','Articulo','Usuario','Configuracion','OrdenServicio');
        var $components = array('RequestHandler');
	var $helpers = array('Html','Form' => array('className' => 'BootstrapForm'),'Cargar','Ajax','Js','Paginator'=>array('ajax'=>'Ajax'));
        var $layout = 'ajax';
	function index() {
		
           $this->redirect('/Bienvenidos');
	}
        
        function vista_clientes(){
            $this->con['Cliente.status']='1';	
            $this->Cliente->recursive = 2;
            $edo=$this->paginate('Cliente',$this->con);
            //pr($edo);
            $this->set('Clientes',$edo);
        }
        
        function vista_clientes_nuevos(){
          $this->paginate = array('limit' => 20,'order'=>'Cliente.reg_id ASC');
          $con=array('Cliente.status=1 and Cliente.id_balanza IS NULL');
            $this->Cliente->recursive = 2;
            $edo=$this->paginate('Cliente',$con);
            //pr($edo);
            $this->set('Clientes',$edo);
            $this->render("vista_clientes");
        }
        
        function nuevo(){
           if (!empty($this->data)) {
                
                $this->Cliente->create();
                if(empty($this->data['Cliente']['cedula'])){
                  $this->set('Error','Cédula Obligatoria');
                }else
                    if(empty($this->data['Cliente']['email'])){
                  $this->set('Error','Correo Obligatoria');
                }else
                    if(empty($this->data['Cliente']['fullname'])){
                  $this->set('Error','Correo Obligatoria');
                }else
                    if(empty($this->data['Cliente']['sexo'])){
                  $this->set('Error','Correo Obligatoria');
                }else
                    if(empty($this->data['Cliente']['movil'])){
                  $this->set('Error','Correo Obligatoria');
                }
                else
                    if(empty($this->data['Cliente']['password'])){
                  $this->set('Error','Clave Obligatoria');
                }else
                   if(empty($this->data['DireccionCliente']['ciudad'])){
                  $this->set('Error','Ciudad en Dirección Obligatoria');
                }else
                    {
                    $date=date("Y-m-d H:i:s");
                     $this->data['Cliente']['reg_date']=$date;
                     $fecha = date_create($this->data['Cliente']['fecha_nacimiento']);
                     $this->data['Cliente']['fecha_nacimiento']=date_format($fecha, 'Y-m-d');
                    if($this->Cliente->save($this->data)){
                        $this->data['DireccionCliente']['id_cliente']=$this->Cliente->id;
                        if($this->DireccionCliente->save($this->data)){
                            $errorCorrectionLevel = 'L';
                            $matrixPointSize = 4;
                            $PNG_TEMP_DIR = 'img/qrcode/temp'.DIRECTORY_SEPARATOR;
                            $filename = $PNG_TEMP_DIR.'test'.md5($this->data['Cliente']['cedula'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
                            QRcode::png(base64_encode(base64_encode($cedula)), $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
                            $are=array(0=>strtolower(strtolower(trim($this->data['Cliente']['email']))));
                            $mensaje="Bienvenido a nuestra empresa soloplancho\n usted puede realizar solicitudes por nuestra apps o en nuestra web http://cliente.soloplancho.com\n"
                                    . "Su usuario el el email: ".strtolower(trim($this->data['Cliente']['email'])). " y Clave: ".trim($this->data['Cliente']['password']);
                            $this->enviar_mensaje($are, $mensaje, 'REGISTRO APPS SOLOPLANCHO.COM');
                            $this->set('Exito',' cliente registrado con exito');
                            $this->data=null;
                             
                            }  else {
                                $this->set('Error','error registrando cliente');
                            }
                        }  else {
                            $this->set('Error','error registrando cliente');
                        }
                    
                }       
            }
        }
        
        function editarcli($id = null){
             
		if (empty($this->data)) {
                        $this->Cliente->recursive = 3;
			$this->data = $this->Cliente->read(null, $id);
                }else{
                    $this->Cliente->create();
                    $res=$resul=array();
                    $res=$this->Cliente->find('first',array('conditions'=>array('Cliente.reg_id !='=>trim($this->data['Cliente']['reg_id']),'Cliente.status !='=>'0','Cliente.cedula'=> trim($this->data['Cliente']['cedula']))));
                    $resul=$this->Cliente->find('first',array('conditions'=>array('Cliente.reg_id !='=>trim($this->data['Cliente']['reg_id']),'Cliente.email'=> trim($this->data['Cliente']['email']))));
                    
                    if($res){
                        $this->set('Error','Ya Existe un cliente con la misma cédula');
                    }else
                        if($resul){
                        $this->set('Error','Ya Existe un cliente con mismo correo');
                    }else
                    {
                        if($this->Cliente->save($this->data)){
                            $errorCorrectionLevel = 'L';
                            $matrixPointSize = 4;
                            $PNG_TEMP_DIR = 'img/qrcode/temp'.DIRECTORY_SEPARATOR;
                            $filename = $PNG_TEMP_DIR.'test'.md5($this->data['Cliente']['cedula'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
                            QRcode::png(base64_encode(base64_encode($cedula)), $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

                            $this->set('Exito',' cliente actualizado con exito');
                        }  else {
                            $this->set('Error','error actualizando cliente');
                        }
                    }
                    //$this->Cliente->recursive = 3;
                    //$this->data = $this->Cliente->read(null, $id);
                }
                $this->set('id',$id);
        }
        
        function editardir($id = null){
             
		if (empty($this->data)) {
                        $this->Cliente->recursive = 3;
			$this->data = $this->Cliente->read(null, $id);
                }else{
                    $this->DireccionCliente->create();
                    
                    if($this->DireccionCliente->save($this->data)){
                            $this->set('Exito','dirección cliente actualizado con exito');
                        }  else {
                            $this->set('Error','error actualizando dirección cliente');
                        }
                }
                $this->set('id',$id);
        }
        function listado($ced=null){
            if(!empty($ced)){
            $this->set('cedula',$ced);
            $this->layout='pdf';
            $this->render('pdf_code');
            }  else {
                $this->redirect('/Bienvenidos');
            }
        }
                
         function asigna_balanza($id = null){
             //pr($this->data);
             if(empty($this->data['Balanza']['codigo2'])){
                 $this->set('Error','Código Balanza Obligatorio');
             }else
                 if(empty($this->data['Balanza']['id_usuario'])){
                 $this->set('Error','Nombre Delivery Obligatorio');
             }else
                 {
		 $res=$this->Balanza->find('first',array('conditions'=>array('Balanza.status'=>'1','Balanza.codigo'=> trim($this->data['Balanza']['codigo2']))));
                  //  pr($this->data);
                    $cod='';
                    if(isset($this->data['Balanza']['codigo']))
                        $cod=$this->data['Balanza']['codigo'];
                if($res){
                    $this->set('Error','Ya Existe código Balanza');
                   
                }else{
                    $this->Balanza->create();
                    $date=date("Y-m-d H:i:s");
                     $this->data['Balanza']['fecha_registro']=$date;
                     
                     $this->data['Balanza']['codigo']=$this->data['Balanza']['codigo2'];
                    if($this->Balanza->save($this->data)){
                            $this->Cliente->create();
                            //$this->data['Cliente']['reg_id']=$this->data['Balanza']['id_usuario'];
                            $this->data['Cliente']['id_balanza']=$this->Balanza->id;
                            
                            if($this->Cliente->save($this->data)){
                                $this->set('Exito','Balanza asignada con exito');
                                 $this->Cliente->recursive = 3;
                                $this->data = $this->Cliente->read(null, $id);
                                
                            }else {
                                $this->set('Error','error actualizando balanza cliente');
                                 $this->data['Balanza']['codigo2']= $this->data['Balanza']['codigo'];
                                $this->data['Balanza']['codigo']=$cod;
                            }
                        }  else {
                            $this->set('Error','error actualizando balanza');
                             $this->data['Balanza']['codigo2']= $this->data['Balanza']['codigo'];
                        $this->data['Balanza']['codigo']=$cod;
                        }
                       
                }
             }
                $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3')));
		$this->set('delivery',$resu);
                $this->set('id',$id);
        }
        
        function crear_orden($id = null){
           
            $emp = $this->Session->read('id_empresa');
            $res=$this->Articulo->find('all',array('conditions'=>array('Articulo.status'=>'1')));
	    $this->set('articulos',$res);
            $costo=$this->Configuracion->find('first',array('conditions'=>array('Configuracion.status'=>'1','Configuracion.codigo'=>'costo')));
            $this->set('costo',$costo['Configuracion']['valor']);
            $this->set('idemp',$emp);
            $this->set('id',$id);
             if (empty($this->data['OrdenServicio']['peso_libras'])) {
                        $this->set('Error','Precio Libras Obligatorio');
                }else
                     if (empty($this->data['OrdenServicio']['recepcion']) || count($this->data['OrdenServicio']['recepcion'])<1) {
                        $this->set('Error','Recepción Obligatorio');
                }else
                    {
                     
                    $this->OrdenServicio->create();
                    $can=0;
                    foreach ($this->data['OrdenArticulo'] as $key => $value) {
                            $can+=$value;
                        }
                        if(empty($this->data['OrdenServicio']['precio_orden'])){
                            $this->data['OrdenServicio']['precio_orden']=$costo['Configuracion']['valor']*$this->data['OrdenServicio']['peso_libras'];
                        }
                        $this->data['OrdenServicio']['cantidad_piezas']=$can;
                        $date=date("Y-m-d H:i:s");
                        $this->data['OrdenServicio']['fecha_solicitud']=$date;
                         $this->data['OrdenServicio']['fecha_entrega']=$date;
                    if($this->OrdenServicio->save($this->data)){
                        $ido=$this->OrdenServicio->id;
                        $this->OrdenArticulo->create();
                        $this->OrdenArticulo->primaryKey = '';
                        foreach ($this->data['OrdenArticulo'] as $key => $value) {
                          if(!empty($value)){
                            $d['OrdenArticulo']['id_orden']=$ido;
                            $d['OrdenArticulo']['id_articulo']=$key;
                            $d['OrdenArticulo']['cantidad']=$value;
                            if($this->OrdenArticulo->saveAll($d))
                            {
                                $k=0;
                            }
                            }
                        }
                        $cli=$this->Cliente->find('first',array('fields'=>'email','conditions'=>array('Cliente.id'=>$id)));
                        $are=array(0=>strtolower(strtolower(trim($cli['Cliente']['email']))));
                            $mensaje="Usted ha registrado la orden # $ido\n en soloplancho empresa líder en planchado también visite nuestra web http://www.soloplancho.com\n"
                                    . "Desde su cuenta email: ".strtolower(trim($cli['Cliente']['email']));
                            $this->enviar_mensaje($are, $mensaje, 'ORDEN SERVICIO PARA PLANCHADO, SOLOPLANCHO');
                        $this->set('Exito','orden de servicio crearda con exito');
                    }  else {
                        $this->set('Error','error actualizando dirección cliente');
                    }
                }
        }
                
        function vercliente($id = null) {
		if (!$id) {
			$this->set('Error',__('Listado de Clientes', false));
			$this->index();
                        $this->render('index');
		}
                $this->Cliente->create();
		if (empty($this->data)) {
                        $this->Cliente->recursive = 3;
			$this->data = $this->Cliente->read(null, $id);
		}
                $emp = $this->Session->read('id_empresa');
                $this->con['OrdenServicio.id_empresa']=$emp;
                $this->con['OrdenServicio.id_cliente']=$id;
                $resu=$this->Usuario->find('list',array('fields'=>'id_usuario,fullname','conditions'=>array('Usuario.status'=>'1','Usuario.tipo'=>'3')));
		$this->set('delivery',$resu);
                $res=$this->Articulo->find('all',array('conditions'=>array('Articulo.status'=>'1')));
		$this->set('articulos',$res);
                $costo=$this->Configuracion->find('first',array('conditions'=>array('Configuracion.status'=>'1','Configuracion.codigo'=>'costo')));
		$this->OrdenServicio->recursive = 2;
                $ordenes=$this->paginate('OrdenServicio',$this->con);
        
                $this->set('ordenes',$ordenes);
                $this->set('cedula',$this->data['Cliente']['cedula']);
                $this->set('costo',$costo['Configuracion']['valor']);
                $this->set('id',$id);
                $this->set('idemp',$emp);
	}
        function ordenescliente($id = null){

            $emp = $this->Session->read('id_empresa');
            $this->con['OrdenServicio.id_empresa']=$emp;
            $this->con['OrdenServicio.id_cliente']=$id;
            $this->OrdenServicio->recursive = 2;
            $ordenes=$this->paginate('OrdenServicio',$this->con);
            $this->set('id',$id);
                $this->set('ordenes',$ordenes);
        }
        function mostrarbadge(){
             $emp = $this->Session->read('id_empresa');
             $cliente=$this->Cliente->find('count',array('conditions'=>array('Cliente.id_balanza'=>null)));
             $orden=$this->OrdenServicio->find('count',array('conditions'=>array('OrdenServicio.status'=>'1','OrdenServicio.recepcion'=>'domicilio','OrdenServicio.id_empresa'=>$emp)));
             $ordenc=$this->OrdenServicio->find('count',array('conditions'=>array('OrdenServicio.status'=>'8','OrdenServicio.id_empresa'=>$emp)));
                $data['cliente']=$cliente;
             	$data['ordens']=$orden;
                $data['ordenc']=$ordenc;
                echo json_encode($data); 
                exit; 
        }

	function add() {
		if (!empty($this->data)) {
                
                $this->Cliente->create();
                if(empty($this->data['Cliente']['cedula'])){
                  $this->set('Error','Cédula Obligatoria');
                }else{
                    if($this->Cliente->save($this->data)){
                        $this->data['DireccionCliente']['id_cliente']=$this->Cliente->id;
                        if($this->DireccionCliente->save($this->data)){
                            $this->set('Exito',' cliente registrado con exito');
                            }  else {
                                $this->set('Error','error registrando cliente');
                            }
                        }  else {
                            $this->set('Error','error registrando cliente');
                        }
                }       
            } 
                
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->set('Error',__('No hay Datos', true));
			$this->index();
                               $this->render('vista_clientes');
		}
		if (!empty($this->data)) {
                   $res=$resul=array();
                   $res=$this->Cliente->find('first',array('conditions'=>array('Cliente.id_edo !='=>$this->data['Cliente']['id_edo'],'Cliente.co_stat_data !='=>'E','Cliente.nb_edo'=> strtoupper(trim($this->data['Cliente']['nb_edo'])))));
                                              
                    
                   if($res>0 && !empty($this->data['Cliente']['nb_edo']))
                   {
                      $this->set('Error',__('Nombre del Estado ya Existe', true)); 
                   }else if($resul>0 && !empty($this->data['Cliente']['co_edo_asap'])){
                       $this->set('Error',__('Código del Estado ya Existe', true)); 
                   }
                   else
                   {
                    if($this->data['Cliente']['co_stat_data']=='N')
                    $this->data['Cliente']['co_stat_data']='N';
                    else
                        if($this->data['Cliente']['co_stat_data']=='E')
                    $this->data['Cliente']['co_stat_data']='E';
                    else
                        $this->data['Cliente']['co_stat_data']='M';
                   $this->data['Cliente']['co_edo_asap']=  strtoupper(trim($this->data['Cliente']['co_edo_asap']));
                   $this->data['Cliente']['nb_captl_edo']=  strtoupper(trim($this->data['Cliente']['nb_captl_edo']));
                   $this->data['Cliente']['nb_edo']=  strtoupper(trim($this->data['Cliente']['nb_edo']));
	
                    if ($this->Cliente->save($this->data)) {
                            $this->Cliente->query('COMMIT');
				$this->set('Exito',__('El Estado ha sido Modificado.', true));
			
                                $this->busqueda($this->data['Cliente']['co_edo_asap']);
                                $this->render('busqueda');
                        } else {
				$this->set('Error',__('El Estado no puede ser Modificado.', true));
			}
                    }
                    
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->set('Error',__('No existe este ID', true));
			$this->index();
                        $this->render('index');
		}
                $this->data['Cliente']['id_edo']=$id;
                        $this->data['Cliente']['co_stat_data']='E';
		if ($this->Cliente->save($this->data)) {
                    $this->Cliente->query('COMMIT');
			$this->set('Exito',__('Estado Borrado', true));
			
		}else
		$this->set('Error',__('Estado no puede ser Borrado', true));
		$this->busqueda();
                        $this->render('busqueda');
	}
}
