<?php
function crypt_clave($password, $digito = 7)
{  
	#$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';  
	#$salt = sprintf('$9x$%3xd$', $digito);  
	#for($i = 0; $i < 22; $i++)  
	#{  
	# $salt .= $set_salt[mt_rand(0, 63)];  
	#}  
	#return crypt($password, $salt);  
	return $passHash = password_hash($password, PASSWORD_BCRYPT);
}
function ExtractUserIpAddress()
{
    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }
}
function logOut()
{
	session_unset();
	session_destroy();
	session_start();
	session_regenerate_id(true);
}
function url_admin($url_base)
{
	if($url_base!=NULL)
	{
		$_modulo =	$_option =	$_token = 	$_action = 	$_id = 	$_evento = 	$_error = "";		
		$url_base = strtolower($url_base); 
		$array_secciones = explode("&",$url_base);
		foreach($array_secciones as $item)
		{
			
			$sub_array = explode("=",$item);
			if($sub_array[0]=="modulo")
			{
				$_modulo = $sub_array[1];
			}
			else if($sub_array[0]=="option")
			{
				$_option = $sub_array[1];
			}
			else if($sub_array[0]=="token")
			{
				$_token = $sub_array[1];
			}
			else if($sub_array[0]=="action")
			{
				$_action = $sub_array[1];
			}
			else if($sub_array[0]=="id")
			{
				$_id = $sub_array[1];
			}
			else if($sub_array[0]=="evento")
			{
				$_evento = $sub_array[1];
			}
			else if($sub_array[0]=="error")
			{
				$_error = $sub_array[1];
			}
			
		}
		/*
		$_modulo = isset($array["modulo"])?$array["modulo"]:'';
		$_option = isset($array["option"])?$array["option"]:'';
		$_token = isset($array["token"])?$array["token"]:'';
		$_action = isset($array["action"])?$array["action"]:'';
		$_id = isset($array["ID"])?$array["ID"]:'';
		$_evento = isset($array["evento"])?$array["evento"]:'';
		$_error = isset($array["error"])?$array["error"]:'';
		*/
		$url=URL_WEB_ADMIN.(($_modulo!='')?$_modulo:'').(($_option!='')?"/".$_option:'').(($_token!='')?"/".$_token:'').(($_action!='')?"/".$_action:'').(($_id!='')?"/".$_id:'').(($_evento!='')?"/".$_evento:'').(($_error!='')?"/".$_error:'');
		return $url;
	}
	else
	{
		$url= URL_WEB_ADMIN;
		
	}
	return $url;	
}
function resultado_busqueda($termino)
{
	if($termino!=NULL)
	{
		return "Resultados para ".$termino;
	}
	else
	{
		return "Resultados para ";	
	}
}?>