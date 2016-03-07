<?php

class BienvenidosController extends AppController{
      var $name = 'Bienvenidos';
	var $helpers = array('Html','Form','Ajax','Javascript','Paginator'=>array('ajax'=>'Ajax'));
	
	var $uses = array();
        var $layout = 'ajax';
        var $pageTitle=".:Sistema SoloPlancho.:";
	function index(){
         $this->set('title_for_layout',$this->pageTitle);
            $users = $this->Session->read('Autenticado'); 
            if($users){
                
       if($this->Session->read('perfil')=='1'){
           $this->layout = 'admin';
       }else if($this->Session->read('perfil')=='2'){
           $this->layout = 'empresa';
       } else{
            $this->layout = 'empresa';
            //$this->render('consulta');
       }
            }else{
                 $this->redirect(array('controller'=>'entradas','action'=>'index'));
            }
	} 
}
