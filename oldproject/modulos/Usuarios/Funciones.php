<?php
	session_start();
	include("../../libs/libs.php");
	$Params 	= $_POST['Params'];
	$Parametros = json_decode($Params,true);
	$Accion 	= $Parametros['Accion'];
	$conexion   = new ConexionBean(); //Variable de conexión
	$con        = $conexion->_con(); //Variable de conexión

	//Switch de las funciones
	switch($Accion)
	{

		case 'LoginUsuario':
			$salidaJson = LoginUsuario($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ValidaDatos':
			$salidaJson = ValidaDatos($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarUsuarios':
			$salidaJson = BuscarUsuarios($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarInfoClientePorId':
			$salidaJson = BuscarInfoClientePorId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarUsuario':
			$salidaJson = EditarUsuario($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarUsuario':
			$salidaJson = EliminarUsuario($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarUsuario':
			$salidaJson = AgregarUsuario($Parametros);
			echo json_encode($salidaJson);
		break;	

	}
	
	
	function LoginUsuario($Parametros)
	{
		$consultar = new Consultar();
		$user      = $Parametros['usuario'];
		$password  = $Parametros['password'];
		$userLogin = $consultar->_LoginUsuario($user,$password);
		$existe    = 0;
		if($userLogin=="")
		{
			//Aquí no existe el usuario
		}
		else
		{
			$existe = 1;
			$_SESSION['usuario'] = $userLogin;
		}
		$datos = array("existe"=>$existe,"user"=>$userLogin);
		return $datos;
	}//LoginUsuario

	function ValidaDatos($Parametros)
	{
		// Tomando los datos
		$nombre       = $_SESSION['usuario']['nb_nombre'];
		$nb_apellidos = $_SESSION['usuario']['nb_apellidos'];
		$permisos     = $_SESSION['usuario']['Permisos'];
		$nb_completo  = $nombre." ".$nb_apellidos;
		$datos = array("nombre"=>$nb_completo,"permisos"=>$permisos);
		return $datos;
	}//ValidaDatos

	function BuscarUsuarios($Parametros)
	{
		$consultar = new Consultar();
		$usuarios  = $consultar->_ConsultarUsuarios();
		$existe    = 0;
		$cantidad  = count($usuarios);
		//Verificando si devolvió datos
		if($usuarios!="" && $cantidad>0)
		{
			$existe = 1;
		}
		$datos     = array("usuarios"=>$usuarios,"existe"=>$existe);
		return $datos;
	}//BuscarUsuarios

	function BuscarInfoClientePorId($Parametros)
	{
		$id_usuario = $Parametros['id'];
		//buscando al usuario
		$consultar = new Consultar();
		$usuario    = $consultar->_ConsultarUsuarioPorId($id_usuario);
		$cantidad   = count($usuario);
		$existe     = 0;
		if($cantidad>0)
		{
			$existe = 1;
		}
		$datos = array("usuario"=>$usuario,"existe"=>$existe);
		return $datos;
	}//BuscarInfoClientePorId

	function EditarUsuario($Parametros)
	{
		//tomando el id del usuario y buscando al usuario para editar.
		$id = $Parametros['id'];
		$usuario = R::load("sgusuarios",$id);
		//Editando los valores
		$usuario->nb_usuario       = $Parametros['nb_usuario'];
		$usuario->pw_password      = $Parametros['pw_password'];
		$usuario->nb_nombre		   = $Parametros['nb_nombre'];
		$usuario->nb_apellidos 	   = $Parametros['nb_apellidos'];
		$usuario->de_genero		   = $Parametros['de_genero'];
		$usuario->num_edad		   = $Parametros['num_edad'];
		$usuario->de_email 		   = $Parametros['de_email'];
		$usuario->num_telefono     = $Parametros['num_telefono'];
		$usuario->num_celular      = $Parametros['num_celular'];
		$usuario->de_colonia       = $Parametros['de_colonia'];
		$usuario->de_domicilio     = $Parametros['de_domicilio'];
		$usuario->num_codigoPostal = $Parametros['num_codigoPostal'];
		$usuario->Permisos         = $Parametros['Permisos'];

		//Haciendo el try catch del update.
		R::begin();
			    try{
			       $respuesta = R::store($usuario);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $respuesta =  R::rollback();
			    }
			R::close();
		
		$datos = array("respuesta"=>$respuesta);
		return $datos;
	}//EditarUsuario

	function EliminarUsuario($Parametros)
	{
		$id = $Parametros['id'];
		$usuario = R::load("sgusuarios",$id);
		$usuario->sn_activo = 0;
		//Haciendo el try catch del update.
		R::begin();
			    try{
			       $respuesta = R::store($usuario);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $respuesta =  R::rollback();
			    }
			R::close();
		//Buscando los usuarios que quedan
		$consultar = new Consultar();
		$usuarios  = $consultar->_ConsultarUsuarios();
		$existe    = 0;
		$cantidad  = count($usuarios);
		//Verificando si devolvió datos
		if($usuarios!="" && $cantidad>0)
		{
			$existe = 1;
		}
		$datos     = array("usuarios"=>$usuarios,"existe"=>$existe,"respuesta"=>$respuesta);
		return $datos;
	}//EliminarUsuario

	function AgregarUsuario($Parametros)
	{
		//Crear un objeto de la tabla
		R::freeze(1);
		$usuario  = R::dispense("sgusuarios");
		$agregado = 0;
		//Editando los valores
		$usuario->nb_usuario       = $Parametros['nb_usuario'];
		$usuario->pw_password      = $Parametros['pw_password'];
		$usuario->nb_nombre		   = $Parametros['nb_nombre'];
		$usuario->nb_apellidos 	   = $Parametros['nb_apellidos'];
		$usuario->de_genero		   = $Parametros['de_genero'];
		$usuario->num_edad		   = $Parametros['num_edad'];
		$usuario->de_email 		   = $Parametros['de_email'];
		$usuario->num_telefono     = $Parametros['num_telefono'];
		$usuario->num_celular      = $Parametros['num_celular'];
		$usuario->de_colonia       = $Parametros['de_colonia'];
		$usuario->de_domicilio     = $Parametros['de_domicilio'];
		$usuario->num_codigopostal = $Parametros['num_codigoPostal'];
		$usuario->permisos         = $Parametros['Permisos'];
		$usuario->sn_activo        = 1;
		R::begin();
		    try{
		       $id = R::store($usuario);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $id =  R::rollback();
		       print_r($e);
		    }
		R::close();
		if(is_numeric($id))
		{
			$agregado = 1;
		}
		$datos = array("agregado"=>$agregado);
		return $datos;
	}//AgregarUsuario
	
?>