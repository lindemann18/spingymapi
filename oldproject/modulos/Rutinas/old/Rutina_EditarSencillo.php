<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//atrapar los valores de la rutina
		$day=$_GET['Day']; //Día donde se hará la rutina
		$id_rutina=$_GET['Rut']; //Id de la rutina a editar
		$TipoRut=$_GET['TipoRut']; //Tipo de rutina con la cual se buscarán los ejercicios
		
		//Definiendo el día de la semana
		switch($day)
		{
			case '1';
				$DiaRutina="Lunes";
			break;
			case '2';
				$DiaRutina="Martes";
			break;
			case '3';
				$DiaRutina="Miercoles";
			break;
			case '4';
				$DiaRutina="Jueves";
			break;
			case '5';
				$DiaRutina="Viernes";
			break;
			case '6';
				$DiaRutina="Sabado";
			break;
			case '7';
				$DiaRutina="Domingo";
			break;
			
		}//switch
			
		//Consultar la categoría de la rutina por id
		$resultCategoriaRutina=$consultar->_ConsultarRutinaPorId($id_rutina);
		$filaCategoriaRutina=$resultCategoriaRutina->fetch_assoc();
		$id_CategoriaRutina=$filaCategoriaRutina['id_CategoriaRutina'];
				
		//Buscar las actividades relacionadas con el tipo de rutina.
		$ResultEjerciciosPorTipoRutina=$consultar->_ConsultarEjerciciosPorTipoRutina($TipoRut);
		$num_EjerciciosPorRutina=$ResultEjerciciosPorTipoRutina->num_rows;
		
		//Tomando el tipo de rutina de los ejercicios
		$resultTipoEjercicio=$consultar->_ConsultarEjerciciosPorTipoRutina($TipoRut);
		$filaTipoEjercicio=$resultTipoEjercicio->fetch_assoc();
		$id_TipoRutina=$filaTipoEjercicio['id_TipoRutina'];
		$nb_TipoRutina=$filaTipoEjercicio['nb_TipoRutina'];
		
		//Buscando el id del dia actual
		$resultDia=$consultar->_ConsultarDiaPorDesc($DiaRutina);
		$filaDia=$resultDia->fetch_assoc();
		$idDiaRegistroEjercicio=$filaDia['id'];
		
	
		
		
?>

<link rel="stylesheet" href="css/bootstrap-duallistbox.css">
<style>
.Cuestionario{margin-right: 20%;}
.Botones {margin-right: 4%;}
</style>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rutinas
                        <small>Registrar Ejercicios</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Rutinas</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="EjercicioAgregadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Ejercicios Registrado.</div>
                    <h4 class="page-header">
                        Formulario De Rutinas
                        <small>
                        	En este apartado podrá registrar las Rutinas para los clientes de <span class="text-red">spin gym</span>. Anote el nombre de la rutina, descripci&oacute;n
                            seleccione el tipo de rutina para cada día de la semana de la persona.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->

                    <!-- FORMULARIO -->
                    <form name="MusculosRegistrar" id="MusculosRegistrar" method="post" role="form">
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    <div class="row">
                    	<!-- COLUMNA IZQUIERDA -->
                    	<div class="col-md-8 pull-right Cuestionario">
                        	<!-- CAJA -->
							<div class="box box-primary">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Datos Rutinas</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	<h2><?php echo "Día: ".$DiaRutina; ?></h2>
                                    <h3 id="TipoRutinaTitulo"></h3>
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                    <input type="hidden" id="id_rutina" value="<?php echo $id_rutina;?>">
                                    <input type="hidden" id="id_dia" value="<?php echo $idDiaRegistroEjercicio?>">
                                    <input type="hidden" id="Dia_Actual" value="<?php echo $DiaRutina;?>">
                                    <input type="hidden" id="id_TipoRutina" value="<?php echo $id_TipoRutina?>">
                                    <input type="hidden" id="nb_TipoRutina" value="<?php  echo $nb_TipoRutina?>">
                                    <input type="hidden" id="id_CategoriaRutina" value="<?php echo $id_CategoriaRutina;?>" />
                                     
                                    <div class="form-group">
                                        <label for="nb_apellidos" id="EjerciciosLabel"></label>
                                       <select multiple="multiple" size="10" name="duallistbox_demo2" class="demo2">
                                       <?php 
									   		for($i=0; $i<$num_EjerciciosPorRutina; $i++)
											{
												$filaEjerciciosPorRutina=$ResultEjerciciosPorTipoRutina->fetch_assoc();
												echo '<option value="'.$filaEjerciciosPorRutina['id'].'" class="Actividad">'.$filaEjerciciosPorRutina['nb_ejercicio'].'</option>';
												$id_TipoRutina=$filaEjerciciosPorRutina['id_TipoRutina'];
											}//for
									   		echo '';
									  	?>
       
     								 </select>
       
                                    </div>
                                    
                                    <!-- días de la rutina-->
                                    
                                    
                                </div><!-- box-body -->
                                <!-- CUERPO DE LA CAJA -->

                                <!-- FOOTER DE LA CAJA -->
                                <div class="box-footer">
                                     Los campos marcados con <span class="text-red"><strong>*</strong></span> son obligatorios.
                                </div>
                                <!-- FOOTER DE LA CAJA -->
                            </div>
                            <!-- CAJA -->
                        </div>
                        <!-- COLUMNA IZQUIERDA -->
                        
                       
                    </div>
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    
                    <div class="row Botones">
                    	<div class="col-md-6" align="right"><button type="button" class="btn btn-primary" onclick=" checkRequeridos();">REGISTRAR</button></div>
                        <div class="col-md-6" align="left"><button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Ejercicios';">CANCELAR</button></div>
                    </div>
                    </form>
                    <!-- FORMULARIO -->
                </section>
            </aside>

