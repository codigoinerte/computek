<?php
class config_usuarios
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function detalle_usuario($id)
	{
		$lista="";
		$query="SELECT mep.id, ru.usuario, ru.pass, mep.idempresa, mep.nombres,
				mep.apellidos, mep.fecha_nacimiento, mep.idestado, mep.idtipo_usuario, 
				mep.idestado, mep.correo, ru.id as idusuario, mep.imagen
				FROM mod_empresa_personal mep
				LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
				WHERE mep.id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;		
	}
	
	public function verificar_usuario($usuario)
	{
		$lista="";
		$query="SELECT ru.id, ru.usuario, ru.pass, mep.idempresa, mep.nombres, CONCAT(mep.nombres,' ',mep.apellidos) as nombre_usuario,
				mep.apellidos, mep.fecha_nacimiento, mep.idestado, mep.idtipo_usuario, 
				mep.idestado, mep.correo, ru.id as idusuario
				FROM mod_empresa_personal mep
				LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
				WHERE ru.usuario = ? ";
		$lista = $this->data->executeQuery($query, array("$usuario"));
		return $lista;		
	}
	
	public function listar_permisos($id)
	{
		$query="SELECT GROUP_CONCAT(idmenu) as idmenu FROM mod_registro_usuarios_permisos WHERE idusuario = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;
	}
	public function listar_usuario()
	{
		$lista="";
		$query="SELECT mep.id, ru.usuario, ru.pass,CONCAT(mep.nombres,' ',mep.apellidos) as nombre_usuario, mep.fecha_nacimiento,
				mep.idestado, rue.estado, ut.tipo, mep.idtipo_usuario
				FROM mod_empresa_personal mep
				LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
				LEFT JOIN mod_registro_usuarios_estado rue ON rue.id = mep.idestado
				LEFT JOIN mod_registro_usuarios_tipo ut ON ut.id = mep.idtipo_usuario ";
		$lista = $this->data->executeQuery($query);
		return $lista;	
	}
	public function listar_usuario_estado()
	{
		$lista="";
		$query="SELECT id as value, estado as nombre FROM mod_registro_usuarios_estado ";
		$lista = $this->data->executeQuery($query);
		return $lista;	
	}
	public function listar_tipo_usuario()
	{
		$lista="";
		$query="SELECT id,id as value, tipo , tipo as nombre FROM mod_registro_usuarios_tipo";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function listar_usuarioxpersonal($id)
	{
		$lista="";
		$query="SELECT id FROM mod_registro_usuarios WHERE idpersonal = ?";
		$lista = $this->data->executeQuery($query,array("$id"));
		return $lista;					
	}
	public function insertar_personal($idempresa, $nombres, $apellidos, $fecha_nacimiento, $correo,  $idestado, $idtipo_usuario)
	{
		$query="INSERT INTO mod_empresa_personal ( idempresa, nombres, apellidos, fecha_nacimiento, correo, idestado, idtipo_usuario)
				VALUES (?,?,?,?,?,?,?)";
		$this->data->updateQuery($query,array("$idempresa", "$nombres", "$apellidos", "$fecha_nacimiento", "$correo", "$idestado", "$idtipo_usuario"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_empresa_personal";
		$lista = $this->data->executeQuery($query);
		return $lista;				
	}
	public function insertar_usuario($usuario, $pass, $idpersonal)
	{
		$query="INSERT INTO mod_registro_usuarios(usuario, pass, idpersonal) VALUES (?,?,?) ";
		$this->data->updateQuery($query,array("$usuario", "$pass", "$idpersonal"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_registro_usuarios";
		$lista = $this->data->executeQuery($query);
		return $lista;						
	}
	public function insertar_info_contacto($dato, $tipo, $idregistro, $tabla, $principal)
	{
		$query="INSERT INTO mod_dato_info(dato, tipo_dato, idregistro, tabla, principal)
				VALUES (?,?,?,?,?)";
		$this->data->updateQuery($query,array("$dato", "$tipo", "$idregistro", "$tabla","$principal"));	
	}
	public function insertar_usuario_permiso($idusuario, $idtipo, $idmenu_principal, $idmenu)
	{
		$query="INSERT INTO mod_registro_usuarios_permisos(idusuario, idtipo, idmenu_principal, idmenu)
				VALUES (?,?,?,?)";
		$this->data->updateQuery($query,array("$idusuario", "$idtipo", "$idmenu_principal", "$idmenu"));	
	}
	public function actualizar_personal($id, $nombre, $apellido, $fecha_nacimiento, $correo, $idestado, $idtipo=0)
	{
		$query="UPDATE mod_empresa_personal SET 
						nombres='".$nombre."',
						apellidos='".$apellido."',
						fecha_nacimiento='".$fecha_nacimiento."',
						correo='".$correo."',
						idestado='".$idestado."',
						idtipo_usuario='$idtipo'
						 WHERE id= ? ";		
		$this->data->updateQuery($query,array("$id"));	
	}
	
	public function actualizar_personal_imagen($id, $imagen='')
	{
		$query="UPDATE mod_empresa_personal SET ";
		if($imagen=='')
		{
			$query.=" imagen=null ";
		}
		else
		{
			$query.=" imagen='".$imagen."' ";
		}
		$query.=" WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	
	public function actualizar_usuario($id, $usuario, $pass='')
	{
		$query="UPDATE mod_registro_usuarios SET usuario='".$usuario."' ";
		if($pass!=='')		
		{
			$query.=" ,pass='".$pass."' ";
		}
				
		$query.=" WHERE idpersonal= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function actualizar_only_password($id, $pass)
	{
		$query="UPDATE mod_registro_usuarios SET pass='".$pass."' WHERE idpersonal= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	
	public function eliminar_permisos($id)
	{
		$query="DELETE FROM mod_registro_usuarios_permisos WHERE idusuario = ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function eliminar_personal($id)
	{
		$query="DELETE FROM mod_empresa_personal WHERE id = ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function eliminar_usuario($id)
	{
		$query="DELETE FROM mod_registro_usuarios WHERE idpersonal = ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function eliminar_data_info($id, $tabla)
	{
		$query="DELETE FROM mod_dato_info WHERE idregistro = ? AND tabla = ? ";
		$this->data->updateQuery($query,array("$id", "$tabla"));	
	}	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function verificar_recuperacion($usuario, $correo)
	{
		$lista="";
		$query="SELECT ru.id, ru.usuario, ru.pass, mep.idempresa, mep.nombres, CONCAT(mep.nombres,' ',mep.apellidos) as nombre_usuario,
				mep.apellidos, mep.fecha_nacimiento, mep.idestado, mep.idtipo_usuario, 
				mep.idestado, mep.correo, ru.id as idusuario
				FROM mod_empresa_personal mep
				LEFT JOIN mod_registro_usuarios ru ON ru.idpersonal = mep.id
				WHERE ru.usuario = ? AND mep.correo = ? ";
		$lista = $this->data->executeQuery($query, array("$usuario", "$correo"));
		return $lista;			
	}
	public function actualizar_password($id,$password)
	{
		$query="UPDATE mod_registro_usuarios SET pass='".$password."' WHERE id = ? ";
		$this->data->updateQuery($query,array("$id"));
	}
}
