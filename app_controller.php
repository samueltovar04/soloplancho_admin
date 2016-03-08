<?php
 /**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
 App::import('Vendor', 'correo', false);
class AppController extends Controller {
       var $components = array('Session',
        'DebugKit.Toolbar' => array('panels' => array('history', 'session')));
    var $pageTitle = 'SoloPlancho .:Inicio:.';
    
        function enviar_mensaje($log,$mensaje,$asunto)
        {
            $header = "From: soloplancho@soloplancho.com \n";
            $header .= "Mime-Version: 1.0\nContent-Type: text/html; charset=UTF-8\nContent-Transfer-Encoding: 7bit";
            $descripcion = "Este mensaje fue enviado por SOLOPLANCHO \"Los Número uno en Planchado\",\n";
            $descripcion=utf8_decode($descripcion.$mensaje);
            set_time_limit(0);
            $m = new cMailer();
            for($i=0;$i<count($log);$i++)
            $m->AddAddress($log[$i]);
            $m->AddAddress("soloplancho@gmail.com");

            $m->AddSender("soloplancho@gmail.com");
            $m->AddSubject("$asunto");

            $m->AddMessage("$descripcion");

            $re=$m->AddHost("soloplancho.com",2500);
            if($re)
            {
            $m->Send();
	if($m)
            echo " Datos Enviados correctamente";
	else
            echo "no se envio $m";
        }
        else
        {
            $this->set('usuario',$log[0]);
          $this->render();
        }
        }
}
