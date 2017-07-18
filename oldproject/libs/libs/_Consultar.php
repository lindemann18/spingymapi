<?php 
	class Consultar
	{

		//Queries de Utilidades
		//niscelaneuos
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


		// Módulo de rutinas clientes
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
	

	// MIscelaneous
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

	//Rutinas
	function _ConsultarPosicionEjercicioRutina($id_rutina)
	{
		 $query = '
			select IFNULL(MAX(id_posicionejercicio+1),1) as "id_posicionejercicio" 
			from sgejerciciosrutina where id_rutina = ?
		';
		$posicion = $this->EjecutarTransaccionSinglerow($query,$id_rutina);
		return $posicion;
	}//_ConsultarPosicionEjercicioRutina

	//Rutinas
	function _ConsultarPosicionEjercicioRutinaCliente($id_rutina)
	{
		 $query = '
			select IFNULL(MAX(id_posicionejercicio+1),1) as "id_posicionejercicio" 
			from sgejerciciosrutinacliente where id_rutina = ?
		';
		$posicion = $this->EjecutarTransaccionSinglerow($query,$id_rutina);
		return $posicion;
	}//_ConsultarPosicionEjercicioRutina

	// Rutinas
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

	// Rutinas
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

	// Rutina
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

	// Rutinas
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

	// Rutinass
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

	// Rutinas clientes
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


	// Rutinas
	function _ConsultarDiasSemana()
	{
		$query='select * from sgdias';
		$dias = $this->EjecutarTransaccionAllNoParams($query);
		return $dias;
	}//_ConsultarDiasSemana

	// Rutinas
	function _ConsultarInfoTotalEjerciciosPorIdRutina($id_rutina)
	{
		$query='
			select * from sgejerciciosrutina where id_rutina = ? and sn_activo=1 order by id_posicionejercicio
		';
		$ejercicios = $this->EjecutarTransaccionAll($query,$id_rutina);	
		return $ejercicios;
	}

	//Rutinas clientes
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



	/* here */

		// Biotest
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

		// Biotest
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
	

		
	