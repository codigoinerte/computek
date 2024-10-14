<?php
#if(!defined("COD_SEG")) die( "Acceso Restringido" );
class contactenos
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar(); 
	}
	public function listar_correo($correo)
	{
		$lista="";
		$query="SELECT count(*) FROM mod_config_correos WHERE correo = ?  ";
		$lista = $this->data->executeQuery($query, array( "$correo" ));
		return $lista;
	}
	public function insertar_correo($tipo_correo, $nombre="", $correo="", $empresa="", $telefono="", $asunto="", $mensaje="")
	{
		$query="INSERT INTO `mod_config_correos`(`tipo_correo`, `nombre`, `correo`, `empresa`, `telefono`, `asunto`, `mensaje`)
				VALUES (?,?,?,?,?,?,?) ";
		$this->data->updateQuery($query,array("$tipo_correo", "$nombre", "$correo", "$empresa", "$telefono", "$asunto", "$mensaje"));		
	}
	public function eliminar_correo($tipo_correo, $correo)
	{
		$query="DELETE FROM `mod_config_correos` WHERE tipo_correo= ? AND correo = ?";
		$this->data->updateQuery($query,array("$tipo_correo", "$correo"));		
	}
	
}