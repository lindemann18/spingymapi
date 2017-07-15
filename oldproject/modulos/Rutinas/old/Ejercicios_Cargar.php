<?php
require_once("../../libs/libs.php");
$consultar=new Consultar();
if(isset($_GET['id_rutina']))
{
	$tipo_rutina=$_GET['id_rutina'];
}
//Trayendo la lista de instructores para filtrar
if($tipo_rutina!="Todos"){$Result=$consultar->_ConsultarEjerciciosPorTipoRutina($tipo_rutina);}
else{$Result=$consultar->_ConsultarEjerciciosTipoRutinaGeneral();}
//$Result=$consultar->_ConsultarEjerciciosPorTipoRutina($tipo_rutina);
//tipos de músculo
$resultRutinas=$consultar->_ConsultarTiposDeRutina();
?>									
                                  <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th class="sorting_asc">CODIGO</th>
                                                <th>EJERCICIO</th>
                                                <th>DESCRIPCION</th>
                                                <th>TIPO RUTINA</th>
                                                <th>MUSCULO</th>
                                                <th>MAQUINA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($fila=$Result->fetch_assoc()):
										
											echo('
                                            <tr onclick="SeleccioinarDato('.$fila['id'].')" id=fila"'.$fila['id'].'">
                                                <td id="cliente">'.$fila['id'].'</td>
												<td>'.$fila['nb_ejercicio'].'</td>
                                                <td>'.$fila['desc_ejercicio'].'</td>
												<td>'.$fila['nb_TipoRutina'].'</td>
                                                <td>'.$fila['nb_musculo'].'</td>
												<td>'.$fila['nb_maquina'].'</td>
                                            </tr>
											');	
										
										endwhile;
										?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>CODIGO</th>
                                             	<th>EJERCICIO</th>
                                                <th>DESCRIPCION</th>
                                                <th>TIPO RUTINA</th>
                                                <th>MUSCULO</th>
                                                <th>MAQUINA</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_instructor" value="<?php echo $id_instructor?>" />
                                        <div class="col-sm-1"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="window.location='index.php?nav=Ejercicios_registrar';"><i class="fa fa-plus"></i> AGREGAR</button></div>
                                    	<div class="col-sm-1"><button class="btn btn-warning btn-sm" id="editar" title="EDITAR REGISTRO" data-original-title="EDITAR REGISTRO" onclick="Editar()"><i class="fa fa-edit"></i> EDITAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-danger btn-sm" id="eliminar" title="ELIMINAR REGISTRO" data-original-title="ELIMINAR REGISTRO"  onclick="EliminarMaquina()"><i class="fa fa-times"></i> ELIMINAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-info btn-sm" id="Mostrars" title="MOSTRAR PRUEBAS" data-original-title="MOSTRAR INSTRUCTORES"  onclick="MostrarRutinas()"><i class="fa fa-book"></i>&nbsp; Tipos De Rutinas</button></div>
                                        <div class="col-sm-2 ListaInstructores" id="">
                                            <select name="Impedimento_Entrenamiento" id="Lista_Rutinas" class="LabelPregunta form-control requerido" onchange="TipoEjercicioSeleccionado()">
                                                <option value="">Seleccionar...</option>
                                                <?php
													while($filaIns=$resultRutinas->fetch_assoc()) 
													{echo "<option value='".$filaIns['id']."'>".$filaIns['nb_TipoRutina']."</option>";}
												?>
                                                <option value="Todos">Todos</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12"><h3 class="box-title">Acciones</h3></div>
                                    </div>