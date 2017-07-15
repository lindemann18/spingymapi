<style type="text/css">
	.ListaInstructores {margin-left: 4%; margin-top: 0%; visibility:hidden}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		
?>
			<!--Modal de enviando -->
            
            <div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 id="TextoModal">Enviando...</h1>
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
										$id_instructor=$_SESSION['Sesion']['id_usuario'];
										$ResultInstructores=$consultar->_ConsultarInstructores($id_instructor);
										//instructores
										$result = $consultar->_ReporteEntrenadoresRutinasYBiotest();
										$RS_num = $result->num_rows;
									?>									
                                    <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th class="sorting_asc">CODIGO</th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>RUTINAS CREADAS</th>
                                                <th>RUTINAS ASIGNADAS</th>
                                                <th>BIOTEST</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($fila=$result->fetch_assoc()):
										
											echo('
                                            <tr onclick="SeleccioinarDato('.$fila['id_usuario'].')" id=fila"'.$fila['id_usuario'].'">
                                                <td id="cliente">'.$fila['id_usuario'].'</td>
												<td>'.$fila['nb_nombre'].'</td>
												<td>'.$fila['nb_apellidos'].'</td>
                                                <td>'.$fila['Rutina_Creada'].'</td>
                                                <td>'.$fila['Rutina_Asignada'].'</td>
                                                <td>'.$fila['biotest_hecho'].'</td>
												
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
                                                <th>RUTINAS CREADAS</th>
                                                <th>RUTINAS ASIGNADAS</th>
                                                <th>BIOTEST</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_instructor" value="<?php echo $id_instructor?>" />
                                        <div class="col-sm-1"><button class="btn btn-info btn-sm" id="Mostrars" title="MOSTRAR INSTRUCTORES" data-original-title="MOSTRAR INSTRUCTORES"  onclick="ReportePdf()"></i>&nbsp; Mostrar Reporte PDF</button></div>
                                        <div class="col-sm-1">&nbsp;</div>
                                      	<div class="col-sm-1"><button class="btn btn-success btn-sm" id="Mostrars" title="MOSTRAR INSTRUCTORES" data-original-title="MOSTRAR INSTRUCTORES"  onclick="EnviarReportePdf()"></i>&nbsp; Enviar Reporte PDF</button></div>
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
	$('#m-reportes').addClass('active');
	
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
	var url="modulos/Reportes/ClientesCargar.php?id_instructor="+id_instructor;
		$.ajax({   
		type: "POST",
		url:url="modulos/Reportes/ClientesCargar.php?id_instructor="+id_instructor,
		success: function(datos)
			{    
				$('#TablaDatos').html(datos).hide();
				$('#TablaDatos').show('slideDown');
				LoadTable();
			}
		});
		
}//ClientesConInstructorSeleccionado



function ReportePdf()
{
	var confirmacion = confirm('¿Está seguro de Imprimir este Reporte?');
		if(confirmacion == true){
			
				window.open('modulos/Reportes/EntrenadoresPdf.php');
			
		}
}//Mostrarinstructores

function EnviarReportePdf()
{
	//Mostrando el modal
	$("#pleaseWaitDialog").modal('show');
	//Mandar a generar el pdf.	
	$.ajax("modulos/Reportes/EntrenadoresPdf.php?Mail=1").then(function(response)
	{	
		var objJSON = eval("(function(){return " + response + ";})()");
		id_usuario=objJSON.id_usuario;
		//Redirigir a la otra página
		$("#TextoModal").text("Reporte Enviado");
		$("#pleaseWaitDialog").modal('hide');
		
	})
}//EnviarRutina


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

function ImprimirFormulario(id)
{
	var confirmacion = confirm('¿Está seguro de Imprimir este formulario?');
		if(confirmacion == true){
			
				window.open('modulos/Reportes/pdf/ReporteCliente.php?id='+id);
			
		}
}//ImprimirFormulario
</script>

