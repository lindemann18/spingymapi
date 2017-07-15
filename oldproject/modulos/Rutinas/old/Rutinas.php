<style type="text/css">
	.ListaInstructores {margin-left: 0%; margin-top: 0%; visibility:hidden}
	.Right {margin-right: 2.5%;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		$id_usuario=$_SESSION['Sesion']['id_usuario']; //id del uusuario actual en sesión
		
		$consultar		= new Consultar();
		$ResultUsuarios = $consultar->_ConsultarUsuarios();
		
		//Lista de usuarios con Rutinas para el combo select
		$ResultEntrenadoresRutinas = $consultar->_ConsultarListaEntrenadoresConRutinasSoloNombres();
		
		
		//Verificando si el usuario actual ha hecho rutinas, de no ser así se mostrarán las rutinas de cualquier otro entrenador
		$resultVerificacion = $consultar->_ConsultarUsuarioVerificarSiTieneRutinas($id_usuario);
		$numVerificacion	= $resultVerificacion->num_rows; //Número que nos dice si existen rutinas, de existir se buscan rutinas de este usuario
		if($numVerificacion>0)
		{
			//Verificando que categorías de rutinas tiene el Entrenador.
			$ResultCategoriasRutinas = $consultar->_ConsultarCategoriaRutinasDelEntrenador($id_usuario);
			$numCategorias			 = $ResultCategoriasRutinas->num_rows;
			$id_CategoriaBuscar		 = 0;
			
			for($i=0; $i<$numCategorias; $i++)
			{
				$fila=$ResultCategoriasRutinas->fetch_assoc();
				switch($fila['id_categoria'])
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
					
				}//switch
				
			}//for
			//las rutinas van por id 1) principiantes 2) intermedio 3) avanzado.
			$resultRutinas=$consultar->_ConsultarRutinaPorEntrenadorYCategoriaDeRutina($id_usuario,$id_CategoriaBuscar,"Todos"); //el 1 es por que muestra las rutinas de principiantes.
			
			//Se agregaron estas líneas aquí para buscar que en cualqueir situación al entrar muestre Todas las rutinas.
			$resultRutinas = $consultar->_ConsultarRutinasTotales("Todos");
		}//if
		else 
		{
			//Si el entrenador actual no tiene rutinas, le aparecerán de los que si tienen Rutinas
			$resultEntrenadores		   = $consultar->_ConsultarEntrenadoresConRutinas(); //Buscando entrenadores que si cuenten con rutina
			$filaEntrenadoresConRutina = $resultEntrenadores->fetch_assoc(); //Tomando los datos del primer registro
			$id_usuarioRutina		   = $filaEntrenadoresConRutina['id_usuario']; //tomandl el id
			
			//Buscando que categorías de rutina tiene
			$resultTiposCategorias = $consultar->_ConsultarCategoriaRutinasDelEntrenador($id_usuarioRutina);
			$numCategoriasRutinas  = $resultTiposCategorias->num_rows;
			
			$id_CategoriaBuscar=0; //Categoría con la cual se buscarán las rutinas
			for($i=0; $i<$numCategoriasRutinas; $i++)
			{
				$filaCategoriaRutinas=$resultTiposCategorias->fetch_assoc();
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
					
				}//switch
			}//for
			
			//$resultRutinas=$consultar->_ConsultarRutinaPorEntrenadorYCategoriaDeRutina($id_usuarioRutina,$id_CategoriaBuscar); 
			$resultRutinas = $consultar->_ConsultarRutinasTotales();
		}//else
		
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rutinas
                        <small>Listado Rutinas</small>
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
                        Listado de Rutinas
                        <small>
                        	En este apartado encontrará a todas las Rutinas registradas en <span class="text-red">spin gym</span>, a demás podrá dar de alta,
                            editar o incluso dar de baja a las Rutinas que necesite.
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
										
										//Trayendo la lista de instructores para filtrar
										
										//tipos de músculo
									?>									
                                    <table id="listados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr >
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
                                            	<th class="text-center">CODIGO</th>
                                             	<th class="text-center">RUTINA</th>
                                                <th class="text-center">DESCRIPCION</th>
                                                <th class="text-center">CATEGORIA</th>
                                                <th class="text-center">GENERO</th>
                                                <th class="text-center">CUERPO</th>
                                                <th class="text-center">ENTRENADOR</th>
                                                <th class="text-center">FECHA</th>
                                                <th class="text-center">INFORMACION</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                    	<input type="hidden" id="id_instructor" value="<?php echo $id_usuario?>" />
                                        <input type="hidden" id="id_CategoriaBuscar" value="<?php echo $id_CategoriaBuscar?>">
                                        <div class="col-sm-1"><button class="btn btn-success btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="window.location='index.php?nav=Rutinas_registrar';"><i class="fa fa-plus"></i> AGREGAR</button></div>
                                    	<div class="col-sm-1"><button class="btn btn-warning btn-sm" id="editar" title="EDITAR REGISTRO" data-original-title="EDITAR REGISTRO" onclick="Editar()"><i class="fa fa-edit"></i> EDITAR</button></div>
                                        <div class="col-sm-1"><button class="btn btn-danger btn-sm" id="eliminar" title="ELIMINAR REGISTRO" data-original-title="ELIMINAR REGISTRO"  onclick="EliminarRutina()"><i class="fa fa-times"></i> ELIMINAR</button></div>
                                        <div class="col-sm-1 Right"><button class="btn btn-info btn-sm " id="Mostrars" title="MOSTRAR PRUEBAS" data-original-title="MOSTRAR INSTRUCTORES"  onclick="MostrarInstructores()"><i class="fa fa-male"></i> INSTRUCTORES</button></div>
                                      <!--  <div class="col-sm-1 Right">
                                        	<button class="btn btn-info btn-sm" id="Mostrars" title="MOSTRAR PRUEBAS" 
                                            data-original-title="MOSTRAR INSTRUCTORES"  onclick="MostrarRutinas()">
                                            <i class="fa fa-book"></i> TIPOS RUTINA</button>
                                        </div>-->
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
	
	idRutina=0;
	LoadTable();
		
	
});//document ready

