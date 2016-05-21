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
        $re='';
        $m = new cMailer();
       for($i=0;$i<count($log);$i++){
            $m->AddAddress($log[$i]);
            $com="echo '$descripcion' | mail -s '$asunto' ".$log[$i];
            //system($com);
            //mail($log[$i], $asunto, $descripcion, $header);
       }
       $m->AddAddress("soloplancho@gmail.com");
       $m->AddSender("soloplancho@gmail.com");
       $m->AddSubject("$asunto");
       $m->AddMessage("$descripcion");
       $re=$m->AddHost("localhost",2500);
       if($re)
    {
        $m->Send();
        if($m)
             $resultados['mensaje_correo']=" Datos Enviados correctamente";
        else
             $resultados['mensaje_correo']="no se envio $m";
     }
     else
        {
              $resultados['mensaje_correo']= "no conecta $m";
        }

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
    $eol = PHP_EOL;
    $header = "From: SOLOPLANCHO <soloplancho@gmail.com>".$eol;
    $header .= "Reply-To: soloplancho@gmail.com$eol";
    $header .= "MIME-Version: 1.0$eol";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";
    //$header .= "This is a multi-part message in MIME format.\r\n";
    $nmessage = "--".$uid.$eol;
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1".$eol;
    $nmessage .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
    $nmessage .= $message.$eol;
    $nmessage .= "--".$uid.$eol;
    $nmessage.= "Content-Type: application/pdf; name=\"".$filename."\"".$eol; // use different content types here
    $nmessage .= "Content-Transfer-Encoding: base64".$eol;
    $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
    $nmessage .= $content.$eol;
    $nmessage .= "--".$uid."--";
    if (mail($mailto, $asunto, $nmessage, $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
  }
 function enviar_curl($url, $post_data)
 {  
     if($curl_connection = curl_init($url))  
     {  
	$post_string = json_encode($post_data); 
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);  
        curl_setopt($curl_connection, CURLOPT_USERAGENT,  
        "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");  
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string); 
	curl_setopt($curl_connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($post_string)));    

     //foreach ( $post_data as $key => $value)  
     //{  
     //  $post_items[] = $key . '=' . $value;  
     //}  
     //$post_string = implode ('&', $post_items);    
 
     $result = curl_exec($curl_connection);  
     //muestra los resultados del proceso  
     //print_r(curl_getinfo($curl_connection));  
     //echo curl_errno($curl_connection)
     curl_close($curl_connection);  
       }  
     else{   
     }  
 }
 
 function token_id()
{
 // add limit
$id_length = 12;

// add any character / digit
$alfa = "abcdefghijklmnopqrstuvwxyz1234567890";
$token = "";
for($i = 1; $i < $id_length; $i ++) {

  // generate randomly within given character/digits
  @$token .= $alfa[rand(1, strlen($alfa))];

}    
return $token;
}
}
