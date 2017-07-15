<style type="text/css">
	.ListaInstructores {margin-left: 4%; margin-top: 0%; visibility:hidden}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Clientes
                        <small>Registrar Clientes</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">Clientes</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Listado de Clientes
                        <small>
                        	En este apartado encontrará a todos los Clientes registrados en <span class="text-red">spin gym</span>, a demás podrá dar de alta,
                            editar o incluso dar de baja a los Clientes que necesite.
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
                                    	<h4>Para realizar alguna acción con un registro, por favor de clic sobre la información correspondiente
                                        del cliente para seleccionarlo, y a continuación, de clic en alguno de los botones EDITAR o ELIMINAR.</h4>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive" id="TablaDatos">
                                	<?php
                                    	$consultar=new Consultar();
										
										//Trayendo la lista de instructores para filtrar
										$id_instructor		= $_SESSION['Sesion']['id_usuario'];
										$ResultInstructores = $consultar->_ConsultarInstructores($id_instructor);
										
										//instructores
										//$result=$consultar->_ConsultarClientesPorInstructor($id_instructor);
										$result = $consultar->_ConsultarClientes(); 
										$RS_num = $result->num_rows;
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
												<td><button type="button" class="btn btn-info" onclick="_ClienteRutina('.$fila['id_cliente'].')">Rutina</button></td>
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
                                </div><!---TablaDatos --->
                            </div>
                        </div>
                    </div>
                </section>
            </aside>

</div>


        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listadp.php';
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-clientes').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	//$('#nb_cliente').focus();
	
	idClienteEliminar=0;
	LoadTable();
		
	
});//document ready

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
		
}//ClientesConInstructorSeleccionado

function _ClienteRutina(id)
{
	var confirmacion = confirm('¿Está seguro que desea acceder al apartado de rutina?');
		if(confirmacion == true){
			
				window.location='index.php?nav=clientes_rutina&id_cliente='+id;
			
		}
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
				$('#listados tbody').on( 'click', 'tr', function () {
					//SI LA FILA TIENE LA CLASE bg-blue
					if ( $(this).hasClass('bg-blue') ) {
						//ELIMINAMOS LA CLASE (CON ELLO SIMULAMOS QUE DEJAMOS DE TENERLA SELECCIONADA)
						$(this).removeClass('bg-blue');
					}
					//SI NO
					else {
						//NOS ASEGURAMOS QUE NINGUN TR LA TENGA
						tabla.$('tr.bg-blue').removeClass('bg-blue');
						//AÑADIMOS LA CLASE SOLAMENTE AL TR SOBRE EL QUE SE DIO CLIC
						$(this).addClass('bg-blue');
						//ASIGNAMOS A idcliente LA BUSQUEDA DE LA CELDA DEL TR CON CLASE bg-blue E ID cliente
						idcliente = $(this).find($('.bg-blue #cliente'));
					}
				} );
}//LoadTable

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
					// var url="modulos/Clientes/ClientesCargar.php?id_instructor="+id_instructor;
					 var url="modulos/Clientes/ClientesCargar.php?id_instructor=Todos";
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

