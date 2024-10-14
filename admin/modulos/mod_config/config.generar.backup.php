<?php
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.producto.estado.php";

$datos_estado_producto = new producto_estado();



$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.generar.backup.script.php";
$url_form_nuevo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_form_eliminar_imagen_seo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen_seo";


$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$url_generar = "generar_backup('$url_form_nuevo');";
$array_listado=array();
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Listado backups sistema</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons("", $get_action, "", "", "", $url_generar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
	<?php ##################################################### ?>
		<div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Listado backups
    </div>
    <div class="panel-body">
	  <?php
	
	$cache_file = URL_ROOT_ADMIN."cache/".md5(URL_WEB_ADMIN."cache_backup_system_list").".php"; 
	$cache_var = '';
	if(!file_exists($cache_file))
	{		
	
	  $noencontrado='<h4 align="center">No se han encontrado registros</h4>';	
	  $carpeta=URL_ROOT."/admin/systembk/";
	  $num=1;	
	  if(is_dir($carpeta)){
		if($dir = opendir($carpeta)){
	 
      $cache_var.='<table id="listado_paginacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="30">#</th>
                <th>Nombre</th>                
                <th width= "100px">Peso</th>                
                <th width="250px">Fecha</th>                
            </tr>
        </thead>
        <tbody>';
			while(($archivo = readdir($dir)) !== false){
			if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess')
			{
				$url_archivo = URL_WEB_ADMIN."systembk/".$archivo;
				$size = filesize($carpeta.$archivo);
			
	 $cache_var.='<tr>
                <td width="30">'.$num.'</td>
                <td>';
				
				if($size>SIZE_BACKUP_SYSTEM)
				{
					$cache_var.='<div class="badge bg-success pull-left"><i class="fa fa-check" aria-hidden="true"></i></div>&nbsp;&nbsp;&nbsp;';
				}
				else
				{
					$cache_var.='<div class="badge bg-danger pull-left"><i class="fa fa-check" aria-hidden="true"></i></div>&nbsp;&nbsp;&nbsp;';
				}
				
	  $cache_var.='<a target="_blank" href="'.$url_archivo.'">'.$archivo.'</a>
				
				</td>                
                <td>'.(formatSizeUnits(filesize($carpeta.$archivo))).'</td>                
                <td width="250px">'.(strftime("%A %e de %B del %G %r", filectime($carpeta.$archivo))).'</td>                
            </tr>';
				}
		 $num++; }
          $cache_var.='</tbody>
      </table>';
	  
		}
		else
		{
			echo $noencontrado;
		}		  
	  }
	  else
	  {
		  echo $noencontrado;
	  } 

		file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
		echo $cache_var;

	}
	else
	{
		include $cache_file ;
	}	
	
	?>	
    </div>
 </div>
	<?php ##################################################### ?>
</div>