function InfoRutina(id)
{
	var confirmacion = confirm('¿Está seguro desea ver la información de  esta rutina?');
		if(confirmacion == true){
		
				window.location='index.php?nav=RutinaOrdenEnt&id_Rutina='+id;
			
		}	
}

function FiltrarRutinas()
{
		var confirmacion = confirm('¿Está seguro de Filtrar las rutinas?.');
		if(confirmacion == true)
		{
			id_entrenador	   = $("#Lista_Entrenadores").val(); //id del entrenador de la rutina
			id_CategoriaRutina = $("#Lista_Rutinas").val();		//id de la categoría da la rutina
			id_Genero	  	   = $("#Lista_Genero").val(); 	   //id del género de la rutina a filtrar
			
			//Verificando que ambos tienen valores 
			if(id_entrenador!="" && id_CategoriaRutina!="" && id_Genero!="")
			{
	
					 var url="modulos/Rutinas/Rutinas_Cargar.php?id_entrenador="+id_entrenador+"&id_CategoriaRutina="+id_CategoriaRutina+"&id_Genero="+id_Genero;
						$.ajax({   
							type: "POST",
							url:url,
							success: function(datos){    
								$('#TablaDatos').html(datos).hide();
								$('#TablaDatos').show('slideDown');
								LoadTable();
							}
						});
					
			} //if datos diferentes de ""
			else {alert("Por favor seleccione algún entrenador, tipo de rutina y género para filtrar");}
			
		} //if confirmación
		else {}
	
	
}//FiltrarRutinas

function TipoEntrenadorSeleccionado()
{
	id_entrenador = $("#Lista_Entrenadores").val(); //tomando el id del entrenador
	$("#Lista_Rutinas").css("visibility","visible"); //Mostrando el tipo de rutina que se puede seleccionar
	if(id_entrenador!="Todos")
	{
		//Objeto a mandar para buscar los tipos de rutinas con los que cuenta el entrenador
		var Arr=new Object();	
		Arr['id_entrenador']	= id_entrenador;
		Arr['Accion']			="BuscarCategoriaRutinasPorEntrenador";
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
					var objJSON = eval("(function(){return " + response + ";})()");
					console.log(objJSON);
					clearSelect("Lista_Rutinas");
					
					//Pegando las opciones de máquinas
					$("#Lista_Rutinas").append("<option value=''>Seleccionar...</option>");
					//Pegando las opciones de rutinas
					for(i=0; i<objJSON.Categorias.length; i++)
					{
						Categorias = objJSON.Categorias[i];
						AgregarOption("Lista_Rutinas",Categorias.id_categoria,Categorias.nb_CategoriaRutina);
					}//for
					AgregarOption("Lista_Rutinas","Todos","Todos");
					//Pegando las opciones de rutinas
				}
				
			});	
	}//if
	else
	{
		//Objeto a mandar para buscar los tipos de rutinas con los que cuenta el entrenador
		var Arr					= new Object();	
		Arr['id_entrenador']	= id_entrenador;
		Arr['Accion']			="BuscarCategoriaRutinasGeneral";
		var Params= JSON.stringify(Arr);
		
		$.post( "modulos/Rutinas/Funciones.php", { Params: Params})
  		.done(function( response ) {
			var objJSON = eval("(function(){return " + response + ";})()");
			console.log(objJSON);
			clearSelect("Lista_Rutinas");
			
			//Pegando las opciones de máquinas
			$("#Lista_Rutinas").append("<option value=''>Seleccionar...</option>");
			console.log(objJSON.Categorias);
			//Pegando las opciones de rutinas
			for(i=0; i<objJSON.Categorias.length; i++)
			{
				Categorias = objJSON.Categorias[i];
				AgregarOption("Lista_Rutinas",Categorias.id_categoria,Categorias.nb_CategoriaRutina);
			}//for
			//Pegando las opciones de rutinas
			
 		 });//Done
	}//else
	
}//TipoEntrenadorSeleccionado

