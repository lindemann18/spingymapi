<style type="text/css">
	.ListaInstructores {margin-left: 4%; margin-top: 0%; visibility:hidden}
	.size {font-size: 12.5px;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		$consultar 		= new Consultar();
		$idRutina  		= $_GET['Rutina'];
		$result	   		= $consultar->_ConsultarInformacionRutinaPreFinalPorId($idRutina);
		$num_ejercicios = $result->num_rows;
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
                                   
									?>									
                                    <table id="listados" class="table table-bordered table-striped col-xs-11 col-sm-11 size">
                                        <thead>
                                            <tr>
                                            	    <th class="sorting_asc">CODIGO </th>
                                                <th>RUTINA</th>
                                                <th>DESCRIPCION</th>
                                                <th>CATEGORIA</th>
                                                <th>EJERCICIO</th>
                                                <th>REPETICIONES</th>
                                                <th>SERIES</th>
                                                <th>DIA</th>
                                                <th>TIPO RUTINA</th>
                                                <th>MUSCULO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</td>
                                                <th>RELACION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     <?php
                                                	for($i=0; $i<$num_ejercicios; $i++)
													{
														$fila=$result->fetch_assoc();//Sacando las filas
														echo'
															<tr id='.$fila['id_rutina'].'>
																<td>'.$fila['id_PosicionEjercicio'].'</td>
																<td>'.$fila['nb_rutina'].'</td>
																<td>'.$fila['desc_rutina'].'</td>
																<td>'.$fila['nb_CategoriaRutina'].'</td>
																<td>'.$fila['nb_ejercicio'].'</td>
																<td id="Val'.$fila['id_ejercicio'].'"
																 class="Repeticiones text-center">'.$fila['num_Repeticiones'].'</td>
																<td id="ValRu'.$fila['id_ejercicio'].'" 
																class="Circuitos text-center">'.$fila['num_Circuitos'].'</td>
																<td>'.$fila['nb_dia'].'</td>
																<td>'.$fila['nb_TipoRutina'].'</td>
																<td>'.$fila['nb_musculo'].'</td>
																<td>'.$fila['nb_nombre']." ".$fila['nb_apellidos'].'</td>
																<td>'.$fila['fh_Creacion'].'</td>
																<td id="ValRe'.$fila['id_ejercicio'].'"  
																class="Relacion text-center">'.$fila['ejercicio_relacion'].'</td>
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
                                                <th>SERIES</th>
                                                <th>DIA</th>
                                                <th>TIPO RUTINA</th>
                                                <th>MUSCULO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</td>
                                                <th>RELACION</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_rutina" value="<?php  echo $idRutina?>" />
                                    	<div class="col-sm-1"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="FinalizarRutina()"><i class="fa fa-plus"></i> Finalizar Rutina</button></div>
                                    	
                                        <div class="col-sm-12"><h3 class="box-title">Acciones</h3></div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>

</div>


        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>

<script>
	 //$('#listados').editableTableWidget().numericInputExample();
  
  //$('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
  //window.prettyPrint && prettyPrint();		
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
	
	console.log(id2);
	if($(id2).hasClass("Repeticiones"))
	{
		if($.isNumeric(newValue))
		{
			id_rutina 	= $("#id_rutina").val();
			idEjercicio = id.split("Val");
			console.log("el id es: "+idEjercicio[1]+" Las repeticiones son : "+newValue);
			InsertarRepeticionesBD(idEjercicio[1], newValue,id_rutina);
		}//if
		else
		{
			alert("Favor de ingresar un número válido.");
		}//else
		
	}//If class
	
	
	if($(id2).hasClass("Circuitos"))
	{
		if($.isNumeric(newValue))
		{
			id_rutina 	= $("#id_rutina").val();
			idEjercicio = id.split("ValRu");
			console.log("el id es: "+idEjercicio[1]+" Los Circuitos son : "+newValue);
			InsertarCircuitosBD(idEjercicio[1], newValue)
		}
		else
		{
			alert("Favor de ingresar un número válido.");
		}//else
	}
	
	if($(id2).hasClass("Relacion"))
	{
		id_rutina 	= $("#id_rutina").val();
		idEjercicio = id.split("ValRe");
		console.log("el id es: "+idEjercicio[1]+" La relación es : "+newValue);
		InsertarRelacionEjerciciosBD(idEjercicio[1],newValue);
	}
	
	
	
});	// función de la tabla

//Elimando todas las cookies
var cookies = $.cookie();
for(var cookie in cookies) {
   $.removeCookie(cookie);
}
	
});//document ready

function InsertarRepeticionesBD(id, repeticiones,id_rutina)
{
	
		//Objeto con la información a guardar en la BD
		var Arr=new Object();	
		Arr['id_rutina']		  = id_rutina;
		Arr['id_ejercicio']		  = id;
		Arr['num_repeticiones']	  = repeticiones;
		Arr['Accion']		 	  = "AgregarRepeticionesEjercicio";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);
		$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){var objJSON = eval("(function(){return " + response + ";})()");})
}//InsertarRepeticionesBD

function InsertarCircuitosBD(id, circuitos,id_rutina)
{
	//Objeto con la información a guardar en la BD
		var Arr=new Object();	
		Arr['id_rutina']		  = id_rutina;
		Arr['id_ejercicio']		  = id;
		Arr['num_circuitos']	  = circuitos;
		Arr['Accion']		 	  = "AgregarCircuitosEjercicio";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);
		$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){var objJSON = eval("(function(){return " + response + ";})()");})
}

