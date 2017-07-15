<?php 
	
	require_once("../../libs/libs.php");
	$consultar=new Consultar();
	if(isset($_GET['id_entrenador']) && $_GET['id_entrenador']!="" && isset($_GET['id_CategoriaRutina']) && $_GET['id_CategoriaRutina']!="")
	{
		//Tomando los valores para el query del entrenador
		$id_entrenador		= $_GET['id_entrenador'];
		$id_CategoriaRutina = $_GET['id_CategoriaRutina'];
		$id_Genero			= $_GET['id_Genero'];
		
		// Verificar los diferntes casos de búsqueda de rutinas.
		// 1) Donde ninguno de los parámetros id_entrenador y id_categoría llevan el valor de "Todos".
		// 2) Donde el id_entrenador es "Todos" y el id_categoría lleva el valor de alguna cateogría.
		// 3) Donde el id_entrenador es diferente de "Todos" y el id_categoria es igual a Todos.
		// 4) Donde ambos, id_entrenador y id_categoría llevan el valor de "Todos".
		
		switch(true)
		{
			case $id_entrenador !="Todos" && $id_CategoriaRutina !="Todos":
				//Verificar si el entrenador al que se eligió tiene rutinas o no.
				$resultVerificacion = $consultar->_ConsultarUsuarioVerificarSiTieneRutinas($id_entrenador);
			$numVerificacion=$resultVerificacion->num_rows; //Número que nos dice si existen rutinas, de existir se buscan rutinas de este usuario
				if($numVerificacion>0)
				{
					//Lista de usuarios con Rutinas para el combo select
					$ResultEntrenadoresRutinas = $consultar->_ConsultarListaEntrenadoresConRutinasSoloNombres();
					$resultRutinas			   = $consultar->_ConsultarRutinaPorEntrenadorYCategoriaDeRutina($id_entrenador,$id_CategoriaRutina,$id_Genero); 
				}//if $numVerificacion>0
				
				else 
				{
					//Si el entrenador actual no tiene rutinas, le aparecerán de los que si tienen Rutinas
					$resultEntrenadores		   = $consultar->_ConsultarEntrenadoresConRutinas(); //Buscando entrenadores que si cuenten con rutina
					$filaEntrenadoresConRutina = $resultEntrenadores->fetch_assoc(); //Tomando los datos del primer registro
					$id_usuarioRutina 		   = $filaEntrenadoresConRutina['id_usuario']; //tomandl el id
					
					//Buscando que categorías de rutina tiene
					$resultTiposCategorias = $consultar->_ConsultarCategoriaRutinasDelEntrenador($id_usuarioRutina);
					$numCategoriasRutinas  = $resultTiposCategorias->num_rows;
					
					$id_CategoriaBuscar=0; //Categoría con la cual se buscarán las rutinas
					for($i=0; $i<$numCategoriasRutinas; $i++)
					{
						$filaCategoriaRutinas = $resultTiposCategorias->fetch_assoc();
						switch($filaCategoriaRutinas['id_categoria'])
						{
							case 1:
								$id_CategoriaBuscar=1;	
							break;
							
							case 2:
								if($id_CategoriaBuscar==0)
								{$id_CategoriaBuscar=2;}	
							break;
							
							
							case 3:
								if($id_CategoriaBuscar==0)
								{$id_CategoriaBuscar=3;}	
							break;
							
							case 4:
								if($id_CategoriaBuscar==0)
								{$id_CategoriaBuscar = 4;}	
							break;
							
						}//switch
					}//for
					
					$resultRutinas=$consultar->_ConsultarRutinaPorEntrenadorYCategoriaDeRutina($id_usuarioRutina,$id_CategoriaBuscar,$id_Genero); 
				}//else
			break;
			
			//Aquí es todos los entrenadores pero una categoría en específico.
			case $id_entrenador =="Todos" && $id_CategoriaRutina !="Todos":
				$resultRutinas 			   = $consultar->_ConsultarRutinasPorCategoria($id_CategoriaRutina,$id_Genero);
				$ResultEntrenadoresRutinas = $consultar->_ConsultarListaEntrenadoresConRutinasSoloNombres();
			break;
			
			//Aquí es todos los entrenadores y todas las categorías..
			case $id_entrenador =="Todos" && $id_CategoriaRutina =="Todos":
				$resultRutinas 			   = $consultar->_ConsultarRutinasTotales($id_Genero);
				$ResultEntrenadoresRutinas = $consultar->_ConsultarListaEntrenadoresConRutinasSoloNombres();
			break;
			
			case $id_entrenador !="Todos" && $id_CategoriaRutina =="Todos":
				$utilidades    			   = new Utilidades();
				$resultCat    			   = $utilidades->_DefinirTipoRutinaCategoria($id_CategoriaRutina);
				$resultRutinas 			   = $consultar->_ConsultarRutinaPorEntrenadorYCategoriaDeRutina($id_entrenador,$resultCat,$id_Genero); 
				$ResultEntrenadoresRutinas = $consultar->_ConsultarListaEntrenadoresConRutinasSoloNombres();
			break;
			
		}//switch
		
		
		
	}//if