</div>

<?php 
	include('includes/footer.php');
	include("modulos/Usuarios/JavaScript.php");
?>

<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listado.php';
	
	
	
	//Poniendo el encabezado de que tipo rutina pertenecen los ejercicios en caso de que sea Varios
	nb_TipoRutina=$("#nb_TipoRutina").val();
	$("#EjerciciosLabel").text("Ejercicios Para: "+nb_TipoRutina);
	
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-rutinas').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	$('#nb_cliente').focus();
	
	//Variables globales
	DiaActual=0; //Día de la semana para pasar al siguiente día.
	RutinaSiguiente=0; //Esta variable es para cuando se cambia la rutina, la uso en caso de que usen rutina compleja y necesite pasarse al
	//Siguiente día
	
	  var demo2 = $('.demo2').bootstrapDualListbox({
          nonSelectedListLabel: 'Non-selected',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false
        });
});



function checkRequeridos(){
	var contador 	= 0;
	var campo		= '';
	var	id			= '';
	
	//PARA CADA ELEMENTO CON CLASE requerido
	$(".requerido").each(function(index){
		//SI EL VALOR DE ESTE ELEMENTO ES VACIO
		if ($(this).val() == '' ){
			contador++;									//AUMENTAMOS EN 1 A contador
			$(this).parent().addClass('has-error');		//AGREGAMOS AL DIV PADRE DEL ELEMENTO (CON CLASE requerido) LA CLASE has-error
			$(this).focus();							//LE PASAMOS EL FOCO AL ELEMENTO
			return false;								//RETORNAMOS UN FALSE PARA QUE NO SE EJECUTE EL SUBMIT
		}
		
		//SI EL DIV PADRE DEL ELEMENTO TIENE LA CLASE has-error Y EL VALOR DEL ELEMENTO CON CLASE REQUERIDO ES
		//DIFERENTE DE VACIO
		if( $(this).parent().hasClass('has-error') && $(this).val() != '' ){
			//REMOVEMOS LA CLASE has-error DEL DIV PADRE DEL ELEMENTO CON CLASE requerido
			$(this).parent().removeClass('has-error');
			//RESETEAMOS contador PARA QUE VUELVA A SER 0 Y NO AFECTE EN LA SIGUIENTE VALIDACION
			contador = 0;
		}
	});
	
	//SI CONTADOR (POR ALGUNA EXTRAÑA RAZON) ES DIFERENTE DE 0
	if( contador != 0 ){
		//RETORNAMOS FALSE PARA QUE NO SE EJECUTE EL SUBMIT
		return false;
	//SI NO
	}else{
		//EJECUTAMOS  LA FUNCION clientesRegistrar()
		RegistraMaquina();
	}
}

