<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.php";
$datos_registro = new registro();

$idcategoria = isset($_POST["idcat"])?$_POST["idcat"]:0;
$idcat_activo = isset($_POST["value"])?$_POST["value"]:0;

$listado_subcategoria = $datos_registro->listar_registro_relacionxtipo($idcategoria, 2);
?>
<option value="">-Seleccione una opcion-</option>
<?php
if($idcategoria > 0)
{
	if(count($listado_subcategoria) > 0)
	{
		foreach($listado_subcategoria as $item)
		{	
			$item_id = isset($item["id"])?$item["id"]:0;
			$item_nombre = isset($item["nombre"])?$item["nombre"]:'';
			?>
			<option value="<?php echo $item_id; ?>" <?php echo ($idcat_activo==$item_id)?'selected':''; ?>><?php echo $item_nombre; ?></option>
			<?php
		}
	}
}
?>