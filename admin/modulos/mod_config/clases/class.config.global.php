<?php
class config_global
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	
	function config_listado_imagenes($idtipo)
	{
		$lista="";
		$query="SELECT id, idtipo, alto, ancho, calidad, cuadrado, ratio
				FROM mod_config_imagenes
				WHERE idtipo = ? ";
		$lista = $this->data->executeQuery($query, array("$idtipo"));
		return $lista;			
	}
	function config_insertar_imagenes($idtipo, $alto, $ancho, $calidad, $cuadrado, $ratio)
	{
		$query="INSERT INTO `mod_config_imagenes`( `idtipo`, `alto`, `ancho`, `calidad`, `cuadrado`, `ratio`)
				VALUES (?,?,?,?,?,?)";
		$this->data->updateQuery($query,array("$idtipo", "$alto", "$ancho", "$calidad", "$cuadrado", "$ratio"));			
	}
	function config_actualizar_imagenes($idtipo, $alto, $ancho, $calidad, $cuadrado, $ratio)
	{
		$query="UPDATE mod_config_imagenes SET 
					alto='".$alto."',
					ancho='".$ancho."',
					calidad='".$calidad."',
					cuadrado='".$cuadrado."',
					ratio='".$ratio."'
					WHERE idtipo= ? ";
		$this->data->updateQuery($query,array("$idtipo"));			
	}
}
?>