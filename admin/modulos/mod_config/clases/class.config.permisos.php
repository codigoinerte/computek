<?php
class config_permisos
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	
	public function detalle_permisos($id)
	{
		$lista="";
		$query="SELECT id, tipo FROM mod_registro_usuarios_tipo WHERE id = ?";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;			
	}
	public function listado_permisos()
	{
		$lista="";
		$query="SELECT id, tipo FROM mod_registro_usuarios_tipo ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function listado_permisosxid($idtipo, $idmenu)
	{
		$lista="";
		$query="SELECT GROUP_CONCAT(idmenu) as idmenu 
				FROM mod_registro_usuarios_permisos
				WHERE idtipo = ? AND idmenu_principal = ? ";
		$lista = $this->data->executeQuery($query, array("$idtipo", "$idmenu"));
		return $lista;	
	}
	public function insertar_permiso($tipo)
	{
		$query="INSERT INTO mod_registro_usuarios_tipo(tipo) VALUES (?)";
		$this->data->updateQuery($query,array("$tipo"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_registro_usuarios_tipo";
		$lista = $this->data->executeQuery($query);
		return $lista;						
	}
	public function insertar_relacion_permisos($idtipo, $idmenu_principal, $idmenu)
	{
		$query="INSERT INTO mod_registro_usuarios_permisos ( idtipo, idmenu_principal, idmenu) VALUES (?,?,?)";
		$this->data->updateQuery($query,array("$idtipo", "$idmenu_principal", "$idmenu"));		
	}
	public function actualizar_permiso($id, $tipo)
	{
		$query="UPDATE mod_registro_usuarios_tipo SET tipo='".$tipo."' WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));		
	}
	public function eliminar_permiso($id)
	{
		$query="DELETE FROM mod_registro_usuarios_tipo WHERE id = ?";
	}
	public function eliminar_relacion_permisos($idtipo, $idmenu)
	{
		$query="DELETE FROM mod_registro_usuarios_permisos WHERE idtipo = ? AND idmenu_principal = ? ";
		$this->data->updateQuery($query,array("$idtipo","$idmenu"));
	}
	
		
}