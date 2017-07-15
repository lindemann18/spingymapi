<?php
	include("../../libs/libs.php");
	$Params 	= $_POST['Params'];
	$Parametros = json_decode($Params,true);
	$Accion 	= $Parametros['Accion'];
	$conexion   = new ConexionBean(); //Variable de conexión
	$con        = $conexion->_con(); //Variable de conexión
	//Switch de las funciones
	switch($Accion)
	{

		case 'ConsultarConsejos':
			$salidaJson = ConsultarConsejos($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarInfoConsejoPorId':
			$salidaJson = BuscarInfoConsejoPorId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarConsejo':
			$salidaJson = EditarConsejo($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'ConsultarMaquinas':
			$salidaJson = ConsultarMaquinas($Parametros);
			echo json_encode($salidaJson);
		break;
	
		case 'EliminarMaquina':
			$salidaJson = EliminarMaquina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarMaquinaId':
			$salidaJson = BuscarMaquinaId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarMaquina':
			$salidaJson = EditarMaquina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarCategoriasMaquina':
			$salidaJson = BuscarCategoriasMaquina($Parametros);
			echo json_encode($salidaJson);
		break;
		
		case 'AgregarMaquina':
			$salidaJson = AgregarMaquina($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'FiltrarMaquinas':
			$salidaJson = FiltrarMaquinas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'CategoriasMaquinas':
			$salidaJson = CategoriasMaquinas($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'AgregarCategoria':
			$salidaJson = AgregarCategoria($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'BuscarCategoriaPorId':
			$salidaJson = BuscarCategoriaPorId($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EditarCategoria':
			$salidaJson = EditarCategoria($Parametros);
			echo json_encode($salidaJson);
		break;

		case 'EliminarCategoria':
			$salidaJson = EliminarCategoria($Parametros);
			echo json_encode($salidaJson);
		break;
	}//switch
		
	function ConsultarConsejos($Parametros)
	{
		$id 	   = $Parametros['id'];
		$consultar = new Consultar();
		$consejos  = $consultar->_ConsultarConsejosPorPrueba($id);
		$existe    = 0;
		$existep   = 0;
		$cantidad  = count($consejos);
		//Verificando si devolvió datos
		if($consejos!="" && $cantidad>0)
		{
			$existe = 1;
		}

		//Buscando los tipos de pruebas
		$Pruebas = $consultar->_ConsultartiposPruebas();
		$cantidadp = count($Pruebas);
		if($Pruebas!="" && $cantidadp>0)
		{
			$existep = 1;
		}//if

		$datos     = array("consejos"=>$consejos,"existe"=>$existe,"existep"=>$existep,"pruebas"=>$Pruebas);
		return $datos;
	}//ConsultarConsejos

	function BuscarInfoConsejoPorId($Parametros)
	{
		$id_consejo = $Parametros['id'];
		$consultar  = new Consultar();
		$consejo    = $consultar->_ConsultarConsejoPorId($id_consejo);
		$cantidad   = count($consejo);
		$existe     = 0;
		if($cantidad>0)
		{
			$existe = 1;
		}
		$datos = array("consejo"=>$consejo,"existe"=>$existe);
		return $datos;
	}//BuscarInfoConsejoPorId

	function EditarConsejo($Parametros)
	{
		R::freeze(1);
		$id 		  = $Parametros['id'];
		$consejotexto = $Parametros['Consejo'];
		$ConsejoOb    = R::load("sgconsejos",$id);
		$ConsejoOb->consejo = $consejotexto;
		$error       = 0;
		$msj         = "";
		R::begin();
			    try{
			       $respuesta = R::store($ConsejoOb);
			        R::commit();
			    }
			    catch(Exception $e) {
			    	$error = 1;
			    	$msj   = $e->getMessage;
			       $respuesta =  R::rollback();
			    }
			R::close();
		
		$datos = array("respuesta"=>$respuesta,"error"=>$error,"msj"=>$msj);
		return $datos;
	}//Editarconsejo

	function EliminarMaquina($Parametros)
	{
		//Tomando el id y buscando la máquina
		$id      = $Parametros['id'];
		$maquina = R::load("sgmaquinas",$id);
		$maquina->sn_activo = 0;

		//Editando la máquina
		R::begin();
		    try{
		       $respuesta = R::store($maquina);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		    }
		R::close();

		//Buscando las máquinas restantes
		$consultar = new Consultar();
		$maquinas  = $consultar->_ConsultarMaquinas();
		$cantidad  = count($maquinas);
		$existe    = 0;
		if($maquinas !="" && $cantidad>0){$existe=1;}

		$datos = array("respuesta"=>$respuesta,"maquinas"=>$maquinas,"existe"=>$existe);
		return $datos;
	}//EliminarMaquina

	function BuscarMaquinaId($Parametros)
	{
		//Buscando la información de la máquina
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		$maquina   = $consultar->_BuscarMaquinaId($id);
		$existe    = 0;
		$existemaq = 0;
		$cantidad  = count($maquina);
		if($maquina>0){$existe = 1;}

		//BUscando los géneros de las máquinas
		$tipoMaquinas = $consultar->_ConsultarTiposMaquina();
		
		$cantidadmaq  = count($tipoMaquinas);

		if($tipoMaquinas!="" && $cantidadmaq>0){$existemaq = 1;}

		$datos = array("existe"=>$existe,"maquina"=>$maquina,"existemaq"=>$existemaq,"tipoMaquinas"=>$tipoMaquinas);
		return $datos;
	}//BuscarMaquinaId

	function EditarMaquina($Parametros)
	{	
		$maquina 			   = R::load("sgmaquinas",$Parametros['id']);
		$maquina->nb_maquina   = $Parametros['nb_maquina'];
		$maquina->desc_maquina = $Parametros['desc_maquina'];
		$maquina->num_maquina  = $Parametros['num_maquina'];
		$maquina->id_categoriamaquina = $Parametros['id_categoriamaquina'];
		//Editando la máquina
		R::begin();
		    try{
		       $respuesta = R::store($maquina);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		    }
		R::close();
		$datos = array("respuesta"=>$respuesta);
		return $datos;
	}//EditarMaquina

	function BuscarCategoriasMaquina()
	{
		//BUscando los géneros de las máquinas
		$consultar    = new Consultar();
		$tipoMaquinas = $consultar->_ConsultarTiposMaquina();
		$cantidad     = count($tipoMaquinas);
		$existe       = 0;
		if($cantidad>0 && $tipoMaquinas!=""){$existe=1;}
		$datos = array("existe"=>$existe,"tipoMaquinas"=>$tipoMaquinas);
		return $datos;
	}//BuscarCategoriasMaquina
	
	function AgregarMaquina($Parametros)
	{
		//Crear un objeto de la tabla
		R::freeze(1);
		$maquina  = R::dispense("sgmaquinas");
		$agregado = 0;

		//Agregando los valores al objeto.
		$maquina->nb_maquina   		  = $Parametros['nb_maquina'];
		$maquina->desc_maquina 		  = $Parametros['desc_maquina'];
		$maquina->num_maquina         = $Parametros['num_maquina'];
		$maquina->id_categoriamaquina = $Parametros['id_categoriamaquina'];
		$maquina->sn_activo           = 1;

		//añadiendo a la bd la máquina.
		R::begin();
		    try{
		       $respuesta = R::store($maquina);
		        R::commit();
		    }
		    catch(Exception $e) {
		    	$respuesta =  R::rollback();
		       $respuesta = "algo falló";
		    }
		R::close();

		if(is_numeric($respuesta)){$agregado = 1;}
		$datos = array("agregado"=>$agregado);
		return $datos;
	}//AgregarMaquina

	function ConsultarMaquinas()
	{
		//consultando las máquinas
		$consultar = new Consultar();
		$maquinas  = $consultar->_ConsultarMaquinas();
		$cantidad  = count($maquinas);
		$existe    = 0;
		$existem   = 0;
		if($maquinas !="" && $cantidad>0){$existe=1;}

		//Consultar las categorías de máquinas
		$tiposMaquinas = $consultar->_ConsultarTiposMaquina();
		//Añadiendo la opción, Todas.
		$todas = array("id"=>"Todas","nb_categoriamaquina"=>"Todas",
					   "desc_categoriamaquina"=>"Todas","sn_activo"=>"1",
					   "Id_UsuarioRegistro"=>"todas");
		$cantidadt     = count($tiposMaquinas);
		if($tiposMaquinas !="" && $cantidadt>0){$existem=1; array_push($tiposMaquinas,$todas);}

		$datos = array("maquinas"=>$maquinas,"existe"=>$existe,
					   "tiposMaquinas"=>$tiposMaquinas,"existem"=>$existem);
		return $datos;
	}//ConsultarMaquinas

	function FiltrarMaquinas($Parametros)
	{
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		$existe    = 0;
		$maquinas  = $consultar->_BuscarMaquinaPorCategoria($id);
		if($maquinas!="error"){$existe = 1;}
		$datos = array("maquinas"=>$maquinas,"existe"=>$existe);
		return $datos;
	}//FiltrarMaquinas

	function AgregarCategoria($Parametros)
	{
		//Tomando los datos
		session_start();
		R::freeze(1);
		$nb_categoriamaquina   = $Parametros['nb_categoriamaquina'];
		$Desc_CategoriaMaquina = $Parametros['desc_categoriamaquina'];
		$id_usuario            = $_SESSION['usuario']['id'];
		$catmaquina            = R::dispense("sgcategoriamaquina");
		$catmaquina->nb_categoriamaquina = $nb_categoriamaquina;
		$catmaquina->desc_categoriamaquina = $Desc_CategoriaMaquina;
		$catmaquina->id_usuarioregistro = $id_usuario;
		$existe = 0;
		R::begin();
		    try{
		       $respuesta = R::store($catmaquina);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();

		if($respuesta!="Error"){$existe = 1;}
		$datos = array("existe"=>$existe);
		return $datos;
	}//AgregarCategoria

	function BuscarCategoriaPorId($Parametros)
	{
		$id        = $Parametros['id'];
		$consultar = new Consultar();
		$cat       = $consultar->_BuscarCategoriaPorId($id);

		$cantidad  = count($cat);
		$existe    = 0;
		if($cantidad>0 && $cat!=""){$existe = 1;}
		$datos     = array("existe"=>$existe,"cat"=>$cat);
		return $datos;
	}//BuscarCategoriaPorId

	function EditarCategoria($Parametros)
	{
		//Tomando los datos de la categoría.
		$id  				   = $Parametros['id'];
		$nb_categoriamaquina   = $Parametros['nb_categoriamaquina'];
		$desc_categoriamaquina = $Parametros['desc_categoriamaquina'];
		$categoria   		   = R::load("sgcategoriamaquina",$id);
		$categoria->nb_categoriamaquina   = $nb_categoriamaquina;
		$categoria->desc_categoriamaquina = $desc_categoriamaquina;
		$exito 							  = 0;
		R::freeze(1);
		R::begin();
		    try{
		       $respuesta = R::store($categoria);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		if($respuesta!="Error"){$exito = 1;}
		$datos = array("exito"=>$exito);
		return $datos;
	}//EditarCategoria

	function EliminarCategoria($Parametros)
	{
		$id = $Parametros['id'];
		R::freeze(1);
		$categoria = R::load('sgcategoriamaquina',$id);
		$exito     = 0;
		$categoria->sn_activo = 0;
		R::begin();
		    try{
		       $respuesta = R::store($categoria);
		        R::commit();
		    }
		    catch(Exception $e) {
		       $respuesta =  R::rollback();
		       $respuesta = "Error";
		    }
		R::close();
		if($respuesta!="Error"){$exito = 1;}
		//BUscando los géneros de las máquinas
		$consultar    = new Consultar();
		$tipoMaquinas = $consultar->_ConsultarTiposMaquina();
		$cantidadc    = count($tipoMaquinas);
		$existec      = 0;
		if($cantidadc>0 && $tipoMaquinas!=""){$existec = 1;}
		$datos = array("exito"=>$exito,"existec"=>$existec,"Categorias"=>$tipoMaquinas);
		return $datos;
	}
?>

