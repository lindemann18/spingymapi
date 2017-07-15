<?php	
	require_once("../../libs/libs.php");
	session_start();
	
	if(isset($_GET['id_instructor']))
	{
		$id_instructor=$_GET['id_instructor'];
	}
	else {$id_instructor=$_SESSION['Sesion']['id_usuario'];}
	
	$consultar=new Consultar();
	//Trayendo la lista de instructores para filtrar
	if($id_instructor!="Todos"){$result=$consultar->_ConsultarClientesPorInstructor($id_instructor);}
	else{$result=$consultar->_ConsultarClientes();}
	$ResultInstructores = $consultar->_ConsultarInstructores($id_instructor);
	$RS_num				= $result->num_rows;
?>									
                                       <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th class="sorting_asc">CODIGO</th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>EMAIL</th>
                                                <th>CELULAR</th>
                                                <th>ENTRENADOR</th>
                                                <th>BIOTEST</th>
                                                <th>FORMULARIO</th>
                                                <th>RUTINA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($fila=$result->fetch_assoc()):
										
											echo('
                                            <tr onclick="SeleccioinarDato('.$fila['id_cliente'].')" id=fila"'.$fila['id_cliente'].'">
                                                <td id="cliente">'.$fila['id_cliente'].'</td>
												<td>'.$fila['nb_cliente'].'</td>
                                                <td>'.$fila['nb_apellidos'].'</td>
                                                <td>'.$fila['de_email'].'</td>
                                                <td>'.$fila['num_celular'].'</td>
												<td>'.$fila['Ins_nombre']." ".$fila['Ins_apellido'].'</td>
												<td><button type="button" class="btn btn-success" onclick="BioTest('.$fila['id_cliente'].')">BioTest</button></td>
												<td><button type="button" class="btn btn-warning" onclick="Formulario('.$fila['id_cliente'].')">Formulario</button></td>
												<td><button type="button" class="btn btn-info" onclick="Formulario('.$fila['id_cliente'].')">Rutina</button></td>
                                            </tr>
											');	
										
										endwhile;
										?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>CODIGO</th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>EMAIL</th>
                                                <th>CELULAR</th>
                                                <th>ENTRENADOR</th>
                                                <th>BIOTEST</th>
                                                <th>FORMULARIO</th>
                                                <th>RUTINA</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_instructor" value="<?php echo $id_instructor?>" />
                                    	<div class="col-sm-1"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="window.location='index.php?nav=clientes_registrar';"><i class="fa fa-plus"></i> AGREGAR</button></div>
                                    	<div class="col-sm-1"><button class="btn btn-warning btn-sm" id="editar" title="EDITAR REGISTRO" data-original-title="EDITAR REGISTRO" onclick="Editar()"><i class="fa fa-edit"></i> EDITAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-danger btn-sm" id="eliminar" title="ELIMINAR REGISTRO" data-original-title="ELIMINAR REGISTRO"  onclick="EliminarCliente()"><i class="fa fa-times"></i> ELIMINAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-info btn-sm" id="Mostrars" title="MOSTRAR INSTRUCTORES" data-original-title="MOSTRAR INSTRUCTORES"  onclick="Mostrarinstructores()"><i class="fa fa-male"></i>&nbsp; Entrenadores Mixtos</button></div>
                                        <div class="col-sm-2 ListaInstructores" id="">
                                            <select name="Impedimento_Entrenamiento" id="Lista_Entrenadores" class="LabelPregunta form-control requerido" onchange="ClientesConInstructorSeleccionado()">
                                                <option value="">Seleccionar...</option>
                                                <option value="Todos">Todos</option>
                                                <?php
													 while($filaIns=$ResultInstructores->fetch_assoc()) 
													{echo "<option value='".$filaIns['id_usuario']."'>".$filaIns['nb_nombre']." ".$filaIns['nb_apellidos']."</option>";}
												?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12"><h3 class="box-title">Acciones</h3></div>
                                    </div>