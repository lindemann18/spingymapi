<?php
class Conectar{

    public static function _con(){

		$version = 0;

		

		if($version == 0){		

			$host="localhost";

			$usuario="root";

			$pass="";

			$nomBase="spingym2";

		}

       $con=new mysqli($host, $usuario, $pass, $nomBase);
		mysqli_query($con,"SET NAMES 'utf8'" );
		if($con->connect_errno)
		{
			print_r($con);
			die("Disculpe los problemas, estamos trabajando en ello.");	
		}
        return $con;
    }
	
}//Conectar
	
?>