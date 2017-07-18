<?php 
	class biotestController
	{
		function _ConsultartiposPruebas()
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultartiposPruebas();
			return $response;
		}

		function ConsultarRegistrosLight($id)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarRegistrosLight($id);
			return $response;
		}

		function ConsultarResultadosPruebas($tipo_prueba, $id_cliente)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarResultadosPruebas($tipo_prueba, $id_cliente);
			return $response;
		}

		function ConsultarResultadosPruebaslight($tipo_prueba, $id_cliente)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarResultadosPruebaslight($tipo_prueba, $id_cliente);
			return $response;
		}

		function ConsultarResultadosPruebasIMM($tipo_prueba, $id_cliente)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarResultadosPruebasIMM($tipo_prueba, $id_cliente);
			return $response;
		}

		function ConsultarResultadoPruebaCliente($tipo_prueba, $id_cliente)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarResultadoPruebaCliente($tipo_prueba, $id_cliente);
			return $response;
		}

		function ConsultarUltimoBiotestlightRealizado($id)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarUltimoBiotestlightRealizado($id);
			return $response;
		}

		function ConsultarUltimoBiotestRealizado($id)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarUltimoBiotestRealizado($id);
			return $response;
		}

		function ConsultarResultadosPruebasReporte($id)
		{
			$biotestModel = new biotestModel();
			$response = $biotestModel->_ConsultarResultadosPruebasReporte($id);
			return $response;
		}
	
	}

 ?>