<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//atrapar los valores de la rutina
		$day=$_GET['Day'];
		$TipoRutina=$_GET['Rut'];
		
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
				
		//Buscar las actividades relacionadas con el tipo de rutina.
		$ResultEjerciciosPorTipoRutina=$consultar->_ConsultarEjerciciosPorTipoRutina($TipoRutina);
		$num_EjerciciosPorRutina=$ResultEjerciciosPorTipoRutina->num_rows;
		
		//Tomando el tipo de rutina de los ejercicios
		$resultTipoEjercicio=$consultar->_ConsultarEjerciciosPorTipoRutina($TipoRutina);
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
                                    <input type="hidden" id="id_rutina" value="<?php echo $_SESSION['id_rutina'];?>">
                                    <input type="hidden" id="id_dia" value="<?php echo $idDiaRegistroEjercicio?>">
                                    <input type="hidden" id="Dia_Actual" value="<?php echo $DiaRutina;?>">
                                    <input type="hidden" id="id_TipoRutina" value="<?php echo $id_TipoRutina?>">
                                    <input type="hidden" id="nb_TipoRutina" value="<?php  echo $nb_TipoRutina?>">
                                    
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
	
	//Añadiendo la cabeza del tipo de rutina que tendrá
	ContadorRutinasDiasTitulo=$.cookie("ContadorRutinasDias"); //Contador.
	TiposRutinasVector	= $.cookie("TiposRutinasSemana"); //Vector con tipos de rutinas.
	TiposRutinasVector = TiposRutinasVector.split(","); //Separando para evitar las ",".
	$("#TipoRutinaTitulo").text("Tipo de Rutina: "+TiposRutinasVector[ContadorRutinasDiasTitulo]);
	
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
	//Verificando si realmente se quieren continuar
	var confirmacion = confirm('¿Está seguro que desea continuar?');
	if(confirmacion == true)
	{
	//Verificando, si hay rutinas seleccionadas se procede a continuar
	CantidadEjercicios=document.getElementById("bootstrap-duallistbox-selected-list_duallistbox_demo2").length;
	if(CantidadEjercicios>0)
	{
		EjerciciosRutina=new Array();	
		$(".box2 .Actividad").each(function(){
				Ejercicio=$(this).val();
				EjerciciosRutina.push(Ejercicio);
		});//.box2 function

		//Guardando en la BD Los ejercicios de la rutina
	
		//Tomando los datos para insertar los ejercicios a la rutina definida
		id_rutina			     	= $("#id_rutina").val();
		id_usuario		  			= $("#id_usuario").val();
		id_dia			  		    = $("#id_dia").val();
		id_CategoriaRutina		    = $.cookie("id_CategoriaRutina");
		CantidadEjercicios			= EjerciciosRutina.length;
		id_TipoRutina	  			= $("#id_TipoRutina").val();
		
		//Creando un objeto para mandarlo al archivo Funciones.php
		Arr 					    = new Object();
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
		$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){var objJSON = eval("(function(){return " + response + ";})()");})
		
		//Verificando que tipo de rutina es
		Tipo_RutinaActual=$.cookie("Tipo_RutinaActual");
		
		//Si la rutina es compleja debe de hacerse la verificación en que punto del registro va
		if(Tipo_RutinaActual=="Compleja")
		{
			//Tomando los datos pertinentes.
			Contador		 = $.cookie("Contador"); //Las cantidades actuales que se llevan registradas.
			TotalActividades = $.cookie("TotalActividades");  //Total de cantidades  de tipos de rutina que se definirán.
			Contador++; //Se aumenta el contador para decir que ya va una más registrada
			$.cookie("Contador",Contador); //Actualizando el contador
			Dia_ActualRutina=$.cookie("Dia_ActualRutina"); //Día en el que se encuentra el proceso de rutinas
			Rutina=$.cookie("DiaRutina"); //Rutinas a crear
			DiaRutina=Rutina.split(","); //Dia 
			Rut=DiaRutina[Contador];
			if(Contador==TotalActividades)
			{
				Dia_Codigo=CambiarDiaActualRutina(Dia_ActualRutina); //Se cambia el día de la rutina
				VerificarDiaPorCodigo(Dia_Codigo);
				console.log($.cookie(Dia_Codigo));
				$.cookie("Dia_ActualRutina",Dia_Codigo); //Se asigna a la variable de sesión el nuevo día de rutina.
				
				//Obtener que tipo de rutina será la del siguiente día
				ContadorRutinasDias = $.cookie("ContadorRutinasDias");
				ContadorRutinasDias++;
				$.cookie("ContadorRutinasDias",ContadorRutinasDias); //Actualizando el contador
				
				//Trayendo ambos vectores, valor de tipo rutina y su texto
				RutinasVector		= $.cookie("RutinasDias");
				TiposRutinasVector	= $.cookie("TiposRutinasSemana");
				
				//Separando ambos con split para poder acceder y evitar contar las "," como parte del vector.
				RutinasDias 	    = RutinasVector.split(",");
				TiposRutinasVector  = TiposRutinasVector.split(",");
				
				//Cambiar el tipo de rutina actual, ya sea sencilla o complicada.
				
				Rut = RutinasDias[ContadorRutinasDias]; //Tipo de rutina que será, es número
				Tipo_RutinaActualVerificar=TiposRutinasVector[ContadorRutinasDias]; //Tomando el valor para verificar si es simple o compleja
				Tipo_RutinaActual = (Tipo_RutinaActualVerificar!="Varios")?"Simple":"Compleja"; //Definiendo que es
				$.cookie("Tipo_RutinaActual",Tipo_RutinaActual); // Actualizando la cookie.
				
				//Se verifica si es el último día de la semana, para pasar al final de la rutina
				if(Dia_Codigo=="Ejercicio_Terminado")
				{
					window.location='index.php?nav=RutinaOrdenEnt&id_Rutina='+id_rutina; //Elegir rutinas porm día
				}
				else
				{
					//Si el siguiente día tiene rutina compleja se dirige a elegir los ejercicios de la rutina de esedía
					if(Tipo_RutinaActual=="Compleja")
					{
						window.location='index.php?nav=Rutina_Comp&Day='+DiaActual; //Elegir rutinas porm día
					} //if compleja
					else{window.location='index.php?nav=Rutinas_registrar2&Day='+DiaActual+"&Rut="+Rut;}
				}//else
			} //if Contador==TotalActividades
			else
			{
				
				VerificarDiaPorCodigo(Dia_ActualRutina); //tomando el código actual para mandarlo al registro
				window.location='index.php?nav=Rutinas_registrar2&Day='+DiaActual+"&Rut="+Rut;
				
			}
		}//if Compleja
		//Rutina Sencilla
		else
		{
				Dia_ActualRutina=$.cookie("Dia_ActualRutina"); //Día en el que se encuentra el proceso de rutinas
				Dia_Codigo=CambiarDiaActualRutina(Dia_ActualRutina); //Se cambia el día de la rutina
				VerificarDiaPorCodigo(Dia_Codigo);
				console.log($.cookie(Dia_Codigo));
				$.cookie("Dia_ActualRutina",Dia_Codigo); //Se asigna a la variable de sesión el nuevo día de rutina.
				
				//Obtener que tipo de rutina será la del siguiente día
				ContadorRutinasDias=$.cookie("ContadorRutinasDias");
				ContadorRutinasDias++;
				$.cookie("ContadorRutinasDias",ContadorRutinasDias); //Actualizando el contador
				
				//Trayendo ambos vectores, valor de tipo rutina y su texto
				RutinasVector		= $.cookie("RutinasDias");
				TiposRutinasVector	= $.cookie("TiposRutinasSemana");
				
				//Separando ambos con split para poder acceder y evitar contar las "," como parte del vector.
				RutinasDias 	   = RutinasVector.split(",");
				TiposRutinasVector = TiposRutinasVector.split(",");
				
				//Cambiar el tipo de rutina actual, ya sea sencilla o complicada.
				
				Rut=RutinasDias[ContadorRutinasDias]; //Tipo de rutina que será, es número
				Tipo_RutinaActualVerificar=TiposRutinasVector[ContadorRutinasDias]; //Tomando el valor para verificar si es simple o compleja
				Tipo_RutinaActual=(Tipo_RutinaActualVerificar!="Varios")?"Simple":"Compleja"; //Definiendo que es
				$.cookie("Tipo_RutinaActual",Tipo_RutinaActual); // Actualizando la cookie.
				
				//Se verifica si es el último día de la semana, para pasar al final de la rutina
				if(Dia_Codigo=="Ejercicio_Terminado")
				{
					//window.location='index.php?nav=Rutinas_Prefinal&Rutina='+id_rutina; //Elegir rutinas porm día
					window.location='index.php?nav=RutinaOrdenEnt&id_Rutina='+id_rutina; //Elegir rutinas porm día
				}
				else
				{
					//Si el siguiente día tiene rutina compleja se dirige a elegir los ejercicios de la rutina de esedía
					if(Tipo_RutinaActual=="Compleja")
					{
						window.location='index.php?nav=Rutina_Comp&Day='+DiaActual; //Elegir rutinas porm día
					} //if compleja
					else{window.location='index.php?nav=Rutinas_registrar2&Day='+DiaActual+"&Rut="+Rut;}
				}//else
		}
		
	}else {alert("Seleccione ejercicios para la rutina actual");}
	
	}//If de confirmación
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

function CambiarDiaActualRutina(DiaRutina)
{
	switch(DiaRutina)
	{
		case 'Ejercicio_Lunes':
			DiaRutinaActual='Ejercicio_Martes';
		break;
		
		case 'Ejercicio_Martes':
			DiaRutinaActual='Ejercicio_Miercoles';
		break;
		
		case 'Ejercicio_Miercoles':
			DiaRutinaActual='Ejercicio_Jueves';
		break;
		
		case 'Ejercicio_Jueves':
			DiaRutinaActual='Ejercicio_Viernes';
		break;
		
		case 'Ejercicio_Viernes':
			DiaRutinaActual='Ejercicio_Sabado';
		break;
		
		case 'Ejercicio_Sabado':
			DiaRutinaActual='Ejercicio_Domingo';
		break;
		
		case 'Ejercicio_Domingo':
			DiaRutinaActual='Ejercicio_Terminado';
		break;
		
	}//switch
	
	return DiaRutinaActual;
}//CambiarDiaActualRutina

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
