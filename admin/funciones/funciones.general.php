<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function url_amigable($url)
{
	if(URL_AMIGABLE == "true")
	{
		/*http://erpdemo.soltronica.info/erp/index.php?modulo=mod_erp&option=registrar.cliente&token=dQTpPbVZzWlcxbGJuUnZkT2pRek9uRmhhq&action=new*/
		$url = $url . "&";
		
		preg_match("/#(.*?)&/i", $url, $michix );
		$michi = isset($michix[1]) ? $michix[1] : '';	
		$url = str_replace("#$michi", "", $url);
		
		preg_match("/modulo=(.*?)&/i", $url, $modulox );
		$modulo = isset($modulox[1]) ? $modulox[1] : '';
		preg_match("/option=(.*?)&/i", $url, $optionx );
		$option = isset($optionx[1]) ? $optionx[1] : '';
		preg_match("/token=(.*?)&/i", $url, $tokenx );
		"token=".$token = isset($tokenx[1]) ? $tokenx[1] : '';
		preg_match("/action=(.*?)&/i", $url, $actionx );
		$action = isset($actionx[1]) ? $actionx[1] : '';
		preg_match("/ID=(.*?)&/i", $url, $IDx );
		$ID = isset($IDx[1]) ? $IDx[1] : '';
		preg_match("/evento=(.*?)&/i", $url, $eventox );
		$evento = isset($eventox[1]) ? $eventox[1] : '';
		preg_match("/error=(.*?)&/i", $url, $errorx );
		$error = isset($errorx[1]) ? $errorx[1] : '';
		preg_match("/ide=(.*?)&/i", $url, $idex );
		$ide =isset($idex[1]) ? $idex[1] : '';
		
		#return "modulo = $modulo  option=$option  token=$token  action=$action  ID=$ID  evento=$evento  error=$error  IDE=$ide ";
		#exit();
		$archivo_alias = "";#'admin';
		
		if($modulo != '' && $option != '' && $token != '' && $action != '' && $ID != '' && $evento != '' && $error != '' && $ide != '')
		{
			$new_url = URL_WEB_ADMIN."$modulo/$option/$token/$action/$ID/$evento/$error/$ide";
			
		}
		else if($modulo != '' && $option != '' && $token != '' && ($action != '' or $ID != '' or $evento != '' or $error != '') && $ide == '')
		{
			if($ID == '')
			{
				if($action != '')
				{
					$new_url = URL_WEB_ADMIN."$modulo/$option/$token/$action";
					
				}
				else
				{
					$new_url = URL_WEB_ADMIN."$modulo/$option/$token/lista/0/$evento";
				}
			}	
			else if($ID != '' && $evento == '')
			{
				$new_url = URL_WEB_ADMIN."$modulo/$option/$token/$action/$ID";
			}			
			else if($evento != '' && $error == '')
			{
				$new_url = URL_WEB_ADMIN."$modulo/$option/$token/$action/$ID/$evento";
			}
			else
			{
				$new_url = URL_WEB_ADMIN."$modulo/$option/$token/$action/$ID/$evento/$error";
			}
		}	
		else if($modulo != '' && $option != '' && $token != '' && $action == '' && $ID == '' && $evento == '' && $error == '' && $ide == '')
		{
			$new_url = URL_WEB_ADMIN."$modulo/$option/$token";
		}			
		else
		{
			$new_url = URL_WEB_ADMIN."$token";
		}			

		if($michi != '') {	$new_url = $new_url . "#". $michi;}
			
		//$new_url = http://erpdemo.soltronica.info/erp/panel/mod_erp/registrar.cliente/dQTpPbVZzWlcxbGJuUnZkT2pRek9uRmhhq/new/ ID/idc/idd/ide
	}
	else
	{
		$new_url = $url	;
	}	
	return $new_url;
}
function enviar_correo_web($remitente_sis, $correo_respuesta, $nombre_usuario_para, $correo_para, $correo_asunto, $body, $logo_empresa)
{
		$cid = "logo";
		$mail = new PHPMailer();
	
		$mail->IsHTML(true); // Envio tipo HTML
		$mail->IsSMTP(); // telling the class to use SMTP
		#$mail->Debugoutput = 'html';
		#$mail->SMTPDebug = 2;
		$mail->Host = SMTP_HOST;
		$mail->Port = SMTP_PORT;
		$mail->SMTPSecure = SMTP_SECURE;
		$mail->SMTPAuth = SMTP_AUTH;
		$mail->Username = SMTP_USERNAME;
		$mail->Password = SMTP_PASSWORD;
	
		
		//$mail->Priority = 1; // ******** PRIORIDAD *******
		#$mail->Host = "localhost"; #<!-----
		$mail->From = $correo_respuesta;  // CORREO DE USUARIO
		$mail->FromName = $remitente_sis;  // USUARIO
		$mail->Subject = $correo_asunto;
		$mail->AddAddress($correo_para,$nombre_usuario_para); 
		//$mail->AddAddress("destino1@correo.com","Nombre 01");
		//$mail->AddCC("usuariocopia@correo.com");
		//$mail->AddBCC(CORREO_VENTAS);  // CORREO DEL SUPER ADMINISTRADOR
		//$mail->Body = $body;
		$mail->Body = $body;
		$mail->AddEmbeddedImage($logo_empresa, $cid, $cid, 'base64', 'image/png');			
		return $result = $mail->Send();
		
}
function get_random_string($length = 6){
    $cons = array('b','c','d','f','g','h','j','k','l',  
                  'm','n','p','r','s','t','v','w','x','y','z');
    $voca = array('a','e','i','o','u');
    
    srand((double)microtime()*1000000);
    
    $max = $length/2;
    $password = '';
    for($i=1;$i<=$max;$i++){
        $password .= $cons[rand(0,count($cons)-1)];
        $password .= $voca[rand(0,count($voca)-1)];
    }
 
    if(($length % 2) == 1) $password .= $cons[rand(0,count($cons)-1)];
 
    return $password;
}
?>