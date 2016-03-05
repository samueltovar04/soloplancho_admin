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
