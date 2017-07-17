<?php 
	// USER ROUTES
	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	$app->get("/routines",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();

				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$routinesController = new routinesController();
					$dataResponse = $routinesController->ConsultarRutinas();	
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

	$app->get("/routines/categories",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();

				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$routinesController = new routinesController();
					$dataResponse = $routinesController->ConsultarCategoriaRutinas();	
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

	$app->get("/routines/genre",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();

				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$routinesController = new routinesController();
					$dataResponse = $routinesController->ConsultarGenerosRutina();	
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

	$app->get("/routines/trainers",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();

				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$routinesController = new routinesController();
					$dataResponse = $routinesController->_ConsultarEntrenadoresConRutinas();	
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