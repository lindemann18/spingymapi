<?php 
	
	class usersModel
	{
		function _LoginUsuario($user,$pass)
		{
			$query = "SELECT * FROM sgusuarios where nb_usuario=? and pw_password=?";
			$Utilities = new Utilities();
			$response = $Utilities->QueryTwoParametersOneRow($user,$pass,$query);
			return $response;
		}

		function _ConsultarUsuarios()
		{
			$query = "SELECT * FROM sgusuarios  where sn_activo =1 ORDER BY id ASC";
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}
	}

 ?>