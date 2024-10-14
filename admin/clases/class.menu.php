<?php
class menu
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function listado_menu($idmenu, $idtipo,$idcategoria=0,$idsubcategoria=0, $idusuario=0)
	{
		$query="SELECT mcd.id, mcd.nombre, mcd.idtipo, mcd.idcategoria, mcd.idsubcategoria, mcd.ruta, mcd.orden
				FROM mod_config_menu_detalle mcd
				LEFT JOIN mod_config_menu mcm ON mcm.id = mcd.idmenu
				WHERE mcd.idtipo = ? AND mcd.idmenu = ?";
		if($idcategoria>0)
		{
			$query.=" AND  mcd.idcategoria = '$idcategoria' ";
		}
		if($idsubcategoria>0)
		{
			$query.=" AND mcd.idsubcategoria = '$idsubcategoria' ";
		}
		if($idusuario > 0)
		{
		$query.=" AND
					(
						IF(

							(
								SELECT mep.idtipo_usuario
								FROM mod_empresa_personal mep
								LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
								WHERE ru.id = $idusuario
							) = 0,
							(
								SELECT count(*)
								FROM mod_registro_usuarios_permisos
								WHERE idusuario = $idusuario AND idmenu_principal = 1 AND idmenu = mcd.id
							),
							(
								SELECT count(*)
								FROM mod_registro_usuarios_permisos
								WHERE idmenu_principal = 1 AND idmenu = mcd.id AND
								idtipo = 
								 (
									SELECT mep.idtipo_usuario
									FROM mod_empresa_personal mep
									LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
									WHERE ru.id = $idusuario
								)
							)
						)
						
					) > 0";
		}
			$query.=" ORDER BY orden ASC; ";
		$lista = $this->data->executeQuery($query, array("$idtipo", "$idmenu"));
		return $lista;
	}
	public function listar_detalle_menu($idmenu)
	{
		$lista="";
		$query="SELECT id, nombre, idtipo, idmenu, idcategoria, idsubcategoria, ruta, idestado, orden
				FROM mod_config_menu_detalle
				WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$idmenu"));
		return $lista;		
	}
	public function listar_menu_tipo()
	{
		$lista="";
		$query="SELECT id as value, tipo as nombre FROM mod_config_menu_tipo ";
		$lista = $this->data->executeQuery($query);
		return $lista;		
	}
	public function listar_menu_principal()
	{
		$lista="";
		$query="SELECT id as value, nombre FROM mod_config_menu ORDER BY orden ASC ";
		$lista = $this->data->executeQuery($query);
		return $lista;				
	}
	public function listar_menu_estado()
	{
		$lista="";
		$query="Select id as value, estado as nombre FROM mod_config_estado ORDER BY id DESC";
		$lista = $this->data->executeQuery($query);
		return $lista;						
	}
	public function listar_menu_nivel($idmenu,$tipo=0)
	{
		$lista="";
		$query="Select id as value, nombre as nombre FROM mod_config_menu_detalle
				WHERE idmenu = ? ";
		if($tipo==1)
		{
			$query.=" AND idcategoria = 0 AND idsubcategoria = 0 ";
		}
		else
		{
			$query.=" AND idcategoria > 0 AND idsubcategoria = 0 ";
		}
		$lista = $this->data->executeQuery($query, array("$idmenu"));
		return $lista;		
	}
	public function insertar_menu($nombre, $idtipo, $idmenu, $idcategoria, $idsubcategoria, $ruta, $idestado, $orden)
	{
		$query="INSERT INTO mod_config_menu_detalle(nombre, idtipo, idmenu, idcategoria, idsubcategoria, ruta, idestado, orden)
				VALUES (?,?,?,?,?,?,?,?) ";
		$this->data->updateQuery($query,array("$nombre", "$idtipo", "$idmenu", "$idcategoria", "$idsubcategoria", "$ruta", "$idestado", "$orden"));
		
		$lista="";
		$query="Select MAX(id) as id FROM mod_config_menu_detalle ";
		$lista = $this->data->executeQuery($query);
		return $lista;
	}
	public function actualizar_detalle_menu($id, $nombre, $idtipo, $idmenu, $idcat, $idscat, $ruta, $idestado, $orden)
	{
		$query="UPDATE mod_config_menu_detalle SET
				nombre='".$nombre."',
				idtipo='".$idtipo."',
				idmenu='".$idmenu."',
				idcategoria='".$idcat."',
				idsubcategoria='".$idscat."',
				ruta='".$ruta."',
				idestado='".$idestado."',
				orden='".$orden."'
				WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));		
	}
	public function eliminar_detalle_menu($id)
	{
		$query="DELETE FROM `mod_config_menu_detalle` WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));		
	}
	
}
	
?>