<?php

	// Machine Categories ROUTES
	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	//Get MAachines Categories
	$app->get("/machinecategories",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$machineCC = new machineCategoriesController();
					$dataResponse = $machineCC->ConsultarCategoriaMaquinas();	
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


	$app->get("/machinecategories/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');

				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$machineCC = new machineCategoriesController();
					$dataResponse = $machineCC->ConsultarCategoriaMaquinaPorId($id);	
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