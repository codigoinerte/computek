<?php
class marca
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function detalle_marca($id)
	{
		$lista="";
		$query="SELECT id, marca, imagen FROM mod_panel_registro_marca WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;			
	}
	public function listado_marcas()
	{
		$lista="";
		$query="SELECT id, id as value, marca, marca as nombre FROM mod_panel_registro_marca ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function insertar_marca($marca, $imagen)
	{
		$query="INSERT INTO mod_panel_registro_marca(marca, imagen) VALUES (?,?)";
		$this->data->updateQuery($query,array("$marca", "$imagen"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_panel_registro_marca";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function actualizar_marca($id, $marca, $imagen="")
	{
		$query="UPDATE mod_panel_registro_marca SET marca='".$marca."' ";
		if($imagen!=='')
		{
			$query.=" ,imagen='".$imagen."' ";
		}
		$query.=" WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function actualizar_marca_imagen($id)
	{
		$query="UPDATE mod_panel_registro_marca SET imagen=NULL WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function eliminar_marca($id)
	{
		$query="DELETE FROM `mod_panel_registro_marca` WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));								
	}
}
	?>