function RegistraMaquina()
{
	//Verificando, si hay rutinas seleccionadas se procede a continuar
	CantidadEjercicios=document.getElementById("bootstrap-duallistbox-selected-list_duallistbox_demo2").length;
	if(CantidadEjercicios>0)
	{
			EjerciciosRutina=new Array();	
	    $(".box2 .Actividad").each(function(){
			Ejercicio=$(this).val();
			EjerciciosRutina.push(Ejercicio);
		});

		//Guardando en la BD Los ejercicios de la rutina
	
		//Tomando los datos para insertar los ejercicios a la rutina definida
		id_rutina		   = $("#id_rutina").val();
		id_usuario		   = $("#id_usuario").val();
		id_dia			   = $("#id_dia").val();
		id_CategoriaRutina = $("#id_CategoriaRutina").val();
		CantidadEjercicios = EjerciciosRutina.length;
		id_TipoRutina	   = $("#id_TipoRutina").val();
		
		//Creando un objeto para mandarlo al archivo Funciones.php
		Arr=new Object();
		Arr['id_rutina']			= id_rutina;
		Arr['id_usuario']			= id_usuario;
		Arr['id_dia']				= id_dia;
		Arr['id_CategoriaRutina'] 	= id_CategoriaRutina;			
		Arr['EjerciciosRutina']		= EjerciciosRutina;
		Arr['CantidadEjercicios']	= CantidadEjercicios;
		Arr['id_TipoRutina']		= id_TipoRutina;
		Arr['Accion']				= "RegistrarEjerciciosRutinas";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);	
		$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){
		
		
		//Verificando que tipo de rutina es
		Tipo_RutinaActual=$.cookie("Tipo_RutinaActual");
		
		
		
		
		//Se trae los datos de los días actuales
		DiasRutinas	  = $.cookie("DiasRutinas");//Vector con los id de los tipos de rutinas (1-8) (Declarado en Rutina_CompEdit)
		IdDiasRutinas = $.cookie("IdDiasRutinas"); //Vector con los ids de los inputs ej. lunes_Ejercicio(Declarado en Rutina_CompEdit)
		TextoRutinas  = $.cookie("TextoRutinas");//Vector con los textos de tipos de rutina (Declarado en Rutina_CompEdit)
		DiasEdicion	  = $.cookie("DiasEdicion") //Vector con el id de los días que serán editados, ej: Lunes, martes, etc. (Rutinas_editar.php)
		ContadorDias  = $.cookie("ContadorDiasEditar"); //Contador de los días (Declarado en rutinas_EditarDias)
		CantidadDias  =	$.cookie("CantidadDias"); //cantidad total de los días a editar(Declarado en rutinas_EditarDias)
		
		//Separar los Vectores
		DiasRutinasSplit   = DiasRutinas.split(",");
		IdDiasRutinasSplit = IdDiasRutinas.split(",");
		TextoRutinasSplit  = TextoRutinas.split(",");
		DiasEdicionSplit   = DiasEdicion.split(",");	
		
	
		
		//Si la rutina es compleja debe de hacerse la verificación en que punto del registro va
		if(Tipo_RutinaActual=="Compleja")
		{
			//Tomando los datos pertinentes.
			Contador		 = $.cookie("ContadorActividadesDiaActual"); //Las cantidades actuales que se llevan registradas.
			TotalActividades = $.cookie("TotalActividadesDiaActual");  //Total de cantidades  de tipos de rutina que se definirán.
			Contador++; //Se aumenta el contador para decir que ya va una más registrada.
			 $.cookie("ContadorActividadesDiaActual",Contador); //actualizando el contador de actividades 
			 
			if(Contador==TotalActividades) //se verifica si ya se cumplieron todos los ejercicios a realizar.
			{
				//Al estar igual significa que se terminó de editar lo de este día, entonces se pasa al siguiente.
				
				ContadorDias++; //se le suma 1 por que significa que ya se cumplió este día
				
				//Verificando que no se han cumplido todos los días a editar.
				if(CantidadDias==ContadorDias)
				{
					//Si cantidad se cumplió es por que ya se cumplieron todas las ediciones.
					
					//Se actualizan los id_PosicionEjercicio para que todos queden a la par.
					//Creando un objeto para mandarlo al archivo Funciones.php
					Arr=new Object();
					Arr['id_rutina']			= id_rutina;
					Arr['Accion']				= "EditarEjerciciosRutinas";
		
					//Mandando por AJAX la información a la BD
					var Params= JSON.stringify(Arr);	
					$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){
						
					}); //ajax
					
					//se procede a mandar a que se vea la rutina después de los cambios.
					window.location='index.php?nav=RutinaOrdenEnt&id_Rutina='+id_rutina; //Elegir rutinas porm día.
				}// if CantidadDias==ContadorDias
				
				else	//Es que todavía quedan días por editar.
				{
					$.cookie("ContadorDiasEditar",ContadorDias); //ACtualizando el contador de días.
					
					// Se debe proceder a sacar el siguiente día de la rutina, su tipo de rutina, el id del día
					// Verificar si es sencilla o compleja y dirigir a donde debe de irse dependiendo de su tipo de rutina
					
					CodigoDiaSiguiente=DiasEdicionSplit[ContadorDias]; //Día actual para editar
					TextoRutinaDiaActual=TextoRutinasSplit[ContadorDias]; //Texto de la rutina actual, ya sea brazo, varios, clase, etc.
					Tipo_RutinaSiguienteDia=(TextoRutinaDiaActual!="Varios")?"Simple":"Compleja"; //Definiendo que tipo de rutina es.
					TipoRutina_idCategoria=DiasRutinasSplit[ContadorDias]; //es el número de la rutina par aobtener los ejercicios
					$.cookie("Tipo_RutinaActual",Tipo_RutinaSiguienteDia); //ACtualizando el tipo de rutina para este día
					
						//Verificar el tipo de rutina para mandarlo a rutina compleja o a rutina simple
						if(Tipo_RutinaSiguienteDia=="Compleja")
						{
							window.location='index.php?nav=Rutina_CompEdit&Rut='+id_rutina+'&Day='+CodigoDiaSiguiente; //Elegir rutinas porm día
						}// if Tipo_RutinaActual
						else
						{
							TipoRutinaEditar=DiasRutinasSplit[ContadorDias]; //id del tipo de rutina para traer los ejercicios, ya se abrazo, pierna, etc.
							window.location='index.php?nav=Rutina_EditarSencillo&Day='+CodigoDiaSiguiente+"&Rut="+id_rutina+"&TipoRut="+TipoRutina_idCategoria;
						}//else
				} //else
			} //if Contador==TotalActividades
			
			//Todavía faltan actividades para ese día
			else
			{
				RutinasDiaEdicion=$.cookie("RutinasDiaEdicion"); //Array donde se guardan las cantidades de rutinas a realizar.
				RutinasDiaEdicionSplit=RutinasDiaEdicion.split(","); //Vector de las actividades sanitizado de comas
				IdSiguienteActividad=RutinasDiaEdicionSplit[Contador]; //Tomando la siguiente actividad
				
				//Redirigiendo
				window.location='index.php?nav=Rutina_EditarSencillo&Day='+id_dia+"&Rut="+id_rutina+"&TipoRut="+IdSiguienteActividad;
			}//else
		}//if Compleja
		
		//Rutina Sencilla
		else
		{
				ContadorDias++; //se le suma 1 por que significa que ya se cumplió este día
				//Verificando que no se han cumplido todos los días a editar.
				if(CantidadDias==ContadorDias)
				{
					//Si cantidad se cumplió es por que ya se cumplieron todas las ediciones.
					
					//Se actualizan los id_PosicionEjercicio para que todos queden a la par.
					//Creando un objeto para mandarlo al archivo Funciones.php
					Arr=new Object();
					Arr['id_rutina']			= id_rutina;
					Arr['Accion']				= "EditarEjerciciosRutinas";
		
					//Mandando por AJAX la información a la BD
					var Params= JSON.stringify(Arr);	
					$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){
						
					}); //ajax
					
					//se procede a mandar a que se vea la rutina después de los cambios.
					window.location='index.php?nav=RutinaOrdenEnt&id_Rutina='+id_rutina; //Elegir rutinas porm día.
				}// if CantidadDias==ContadorDias
				
				else	//Es que todavía quedan días por editar.
				{
					$.cookie("ContadorDiasEditar",ContadorDias); //ACtualizando el contador de días.
					
					// Se debe proceder a sacar el siguiente día de la rutina, su tipo de rutina, el id del día
					// Verificar si es sencilla o compleja y dirigir a donde debe de irse dependiendo de su tipo de rutina
					CodigoDiaSiguiente=DiasEdicionSplit[ContadorDias]; //Día actual para editar
					TextoRutinaDiaActual=TextoRutinasSplit[ContadorDias]; //Texto de la rutina actual, ya sea brazo, varios, clase, etc.
					Tipo_RutinaSiguienteDia=(TextoRutinaDiaActual!="Varios")?"Simple":"Compleja"; //Definiendo que tipo de rutina es.
					TipoRutina_idCategoria=DiasRutinasSplit[ContadorDias]; //es el número de la rutina par aobtener los ejercicios
					$.cookie("Tipo_RutinaActual",Tipo_RutinaSiguienteDia); //ACtualizando el tipo de rutina para este día
					
						//Verificar el tipo de rutina para mandarlo a rutina compleja o a rutina simple
						if(Tipo_RutinaSiguienteDia=="Compleja")
						{
							window.location='index.php?nav=Rutina_CompEdit&Rut='+id_rutina+'&Day='+CodigoDiaSiguiente; //Elegir rutinas porm día
						}// if Tipo_RutinaActual
						else
						{
							TipoRutinaEditar=DiasRutinasSplit[ContadorDias]; //id del tipo de rutina para traer los ejercicios, ya se abrazo, pierna, etc.
							window.location='index.php?nav=Rutina_EditarSencillo&Day='+CodigoDiaSiguiente+"&Rut="+id_rutina+"&TipoRut="+TipoRutina_idCategoria;
						}//else
				}//else
			
		} //else de rutina sencilla
			
		});//ajax de agregar. Se coloca aquí por que de otra manera no hace el cabio de id_PosicionEjercicio del último elemento.
	}else {alert("Seleccione ejercicios para la rutina actual");}
	

}//RegistraMaquina

