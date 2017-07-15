<?php
	class Actualizar
	{

		//Método para el módulo de Rutinas
		function _ActualizarPosicionPorRutinaTemplateEjercicioYValor($id_Rutina,$id_ejercicioRutina, $id_Hijo)
		{
			$query = '
				UPDATE sgejerciciosrutina
				
				set id_posicionejercicio = ? 
				
				where id_Rutina= ? and id= ? ;
			';
			R::freeze(1);
			R::begin();
		    try{
		       $info = R::getRow($query,[$id_Hijo,$id_Rutina,$id_ejercicioRutina]);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $info =  R::rollback();
		       $info = "Error";
		    }

			R::close();
			return $info;
		}//_ActualizarPosicionPorRutinaTemplateEjercicioYValor

		function _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioTemplate($id_rutina,$id_posicion)
		{
			$query= '
			UPDATE sgejerciciosrutina as EjercicioRutina, 
			(
				SELECT 
				Rut.id,
				Rut.id_PosicionEjercicio 
				FROM sgejerciciosrutina  Rut
				where Rut.id_rutina=? and Rut.id_posicionejercicio=? and Rut.sn_activo=1
			) as temp
			SET EjercicioRutina.id_posicionejercicio = temp.id_posicionejercicio+1 
			WHERE EjercicioRutina.id_Rutina=? and EjercicioRutina.id_posicionejercicio=?
			';	
			 R::freeze(1);
			R::begin();
		    try{
		       $info = R::getRow($query,[$id_rutina,$id_posicion,$id_rutina,$id_posicion]);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $info =  R::rollback();
		       $info = "Error";
		    }

			R::close();
			return $info;
		}//_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioTemplate

		//Este método es para el módulo de Clientes
		function _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicio($id_rutina,$id_posicion,$id_dia)
		{
			$query ='
				update sgejerciciosrutinacliente set 
				id_posicionejercicio = id_posicionejercicio+1 
				where id_posicionejercicio <=? and id_rutina = ? and id_dia = ?';
			  R::freeze(1);
			R::begin();
		    try{
		       $info = R::getRow($query,[$id_posicion,$id_rutina,$id_dia]);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $info =  R::rollback();
		       $info = "Error";
		    }

			R::close();
			return $info;
		}//_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicio

		function _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaTemp($id_rutina,$id_posicion)
		{
			$query= '
			UPDATE sgejerciciosrutina as EjercicioRutina, 
			(
				SELECT 
				Rut.id,
				Rut.id_PosicionEjercicio 
				FROM sgejerciciosrutina  Rut
				where Rut.id_rutina=? and Rut.id_posicionejercicio=? and Rut.sn_activo=1
			) as temp
			SET EjercicioRutina.id_posicionejercicio = temp.id_posicionejercicio-1 
			WHERE EjercicioRutina.id_Rutina=? and EjercicioRutina.id_posicionejercicio=?
			';	
			 R::freeze(1);
			R::begin();
		    try{
		       $info = R::getRow($query,[$id_rutina,$id_posicion,$id_rutina,$id_posicion]);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $info =  R::rollback();
		       $info = "Error";
		    }

			R::close();
			return $info;
		}//_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaTemp

		function _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaClie($id_rutina,$id_posicion,$id_dia)
		{
			$query= '
				update sgejerciciosrutinacliente set 
				id_posicionejercicio = id_posicionejercicio-1 
				where id_posicionejercicio >=? and id_rutina = ? and id_dia = ?
			';	
			 R::freeze(1);
			R::begin();
		    try{
		       $info = R::getRow($query,[$id_posicion,$id_rutina,$id_dia]);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $info =  R::rollback();
		       $info = "Error";
		    }

			R::close();
			return $info;
		}//_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioRestaTemp

		function _EliminarEjercicioPorRutinaYDia($id_dia, $id_rutina)
		{
			/*$query='
				UPDATE sg_ejerciciosrutina SET
				sn_activo=0
				WHERE id_Rutina="'.$id_rutina.'" AND id_dia="'.$id_dia.'"
			';*/
			$query=' DELETE FROM sgejerciciosrutina WHERE id_rutina=? AND id_dia= ?';
						
			R::freeze(1);
			R::begin();
		    try{
		       $info = R::getRow($query,[$id_rutina,$id_dia]);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $info =  R::rollback();
		       $info = "Error";
		    }

			R::close();
			return $info;
		}//_EliminarEjercicioPorRutinaYDia

		function _ActualizarPosicionPorRutinaEjercicioYValor($id_Rutina,$id_ejercicio, $id_Hijo)
		{
			$query = '
				UPDATE sgejerciciosrutinacliente
				
				set id_posicionejercicio = ?
				
				where id_rutina=? and id=?;
			';
			$cambio = $this->EjecutarTransaccion3Params($query,$id_Hijo,$id_Rutina,$id_ejercicio);
		}//_ActualizarPosicionPorRutinaEjercicioYValor

		function EjecutarTransaccion3Params($query,$param,$param2,$param3)
		{
			R::freeze(1);
			R::begin();
			    try{
			       $objeto = R::getRow($query,[$param,$param2,$param3]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $objeto =  R::rollback();
			       $objeto = "Error";
			    }
			R::close();
			return $objeto;
		}

		//Este método es para el módulo de Clientes
		function _ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioResta($id_Rutina, $Inicio_Cambio,$id_Padre,$id_dia)
		{
			$query= '
			update sgejerciciosrutinacliente set 
			id_posicionejercicio = id_posicionejercicio-1 
			where id_posicionejercicio >=? and 
			id_posicionejercicio<=? and id_rutina = ?  and id_dia = ? 
			';	
			R::freeze(1);
			R::begin();
			    try{
			       $objeto = R::getRow($query,[$Inicio_Cambio,$id_Padre,$id_Rutina,$id_dia]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $objeto =  R::rollback();
			       $objeto = "Error";
			    }
			R::close();
			return $objeto;
		}//_ActualizarIdPosicionEjercicioPorIdRutinaYidPosicionEjercicioResta

		function _ActualizarIdPosicionEjercicioSubioPosicion($id_rutina,$Inicio_Cambio,$id_hijo,$id_dia)
		{
			$query= '
			update sgejerciciosrutinacliente set 
			id_posicionejercicio = id_posicionejercicio+1 
			where id_posicionejercicio <=? and id_posicionejercicio>=? 
			and id_rutina = ?  and id_dia = ? 
			';	
			R::freeze(1);
			R::begin();
			    try{
			       $objeto = R::getRow($query,[$Inicio_Cambio,$id_hijo,$id_rutina,$id_dia]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $objeto =  R::rollback();
			       $objeto = "Error";
			    }
			R::close();
			return $objeto;
		}//_ActualizarIdPosicionEjercicioSubioPosicion

		function _EliminarRutinaClientePorIdcliente($id,$id_rutina)
		{
			//Eliminando la rutina del cliente para evitar muchos datos innecesarios
			$query='
			DELETE FROM  sgrutinasclientes WHERE id_cliente=?
			';
			
			//Eliminando los ejercicios de las rutinas que se eliminan, para evitar demasiados datos.
			$query2 = '
			DELETE FROM sgejerciciosrutinacliente  WHERE id_rutina = ?
			';	
			$objeto = R::exec($query,[$id]);
			$objeto = R::exec($query2,[$id_rutina]);
			return $objeto;
		}
		//funciones Viejas

		function EliminarUsuario($id)	
		{
			$query='
				UPDATE sg_usuarios set sn_activo=0 where id_usuario="'.$id.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//EliminarUsuario
		
		
		function EditarUsuario($nb_usuario,$nb_apellidos,$de_genero,$num_edad,$de_email,
				$num_telefono,$num_celular,$de_colonia,$de_domicilio,$num_codigoPostal,$Permisos,$pw_password,$nb_nombre,$id_user)
		{
			$query='
				UPDATE sg_usuarios set 
				nb_usuario="'.$nb_usuario.'", 
				nb_apellidos="'.$nb_apellidos.'",
				de_genero="'.$de_genero.'",
				num_edad="'.$num_edad.'",
				de_email="'.$de_email.'",
				num_telefono="'.$num_telefono.'",
				num_celular="'.$num_celular.'",
				de_colonia="'.$de_colonia.'",
				de_domicilio="'.$de_domicilio.'",
				num_codigoPostal="'.$num_codigoPostal.'",
				Permisos="'.$Permisos.'",
				pw_password="'.$pw_password.'",
				nb_nombre="'.$nb_nombre.'"
				
				where id_usuario="'.$id_user.'"
				
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//EditarUsuario
		
		function _Eliminarcliente($id)
		{
			$query='
				UPDATE sg_clientes set sn_activo=0 where id_cliente="'.$id.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}
		
		
		function _EditarCliente($nb_apellidos,$de_genero,$fh_nacimiento,$de_email,
				$num_telefono,$num_celular,$de_colonia,$de_domicilio,$num_codigoPostal,$nb_cliente, $id_cliente,$id_cuerpo)
		{
			$query='
				UPDATE sg_clientes set 
				nb_apellidos="'.$nb_apellidos.'",
				de_genero="'.$de_genero.'",
				fh_nacimiento="'.$fh_nacimiento.'",
				de_email="'.$de_email.'",
				num_telefono="'.$num_telefono.'",
				num_celular="'.$num_celular.'",
				de_colonia="'.$de_colonia.'",
				de_domicilio="'.$de_domicilio.'",
				num_codigoPostal="'.$num_codigoPostal.'",
				nb_cliente="'.$nb_cliente.'",
				id_tipocuerpo = "'.$id_cuerpo.'"
				
				where id_cliente="'.$id_cliente.'"
				
			';
			$conectar = new Conectar();
			$con	  = Conectar::_con();
			$result	  = $con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}
		
		function EditarDatosFormularioPorIdCliente($Condicion_Cardiaca,$Condicion_Pecho,$Condicion_Pecho_reciente,$Condicion_Balance, $Lesion_Fisica, 
				$Medicamentos_Corazon,$Impedimento_Entrenamiento,$Lecturas_Anormales, $Cirujia_Bypass, $Dificultad_Respirar, $Enfermedades_Renales,
				$Arritmia,$Colesterol, $Presion_Alta,$cantidad_Cigarros,$Molestias_Articulaciones,$Molestias_Espalda, $Desayuno_Diario, $Comida_Diaria,
				$Cena_Diaria, $EntreComida_Diaria,$Frecuencia_EntreComida,$Plan_Alimenticio, $Intensidad_Ejercicio,$Intensidad_Ejercicio2,
				$Intensidad_Ejercicio3, $Intensidad_Ejercicio4,$Intensidad_Ejercicio5, $Programa_Ejercicio, $Actividades_deseables, 
				$Actividades_indeseables,$deporte_Frecuente, $Minutos_Dia, $Dias_Semana,$Resultado_Ejercicio,$id_cliente ,$id_instructor)
		{
			$query='
				UPDATE sg_formulario set 
				Condicion_Cardiaca="'.$Condicion_Cardiaca.'",
				Condicion_Pecho="'.$Condicion_Pecho.'",
				Condicion_Pecho_reciente="'.$Condicion_Pecho_reciente.'",
				Condicion_Balance="'.$Condicion_Balance.'",
				Lesion_Fisica="'.$Lesion_Fisica.'",
				Medicamentos_Corazon="'.$Medicamentos_Corazon.'",
				Impedimento_Entrenamiento="'.$Impedimento_Entrenamiento.'",
				Lecturas_Anormales="'.$Lecturas_Anormales.'",
				Cirujia_Bypass="'.$Cirujia_Bypass.'",
				Dificultad_Respirar="'.$Dificultad_Respirar.'",
				Enfermedades_Renales="'.$Enfermedades_Renales.'",
				Arritmia="'.$Arritmia.'",
				Colesterol="'.$Colesterol.'",
				Presion_Alta="'.$Presion_Alta.'",
				cantidad_Cigarros="'.$cantidad_Cigarros.'",
				Molestias_Articulaciones="'.$Molestias_Articulaciones.'",
				Molestias_Espalda="'.$Molestias_Espalda.'",
				Desayuno_Diario="'.$Desayuno_Diario.'",
				Comida_Diaria="'.$Comida_Diaria.'",
				Cena_Diaria="'.$Cena_Diaria.'",
				EntreComida_Diaria="'.$EntreComida_Diaria.'",
				Frecuencia_EntreComida="'.$Frecuencia_EntreComida.'",
				Plan_Alimenticio="'.$Plan_Alimenticio.'",
				Intensidad_Ejercicio="'.$Intensidad_Ejercicio.'",
				Intensidad_Ejercicio2="'.$Intensidad_Ejercicio2.'",
				Intensidad_Ejercicio3="'.$Intensidad_Ejercicio3.'",
				Intensidad_Ejercicio4="'.$Intensidad_Ejercicio4.'",
				Intensidad_Ejercicio5="'.$Intensidad_Ejercicio5.'",
				Programa_Ejercicio="'.$Programa_Ejercicio.'",
				Actividades_deseables="'.$Actividades_deseables.'",
				Actividades_indeseables="'.$Actividades_indeseables.'",
				deporte_Frecuente="'.$deporte_Frecuente.'",
				Minutos_Dia="'.$Minutos_Dia.'",
				Dias_Semana="'.$Dias_Semana.'",
				Resultado_Ejercicio="'.$Resultado_Ejercicio.'"
				
				where id_cliente="'.$id_cliente.'"
			';	
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//EditarDatosFormularioPorIdCliente
		
		function _EditarConsejoPorId($idconsejo, $consejo)
		{
			$query='
				UPDATE sg_consejos set Consejo="'.$consejo.'" where id="'.$idconsejo.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarConsejoPorId
		
		function _EditarMaquinaPorId($nb_maquina, $desc_maquina,$num_maquina, $id_CategoriaMaquina,$id_Maquina)
		{
			$query='
				UPDATE sg_maquinas set
				 nb_maquina			 = "'.$nb_maquina.'", 
				 desc_maquina		 = "'.$desc_maquina.'",
				 num_maquina		 = "'.$num_maquina.'",
				 id_CategoriaMaquina = "'.$id_CategoriaMaquina.'"
				 where id			 = "'.$id_Maquina.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarMaquinaPorId
		
		function _EliminarMaquina($id_Maquina)
		{
			$query='
				UPDATE sg_maquinas set sn_activo=0 where id="'.$id_Maquina.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EliminarMaquina
		
		function _EditarCategoria($nb_CategoriaMaquina, $Desc_CategoriaMaquina, $id_Categoria)
		{
			$query='
				UPDATE sg_categoriamaquina set 
				nb_CategoriaMaquina="'.$nb_CategoriaMaquina.'",
				Desc_CategoriaMaquina="'.$Desc_CategoriaMaquina.'"
				WHERE id="'.$id_Categoria.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarCategoria
		
		function _EliminarCategoria($id_categoria)
		{
			$query='
				UPDATE sg_categoriamaquina set sn_activo=0 where id="'.$id_categoria.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EliminarCategoria
		
		function _EditarMusculo($nb_musculo, $desc_musculo,$id_usuario, $id_musculo, $id_TipoRutina)
		{
			$query='
				UPDATE sg_musculos SET 
				nb_musculo="'.$nb_musculo.'",
				desc_musculo="'.$desc_musculo.'",
				id_TipoRutina="'.$id_TipoRutina.'"
				WHERE id="'.$id_musculo.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarMusculo
		
		function _EliminarMusculo($id_musculo)
		{
			$query='
				UPDATE sg_musculos SET 
				sn_activo=0
				WHERE id="'.$id_musculo.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EliminarMusculo
		
		function _EditarDatosRutina($id_rutina,$nb_rutina,$desc_rutina,$id_GeneroRutina,$id_cuerpo)
		{
			$query='
				UPDATE sg_rutinas SET 
				nb_rutina   	= "'.$nb_rutina.'",
				desc_rutina 	= "'.$desc_rutina.'",
				id_GeneroRutina = "'.$id_GeneroRutina.'",
				id_tipocuerpo   = "'.$id_cuerpo.'"
				WHERE id_rutina ="'.$id_rutina.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarDatosRutina
		
		function _EditarTipoRutina($nb_TipoRutina, $desc_TipoRutina, $id_usuario,$id_TipoRutina)
		{
			$query='
				UPDATE sg_tiposrutina SET
				nb_TipoRutina="'.$nb_TipoRutina.'",
				desc_TipoRutina="'.$desc_TipoRutina.'"
				WHERE id="'.$id_TipoRutina.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarTipoRutina
		
		function _EliminarTipoRutina($id_TipoRutina)
		{
			$query='
				UPDATE sg_tiposrutina SET 
				sn_activo=0
				WHERE id="'.$id_TipoRutina.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EliminarMusculo
		
		function _EditarEjercicio($nb_ejercicio, $desc_ejercicio, $id_musculo, $id_TipoRutina, $id_maquina,$id_usuario, $id_Ejercicio)
		{
			$query='
				UPDATE sg_ejercicios SET
				nb_ejercicio="'.$nb_ejercicio.'",
				desc_ejercicio="'.$desc_ejercicio.'",
				id_musculo="'.$id_musculo.'",
				id_TipoRutina="'.$id_TipoRutina.'",
				id_maquina="'.$id_maquina.'"
				WHERE id="'.$id_Ejercicio.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EditarEjercicio
		
		function _EliminarEjercicio($id_Ejercicio)
		{
			$query='
				UPDATE sg_ejercicios SET 
				sn_activo=0
				WHERE id="'.$id_Ejercicio.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EliminarEjercicio
		
		function _ActualizarNumeroRepeticionesEjercicioPorId($id, $num_Repeticiones)
		{
			 $query='
			 	UPDATE sg_ejerciciosrutina SET
				num_Repeticiones= "'.$num_Repeticiones.'"
			 	WHERE id="'.$id.'"
			 ';
			 $conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarNumeroRepeticionesEjercicioPorId
		
	
		
		function _ActualizarNumeroRepeticionesEjercicioClientePorId($id, $num_Repeticiones)
		{
			 $query='
			 	UPDATE sg_ejerciciosrutinacliente SET
				num_Repeticiones= "'.$num_Repeticiones.'"
			 	WHERE id_ejercicioRutinaCliente="'.$id.'"
			 ';
			 $conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarNumeroRepeticionesEjercicioPorId
		
		function _ActualizarNumeroCircuitosEjercicioPorId($id, $num_Circuito)
		{
			 $query='
			 	UPDATE sg_ejerciciosrutina SET
				num_Circuitos= "'.$num_Circuito.'"
			 	WHERE id="'.$id.'"
			 ';
			 $conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarNumeroRepeticionesEjercicioPorId
		
		function _ActualizarRelacionEjercicios($id_ejercicio, $relacion)
		{
			$query = '
				UPDATE sg_ejerciciosrutina SET
				ejercicio_relacion= "'.$relacion.'"
			 	WHERE id= "'.$id_ejercicio.'"
			';	
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarRelacionEjercicios
		
		function _ActualizarRelacionEjerciciosClientes($id_ejercicio, $relacion)
		{
			$query = '
				UPDATE sg_ejerciciosrutinacliente SET
				ejercicio_relacion= "'.$relacion.'"
			 	WHERE id_ejercicioRutinaCliente= "'.$id_ejercicio.'"
			';	
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarRelacionEjercicios
		
		
		function _ActualizarNumeroCircuitosEjercicioClientePorId($id, $num_Circuito)
		{
			 $query='
			 	UPDATE sg_ejerciciosrutinacliente SET
				num_Circuitos= "'.$num_Circuito.'"
			 	WHERE id_ejercicioRutinaCliente="'.$id.'"
			 ';
			 $conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarNumeroRepeticionesEjercicioPorId
		
		//Este método es para el módulo de rutinas
		
		
		
		
		//Este método es para el módulo de rutinas
		
		
		
		
		
		
		//Método par ael módulo de Clientes
		
		
		function _ActualizarIdPosicionEjercicioIdEjercicio($id_Rutina, $id_ejercicio, $id_PosicionEjercicio)
		{
			$query = '
				update sg_ejerciciosrutina set 
				id_PosicionEjercicio= "'.$id_PosicionEjercicio.'" 
				where id="'.$id_ejercicio.'" and id_Rutina="'.$id_Rutina.'"
			';	
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_ActualizarIdPosicionEjercicioIdEjercicio
		
		function _EliminarRutinaPorId($id)
		{
			$query='
				UPDATE sg_rutinas SET
				sn_activo=0
				WHERE id_rutina="'.$id.'"
			';
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//EliminarRutinaPorId
		
		
		
		function _EliminarRutinaClienteActualPorId($id_rutinaCliente)
		{
			$query='
			UPDATE sg_rutinasclientes SET sn_activo=0
			WHERE id_rutinaCliente="'.$id_rutinaCliente.'"
			';	
			$conectar=new Conectar();
			$con=Conectar::_con();
			$result=$con->query($query)or die("Error en $query ".mysqli_error($query));
			return $result;
		}//_EliminarRutinaClienteActualPorId
		
		
		
	}//ACtualizar
?>