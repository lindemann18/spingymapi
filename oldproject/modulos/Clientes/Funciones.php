<?php
	session_start();
	include("../../libs/libs.php");
	$Params=(isset($_GET['Params']))?$_GET['Params']:$_POST['Params'];
	
	$Parametros = json_decode($Params,true);
	$conexion   = new ConexionBean(); //Variable de conexión
	$con        = $conexion->_con(); //Variable de conexión
	
	$Accion=$Parametros['Accion'];
	//Switch de las funciones
	switch($Accion)
	{
		case 'Clientes':
			$salidaJson = Clientes($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarCliente':
			$salidaJson = AgregarCliente($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'InfoCliente':
			$salidaJson = InfoCliente($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'Editarcliente':
			$salidaJson = Editarcliente($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarCliente':
			$salidaJson = EliminarCliente($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'FiltrarClientes':
			$salidaJson = FiltrarClientes($Parametros);
			echo json_encode($salidaJson);
		break;
		case 'InfoFormulario':
			$salidaJson = InfoFormulario($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'RegistrarForm':
			$salidaJson = RegistrarForm($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'InfoClienteRutinas':
			$salidaJson = InfoClienteRutinas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ExisteRutinaCliente':
			$salidaJson = ExisteRutinaCliente($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'InfoRutinaCliente':
			//DEvolviendo parámetros para la notificación				
			$salidaJson = InfoRutinaCliente($Parametros);
			echo json_encode($salidaJson);
		break;
		
		case 'AgregarRutina':
			//DEvolviendo parámetros para la notificación				
			$salidaJson = AgregarRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'CambioLugarEjercicio':
			
			$AccionCambio = $Parametros['AccionCambio'];

			switch($AccionCambio)
			{
				case 'SinPadre':
					$salidaJson = CambioLugarEjercicioSinPadre($Parametros);
					echo json_encode($salidaJson);
				break;
				
				case 'SinHijo':
					$salidaJson = CambioLugarEjercicioSinHijo($Parametros);
					echo json_encode($salidaJson);
				break;
				
				case 'ConAmbosBajoPosicion':
					$salidaJson = ConAmbosBajoPosicion($Parametros);
					echo json_encode($salidaJson);
				break;
				
				case 'ConAmbosSubioPosicion':
					$salidaJson = ConAmbosSubioPosicion($Parametros);
					echo json_encode($salidaJson);
				break;
				
			}//switch
		break;

		case 'EjerciciosRutinaOrden':
			//DEvolviendo parámetros para la notificación				
			$salidaJson = EjerciciosRutinaOrden($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarRelacionEjercicio':
			//Mandando los valores a BD ya sea para agregar y o actualizar
			$salidaJson = AgregarRelacionEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarRepeticionesEjercicio':
			$salidaJson = AgregarRepeticionesEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarCircuitosEjercicio':
			$salidaJson = AgregarCircuitosEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'DesactivarRutina':
			$salidaJson = DesactivarRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'RegistrarEjerciciosRutinas':
			$salidaJson = RegistrarEjerciciosRutinas($Parametros);
			echo json_encode($salidaJson);
		break;

		//casos viejos
		
		
		
		case 'AsignarRutinaCliente':
			
			//Mandando los valores a BD ya sea para agregar y o actualizar
			$salidaJson = AsignarRutinaCliente($Parametros);
			echo json_encode($salidaJson);
		break;
		
		case 'ConsultarTiposCuerpo':
			$salidaJson = ConsultarTiposCuerpo();
			echo json_encode($salidaJson);
		break;
		
	}//switch
	
	function Clientes($Parametros)
	{
		$consultar = new Consultar();
		$clientes  = $consultar->_ConsultarClientes();
		$cantidad  = count($clientes);
		$exito     = ($cantidad>0)?1:0;

		//Consultando los entrenadores
		$entrenadores = $consultar->_ConsultarUsuariosFiltros();
		//INcluir la opción de todos.
		$todos = array("id"=>"Todos","nombre"=>"Todos");
		array_push($entrenadores,$todos);
		$cantidaden   = count($entrenadores);
		$exitoent     = ($cantidaden>0)?1:0;
		$datos     = array("exito"=>$exito,"clientes"=>$clientes,
						   "exitoent"=>$exitoent,"entrenadores"=>$entrenadores);
		return $datos;
	}//clientes
	
	function AgregarCliente($Parametros)
	{
		//Creando un objeto del a tabla
		$cliente = R::dispense("sgclientes");
		$consultar = new Consultar();
		//print_r($Parametros);

		//Pegando la fecha
		$fecha = $Parametros['year']."-".$Parametros['mes']."-".$Parametros['dia_nacimiento'];

		//Consultar el id del tipo cuerpo
		$cuerpo = $consultar->_ConsultarCuerposPorNombre($Parametros['id_cuerpo']);

		//Scando el id del usuario que registra
		
		$id_usuario = $_SESSION['usuario']['id'];

		//Asignadno los valores
		$cliente->nb_cliente          = $Parametros['nb_cliente'];
		$cliente->id_usuario_registro = $id_usuario;
		$cliente->id_tipocuerpo 	  = $cuerpo['id'];
		$cliente->nb_apellidos  	  = $Parametros['nb_apellidos'];
		$cliente->de_genero     	  = $Parametros['de_genero'];
		$cliente->fh_nacimiento 	  = $fecha;
		$cliente->num_telefono     	  = $Parametros['num_telefono'];
		$cliente->num_celular     	  = $Parametros['num_celular'];
		$cliente->de_colonia     	  = $Parametros['de_colonia'];
		$cliente->de_domicilio        = $Parametros['de_domicilio'];
		$cliente->num_codigopostal    = $Parametros['num_codigopostal'];
		$cliente->de_email            = $Parametros['de_email'];
		$cliente->sn_activo 	      = 1;
		$respuesta 					  = EjecutarTransaccion($cliente);
		$exito                        = ($respuesta!="Error")?1:0;
		$datos 						  = array("exito"=>$exito);
		return $datos;
	}//AgregarCliente

	function InfoCliente($Parametros)
	{
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		$cliente   = $consultar->_ConsultarclientePorId($id);
		$cantidad  = count($cliente);
		$exito     = ($cantidad>0)?1:0;
		$datos     = array("exito"=>$exito,"cliente"=>$cliente);
		return $datos;
	}//InfoCliente
	
	function Editarcliente($Parametros)
	{
		$id = $Parametros['id'];
		//Pegando la fecha
		$fecha = $Parametros['birth_year']."-".$Parametros['birth_month']."-".$Parametros['birth_day'];
		$cliente = R::load("sgclientes",$id);

		//Consultar el id del tipo cuerpo
		$consultar = new Consultar();
		$cuerpo    = $consultar->_ConsultarCuerposPorNombre($Parametros['nb_cuerpo']);

		//Guardando los valores de los clientes.
		$cliente->nb_cliente       = $Parametros['nb_cliente'];
		$cliente->nb_apellidos     = $Parametros['nb_apellidos'];
		$cliente->de_genero        = $Parametros['de_genero'];
		$cliente->fh_nacimiento    = $fecha;
		$cliente->de_email         = $Parametros['de_email'];
		$cliente->num_telefono     = $Parametros['num_telefono'];
		$cliente->num_celular      = $Parametros['num_celular'];
		$cliente->de_domicilio     = $Parametros['de_domicilio'];
		$cliente->de_colonia       = $Parametros['de_colonia'];
		$cliente->num_codigopostal = $Parametros['num_codigopostal'];
		$cliente->id_tipocuerpo    = $cuerpo['id'];
		$respuesta 				   = EjecutarTransaccion($cliente);
		$exito 					   = ($respuesta!="Error")?1:0;
		$datos 					   = array("exito"=>$exito);
		return $datos;
	}//Editarcliente

	function EliminarCliente($Parametros)
	{
		$id      = $Parametros['id'];
		$cliente = R::load("sgclientes",$id);
		$cliente->sn_activo = 0;
		$respuesta = EjecutarTransaccion($cliente);
		$exito 	   = ($respuesta!="Error")?1:0;

		//Consultando los clientes restantes.
		$consultar = new Consultar();
		$clientes  = $consultar->_ConsultarClientes();
		$cantidad  = count($clientes);
		$exitocli  = ($cantidad>0)?1:0;

		$datos 	   = array("exito"=>$exito,"exitocli"=>$exitocli,"clientes"=>$clientes);
		return $datos;
	}//EliminarCliente

	function FiltrarClientes($Parametros)
	{
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		$clientes  = $consultar->_ConsultarClientesPorEntrenador($id);
		$cantidad  = count($clientes);
		$exito     = ($cantidad>0)?1:0;
		$datos     = array("exito"=>$exito,"clientes"=>$clientes);
		return $datos;
	}//FiltrarClientes

	function InfoFormulario($Parametros)
	{
		$id 	    = $Parametros['id'];
		$consultar  = new Consultar();
		$respuestas = $consultar->_ConsultarInformacionClienteReporteFormulario($id);
		$cantidad   = count($respuestas);
		$exito      = ($cantidad>0)?1:0;
		if($exito==0){$respuestas = array("id"=>$id);}
		$datos      = array("exito"=>$exito,"respuestas"=>$respuestas);
		return $datos;
	}//InfoFormulario

	function RegistrarForm($Parametros)
	{
		$id         = $Parametros['id'];
		$id_usuario = $_SESSION['usuario']['id'];
		// verificando si el cliente ya tiene un registro previo del formulario
		// o es el primer registro del mismo.
		$consultar = new Consultar();
		$resultado = $consultar->_ConsultarSiClienteHizoElFormulario($id);
		$cantidad  = count($resultado);
		if($cantidad>0)
		{
			//si entra aquí es por que ya hizo el formulario y va a editar valores.
			$campos     = R::find('sgformulario','id_cliente=?',[$id]);
			//tomando el id del cliente para cargar el campo correcto del
			// formulario

			$id_form    = $Parametros['id_form'];
			$respuestas = R::load("sgformulario",$id_form);

		}//if
		else
		{
			// si entra aquí es que no existe ningún registro y es la primavera vez
			// que hace el formulario, se procede a registrar.
			$respuestas = R::dispense("sgformulario");
		}//eñse

		
		//Cargando los valores
		$respuestas->condicion_cardiaca 	   = $Parametros['condicion_cardiaca'];
		$respuestas->condicion_pecho    	   = $Parametros['condicion_pecho'];
		$respuestas->condicion_pechoreciente   = $Parametros['condicion_pechoreciente'];
		$respuestas->condicion_balance    	   = $Parametros['condicion_balance'];
		$respuestas->lesion_fisica    	       = $Parametros['lesion_fisica'];
		$respuestas->medicamentos_corazon      = $Parametros['medicamentos_corazon'];
		$respuestas->impedimento_entrenamiento = $Parametros['impedimento_entrenamiento'];
		$respuestas->lecturas_anormales 	   = $Parametros['lecturas_anormales'];
		$respuestas->cirujia_bypass 	       = $Parametros['cirujia_bypass'];
		$respuestas->dificultad_respirar 	   = $Parametros['dificultad_respirar'];
		$respuestas->enfermedades_renales 	   = $Parametros['enfermedades_renales'];
		$respuestas->arritmia 	               = $Parametros['cirujia_bypass'];
		$respuestas->colesterol 	           = $Parametros['colesterol'];
		$respuestas->presion_alta 	           = $Parametros['presion_alta'];
		$respuestas->cantidad_cigarros 	       = $Parametros['cantidad_cigarros'];
		$respuestas->molestias_articulaciones  = $Parametros['molestias_articulaciones'];
		$respuestas->molestias_espalda 	       = $Parametros['molestias_espalda'];
		$respuestas->desayuno_diario 	       = $Parametros['desayuno_diario'];
		$respuestas->comida_diaria 	           = $Parametros['comida_diaria'];
		$respuestas->cena_diaria 	           = $Parametros['cena_diaria'];
		$respuestas->entrecomida_diaria 	   = $Parametros['entrecomida_diaria'];
		$respuestas->frecuencia_entrecomida    = $Parametros['frecuencia_entrecomida'];
		$respuestas->plan_alimenticio 	       = $Parametros['plan_alimenticio'];
		$respuestas->intensidad_ejercicio 	   = $Parametros['intensidad_ejercicio'];
		$respuestas->intensidad_ejercicio2 	   = $Parametros['intensidad_ejercicio2'];
		$respuestas->intensidad_ejercicio3 	   = $Parametros['intensidad_ejercicio3'];
		$respuestas->intensidad_ejercicio4 	   = $Parametros['intensidad_ejercicio4'];
		$respuestas->intensidad_ejercicio5 	   = $Parametros['intensidad_ejercicio5'];
		$respuestas->programa_ejercicio 	   = $Parametros['programa_ejercicio'];
		$respuestas->actividades_indeseables   = $Parametros['actividades_indeseables'];
		$respuestas->deporte_frecuente 	       = $Parametros['deporte_frecuente'];
		$respuestas->minutos_dia 	           = $Parametros['minutos_dia'];
		$respuestas->dias_semana 	           = $Parametros['dias_semana'];
		$respuestas->resultado_ejercicio 	   = $Parametros['resultado_ejercicio'];
		$respuestas->id_instructor 			   = $id_usuario;
		$respuestas->id_cliente 			   = $id;
		$respuestas->actividades_deseables 	   = " ";
		R::freeze(1);
		//$respuesta = R::store($respuestas);
		$respuesta = EjecutarTransaccion($respuestas);
		$exito     = (is_numeric($respuesta))?1:0;
		$datos     = array("exito"=>$exito);
		return $datos;
	}//RegistrarForm

	function InfoClienteRutinas($Parametros)
	{
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		$resultado = $consultar->_ConsultarInformacionClientesRutinaPorIdCliente($id);
		$exito     = ($resultado!="Error")?1:0;
		$datos = array("exito"=>$exito,"resultado"=>$resultado);
		return $datos;
	}//InfoClienteRutinas

	function ExisteRutinaCliente($Parametros)
	{
		$consultar = new Consultar();
		$id 	   = $Parametros['id'];
		$existe    = $consultar->_ConsultarRutinasClientesPorIdCliente($id);
		$cantidad  = count($existe);
		$datos     = array("cantidad"=>$cantidad);
		return $datos;
	}//ExisteRutinaCliente

	function InfoRutinaCliente($Parametros)
	{
		$id         = $Parametros['id'];
		$exito      = 0;
		$ejercicios = "";
		//verificando si el cliente tiene una rutina asignada.
		$datosRut   = R::findOne("sgrutinasclientes","where id_cliente  = ?",[$id]);
		$cantidad_r = count($datosRut);
		if($cantidad_r>0)
		{
			$id_rutina = $datosRut->id;
			$consultar  = new Consultar();
			$ejercicios = $consultar->_ConsultarInformacionRutinaPreFinalClientePorId($id_rutina);
			$cantidad   = count($ejercicios);
			$exito      = ($cantidad>0)?1:0;
		}

		$datos      = array("exito"=>$exito,"ejercicios"=>$ejercicios);
		return $datos;
	}//InfoRutinaCliente

	// Funciones de rutinas clientes

	function CambioLugarEjercicioSinPadre($Parametros)
	{
		$id_Rutina        = $Parametros['id_rutina'];
		$id_Cambio        = $Parametros['id_cambio'];
		$id_Hijo          = $Parametros['id_Hijo'];
		$Cantidad_Puestos = $Parametros['Cantidad_Puestos'];
		$consultar        = new Consultar();
		$agregar          = new Agregar();
		$actualizar       = new Actualizar();
		$id_dia 		  = "";

		//Casos a definir 1) cuando la cantidad de puestos es 1 2) cuando la cantidad de puestos es mayor a 1
		
		//Caso 1) cuando la cantidad de puestos es 1, solo se hará un intercambio de valores
		if ($Cantidad_Puestos == 1)
		{
			
			//Obteniendo el id del id_PosicionEjercicio que fue movido
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Hijo);
			$id_EjercicioClienteHijo 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cambiando el valor para ambos, el que fue movido y el hijo.
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Hijo);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClienteHijo, $id_Cambio);


		}
		else  
		{
			//Caso 2) se tiene que hacer un cambio por la cantidad de espacios recorridos
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id']; //Id del ejercicio a cambairle la posición
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			//Tomando el id desde el último a cambiarse hasta el primero, se hace desde el último para evitar repetidos u otros problemas
			
			$id_PosicionEjercicioCambiar = $id_Cambio-1;

			//Actualizando la posición del ejercicioo del último al primero
			$resulAc=$actualizar ->_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicio($id_Rutina, $id_PosicionEjercicioCambiar,$id_dia);
			
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Hijo);
			
		} //else

		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinasClientes($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	} //CambioLugarEjercicioSinPadre

	function CambioLugarEjercicioSinHijo($Parametros)
	{
		$id_Rutina        = $Parametros['id_rutina'];
		$id_Cambio        = $Parametros['id_cambio'];
		$id_Hijo          = $Parametros['id_Hijo'];
		$id_Padre         = $Parametros['id_Padre'];
		$Cantidad_Puestos = $Parametros['Cantidad_Puestos'];
		$consultar        = new Consultar();
		$agregar          = new Agregar();
		$actualizar       = new Actualizar();
		$id_dia 		  = "";
		
		
		//Casos a definir 1) cuando la cantidad de puestos es 1 2) cuando la cantidad de puestos es mayor a 1
		
		//Caso 1) cuando la cantidad de puestos es 1, solo se hará un intercambio de valores
		if ($Cantidad_Puestos == 1)
		{
			//Obteniendo el id del id_PosicionEjercicio que fue movido
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Padre);
			$id_EjercicioClienteHijo 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cambiando el valor para ambos, el que fue movido y el hijo.

			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Padre);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClienteHijo, $id_Cambio);
		}
		else  
		{
			//Caso 2) se tiene que hace run cambio por la cantidad de espacios recorridos
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id']; //Id del ejercicio a cambairle la posición
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			//Se debe tomar la posición del td que s emovió y sumarle la cantidad de de puestos que se bajó
			//Para ir avanzando se le va restando 1, por cada vez que entra al ciclo y así irá dando los números
			$id_PosicionEjercicioCambiar = $id_Cambio+1;
			//Actualizando la posición del ejercicioo del último al primero
			$resulAc=$actualizar ->_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaClie($id_Rutina, $id_PosicionEjercicioCambiar,$id_dia);
				
			
			
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Padre);
			
		} //else
		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinasClientes($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	}//CambioLugarEjercicioSinHijo

	function ConAmbosBajoPosicion($Parametros)
	{
		$id_Rutina        = $Parametros['id_rutina'];
		$id_Cambio        = $Parametros['id_cambio'];
		$id_Hijo          = $Parametros['id_Hijo'];
		$id_Padre         = $Parametros['id_Padre'];
		$Cantidad_Puestos = $Parametros['Cantidad_Puestos'];
		$consultar        = new Consultar();
		$agregar          = new Agregar();
		$actualizar       = new Actualizar();
		$id_dia 		  = "";
		
		//Casos a definir 1) cuando la cantidad de puestos es 1 2) cuando la cantidad de puestos es mayor a 1
		
		//Caso 1) cuando la cantidad de puestos es 1, solo se hará un intercambio de valores
		if ($Cantidad_Puestos == 1)
		{
			//Obteniendo el id del id_PosicionEjercicio que fue movido
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Padre);
			$id_EjercicioClientPadre 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cuando se baja una sola posición en la lista y se tiene, padre he hijo, se hace meramente un intercambio de posiciones tal cual
			//Al que se le movió se le asigna la posición del padre y al pdre se le asigna la posición del que fue movido
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Padre);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClientPadre, $id_Cambio);

		}
		else
		{
			//caso 2= cuando la cantidad de puestos que se ha bajado es mayor que 1, se cuenta con padre he hijo.
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			
			$Inicio_Cambio = $id_Cambio + 1; //es desde donde se comienza a hacer el ajuste de posiciones.
			$resulAc = $actualizar -> _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioResta($id_Rutina, $Inicio_Cambio,$id_Padre,$id_dia);
			 
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Padre);
			
		}//else
		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinasClientes($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	}//ConAmbosBajoPosicion
	

	function ConAmbosSubioPosicion($Parametros)
	{
		$id_Rutina        = $Parametros['id_rutina'];
		$id_Cambio        = $Parametros['id_cambio'];
		$id_Hijo          = $Parametros['id_Hijo'];
		$Cantidad_Puestos = $Parametros['Cantidad_Puestos'];
		$consultar        = new Consultar();
		$agregar          = new Agregar();
		$actualizar       = new Actualizar();
		$id_dia 		  = "";
		
		//Casos a definir 1) cuando la cantidad de puestos es 1 2) cuando la cantidad de puestos es mayor a 1
		
		//Caso 1) cuando la cantidad de puestos es 1, solo se hará un intercambio de valores
		if ($Cantidad_Puestos == 1)
		{
			//Obteniendo el id del id_PosicionEjercicio que fue movido
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			
			//Obtener el id del id_PosicionEjercicio padre a intercambiar
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Hijo);
			$id_EjercicioClientPadre 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cuando se baja una sola posición en la lista y se tiene, padre he hijo, se hace meramente un intercambio de posiciones tal cual
			//Al que se le movió se le asigna la posición del padre y al pdre se le asigna la posición del que fue movido
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Hijo);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_EjercicioClientPadre, $id_Cambio);

		}//if
		else
		{
			//caso 2= cuando la cantidad de puestos que se ha bajado es mayor que 1, se cuenta con padre he hijo.
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			
			$Inicio_Cambio = $id_Cambio - 1; //es desde donde se comienza a hacer el ajuste de posiciones.
			$resulAc = $actualizar -> _ActualizarIdPosicionEjercicioSubioPosicion($id_Rutina, $Inicio_Cambio,$id_Hijo,$id_dia);
				 
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Hijo);
		}//else
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinasClientes($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	}//ConAmbosSubioPosicion

	function EjecutarTransaccion($objeto)
	{
		R::freeze(1);
		R::begin();
		    try{
		       $respuesta = R::store($objeto);
		        R::commit();
		    }
		    catch(Exception $e) {
		    	print_r($e->getMessage());
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		return $respuesta;
	}//EjecutarTransacción
		
	function EjerciciosRutinaOrden($Parametros)
	{
		$id         = $Parametros['id'];
		$consultar  = new Consultar();
		$ejercicios = $consultar->_ConsultarInformacionRutinaPreFinalClientePorId($id);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"ejercicios"=>$ejercicios);
		return $datos;
	}//EjerciciosRutinaOrden

	function AgregarRelacionEjercicio($Parametros)
	{
		$id_ejercicio = $Parametros['id_ejercicio'];
		$relacion     = $Parametros['relacion'];

		$ejercicio = R::load("sgejerciciosrutinacliente",$id_ejercicio);
		$ejercicio->ejercicio_relacion = $relacion;
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = is_numeric($respuesta);
		$datos     = array("exito"=>$exito);
		return $datos;
	}//AgregarRelacionEjercicio

	function AgregarRepeticionesEjercicio($Parametros)
	{
		$id_ejercicio     = $Parametros['id_ejercicio'];
		$num_repeticiones = $Parametros['num_repeticiones'];
		$id_rutina 	      = $Parametros['id_rutina'];

		$ejercicio = R::load("sgejerciciosrutinacliente",$id_ejercicio);
		$ejercicio->num_repeticiones = $num_repeticiones;
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = is_numeric($respuesta);
		$datos     = array("exito"=>$exito);
		return $datos;
	}//AgregarRepeticionesEjercicio

	function AgregarCircuitosEjercicio($Parametros)
	{
		$id_ejercicio  = $Parametros['id_ejercicio'] ;
		$num_circuitos = $Parametros['num_circuitos'] ;

		$ejercicio = R::load("sgejerciciosrutinacliente",$id_ejercicio);
		$ejercicio->num_circuitos = $num_circuitos;
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = is_numeric($respuesta);
		$datos     = array("exito"=>$exito);
		return $datos;

	}///AgregarCircuitosEjercicio

	function DesactivarRutina($Parametros)
	{
		$id = $Parametros['id'];
		$rutina = R::findOne("sgrutinasclientes","id_cliente=?",[$id]);
		$id_rutina = $rutina->id;
		$actualizar = new Actualizar();
		$exito      = 0;
		$resultado  = $actualizar->_EliminarRutinaClientePorIdcliente($id,$id_rutina);
		if(is_numeric($resultado))
		{
			$exito = 1;
		}
		$datos = array("exito"=>$exito);
		return $datos;
	}//DesactivarRutina

	function RegistrarEjerciciosRutinas($Parametros)
	{
		//Tomando los datos
		if(isset($Parametros['id_rutina']))
		{
			$id_rutina = $Parametros['id_rutina'];
		}
		else{$id_rutina = $_SESSION['id_rutina'];}
		$consultar          = new Consultar();
		$id_dia             = $Parametros['id_dia'];
		$id_CategoriaRutina = $Parametros['id_CategoriaRutina'];
		$id_TipoRutina      = $Parametros['id_TipoRutina'];
		$ejerciciosAgregar  = $Parametros['EjerciciosRutina'];
		$cantidad           = count($ejerciciosAgregar);
		
		$id_usuario         = $_SESSION['usuario']['id'];
		$errores            = array(); //Reporte de errrores
		$guardados          = array(); // reporte de guardados
		//Se procede a agregar los ejercicios.

		for($i=0; $i<$cantidad; $i++)
		{
			$ejercicio = $ejerciciosAgregar[$i];
			$posicion  = $consultar->_ConsultarPosicionEjercicioRutinaCliente($id_rutina);
			$id_posicionejercicio = $posicion['id_posicionejercicio'];
			//creando la variable he ingresando los datos.
			$ejercicioAg = R::dispense("sgejerciciosrutinacliente");
			$ejercicioAg->id_ejercicio  		 = $ejercicio;
			$ejercicioAg->id_dia       		     = $id_dia;
			$ejercicioAg->id_categoriarutina     = $id_CategoriaRutina;
			$ejercicioAg->id_tiporutinaejercicio = $id_TipoRutina;
			$ejercicioAg->id_rutina              = $id_rutina;
			$ejercicioAg->id_usuariocreacion     = $id_usuario;
			$ejercicioAg->id_posicionejercicio   = $id_posicionejercicio;
			$ejercicioAg->nb_ejerciciorutina     = " ";
			$ejercicioAg->desc_ejerciciorutina   = " ";
			$ejercicioAg->sn_activo  	         = 1;

			//Guardando el ejercicio
			$respuesta = EjecutarTransaccion($ejercicioAg);
			if(is_numeric($respuesta))
			{
				$resp = array("agregado"=>"si","id"=>$respuesta);
				array_push($guardados,$resp);
			}
			else
			{
				$resp = array("agregado"=>"no");
				array_push($errores,$resp);
			}

		}//For
			
		$cantidadagregados = count($guardados);
		$exito   = ($cantidadagregados==$cantidad)?1:0;
		$datos   = array("exito"=>$exito);
		return $datos;
	}//RegistrarEjerciciosRutinas

	//Funciones viejas
	function EditarCliente1($Parametros)
	{
		//Tomamos los datos.
		$consultar        = new Consultar();
		$nb_apellidos	  = $Parametros['nb_apellidos'];
		$de_genero		  = $Parametros['de_genero'];
		$fh_nacimiento    = $Parametros['fh_nacimiento'];
		$de_email		  = $Parametros['de_email'];
		$num_telefono	  = $Parametros['num_telefono'];
		$num_celular	  = $Parametros['num_celular'];
		$de_colonia		  = $Parametros['de_colonia'];
		$de_domicilio	  = $Parametros['de_domicilio'];
		$num_codigoPostal = $Parametros['num_codigoPostal'];
		$nb_cliente		  = $Parametros['nb_cliente'];
		$id_cliente		  = $Parametros['id_cliente'];
		$id_cuerpo        = $Parametros['id_cuerpo'];
		$resultCuerpo     = $consultar->_ConsultarCuerpoPorTexto($id_cuerpo);
		$filaCuerpo       = $resultCuerpo->fetch_assoc();
		$id_tipoCuerpo    = $filaCuerpo['id'];
		$editar = new Actualizar();
		$result = $editar->_EditarCliente($nb_apellidos,$de_genero,$fh_nacimiento,$de_email,
				$num_telefono,$num_celular,$de_colonia,$de_domicilio,$num_codigoPostal,$nb_cliente, $id_cliente,$id_tipoCuerpo);
	}
	
	function EliminarCliente1($id)
	{
		$eliminar=new Actualizar();
		$result=$eliminar->_Eliminarcliente($id);
	}
	
	function GuardarDatosFormulario($Condicion_Cardiaca,$Condicion_Pecho,$Condicion_Pecho_reciente,$Condicion_Balance, $Lesion_Fisica, $Medicamentos_Corazon,
	 $Impedimento_Entrenamiento,$Lecturas_Anormales, $Cirujia_Bypass, $Dificultad_Respirar, $Enfermedades_Renales,$Arritmia,$Colesterol, $Presion_Alta,
	  $cantidad_Cigarros,$Molestias_Articulaciones,$Molestias_Espalda, $Desayuno_Diario, $Comida_Diaria, $Cena_Diaria, $EntreComida_Diaria,
	  $Frecuencia_EntreComida,$Plan_Alimenticio, $Intensidad_Ejercicio,$Intensidad_Ejercicio2,$Intensidad_Ejercicio3, $Intensidad_Ejercicio4,
	  $Intensidad_Ejercicio5, $Programa_Ejercicio, $Actividades_deseables, $Actividades_indeseables,$deporte_Frecuente, $Minutos_Dia, $Dias_Semana,
	  $Resultado_Ejercicio,$id_cliente ,$id_instructor )
	{
		$agregar=new Agregar();
		$result=$agregar->_AgregarDatosFormularioSalud($Condicion_Cardiaca,$Condicion_Pecho,$Condicion_Pecho_reciente,$Condicion_Balance, $Lesion_Fisica, $Medicamentos_Corazon,
		$Impedimento_Entrenamiento,$Lecturas_Anormales, $Cirujia_Bypass, $Dificultad_Respirar, $Enfermedades_Renales,$Arritmia,$Colesterol, $Presion_Alta,
		$cantidad_Cigarros,$Molestias_Articulaciones,$Molestias_Espalda, $Desayuno_Diario, $Comida_Diaria, $Cena_Diaria, $EntreComida_Diaria,
		$Frecuencia_EntreComida,$Plan_Alimenticio, $Intensidad_Ejercicio,$Intensidad_Ejercicio2,$Intensidad_Ejercicio3, $Intensidad_Ejercicio4,
		$Intensidad_Ejercicio5, $Programa_Ejercicio, $Actividades_deseables, $Actividades_indeseables,$deporte_Frecuente, $Minutos_Dia, $Dias_Semana,
		$Resultado_Ejercicio,$id_cliente ,$id_instructor);											
	}
	
	function EditarDatosFormulario($Condicion_Cardiaca,$Condicion_Pecho,$Condicion_Pecho_reciente,$Condicion_Balance, $Lesion_Fisica, 
				$Medicamentos_Corazon,$Impedimento_Entrenamiento,$Lecturas_Anormales, $Cirujia_Bypass, $Dificultad_Respirar, $Enfermedades_Renales,
				$Arritmia,$Colesterol, $Presion_Alta,$cantidad_Cigarros,$Molestias_Articulaciones,$Molestias_Espalda, $Desayuno_Diario, $Comida_Diaria,
				$Cena_Diaria, $EntreComida_Diaria,$Frecuencia_EntreComida,$Plan_Alimenticio, $Intensidad_Ejercicio,$Intensidad_Ejercicio2,
				$Intensidad_Ejercicio3, $Intensidad_Ejercicio4,$Intensidad_Ejercicio5, $Programa_Ejercicio, $Actividades_deseables, 
				$Actividades_indeseables,$deporte_Frecuente, $Minutos_Dia, $Dias_Semana,$Resultado_Ejercicio,$id_cliente ,$id_instructor )
	{
		$Actualizar=new Actualizar();
		$result=$Actualizar->EditarDatosFormularioPorIdCliente($Condicion_Cardiaca,$Condicion_Pecho,$Condicion_Pecho_reciente,$Condicion_Balance, $Lesion_Fisica, $Medicamentos_Corazon,
		$Impedimento_Entrenamiento,$Lecturas_Anormales, $Cirujia_Bypass, $Dificultad_Respirar, $Enfermedades_Renales,$Arritmia,$Colesterol, $Presion_Alta,
		$cantidad_Cigarros,$Molestias_Articulaciones,$Molestias_Espalda, $Desayuno_Diario, $Comida_Diaria, $Cena_Diaria, $EntreComida_Diaria,
		$Frecuencia_EntreComida,$Plan_Alimenticio, $Intensidad_Ejercicio,$Intensidad_Ejercicio2,$Intensidad_Ejercicio3, $Intensidad_Ejercicio4,
		$Intensidad_Ejercicio5, $Programa_Ejercicio, $Actividades_deseables, $Actividades_indeseables,$deporte_Frecuente, $Minutos_Dia, $Dias_Semana,
		$Resultado_Ejercicio,$id_cliente ,$id_instructor);		
	}				
	
	function AgregarRutina($Parametros)
	{
		//Creando la rutina
		
		date_default_timezone_set("America/Chihuahua");
		$fh_creacion                = date("Y-m-d"); //fecha del día de hoy
		$id_usuario 			    = $_SESSION['usuario']['id'];
		$rutina 				    = R::dispense("sgrutinasclientes");
		$rutina->id_usuariocreacion = $id_usuario;
		$rutina->id_categoriarutina = $Parametros['categoria'];
		$rutina->id_cliente  		= $Parametros['cliente'];
		$rutina->id_generorutina    = $Parametros['genero'];
		$rutina->id_tipocuerpo      = $Parametros['cuerpo'];
		$rutina->nb_rutina          = $Parametros['nb_rutina'];
		$rutina->desc_rutina        = $Parametros['desc_rutina'];
		$rutina->id_edad 			= $Parametros['id_edad'];
		$rutina->sn_activo          = 1;
		$rutina->fh_creacion        = $fh_creacion;
		$respuesta 					= EjecutarTransaccion($rutina);
		$exito  					= (is_numeric($respuesta))?1:0;
		$datos 						= array("exito"=>$exito,"id_rutina"=>$respuesta);

		//Guardando en variable de sesión el id de la rutina
		if(is_numeric($respuesta)){$_SESSION['id_rutina'] = $respuesta;}
		return $datos;
	}//AgregarRutina
	
	
	function AsignarRutinaCliente($Parametros)
	{
		date_default_timezone_set("Mexico/General");
		

		//Tomando los valores
		$id_instructor  = $_SESSION['usuario']['id'];
		$id_cliente		= $Parametros['Cliente'];
		$id_rutina		= $Parametros['id_rutina'];
		$fh_creacion    = date("Y-m-d"); //fecha del día de hoy
		$exito          = 0;

		//buscar la información de la rutina y tomando lo sdatos.
		$rutina         = R::load("sgrutinas",$id_rutina);
		$id_categoriarutina = $rutina->id_categoriarutina;
		$nb_rutina      = $rutina->nb_rutina;
		$desc_rutina    = $rutina->desc_rutina;
		$id_tipocuerpo  = $rutina->id_tipocuerpo;

		$consultar 		= new Consultar();
		$agregar  		= new Agregar();
		
		//Agregando en la Tabla sg_rutinasclientes Los datos de la rutina
		$rutina_agregar = R::dispense("sgrutinasclientes");
		$rutina_agregar->id_usuariocreacion = $id_instructor;
		$rutina_agregar->id_categoriarutina = $id_categoriarutina;
		$rutina_agregar->id_cliente         = $id_cliente;
		$rutina_agregar->id_tipocuerpo      = $id_tipocuerpo;
		$rutina_agregar->nb_rutina          = $nb_rutina;
		$rutina_agregar->desc_rutina        = $desc_rutina;
		$rutina_agregar->fh_creacion        = $fh_creacion;
		$rutina_agregar->sn_activo          = 1;
		$id_rutinacliente 				    = EjecutarTransaccion($rutina_agregar);
		$agregados 							= array();
		if(is_numeric($id_rutinacliente))
		{
			// Si entra aquí es por que agregó correctamente la rutina.
			// Se procede a buscar todos los ejercicios de la rutina que se agrega.
			//Tomando los ejercicios de la rutina
			$ejercicios = $consultar->_ConsultarInfoTotalEjerciciosPorIdRutina($id_rutina);
			$cantidad   = count($ejercicios);
			if($cantidad>0)
			{
				//Aquí si entra si hay ejercicios.
				foreach ($ejercicios as $ejercicio) 
				{
					//agregando los datos del ejercicio a la tabla de ejercicios rutina clientes.
					$ejerciciocliente =  R::dispense("sgejerciciosrutinacliente");
					$ejerciciocliente->id_ejercicio       = $ejercicio['id_ejercicio'];
					$ejerciciocliente->id_usuariocreacion = $ejercicio['id_usuariocreacion'];
					$ejerciciocliente->id_dia             = $ejercicio['id_dia'];
					$ejerciciocliente->id_rutina          = $id_rutinacliente;
					$ejerciciocliente->id_categoriarutina = $ejercicio['id_categoriarutina'];
					$ejerciciocliente->id_tiporutinaejercicio = $ejercicio['id_tiporutinaejercicio'];
					$ejerciciocliente->id_posicionejercicio = $ejercicio['id_posicionejercicio'];
					$ejerciciocliente->num_circuitos = $ejercicio['num_circuitos'];
					$ejerciciocliente->num_repeticiones = $ejercicio['num_repeticiones'];
					$ejerciciocliente->ejercicio_relacion = $ejercicio['ejercicio_relacion'];
					$ejerciciocliente->sn_activo = 1;
					$ejerciciocliente->nb_ejerciciorutina = " ";
					$ejerciciocliente->desc_ejerciciorutina = " ";
					$ejercicioid = EjecutarTransaccion($ejerciciocliente);
					if(is_numeric($ejercicioid))
					{
						$dato = array("id"=>$ejercicioid);
						array_push($agregados,$dato);
					}
				}//foreach
				$cantidad_agregados = count($agregados);
				$exito = ($cantidad==$cantidad_agregados)?1:0;
			}//if $cantidad>0
		}//if
		$datos = array("exito"=>$exito,"id_rutinacliente"=>$id_rutinacliente);
		return $datos;
	}//AsignarRutinaACliente
	
	
	//Funciones de cambio de logar de la rutina de clientes
	
	
	function ConsultarTiposCuerpo()
	{
		//Buscando los tipos de cuerpo existentes
		$consultar = new Consultar();
		$result    = $consultar->_ConsultarTiposCuerpo();
		$num_rows  = $result->num_rows;
		$cuerpos   = array();

		for($i=0; $i<$num_rows; $i++)
		{
			$fila   = $result->fetch_assoc();
			$cuerpo = array("id"=>$fila['id'],"nb_cuerpo"=>$fila['nb_cuerpo'],
				            "desc_tipocuerpo"=>$fila['desc_tipocuerpo'],
				            "url_img"=>$fila['url_img']);
			array_push($cuerpos, $cuerpo);
		}//for
		
		return $datos = array("cuerpos"=>$cuerpos);
	}//ConsultarTiposCuerpo
?>