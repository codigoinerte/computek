<?php
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.com.pagina.php";
$datos_pagina = new pagina();

$url_guardar = "guardar_pagina();";
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/com.pagina.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";

$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$detalle_pagina = $datos_pagina->detalle_registro($get_id);
if(count($detalle_pagina) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_nombre = "";
	$item_pagina = "";
}
else
{
	$item_nombre = $detalle_pagina[0]["nombre"];
	$item_pagina = $detalle_pagina[0]["pagina"];
}

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Registro Menús Principales</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/$get_modulo/ajax/listado.com.pagina.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
	
  <div class="col-xs-12 col-md-12">
  <div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Detalle
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>">        
		<?php
		
		 layers(1, "Nombre", "nombre", "Ingrese el nombre de la pagina", "", $item_nombre); 
		 layers(1, "Página", "pagina", "Ingrese nombre del archivo ejem. pagina.php", "", $item_pagina); 
		 
		 layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 
 		#layers_action($url_cancelar);
		?>        
		  
      </form>
    </div>
 </div>
 </div> 	 	
<!--SEGUNDO BLOQUE-->
<?php
}
?>
	
 	 
	
</div>

