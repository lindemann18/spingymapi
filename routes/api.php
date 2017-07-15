<?php 
	if(!defined("SPECIALCONSTANT")) die("acceso denegado");

	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	$app->get("/users/",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
		try {
			$Usuarios = null;
			$conexion = new Conexion();
			$con        = $conexion->_con();
			R::begin();
			    try{
			       $Usuarios = R::getAll("SELECT * FROM sgusuarios  where sn_activo =1 ORDER BY id ASC");
			        R::commit();
			    }
			    catch(Exception $e) {
			       $user =  R::rollback();
			    }
			R::close();
			
			$response->withHeader("Content-type","application/json");
			$newResponse = $response->withStatus(200);
			$body = $response->getBody();
			$body->write(json_encode($Usuarios));
		} catch (PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
	});

	$app->get("/books/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
		$id  = $request->getAttribute('id');
		try {
			$con = getConnection();
			$dbh = $con->prepare("SELECT * FROM books WHERE ID= ?");
			$dbh->bindParam(1,$id);
			$dbh->execute();
			$books = $dbh->fetchObject();
			$con = null;
			$response->withHeader("Content-type","application/json");
			$newResponse = $response->withStatus(200);
			$body = $response->getBody();
			$body->write(json_encode($books));
		} catch (PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
	});

	$app->post("/books/",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
		$data = $request->getParsedBody();
		$title  = $data["title"];
		$isbn   = $data["isbn"];
		$author = $data["author"];

		try {
			$con = getConnection();
			$dbh = $con->prepare("INSERT INTO books VALUES(null,?,?,?,NOW())");
			$dbh->bindParam(1,$author);
			$dbh->bindParam(2,$title);
			$dbh->bindParam(3,$isbn);
			$dbh->execute();
			$bookid = $con->lastInsertId();
			$con = null;
			$response->withHeader("Content-type","application/json");
			$newResponse = $response->withStatus(200);
			$body = $response->getBody();
			$body->write(json_encode($bookid));
		} catch (PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
	});

	$app->put("/books/",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
		$data = $request->getParsedBody();
		print_r($data);
		$id 	= $data["id"];
		$title  = $data["title"];
		$isbn   = $data["isbn"];
		$author = $data["author"];

		try {
			$con = getConnection();
			$dbh = $con->prepare("UPDATE books SET title=?,isbn=?,author=? WHERE id = ?");
			$dbh->bindParam(1,$title);
			$dbh->bindParam(2,$isbn);
			$dbh->bindParam(3,$author);
			$dbh->bindParam(4,$id);

			$dbh->execute();
			$con = null;
			$response->withHeader("Content-type","application/json");
			$newResponse = $response->withStatus(200);
			$body = $response->getBody();
			$body->write(json_encode(array("res"=>1)));
		} catch (PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
	});
	

	$app->get("/booksDelete/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
		try {
			$id  = $request->getAttribute('id');

			$con = getConnection();
			$dbh = $con->prepare("DELETE FROM books WHERE id= ?");
			$dbh->bindParam(1,$id);
			$dbh->execute();
			$con = null;
			$response->withHeader("Content-type","application/json");
			$newResponse = $response->withStatus(200);
			$body = $response->getBody();
			$body->write(json_encode(array("res"=>1)));
		} catch (PDOException $e) {
			print_r($e->getMessage());
			echo "Error: ".$e->getMessage();
		}
	});
 ?>