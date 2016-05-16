<?php


define("LIBR", "\r\n"); // use a "\n" if you have problems

class attach_mailer {
	
	var $from_name;
	var $from_mail;
	var $mail_to;
	var $mail_cc;
	var $mail_bcc;
	
	var $mail_headers;
	var $mail_subject;
	var $mail_body = "";
	
	var $valid_mail_adresses; // boolean is true if all mail(to) adresses are valid
	var $uid; // the unique value for the mail boundry
	var $mail_priority = 3; // 3 = normal, 2 = high, 4 = low
	
	var $att_files = array();
	var $msg = array();
	
	// functions inside this constructor
	// - validation of e-mail adresses
	// - setting mail variables
	// - setting boolean $valid_mail_adresses
	function attach_mailer($name = "", $from, $to, $cc = "", $bcc = "", $subject = "", $body = "") {
		$this->valid_mail_adresses = true;
		if (!$this->check_mail_address($to)) {
			$this->msg[] = "Error, the \"mailto\" address is empty or not valid.";
			$this->valid_mail_adresses = false;
		} 
		if (!$this->check_mail_address($from)) {
			$this->msg[] = "Error, the \"from\" address is empty or not valid.";
			$this->valid_mail_adresses = false;
		} 
		if ($cc != "") {
			if (!$this->check_mail_address($cc)) {
				$this->msg[] = "Error, the \"Cc\" address is not valid.";
				$this->valid_mail_adresses = false;
			} 
		}
		if ($bcc != "") {
			if (!$this->check_mail_address($bcc)) {
				$this->msg[] = "Error, the \"Bcc\" address is not valid.";
				$this->valid_mail_adresses = false;
			} 
		}
		if ($this->valid_mail_adresses) {
			$this->from_name = $this->strip_line_breaks($name);
			$this->from_mail = $this->strip_line_breaks($from);
			$this->mail_to = $this->strip_line_breaks($to);
			$this->mail_cc = $this->strip_line_breaks($cc);
			$this->mail_bcc = $this->strip_line_breaks($bcc);
			$this->mail_subject = $this->strip_line_breaks($subject);
			$this->create_mime_boundry();
			$this->mail_body = $this->create_msg_body($body);
			$this->mail_headers = $this->create_mail_headers();
		} else {
			return;
		}		
	}
	function get_msg_str() {
		$messages = "";
		foreach($this->msg as $val) {
			$messages .= $val."<br>\n";
		}
		return $messages;			
	}
	// use this to prent formmail spamming
	function strip_line_breaks($val) {
		$val = preg_replace("/([\r\n])/", "", $val);
		return $val;
	}
	function check_mail_address($mail_address) {
		$pattern = "/^[\w-]+(\.[\w-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4})$/i";
		if (preg_match($pattern, $mail_address)) {
			if (function_exists("checkdnsrr")) {
				$parts = explode("@", $mail_address);
				if (checkdnsrr($parts[1], "MX")){
					return true;
				} else {
					return false;
				}
			} else {
				// on windows hosts is only a limited e-mail address validation possible
				return true;
			}
		} else {
			return false;
		}
	}
	function create_mime_boundry() {
		$this->uid = "_".md5(uniqid(time()));
	}
	function get_file_data($filepath) {
		if (file_exists($filepath)) {
			if (!$str = file_get_contents($filepath)) {
				$this->msg[] = "Error while opening attachment \"".basename($filepath)."\"";
			} else {
				return $str;
			}
		} else {
			$this->msg[] = "Error, the file \"".basename($filepath)."\" does not exist.";
			return;
		}
	}
	// remember "LIBR" is the line break defined in constact above
	function create_msg_body($mail_msg, $cont_tranf_enc = "7bit", $type = "text/plain", $enc = "iso-8859-1") {
		$str = "--".$this->uid.LIBR;
		$str .= "Content-type:".$type."; charset=".$enc.LIBR;
		$str .= "Content-Transfer-Encoding: ".$cont_tranf_enc.LIBR.LIBR;
		$str .= trim($mail_msg).LIBR.LIBR;
		return $str;
	}
	function create_mail_headers() {
		if ($this->from_name != "") {
			$headers = "From: ".$this->from_name." <".$this->from_mail.">".LIBR;
			$headers .= "Reply-To: ".$this->from_name." <".$this->from_mail.">".LIBR;
		} else {
			$headers = "From: ".$this->from_mail.LIBR;
			$headers .= "Reply-To: ".$this->from_mail.LIBR;
		}
		if ($this->mail_cc != "") $headers .= "Cc: ".$this->mail_cc.LIBR;
		if ($this->mail_bcc != "") $headers .= "Bcc: ".$this->mail_bcc.LIBR;
		$headers .= "MIME-Version: 1.0".LIBR;
		$headers .= "X-Mailer: Attachment Mailer ver. 1.0".LIBR;
		$headers .= "X-Priority: ".$this->mail_priority.LIBR;
		$headers .= "Content-Type: multipart/mixed;".LIBR.chr(9)." boundary=\"".$this->uid."\"".LIBR.LIBR;
		$headers .= "This is a multi-part message in MIME format.".LIBR.LIBR;
		return $headers;
	}
	// use for $dispo "attachment" or "inline" (f.e. example images inside a html mail
	function create_attachment_part($file, $dispo = "attachment") {
		if (!$this->valid_mail_adresses) return;
		$file_str = $this->get_file_data($file);
		if ($file_str == "") {
			return;
		} else {
			$filename = basename($file);
			$file_type = mime_content_type($file);
			$chunks = chunk_split(base64_encode($file_str));
			$mail_part = "--".$this->uid.LIBR;
			$mail_part .= "Content-type:".$file_type.";".LIBR.chr(9)." name=\"".$filename."\"".LIBR;
			$mail_part .= "Content-Transfer-Encoding: base64".LIBR;
			$mail_part .= "Content-Disposition: ".$dispo.";".chr(9)."filename=\"".$filename."\"".LIBR.LIBR;
			$mail_part .= $chunks;
			$mail_part .= LIBR.LIBR;
			$this->att_files[] = $mail_part;
		}			
	}
	function process_mail() {
		if (!$this->valid_mail_adresses) return;
		$mail_message = $this->mail_body;
		if (count($this->att_files) > 0) {
			foreach ($this->att_files as $val) {
				$mail_message .= $val;
			}
			$mail_message .= "--".$this->uid."--";
		}
		if (mail($this->mail_to, $this->mail_subject, $mail_message, $this->mail_headers)) {
			$this->msg[] = "Your mail is succesfully submitted.";
		} else {
			$this->msg[] = "Error while sending you mail.";
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
    if (mail($mailto, $asunto, $message, $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
  }
}
	
?>