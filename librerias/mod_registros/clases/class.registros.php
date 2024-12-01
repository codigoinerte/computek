<?php
#if(!defined("COD_SEG")) die( "Acceso Restringido" );
class registros_home
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar(); 
	}
	public function identificador($alias)
	{
		$lista="";
		$query="SELECT mcp.pagina, ca.id_pagina, ca.id_registro, mar.idtipo, mar.nombre
				FROM mod_com_alias ca
				LEFT JOIN mod_panel_registro mar ON mar.id = ca.id_registro
				LEFT JOIN mod_com_pagina mcp ON mcp.id = ca.id_pagina
				WHERE ca.alias = ? ";
		$lista = $this->data->executeQuery($query, array( "$alias" ));
		return $lista;
	}
	
	public function detalle_registro($id)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, marp.stock, mrm.marca, mre.estado, marp.stock, mrm.marca, mre.estado
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto				
				WHERE mar.id = ? ";
		$lista = $this->data->executeQuery($query, array( "$id" ));
		return $lista;
	}
	
	public function listar_registro_relacionados($idpadre, $idtipo)
	{
		$lista="";
		$query="SELECT mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion, mca.alias
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				WHERE mrr.id1 = ? AND mar.idtipo = ?
				ORDER BY mar.orden ASC, mar.id ASC";
		$lista = $this->data->executeQuery($query, array( "$idpadre","$idtipo" ));
		return $lista;
	}
	public function contar_registro_relacionados($idpadre, $idtipo)
	{
		$lista="";
		$query="SELECT count(*)
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id				
				WHERE mrr.id1 = ? AND mar.idtipo = ?
				ORDER BY mar.orden ASC, mar.id ASC";
		$lista = $this->data->executeQuery($query, array( "$idpadre","$idtipo" ));
		return $lista;
	}
	
	public function listar_registro_relacionados_detalle($idpadre, $idtipo, $id)
	{
		$lista="";
		$query="SELECT mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion,
				mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion, mca.alias,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id	
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idestado=1 AND mrr.id1 = ? AND mar.idtipo = ? AND mar.id <> ?
				ORDER BY mar.orden ASC, mar.id ASC";
		$lista = $this->data->executeQuery($query, array( "$idpadre","$idtipo","$id" ));
		return $lista;
	}
	
	public function listar_registroxtipo($idtipo)
	{
		$lista="";
		$query="SELECT mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				WHERE mar.idtipo = ?";
		$lista = $this->data->executeQuery($query, array( "$idtipo" ));
		return $lista;
	}	
	public function listar_registroxtipoxid($idtipo, $id)
	{
		$lista="";
		$query="SELECT mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				WHERE mar.idtipo = ? AND mar.id = ?";
		$lista = $this->data->executeQuery($query, array( "$idtipo", "$id" ));
		return $lista;
	}
	
	public function detalle_nivel_superior($id)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mca.alias				
				FROM mod_panel_registro mar
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id1 = mar.id
				WHERE mrr.id2 = ?";
		$lista = $this->data->executeQuery($query, array( "$id" ));
		return $lista;
	}
	
	public function listar_categoriasxpagina($idpagina)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion, mca.alias
				FROM mod_panel_registro mar
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				WHERE mca.id_pagina = ? AND  mar.idtipo = ?";
		$lista = $this->data->executeQuery($query, array( "$idpagina", 1 ));
		return $lista;
	}
	public function listar_registros_nuevos($idpadre, $idtipo, $limite=0)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar1.iddestacado=1 AND mar1.imagen<>''
					LIMIT 0,1
				) as imagen_principal, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar1.imagen<>''
					LIMIT 0,1
				) as imagen_destacada
				
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_panel_registro_relacion mrr2 ON mrr2.id2 = mrr.id1
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id	
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mrr2.id1 = ? AND  mar.idtipo = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC ";
		if($limite>0)
		{
			$query.=" LIMIT 0, $limite ; ";			
		}
		
		$lista = $this->data->executeQuery($query, array( "$idpadre", "$idtipo" ));
		return $lista;
	}
	#LISTAR REGISTROS DESTACADOS PAGINA
	public function contar_destacados()
	{
		$lista="";
		$query="SELECT count(*)
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idtipo = ? AND mar.iddestacado = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC ";
		$lista = $this->data->executeQuery($query, array( "3", "1" ));
		return $lista;
	}

	public function listar_destacados($limitInf,$tamPag)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idtipo = ? AND mar.iddestacado = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC 
				LIMIT $limitInf,$tamPag  ;";				
		$lista = $this->data->executeQuery($query, array( "3", "1" ));
		return $lista;
	}

	#LISTAR REGISTROS especiales
	public function contar_especiales($tipo)
	{
		$query_especial = "";
		if($tipo == 1){
			$query_especial = " AND mar.idoficina = 1 ";
		}else if($tipo == 2){
			$query_especial = " AND mar.idgamer = 1 ";
		}else if($tipo == 3){
			$query_especial = " AND mar.idproductividad = 1 ";
		}
		 
		$lista="";
		$query="SELECT count(*)
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idtipo = ? AND mar.idestado=1 $query_especial
				ORDER BY fecha_creacion ASC, mar.orden ASC ";
		$lista = $this->data->executeQuery($query, array("3"));
		return $lista;
	}

	public function listar_especiales($tipo, $limitInf,$tamPag)
	{
		$query_especial = "";
		if($tipo == 1){
			$query_especial = " AND mar.idoficina = 1 ";
		}else if($tipo == 2){
			$query_especial = " AND mar.idgamer = 1 ";
		}else if($tipo == 3){
			$query_especial = " AND mar.idproductividad = 1 ";
		}

		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idtipo = ? AND mar.idestado=1 $query_especial
				ORDER BY fecha_creacion ASC, mar.orden ASC 
				LIMIT $limitInf,$tamPag  ;";				
		$lista = $this->data->executeQuery($query, array("3"));
		return $lista;
	}

	public function listar_registros_destacados($idtipo, $limite=0)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idtipo = ? AND mar.iddestacado = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC ";
		if($limite>0)
		{
			$query.=" LIMIT 0, $limite ; ";			
		}
		
		$lista = $this->data->executeQuery($query, array( "$idtipo", "1" ));
		return $lista;
	}
	
	public function listar_registros_destacadosxpadre($idtipo, $limite=0, $idpadre=0)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idtipo = ? AND mar.iddestacado = ? AND mrr.id1 = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC ";
		if($limite>0)
		{
			$query.=" LIMIT 0, $limite ; ";			
		}
		
		$lista = $this->data->executeQuery($query, array( "$idtipo", "1", "$idpadre" ));
		return $lista;
	}
	
	///////////////////////////////////////////////////////////////////////////
	#PRODUCTOS
	public function contar_registros_productos($idpadre, $idtipo)
	{

		$lista="";
		$query="SELECT count(*)
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				WHERE mrr.id1 = ? AND  mar.idtipo = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC ";		
		
		$lista = $this->data->executeQuery($query, array( "$idpadre", "$idtipo" ));
		return $lista;		
	}
	public function listar_registros_productos($idpadre, $idtipo, $limitInf,$tamPag)
	{

		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4
					LIMIT 0,1
				) as imagen_principal,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_destacada				
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id	
				WHERE mrr.id1 = ? AND  mar.idtipo = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC
				LIMIT $limitInf,$tamPag ; ";		
		$lista = $this->data->executeQuery($query, array( "$idpadre", "$idtipo" ));
		return $lista;		
	}

	#PRODUCTOS BY CATEGORIA
	public function contar_registros_productosByCategory($idpadre, $idtipo)
	{

		$lista="";
		$query="SELECT count(*)
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_panel_registro_relacion mrr2 ON mrr2.id2 = mrr.id1
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id				
				WHERE mrr2.id1 = ? AND  mar.idtipo = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC ";		
		
		$lista = $this->data->executeQuery($query, array( "$idpadre", "$idtipo" ));
		return $lista;		
	}
	public function listar_registros_productosByCategory($idpadre, $idtipo, $limitInf,$tamPag)
	{

		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4
					LIMIT 0,1
				) as imagen_principal,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_destacada				
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_panel_registro_relacion mrr2 ON mrr2.id2 = mrr.id1
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id	
				WHERE mrr2.id1 = ? AND  mar.idtipo = ? AND mar.idestado=1
				ORDER BY fecha_creacion ASC, mar.orden ASC
				LIMIT $limitInf,$tamPag ; ";		
		$lista = $this->data->executeQuery($query, array( "$idpadre", "$idtipo" ));
		return $lista;		
	}
	
	///////////////////////////////////////////////////////////////////////////
	
	public function info_empresa($tabla, $tipo_dato, $idregistro, $principal=0)
	{
		$lista="";
		$query="SELECT da.dato, dai.imagen, dai.icono, dai.nombre
				FROM mod_dato_info da
				LEFT JOIN mod_dato_tipo_info dai ON dai.id = da.tipo_dato
				WHERE da.tabla = ? AND da.tipo_dato = ? AND da.idregistro = ? ";
				if($principal > 0)
				{
					$query.=" AND da.principal = $principal
					LIMIT 0,1 ";
				}
		$lista = $this->data->executeQuery($query, array( "$tabla","$tipo_dato","$idregistro" ));
		return $lista;		
	}
	public function insertar_visita($ip, $idregistro, $currency_converter, $currency_symbol_utf8, $currency_symbol, $currency_code, $timezone, $continent_name, $continent_code, $country_name, $country_code, $city, $region_code, $latitud, $longitud, $fecha, $otros)
	{
		$query="INSERT INTO `mod_estadistica_posicion`( `ip`, `idregistro`,  `currency_converter`, `currency_symbol_utf8`, `currency_symbol`, `currency_code`, `timezone`, `continent_name`, `continent_code`, `country_name`, `country_code`, `city`, `region_code`, `latitud`, `longitud`, `fecha`, `otros`)
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
		$this->data->updateQuery($query,array("$ip", "$idregistro", "$currency_converter", "$currency_symbol_utf8", "$currency_symbol", "$currency_code", "$timezone", "$continent_name", "$continent_code", "$country_name", "$country_code", "$city", "$region_code", "$latitud", "$longitud", "$fecha", "$otros"));
	}
	public function contar_cantidad_login_admin($ip)
	{
		$lista="";
		$query="SELECT count(*) as cantidad FROM mod_registro_usuarios_log WHERE ip = ? ";
		$lista = $this->data->executeQuery($query, array( "$ip" ));
		return $lista;			
	}
	public function eliminar_visitasxip($ip)
	{
		$lista="";
		$query="DELETE FROM `mod_estadistica_posicion` WHERE ip = ? ";
		$this->data->updateQuery($query,array("$ip"));			
	}
	public function get_marcas($limit = 0){
		$lista="";
		$query="SELECT id, marca, imagen 
				FROM mod_panel_registro_marca 
				";
		if($limit > 0){
			$query.=" LIMIT 0, $limit";
		}
		$lista = $this->data->executeQuery($query);
		return $lista;
	}
}
?>