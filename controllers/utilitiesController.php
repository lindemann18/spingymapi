<?php 
	class utilitiesController
	{
		function validateLoginInfo($data)
		{
			if(array_key_exists("HTTP_USER",$data) && array_key_exists("HTTP_PASS",$data))
				{
					$user   = $data['HTTP_USER'][0];
					$pass   = $data['HTTP_PASS'][0];
					$usersC = new UsersController();
					$dataResponse = $usersC->LoginUsuario($user,$pass);
				}else{
					$dataResponse = array("error"=>true,"message"=>"no login information","data"=>"none");
				}
			return $dataResponse;
		}
	}

 ?>