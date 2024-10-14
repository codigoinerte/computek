<?php
class definition
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}	
	public function usuario_activo($id)
	{
		$lista="";
		$query="SELECT mep.id, ru.usuario, ru.pass, mep.idempresa, mep.nombres, CONCAT(mep.nombres,' ',mep.apellidos) as nombre_usuario,
				mep.apellidos, mep.fecha_nacimiento, mep.idestado, mep.idtipo_usuario, 
				mep.idestado, mep.correo, ru.id as idusuario, mep.imagen, ut.tipo
				FROM mod_empresa_personal mep
				LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
				LEFT JOIN mod_registro_usuarios_tipo ut ON ut.id = mep.idtipo_usuario
				WHERE ru.id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;				
	}
	public function listar_usuarios()
	{
		$lista="";
		$query="SELECT mep.id, ru.usuario, ru.pass,CONCAT(mep.nombres,' ',mep.apellidos) as nombre_usuario, mep.fecha_nacimiento,
				mep.idestado, rue.estado, ut.tipo, mep.idtipo_usuario, mep.imagen, ru.actividad
				FROM mod_empresa_personal mep 
				LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
				LEFT JOIN mod_registro_usuarios_estado rue ON rue.id = mep.idestado
				LEFT JOIN mod_registro_usuarios_tipo ut ON ut.id = mep.idtipo_usuario ";
		$lista = $this->data->executeQuery($query);
		return $lista;	
		
	}
	public function actualizar_estado_sesion($idusuario, $estado)
	{
		$query="UPDATE mod_registro_usuarios SET actividad='".$estado."' WHERE id = ? ";
		$this->data->updateQuery($query,array("$idusuario"));	
	}
	public function detalle_empresa($id)
	{
		$lista="";
		$query="SELECT id, idtipo, empresa, ruc, idpersonal, titulo_seo, keyword_seo, descripcion_seo, favicon, isotipo, logo
				FROM mod_empresa me
				WHERE id = ? ";
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
	public function mail_pendientes()
	{
		$lista="";
		$query="SELECT count(*) as cant FROM mod_config_correos WHERE atencion = 2 ; ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	
}