<?php 
	
	class UsersController
	{
		function LoginUsuario($user,$pass)
		{
			$uModel = new usersModel();
			$response   = $uModel->_LoginUsuario($user,$pass);

			//Checking if there is users
			if($response["data"]==null)
			{
				$response["data"]    = "None";
				$response['error']   = true;
				$response['message'] = "Wrong User Or Password";
			}

			return $response;
		}

		function GetUsers()
		{
			$uModel = new usersModel();
			$response = $uModel->_ConsultarUsuarios();
			return $response;
		}

		function getUsersFiltered()
		{
			$uModel = new usersModel();
			$response = $uModel->_ConsultarUsuariosFiltros();
			return $response;
		}

		function getUserById($id)
		{
			$uModel = new usersModel();
			$response = $uModel->_ConsultarUsuarioPorId($id);
			if($response["data"]==null)
			{
				$response["error"] = true;
				$response["message"] = "the user does not exist";
			}
			return $response;
		}
	}
	
 ?>