function InsertarRelacionEjerciciosBD(id,relacion)
{
	//Objeto con la información a guardar en la BD
		var Arr=new Object();	
		Arr['id_ejercicio']		  = id;
		Arr['relacion']			  = relacion;
		Arr['Accion']		 	  = "AgregarRelacionEjercicio";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);
		$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response)
		{
			var objJSON = eval("(function(){return " + response + ";})()");
		});
}//InsertarRelacionEjerciciosBD

function ClientesConInstructorSeleccionado()
{
	id_instructor=$("#Lista_Entrenadores").val();
	var Arr=new Object();
	Arr['id_instructor']		= id_instructor;
	var Params= JSON.stringify(Arr);	
	var url="modulos/Clientes/ClientesCargar.php?id_instructor="+id_instructor;
		$.ajax({   
		type: "POST",
		url:url="modulos/Clientes/ClientesCargar.php?id_instructor="+id_instructor,
		success: function(datos)
			{    
				$('#TablaDatos').html(datos).hide();
				$('#TablaDatos').show('slideDown');
				LoadTable();
			}
		});
		
}

function Mostrarinstructores()
{
	$(".ListaInstructores").css("visibility","visible");
}//Mostrarinstructores

function LoadTable()
{
	//CREA LA TABLA EN FORMATO BOOTSTRAP DATATABLE
				tabla = $('#listados').dataTable( {
					"aaSorting": [[0,'asc']],						//ORDENA DE FORMA DESCENDENTE LA PRIMER COLUMNA (RECORDAR QUE EN LOS ARREGLOS SE COMIENZA DESDE CERO [0] )
					"oLanguage": {									//PARAMETROS DE IDIOMA
				 		"oPaginate": {								//PARAMETROS DE PAGINADOR
							"sFirst"	: "Primera Página",			//TEXTO PARA PAGINADOR, BOTON PRIMERA PAGINA
							"sLast"		: "Última Página",			//TEXTO PARA PAGINADOR, BOTON ULTIMA PAGINA
				 			"sNext"		: "Siguiente",				//TEXTO PARA PAGINADOR, BOTON SIGUIENTE
							"sPrevious"	: "Anterior"				//TEXTO PARA PAGINADOR, BOTON ANTERIOR
				 		},
						"sInfo"				: "Mostrando _START_ al _END_ de _TOTAL_ registros.",						//INFORMACION DE MUESTREO
						"sLoadingRecords"	: "Cargando registros...",													//LEYENDA CARGANDO
						"sProcessing"		: "Procesando...",															//LEYENDA PROCESANDO
						"sSearch"			: "Buscar registro:",														//LEYENDA BUSCAR REGISTRO
						"sZeroRecords"		: "No hay registros que concidan con esos datos. Busque de nuevo.",			//LEYENDA CERO COINCIDENCIAS
						"sInfoEmpty"		: "Mostrando 0 registros",													//LEYENDA MOSTRANDO CERO REGISTROS
						"sInfoFiltered"		: "(filtrados de un total de _MAX_ registros.)"								//LEYENDA TOTAL DE x REGISTROS
				 	}
				 });
				 
				//VARIABLE USADA PARA OBTENER EL NUMERO ID DEL CLIENTE
				var idcliente = '';
				//AL HACER CLIC SOBRE UNA FILA
		
}//LoadTable


function FinalizarRutina()
{
		var confirmacion = confirm('¿Está seguro de finalizar esta rutina?');
		if(confirmacion == true){
		
				window.location='index.php?nav=Rutinas';
			
		}	
}//FinalizarRutina

function SeleccioinarDato(id)
{
	idClienteEliminar=(idClienteEliminar==id)?0:id;
}

function EliminarCliente()
{

		var confirmacion = confirm('¿Está seguro de eliminar este registro?\n\nSe perderán todos los datos.');
		if(confirmacion == true){
			if(idClienteEliminar!=0)
			{
				var Arr=new Object();
				Arr['id_cliente']		= idClienteEliminar;
				Arr['Accion']			="Eliminar";
				idClienteEliminar=0; //se devuelve a 0 el id de eliminar
	var Params= JSON.stringify(Arr);	
	$.ajax({
				
				cache: false,
				type: "GET",
				contentType:false,
				processData:false,
				url: "modulos/Clientes/Funciones.php?Params="+Params,
				data: Params,
				datatype:"json",
				success: function(response){
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					//Mostrando la notificación de eliminado
					$("#UsuarioEliminadoNotificacion").css("display","inherit");
					$("#UsuarioEliminadoNotificacion").delay( 8000 ).fadeOut();
					
					//Pegando de nuevo el contenido
					id_instructor=$("#id_instructor").val();
					 var url="modulos/Clientes/ClientesCargar.php?id_instructor="+id_instructor;
						$.ajax({   
							type: "POST",
							url:url,
							success: function(datos){    
								$('#TablaDatos').html(datos).hide();
								$('#TablaDatos').show('slideDown');
								LoadTable();
							}
						});
					
				}
				
			});	
			
			}else{alert("Seleccione un usuario para eliminar");}
		}
	
}//EliminarUsuario

function Editar()
{
		var confirmacion = confirm('¿Está seguro de Editar este registro?');
		if(confirmacion == true){
			if(idClienteEliminar!=0)
			{
				window.location='index.php?nav=clientes_editar&id='+idClienteEliminar;
			}else{alert("Seleccione un usuario para Editar");}
		}
}//Editar

function BioTest(id_cliente)
{
	var confirmacion = confirm('¿Está seguro de Correr el BIOTEST?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Biotest&id='+id_cliente;
			
		}
}//BioTest

function Formulario(id_cliente)
{
	var confirmacion = confirm('¿Está seguro de hacer el FORMULARIO?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Formulario&id='+id_cliente;
			
		}
}

</script>