function AsignarGeneroRutina()
{
	Lista_Rutinas = $("#Lista_Rutinas").val();
	id_entrenador = $("#Lista_Entrenadores").val(); //tomando el id del entrenador
	$("#Lista_Genero").css("visibility","visible"); //Mostrando el tipo de rutina que se puede seleccionar
	if(Lista_Rutinas!="")
	{
		var Arr					= new Object();	
		Arr['id_entrenador']	= id_entrenador;
		Arr['Lista_Rutinas']	= Lista_Rutinas;
		Arr['Accion']			="BuscarGeneroRutinas";
		var Params= JSON.stringify(Arr);
		$.post( "modulos/Rutinas/Funciones.php", { Params: Params})
  		.done(function( response ) {
			var json = eval("(function(){return " + response + ";})()");
			console.log(json);
			
			//Pegando las opciones al select.
			
			clearSelect("Lista_Genero");
			
			//Pegando las opciones de máquinas
			$("#Lista_Genero").append("<option value=''>Seleccionar...</option>");
			Generos = json.Generos;
			//Pegando las opciones de rutinas
			for(i=0; i<json.Generos.length; i++)
			{
				Genero = Generos[i];
				AgregarOption("Lista_Genero",Genero.id,Genero.nb_TipoRutina);
			}//for
			AgregarOption("Lista_Genero","Todos","Todos");
			
 		 });//Don	
	}//if
}//AsignarGeneroRutina

function MostrarInstructores()
{
	$("#Lista_Entrenadores").css("visibility","visible");
}//Mostrarinstructores

function AgregarOption(idcombo,value,text)
 {
 	option=document.createElement('option');
	option.value=value;
	option.text=text;
	cel=document.getElementById(idcombo);
	cel.options.add(option);
 }	

function clearSelect(idSelect)
{
	sel= document.getElementById(idSelect);
	tope= sel.options.length - 1;
	for (ind= tope; ind > -1; ind--)
	{
		sel.options.remove(ind);
	} //for
}//clearSelect

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
	idRutina=(idRutina==id)?0:id;
}


function Editar()
{
	var confirmacion = confirm('¿Está seguro de editar esta Rutina?');
		if(confirmacion == true){
			if(idRutina!=0){window.location='index.php?nav=Rutinas_EditarDatos&id_rutina='+idRutina;}
			else {alert("Por favor selecciona alguna Rutina para editar");}
		}//if true
}//Editar


function EliminarRutina()
{
	//Tomando los valores actuales
	id_instructor		= $("#id_instructor").val();
	id_CategoriaBuscar	= $("#id_CategoriaBuscar").val();
	
		var confirmacion = confirm('¿Está seguro de eliminar este registro?\n\nSe perderán todos los datos.');
		if(confirmacion == true){
			if(idRutina!=0)
			{
				var Arr=new Object();
				Arr['idRutina']	= idRutina;
				Arr['Accion']	= "EliminarRutinaPorId";
				idRutina=0; //se devuelve a 0 el id de eliminar
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
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					//Mostrando la notificación de eliminado
					$("#EjercicioEliminadoNotificacion").css("display","inherit");
					$("#EjercicioEliminadoNotificacion").delay( 8000 ).fadeOut();
					
					//Pegando de nuevo el contenido
					id_instructor=$("#id_instructor").val();
					 var url="modulos/Rutinas/Rutinas_Cargar.php?id_entrenador="+id_instructor+"&id_CategoriaRutina="+id_CategoriaBuscar;
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
			
			}else{alert("Seleccione una Máquina para eliminar");}
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

