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
	}

 ?>