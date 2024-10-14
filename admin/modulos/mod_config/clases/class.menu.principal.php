<?php
class menu_principal
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function listado_menu_principal_detalle($idmenu)
	{
		$lista="";
		$query="SELECT id, nombre, orden, estado, observaciones FROM mod_config_menu WHERE id = ?";
		$lista = $this->data->executeQuery($query, array("$idmenu"));
		return $lista;		
	}
	public function insertar_menu_principal($menu, $orden, $descripcion, $estado)
	{
		$query="INSERT INTO mod_config_menu(nombre, orden, observaciones, estado)
				VALUES (?,?,?,?) ";
		$this->data->updateQuery($query,array("$menu", "$orden", "$descripcion", "$estado"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_config_menu";
		$lista = $this->data->executeQuery($query);
		return $lista;								
	}
	public function actualizar_menu_principal($get_id, $menu, $orden, $descripcion, $estado)
	{
		$query="UPDATE mod_config_menu SET
				nombre='".$menu."',
				orden='".$orden."',
				estado='".$estado."',
				observaciones='".$descripcion."'
				WHERE id= ? ";
		$this->data->updateQuery($query,array("$get_id"));				
	}
	public function eliminar_menu_principal($id)
	{
		$query="DELETE FROM mod_config_menu WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));				
	}
	public function listar_menu_principal()
	{
		$lista="";
		$query="SELECT mcm.id, mcm.nombre, mcm.orden, mce.estado
				FROM mod_config_menu mcm
				LEFT JOIN mod_config_estado mce ON mce.id = mcm.estado";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
}

?>