<?php
$cache_file = URL_ROOT_ADMIN."cache/".md5(URL_WEB."constantes_sistema_administracion").".php"; 
$cache_var = '';
if(!file_exists($cache_file))
{	
	$datos_definition = new definition();
	$listado_constantes = $datos_definition->listado_constantes(1);
	$cache_var .= "<?php ";
	if(count($listado_constantes) > 0)
	{
		foreach($listado_constantes as $item)
		{
			$_item_constante = isset($item["constante"])?$item["constante"]:'';
			$_item_valor = isset($item["valor"])?$item["valor"]:'';

			if($_item_constante!=='')
			{
				$cache_var .= 'define("'.$_item_constante.'","'.$_item_valor.'");';				
			}

		}
	}
	$cache_var .= "?>";
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;	
}
else
{
	include $cache_file;
}
?>