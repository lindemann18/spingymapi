<?php
	session_start();
	include("../../libs/libs.php");
	$conexion   = new ConexionBean(); //Variable de conexión
	$con        = $conexion->_con(); //Variable de conexión
	$Params=(isset($_GET['Params']))?$_GET['Params']:$_POST['Params'];
	$Parametros=json_decode($Params,true);
	$Accion=$Parametros['Accion'];

	//Switch de las funciones
	switch($Accion)
	{
		case 'FormularioClientes':
			$salidaJson = FormularioClientes($Parametros);
			echo json_encode($salidaJson);
		break;

	}
	
	function FormularioClientes($Parametros)	
	{
		$consultar = new Consultar();
		$datos     = $consultar->_ConsultarClientesFormulario();
		return $datos;
	}//FormularioClientes

?>
