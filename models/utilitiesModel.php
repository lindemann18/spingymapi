<?php 
	
	class Utilities
	{
		function QueryGetAll($query)
		{
			$error   = "false";
			$message = "";
			R::begin();
			    try{
			       $data = R::getAll($query);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $error   = "true";
			       $message = $e;
			       $data   =  R::rollback();
			    }

			R::close();
			$response = array("data"=>$data,"error"=>$error,"message"=>$message);
			return $response;
		}

		function QueryTwoParametersOneRow($param,$param2,$query)
		{
			$error = false;
			R::begin();
			    try{
			       $data = R::getRow($query,[$param,$param2]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $error = true;
			       $data   =  R::rollback();
			    }

			R::close();
			$response = array("data"=>$data,"error"=>$error);
			return $response;
		}	
	}
 ?>