<?php
class EntradasController extends AppController{
      var $name = 'Entradas';
	var $helpers = array('Html','Javascript','Ajax','Cargar');
	
	var $uses = array('Usuario');
        var $layout = 'entrada';
         function beforeRender () { 
            $this->set('title_for_layout', $this->pageTitle);
        }
        function afterFilter() {
            
        }
        function beforeFilter () { 
            
        }
	function index(){
         //debug($this);
            $are=array(0=>strtolower("tovar.samuel@gmail.com"));
        $this->enviar_mensaje($are, "mensaje de prueba", 'RECUPERAR CLAVE');
	} 

	function login(){
  if(!empty($this->data)){
    $reduser=  strtoupper(trim($this->data['entrada']['login']));
    $clave=  md5(trim($this->data['entrada']['clave']));
    $busq=$this->Usuario->find('first',array('fields'=>'email,fullname,cedula,tipo,status,id_usuario,id_empresa','conditions'=>array("UPPER(email)"=>$reduser,'clave'=>$clave)));
    //pr($busq); echo count($busq).$busq['Usuario']['fullname'];
    if(empty($this->data['entrada']['login'])){
          $this->set('Error','Usuario  Requerido.');
    }else
    if(strtoupper($busq['Usuario']['email'])==$reduser){
        
        $this->Session->write('username',$busq['Usuario']['fullname']);
	$this->Session->write('Autenticado',true);
        $this->Session->write('id_usuario',$busq['Usuario']['id_usuario']);
        $this->Session->write('id_empresa',$busq['Usuario']['id_empresa']);
        $this->Session->write('cedula',$busq['Usuario']['cedula']);
	$this->Session->write('perfil',$busq['Usuario']['tipo']);
                        $are=array(0=>strtolower(strtolower(trim($busq['Usuario']['email']))));
                            $mensaje="Usted ha ingresado a sysadmin.soloplancho.com \n<br>, En fecha ".date('d-m-Y h:i:s')
                                    . "<br>Desde su cuenta email: ".strtolower(trim($busq['Usuario']['email']));
                            $this->enviar_mensaje($are, $mensaje, 'INGRESO AL SISTEMA, SOLOPLANCHO');
        $this->redirect('/bienvenidos');

    }else{
        $this->set('Error','Usuario  ó Clave Invalido.');
         $this->Session->setFlash('Usuario ó Clave Invalido.');
    }
  }
           
}
	function cerrar(){
            session_start();
            session_destroy();
            
		$this->Session->destroy('username');
		$this->Session->destroy('perfil');
		$this->Session->destroy('Autenticado');
                $this->Session->destroy('id_usuario');
                $this->Session->destroy('id_empresa');
                $this->Session->destroy('cedula');
                
		$this->Session->delete('cedula');
                $this->Session->delete('perfil');
		$this->Session->delete('username');
		$this->Session->delete('Autenticado');
                 $this->Session->delete('id_usuario');
                  $this->Session->delete('id_empresa');
                  print("<META HTTP-EQUIV=Refresh CONTENT='0; URL=/'>");
            $this->redirect('/');
	}

}


?>
