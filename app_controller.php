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
            $res='';
            $m = new cMailer();
            for($i=0;$i<count($log);$i++){
            $m->AddAddress($log[$i]);
            $com="echo '$descripcion' | mail -s '$asunto' ".$log[$i];
            //system($com);
            mail($log[$i], $asunto, $descripcion, $header);
            }
            $m->AddAddress("soloplancho@gmail.com");

            $m->AddSender("soloplancho@gmail.com");
            $m->AddSubject("$asunto");

            $m->AddMessage("$descripcion");

            $re=$m->AddHost("localhost",25);
            if($res)
            {
            $m->Send();
	if($m)
            echo " Datos Enviados correctamente";
	else
            echo "no se envio $m";
        }
       /* else
        {
            $this->set('usuario',$log[0]);
          $this->render();
        }*/
        }
        
        function mail_attachment($filename, $path, $mailto, $message, $asunto) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: SÓLO PLANCHO <soloplancho@gmail.com>\r\n";
    $header .= "Reply-To: soloplancho@gmail.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($mailto, $asunto, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}
}
