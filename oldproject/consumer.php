<?php
class Consumer
{
	public function sendPost()
	{
		//datos a enviar
		$data = array("title" => "forastero misterioso","isbn"=>"958-985-154","author"=>"mark twain");
		//url contra la que atacamos
		$ch = curl_init("localhost/slimphp/index.php/books/");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		//enviamos el array data
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}
 
	public function sendPut($id)
	{
		//datos a enviar
		$data = array("title" => "forastero misterioso","isbn"=>"958-985-154","author"=>"mark twain","id"=>$id);
		//url contra la que atacamos
		$ch = curl_init("localhost/slimphp/index.php/books/");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		//enviamos el array data
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}
 
	public function sendGetById($user,$pass)
	{

		$ch = curl_init("localhost/spingymapi/index.php/users/$user/$pass");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		//enviamos el array data
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}

	public function sendGet()
	{

		$ch = curl_init("localhost/slimphp/index.php/books/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		$response = curl_exec($ch);
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}
 
	public function sendDelete($id)
	{
		$ch = curl_init("localhost/slimphp/index.php/books/$id");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		//enviamos el array data
		
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}
}

$curl = new Consumer();
$curl->sendGetById("holis","spingym123");