function CambiarDiaActual(Dia)
{
	switch(Dia)
	{
			case 'Ejercicio_Lunes':
			DiaActual="1";
		break;
		case 'Ejercicio_Martes':
			DiaActual="2";
		break;
		case 'Ejercicio_Miercoles':
			DiaActual="3";
		break;
		case 'Ejercicio_Jueves':
			DiaActual="4";
		break;
		case 'Ejercicio_Viernes':
			DiaActual="5";
		break;
		case 'Ejercicio_Sabado':
			DiaActual="6";
		break;
		case 'Ejercicio_Domingo':
			DiaActual="7";
		break;
	
	}//switch
}//CambiarDiaActual


function VerificarDiaPorCodigo(Dia)
{
	switch(Dia)
	{
		case 'Ejercicio_Lunes':
			DiaActual="1";
		break;
		case 'Ejercicio_Martes':
			DiaActual="2";
		break;
		case 'Ejercicio_Miercoles':
			DiaActual="3";
		break;
		case 'Ejercicio_Jueves':
			DiaActual="4";
		break;
		case 'Ejercicio_Viernes':
			DiaActual="5";
		break;
		case 'Ejercicio_Sabado':
			DiaActual="6";
		break;
		case 'Ejercicio_Domingo':
			DiaActual="7";
		break;
	}//switch
}//VerificarDiaPorCodigo

</script>
