<?php

class UsuariosController extends AppController{
    var $paginate = array('limit' => 20,'order'=>'Usuario.id_usuario ASC');
	var $name = 'Usuarios';
        var  $con=array();
        var $uses=array('Cliente','Articulo','Usuario','Configuracion','OrdenServicio','UsuarioOrden');
         var $components = array('RequestHandler');
	var $helpers = array('Html','Form' => array('className' => 'BootstrapForm'),'Cargar','Ajax','Js','Paginator'=>array('ajax'=>'Ajax'));
        var $layout = 'ajax';
	function index() {
	    $emp = $this->Session->read('id_empresa');
            $this->con['Usuario.id_empresa']=$emp;	
            $this->Usuario->recursive = 2;
            $ordenes=$this->paginate('Usuario',$this->con);

            $this->set('usuarios',$ordenes);
           
	}
        function cambio_clave(){
             $id = $this->Session->read('id_usuario');
            
            $this->data= $this->Usuario->read(null,$id);
            
           // pr($this->data);
             $this->set('id',$id);
        }
        
        
        function cambioclave(){
            if(empty($this->data['Usuario']['clave_actual'])){
                 $this->set("Error","Clave Actual Obligatotia");
            }else
                if(empty($this->data['Usuario']['clave_nueva'])){
                $this->set("Error","Clave Nueva Obligatotia");
            }else
                if(empty($this->data['Usuario']['confirma'])){
                $this->set("Error","Confirma Obligatotia");
            }else
                if($this->data['Usuario']['clave_nueva']!=$this->data['Usuario']['confirma']){
                $this->set("Error","Las Claves no son iguales");
            }else
                {
               $this->data['Usuario']['clave']= md5($this->data['Usuario']['clave_nueva']);
            if($this->Usuario->save($this->data)){
                    $this->set("Exito","Clave Cambiada");
                    $this->data=null;
                }
                else {
                    $this->set("Error","Error al cambiar la clave");
                }
            }
            $id = $this->Session->read('id_usuario');
            
            $this->data= $this->Usuario->read(null,$id);
             $this->set('id',$id);
        }
        function asigna_status($id,$state){
            $this->data['Usuario']['id_usuario']=$id;
            if($state==='true'){ echo $tate;
                $this->data['Usuario']['status']=1;
            }else {
                $this->data['Usuario']['status']=0;
            }
            if($this->Usuario->save($this->data)){
                    $this->set("Exito","Empleado Actualizado");
                    $this->data=null;
                }
                else {
                    $this->set("Error","Empleado no se pudo Actualizar");
                }
                 $this->set('id',$id);
        }
                
