<?php 
	class Agregar
	{
		function _AgregarUsuario($nb_usuario,$nb_apellidos,$de_genero,$num_edad,$de_email,
				$num_telefono,$num_celular,$de_colonia,$de_domicilio,$num_codigoPostal,$Permisos,$pw_password,$nb_nombre)
		{
			$query='
				INSERT INTO sg_usuarios (nb_usuario,nb_apellidos,de_genero,num_edad,de_email,
				num_telefono,num_celular,de_colonia,de_domicilio,num_codigoPostal,Permisos,pw_password,nb_nombre,sn_activo)
				VALUES
				(
					"'.$nb_usuario.'",
					"'.$nb_apellidos.'",
					"'.$de_genero.'",
					"'.$num_edad.'",
					"'.$de_email.'",
					"'.$num_telefono.'",
					"'.$num_celular.'",
					"'.$de_colonia.'",
					"'.$de_domicilio.'",
					"'.$num_codigoPostal.'",
					"'.$Permisos.'",
					"'.$pw_password.'",
					"'.$nb_nombre.'",
					"1"
				)
			';			
			
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;		
		}//	_AgregarUsuario
		
		
		function _AgregarCliente($nb_apellidos,$de_genero,$fh_nacimiento,$de_email,
				$num_telefono,$num_celular,$de_colonia,$de_domicilio,$num_codigoPostal,$nb_nombre,$id_usuario,$id_cuerpo)
		{
			$query='
				INSERT INTO sg_clientes (nb_apellidos,de_genero,fh_nacimiento,de_email,
				num_telefono,num_celular,de_colonia,de_domicilio,num_codigoPostal,nb_cliente,id_usuario_registro,sn_activo,id_tipocuerpo)
				VALUES
				(
					"'.$nb_apellidos.'",
					"'.$de_genero.'",
					"'.$fh_nacimiento.'",
					"'.$de_email.'",
					"'.$num_telefono.'",
					"'.$num_celular.'",
					"'.$de_colonia.'",
					"'.$de_domicilio.'",
					"'.$num_codigoPostal.'",
					"'.$nb_nombre.'",
					"'.$id_usuario.'",
					"1",
					"'.$id_cuerpo.'"
				)
			';			
			
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	
		}//_AgregarCliente
		
		function _AgregarResultadoPrueba($id_instructor, $id_cliente,$tipo_prueba,$desc_prueba, $resultado, $porcentaje,$ResultadoEvaluado)
		{
			date_default_timezone_set("Mexico/General");
			//Verificar si el examen ya se hizo hoy, no se vuelve a aplicar.
			
			//Creando la variable de consulta y trayendo los datos de la última prueba
			$consultar	   = new Consultar();
			$resultPrueba  = $consultar->_ConsultarFechaUltimoBiotest($id_cliente,$tipo_prueba);
			$fila		   = $resultPrueba->fetch_assoc();
			$t			   = date("Y-m-d"); //fecha del día de hoy
			$fechaPrueba   = $fila['fecha'];
			$fechas		   = explode(" ",$fechaPrueba);
			$fechaSinHoras = $fechas[0];
			if($fechaSinHoras<$t)
			{
				
				$query='
					INSERT INTO sg_pruebas (id_instructor,id_cliente,Tipo_Prueba,Desc_Prueba, Resultado, Porcentaje,resultado_numerico)
					VALUES
					(
						"'.$id_instructor.'",
						"'.$id_cliente.'",
						"'.$tipo_prueba.'",
						"'.$desc_prueba.'",
						"'.$resultado.'",
						"'.$porcentaje.'",
						"'.$ResultadoEvaluado.'"
					)
				';
				$conectar=new Conectar();
				$con=Conectar::_con();
				$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
				return $result;	
			}
		}//_AgregarResultadoPrueba
		
		function _AgregarResultadoMultiQuery($id_cliente, $query)
		{
			
			//Creando la variable de consulta y trayendo los datos de la última prueba
			
			//Tuve que agregar aquí la parte donde se hace lo de los arraysy todo por que debía ser en el multiquery 
			//en otro lado de plano no pude.
			
			$arrayResultados  = array();
			$arrayResultados2 = array();
			$consultar		  = new Consultar();
			$resultPrueba  	  = $consultar->_ConsultarFechaUltimoBiotest($id_cliente,4);
			$fila 			  = $resultPrueba->fetch_assoc();
			
			date_default_timezone_set("Mexico/General");
			$t			   = date("Y-m-d"); //fecha del día de hoy
			$fechaPrueba   = $fila['fecha'];
			$fechas		   = explode(" ",$fechaPrueba);
			$fechaSinHoras = $fechas[0];
			
			if($fechaSinHoras<$t)
			{
				$conectar=new Conectar();
				$con=Conectar::_con();
				if($result=$con->multi_query($query))
				{
					while ($con->next_result()) 
					{
						if ($resultset = $con->store_result()) {
							for($i=0; $i<=15; $i++)
							{
								$record = $resultset->fetch_array(MYSQLI_BOTH);
								if($i<=7)
								{
									$fecha=$this->ConvertirTimeStamp($record['fecha']); //Devolviendo un string con la fecha con el método de la línea 148
									$DescPrueba=$record['Desc_Prueba'];
									$ResultadoNumerico=$record['resultado_numerico'];
									$Prueba=array("DescPrueba"=>$DescPrueba,"PorcentResultadoNumericoaje"=>$ResultadoNumerico, "Fecha"=>$fecha);	
									array_push ($arrayResultados,$Prueba); //Los primeros 8 que toma los los actuales
								}
								if($i>=8)
								{
									
									if($record['fecha']!=null){$fecha2=$this->ConvertirTimeStamp($record['fecha']);} else {$fecha2=0;}
									if($record['Desc_Prueba']!=null)$DescPrueba=$record['Desc_Prueba']; else {$DescPrueba=0;}
									if($record['resultado_numerico']!=null){$ResultadoNumerico2=$record['resultado_numerico']; }else {$ResultadoNumerico2=0;}
									if($ResultadoNumerico==true)$ResultadoNumerico=0;
									$Prueba2=array("DescPrueba"=>$DescPrueba,"PorcentResultadoNumericoaje"=>$ResultadoNumerico2, "Fecha"=>$fecha2);	
									array_push ($arrayResultados2,$Prueba2); //Los primeros 8 que toma los los actuales
								}
							}//for
						}//if
					}//while
					//print_r($arrayResultados2);
					session_start();
					//print_r($arrayResultados);
					//print_r($arrayResultados2);
					$_SESSION['arrayResultados']  = $arrayResultados;
					$_SESSION['arrayResultados2'] = $arrayResultados2;
				}//if
				else
				{	
					
				}
				return $result;	
			}
		}
		
		function _AgregarRegistroBitacoraBiotest($id_UsuarioCreacion, $id_cliente)
		{
			date_default_timezone_set("Mexico/General");
			$fecha_actual = date("Y-m-d"); //fecha del día de hoy
			
			$query='
				INSERT INTO sg_biotestbitacora (id_UsuarioCreacion,id_cliente, fh_creacion) 
				values(
					"'.$id_UsuarioCreacion.'",
					"'.$id_cliente.'",
					"'.$fecha_actual.'"
				)
			';
			$conectar=new Conectar();
				$con=Conectar::_con();
				$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
				return $result;	
		}//_AgregarRegistroBitacoraBiotest
		
		function _AgregarDatosFormularioSalud($Condicion_Cardiaca,$Condicion_Pecho,$Condicion_Pecho_reciente,$Condicion_Balance, $Lesion_Fisica, $Medicamentos_Corazon,
		$Impedimento_Entrenamiento,$Lecturas_Anormales, $Cirujia_Bypass, $Dificultad_Respirar, $Enfermedades_Renales,$Arritmia,$Colesterol, $Presion_Alta,
		$cantidad_Cigarros,$Molestias_Articulaciones,$Molestias_Espalda, $Desayuno_Diario, $Comida_Diaria, $Cena_Diaria, $EntreComida_Diaria,
		$Frecuencia_EntreComida,$Plan_Alimenticio, $Intensidad_Ejercicio,$Intensidad_Ejercicio2,$Intensidad_Ejercicio3, $Intensidad_Ejercicio4,
		$Intensidad_Ejercicio5, $Programa_Ejercicio, $Actividades_deseables, $Actividades_indeseables,$deporte_Frecuente, $Minutos_Dia, $Dias_Semana,
		$Resultado_Ejercicio,$id_cliente ,$id_instructor)
		{
			echo "yo yo";
			$query='
				INSERT INTO sg_formulario (Condicion_Cardiaca,Condicion_Pecho,Condicion_Pecho_reciente,Condicion_Balance, Lesion_Fisica, Medicamentos_Corazon,
				Impedimento_Entrenamiento,Lecturas_Anormales, Cirujia_Bypass, Dificultad_Respirar, Enfermedades_Renales,Arritmia,Colesterol, Presion_Alta,
				cantidad_Cigarros,Molestias_Articulaciones,Molestias_Espalda, Desayuno_Diario, Comida_Diaria, Cena_Diaria, EntreComida_Diaria,
				Frecuencia_EntreComida,Plan_Alimenticio, Intensidad_Ejercicio,Intensidad_Ejercicio2,Intensidad_Ejercicio3, Intensidad_Ejercicio4,
				Intensidad_Ejercicio5, Programa_Ejercicio, Actividades_deseables, Actividades_indeseables,deporte_Frecuente, Minutos_Dia, Dias_Semana,
				Resultado_Ejercicio,id_cliente ,id_instructor)
				VALUES(
				"'.$Condicion_Cardiaca.'",
				"'.$Condicion_Pecho.'",
				"'.$Condicion_Pecho_reciente.'",
				"'.$Condicion_Balance.'", 
				"'.$Lesion_Fisica.'",
				"'.$Medicamentos_Corazon.'",
				"'.$Impedimento_Entrenamiento.'",
				"'.$Lecturas_Anormales.'", 
				"'.$Cirujia_Bypass.'",
				"'.$Dificultad_Respirar.'",
				"'.$Enfermedades_Renales.'",
				"'.$Arritmia.'",
				"'.$Colesterol.'", 
				"'.$Presion_Alta.'",
				"'.$cantidad_Cigarros.'",
				"'.$Molestias_Articulaciones.'",
				"'.$Molestias_Espalda.'",
				"'.$Desayuno_Diario.'",
				"'.$Comida_Diaria.'",
				"'.$Cena_Diaria.'",
				"'.$EntreComida_Diaria.'",
				"'.$Frecuencia_EntreComida.'",
				"'.$Plan_Alimenticio.'", 
				"'.$Intensidad_Ejercicio.'",
				"'.$Intensidad_Ejercicio2.'",
				"'.$Intensidad_Ejercicio3.'",
				"'.$Intensidad_Ejercicio4.'",
				"'.$Intensidad_Ejercicio5.'",
				"'.$Programa_Ejercicio.'",
				"'.$Actividades_deseables.'",
				"'.$Actividades_indeseables.'",
				"'.$deporte_Frecuente.'",
				"'.$Minutos_Dia.'",
				"'.$Dias_Semana.'",
				"'.$Resultado_Ejercicio.'",
				"'.$id_cliente.'",
				"'.$id_instructor.'"	
				);
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	
		}//_AgregarDatosFormularioSalud
		
		
		function _AgregarNuevaMaquina($nb_maquina, $desc_maquina,$num_maquina, $id_CategoriaMaquina)
		{
			
			$query='
				INSERT INTO sg_maquinas (nb_maquina,desc_maquina,num_maquina, id_CategoriaMaquina )
				values(
					"'.$nb_maquina.'",
					"'.$desc_maquina.'",
					"'.$num_maquina.'",
					"'.$id_CategoriaMaquina.'"
				);
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	

		}//_AgregarNuevaMaquina
		
		function _AgregarCategoria($id_usuario,$nb_CategoriaMaquina, $Desc_CategoriaMaquina)
		{
			$query='
				INSERT INTO sg_categoriamaquina (nb_CategoriaMaquina, Desc_CategoriaMaquina, sn_activo, id_UsuarioRegistro)
				values (
					"'.$nb_CategoriaMaquina.'",
					"'.$Desc_CategoriaMaquina.'",
					"'.$id_usuario.'",
					"1"
				);
			';	
			
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	
		}//_AgregarCategoria
		
		function _AgregarMusculo($nb_musculo, $desc_musculo,$id_usuario,$id_TipoRutina)
		{
			$query='
				INSERT INTO sg_musculos (nb_musculo, desc_musculo, id_usuario_creacion,id_TipoRutina, sn_activo)
				VALUES(
					"'.$nb_musculo.'",
					"'.$desc_musculo.'",
					"'.$id_usuario.'",
					"'.$id_TipoRutina.'",
					"1"
				);
			';
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	
		}//_AgregarMusculo	
		
		function _AgregarTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario)
		{
			$query='
				INSERT INTO sg_tiposrutina (nb_TipoRutina,desc_TipoRutina, id_UsuarioRegistro, sn_activo)
				values(
					"'.$nb_TipoRutina.'",
					"'.$desc_TipoRutina.'",
					"'.$id_usuario.'",
					"1"
				);
			';
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	
		}//_AgregarTipoRutina
		
		function _AgregaEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina, $id_maquina, $id_usuario)
		{
			$query='
				INSERT INTO sg_ejercicios (nb_ejercicio, desc_ejercicio, id_musculo,id_TipoRutina, id_maquina, id_UsuarioCreacion,sn_activo)
				VALUES(
					"'.$nb_ejercicio.'",
					"'.$desc_ejercicio.'",
					"'.$id_musculo.'",
					"'.$id_TipoRutina.'",
					"'.$id_maquina.'",
					"'.$id_usuario.'",
					"1"
				);
			';	
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;	
		}//_AgregaEjercicio
		
		function _AgregarRutina($nb_rutina, $id_CategoriaRutina,$desc_rutina,$id_usuario, $fh_Creacion,$id_GeneroRutina,$id_cuerpo)
		{
			//Insertando la rutina en la BD
			$query='
				INSERT INTO sg_rutinas (nb_rutina, id_CategoriaRutina,desc_rutina,id_UsuarioCreacion, fh_Creacion,id_GeneroRutina,id_tipocuerpo,sn_activo)
				VALUES(
					"'.$nb_rutina.'",
					"'.$id_CategoriaRutina.'",
					"'.$desc_rutina.'",
					"'.$id_usuario.'",
					"'.$fh_Creacion.'",
					"'.$id_GeneroRutina.'",
					"'.$id_cuerpo.'",
					"1"
				);
			';
			$con=Conectar::_con();
			$resultAgregar=$con->query($query)or die("Error en $query ".mysqli_error($query));
			
			//Buscando la información de la rutina recien agregada
			$consultar=new Consultar();
			$result=$consultar->_ConsultarRutinaPorNombreYCategoria($nb_rutina, $id_CategoriaRutina);
			return $result;
		}//_AgregarRutina
		
		function _AgregarRutinaCliente($nb_rutina, $id_CategoriaRutina,$desc_rutina,$id_usuario, $fh_Creacion,$id_cliente,$id_cuerpo)
		{
			//Buscando la rutina actual del cliente
			$consultar  = new Consultar();
			$actualizar = new Actualizar();
			
			$resultRutinaActual = $consultar->_ConsultarInfoRutinaVigenteClientePorId($id_cliente);
			$num_rutinas		= $resultRutinaActual->num_rows; //Verificando si existen rutinas vigentes para ese cliente.
			if($num_rutinas>0) //es es mayor que 0 entonces hay una rutina vigente, se da de baja y se agrega la actual.
			{
				$filaRutinaActual = $resultRutinaActual->fetch_assoc();
				$id_rutinaCliente = $filaRutinaActual['id_rutinaCliente'];
				//Dando de baja la rutina actual
				$resultRutinaBaja = $actualizar->_EliminarRutinaClienteActualPorId($id_rutinaCliente);
			}
			
			
			//Insertando la rutina en la BD
			$query='
				INSERT INTO sg_rutinasclientes (nb_rutina, id_CategoriaRutina,desc_rutina,id_UsuarioCreacion, fh_Creacion,id_cliente,id_tipocuerpo,sn_activo)
				VALUES(
					"'.$nb_rutina.'",
					"'.$id_CategoriaRutina.'",
					"'.$desc_rutina.'",
					"'.$id_usuario.'",
					"'.$fh_Creacion.'",
					"'.$id_cliente.'",
					"'.$id_cuerpo.'",
					"1"
				);
			';
			$con 		   = Conectar::_con();
			$resultAgregar = $con->query($query)or die("Error en $query ".mysqli_error($query));
			
			//Buscando la información de la rutina recien agregada
			$resultRutina=$consultar->_ConsultarRutinaClientePorIdEntrenadorYNombreRutina($id_usuario, $nb_rutina);
			return $resultRutina;
		}//_AgregarRutina
			
		function _RegistrarEjerciciosRutinas($id_rutina, $id_usuario,$id_dia,$id_CategoriaRutina, $EjerciciosRutina, $CantidadEjercicios ,$id_TipoRutina)
		{
			$consultar = new Consultar();
			//Insertando todos los ejercicios a la BD
			for($i=0; $i<$CantidadEjercicios; $i++)
			{
				//tomando la última posición del ejercicio de la rutina
				$resPosicionEjercicio = $consultar->_ConsultarPosicionEjercicioRutina($id_rutina);
				$filaPosicion = $resPosicionEjercicio->fetch_assoc();
				$id_PosicionEjercicio = $filaPosicion['id_PosicionEjercicio'];
				
				$id_Ejercicio=$EjerciciosRutina[$i];
				$query='
				INSERT INTO sg_ejerciciosrutina (id_Ejercicio,id_UsuarioCreacion, id_dia, id_Rutina, id_CategoriaRutina,id_TipoRutinaEjercicio	 ,id_PosicionEjercicio)
				values(
					"'.$id_Ejercicio.'",
					"'.$id_usuario.'",
					"'.$id_dia.'",
					"'.$id_rutina.'",
					"'.$id_CategoriaRutina.'",
					"'.$id_TipoRutina.'",
					"'.$id_PosicionEjercicio.'"
				);
			';
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			}//for
			
			return $result;	
		}//RegistrarEjerciciosRutinas
		
		
		function _RegistrarEjerciciosRutinasClientes($id_rutina, $id_usuario,$id_dia,$id_CategoriaRutina, $EjerciciosRutina, $CantidadEjercicios ,$id_TipoRutina)
		{
			$consultar = new Consultar();
			
			//Insertando todos los ejercicios a la BD
			for($i=0; $i<$CantidadEjercicios; $i++)
			{
				//tomando la última posición del ejercicio de la rutina
				$resPosicionEjercicio = $consultar->_ConsultarPosicionEjercicioRutinaCliente($id_rutina);
				$filaPosicion = $resPosicionEjercicio->fetch_assoc();
				$id_PosicionEjercicio = $filaPosicion['id_PosicionEjercicio'];
				
				$id_Ejercicio=$EjerciciosRutina[$i];
				$query='
				INSERT INTO sg_ejerciciosrutinacliente (id_Ejercicio,id_UsuarioCreacion, id_dia, id_Rutina, id_CategoriaRutina,id_TipoRutinaEjercicio,id_PosicionEjercicio)
				values(
					"'.$id_Ejercicio.'",
					"'.$id_usuario.'",
					"'.$id_dia.'",
					"'.$id_rutina.'",
					"'.$id_CategoriaRutina.'",
					"'.$id_TipoRutina.'",
					"'.$id_PosicionEjercicio.'"
				);
			';
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			}//for
			
			return $result;	
		}//RegistrarEjerciciosRutinas
		
		function _RegistrarEjerciciosRutinaClienteIndividual($id_Ejercicio,$id_instructor,$id_dia, $id_Rutina, $id_CategoriaRutinaEj, $id_TipoRutinaEjercicio, $num_Circuitos, $num_Repeticiones,$id_PosicionEjercicio,$ejercicio_relacion)
		{
			//Esta función se llama para registrar los ejercicios de las rutinas.
			$query='
				INSERT INTO sg_ejerciciosrutinacliente (id_Ejercicio,id_UsuarioCreacion,id_dia,id_Rutina,id_CategoriaRutina,id_TipoRutinaEjercicio,num_Circuitos,num_Repeticiones, id_PosicionEjercicio,ejercicio_relacion, sn_activo)
				VALUES (
					"'.$id_Ejercicio.'",
					"'.$id_instructor.'",
					"'.$id_dia.'",
					"'.$id_Rutina.'",
					"'.$id_CategoriaRutinaEj.'",
					"'.$id_TipoRutinaEjercicio.'",
					"'.$num_Circuitos.'",
					"'.$num_Repeticiones.'",
					"'.$id_PosicionEjercicio.'",
					"'.$ejercicio_relacion.'",
					"1"
				);
			';
			//echo $query;
			$con 	= Conectar::_con();
			$result = $con->query($query)or die("Error en $query ".mysqli_error($query));
		}//_RegistrarEjerciciosRutinaClienteIndividual
		
		function _RegistrarEjerciciosRutinaClienteAsignacion($ejercicios)
		{
			//Recorriendo el array uno por uno.
			foreach ($ejercicios as $ejercicio)
			{
				//Tomar los datos del array
				$id_Ejercicio 			= $ejercicio['id_Ejercicio'];
				$id_dia 				= $ejercicio['id_dia']; 
				$id_Rutina 				= $ejercicio['id_Rutina'];
				$id_CategoriaRutinaEj 	= $ejercicio['id_CategoriaRutinaEj'];
				$id_TipoRutinaEjercicio = $ejercicio['id_TipoRutinaEjercicio'];
				$id_PosicionEjercicio 	= $ejercicio['id_PosicionEjercicio'];
				$num_Circuitos	  	  	= $ejercicio['num_Circuitos']; 
				$num_Repeticiones 	  	= $ejercicio['num_Repeticiones']; 
				$id_instructor			= $ejercicio['id_instructor'];
				$ejercicio_relacion	    = $ejercicio['ejercicio_relacion'];
				//Guardando en la tabla de sg_ejerciciosrutinacliente los ejercicios.
				$this->_RegistrarEjerciciosRutinaClienteIndividual($id_Ejercicio,$id_instructor,$id_dia, $id_Rutina, $id_CategoriaRutinaEj, 	$id_TipoRutinaEjercicio, $num_Circuitos, $num_Repeticiones,$id_PosicionEjercicio,$ejercicio_relacion);
				//print_r($ejercicio);
			}
			
			//$con 	= Conectar::_con();
			//$result = $con->query($query)or die("Error en $query ".mysqli_error($query));
		}//_RegistrarEjerciciosRutinaClienteAsignacion
			
	function ConvertirTimeStamp($time) //función para devolver un string de la fecha a partir de una time stamp de mysql
	{
		//Quitando las horas y minutos
		$fechas=explode(" ",$time);
		$fechaSinHoras=$fechas[0];
		//Seperando los elementos de año, mes y día.
		$ElementosFecha=explode("-",$fechaSinHoras);
		$year=$ElementosFecha[0];
		@$month=$ElementosFecha[1];
		@$day=$ElementosFecha[2];
		$mes="";
		//Asignando el nombre del mes correspondiente
			if($month==1)$mes="Enero";
			if($month==2)$mes="Febrero";
			if($month==3)$mes="Marzo";
			if($month==4)$mes="Abril";
			if($month==5)$mes="Mayo";
			if($month==6)$mes="Junio";
			if($month==7)$mes="Julio";
			if($month==8)$mes="Agosto";
			if($month==9)$mes="Septiembre";
			if($month==10)$mes="Octubre";
			if($month==11)$mes="Noviembre";
			if($month==12)$mes="Diciembre";	
		
		//Devolviendo el string de la fecha adecuado.
		$Fechafinal=$day." de ".$mes." de ".$year;
		return $Fechafinal;
	}
		
		
	
}//Agregar
	
?>