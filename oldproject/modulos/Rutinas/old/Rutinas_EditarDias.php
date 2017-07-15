<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//atrapar los valores de la rutina
		$id_rutina	  = $_GET['id_rutina'];
		
		//Tomando los valores de la variable de sesión
		$DiasEdicion  = $_SESSION['DiasEdicion'];  
		$CantidadDias = $_SESSION['CantidadDias']; 
		$contador	  = $_SESSION['Contador'];
		
		//Tomando el día actual al que se le hará la edición
		$DiaActualEdicion	=	$DiasEdicion[$contador];
		$contador++;  //añadiendo uno más al contador
		//$_SESSION['Contador']=$contador; //ACtualizando el contador
		
		
				
		//Consultar los tipos de rutinas que existen
		$ResultRutinas=$consultar->_ConsultarTiposDeRutina(); //rutinas existentes(
		$num_rutinas=$ResultRutinas->num_rows; //cantidad de rutinas
		$Rutinas=Array(); 
		
		//Tomando todas las rutinas para pegarlas en los selects
		for($i=0; $i<$num_rutinas; $i++)
		{
			$fila=$ResultRutinas->fetch_assoc();
			$rutina=array("id"=>$fila['id'], "nb_TipoRutina"=>$fila['nb_TipoRutina']);
			array_push($Rutinas, $rutina);
		}//for
		
		
		function RetornarDiaActual($DiaActualEdicion)
		{
				switch($DiaActualEdicion)
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
				return $DiaRutina;
		}//RetornarDiaActual
		
		function RetornarIdPorNombre($nombre)
		{
				
			switch($nombre)
			{
				case 'Lunes':
					$id_inputreturn='Ejercicio_Lunes';
				break;
				
				case 'Martes':
					$id_inputreturn='Ejercicio_Martes';
				break;
				
				case 'Miercoles':
					$id_inputreturn='Ejercicio_Miercoles';
				break;
				
				case 'Jueves':
					$id_inputreturn='Ejercicio_Jueves';
				break;
				
				case 'Viernes':
					$id_inputreturn='Ejercicio_Viernes';
				break;
				
				case 'Sabado':
					$id_inputreturn='Ejercicio_Sabado';
				break;
				
				case 'Domingo':
					$id_inputreturn='Ejercicio_Domingo';
				break;
				
			}//switch
			return $id_inputreturn;
		}//RetornarIdPorNombre
		
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
                                	<h2>Edici&oacute;n De Rutinas</h2>
                                    <h3 id="TipoRutinaTitulo"></h3>
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                    <input type="hidden" id="id_rutina" value="<?php echo $id_rutina; ?>">
                                  
                                    
                                    <!-- días de la rutina-->
                                    <?php 
									
									//Imprimiendo los días a cambiar
									
									for($i=0; $i<$CantidadDias; $i++)
									{
										//Obtener nombre del día de la semana
										$id_dia=$DiasEdicion[$i]; //id del día a editar
										$nombreDia=RetornarDiaActual($id_dia); //Nombre del día a editar a partir del ID
										$id_input=RetornarIdPorNombre($nombreDia); //id del input del día a editar-.
										
										?>
										<div class="form-group">
											<label for="nb_apellidos"><?php echo $nombreDia;  ?></label>
										   <select name="<?php echo $id_input;?>" id="<?php echo $id_input;?>" class="form-control requerido SelectDia" onChange="">
												<option value="">Seleccionar...</option>
												<?php 
													for($j=0; $j<$num_rutinas; $j++)
													{
														echo '<option value="'.$Rutinas[$j]['id'].'">'.$Rutinas[$j]['nb_TipoRutina'].'</option>';
													}		
												?>
											</select>
										</div>
										
									<?php }//for  ?>
                                  
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
		id_rutina	  = $("#id_rutina").val();		
		IdDiasRutinas = new Array(); //Vector con los ids de los inputs
		DiasRutinas   = new Array(); //Vector con los id de los tipos de rutinas, números 1,2,3,etc.
		TextoRutinas  = new Array(); //Vector con los textos de tipos de rutina
		
		$(".SelectDia").each(function(){
			
			//tomando el id de los inputs
			id_select=this.id; //tomando el id de los inputs
			IdDiasRutinas.push(id_select); //Ingresándolos al vectór
			
			//Tomando los valores de los inputs
			id2="#"+id_select; //id para jquery
			ValInput=$(id2).val(); //tomando el valor del input
			DiasRutinas.push(ValInput); //insertándolo al vector
			
			//Tomando texto de las rutinas
			id3=id2+" option:selected"; //id para tomar los textos
			TextoInput=$(id3).text();
			TextoRutinas.push(TextoInput);
		});
	
	
	Cantidad = DiasRutinas.length; //Para comparar con el contador
	Contador =0;					//Contador de cuantos días se llevan hechos
	TipoRutina = TextoRutinas[Contador]; //Texto de la rutina del primer elemento del vectór para determinar si es simple o complicada
	CodigoDia=VerificarDiaPorCodigo(IdDiasRutinas[Contador]); //número de día para mandar a la siguiente pantalla el día que será editado
	
	//Definiendo que tipo de rutina será la primera a editar
	Tipo_RutinaActual=(TipoRutina!="Varios")?"Simple":"Compleja"; //Se toma el tipo de rutina que se ha seleccionado para ver a donde se 
	
	//Definiendo el día actual de la rutina
	Dia_ActualRutina=IdDiasRutinas[Contador];
	//guardando en cookies los vectores
	$.cookie("DiasRutinas",DiasRutinas);
	$.cookie("IdDiasRutinas",IdDiasRutinas);
	$.cookie("TextoRutinas",TextoRutinas);
	$.cookie("ContadorDiasEditar",Contador); 
	$.cookie("Tipo_RutinaActual",Tipo_RutinaActual); //Cookie para saber en que tipo de rutina se encuentra la edición actual	
	$.cookie("Dia_ActualRutina",Dia_ActualRutina);//Día actual de la rutina donde nos encontramos
	
	console.log(IdDiasRutinas);
	console.log(DiasRutinas);
	console.log(TextoRutinas);
	
	//Dirige al usuario, si a elegir varios tipos de rutina o ejercicios de forma directa.
	var confirmacion = confirm('¿Está seguro de pasar al siguiente FORMULARIO?');
		if(confirmacion == true)
		{
			//Se debe tomar el id de la rutina y el día
			
			if(Tipo_RutinaActual=="Compleja")
			{
				window.location='index.php?nav=Rutina_CompEdit&Rut='+id_rutina+'&Day='+CodigoDia; //Elegir rutinas porm día
			}//if Tipo_RutinaActual=="Compleja
			else
			{
				//Tomando la rutina actual  a seguir 
				RutinaActualEditar=DiasRutinas[Contador];
				window.location='index.php?nav=Rutina_EditarSencillo&Day='+CodigoDia+"&Rut="+id_rutina+"&TipoRut="+RutinaActualEditar;	
			} //else
			
		}//if confirmacion
	

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
	return DiaActual;
}//VerificarDiaPorCodigo

</script>
