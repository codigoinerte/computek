<?php
class pagina
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	
	function detalle_registro($id)
	{
		$lista="";
		$query="SELECT id, nombre, pagina FROM mod_com_pagina WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;		
	}
	function listar_paginas()
	{
		$lista="";
		$query="SELECT id, nombre, pagina, id as value FROM mod_com_pagina";
		$lista = $this->data->executeQuery($query);
		return $lista;
	}
	function listar_paginas_select()
	{
		$lista="";
		$query="SELECT cp.id, cp.nombre, cp.pagina, cp.id as value
				FROM mod_com_pagina cp
				WHERE
				(
					SELECT count(*)
					FROM mod_com_alias ma
					WHERE ma.id_pagina = cp.id
				) = 0";
		$lista = $this->data->executeQuery($query);
		return $lista;
	}
	function insertar_pagina($nombre, $pagina)
	{
		$query="INSERT INTO mod_com_pagina(nombre, pagina) VALUES (?,?)";
		$this->data->updateQuery($query,array("$nombre", "$pagina"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_com_pagina";
		$lista = $this->data->executeQuery($query);
		return $lista;	
	}
	function actualizar_pagina($id, $nombre, $pagina)
	{
		$query="UPDATE mod_com_pagina SET
				nombre='".$nombre."',
				pagina='".$pagina."'
				WHERE id= $id ";
		$this->data->updateQuery($query,array("$id"));			
	}
	function eliminar_pagina($id)
	{
		$query="DELETE FROM `mod_com_pagina` WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));		
	}
	
}