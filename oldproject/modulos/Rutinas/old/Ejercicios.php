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
                        Rutinas
                        <small>Listado Ejercicios</small>
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
                        Listado de Ejercicios
                        <small>
                        	En este apartado encontrará a todas las Ejercicios registrados en <span class="text-red">spin gym</span>, a demás podrá dar de alta,
                            editar o incluso dar de baja a las m&aacute;quinasque necesite.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="EjercicioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong>Ejercicio Eliminado.</div>
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
										$tipo_rutina=3; //por default el primer 1 d eprueba será el 1 el de condición física
										$Result=$consultar->_ConsultarEjerciciosPorTipoRutina($tipo_rutina);
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
	$('#m-rutinas').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	//$('#nb_cliente').focus();
	
	idEjercicio=0;
	LoadTable();
		
	
});//document ready

function TipoEjercicioSeleccionado()
{
	id_rutina=$("#Lista_Rutinas").val();

	var url="modulos/Rutinas/Ejercicios_Cargar.php?id_rutina="+id_rutina;
		$.ajax({   
		type: "POST",
		url:url="modulos/Rutinas/Ejercicios_Cargar.php?id_rutina="+id_rutina,
		success: function(datos)
			{    
				$('#TablaDatos').html(datos).hide();
				$('#TablaDatos').show('slideDown');
				LoadTable();
			}
		});
		
}

function MostrarRutinas()
{
	$("#Lista_Rutinas").css("visibility","visible");
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
	idEjercicio=(idEjercicio==id)?0:id;
}


function Editar()
{
	var confirmacion = confirm('¿Está seguro de editar esta Ejercicio?');
		if(confirmacion == true){
			if(idEjercicio!=0){window.location='index.php?nav=Ejercicio_Editar&id='+idEjercicio;}
			else {alert("Por favor selecciona alguna máquina para editar");}
		}//if true
}//Editar


function EliminarMaquina()
{

		var confirmacion = confirm('¿Está seguro de eliminar este registro?\n\nSe perderán todos los datos.');
		if(confirmacion == true){
			if(idEjercicio!=0)
			{
				var Arr=new Object();
				Arr['id_Ejercicio']		= idEjercicio;
				Arr['Accion']			="EliminarEjercicio";
				idEjercicio=0; //se devuelve a 0 el id de eliminar
	var Params= JSON.stringify(Arr);	
	$.ajax({
				
				cache: false,
				type: "GET",
				contentType:false,
				processData:false,
				url: "modulos/Rutinas/Funciones.php?Params="+Params,
				data: Params,
				datatype:"json",
				success: function(response){
					//console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					
					//Verificando si exisen rutinas ligadas a estos ejercicios
					Existente = objJSON.Rutinas.Existente;
					
					if(Existente >0)
					{
						Rutinas   = objJSON.Rutinas.Rutinas;
						SizeVec   = Rutinas.length;
						console.log(Rutinas);
						RutinasDesp = new Array();
					
						for(i=0; i<SizeVec; i++)
						{
							Rutina 	 		    = new Object();
							Rut   			    = Rutinas[i]; 
							Rutina.id_Ejercicio = Rut.id_Ejercicio;
							Rutina.nb_ejercicio = Rut.nb_ejercicio;
							Rutina.nb_rutina    = Rut.nb_rutina;
							Rutina.categoria    = Rut.categoria;
							Rutina.nb_nombre    = (Existente==2)?Rut.nb_nombre:"";
							Rutina.nb_apellidos = (Existente==2)?Rut.nb_apellidos:"";
							RutinasDesp.push(Rutina);
						}//for
					
						//console.log(RutinasDesp);
						var RutinasJson = JSON.stringify(RutinasDesp);	
						console.log(RutinasJson);
						//Creando la cookie de las rutinas.
						$.cookie("RutinasJson",RutinasJson);
						//window.location='index.php?nav=Error_Rutina'; //Elegir rutinas porm día
						//Se pegará el formulario y redirijirá
						$('#TablaDatos').append($('<form id="FormError" action="index.php?nav=Error_Rutina" method="post"></form>'));
						$("#FormError").append('<input type="hidden" name="Rutinas" value="'+RutinasJson+'">');
						if(Existente==1)$("#FormError").append('<input type="hidden" name="Error" value="Ejercicios">');
						if(Existente==2)$("#FormError").append('<input type="hidden" name="Error" value="EjerciciosClientes">');
						$("#FormError").submit();	
					}//if
					
					else
					{
						//Mostrando la notificación de eliminado
						$("#EjercicioEliminadoNotificacion").css("display","inherit");
						$("#EjercicioEliminadoNotificacion").delay( 8000 ).fadeOut();
						
						//Pegando de nuevo el contenido
						id_instructor=$("#id_instructor").val();
						 var url="modulos/Rutinas/Ejercicios_Cargar.php?id_rutina="+3;
							$.ajax({   
								type: "POST",
								url:url,
								success: function(datos){    
									$('#TablaDatos').html(datos).hide();
									$('#TablaDatos').show('slideDown');
									LoadTable();
								}
							});
					  }//else
				}
				
			});	
			
			}else{alert("Seleccione un Ejercicio para eliminar");}
		}
	
}//EliminarMaquina

function TipoMaquinaSeleccionado()
{
	id_Musculo=$("#Lista_Musculos").val();
	var Arr=new Object();
	
		$.ajax({   
		type: "POST",
		url:url="modulos/Utilidades/Maquinas_Cargar.php?id_Musculo="+id_Musculo,
		success: function(datos)
			{    
				$('#TablaDatos').html(datos).hide();
				$('#TablaDatos').show('slideDown');
				LoadTable();
			}
		});
}//TipoMaquinaSeleccionado

</script>

