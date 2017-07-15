<style type="text/css">
	.ListaInstructores {margin-left: 4%; margin-top: 0%; visibility:hidden}
	.Arriba{margin-top: 1%;}
	.Izquierda{margin-left: 3%;}
	.Derecha {margin-right: 15%;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		$consultar=new Consultar();
		$id_cliente=$_GET['id_cliente']; //id del cliente para tomar rutina
		
		//verificando que el cliente tiene una rutina activa
		$resultRutina = $consultar->_ConsultarRutinasClientesPorIdCliente($id_cliente);
		$num_rutina	  = $resultRutina->num_rows;
		if($num_rutina > 0) 
		{
			$rutina = true; //Puede acceder al apartado de editar rutina
			//Tomar los datos de la rutina
			$fila 	 		= $resultRutina->fetch_assoc();
			$idRutina 		= $fila['id_rutinaCliente'];
			$result   		= $consultar->_ConsultarInformacionRutinaPreFinalClientePorId($idRutina);
			$num_ejercicios = $result->num_rows;
		}
		else 
		{
			$rutina = false; //No existe rutina así que debe crear una primero	
		}
		
		
?>
            
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rutinas
                        <small>Finalizar Rutina</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">Rutinas</li>
                    </ol>
                </section>
                
                
			<!--Modal de enviando -->
            
            <div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1>Enviando...</h1>
                        </div>
                    <div class="modal-body">
                        <div class="progress progress-striped active">
                        <div class="progress-bar progress-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        
                        </div>
                        </div>
                    </div><!-- modal body-->
                    <div class="modal-footer">
                    </div>
                    </div>
                </div>
            </div><!-- pleaseWaitDialog-->
            
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Listado de Clientes
                        <small>
                        	En este apartado encontrará toda la informaci&oacute;n de la rutina registrada para  los Clientes de <span class="text-red">spin gym</span>,
                            podrá dar de alta los n&uacute;meros de repeticiones y de circuitos para cada ejercicio de toda la rutina.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4>Para relizar alg&uacute;n cambio de click sobre los campos vac&iacute;os (o con n&uacute;meros si ya contiene) de <strong>Repeticiones</strong>
                                        	y <strong>Circuitos</strong>, anote los números y presionte <strong>Enter</strong>.
                                        </h4>
                                    </div>
                                </div><!-- /.box-header -->
                                  <div class="box-body table-responsive" id="TablaDatos">
                                	<?php
                                   	if($rutina == true)
									{ 
									?>									
                                    <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	    <th class="sorting_asc">CODIGO </th>
                                                <th>RUTINA</th>
                                                <th>DESCRIPCION</th>
                                                <th>CATEGORIA</th>
                                                <th>EJERCICIO</th>
                                                <th>REPETICIONES</th>
                                                <th>CIRCUITOS</th>
                                                <th>DIA</th>
                                                <th>TIPO RUTINA</th>
                                                <th>MUSCULO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                     <?php
                                                	for($i=0; $i<$num_ejercicios; $i++)
													{
														$fila=$result->fetch_assoc();//Sacando las filas
														echo'
															<tr id='.$fila['id_rutinaCliente'].'>
																<td>'.$fila['id_rutinaCliente'].'</td>
																<td>'.$fila['nb_rutina'].'</td>
																<td>'.$fila['desc_rutina'].'</td>
																<td>'.$fila['nb_CategoriaRutina'].'</td>
																<td>'.$fila['nb_ejercicio'].'</td>
																<td id="Val'.$fila['id_ejercicio'].'" class="Repeticiones">'.$fila['num_Repeticiones'].'</td>
																<td id="ValRu'.$fila['id_ejercicio'].'" class="Circuitos">'.$fila['num_Circuitos'].'</td>
																<td>'.$fila['nb_dia'].'</td>
																<td>'.$fila['nb_TipoRutina'].'</td>
																<td>'.$fila['nb_musculo'].'</td>
																<td>'.$fila['nb_nombre']." ".$fila['nb_apellidos'].'</td>
																<td>'.$fila['fh_Creacion'].'</td>
															</tr>
														';
														
													}//for
												?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                 <th> CODIGO </th>
                                                 <th>RUTINA</th>
                                                <th>DESCRIPCION</th>
                                                <th>CATEGORIA</th>
                                                <th>EJERCICIO</th>
                                                <th>REPETICIONES</th>
                                                <th>CIRCUITOS</th>
                                                <th>DIA</th>
                                                <th>TIPO RUTINA</th>
                                                <th>MUSCULO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_rutina" value="<?php  echo $idRutina; ?>" />
                                    	<div class="col-sm-1 Arriba"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="MenuRutina(<?php echo $id_cliente?>)"><i class="fa fa-plus"></i> Finalizar Rutina</button></div>
                                    	<div class="col-sm-1 Arriba Izquierda"><button class="btn btn-info btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="EnviarRutina()"><i class="fa fa-plus"></i> Enviar Rutina</button></div>
                                        <div class="col-sm-12"><h3 class="box-title">Acciones</h3></div>
                                    </div>
                            </div><!-- tabla datos-->
                            <?php }else  {?>
                            <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                            <div class="row">
                                <!-- COLUMNA IZQUIERDA -->
                                <div class="col-md-12">
                                    <!-- CAJA -->
                                    <div class="box box-primary">
                                        <!-- HEADER DE LA CAJA -->
                                        <div class="box-header">
                                       
                                        </div>
                                        <!-- HEADER DE LA CAJA -->
                                        
                                        <!-- CUERPO DE LA CAJA -->
                                        <div class="box-body">
                                         <div class="row">
                                         	<h3 class="box-title text-center">No Existen rutinas Todavía</h3>
                                        	<h4 class="text-center">Este cliente no tiene rutinas, favor de crear o asignar una en el apartado de rutinas. De Click al botón de menu rutinas para ir al apartado de rutinas.</h4>
                                           <div class="col-xs-5 pull-right Derecha"> <button class="btn btn-success btn-sm Izquierda" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="MenuRutina(<?php echo $id_cliente?>)"><i class="fa fa-plus"></i> Menu Rutina</button></div>
                                         </div><!--row-->
                                        </div><!-- bodbody-->
                                    </div> <!-- bbox primary-->
                                
                                </div><!-- col-md-6-->
                            </div> <!-- row-->
                            	
                            <?php }?>
                        </div>
                    </div>
                </section>
            </aside>

</div>


        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>

<script>
	 $('#listados').editableTableWidget().numericInputExample();
  $('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
  window.prettyPrint && prettyPrint();		
</script>

<script>
$(document).ready(function(){
	
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-rutinas').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	//$('#nb_cliente').focus();
	
	idClienteEliminar=0;
	
	//LoadTable(); //Cargando estilos de la tabla
	
	//función para tomar los datos y mandar las repeticinoes y circuitos a la bd
		$('table td').on('change', function(evt, newValue) {
	// do something with the new cell value 
	console.log(evt.currentTarget);
	console.log(newValue);
	console.log(evt.currentTarget.id);
	
	
	id=evt.currentTarget.id;
	id2="#"+id;
	
	if($(id2).hasClass("Repeticiones"))
	{
		idEjercicio=id.split("Val");
		console.log("el id es: "+idEjercicio[1]+" Las repeticiones son : "+newValue);
		InsertarRepeticionesBD(idEjercicio[1], newValue);
		
		
	}//If class
	
	
	if($(id2).hasClass("Circuitos"))
	{
		idEjercicio=id.split("ValRu");
		console.log("el id es: "+idEjercicio[1]+" Los Circuitos son : "+newValue);
		InsertarCircuitosBD(idEjercicio[1], newValue)
	}
	
});	// función de la tabla

//Elimando todas las cookies
var cookies = $.cookie();
for(var cookie in cookies) {
   $.removeCookie(cookie);
}
	
});//document ready


function InsertarRepeticionesBD(id, Repeticiones)
{
	//Objeto con la información a guardar en la BD
		var Arr=new Object();	
		Arr['id_ejercicio']		  = id;
		Arr['num_repeticiones']	  = Repeticiones;
		Arr['id_rutina']		  = $("#id_rutina").val();	
		Arr['Accion']		 	  = "AgregarRepeticionesEjercicio";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);
		$.ajax("modulos/Clientes/Funciones.php?Params="+Params).then(function(response){var objJSON = eval("(function(){return " + response + ";})()");})
}

function InsertarCircuitosBD(id, circuitos)
{
	//Objeto con la información a guardar en la BD
		var Arr=new Object();	
		Arr['id_ejercicio']		  = id;
		Arr['num_circuitos']	  = circuitos;
		Arr['Accion']		 	  = "AgregarCircuitosEjercicio";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);
		$.ajax("modulos/Clientes/Funciones.php?Params="+Params).then(function(response){var objJSON = eval("(function(){return " + response + ";})()");})
}

function EnviarRutina()
{
	id_rutina = $("#id_rutina").val();
	
	//Mostrando el modal
	$("#pleaseWaitDialog").modal('show');
	//Mandar a generar el pdf.	
	$.ajax("modulos/Clientes/CrearPdf.php?id_rutina="+id_rutina).then(function(response)
	{	
		var objJSON = eval("(function(){return " + response + ";})()");
		id_cliente=objJSON.id_cliente;
		//Redirigir a la otra página
		$("#pleaseWaitDialog").modal('hide');
		window.location='index.php?nav=Rutina_Enviada&id_cliente='+id_cliente;
	})
}


function MenuRutina(id)
{
	var confirmacion = confirm('¿Está seguro que desea acceder al apartado de rutinas?');
		if(confirmacion == true){
			
				window.location='index.php?nav=clientes_rutina&id_cliente='+id;
			
		}
}//MenuRutina

</script>

