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

		function QueryGetAllOneParam($query,$param)
		{
			$error   = "false";
			$message = "";
			R::begin();
			    try{
			       $data = R::getAll($query,[$param]);
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

		function QueryGetAllThreeParam($query,$param,$param2,$param3)
		{
			$error   = "false";
			$message = "";
			R::begin();
			    try{
			       $data = R::getAll($query,[$param,$param2,$param3]);
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

		function QueryGetAllTwoParam($query,$param,$param2)
		{
			$error   = "false";
			$message = "";
			R::begin();
			    try{
			       $data = R::getAll($query,[$param,$param2]);
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

		function QueryGetRowOneParam($query,$param)
		{
			$error   = "false";
			$message = "";
			R::begin();
			    try{
			       $data = R::getRow($query,[$param]);
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

		function QueryGetRowTwoParam($query,$param,$param2)
		{
			$error   = "false";
			$message = "";
			R::begin();
			    try{
			       $data = R::getRow($query,[$param,$param2]);
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
			$message = null;
			R::begin();
			    try{
			       $data = R::getRow($query,[$param,$param2]);
			        R::commit();
			    }
			    catch(Exception $e) {
			       $error = true;
			       $message = $e;
			       $data   =  R::rollback();
			    }

			R::close();
			$response = array("data"=>$data,"error"=>$error,"message"=>$message);
			return $response;
		}	
	}
 ?>