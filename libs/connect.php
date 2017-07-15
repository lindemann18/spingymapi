<?php 
	require("rb.php");

	if(!defined("SPECIALCONSTANT")) die("acceso denegado");

	class Conexion
	{
		function _Con()
		{
			$con = R::setup('mysql:host=localhost;dbname=spingym','root', '');
			return $con;
		}

	}//Conexion
	
 ?>