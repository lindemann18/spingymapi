<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//atrapar los valores de la rutina
		$id_rutina 	  = $_GET['id_rutina'];
		$resultDias   = $consultar->_ConsultarDiasSemana();
		

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
                        	En este apartado podrá Editar las Rutinas para los clientes de <span class="text-red">spin gym</span>. Seleccione los d&iacute;as
                            de las rutinas a editar y luego proceda a seleccionar los ejercicios y categorías de los mismos 
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
                                	<h2>Rutinas Edici&oacute;n</h2>
                                    <h3 id="TipoRutinaTitulo"></h3>
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                    <input type="hidden" id="id_rutina" value="<?php echo $id_rutina;?>">
                                    <div class="form-group">
                                        <label for="nb_apellidos" id="EjerciciosLabel"></label>
                                       <select multiple="multiple" size="10" name="duallistbox_demo2" class="demo2">
                                       <?php 
									   		for($i=0; $i<7; $i++)
											{
												$filaDias=$resultDias->fetch_assoc();
												echo '<option value="'.$filaDias['id'].'" class="Actividad">'.$filaDias['nb_dia'].'</option>';
												
											}//for
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
                    	<div class="col-md-6" align="right"><button type="button" class="btn btn-primary" onclick=" checkRequeridos();">EDITAR</button></div>
                        <div class="col-md-6" align="left"><button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Rutinas';">CANCELAR</button></div>
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
	CantidadDias=document.getElementById("bootstrap-duallistbox-selected-list_duallistbox_demo2").length; //tomando la cantidad de días
	//Ingresando en un vector los días que se tendrán que editar
	if(CantidadDias>0)
	{
			DiasEdicion=new Array();	
			$(".box2 .Actividad").each(function(){
				Dia=$(this).val();
				DiasEdicion.push(Dia);
			}); //function


		//Tomando los datos de la rutina
		id_rutina=$("#id_rutina").val(); //Id de la rutina a editar
		id_usuario=$("#id_usuario").val(); //id del usuario que edita
		
		//Guardando en Cookies los datos para pasar a la edición de ejercicios por día
		Contador = 0; //Contador para saber cuantos días se lleva editados.
		$.cookie("Contador", Contador); //Cookie del contador
		$.cookie("DiasEdicion",DiasEdicion); //Vector con los días a editar
		$.cookie("CantidadDias",CantidadDias); //Cantidad de días que se editarán, se compararán el contador y este para ver si ya se terminó.
		 
		 console.log(DiasEdicion);
		//Desactivando los ejercicios de los días a editar en las rutinas.
		Arr=new Object();
		Arr['id_rutina']	= id_rutina;
		Arr['DiasEdicion']	= DiasEdicion;
		Arr['CantidadDias']	= CantidadDias;
		Arr['Accion']		= "DesactivarEjerciciosPorRutina";
		
		//Mandando por AJAX la información a la BD
		var Params= JSON.stringify(Arr);	
		$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).then(function(response){
			//Redirigiendoa la parte donde dan de alta los registros de nuevo
			window.location='index.php?nav=Rutinas_EditarDias&id_rutina='+id_rutina;
		});
		
		
		
	}else {alert("Seleccione días para editar");}
	

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
