<?php
class config_constantes
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function detalle_constantes($id)
	{
		$lista="";
		$query="SELECT `id`, `nombre`, `comentarios`, `constante`, `valor` FROM `mod_config_constantes` WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;			
	}
	public function listado_constantes()
	{
		$lista="";
		$query="SELECT `id`, `nombre`, `comentarios`, `constante`, `valor` FROM `mod_config_constantes` ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	
	public function insertar_constante($nombre, $comentarios, $constante, $valor)
	{
		$query="INSERT INTO `mod_config_constantes`(`nombre`, `comentarios`, `constante`, `valor`) VALUES (?,?,?,?)";
		$this->data->updateQuery($query,array("$nombre", "$comentarios", "$constante", "$valor"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_config_constantes";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function actualizar_constante($id, $nombre, $comentarios, $constante, $valor)
	{
		$query="UPDATE  mod_config_constantes SET
						nombre='".$nombre."',
						comentarios='".$comentarios."',
						constante='".$constante."',
						valor='".$valor."'
						WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
}
	?>