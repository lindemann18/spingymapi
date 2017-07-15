<?php
	session_start();
	include("../../libs/libs.php");
	$Params=(isset($_GET['Params']))?$_GET['Params']:$_POST['Params'];
	$Parametros = json_decode($Params,true);
	$Accion     = $Parametros['Accion'];
	$conexion   = new ConexionBean(); //Variable de conexión
	$con        = $conexion->_con(); //Variable de conexión
	//Switch de las funciones
	switch($Accion)
	{
		case 'TiposRutina':
			$salidaJson = TiposRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarTipoRutina':
			$salidaJson = AgregarTipoRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarTipoRutina':
			$salidaJson = EliminarTipoRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarTipoRutinaId':
			$salidaJson = BuscarTipoRutinaId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarCategoria':
			$salidaJson = EditarCategoria($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarMusculos':
			$salidaJson = ConsultarMusculos($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarMusculo':
			$salidaJson = AgregarMusculo($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarMusculoPorId':
			$salidaJson = BuscarMusculoPorId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarMusculo':
			$salidaJson = EditarMusculo($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarMusculo':
			$salidaJson = EliminarMusculo($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarEjerciciosLigados':
			$salidaJson = ConsultarEjerciciosLigados($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarEjercicios':
			$salidaJson = ConsultarEjercicios($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarMusculosLigados':
			$salidaJson = ConsultarMusculosLigados($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarInfoEjercicios':
			$salidaJson = ConsultarInfoEjercicios($Parametros);
			echo json_encode($salidaJson);
		break;


		case 'AgregarEjercicio':
			$salidaJson = AgregarEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarEjercicioPorId':
			$salidaJson = BuscarEjercicioPorId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarEjercicio':
			$salidaJson = EditarEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarEjercicio':
			$salidaJson = EliminarEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarRutinasLigadas':
			$salidaJson = ConsultarRutinasLigadas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'FiltrarEjerciciosTipoRutina':
			$salidaJson = FiltrarEjerciciosTipoRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'Rutinas':
			$salidaJson = Rutinas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarCategoriasPorEntrenador':
			$salidaJson = BuscarCategoriasPorEntrenador($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'FiltrarRutinas':
			$salidaJson = FiltrarRutinas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'RutinasAgregarCategorias':
			$salidaJson = RutinasAgregarCategorias($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'VerificarRutina':
			$salidaJson = VerificarRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarRutina':
			$salidaJson = AgregarRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'InfoRutinaCompleja':
			$salidaJson = InfoRutinaCompleja($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarEjerciciosPorRutina':
			$salidaJson = BuscarEjerciciosPorRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'RegistrarEjerciciosRutinas':
			$salidaJson = RegistrarEjerciciosRutinas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'RegistrarEjerciciosRutinasEditar':
			$salidaJson = RegistrarEjerciciosRutinasEditar($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EjerciciosRutinaOrden':
			$salidaJson = EjerciciosRutinaOrden($Parametros);
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

		case 'AgregarRepeticionesEjercicio':
			$salidaJson = AgregarRepeticionesEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarCircuitosEjercicio':
			$salidaJson = AgregarCircuitosEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarRelacionEjercicio':
			//Mandando los valores a BD ya sea para agregar y o actualizar
			$salidaJson = AgregarRelacionEjercicio($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarRutina':
			//Mandando los valores a BD ya sea para agregar y o actualizar
			$salidaJson = EliminarRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'DatosEditarRutina':
			$salidaJson = DatosEditarRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarInfoRutina':
			$salidaJson = EditarInfoRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'DatosEditarRutinaDias':
			$salidaJson = DatosEditarRutinaDias($Parametros);
			echo json_encode($salidaJson);
		break;
		case 'DesactivarEjerciciosPorRutina':
			//Mandando los valores a BD ya sea para agregar y o actualizar
			$salidaJson = DesactivarEjerciciosPorRutina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarTiposRutinaEdit':
			$salidaJson = BuscarTiposRutinaEdit($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarEjerciciosRutinas':
			//Llamando a la función de edición
			
			$salidaJson = EditarEjerciciosRutinas($Parametros);
			echo json_encode($salidaJson);
		break;

		//Secciones Viejas
		case 'AgregaMusculo':
			$nb_musculo	   = $Parametros['nb_musculo'];
			$desc_musculo  = $Parametros['desc_musculo'];
			$id_usuario	   = $Parametros['id_usuario'];
			$id_TipoRutina = $Parametros['id_TipoRutina'];
			//Llamando a la función de edición
			AgregaMusculo($nb_musculo, $desc_musculo,$id_usuario,$id_TipoRutina);
			//DEvolviendo parámetros para la notificación				
			$salidaJson=array("Agregado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		case 'EditarMusculo1':
			$nb_musculo	   =$Parametros['nb_musculo'];
			$desc_musculo  =$Parametros['desc_musculo'];
			$id_usuario	   =$Parametros['id_usuario'];
			$id_musculo	   =$Parametros['id_musculo'];
			$id_TipoRutina =$Parametros['id_TipoRutina'];
			
			//Llamando a la función de edición
			EditarMusculo1($nb_musculo, $desc_musculo,$id_usuario, $id_musculo,$id_TipoRutina);
			//DEvolviendo parámetros para la notificación				
			$salidaJson=array("Editado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		case 'EliminarMusculo1':
			$id_musculo = $Parametros['id_musculo'];
			//Llamando a la función de edición
			$salidaJson = EliminarMusculo($id_musculo);
			//DEvolviendo parámetros para la notificación				
			//$salidaJson = array("Editado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		case 'AgregaTipoRutina':
			$nb_TipoRutina	=$Parametros['nb_TipoRutina'];
			$desc_TipoRutina=$Parametros['desc_TipoRutina'];
			$id_usuario		=$Parametros['id_usuario'];
			//Llamando a la función de edición
			AgregaTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario);
			//DEvolviendo parámetros para la notificación				
			$salidaJson=array("Editado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		case 'EditarTipoRutina':
			$nb_TipoRutina	 = $Parametros['nb_TipoRutina'];
			$desc_TipoRutina = $Parametros['desc_TipoRutina'];
			$id_usuario		 = $Parametros['id_usuario'];
			$id_TipoRutina	 = $Parametros['id_TipoRutina'];
			//Llamando a la función de edición
			EditarTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario,$id_TipoRutina);
			//DEvolviendo parámetros para la notificación				
			$salidaJson=array("Editado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		
		case 'EliminarTipoRutina1':
			$id_TipoRutina = $Parametros['id_TipoRutina'];
			//Llamando a la función de edición
			$salidaJson = EliminarTipoRutina($id_TipoRutina);
			//DEvolviendo parámetros para la notificación				
			echo json_encode($salidaJson);
		break;
		
		
		case 'BuscarRutinasPorMusculo':
			$id_musculo=$Parametros['id_musculo'];
			//Llamando a la función de edición
			$salidaJson=BuscarRutinasPorMusculo($id_musculo);
			//DEvolviendo parámetros para la notificación
			echo json_encode($salidaJson);
		break;
		
		case 'AgregaEjercicio':
			$nb_ejercicio	= $Parametros['nb_ejercicio'];
			$desc_ejercicio	= $Parametros['desc_ejercicio'];
			$id_musculo		= $Parametros['id_musculo'];
			$id_TipoRutina	= $Parametros['id_TipoRutina'];
			$id_maquina		= $Parametros['id_maquina'];
			$id_usuario		= $Parametros['id_usuario'];
			//Llamando a la función de edición
			AgregaEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina, $id_maquina,$id_usuario);
			//DEvolviendo parámetros para la notificación				
			$salidaJson=array("Agregado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		case 'EditarEjercicio1':
			$nb_ejercicio	= $Parametros['nb_ejercicio'];
			$desc_ejercicio	= $Parametros['desc_ejercicio'];
			$id_musculo		= $Parametros['id_musculo'];
			$id_TipoRutina	= $Parametros['id_TipoRutina'];
			$id_maquina		= $Parametros['id_maquina'];
			$id_usuario		= $Parametros['id_usuario'];
			$id_Ejercicio	= $Parametros['id_Ejercicio'];
			//Llamando a la función de edición
			EditarEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina, $id_maquina,$id_usuario, $id_Ejercicio);
			//DEvolviendo parámetros para la notificación				
			$salidaJson = array("Agregado"=>"1" );
			echo json_encode($salidaJson);
		break;
		
		case 'EliminarEjercicio1':
			$id_Ejercicio = $Parametros['id_Ejercicio'];
			//Llamando a la función de edición
			$Rutinas = EliminarEjercicio($id_Ejercicio);
			//DEvolviendo parámetros para la notificación				
			$salidaJson = array("Rutinas"=>$Rutinas);
			echo json_encode($salidaJson);
		break;
		
		case 'BuscarCategoriaRutinasPorEntrenador':
			$id_entrenador = $Parametros['id_entrenador'];
			//Llamando a la función de edición
			
			//DEvolviendo parámetros para la notificación				
			$salidaJson = BuscarCategoriaRutinasPorEntrenador($id_entrenador);
			echo json_encode($salidaJson);
		break;
		
		case 'BuscarCategoriaRutinasGeneral':
			$id_entrenador = $Parametros['id_entrenador'];
			//Llamando a la función de edición
			
			//DEvolviendo parámetros para la notificación				
			$salidaJson = BuscarCategoriaRutinasGeneral($id_entrenador);
			echo json_encode($salidaJson);		
		break;
				
		case 'BuscarRutinasPorEntrenadorYCategoria':
			$id_entrenador		= $Parametros['id_entrenador'];
			$id_CategoriaRutina	= $Parametros['id_CategoriaRutina'];
			//Llamando a la función de edición
			
			//DEvolviendo parámetros para la notificación				
			$salidaJson = BuscarRutinasPorEntrenadorYCategoria($id_entrenador, $id_CategoriaRutina);
			echo json_encode($salidaJson);
		break;
		
		case 'VerificaExistenciaRutina':
			$nb_rutina			= $Parametros['nb_rutina'];
			$id_CategoriaRutina	= $Parametros['id_CategoriaRutina'];
			//Llamando a la función de edición
			
			//DEvolviendo parámetros para la notificación				
			$salidaJson = VerificaExistenciaRutina($nb_rutina, $id_CategoriaRutina);
			echo json_encode($salidaJson);
		break;
		
		case 'AgregarRutina1':
			
			//Llamando a la función de edición
			
			//DEvolviendo parámetros para la notificación				
			$salidaJson = AgregarRutina($Parametros);
			echo json_encode($salidaJson);
		break;
		
		case 'RegistrarEjerciciosRutinas1':
			$id_rutina			= $Parametros['id_rutina'];
			$id_usuario			= $Parametros['id_usuario'];
			$id_dia				= $Parametros['id_dia'];
			$id_CategoriaRutina	= $Parametros['id_CategoriaRutina'];			
			$EjerciciosRutina	= $Parametros['EjerciciosRutina'];
			$id_TipoRutina		= $Parametros['id_TipoRutina'];
			$CantidadEjercicios	= $Parametros['CantidadEjercicios'];
			//Llamando a la función de edición
			
			//DEvolviendo parámetros para la notificación				
			RegistrarEjerciciosRutinas($id_rutina, $id_usuario,$id_dia,$id_CategoriaRutina, $EjerciciosRutina, $CantidadEjercicios, $id_TipoRutina);
			//echo json_encode($salidaJson);
		break;
		
		case 'EditarDatosRutina':
			EditarDatosRutina($Parametros);
			//echo json_encode($salidaJson);
		break;
		
		
		
		
		
		
		
		
		case 'BuscarMaquinasPorCategoria':
			
			//Tomando los valores
			$id_CategoriaMaquina    = $Parametros['id_CategoriaMaquina'];
			
			//Mandando los valores a BD ya sea para agregar y o actualizar
			$salidaJson = BuscarMaquinasPorCategoria($id_CategoriaMaquina);
			echo json_encode($salidaJson);
		break;
		
		case 'BuscarGeneroRutinas':
			$salidaJson = BuscarGeneroRutinas($Parametros);
			echo json_encode($salidaJson);
		break;
		
		//Funciones para los cambios de lugar de los ejercicios de rutina
		case 'CambioLugarEjercicio1':

			//Tomando los valores
			$id_Rutina		  = $Parametros['id_Rutina'];
			$id_Cambio 		  = $Parametros['id_Cambio'];
			$id_Hijo		  = $Parametros['id_Hijo']; 
			$id_Padre		  = $Parametros['id_Padre'];
			$Cantidad_Puestos = $Parametros['Cantidad_Puestos'];
			$AccionCambio	  = $Parametros['AccionCambio'];
			
			//Decisiones sobre el tipo de cambio que se hará 1)Sin padre 2) Sin hijo 3)Con padre he hijo.
			
			switch($AccionCambio)
			{
				case 'SinPadre':
					CambioLugarEjercicioSinPadre($id_Rutina,$id_Cambio,$id_Hijo, $Cantidad_Puestos);
				break;
				
				case 'SinHijo':
					CambioLugarEjercicioSinHijo($id_Rutina,$id_Cambio,$id_Padre, $Cantidad_Puestos);
				break;
				
				case 'ConAmbosBajoPosicion':
					ConAmbosBajoPosicion($id_Rutina,$id_Cambio,$id_Padre, $id_Hijo,$Cantidad_Puestos);
				break;
				
				case 'ConAmbosSubioPosicion':
					ConAmbosSubioPosicion($id_Rutina,$id_Cambio,$id_Padre, $id_Hijo,$Cantidad_Puestos);
				break;
				
			}//switch
		
	}//switch
	
	//Apartado de tipos de rutina	
	function TiposRutina()	
	{
		//Buscando los tipos de rutina
		$consultar = new Consultar();
		$tiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidad  = count($tiposRut);
		$existe    = 0;
		if($cantidad>0){$existe = 1;}
		$datos = array("existe"=>$existe,"tiposRut"=>$tiposRut);
		return $datos;
	}//TiposRutina

	function AgregarTipoRutina($Parametros)
	{
		//Tomando los datos.
		$nb_tiporutina   = $Parametros['nb_tiporutina'];
		$desc_tiporutina = $Parametros['desc_tiporutina'];

		//Generando el objeto de la tabla
		$tipo_rutina = R::dispense("sgtiposrutina");
		$tipo_rutina->nb_tiporutina      = $nb_tiporutina;
		$tipo_rutina->desc_tiporutina    = $desc_tiporutina;
		$tipo_rutina->sn_activo          = 1;
		$tipo_rutina->id_usuarioregistro = $_SESSION['usuario']['id'];
		$exito = 0;
		//Agregando tipo rutina
		R::freeze(1);
		R::begin();
		    try{
		       $respuesta = R::store($tipo_rutina);
		        R::commit();
		    }
		    catch(Exception $e) {
		    	print_r($e->getMessage());
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		if($respuesta!="Error"){$exito = 1;}
		$datos = array("exito"=>$exito);
		return $datos;
	}//AgregarTipoRutina

	function EliminarTipoRutina($Parametros)
	{
		$id = $Parametros['id'];

		//Verificar que músculos están ligados a este tipo de rutina.
		$consultar  = new Consultar();
		$musculos   = $consultar->_ConsultarMusculosPorRutina($id);
		$cantidadm  = count($musculos);
		$existenmus = ($cantidadm>0)?1:0;
		$tiposRut   = [];
		$exitorut   = 0;
		$exito      = 0;
		if($existenmus>0){$existenmus=1;}
		else
		{	
			// Si no existen músculos ligados a este tipo de rutina
			// se eliminan
			$tipo_rutina = R::load("sgtiposrutina",$id);
			$tipo_rutina->sn_activo = 0;
			$exito = 0;
			//editando tipo rutina
			$respuesta = EjecutarTransaccion($tipo_rutina);
			if($respuesta!="Error"){$exito = 1;}
			$tiposRut  = $consultar->_ConsultarTiposRutina();
			$cantidad  = count($tiposRut);
			$exitorut  = 0;
			if($cantidad>0){$exitorut = 1;}
		}//if

		$datos = array("exito"=>$exito,"exitorut"=>$exitorut,
					   "tiposRut"=>$tiposRut,"existenmus"=>$existenmus);
		return $datos;
	}//EliminarTipoRutina

	function BuscarTipoRutinaId($Parametros)
	{
		$id  	     = $Parametros['id'];
		$consultar   = new Consultar();
		$tipo_rutina = $consultar->_ConsultarTipoRutinaPorId($id);
		$cantidad    = count($tipo_rutina);
		$existe      = 0;
		if($cantidad>0){$existe=1;}
		$datos = array("existe"=>$existe,"tipo_rutina"=>$tipo_rutina);
		return $datos;
	}//BuscarTipoRutinaId

	function EditarCategoria($Parametros)
	{
		$id    = $Parametros['id'];
		$exito = 0;
		//Creando un objeto de la tabla.
		$tipo_rutina = R::load("sgtiposrutina",$id);
		$tipo_rutina->nb_tiporutina   = $Parametros['nb_tiporutina'];
		$tipo_rutina->desc_tiporutina = $Parametros['desc_tiporutina'];

		//Agregando a BD
		//editando tipo rutina
		R::freeze(1);
		R::begin();
		    try{
		       $respuesta = R::store($tipo_rutina);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		if($respuesta!="Error"){$exito = 1;}
		$datos = array("exito"=>$exito,"respuesta"=>$respuesta);
		return $datos;
	}//EditarCategoria

	function ConsultarMusculos()
	{
		$consultar = new Consultar();
		$musculos  = $consultar->_ConsultarMusculos();
		$cantidad  = count($musculos);
		$exito     = 0;
		if($cantidad>0){$exito = 1;}
		$datos = array("exito"=>$exito,"musculos"=>$musculos);
		return $datos;
	}//ConsultarMusculos

	function AgregarMusculo($Parametros)
	{
		
		//Crendo el objeto de la tabla
		R::freeze(1);
		$exito 						  = 0;
		$musculo 			    	  = R::dispense("sgmusculos");
		$musculo->nb_musculo    	  = $Parametros['nb_musculo'];
		$musculo->desc_musculo  	  = $Parametros['desc_musculo'];
		$musculo->id_tiporutina 	  = $Parametros['id_tiporutina'];
		$musculo->sn_activo     	  = 1;
		$musculo->id_usuario_creacion = $_SESSION['usuario']['id'];
		//almacenando el músculo
		R::begin();
		    try{
		       $respuesta = R::store($musculo);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		if($respuesta!="Error"){$exito = 1;}
		$datos = array("exito"=>$exito);
		return $datos;
	}//AgregarMusculo

	function BuscarMusculoPorId($Parametros)
	{
		$id = $Parametros['id'];
		R::freeze(1);
		$consultar = new Consultar();
		$musculo   = $consultar->_ConsultarMusculosPorId($id);
		$cantidad  = count($musculo);
		$exito     = 0;
		$existe    = 0;
		if($cantidad>0 && $musculo!="error"){$exito = 1;}

		//buscando los tipos de rutina
		$tiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidad  = count($tiposRut);
		if($cantidad>0){$existe = 1;}

		$datos = array("exito"=>$exito,"musculo"=>$musculo,"existe"=>$existe,"tiposRut"=>$tiposRut);
		return $datos;
	}//BuscarMusculoPorId

	function EditarMusculo($Parametros)
	{
		//Tomando los datos y creando el objeto de la tabla.
		$id 		   = $Parametros['id'];
		$nb_musculo    = $Parametros['nb_musculo'];
		$desc_musculo  = $Parametros['desc_musculo'];
		$id_tiporutina = $Parametros['id_tiporutina'];
		$musculo       = R::load("sgmusculos",$id);

		//Editando los datos
		$musculo->nb_musculo    = $nb_musculo;
		$musculo->desc_musculo  = $desc_musculo;
		$musculo->id_tiporutina = $id_tiporutina;

		//Editar el músculo
		R::freeze(1);
		R::begin();
		    try{
		       $respuesta = R::store($musculo);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		$datos = array("respuesta"=>$respuesta);
		return $datos;
	}//EditarMusculo

	function EliminarMusculo($Parametros)
	{
		$id          = $Parametros['id'];
		$consultar   = new Consultar();
		//Se debe verificar si existen ejercicios ligados a este músculo
		$ejercicios  = $consultar->_ConsultarEjerciciosPorMusculo($id);
		$cantidadeje = count($ejercicios);
		$existeneje  = 0;
		$exito       = 0;
		$musculos    = [];
		$exitomus    = 0;
		if($cantidadeje>0){$existeneje=1;}
		else
		{
			// Si no existen ejercicios ligados a este músculo se 
 			// procede a eliminar el músculo.
 			$musculo = R::load("sgmusculos",$id);
 			$musculo->sn_activo = 0;

 			//Ejecutando la tranasacción
 			$respuesta = EjecutarTransaccion($musculo);
 			if($respuesta!="Error"){$exito=1;}

 			//buscando los músculos restantes.
 			$musculos  = $consultar->_ConsultarMusculos();
			$cantidad  = count($musculos);
			$exitomus  = 0;
			if($cantidad>0){$exitomus = 1;}
		}//else
		$datos = array("existeneje"=>$existeneje,"exito"=>$exito,
					   "exitomus"=>$exitomus,"musculos"=>$musculos);
		return $datos;
	}//EliminarMusculo

	function ConsultarEjerciciosLigados($Parametros)
	{
		$id 		 = $Parametros['id'];
		$consultar   = new Consultar();
		$ejercicios  = $consultar->_ConsultarEjerciciosPorMusculo($id);
		$cantidadeje = count($ejercicios);
		$exito       = ($cantidadeje>0)?1:0;
		$datos       = array("exito"=>$exito,"ejercicios"=>$ejercicios);
		return $datos;
	}//ConsultarEjerciciosLigados

	function ConsultarMusculosLigados($Parametros)
	{
		$id 		 = $Parametros['id'];
		$consultar   = new Consultar();
		$musculos    = $consultar->_ConsultarMusculosPorTipoRutinaId($id);
		$cantidad    = count($musculos);
		$exito       = ($cantidad>0)?1:0;
		$datos       = array("exito"=>$exito,"musculos"=>$musculos);
		return $datos;
	}//ConsultarMusculosLigados

	function ConsultarEjercicios()
	{
		$consultar  = new Consultar();
		$ejercicios = $consultar->_ConsultarEjercicios();
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$tiposRut   = $consultar->_ConsultarTiposRutinas();
		//Ingresando la opción Todos a los tipos de rutina
		$todos      = array("desc_tiporutina"=>"Todos","id"=>"Todos","id_usuarioregistro"=>"1","nb_tiporutina"=>"Todos","sn_activo"=>"1");
		array_push($tiposRut,$todos);
		$cantidadru = count($tiposRut);
		$exitorut   = ($cantidadru>0)?1:0;
		$datos      = array("exito"=>$exito,"exitorut"=>$exitorut,
							"ejercicios"=>$ejercicios,"tiposRut"=>$tiposRut);
		return $datos;
	}//ConsultarEjercicios

	function EjecutarTransaccion($objeto)
	{
		R::freeze(1);
		R::begin();
		    try{
		       $respuesta = R::store($objeto);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		return $respuesta;
	}//EjecutarTransacción


	function ConsultarInfoEjercicios()
	{
		//Consultar los tipos de rutina.
		$consultar = new Consultar();
		$tiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidad  = count($tiposRut);
		$exister   = 0;
		if($cantidad>0){$exister = 1;}
		//Consultando los tipos de máquinas
		$maquinas  = $consultar->_ConsultarTiposMaquina();
		$cantidadm = count($maquinas);
		$exitom    = ($cantidadm>0)?1:0;
		
		//Consultar los tipos de rutinas.
		$tiposRut    = $consultar->_ConsultarTiposRutina();
		$cantidadtr  = count($tiposRut);
		$exitotr     = ($cantidadtr>0)?1:0;
		

		//Enviando los datos
		$datos     = array("exister"=>$exister,"tiposRut"=>$tiposRut,
						  "exitom"=>$exitom,"TiposMaquina"=>$maquinas);
		return $datos;
	}//ConsultarInfoEjercicios

	function AgregarEjercicio($Parametros)
	{
		//Tomando los datos que se deben llenar
		$nb_ejercicio   = $Parametros['nb_ejercicio'];
		$desc_ejercicio = $Parametros['desc_ejercicio'];
		$id_tiporutina  = $Parametros['tiporut'];
		$id_maquina     = $Parametros['tipomaquina'];
		//Tomando los datos opcionales
		$id_musculo     = ($Parametros['musculo']!=0)?$Parametros['musculo']:"";
		$maquina        = ($Parametros['maquina']!=0)?$Parametros['maquina']:"";

		//tomando el id del usuario que lo creó.
		
		$id_usuario     = $_SESSION['usuario']['id'];

		//creando el objeto y asignando los valores al objeto de la tabla
		$ejercicio = R::dispense("sgejercicios");
		$ejercicio->id_usuariocreacion = $id_usuario;
		$ejercicio->id_musculo         = $id_musculo; // opcional.
		$ejercicio->id_maquina         = $maquina; // opcional.
		$ejercicio->nb_ejercicio       = $nb_ejercicio;
		$ejercicio->desc_ejercicio     = $desc_ejercicio;
		$ejercicio->id_tiporutina      = $id_tiporutina;
		$ejercicio->sn_activo          = 1;
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = ($respuesta!="Error")?1:0;
		$datos     = array("exito"=>$exito);
		return $datos;
	}//AgregarEjercicio

	function BuscarEjercicioPorId($Parametros)
	{
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		//Buscando información del ejercicio
		$ejercicio = $consultar->_ConsultarEjercicioPorId($id);
		$cantidad  = count($ejercicio);
		$exito     = ($cantidad>0)?1:0;

		//Consultando los tipos de rutina
		$tiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidad  = count($tiposRut);
		$exitor    = ($cantidad>0)?1:0;
		
		//Consultando los tipos de máquinas
		$TipoMaquina  = $consultar->_ConsultarTiposMaquina();
		$cantidadm    = count($TipoMaquina);
		$exitom       = ($cantidadm>0)?1:0;

		//Consultar los musculos por el tipo de rutina.
		$musculos  = $consultar->_ConsultarMusculosPorTipoRutinaId($ejercicio['id_tiporutina']);

		//Consultar Máquina por id
		$maquinas = $consultar->_BuscarMaquinaPorCategoria($ejercicio['id_categoriamaquina']);

		$datos     = array("exito"=>$exito,"ejercicio"=>$ejercicio,"exitor"=>$exitor,
						   "tiposRut"=>$tiposRut,"exitom"=>$exitom,"TipoMaquina"=>$TipoMaquina,
						   "musculos"=>$musculos,"maquinas"=>$maquinas);
		return $datos;
	}//BuscarEjercicioPorId


	function EditarEjercicio($Parametros)
	{
		//Tomando los datos
		$id = $Parametros['id'];
		$ejercicio  = R::load("sgejercicios",$id);
		//Ingresando los valores
		$ejercicio->id_musculo 	   = $Parametros['id_musculo']	 ;
		$ejercicio->id_maquina     = $Parametros['id_maquina']  ;
		$ejercicio->nb_ejercicio   = $Parametros['nb_ejercicio'];
		$ejercicio->desc_ejercicio = $Parametros['desc_ejercicio'];
		$ejercicio->id_tiporutina  = $Parametros['id_tiporutina'];	

		//Guardándolo en Bd
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = ($respuesta!="Error")?1:0;
		$datos     = array("exito"=>$exito);
		return $datos;
	}//EditarEjercicio

	function EliminarEjercicio($Parametros)
	{
		$id         = $Parametros['id'];
		$consultar  = new Consultar();
		//Buscando si hay rutinas relacionadas con este ejercicioso.
		$rutinas    = $consultar->_ConsultarEjerciciosDeRutinas($id);
		$cantidad   = count($rutinas);
		$existenr   = ($cantidad>0)?1:0;
		$exitoelim  = 0;
		$exitoeje   = 0;
		$ejercicios = [];

		if($existenr!=1)
		{
			// si entra aquí es por que no hay rutinas ligadas a este ejercicio.
			// Entonces se procede a dar de baja el ejercicio.
			$ejercicio  = R::load("sgejercicios",$id);
			$ejercicio->sn_activo = 0;
			$respuesta  = EjecutarTransaccion($ejercicio);
			$exitoelim  = ($respuesta!="Error")?1:0; // Se indica que se eliminó correctaente.
			$ejercicios = $consultar->_ConsultarEjercicios();
			$cantidadej = count($ejercicios);
			$exitoeje   = ($cantidadej>0)?1:0; // indica si se traen los ejercicios.
		}//if
		$datos = array("existenr"=>$existenr,"exitoelim"=>$exitoelim,"exitoeje"=>$exitoeje,
					   "ejercicios"=>$ejercicios,"rutinas"=>$rutinas);
		return $datos;
	}//EliminarEjercicio

	function ConsultarRutinasLigadas($Parametros)
	{
		$consultar = new Consultar();
		$id        = $Parametros['id'];
		$rutinas   = $consultar->_ConsultarEjerciciosDeRutinas($id);
		$cantidad  = count($rutinas);
		$exito     = ($cantidad>0)?1:0;
		$datos     = array("rutinas"=>$rutinas,"exito"=>$exito);
		return $datos;
	}//ConsultarRutinasLigadas

	function FiltrarEjerciciosTipoRutina($Parametros)
	{
		$id   	    = $Parametros['id'];
		$consultar  = new Consultar();
		$ejercicios = $consultar->_ConsultarEjerciciosPorTipoRutina($id);
		$cantidad   = count($ejercicios);
		$exito      = ($ejercicios!="Error")?1:0;
		$datos      = array("exito"=>$exito,"ejercicios"=>$ejercicios);
		return $datos;
	}//FiltrarEjerciciosTipoRutina

	function Rutinas($Parametros)
	{
		$consultar = new Consultar();
		//consultar rutinas
		$rutinas   = $consultar->_ConsultarRutinasTotales();
		$cantidad  = count($rutinas);
		$exito     = ($cantidad>0)?1:0;
		
		//consultar tipos de rutinas
		$tipos_rut = $consultar->_ConsultarCategoriaRutinas();
		$cantidadt = count($tipos_rut);
		$exitot    = ($cantidadt>0)?1:0;

		//Consultar géneros de las rutinas
		$generos   = $consultar->_ConsultarGenerosRutina();
		$cantidadg = count($generos);
		$exitog    = ($cantidadg>0)?1:0;
		if($exitog==1)
		{
			//inyectando  la opción todos a la lista de géneros
			$todos = array("id"=>"Todos","nb_tiporutina"=>"Todos");
			array_push($generos,$todos);
		}

		//consultar entrenadores
		$entrenadores = $consultar->_ConsultarEntrenadoresConRutinas();
		$cantidade    = count($entrenadores);
		$exitoe       = ($cantidade>0)?1:0;
		if($exitoe==1)
		{
			//inyectando  la opción todos a la lista de géneros
			$todose = array("id"=>"Todos","nombre"=>"Todos");
			array_push($entrenadores,$todose);
		}

		

		$datos     = array("exito"=>$exito,"rutinas"=>$rutinas,"exitot"=>$exitot,
						   "tipos_rut"=>$tipos_rut,"exitog"=>$exitog,"generos"=>$generos,
						   "exitoe"=>$exitoe,"entrenadores"=>$entrenadores);
		return $datos;
	}//Rutinas

	function BuscarCategoriasPorEntrenador($Parametros)
	{
		$id = $Parametros['id'];
		$consultar = new Consultar();
		//Definiendo el tipo de busqueda
		if($id!="Todos")
		{
			$tipos_rut  = $consultar->_ConsultarCategoriaRutinaPorEntrenador($id);
			$generos    = $consultar->_ConsultarGenerosRutinaPorEntrenador($id);
		}//if
		else
		{
			$tipos_rut = $consultar->_ConsultarCategoriaRutinas();
			$generos   = $consultar->_ConsultarGenerosRutina();
		}

		$cantidad = count($tipos_rut);
		$exito    = ($cantidad>0)?1:0;
		if($exito==1)
		{
			//inyectando  la opción todos a la lista de tipos rutina
			$todos = array("id"=>"Todos","nb_categoriarutina"=>"Todos");
			array_push($tipos_rut,$todos);
		}//if

		$cantidadg = count($generos);
		$exitog    = ($cantidadg>0)?1:0;
		if($exitog==1)
		{
			//inyectando  la opción todos a la lista de géneros
			$todos = array("id"=>"Todos","nb_tiporutina"=>"Todos");
			array_push($generos,$todos);
		}

		//Consultando los rangos de las edades
		$Edades    = $consultar->_ConsultarEdades();
		$cantidade = count($Edades);
		$exitoed   = ($cantidade>0)?1:0;

		if($exitoed==1)
		{
			//inyectando  la opción todos a la lista de géneros
			$todose = array("id"=>"Todos","nb_edad"=>"Todos");
			array_push($Edades,$todose);
		}

		//Consultando los tipos de cuerpos
		$cuerpos   = $consultar->_ConsultarTiposCuerpo();
		$cantidadc = count($cuerpos);
		$exitoc    = ($cantidadc>0)?1:0;

		if($exitoc==1)
		{
			//inyectando  la opción todos a la lista de géneros
			$todose = array("id"=>"Todos","nb_cuerpo"=>"Todos");
			array_push($cuerpos,$todose);
		}

		$datos    = array("exito"=>$exito,"tipos_rut"=>$tipos_rut,"exitog"=>$exitog,
						   "generos"=>$generos,"exitoed"=>$exitoed,"Edades"=>$Edades,
						   "exitoc"=>$exitoc,"cuerpos"=>$cuerpos);
		return $datos;
	}//BuscarCategoriasPorEntrenador

	function FiltrarRutinas($Parametros)
	{
		//Tomando los criterios de búsqueda
		$entrenador  = $Parametros['entrenador'];
		$tipo_rutina = $Parametros['tipo_rutina'];
		$genero 	 = $Parametros['genero'];
		$edad        = $Parametros['edad'];
		$cuerpo      = $Parametros['cuerpo'];

		$consultar   = new Consultar();
		//Obteniendo las rutinas filtradas.
		$rutinas     = $consultar->_ConsultarRutinasFiltradas($entrenador,$tipo_rutina,$genero,$edad,$cuerpo);
		$cantidad    = count($rutinas);
	 	$exito       = ($rutinas!="Error")?1:0;
	 	$datos       = array("exito"=>$exito,"cantidad"=>$cantidad,"rutinas"=>$rutinas);
	 	return $datos;
	}//FiltrarRutinas

	function RutinasAgregarCategorias($Parametros)
	{
		$consultar = new Consultar();
		
		//consultar tipos de rutinas
		$cat_rut = $consultar->_ConsultarCategoriaRutinas();
		$cantidadt = count($cat_rut);
		$exitot    = ($cantidadt>0)?1:0;
		$tiposrutina = array();
		//eliminando la opción todos
		if($exitot==1)
		{	foreach($cat_rut as $key)
			{
				//$key       = array_search('Todos',$tipos_rut);
			 	if($key['nb_categoriarutina']!="Todos")
			 	{
			 		array_push($tiposrutina,$key);
			 	}
			}
			//unset($tipos_rut[$key]);
		}//if
		

		//Consultar géneros de las rutinas
		$generos   = $consultar->_ConsultarGenerosRutina();
		$cantidadg = count($generos);
		$exitog    = ($cantidadg>0)?1:0;
		

		//Consultando los tipos de cuerpos
		$cuerpos   = $consultar->_ConsultarTiposCuerpo();
		$cantidadc = count($cuerpos);
		$exitoc    = ($cantidadc>0)?1:0;

		//Consultando las categorias de las rutinas
		$tiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidadr = count($tiposRut);
		$exitor    = ($cantidadr>0)?1:0;

		//Consultando los rangos de las edades
		$Edades    = $consultar->_ConsultarEdades();
		$cantidade = count($Edades);
		$exitoe    = ($cantidade>0)?1:0;

		$datos     = array("exitot"=>$exitot,"cat_rut"=>$tiposrutina,"exitog"=>$exitog,
						   "generos"=>$generos,"exitoc"=>$exitoc,"cuerpos"=>$cuerpos,
						   "exitor"=>$exitor,"tiposRut"=>$tiposRut,"exitoe"=>$exitoe,
						   "Edades"=>$Edades);
		return $datos;
	}//RutinasAgregarCategorias

	function VerificarRutina($Parametros)
	{
		//Tomando  los criterios de búsqueda
		$nb_rutina = $Parametros['nb_rutina'];
		$categoria = $Parametros['categoria'];
		$cuerpo    = $Parametros['cuerpo'];
		$genero    = $Parametros['genero'];
		//Buscando una rutina con estos criterios
		$rutina    = R::find( 'sgrutinas', 'nb_rutina = ? and id_categoriarutina = ? and id_generorutina=? and id_tipocuerpo= ?', [$nb_rutina,$categoria,$genero,$cuerpo]);
		$cantidad  = count($rutina);
		$exito     = ($cantidad==0)?1:0;
		$datos     = array("exito"=>$exito);
		return $datos;
	}//VerificarRutina

	function AgregarRutina($Parametros)
	{
		//Creando la rutina
		
		date_default_timezone_set("America/Chihuahua");
		$fh_creacion                = date("Y-m-d"); //fecha del día de hoy
		$id_usuario 			    = $_SESSION['usuario']['id'];
		$rutina 				    = R::dispense("sgrutinas");
		$rutina->id_usuariocreacion = $id_usuario;
		$rutina->id_categoriarutina = $Parametros['categoria'];
		$rutina->id_generorutina    = $Parametros['genero'];
		$rutina->id_tipocuerpo      = $Parametros['cuerpo'];
		$rutina->nb_rutina          = $Parametros['nb_rutina'];
		$rutina->desc_rutina        = $Parametros['desc_rutina'];
		$rutina->id_edad 			= $Parametros['genero'];
		$rutina->sn_activo          = 1;
		$rutina->fh_creacion        = $fh_creacion;
		$respuesta 					= EjecutarTransaccion($rutina);
		$exito  					= (is_numeric($respuesta))?1:0;
		$datos 						= array("exito"=>$exito,"id_rutina"=>$respuesta);

		//Guardando en variable de sesión el id de la rutina
		if(is_numeric($respuesta)){$_SESSION['id_rutina'] = $respuesta;}
		return $datos;
	}//AgregarRutina

	function InfoRutinaCompleja($Parametros)
	{
		//Consultando las categorias de las rutinas
		$consultar = new Consultar();
		$tiposRut  = $consultar->_ConsultarTiposDeRutina();
		$cantidadr = count($tiposRut);
		$exitor    = ($cantidadr>0)?1:0;
		$datos     = array("exitor"=>$exitor,"tiposRut"=>$tiposRut);
		return $datos;
	}//InfoRutinaCompleja

	function BuscarEjerciciosPorRutina($Parametros)
	{
		$tipoRutina = $Parametros['id'];
		$consultar  = new Consultar();
		$ejercicios = $consultar->_ConsultarEjerciciosPorTipoRutina($tipoRutina);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"ejercicios"=>$ejercicios);
		return $datos;
	}//BuscarEjerciciosPorRutina

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
			$posicion  = $consultar->_ConsultarPosicionEjercicioRutina($id_rutina);
			$id_posicionejercicio = $posicion['id_posicionejercicio'];
			//creando la variable he ingresando los datos.
			$ejercicioAg = R::dispense("sgejerciciosrutina");
			$ejercicioAg->id_ejercicio  		 = $ejercicio;
			$ejercicioAg->id_dia       		     = $id_dia;
			$ejercicioAg->id_categoriarutina     = $id_CategoriaRutina;
			$ejercicioAg->id_tiporutinaejercicio = $id_TipoRutina;
			$ejercicioAg->id_rutina              = $id_rutina;
			$ejercicioAg->id_usuariocreacion     = $id_usuario;
			$ejercicioAg->id_posicionejercicio   = $id_posicionejercicio;
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

	function RegistrarEjerciciosRutinasEditar($Parametros)
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
			$posicion  = $consultar->_ConsultarPosicionEjercicioRutinaEdit($id_rutina,$id_dia);
			$id_posicionejercicio = $posicion['id_posicionejercicio'];

			if($id_posicionejercicio==0)
			{
				$posicion  = $consultar->_ConsultarPosicionEjercicioRutinaEditDayB($id_rutina,$id_dia);
				$id_posicionejercicio = $posicion['id_posicionejercicio'];
				$id_posicionejercicio = $id_posicionejercicio+1;
			}else{$id_posicionejercicio = $id_posicionejercicio+1;}
			//creando la variable he ingresando los datos.
			$ejercicioAg = R::dispense("sgejerciciosrutina");
			$ejercicioAg->id_ejercicio  		 = $ejercicio;
			$ejercicioAg->id_dia       		     = $id_dia;
			$ejercicioAg->id_categoriarutina     = $id_CategoriaRutina;
			$ejercicioAg->id_tiporutinaejercicio = $id_TipoRutina;
			$ejercicioAg->id_rutina              = $id_rutina;
			$ejercicioAg->id_usuariocreacion     = $id_usuario;
			$ejercicioAg->id_posicionejercicio   = $id_posicionejercicio;
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

	function EjerciciosRutinaOrden($Parametros)
	{
		$id         = $Parametros['id'];
		$consultar  = new Consultar();
		$ejercicios = $consultar->_ConsultarInformacionRutinaPreFinalPorId($id);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"ejercicios"=>$ejercicios);
		return $datos;
	}//EjerciciosRutinaOrden

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
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Hijo);
			$id_EjercicioClienteHijo 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cambiando el valor para ambos, el que fue movido y el hijo.
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Hijo);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteHijo, $id_Cambio);
		}
		else  
		{
			//Caso 2) se tiene que hacer un cambio por la cantidad de espacios recorridos
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id']; //Id del ejercicio a cambairle la posición
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			//Tomando el id desde el último a cambiarse hasta el primero, se hace desde el último para evitar repetidos u otros problemas
			
			$contador = 0;
			//echo "Cambio, no padre más de un espacio";
			for($i=0; $i<$Cantidad_Puestos; $i++)
			{
				$contador++;
				$id_PosicionEjercicioCambiar = $id_Cambio-$contador;
				//Actualizando la posición del ejercicioo del último al primero
				$resulAc=$actualizar -> _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioTemplate($id_Rutina, $id_PosicionEjercicioCambiar);
			
			}//for
			
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Hijo);
			
		} //else

		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinas($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	} //CambioLugarEjercicioSinPadre

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
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Hijo);
			$id_EjercicioClienteHijo 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cambiando el valor para ambos, el que fue movido y el hijo.
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Hijo);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteHijo, $id_Cambio);
		}//if
		else
		{
			//caso 2= cuando la cantidad de puestos que se ha bajado es mayor que 1, se cuenta con padre he hijo.
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id']; //Id del ejercicio a cambairle la posición
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			//echo "ambos, subió posición";
			$Inicio_Cambio = $id_Cambio - 1; //es desde donde se comienza a hacer el ajuste de posiciones.
			$contador 	   = 1; // Donde se da el incremento de posiciones.
			for ($i=0; $i<$Cantidad_Puestos; $i++)
			{
				//Actualizando la posición del ejercicioo del último al primero.
				$resulAc = $actualizar -> _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioTemplate($id_Rutina, $Inicio_Cambio);
				$Inicio_Cambio = $Inicio_Cambio - $contador;
			}//for
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Hijo);
		}//else

		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinas($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	}//ConAmbosSubioPosicion

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
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio   = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			
			//Obtener el id del id_PosicionEjercicio hijo a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Padre);
			$id_EjercicioClienteHijo 	 = $ResultadoIdEjercicioCambiar['id'];
			
			//Cambiando el valor para ambos, el que fue movido y el hijo.
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Padre);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteHijo, $id_Cambio);
		}
		else  
		{
			//Caso 2) se tiene que hace run cambio por la cantidad de espacios recorridos
			
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];

			//Se debe tomar la posición del td que s emovió y sumarle la cantidad de de puestos que se bajó
			//Para ir avanzando se le va restando 1, por cada vez que entra al ciclo y así irá dando los números
			//echo "Cambio, no hijo más de un espacio";
			$contador		 = 0;
			$Posicion_Cambio = $Cantidad_Puestos;
			for($i=0; $i<$Cantidad_Puestos; $i++)
			{
				$contador++;
				$id_PosicionEjercicioCambiar = $id_Cambio+$contador;
				//Actualizando la posición del ejercicioo del último al primero
				$resulAc=$actualizar -> _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaTemp($id_Rutina, $id_PosicionEjercicioCambiar);
				
			}//for
			
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Padre);
			
		} //else
		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinas($id_Rutina,$id_dia);
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
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_EjercicioClienteCambio   = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			
			//Obtener el id del id_PosicionEjercicio padre a intercambiar
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Padre);
			$id_EjercicioClientPadre     = $ResultadoIdEjercicioCambiar['id'];
			
			//Cuando se baja una sola posición en la lista y se tiene, padre he hijo, se hace meramente un intercambio de posiciones tal cual
			//Al que se le movió se le asigna la posición del padre y al pdre se le asigna la posición del que fue movido
			
			// 1)  id que fue movido
			$ResPosicionMovido = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClienteCambio, $id_Padre);
			
			// 2) id del hijo, del id que fue movido
			$ResPosicionHijo   = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_EjercicioClientPadre, $id_Cambio);
		}
		else
		{
			//caso 2= cuando la cantidad de puestos que se ha bajado es mayor que 1, se cuenta con padre he hijo.
			//echo "ambos, bajó posición";
			//Obtener el id del ejercicio que contiene el id_PosicionEjercicio
			$ResultadoIdEjercicioCambiar = $consultar->_ConsultarId_EjercicioPorId_PosicionEjercicio($id_Rutina, $id_Cambio);
			$id_ejercicioRutinaCliente 	 = $ResultadoIdEjercicioCambiar['id'];
			$id_dia 				     = $ResultadoIdEjercicioCambiar['id_dia'];
			
			$Inicio_Cambio = $id_Cambio + 1; //es desde donde se comienza a hacer el ajuste de posiciones.
			$contador 	   = 1; // Donde se da el incremento de posiciones.
			for ($i=0; $i<$Cantidad_Puestos; $i++)
			{
				//Actualizando la posición del ejercicioo del último al primero.
				$resulAc = $actualizar -> _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaTemp($id_Rutina, $Inicio_Cambio);
			 $Inicio_Cambio = $Inicio_Cambio + $contador;
			}//for
			//Actualizando el id_PosicionEjercicio por el del hijo, que solía ser la primera posición
			
			//Cambiarle el id_PosicionEjercicio por el del id_hijo
			$ResPosicionActualiza = $actualizar->_ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_ejercicioRutinaCliente, $id_Padre);
			
		}//else
		
		//trayendo de nuevo los ejercicios 
		$ejercicios = $consultar->_ConsultarInformacionPorRutinaYDiaRutinas($id_Rutina,$id_dia);
		$cantidad   = count($ejercicios);
		$exito      = ($cantidad>0)?1:0;
		$datos      = array("exito"=>$exito,"dia"=>$id_dia,"ejercicios"=>$ejercicios);
		return $datos;
	}//ConAmbosBajoPosicion

	function AgregarRepeticionesEjercicio($Parametros)
	{
		$id_ejercicio     = $Parametros['id_ejercicio'];
		$num_repeticiones = $Parametros['num_repeticiones'];
		$id_rutina 	      = $Parametros['id_rutina'];

		$ejercicio = R::load("sgejerciciosrutina",$id_ejercicio);
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

		$ejercicio = R::load("sgejerciciosrutina",$id_ejercicio);
		$ejercicio->num_circuitos = $num_circuitos;
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = is_numeric($respuesta);
		$datos     = array("exito"=>$exito);
		return $datos;

	}///AgregarCircuitosEjercicio

	function AgregarRelacionEjercicio($Parametros)
	{
		$id_ejercicio = $Parametros['id_ejercicio'];
		$relacion     = $Parametros['relacion'];

		$ejercicio = R::load("sgejerciciosrutina",$id_ejercicio);
		$ejercicio->ejercicio_relacion = $relacion;
		$respuesta = EjecutarTransaccion($ejercicio);
		$exito     = is_numeric($respuesta);
		$datos     = array("exito"=>$exito);
		return $datos;
	}//AgregarRelacionEjercicio

	function EliminarRutina($Parametros)
	{
		$id     = $Parametros['id'];
		$rutina = R::load("sgrutinas",$id);
		$rutina->sn_activo = 0;
		$respuesta = EjecutarTransaccion($rutina);
		$exito     = is_numeric($respuesta)?1:0;

		//Obteniendo todas las rutinas.
		$consultar = new Consultar();
		//consultar rutinas
		$rutinas   = $consultar->_ConsultarRutinasTotales();
		$cantidad  = count($rutinas);
		$exitor    = ($cantidad>0)?1:0;
		$datos     = array("exito"=>$exito,"exitor"=>$exitor,
						   "rutinas"=>$rutinas);
		return $datos;
	}//EliminarRutinaPorId

	function DatosEditarRutina($Parametros)
	{
		$id        =    $Parametros['id'];
		$consultar = new Consultar();
		R::freeze(1);
		R::begin();
		    try{
		      	$rutina = R::getRow( 'select * from sgrutinas where id= ?', [$id] );
		        R::commit();
		    }
		    catch(Exception $e) {
		       $rutina =  R::rollback();
		       $rutina = "Error";
		    }
		R::close();
		$exito = ($rutina!="Error")?1:0;

		//consultar tipos de rutinas
		$cat_rut = $consultar->_ConsultarCategoriaRutinas();
		$cantidadt = count($cat_rut);
		$exitot    = ($cantidadt>0)?1:0;
		$tiposrutina = array();
		//eliminando la opción todos
		if($exitot==1)
		{	foreach($cat_rut as $key)
			{
				//$key       = array_search('Todos',$tipos_rut);
			 	if($key['nb_categoriarutina']!="Todos")
			 	{
			 		array_push($tiposrutina,$key);
			 	}
			}
			//unset($tipos_rut[$key]);
		}//if
		

		//Consultar géneros de las rutinas
		$generos   = $consultar->_ConsultarGenerosRutina();
		$cantidadg = count($generos);
		$exitog    = ($cantidadg>0)?1:0;
		

		//Consultando los tipos de cuerpos
		$cuerpos   = $consultar->_ConsultarTiposCuerpo();
		$cantidadc = count($cuerpos);
		$exitoc    = ($cantidadc>0)?1:0;

		//Consultando las categorias de las rutinas
		$tiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidadr = count($tiposRut);
		$exitor    = ($cantidadr>0)?1:0;

		//Consultando los rangos de las edades
		$Edades    = $consultar->_ConsultarEdades();
		$cantidade = count($Edades);
		$exitoe    = ($cantidade>0)?1:0;

		$datos     = array("exitot"=>$exitot,"cat_rut"=>$tiposrutina,"exitog"=>$exitog,
						   "generos"=>$generos,"exitoc"=>$exitoc,"cuerpos"=>$cuerpos,
						   "exitor"=>$exitor,"tiposRut"=>$tiposRut,"exito"=>$exito,
						   "rutina"=>$rutina,"exitoe"=>$exitoe,"Edades"=>$Edades);
		return $datos;
	}//DatosEditarRutina

	function EditarInfoRutina($Parametros)
	{
		$id 	= $Parametros['id'];
		$rutina = R::load("sgrutinas",$id);
		$rutina->nb_rutina          = $Parametros['nb_rutina'];
		$rutina->desc_rutina        = $Parametros['desc_rutina'];
		$rutina->id_categoriarutina = $Parametros['id_categoriarutina'];
		$rutina->id_generorutina    = $Parametros['id_generorutina'];
		$rutina->id_tipocuerpo      = $Parametros['id_tipocuerpo'];
		$rutina->id_edad 			= $Parametros['id_edad'];
		$respuesta = EjecutarTransaccion($rutina);
		$exito = ($id==$respuesta)?1:0;
		$datos = array("exito"=>$exito);
		return $datos;
	}//EditarInfoRutina	

	function DatosEditarRutinaDias($Parametros)
	{
		//Obteniendo los días de la semana para editar.
		$consultar = new Consultar();
		$dias      = $consultar->_ConsultarDiasSemana();
		$cantidad  = count($dias);
		$exito     = ($cantidad>0)?1:0;
		$datos     = array("exito"=>$exito,"dias"=>$dias);
		return $datos;
	}//DatosEditarRutinaDias

	function DesactivarEjerciciosPorRutina($Parametros)
	{
		$id_rutina    = $Parametros['id_rutina'];
		$DiasEdicion  = $Parametros['DiasEdicion'];
		$CantidadDias = $Parametros['CantidadDias'];
		$actualizar   = new Actualizar();
		$eliminados   = 0;
		//Desactivando los ejercicios de la rutina pertinente	
		for($i=0; $i<$CantidadDias; $i++)
		{
			$id_dia = $DiasEdicion[$i]; //Dia del ejercicio para deshabilitar
			$result = $actualizar->_EliminarEjercicioPorRutinaYDia($id_dia, $id_rutina);
			if($result!="Error"){$eliminados++;}
		}//for
		
		$exito = ($eliminados==$CantidadDias)?1:0;
		$datos = array("exito"=>$exito);
		return $datos;
	}//DesactivarEjerciciosPorRutina

	function BuscarTiposRutinaEdit($Parametros)
	{
		//Buscar los tipos de rutina, evitar poner lade Varios.
		$consultar = new Consultar();
		$TiposRut  = $consultar->_ConsultarTiposRutina();
		$cantidad  = count($TiposRut);
		$exito     = ($cantidad>0)?1:0;
		$offsetdel = ""; //el offset a remover
		if($exito==1)
		{
			for($i=0; $i<$cantidad; $i++)
			{
				$rutina = $TiposRut[$i];
				if($rutina['nb_tiporutina']=="Varios")
				{
					$offsetdel = $i;
					unset($TiposRut[$i]);
				}//if
			}//for
		}//if
		
		$tiposRutFilt = array();
		$cantidadfinal = count($TiposRut);
		for($i=0; $i<$cantidadfinal; $i++)
		{
			if($i!=$offsetdel)
			{
				$tipru = $TiposRut[$i];
				array_push($tiposRutFilt,$tipru);	
			}
			
		}//for

		$datos = array("exito"=>$exito,"TiposRut"=>$tiposRutFilt);
		return $datos;
	}//BuscarTiposRutinaEdit

	function EditarEjerciciosRutinas($Parametros)
	{
		$id = $Parametros['id'];
		$consultar  = new Consultar();
		$agregar    = new Agregar();
		$actualizar = new Actualizar();
		
		
		//Tomar todos los ejercicios de las rutiinas
			$ejercicios	   		= $consultar->_ConsultarInformacionRutinaPreFinalPorId($id);
			$num_ejercicios     = count($ejercicios);
			$resultados         = array();
			//Obtener los datos de la rutina
			for($i=0; $i<$num_ejercicios; $i++)
			{
				$fila = $ejercicios[$i];
				$id_ejercicio    = $fila['id_ejercicio'];

				//Cargando el objeto de la tabla ejercicios
				$ejercicio = R::load("sgejerciciosrutina",$id_ejercicio);
				$id_PosicionEjer = $i+1;
				$ejercicio->id_posicionejercicio = $id_PosicionEjer;
				$respuesta = R::store($ejercicio);
				
				
				if($respuesta!="Error"){$dato = array("agregao"); array_push($resultados,$dato);}
				
			}//for
			
			$cantidad_editados =  count($resultados);
			$exito = ($cantidad_editados==$ejercicios)?1:0;
			$datos = array("exito"=>$exito);
			return $datos;
	}//RegistrarEjerciciosRutinas
	

	// funciones Viejas

	//Apartado de músculos	
	function AgregaMusculo($nb_musculo, $desc_musculo,$id_usuario,$id_TipoRutina)
	{
		$Agregar = new Agregar();
		$result  = $Agregar->_AgregarMusculo($nb_musculo, $desc_musculo,$id_usuario,$id_TipoRutina);
	}//Editarconsejo
	
	
	function EditarMusculo1($nb_musculo, $desc_musculo,$id_usuario, $id_musculo,$id_TipoRutina)
	{
		$actualizar = new Actualizar();
		$result		= $actualizar->_EditarMusculo($nb_musculo, $desc_musculo,$id_usuario, $id_musculo,$id_TipoRutina);
	}//EditarMusculo
	
	function EliminarMusculo1($id_musculo)
	{
		$actualizar = new Actualizar();
		$consultar  = new Consultar();
		
		//Consultar existencia de ejercicios vinculados a este músculo.
		$ResultEjer = $consultar->_ConsultarMusculosAsignadosEjerciciosPorId($id_musculo);
		$num_rows   = $ResultEjer->num_rows;
		
		//si existen más de 0 registros ses por que hay ejercicios vinculados a este músculo.
		if($num_rows>0)
		{
			$Ejercicios   = array();
			$Existente = 1;
			
			for($i=0; $i<$num_rows; $i++)
			{
				$fila = $ResultEjer->fetch_assoc();
				$ejer = array("id"=>$fila['id'],"nb_musculo"=>$fila['nb_musculo'],"nb_ejercicio"=>$fila['nb_ejercicio'],
				"nb_TipoRutina"=>$fila['nb_TipoRutina']);
				array_push($Ejercicios,$ejer);
			}//for
			$salidaJson = 	array("Ejercicios"=>$Ejercicios,"Existente"=>$Existente);
		}//if
		else
		{
			$Existente  = 0;
			$result		= $actualizar->_EliminarMusculo($id_musculo);	
			$salidaJson = array("Existente"=>$Existente);
		}
		
		//$result		= $actualizar->_EliminarMusculo($id_musculo);
		return $salidaJson;
	}//EliminarMusculo
	
	function AgregaTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario)
	{
		$Agregar = new Agregar();
		$result	 = $Agregar->_AgregarTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario);
	}//AgregaTipoRutina
	
	function EditarTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario,$id_TipoRutina)
	{
		$actualizar= new Actualizar();
		$result=$actualizar->_EditarTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario,$id_TipoRutina);
	}//EditarTipoRutina
	
	function EliminarTipoRutina1($id_TipoRutina)
	{
		$actualizar = new Actualizar();
		$consultar  = new Consultar();
		//Verificar existencia de m{usculos ligados al tipo de rutina
		$resMusculos = $consultar->_ConsultarMusculosPorTipoRutinaId($id_TipoRutina);
		$num_rows    = $resMusculos->num_rows;
		
		//Si hay más de 0 es por que existenn músculos ligados a este tipo de rutina.
		if($num_rows>0)
		{
			$musculos  = array();
			$Existente = 1;
			
			for($i=0; $i<$num_rows; $i++)
			{
				$fila 		   = $resMusculos->fetch_assoc();					
				$id_musculo	   = $fila['id'];
				$nb_musculo	   = $fila['nb_musculo'];
				$nb_TipoRutina = $fila['nb_TipoRutina'];
				$musculo 	   = array("id_musculo"=>$id_musculo, "nb_musculo"=>$nb_musculo, "nb_TipoRutina"=>$nb_TipoRutina);	
				array_push($musculos, $musculo);
			}//for
			$salidaJson = 	array("musculos"=>$musculos,"Existente"=>$Existente);				
		}//if
		else
		{
			$Existente  = 0;
			$result     = $actualizar->_EliminarTipoRutina($id_TipoRutina);	
			$salidaJson = array("Existente"=>$Existente);
		}
		
		return $salidaJson;
	}//EliminarTipoRutina
	
	function BuscarRutinasPorMusculo($id_musculo)
	{
		$consultar=new Consultar();
		//Consiguiendo el tipo de rutinas acorde al músculo
		$result=$consultar->_BuscarRutinasPorMusculo($id_musculo);
		$num_rows=$result->num_rows;
		$Rutinas=array();
		for($i=0; $i<$num_rows; $i++)
		{
			$fila=$result->fetch_assoc();
			if($fila['id']!="" && $fila['nb_TipoRutina']!="")
			{
				$rutina=array("id"=>$fila['id'], "nb_TipoRutina"=>$fila['nb_TipoRutina']);	
				array_push($Rutinas, $rutina);
			}//if
			
			if($fila['id']=="" && $fila['nb_TipoRutina']=="")
			{
				$rutina=array("id"=>0, "nb_TipoRutina"=>"No Existe Rutina Para Este músculo");	
				array_push($Rutinas, $rutina);
			}//if
			
		}	//for
		
		
		
		
		$salidaJson=array("Rutinas"=>$Rutinas);
		return $salidaJson;
	}//BuscarRutinasPorMusculo
	
	function AgregaEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina,$id_maquina, $id_usuario)
	{
		$agregar = new Agregar();
		$result  = $agregar->_AgregaEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina,$id_maquina, $id_usuario);
	}//AgregaEjercicio
	
	function EditarEjercicio1($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina, $id_maquina,$id_usuario, $id_Ejercicio)
	{
		$actualizar = new Actualizar();
		$result=$actualizar->_EditarEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina, $id_maquina,$id_usuario, $id_Ejercicio);
	}//EditarEjercicio
	
	function EliminarEjercicio1($id_Ejercicio)
	{
		//Verificando que no haya rutinas registradas con estos ejercicios.
		$consultar = new Consultar();
		$resultCon = $consultar->_ConsultarExistenciaEjerciciosRutinas($id_Ejercicio);
		$num_rows  = $resultCon->num_rows;
		$Existente = 0;
		
		//si hay más de 0 registros es que existen rutinas 
		if($num_rows>0)
		{
			$Rutinas   = array();
			$Existente = 1;
			
			for($i=0; $i<$num_rows; $i++)
			{
				$fila	 	  = $resultCon->fetch_assoc();
				$nb_rutina	  = $fila['nb_rutina'];
				$nb_ejercicio = $fila['nb_ejercicio'];
				$id_Ejercicio = $fila['id_Ejercicio'];
				$categoria    = $fila['categoria'];
				$rutina 	  = array("nb_rutina"=>$nb_rutina, "nb_ejercicio"=>$nb_ejercicio, "id_Ejercicio"=>$id_Ejercicio, "categoria"=>$categoria);	
				array_push($Rutinas, $rutina);
				
			}//for
			
			$salidaJson = 	array("Rutinas"=>$Rutinas,"Existente"=>$Existente);
			
			
		}//if
		else
		{
			//Verificando que existan rutinas asignadas a usuarios con estos ejercicios.
			$resultCon = $consultar->_ConsultarExistenciaEjerciciosRutinasClientes($id_Ejercicio);
			$num_rows  = $resultCon->num_rows;
			$Existente = 0;
			
			$num_rows;
			//si hay más de 0 registros es que existen rutinas 
			if($num_rows>0)
			{
				$Rutinas   = array();
				$Existente = 2;
				for($i=0; $i<$num_rows; $i++)
				{
					$fila	 	  = $resultCon->fetch_assoc();
					$nb_rutina	  = $fila['nb_rutina'];
					$nb_ejercicio = $fila['nb_ejercicio'];
					$id_Ejercicio = $fila['id_Ejercicio'];
					$categoria    = $fila['categoria'];
					$nb_nombre    = $fila['nb_cliente'];
					$nb_apellidos = $fila['nb_apellidos'];
					
					$rutina 	  = array("nb_rutina"=>$nb_rutina, "nb_ejercicio"=>$nb_ejercicio, "id_Ejercicio"=>$id_Ejercicio, 
					"categoria"=>$categoria, "nb_nombre"=>$nb_nombre, "nb_apellidos"=>$nb_apellidos);	
					array_push($Rutinas, $rutina);
					
				}//for+
				$salidaJson = 	array("Rutinas"=>$Rutinas,"Existente"=>$Existente);
			}//if
			else
			{
				//al Entrar aquí significa que no hay ninguna rutina asignada  y se puede eliminar sin ningún problema.
				$actualizar = new Actualizar();
				$result		= $actualizar->_EliminarEjercicio($id_Ejercicio);
				$salidaJson = array("Existente"=>0);
			}//else
		}//else
		$actualizar = new Actualizar();
		
		return $salidaJson;
	}//EliminarEjercicio
	
	function BuscarCategoriaRutinasPorEntrenador($id_entrenador)
	{
		$consultar=new Consultar();
		$result=$consultar->_ConsultarCategoriaRutinasDelEntrenador($id_entrenador); //BUscando las cateogrías de rutinas del instructor
		$num_rows=$result->num_rows; //número de rutinas
		$Categorias=array();
		
		//Tomando las categorías de rutinas y metiéndolas en el array
		for($i=0; $i<$num_rows; $i++)
		{
			$fila=$result->fetch_assoc(); //Tomando row del query.
			$categoria=array("id_categoria"=>$fila['id_categoria'],"nb_CategoriaRutina"=>$fila['nb_CategoriaRutina']);
			array_push($Categorias, $categoria);
		}//for
		
		$salidaJson=array("Categorias"=>$Categorias);
		return $salidaJson;
	}//BuscarCategoriaRutinasPorEntrenador
	
	
	function BuscarCategoriaRutinasGeneral()
	{
		$consultar	= new Consultar();
		$result		= $consultar->_ConsultarCategoriasDeRutinas(); //BUscando las cateogrías de rutinas del instructor
		$num_rows   = $result->num_rows; //número de rutinas
		$Categorias = array();
		
		//Tomando las categorías de rutinas y metiéndolas en el array
		for($i=0; $i<$num_rows; $i++)
		{
			$fila	   = $result->fetch_assoc(); //Tomando row del query.
			$categoria = array("id_categoria"=>$fila['id'],"nb_CategoriaRutina"=>$fila['nb_CategoriaRutina']);
			if($fila['nb_CategoriaRutina'] == "Todos")
			{
				$categoria = array("id_categoria"=>"Todos","nb_CategoriaRutina"=>$fila['nb_CategoriaRutina']);
			}
			array_push($Categorias, $categoria);
		}//for

		// Aquí se añade la categoría "Todos".
		//$categoria=array("id_categoria"=>"Todos","nb_CategoriaRutina"=>"Todos");
		//array_push($Categorias, $categoria);
		
		$salidaJson = array("Categorias"=>$Categorias);
		return $salidaJson;
	}//BuscarCategoriaRutinasGeneral
	
	function BuscarRutinasPorEntrenadorYCategoria($id_entrenador, $id_CategoriaRutina)
	{
		$consultar=new Consultar();
		$result=$consultar->_ConsultarRutinaPorEntrenadorYCategoriaDeRutina($id_entrenador, $id_CategoriaRutina); //Buscando los entrenadores y sus rutinas
		$num_rows=$result->num_rows; //Número rutinas del entrenador por categoría
		$Rutinas=array();
		//Tomando las rutinas y el entrenador
	}
	
	function VerificaExistenciaRutina($nb_rutina, $id_CategoriaRutina)
	{
		$consultar  = new Consultar();
		$result	    = $consultar->_VerificaExistenciaRutina($nb_rutina, $id_CategoriaRutina);
		$num_rows   = $result->num_rows;
		$Cantidad   = ($num_rows>0)?1:0;
		$salidaJson = array("Existencia"=>$Cantidad);
		return $salidaJson;
	}//VerificaExistenciaRutina
	
	function AgregarRutina1($Parametros)
	{
		
		$agregar 			= new Agregar();
		$nb_rutina			= $Parametros['nb_rutina'];
		$id_CategoriaRutina	= $Parametros['id_CategoriaRutina'];			
		$desc_rutina		= $Parametros['desc_rutina'];
		$id_GeneroRutina	= $Parametros['id_GeneroRutina'];
		$id_usuario			= $Parametros['id_usuario'];
		$id_cuerpo			= $Parametros['id_cuerpo'];
		//Tomar la fecha de hoy
			date_default_timezone_set("America/Chihuahua");
			$fh_Creacion = date("Y-m-d"); //fecha del día de hoy		
			$result		 = $agregar->_AgregarRutina($nb_rutina, $id_CategoriaRutina,$desc_rutina,$id_usuario, $fh_Creacion,$id_GeneroRutina,$id_cuerpo);
			$fila		 = $result->fetch_assoc();
			$id_rutina	 = $fila['id_rutina'];
			//Guardar en una variable de sesión la rutina
			$_SESSION['id_rutina']=$id_rutina;
			$salidaJson=array("id_rutina"=>$id_rutina);
			return $salidaJson;
	}//AgregarRutina
	
	function RegistrarEjerciciosRutinas1($id_rutina, $id_usuario,$id_dia,$id_CategoriaRutina, $EjerciciosRutina, $CantidadEjercicios, $id_TipoRutina)
	{
		$agregar=new Agregar();
		$result=$agregar->_RegistrarEjerciciosRutinas($id_rutina, $id_usuario,$id_dia,$id_CategoriaRutina, $EjerciciosRutina, $CantidadEjercicios, $id_TipoRutina);
	}//RegistrarEjerciciosRutinas
	
	function EditarDatosRutina($Parametros)
	{
		$id_rutina	 	 = $Parametros['id_rutina'];
		$nb_rutina	 	 = $Parametros['nb_rutina'];
		$desc_rutina 	 = $Parametros['desc_rutina'];
		$id_GeneroRutina = $Parametros['id_GeneroRutina'];
		$id_cuerpo  	 = $Parametros['id_cuerpo'];
		//Aquí se editan solamente los datos informativos de la rutina, no ejercicios ni nada que afecte la funcionalidad.
		$actualizar = new Actualizar();
		$result		= $actualizar->_EditarDatosRutina($id_rutina,$nb_rutina,$desc_rutina,$id_GeneroRutina,$id_cuerpo);
	}//EditarDatosRutina
	
	
	
	
	function BuscarMaquinasPorCategoria($id_CategoriaMaquina)
	{
		//Aquí se procede a buscar lás máquinas dependiendo la categoría asignada.
		$Consultar = new Consultar();
		$result    = $Consultar->_ConsultarMaquinaPorCategoria($id_CategoriaMaquina);
		$num_rows  = $result->num_rows;
		$Maquinas  = array();
		//Tomando las categorías de rutinas y metiéndolas en el array
		for($i=0; $i<$num_rows; $i++)
		{
			$fila 	   = $result->fetch_assoc(); //Tomando row del query.
			$Maquina   = array("id_maquina"=>$fila['id'],"nb_maquina"=>$fila['nb_maquina']);
			array_push($Maquinas, $Maquina);
		}//for
		
		// Aquí se añade la categoría "Todos".
		$Maquina = array("id_maquina"=>0,"nb_maquina"=>"Ninguna");
		array_push($Maquinas, $Maquina);
		
		$salidaJson = array("Maquinas"=>$Maquinas);
		return $salidaJson;
		
	}//BuscarMaquinasPorCategoria
	
	function BuscarGeneroRutinas($Parametros)
	{
		$id_entrenador = $Parametros['id_entrenador'];
	    $Lista_Rutinas = $Parametros['Lista_Rutinas'];
		$consultar	   = new Consultar();
		
		//Verificando que tipo de acción se toma, si el  género de rutina es todos, se trae sin distinciones.
		if($Lista_Rutinas!="Todos")
		{
			$result   = $consultar->_ConsultarGenerosRutinaPorEntrenadorYTipoRutina($id_entrenador,$Lista_Rutinas);
			$num_rows =	$result->num_rows;
			$generos  = array();
			for($i=0; $i<$num_rows; $i++)
			{
				//Creando el array de géneros obtenidos para devolverlos
				$fila   = $result->fetch_assoc();
				if($fila['nb_TipoRutina']!="")
				{
					$genero = array("id"=>$fila['id'],"nb_TipoRutina"=>$fila['nb_TipoRutina']);
					array_push($generos,$genero);
				}
				
			}//for
			$json_return = array("Generos"=>$generos);	
		}//if
		else
		{
			//Tomando todos los géneros de las rutinas
			$result   = $consultar->_ConsultarGenerosRutinaPorEntrenador($id_entrenador);
			$num_rows =	$result->num_rows;
			$generos  = array();
			for($i=0; $i<$num_rows; $i++)
			{
				//Creando el array de géneros obtenidos para devolverlos
				$fila   = $result->fetch_assoc();
				$genero = array("id"=>$fila['id'],"nb_TipoRutina"=>$fila['nb_TipoRutina']);
				array_push($generos,$genero);
			}//for
			$json_return = array("Generos"=>$generos);	
		}//else
		
		return $json_return;
	}//BuscarGeneroRutinas
	
	
	
?>