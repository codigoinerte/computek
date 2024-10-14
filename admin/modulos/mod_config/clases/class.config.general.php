<?php
class config_general
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	
	function detalle_dato_info($idregistro,$tabla,$tipo='')
	{
		$lista="";
		$query="SELECT d.dato, d.tipo_dato, dt.nombre, d.principal
				FROM mod_dato_info d
				LEFT JOIN mod_dato_tipo_info dt ON dt.id = d.tipo_dato
				WHERE d.idregistro = ? AND d.tabla = ?";
		if($tipo!=='')
		{
			$query.=" AND d.tipo_dato = ? ";
		}
		$lista = $this->data->executeQuery($query, array("$idregistro", "$tabla"));
		return $lista;			
	}
	function listado_dato_tipo_info()
	{
		$lista="";
		$query="SELECT id as value, nombre FROM mod_dato_tipo_info ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	function detalle_tipo_info($idtipo)
	{
		$lista="";
		$query="SELECT id, nombre FROM mod_dato_tipo_info WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$idtipo"));
		return $lista;			
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
		
}