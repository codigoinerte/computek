<?php
class producto_estado
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function detalle_estado($id)
	{
		$lista="";
		$query="SELECT estado FROM mod_panel_registro_producto_estado WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;			
	}
	public function listado_estado()
	{
		$lista="";
		$query="SELECT id, id as value, estado, estado as nombre FROM mod_panel_registro_producto_estado ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function insertar_estado_producto($estado)
	{
		$query="INSERT INTO mod_panel_registro_producto_estado(estado) VALUES (?)";
		$this->data->updateQuery($query,array("$estado"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_panel_registro_producto_estado";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function actualizar_estado_producto($id, $estado)
	{
		$query="UPDATE mod_panel_registro_producto_estado SET estado='".$estado."' WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function eliminar_estado_producto($id)
	{
		$query="DELETE FROM `mod_panel_registro_marca` WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));								
	}
}
	?>