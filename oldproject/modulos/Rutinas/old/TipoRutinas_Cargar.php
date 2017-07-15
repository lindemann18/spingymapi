<?php

	require_once("../../libs/libs.php");
	$consultar=new Consultar();
	
	//Trayendo la lista de instructores para filtrar
	$Result=$consultar->_ConsultarTiposDeRutina();

?>									
                                    <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th class="sorting_asc">CODIGO</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCION</th>
                                                <th>USUARIO ALTA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($fila=$Result->fetch_assoc()):
										
											echo('
                                            <tr onclick="SeleccioinarDato('.$fila['id'].')" id=fila"'.$fila['id'].'">
                                                <td id="cliente">'.$fila['id'].'</td>
												<td>'.$fila['nb_TipoRutina'].'</td>
                                                <td>'.$fila['desc_TipoRutina'].'</td>
												<td>'.$fila['nb_nombre']." ".$fila['nb_apellidos'].'</td>
                                            </tr>
											');	
										
										endwhile;
										?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>CODIGO</th>
                                                <th>MUSCULO</th>
                                                <th>DESCRIPCION</th>
                                                <th>USUARIO ALTA</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_instructor" value="<?php echo $id_instructor?>" />
                                        <div class="col-sm-1"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="window.location='index.php?nav=Registro_TipoRutina';"><i class="fa fa-plus"></i> AGREGAR</button></div>
                                    	<div class="col-sm-1"><button class="btn btn-warning btn-sm" id="editar" title="EDITAR REGISTRO" data-original-title="EDITAR REGISTRO" onclick="Editar()"><i class="fa fa-edit"></i> EDITAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-danger btn-sm" id="eliminar" title="ELIMINAR REGISTRO" data-original-title="ELIMINAR REGISTRO"  onclick="EliminarMusculo()"><i class="fa fa-times"></i> ELIMINAR</button></div>
                                        
                                        <div class="col-sm-12"><h3 class="box-title">Acciones</h3></div>
                                    </div>