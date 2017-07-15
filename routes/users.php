<?php 
	
	// USER ROUTES
	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	// Login Function
	$app->get("/users/{user}/{pass}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$user   = $request->getAttribute('user');
				$pass   = $request->getAttribute('pass');
				
				$usersC = new UsersController();
				$dataResponse = $usersC->LoginUsuario($user,$pass);
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


	// Getting Users function
	$app->get("/users/",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$user = null;
				$pass = null;
				// Verifying headers
				if(array_key_exists("HTTP_USER",$data) && array_key_exists("HTTP_PASS",$data))
				{
					$user   = $data['HTTP_USER'][0];
					$pass   = $data['HTTP_PASS'][0];
					$usersC = new UsersController();
					$dataResponse = $usersC->LoginUsuario($user,$pass);

				}else{
					$dataResponse = array("error"=>true,"message"=>"no login information","data"=>"none");
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