?>
   <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th class="sorting_asc text-center">CODIGO</th>
                                                <th class="text-center">RUTINA</th>
                                                <th class="text-center">DESCRIPCION</th>
                                                <th class="text-center">CATEGORIA</th>
                                                <th class="text-center">GENERO</th>
                                                <th class="text-center">CUERPO</th>
                                                <th class="text-center">ENTRENADOR</th>
                                                <th class="text-center">FECHA</th>
                                                <th class="text-center">INFORMACION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($filaRutina=$resultRutinas->fetch_assoc()):
										
											echo('
                                            <tr onclick="SeleccioinarDato('.$filaRutina['id_rutina'].')" id=fila"'.$filaRutina['id_rutina'].'" class="text-center">
                                                <td id="cliente">'.$filaRutina['id_rutina'].'</td>
												<td>'.$filaRutina['nb_rutina'].'</td>
                                                <td>'.$filaRutina['desc_rutina'].'</td>
												<td>'.$filaRutina['nb_CategoriaRutina'].'</td>
												<td>'.$filaRutina['nb_TipoRutina'].'</td>
												<td>'.$filaRutina['nb_cuerpo'].'</td>
                                                <td>'.$filaRutina['nb_nombre']." ".$filaRutina['nb_apellidos'].'</td>
												<td>'.$filaRutina['fh_Creacion'].'</td>
												<td><button type="button" class="btn btn-info col-md-12" onclick="InfoRutina('.$filaRutina['id_rutina'].')">Mostrar</button></td>
                                            </tr>
											');	
										
										endwhile;
										?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>CODIGO</th>
                                             	<th>RUTINA</th>
                                                <th>DESCRIPCION</th>
                                                <th>CATEGORIA</th>
                                                <th>GENERO</th>
                                                <th>CUERPO</th>
                                                <th>ENTRENADOR</th>
                                                 <th>FECHA</th>
                                                 <th>INFORMACION</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-1"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="window.location='index.php?nav=Rutinas_registrar';"><i class="fa fa-plus"></i> AGREGAR</button></div>
                                    	<div class="col-sm-1"><button class="btn btn-warning btn-sm" id="editar" title="EDITAR REGISTRO" data-original-title="EDITAR REGISTRO" onclick="Editar()"><i class="fa fa-edit"></i> EDITAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-danger btn-sm" id="eliminar" title="ELIMINAR REGISTRO" data-original-title="ELIMINAR REGISTRO"  onclick="EliminarMaquina()"><i class="fa fa-times"></i> ELIMINAR</button></div>
                                        <div class="col-sm-1 Right"><button class="btn btn-info btn-sm " id="Mostrars" title="MOSTRAR PRUEBAS" data-original-title="MOSTRAR INSTRUCTORES"  onclick="MostrarInstructores()"><i class="fa fa-male"></i> INSTRUCTORES</button></div>
                                      <!--  <div class="col-sm-1 Right"><button class="btn btn-info btn-sm" id="Mostrars" title="MOSTRAR PRUEBAS" data-original-title="MOSTRAR INSTRUCTORES"  onclick="MostrarRutinas()"><i class="fa fa-book"></i> TIPOS RUTINA</button></div>-->
                                        <div class="col-sm-1"><button class="btn btn-primary btn-sm" id="Mostrars" title="MOSTRAR PRUEBAS" data-original-title="MOSTRAR INSTRUCTORES"  onclick="FiltrarRutinas()"><i class="fa fa-search"></i> FILTRAR</button></div>
                                        
                                        <div class="col-sm-2 ListaInstructores" id="">
                                            <select name="Impedimento_Entrenamiento" id="Lista_Entrenadores" class="LabelPregunta form-control requerido" onchange="TipoEntrenadorSeleccionado()">
                                                <option value="">Seleccionar...</option>
                                                <?php
													while($filaIns=$ResultEntrenadoresRutinas->fetch_assoc()) {
													echo "<option value='".$filaIns['id_usuario']."'>".$filaIns['nb_nombre']." ".$filaIns['nb_apellidos']."</option>";}
												?>
                                                 <option value="Todos">Todos</option>
                                            </select>
                                        </div>
                                        
                                         <div class="col-sm-2 ListaInstructores" id="">
                                            <select name="Impedimento_Entrenamiento" id="Lista_Rutinas" class="LabelPregunta form-control requerido" onchange="AsignarGeneroRutina()">
                                                <option value="">Seleccionar...</option>
                                                
                                            </select>
                                        </div>
                                        
                                         <div class="col-sm-2 ListaInstructores" id="">
                                            <select name="Impedimento_Entrenamiento" id="Lista_Genero" class="LabelPregunta form-control requerido" onchange="">
                                                <option value="">Seleccionar...</option>
                                                
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-12"><h3 class="box-title">Acciones</h3></div>
                                    </div>