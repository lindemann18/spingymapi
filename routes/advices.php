<?php 	
	// Advices ROUTES
	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	//Consultar consejo por prueba

	$app->get("/advices/{id}/",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$id   = $request->getAttribute('id');
				
				//Getting DAta
				$data   = $request->getHeaders();
				
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$advices = new advicesController();
					$dataResponse = $advices->ConsultarConsejosPorPrueba($id);
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}		

				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});	

	$app->get("/advices/test/{test}/",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$test   = $request->getAttribute('test');
				
				//Getting DAta
				$data   = $request->getHeaders();
				
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$advices = new advicesController();
					$dataResponse = $advices->ConsultarConsejosPorPrueba($test);
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}		

				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

		$app->get("/advices/{test}/{result}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$test   = $request->getAttribute('test');
				$result   = $request->getAttribute('result');
				
				//Getting DAta
				$data   = $request->getHeaders();
				
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$advices = new advicesController();
					$dataResponse = $advices->ConsultarConsejoAcordeResultado($test,$result);
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}		

				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});	
 ?>