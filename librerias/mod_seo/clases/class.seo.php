<?php
#if(!defined("COD_SEG")) die( "Acceso Restringido" );
class seo
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar(); 
	}
	public function detalle_empresa($id)
	{
		$lista="";
		$query="SELECT me.id, me.idtipo, me.empresa, me.ruc, me.idpersonal, me.titulo_seo, me.keyword_seo, me.descripcion_seo, me.favicon, me.isotipo, me.logo,
				CONCAT(mep.nombres,' ',mep.apellidos) as nombre_administrador, mep.correo,
				(
					SELECT d.dato
					FROM mod_dato_info d
					WHERE d.idregistro = me.id AND d.tabla = 'mod_empresa' AND d.tipo_dato =1 AND d.principal=1
					LIMIT 0,1
				) as telefono,
				(
					SELECT d.dato
					FROM mod_dato_info d
					WHERE d.idregistro = me.id AND d.tabla = 'mod_empresa' AND d.tipo_dato =2 AND d.principal=1
					LIMIT 0,1
				) as celular,
				(
					SELECT d.dato
					FROM mod_dato_info d
					WHERE d.idregistro = me.id AND d.tabla = 'mod_empresa' AND d.tipo_dato =4 AND d.principal=1
					LIMIT 0,1
				) as whatsapp,
				(
					SELECT d.dato
					FROM mod_dato_info d
					WHERE d.idregistro = me.id AND d.tabla = 'mod_empresa' AND d.tipo_dato =5 AND d.principal=1
					LIMIT 0,1
				) as direccion				
				FROM mod_empresa me
				LEFT JOIN mod_empresa_personal mep ON mep.id = idpersonal
				WHERE me.id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;		
	}
}
?>