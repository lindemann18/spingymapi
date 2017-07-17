<?php 
	class Consultar
	{

		//Queries de Utilidades


		function _ConsultartiposPruebas()
		{
			R::begin();
			    try{
			       $Pruebas = R::getAll('SELECT * FROM sgtipospruebas  ORDER BY id ASC');
			        R::commit();
			    }
			    catch(Exception $e) {
			       $Pruebas =  R::rollback();
			    }
			R::close();
			return $Pruebas;
		}//_ConsultartiposPruebas

	

		function _ConsultarEdades()
		{
			R::begin();
			    try{
			    	$query = '
						SELECT * from sgedad;
			    	';
			       $cat = R::getAll($query);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $cat =  R::rollback();
			       $cat = "error";
			    }
			R::close();
			return $cat;
		}//_ConsultarEdades

		function _ConsultarCuerposPorNombre($name)
		{
			$query     = 'select * from sgtipocuerpo where nb_cuerpo = ?';
			$respuesta = $this->EjecutarTransaccionSinglerow($query,$name);
			return $respuesta;
		}//_ConsultarCuerposPorNombre


		// VA en Ejercicios
		function _ConsultarEjerciciosDeRutinas($id)
		{
			$query = '
			select DISTINCT
			eje.nb_ejercicio,
			eje.desc_ejercicio,
			rut.nb_rutina,
			rut.desc_rutina,
			ejeru.id_ejercicio

			from sgrutinas rut

			LEFT JOIN sgejerciciosrutina ejeru
			ON  rut.id = ejeru.id_rutina

			LEFT JOIN sgejercicios eje
			ON eje.id  = ejeru.id_ejercicio

			WHERE ejeru.id_ejercicio =?  AND ejeru.sn_activo = 1 AND rut.sn_activo=1
			';
			$respuesta = $this->EjecutarTransaccionAll($query,$id);
			return $respuesta;
		}//_ConsultarEjerciciosDeRutinas


		//Querys de clientes

		function _ConsultarClientesPorEntrenador($id)
		{
			$condicion = ($id!="Todos")?"AND clientes.id_usuario_registro = ?":"";

			$query = '
				SELECT
				clientes.id,
				clientes.nb_cliente,
				clientes.nb_apellidos,
				clientes.de_email,
				clientes.num_celular,
				usuarios.nb_nombre as "Ins_nombre", 
				usuarios.nb_apellidos as "Ins_apellido" 
				FROM sgclientes clientes
				left join sgusuarios  usuarios on clientes.id_usuario_registro=usuarios.id
				where clientes.sn_activo=1 '.$condicion.'
				ORDER BY clientes.id ASC
			';
			R::begin();
			    try{
			       $respuesta = R::getAll($query,[$id]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $respuesta =  R::rollback();
			       $respuesta = "Error";
			    }
			R::close();
			$respuesta = $this->EjecutarTransaccionAll($query,$id);
			return $respuesta;
		}///_ConsultarClientesPorEntrenador


	function _ConsultarRutinasClientesPorIdCliente($id_cliente)
	{
		$query='
			select * from sgrutinasclientes where id_cliente =? and sn_activo=1
		';
		R::begin();
			    try{
			       $respuesta = R::getRow($query,[$id_cliente]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $respuesta =  R::rollback();
			       $respuesta = "Error";
			    }
		return $respuesta;;
	}//_ConsultarRutinasClientesPorIdCliente

		//Queries de rutinas
	

	function _ConsultarCategoriaRutinaPorEntrenador($id)
	{
		$query= '
		select DISTINCT
		cat.id,
		nb_categoriarutina
		from sgcategoriasrutina cat

		LEFT JOIN sgrutinas rut ON
		rut.id_categoriarutina = cat.id

		LEFT JOIN sgusuarios usu ON
		rut.id_usuariocreacion = usu.id

		where usu.id=? AND rut.sn_activo = 1
		';
		$categorias = $this->EjecutarTransaccionAll($query,$id);
		return $categorias;
	}//_ConsultarCategoriaRutinaPorEntrenador

	function _ConsultarGenerosRutinaPorEntrenador($id)
	{
		$query = '
				SELECT DISTINCT
				Gen.nb_tiporutina,
				Gen.id

				FROM sggenerosrutina Gen

				left JOIN sgrutinas Rut
				on Rut.id_generorutina = Gen.id

				WHERE Rut.id_usuariocreacion=1

				ORDER BY Gen.id
		';	
		//echo $query;
		$generos = $this->EjecutarTransaccionAll($query,$id);
		return $generos;
	}//_ConsultarGenerosRutinaPorEntrenador

	function _ConsultarRutinasFiltradas($entrenador,$tipo_rutina,$genero,$edad,$cuerpo)
	{
		//definiendo las condiciones			
		$condicionent = ($entrenador!="Todos")?"AND Rut.id_usuariocreacion =".$entrenador." ":"";
		$condiciontip = ($tipo_rutina!="Todos")?"AND Rut.id_categoriarutina =".$tipo_rutina." ":"";
		$condiciongen = ($genero!="Todos")?"AND Rut.id_generorutina =".$genero." ":"";
		$condicioned  = ($edad!="Todos")?"AND Rut.id_edad =".$edad." ":"";
		$condicioncue = ($cuerpo!="Todos")?"AND Rut.id_tipocuerpo =".$cuerpo." ":"";

		//Este querie devuelve TODAS las rutinas ordenadas de principiante hasta avanzado.
		$query = '
		SELECT
		Rut.id as id_rutina,
		Rut.nb_rutina,
		Rut.desc_rutina,
		Rut.fh_creacion,
		Usu.nb_nombre,
		Usu.nb_apellidos,
		Cat.nb_categoriarutina,
		Gen.id as id_genero,
		Gen.nb_tiporutina,
		cuerpo.id as id_cuerpo,
		cuerpo.nb_cuerpo,
		edad.nb_edad
		FROM sgrutinas Rut
		left JOIN sgusuarios Usu
		ON Usu.id=Rut.id_usuariocreacion
		left JOIN sgcategoriasrutina Cat
		ON Cat.id=Rut.id_categoriarutina
		LEFT JOIN sggenerosrutina Gen
		ON Gen.id= Rut.id_generorutina
		LEFT JOIN sgtipocuerpo cuerpo
		ON cuerpo.id = Rut.id_tipocuerpo
		LEFT JOIN sgedad edad
		ON edad.id = Rut.id_edad
		where  Rut.sn_activo=1   
		'.$condicionent.'
		'.$condiciontip.'
		'.$condiciongen.'
		'.$condicioned.'
		'.$condicioncue.'
		order by id_rutina asc
		';
		R::freeze(1);	
		R::begin();
	    try{
	       $rutinas = R::getAll($query);
	        R::commit();
	    }
	    catch(Exception $e) {
	       $rutinas =  R::rollback();
	       $rutinas = "Error";
	    }
	R::close();
	return $rutinas;
	}//_ConsultarRutinasFiltradas

	function _ConsultarTiposCuerpo()
	{
		$query='SELECT id,nb_cuerpo from sgtipocuerpo';
		$cuerpos = $this->EjecutarTransaccionAllNoParams($query);
		return $cuerpos;
	}//_ConsultarTiposCuerpo
	

	// ya existe uno, de momento parece sin uso.
	function _ConsultarTiposDeRutina()
	{
		$query="
			SELECT
			TR.id,
			TR.nb_tiporutina,
			TR.desc_tiporutina,
			US.nb_nombre,
			US.nb_apellidos
			from sgtiposrutina TR
			LEFT JOIN sgusuarios US
			ON US.id=TR.id_UsuarioRegistro
			WHERE TR.sn_activo=1 and TR.nb_tiporutina !='Varios'
		";	
		$tipos_rut = $this->EjecutarTransaccionAllNoParams($query);
		return $tipos_rut;
	}//_ConsultarTiposDeRutina

	function _ConsultarPosicionEjercicioRutina($id_rutina)
	{
		 $query = '
			select IFNULL(MAX(id_posicionejercicio+1),1) as "id_posicionejercicio" 
			from sgejerciciosrutina where id_rutina = ?
		';
		$posicion = $this->EjecutarTransaccionSinglerow($query,$id_rutina);
		return $posicion;
	}//_ConsultarPosicionEjercicioRutina

	function _ConsultarPosicionEjercicioRutinaCliente($id_rutina)
	{
		 $query = '
			select IFNULL(MAX(id_posicionejercicio+1),1) as "id_posicionejercicio" 
			from sgejerciciosrutinacliente where id_rutina = ?
		';
		$posicion = $this->EjecutarTransaccionSinglerow($query,$id_rutina);
		return $posicion;
	}//_ConsultarPosicionEjercicioRutina

	function _ConsultarPosicionEjercicioRutinaEdit($id_rutina,$id_dia)
	{
		 $query = '
			select IFNULL(MAX(id_posicionejercicio),0) as "id_posicionejercicio" 
			from sgejerciciosrutina where id_rutina = ? AND id_dia= ?
		';

		R::begin();
			    try{
			       $posicion = R::getRow($query,[$id_rutina,$id_dia]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $posicion =  R::rollback();
			       $posicion = "Error";
			    }
			R::close();
			return $posicion;
	}//_ConsultarPosicionEjercicioRutina

	function _ConsultarPosicionEjercicioRutinaEditDayB($id_rutina,$id_dia)
	{
		 $query = '
			select IFNULL(MAX(id_posicionejercicio),0) as "id_posicionejercicio" 
			from sgejerciciosrutina where id_rutina = ? AND id_dia= ?-1
		';
		R::begin();
			    try{
			       $posicion = R::getRow($query,[$id_rutina,$id_dia]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $posicion =  R::rollback();
			       $posicion = "Error";
			    }
			R::close();
			return $posicion;
	}//_ConsultarPosicionEjercicioRutina

	function _ConsultarInformacionRutinaPreFinalPorId($id)
	{
		$query='
			SELECT 
			/* Datos de la tabla sg_rutinas*/
			Rut.id as id_rutina,
			Rut.id_usuariocreacion,
			Rut.fh_creacion,
			Rut.nb_rutina,
			Rut.desc_rutina,

			/* Datos de Categoría Rutina*/
			CatRu.nb_categoriarutina,

			/* Datos de la tabla sg_ejercicios*/
			Ejer.nb_ejercicio,

			/* Datos de ejercicio sg_ejerciciosrutina*/
			Eje.num_circuitos,
			Eje.num_repeticiones,
			Eje.id as "id_ejercicio",
			Eje.id_dia,
			Eje.id_posicionejercicio,
			Eje.ejercicio_relacion,
			/* Datos de la tabla sg_tiposrutina*/
			TipRu.nb_tiporutina,

			/* DAtos de la tabla días*/
			dias.nb_dia,

			/* Datos de sg_musculos*/
			Musc.nb_musculo,

			/* Datos de la tabla sg_usuarios*/
			Usuarios.nb_nombre,
			Usuarios.nb_apellidos,

			/* Datos de la tabla sg_maquinas */
			Maq.id as id_maquina,
			Maq.nb_maquina

			FROM
			sgrutinas Rut

			/* JOINS*/
			LEFT JOIN 
			sgejerciciosrutina Eje
			ON Eje.id_Rutina

			INNER JOIN sgcategoriasrutina CatRu
			ON CatRu.id=Rut.id_categoriarutina

			INNER JOIN sgejercicios Ejer
			ON Eje.id_Ejercicio=Ejer.id

			INNER JOIN sgtiposrutina TipRu
			ON TipRu.id=Ejer.id_tiporutina

			INNER JOIN sgdias dias
			ON Eje.id_dia=dias.id

			INNER JOIN sgmusculos Musc
			ON Musc.id=Ejer.id_musculo

			INNER JOIN sgusuarios Usuarios ON
			Rut.id_usuariocreacion=Usuarios.id

			LEFT JOIN sgmaquinas Maq ON
			Ejer.id_maquina = Maq.id

			where Rut.id= ? AND Eje.id_rutina= ? AND Eje.sn_activo=1 
			ORDER BY dias.id,Eje.id_posicionejercicio asc, id_ejercicio asc
		';
		R::begin();
			    try{
			       $ejercicios = R::getAll($query,[$id,$id]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $ejercicios =  R::rollback();
			       $ejercicios = "Error";
			    }

			R::close();
			return $ejercicios;
	}//_ConsultarInformacionRutinaPreFinalPorId

	function _ConsultarId_EjercicioPorId_PosicionEjercicio($id_rut, $id_posicion)
	{
		$query= '
		SELECT 
		Rut.id,
		Rut.id_posicionejercicio,
		Rut.id_dia  
		FROM sgejerciciosrutina  Rut
		where Rut.id_rutina= ? and Rut.id_PosicionEjercicio=? and Rut.sn_activo=1
		';
		R::freeze(1);
		R::begin();
			    try{
			       $info = R::getRow($query,[$id_rut,$id_posicion]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $info =  R::rollback();
			       $info = "Error";
			    }

			R::close();
			return $info;
	}//_ConsultarId_EjercicioPorId_PosicionEjercicio

	function _ConsultarInformacionPorRutinaYDiaRutinas($id_rutina, $id_dia)
	{
		$query = '
		SELECT 
		/* Datos de la tabla sg_rutinas*/
		Rut.id as id_rutina,
		Rut.id_usuariocreacion,
		Rut.fh_creacion,
		Rut.nb_rutina,
		Rut.desc_rutina,

		/* Datos de Categoría Rutina*/
		CatRu.nb_categoriarutina,

		/* Datos de la tabla sg_ejercicios*/
		Ejer.nb_ejercicio,

		/* Datos de ejercicio sg_ejerciciosrutina*/
		Eje.num_circuitos,
		Eje.num_repeticiones,
		Eje.id as "id_ejercicio",
		Eje.id_dia,
		Eje.id_posicionejercicio,
		/* Datos de la tabla sg_tiposrutina*/
		TipRu.nb_tiporutina,

		/* DAtos de la tabla días*/
		dias.nb_dia,

		/* Datos de sg_musculos*/
		Musc.nb_musculo,

		/* Datos de la tabla sg_usuarios*/
		Usuarios.nb_nombre,
		Usuarios.nb_apellidos

		FROM
		sgrutinas Rut

		/* JOINS*/
		INNER JOIN 
		sgejerciciosrutina Eje
		ON Eje.id_Rutina = Rut.id

		INNER JOIN sgcategoriasrutina CatRu
		ON CatRu.id=Rut.id_categoriarutina

		INNER JOIN sgejercicios Ejer
		ON Eje.id_ejercicio=Ejer.id

		INNER JOIN sgtiposrutina TipRu
		ON TipRu.id=Ejer.id_tiporutina

		INNER JOIN sgdias dias
		ON Eje.id_dia=dias.id

		INNER JOIN sgmusculos Musc
		ON Musc.id=Ejer.id_musculo

		INNER JOIN sgusuarios Usuarios ON
		Rut.id_UsuarioCreacion=Usuarios.id
		where Rut.id= ?  AND Eje.id_rutina=? AND Eje.sn_activo=1 and Eje.id_dia=?
		ORDER BY dias.id,id_posicionejercicio asc, id_ejercicio asc
		';	
		$ejercicios = $this->EjecutarTransaccionAll3Params($query,$id_rutina,$id_rutina,$id_dia);
		return $ejercicios;
	}//_ConsultarInformacionPorRutinaYDia

	function _ConsultarInformacionPorRutinaYDiaRutinasClientes($id_rutina, $id_dia)
	{
		$query = '
			SELECT 
			/* Datos de la tabla sg_rutinas*/
			Rut.id as id_rutina,
			Rut.id_usuariocreacion,
			Rut.fh_creacion,
			Rut.nb_rutina,
			Rut.desc_rutina,

			/* Datos de Categoría Rutina*/
			CatRu.nb_categoriarutina,

			/* Datos de la tabla sg_ejercicios*/
			Ejer.nb_ejercicio,

			/* Datos de ejercicio sg_ejerciciosrutina*/
			Eje.num_circuitos,
			Eje.num_repeticiones,
			Eje.id as "id_ejercicio",
			Eje.id_dia,
			Eje.id_posicionejercicio,
			/* Datos de la tabla sg_tiposrutina*/
			TipRu.nb_tiporutina,

			/* DAtos de la tabla días*/
			dias.nb_dia,

			/* Datos de sg_musculos*/
			Musc.nb_musculo,

			/* Datos de la tabla sg_usuarios*/
			Usuarios.nb_nombre,
			Usuarios.nb_apellidos

			FROM
			sgrutinasclientes Rut

			/* JOINS*/
			LEFT JOIN 
			sgejerciciosrutinacliente Eje
			ON Eje.id_Rutina = Rut.id

			LEFT JOIN sgcategoriasrutina CatRu
			ON CatRu.id=Rut.id_categoriarutina

			LEFT JOIN sgejercicios Ejer
			ON Eje.id_ejercicio=Ejer.id

			LEFT JOIN sgtiposrutina TipRu
			ON TipRu.id=Ejer.id_tiporutina

			LEFT JOIN sgdias dias
			ON Eje.id_dia=dias.id

			LEFT JOIN sgmusculos Musc
			ON Musc.id=Ejer.id_musculo

			LEFT JOIN sgusuarios Usuarios ON
			Rut.id_UsuarioCreacion=Usuarios.id
			where Rut.id= ?  AND Eje.id_rutina=? AND Eje.sn_activo=1 and Eje.id_dia=?
			ORDER BY dias.id,id_posicionejercicio asc, id_ejercicio asc
		';	
		$ejercicios = $this->EjecutarTransaccionAll3Params($query,$id_rutina,$id_rutina,$id_dia);
		return $ejercicios;
	}//_ConsultarInformacionPorRutinaYDia


	function _ConsultarDiasSemana()
	{
		$query='select * from sgdias';
		$dias = $this->EjecutarTransaccionAllNoParams($query);
		return $dias;
	}//_ConsultarDiasSemana

	function _ConsultarInfoTotalEjerciciosPorIdRutina($id_rutina)
	{
		$query='
			select * from sgejerciciosrutina where id_rutina = ? and sn_activo=1 order by id_posicionejercicio
		';
		$ejercicios = $this->EjecutarTransaccionAll($query,$id_rutina);	
		return $ejercicios;
	}

	function _ConsultarExistenciaRegistrosLight($id_cliente)
	{
		$query= 'SELECT * FROM sgpruebaslight where id_cliente =? ';
		$result = $this->EjecutarTransaccionSinglerow($query,$id_cliente);
		return $result;
	}//_ConsultarExistenciaRegistrosLight

	function _ConsultarId_EjercicioClientePorId_PosicionEjercicio($id_Rutina, $id_Posicion)
	{
		$query= '
		SELECT 
		Rut.id,
		Rut.id_posicionejercicio,
		Rut.id_dia 
		FROM sgejerciciosrutinacliente  Rut
		where Rut.id_rutina= ? and Rut.id_posicionejercicio= ? and Rut.sn_activo=1
		';
		R::freeze(1);
			R::begin();
			    try{
			       $info = R::getRow($query,[$id_Rutina,$id_Posicion]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $info =  R::rollback();
			       $info = "Error";
			    }
			R::close();
			return $info;		
	}//_ConsultarId_EjercicioClientePorId_PosicionEjercicio

	function _ConsultarResultadosPruebas($tipo_prueba, $id_cliente)
	{
		$query='
			select * from sgpruebas pruebas 
			where tipo_prueba= ? 
			and id_cliente=?  order by pruebas.fecha DESC limit 3
		';
		R::freeze(1);
			R::begin();
			    try{
			       $info = R::getAll($query,[$tipo_prueba,$id_cliente]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $info =  R::rollback();
			       $info = "Error";
			    }
			R::close();
			return $info;
	}

	function _ConsultarResultadosPruebaslight($tipo_prueba, $id_cliente)
	{
		$query='
			select * from sgpruebaslight pruebas 
			where tipo_prueba=?
			and id_cliente=? order by pruebas.fh_creacion DESC limit 3
		';
		R::freeze(1);
			R::begin();
			    try{
			       $info = R::getAll($query,[$tipo_prueba,$id_cliente]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $info =  R::rollback();
			       $info = "Error";
			    }
			R::close();
			return $info;	
	}//_ConsultarResultadosPruebaslight

	function _ConsultarResultadosPruebasIMM($tipo_prueba, $id_cliente)
	{
		$query='
			select * from sgpruebaslight pruebas 
			where tipo_prueba=?
			and id_cliente=? order by pruebas.fh_creacion DESC limit 12
		';
		R::freeze(1);
			R::begin();
			    try{
			       $info = R::getAll($query,[$tipo_prueba,$id_cliente]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $info =  R::rollback();
			       $info = "Error";
			    }
			R::close();
			return $info;	
	}//_ConsultarResultadosPruebaslight

	function _ConsultarResultadoPruebaCliente($cliente,$Prueba)
	{
		$query='
			select id,resultado from sgpruebaslight 
			where id_cliente = ? and tipo_prueba = ? 
			order by id desc limit 1
		';
		R::freeze(1);
			R::begin();
			    try{
			       $info = R::getRow($query,[$cliente,$Prueba]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $info =  R::rollback();
			       $info = "Error";
			    }
			R::close();
			return $info;	
	}//_ConsultarResultadoPruebaCliente

	function _ConsultarFechaUltimoBiotestRealizado($id_cliente)
	{
		$query = '
			select MAX(fh_creacion) as "Ultimo_Biotest" from sgpruebaslight where id_cliente = ?
		';
		$result = $this->EjecutarTransaccionSinglerow($query,$id_cliente);
		return $result;
	}//_ConsultarFechaUltimoBiotest

	function _ConsultarUltimoBiotestPruebaLight($id_cliente,$prueba)
	{
		$query = '
			select MAX(fh_creacion) as "Ultimo_Biotest" from sgpruebaslight where id_cliente = ? and tipo_prueba = ?
		';
		$result = $this->EjecutarTransaccionSinglerowDoubleParam($query,$id_cliente,$prueba);
		return $result;
	}

	function _ConsultarUltimoBiotestPrueba($id_cliente,$prueba)
	{
		$query = '
			select MAX(DATE(fecha)) as "Ultimo_Biotest" from sgpruebas where id_cliente = ? and tipo_prueba = ?
		';
		$result = $this->EjecutarTransaccionSinglerowDoubleParam($query,$id_cliente,$prueba);
		return $result;
	}

	function _ConsultarFechaUltimoBiotestUltraRealizado($id_cliente)
	{
		$query = '
			select MAX(DATE(fecha)) as "Ultimo_Biotest" from sgpruebas where id_cliente = ?
		';
		$result = $this->EjecutarTransaccionSinglerow($query,$id_cliente);
		return $result;
	}//_ConsultarFechaUltimoBiotest

		
		function _ConsultarResultadosPruebasReporte($id_prueba, $id_cliente)
		{
			$query = '
			SELECT distinct
			/* Condición física */
			Con_Fis.resultado_numerico, 
			Con_Fis.desc_prueba, 
			Con_Fis.resultado, 
			Con_Fis.fh_creacion,
			Con_Fis.porcentaje
			/* Condición física*/

			FROM sgpruebaslight Pruebas
			LEFT JOIN 
			(
			select distinct * from sgpruebaslight Prueb 
			where tipo_prueba=?
			and id_cliente=?  order by Prueb.fh_creacion DESC limit 3 
			) Con_Fis ON (Pruebas.id_cliente=Con_Fis.id_cliente)
			where Pruebas.id_cliente = ?  order by fh_creacion desc
			';	
			R::freeze(1);
				R::begin();
				    try{
				       $info = R::getAll($query,[$id_prueba,$id_cliente,$id_cliente]);
				        R::commit();
				    }
				    catch(Exception $e) {
				       $info =  R::rollback();
				       $info = "Error";
				    }
				R::close();
				return $info;	
		}//_ConsultarResultadosPruebasReporte

		function _ConsultarResultadosPruebasReporteUltra($id_prueba, $id_cliente)
		{
			$query = '
			SELECT distinct
			/* Condición física */
			Con_Fis.resultado_numerico, 
			Con_Fis.desc_prueba, 
			Con_Fis.resultado, 
			DATE(Con_Fis.fecha) as fecha,
			Con_Fis.porcentaje
			/* Condición física*/

			FROM sgpruebas Pruebas
			LEFT JOIN 
			(
			select distinct * from sgpruebas Prueb 
			where tipo_prueba=?
			and id_cliente=?  order by Prueb.fecha DESC limit 3 
			) Con_Fis ON (Pruebas.id_cliente=Con_Fis.id_cliente)
			where Pruebas.id_cliente = ?  order by fecha desc
			';	
			R::freeze(1);
				R::begin();
				    try{
				       $info = R::getAll($query,[$id_prueba,$id_cliente,$id_cliente]);
				        R::commit();
				    }
				    catch(Exception $e) {
				       $info =  R::rollback();
				       $info = "Error";
				    }
				R::close();
				return $info;	
		}//_ConsultarResultadosPruebasReporte
	

		
	