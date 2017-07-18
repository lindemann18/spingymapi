<?php 
	class biotestModel
	{
		function _ConsultartiposPruebas()
		{
			$query = 'SELECT * FROM sgtipospruebas  ORDER BY id ASC';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarRegistrosLight($id)
		{
			// original name _ConsultarExistenciaRegistrosLight
			$query= 'SELECT * FROM sgpruebaslight where id_cliente =? ';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetAllOneParam($query,$id);
			return $response;
		}

		function _ConsultarResultadosPruebas($tipo_prueba, $id_cliente)
		{
			$query='
				select * from sgpruebas pruebas 
				where tipo_prueba= ? 
				and id_cliente=?  order by pruebas.fecha DESC limit 3
			';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetAllTwoParam($query,$tipo_prueba,$id_cliente);
			return $response;
		}

		function _ConsultarResultadosPruebaslight($tipo_prueba, $id_cliente)
		{
			$query='
				select * from sgpruebaslight pruebas 
				where tipo_prueba=?
				and id_cliente=? order by pruebas.fh_creacion DESC limit 3
			';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetAllTwoParam($query,$tipo_prueba,$id_cliente);
			return $response;
		}

		function _ConsultarResultadosPruebasIMM($tipo_prueba, $id_cliente)
		{
			// Nota: Hacer el mismo query parametrizable para no repetir
			$query='
			select * from sgpruebaslight pruebas 
			where tipo_prueba=?
			and id_cliente=? order by pruebas.fh_creacion DESC limit 12
			';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetAllTwoParam($query,$tipo_prueba,$id_cliente);
			return $response;
		}

		function _ConsultarResultadoPruebaCliente($tipo_prueba, $id_cliente)
		{
			$query='
			select id,resultado from sgpruebaslight 
			where id_cliente = ? and tipo_prueba = ? 
			order by id desc limit 1
			';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetRowTwoParam($query,$tipo_prueba,$id_cliente);
			return $response;
		}

		function _ConsultarUltimoBiotestlightRealizado($id)
		{
			// Original Name _ConsultarFechaUltimoBiotestRealizado
			$query = '
			select MAX(DATE(fh_creacion)) as "Ultimo_Biotest" from sgpruebaslight where id_cliente = ?';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarUltimoBiotestRealizado($id)
		{
			// Original NAme _ConsultarFechaUltimoBiotestUltraRealizado
			$query = 'select MAX(DATE(fecha)) as "Ultimo_Biotest" from sgpruebas where id_cliente = ?';
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarResultadosPruebasReporte($prueba, $cliente)
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
			$Utilities = new Utilities();
			$response  = $Utilities->QueryGetAllThreeParam($query,$prueba,$cliente,$id_cliente);
			return $response;
		}
	}

 ?>