        function usuarioadd(){
            $emp = $this->Session->read('id_empresa');
            if(!empty($this->data)){
            $this->data['Usuario']['id_empresa']=$emp;
            $this->data['Usuario']['clave']= md5($this->data['Usuario']['clave']);
                if($this->Usuario->save($this->data)){
                    $this->set("Exito","Empleado Registrado");
                    $this->data=null;
                }
                else {
                    $this->set("Error","Empleado no se Registro");
                }
            }
        }
        function miperfil($id=null){
            $id = $this->Session->read('id_usuario');
            
            $this->data= $this->Usuario->read(null,$id);
            
           // pr($this->data);
             $this->set('id',$id);
              
        }
        function ordendia($id=null){
            $emp = $this->Session->read('id_empresa');
            
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'UsuarioOrden.id_usuario'=>$id,
                "date_format(UsuarioOrden.fecha_asigna,'%Y%m%d')=curdate() or date_format(UsuarioOrden.fecha_cumple,'%Y%m%d')=curdate()"
                    );
            $this->UsuarioOrden->recursive = 2;
            $usu=$this->paginate('UsuarioOrden',$this->con);
            $this->set('id',$id);
            $this->set('ordenes',$usu);
        }
         function ordensem($id=null){
            $emp = $this->Session->read('id_empresa');
            
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'UsuarioOrden.id_usuario'=>$id,
                        "(date_format(UsuarioOrden.fecha_asigna,'%Y%m%d')>=TIMESTAMPADD(DAY,(0-WEEKDAY(curdate())),curdate()) AND"
                        . " date_format(UsuarioOrden.fecha_asigna,'%Y%m%d')<=TIMESTAMPADD(DAY,(6-WEEKDAY(curdate())),curdate())) or "
                . "(date_format(UsuarioOrden.fecha_cumple,'%Y%m%d')>=TIMESTAMPADD(DAY,(0-WEEKDAY(curdate())),curdate()) AND"
                        . " date_format(UsuarioOrden.fecha_cumple,'%Y%m%d')<=TIMESTAMPADD(DAY,(6-WEEKDAY(curdate())),curdate()))"
                    );
            $this->UsuarioOrden->recursive = 2;
            $usu=$this->paginate('UsuarioOrden',$this->con);
            $this->set('id',$id);
            $this->set('ordenes',$usu);
        }
        
         function ordenmes($id=null){
            $emp = $this->Session->read('id_empresa');
            
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'UsuarioOrden.id_usuario'=>$id,
                "date_format(UsuarioOrden.fecha_asigna,'%m')=date_format(curdate(),'%m') or date_format(UsuarioOrden.fecha_cumple,'%m')=date_format(curdate(),'%m')"
                    );
            $this->UsuarioOrden->recursive = 2;
            $usu=$this->paginate('UsuarioOrden',$this->con);
            $this->set('id',$id);
            $this->set('ordenes',$usu);
        }
        
        function verusuario($id=null){
            $emp = $this->Session->read('id_empresa');
            
            $this->con = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'UsuarioOrden.id_usuario'=>$id,
                        "date_format(UsuarioOrden.fecha_asigna,'%Y%m%d')=curdate() or date_format(UsuarioOrden.fecha_cumple,'%Y%m%d')=curdate()"
                    );
            $this->UsuarioOrden->recursive = 2;
            $usu=$this->paginate('UsuarioOrden',$this->con);
            
            $this->cons = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'UsuarioOrden.id_usuario'=>$id,
                        "(date_format(UsuarioOrden.fecha_asigna,'%Y%m%d')>=TIMESTAMPADD(DAY,(0-WEEKDAY(curdate())),curdate()) AND"
                        . " date_format(UsuarioOrden.fecha_asigna,'%Y%m%d')<=TIMESTAMPADD(DAY,(6-WEEKDAY(curdate())),curdate())) or "
                . "(date_format(UsuarioOrden.fecha_cumple,'%Y%m%d')>=TIMESTAMPADD(DAY,(0-WEEKDAY(curdate())),curdate()) AND"
                        . " date_format(UsuarioOrden.fecha_cumple,'%Y%m%d')<=TIMESTAMPADD(DAY,(6-WEEKDAY(curdate())),curdate()))"
                    );
            $usus=$this->paginate('UsuarioOrden',$this->cons);
            
             $this->conm = array(
                        'OrdenServicio.id_empresa'=>$emp,
                        'UsuarioOrden.id_usuario'=>$id,
                "date_format(UsuarioOrden.fecha_asigna,'%m')=date_format(curdate(),'%m') or date_format(UsuarioOrden.fecha_cumple,'%m')=date_format(curdate(),'%m')"
                    );
            $usum=$this->paginate('UsuarioOrden',$this->conm);
            
            if(empty($this->data)){
            $this->data= $this->Usuario->read(null,$id);
            }else
                if(!empty($this->data)){
            $this->data['Usuario']['id_empresa']=$emp;
                if($this->Usuario->save($this->data)){
                    $this->set("Exito","Empleado Actualizado");
                  // $this->render('usuarioedit');
                    
                }
                else {
                    $this->set("Error","Empleado no se Actualizó");
                }
            }
           // pr($this->data);
             $this->set('id',$id);
              $this->set('ordenes',$usu);
               $this->set('ordenesm',$usum);
               $this->set('ordeness',$usus);
        }
        
        function usuarioedit(){
            $emp = $this->Session->read('id_empresa');
            
            $this->data['Usuario']['id_empresa']=$emp;
                if($this->Usuario->save($this->data)){
                    $this->set("Exito","Empleado Actualizado");
                  // $this->render('usuarioedit');
                    
                }
                else {
                    $this->set("Error","Empleado no se Actualizó");
                }

        }
        
        function clavereset($id){
            $this->data['Usuario']['id_usuario']= $id;
            $this->data['Usuario']['clave']= md5('1234');
                if($this->Usuario->save($this->data)){
                    $this->set("Exito","Clave Reseteada");
                  // $this->render('usuarioedit');
                    
                }
                else {
                    $this->set("Error","Empleado no se Actualizó la clave");
                }

        }
}
